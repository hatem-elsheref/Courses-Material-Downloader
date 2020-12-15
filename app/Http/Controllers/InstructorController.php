<?php

namespace App\Http\Controllers;

use App\Course;
use App\Instructor;
use App\Rules\Email;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class InstructorController extends Controller
{
    public function index()
    {
        $instructors=Instructor::with('courses')->orderByDesc('id')->get();
        return view('dashboard.instructors.index',compact('instructors'));
    }

    public function create()
    {
        return view('dashboard.instructors.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'  =>'required|string|max:191',
            'job'   =>'required|string|max:191',
            'email' =>['required','email','max:191',Rule::unique('instructors','email'),new Email()],
            'photo' =>'image|mimes:png,jpg,jpeg'
        ]);

        $validatedData=$request->except(['_token','photo']);
        if ($request->hasFile('photo')){
            $newName='uploads/instructors/'.$request->file('photo')->hashName();
            $request->file('photo')->move('uploads/instructors',$newName);
        }else{
            $newName='uploads/instructors/'.DEFAULT_AVATAR;
        }

        $validatedData['photo']=$newName;
        $instructor=Instructor::create($validatedData);
        $instructor?success():fail();
        return redirect()->route('instructor.index');
}

    public function show($id)
    {
        $insreuctor=Instructor::findOrFail($id);
        $courses=Course::with(['instructor','category','materials'])->where('instructor_id',$insreuctor->id)->orderByDesc('id')->paginate(PAGINATION);
        return view('dashboard.courses.index',compact('courses'))->with('title','All Courses Of '.$insreuctor->name .' Instructor');
    }

    public function edit($id)
    {
        $instructor=Instructor::findOrFail($id);
        return view('dashboard.instructors.edit',compact('instructor'));
    }

    public function update(Request $request, $id)
    {
        $instructor=Instructor::findOrFail($id);

        $request->validate([
            'name'  =>'required|string|max:191',
            'job'   =>'required|string|max:191',
            'email' =>['required','email','max:191',Rule::unique('instructors','email')->ignore($instructor->id),new Email()],
            'photo' =>'image|mimes:png,jpg,jpeg'
        ]);

        $validatedData=$request->except(['_token','photo','_method']);

        $newName=$instructor->photo;

        if ($request->hasFile('photo')){
            if ($instructor->photo != 'uploads/instructors/'.DEFAULT_AVATAR)
                Storage::disk('my_desk')->delete($instructor->photo);

            $newName='uploads/instructors/'.$request->file('photo')->hashName();
            $request->file('photo')->move('uploads/instructors',$newName);
        }

        $validatedData['photo']=$newName;
        $instructor->update($validatedData)?success():fail();

        return redirect()->route('instructor.index');
    }

    public function destroy($id)
    {
        //remove instructor will remove  courses  he explain  it
        $instructor=Instructor::with(['courses'])->findOrFail($id);
        foreach ($instructor->courses as $course){
            Storage::disk('my_desk')->delete($course->photo);
            $courseDirectory = 'course_' . $course->name . '_' . $course->id;
            Storage::disk('my_desk')->deleteDirectory('uploads'.DIRECTORY_SEPARATOR.'materials'.DIRECTORY_SEPARATOR.$courseDirectory);
            $course->delete();
        }


        if ($instructor->photo != 'uploads/instructors/'.DEFAULT_AVATAR)
            Storage::disk('my_desk')->delete($instructor->photo);

        $instructor->delete()?success():fail();
        return redirect()->back();

    }


}
