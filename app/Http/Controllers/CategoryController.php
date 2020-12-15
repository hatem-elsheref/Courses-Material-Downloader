<?php

namespace App\Http\Controllers;

use App\Category;
use App\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    public function index(){
        $categories=Category::with('courses')->orderByDesc('id')->get();
        return view('dashboard.categories.index',compact('categories'));
    }

    public function show($id){
        $category=Category::findOrFail($id);
        $courses=Course::with(['instructor','category','materials'])->where('category_id',$category->id)->orderByDesc('id')->paginate(PAGINATION);
        return view('dashboard.courses.index',compact('courses'))->with('title','All Courses Of '.$category->name . ' Category');
    }

    public function create(){
        return view('dashboard.categories.create');
    }

    public function store(Request $request){
        $request->validate([
            'name'  =>'required|string|max:191|unique:categories,name',
        ]);
        $validatedData=$request->except(['_token']);
        $validatedData['slug']=Str::slug($request->name).rand(1,1000);
        $category=Category::create($validatedData);
        $category? success():fail();
        return redirect()->route('category.index');

    }

    public function edit($cat){
        $category=Category::findOrFail($cat);
        return view('dashboard.categories.edit',compact('category'));
    }

    public function update(Request $request,$cat){
        $category=Category::findOrFail($cat);
        $request->validate([
            'name'=>['required','string','max:191',Rule::unique('categories','name')->ignore($category->id)],
        ]);
        $validatedData=$request->except(['_token','_method']);
        $validatedData['slug']=Str::slug($request->name).rand(1,1000);
        $category->update($validatedData) ? success() : fail();
        return redirect()->route('category.index');
    }

    public function destroy($id){
        $category=Category::findOrFail($id);

        foreach ($category->courses as $course){
            Storage::disk('my_desk')->delete($course->photo);
            $courseDirectory = 'course_' . $course->name . '_' . $course->id;
            Storage::disk('my_desk')->deleteDirectory('uploads'.DIRECTORY_SEPARATOR.'materials'.DIRECTORY_SEPARATOR.$courseDirectory);
            $course->delete();
        }

        $category->delete()?success():fail();
        return redirect()->route('category.index');
    }
}
