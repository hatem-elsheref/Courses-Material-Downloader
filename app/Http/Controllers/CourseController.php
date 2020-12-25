<?php

namespace App\Http\Controllers;

use App\Category;
use App\Course;
use App\Instructor;
use App\Material;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class CourseController extends Controller
{

    public function index(Request $request)
    {
        $courses=Course::with(['instructor','category','materials'])->where(function ($query) use($request){
            return $query->when($request->search,function ($q) use ($request){
                return $q->where('name','like','%'.$request->search.'%')
                    ->orWhere('slug','like','%'.$request->search.'%')
                    ->orWhere('description','like','%'.$request->search.'%');
//                    ->orWhere('price','=',$request->search);
            });
        })->orderByDesc('id')->paginate(PAGINATION);
        return view('dashboard.courses.index',compact('courses'))->with('title','All Courses');
    }

    public function show($id)
    {
        $course=Course::with(['category','instructor'])->findOrFail($id);
        $materials=Material::where('course_id',$course->id)->orderByDesc('id')->paginate(PAGINATION);
        return view('dashboard.materials.index',['materials'=>$materials,'course'=>$course]);
    }

    public function create()
    {
        $data['instructors']=Instructor::select('id','name')->get();
        $data['categories'] =Category::select('id','name')->get();
        return view('dashboard.courses.create',$data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'          =>'required|string|max:191',
//            'price'         =>'required|numeric|min:0',
            'category_id'   =>['required','numeric',Rule::exists('categories','id')],
            'instructor_id' =>['required','numeric',Rule::exists('instructors','id')],
            'description'   =>'required|string',
            'photo'         =>'required|image|mimes:png,jpg,jpeg',
        ]);

        $validatedData=$request->except(['_token','photo','_wysihtml5_mode']);

        $validatedData['slug']=Str::slug($request->name).rand(1,10);
        $validatedData['photo']='';
        $validatedData['price']=0;

        if ($request->hasFile('photo')){
            $fileName=$request->file('photo')->hashName();
            $parentPath='uploads/courses';
            $request->file('photo')->move($parentPath,$fileName);
            $validatedData['photo']='uploads/courses/'.$fileName;
        }

        $course=Course::create($validatedData);
        $course?success():fail();
        return redirect()->route('course.index');
    }


    public function edit($id)
    {
        $course=Course::findOrFail($id);
        $data['course']     =$course;
        $data['instructors']=Instructor::select('id','name')->get();
        $data['categories'] =Category::select('id','name')->get();
        return view('dashboard.courses.edit',$data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'          =>'required|string|max:191',
//            'price'         =>'required|numeric|min:0',
            'category_id'   =>['required','numeric',Rule::exists('categories','id')],
            'instructor_id' =>['required','numeric',Rule::exists('instructors','id')],
            'description'   =>'required|string',
            'photo'         =>'image|mimes:png,jpg,jpeg',
        ]);
        $course=Course::findOrFail($id);
        $validatedData=$request->except(['_token','_method','photo','_wysihtml5_mode']);
        $validatedData['photo']=$course->photo;
        $validatedData['slug']=Str::slug($request->name).rand(1,10);
        $validatedData['price']=0;
        if ($request->hasFile('photo')){
            $fileName=$request->file('photo')->hashName();
            $parentPath='uploads/courses';
            Storage::disk('my_desk')->delete($course->photo);
            $request->file('photo')->move($parentPath,$fileName);
            $validatedData['photo']='uploads/courses/'.$fileName;
        }


        $course->update($validatedData)?success():fail();
        return redirect()->route('course.index');
    }

    public function destroy($id)
    {
        $course=Course::findOrFail($id);
        Storage::disk('my_desk')->delete($course->photo);
        $courseDirectory = 'course_' . $course->name . '_' . $course->id;
        Storage::disk('my_desk')->deleteDirectory('uploads'.DIRECTORY_SEPARATOR.'materials'.DIRECTORY_SEPARATOR.$courseDirectory);
        $course->delete()?success():fail();
        return redirect()->route('course.index');
    }


}
