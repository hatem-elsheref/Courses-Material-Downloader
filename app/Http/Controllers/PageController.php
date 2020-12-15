<?php

namespace App\Http\Controllers;

use App\Category;
use App\Course;
use App\Contact;
use App\Instructor;
use App\Material;
use App\Rules\Email;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PageController extends Controller
{
    public function __construct(){
        $this->middleware('auth')->only('download');
    }

    public function index(){
        $topCourses=Course::with(['instructor','category'])->orderByDesc('id')->take(TOP)->get();
        $topInstructors=Instructor::with(['courses'])->inRandomOrder('id')->take(4)->get();
        return view('front.index',compact('topCourses'))->with('instructors',$topInstructors);
    }
    public function searchByCategory($slug){
        $category=Category::where('slug',$slug)->firstOrFail();
        $courses=Course::with(['instructor','category','materials'])->where('category_id',$category->id)->paginate(PAGINATION);
        return view('front.courses',['courses'=>$courses]);
    }
    public function searchByInstructor($id){
        $instructor=Instructor::with('courses')->where('id',$id)->firstOrFail();
        $courses=Course::with(['instructor','category','materials'])->where('instructor_id',$instructor->id)->paginate(PAGINATION);
        return view('front.courses',['courses'=>$courses]);
    }
    public function searchByKeyword(Request $request){
        $Courses=Course::with(['instructor','category'])->where('name','like','%'.$request->search.'%')->orWhere('description','like','%'.$request->search.'%')
        ->orderByDesc('id')->paginate(PAGINATION);
        return view('front.courses',['courses'=>$Courses]);
    }
    public function courseDetails($slug){
        $course=Course::with(['instructor','category','materials'])->where('slug',$slug)->firstOrFail();
        $relatedCourses=Course::with(['category','materials'])->where('category_id',$course->category_id)->orWhere('instructor_id',$course->instructor->id)->take(TOP)->get();
        return view('front.course-details',compact('course'))->with('related',$relatedCourses);
    }

    public function courses(){
        $courses=Course::with(['instructor','category'])->orderByDesc('id')->paginate(9);
        return view('front.courses',compact('courses'));
    }



    // pages
    public function about(){
        $data['instructors']=Instructor::count();
        $data['courses']=Course::count();
        $data['materials']=Material::count();
        return view('front.about',$data);
    }
    public function contact(){
        return view('front.contact');
    }
    public function sendContact(Request $request){
        $request->validate([
            'name'      =>'required|string|max:191',
            'email'     =>['required','email','max:191',new Email()],
            'subject'   =>'required|string|max:191',
            'message'   =>'required|string',
        ]);

        $request->status='unread';
        Contact::create($request->except(['_token']));
        success();
        return redirect()->back()->with('response',['type'=>'success','message'=>'Message Sent Successfully']);
    }

    public function download($id){
        $material=Material::findOrFail($id);
        if (in_array($material->type,['video','audio'])){
            if ($material->type =='video'){
                if ($material->source =='Youtube'){
                    $material->download+=1;
                    $material->save();
                    $this->downloadVideoFromYoutube($material);
                }else{
                    $material->download+=1;
                    $material->save();
                    $this->downloadFromExternalHost($material);
                }
            }else{
                $material->download+=1;
                $material->save();
                $this->downloadFromExternalHost($material);
            }
        }else{
           if ($material->source == 'Uploading'){
               $material->download+=1;
               $material->save();
               return Storage::disk('my_desk')->download($material->path,$material->download_name);
           }else{
               $material->download+=1;
               $material->save();
               $this->downloadFilesFromExternalHost($material);
           }
        }
    }
    private function downloadFilesFromExternalHost($material){
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="'.$material->download_name.'"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        flush(); // Flush system output buffer
        readfile($material->path);
        die();
    }

    private function downloadVideoFromYoutube($material){
        // Load and initialize downloader class

        $handler = new \YouTubeDownloader();

// Youtube video url
        $youtubeURL = $material->path;

// Check whether the url is valid
        if(!empty($youtubeURL) && !filter_var($youtubeURL, FILTER_VALIDATE_URL) === false){
            // Get the downloader object
            $downloader = $handler->getDownloader($youtubeURL);

            // Set the url
            $downloader->setUrl($youtubeURL);

            // Validate the youtube video url
            if($downloader->hasVideo()){
                // Get the video download link info
                $videoDownloadLink = $downloader->getVideoDownloadLink();

                $videoTitle = $videoDownloadLink[0]['title'];
                $videoQuality = $videoDownloadLink[0]['qualityLabel'];
                $videoFormat = $videoDownloadLink[0]['format'];
                $videoFileName = strtolower(str_replace(' ', '_', $videoTitle)).'.'.$videoFormat;
                $downloadURL = $videoDownloadLink[0]['url'];


                if(!empty($downloadURL)){
                    // Define header for force download
                    header("Cache-Control: public");
                    header("Content-Description: File Transfer");
                    header("Content-Disposition: attachment; filename=$material->download_name");
                    header("Content-Type: application/zip");
                    header("Content-Transfer-Encoding: binary");

                    // Read the file
                    readfile($downloadURL);
                }
            }else{
                echo "The video is not found, please check YouTube URL.";
            }
        }else{
            echo "Please provide valid YouTube URL.";
        }

    }
    private function downloadFromExternalHost($material){
        if(!empty($material->path)){
            // Define headers
            header("Cache-Control: public");
            header("Content-Description: File Transfer");
            header("Content-Disposition: attachment; filename=$material->download_name");
            header("Content-Type: application/zip");
            header("Content-Transfer-Encoding: binary");

            // Read the file
            readfile($material->path);
        }


    }


}



