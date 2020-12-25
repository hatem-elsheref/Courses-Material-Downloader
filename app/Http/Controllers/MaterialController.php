<?php

namespace App\Http\Controllers;

use App\Course;
use App\Material;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;


class MaterialController extends Controller
{
    public function create($courseId){
        $course=Course::findOrFail($courseId);
        $types=Material::types();
        $sources=Material::sources();
        return view('dashboard.materials.create',['course'=>$course,'types'=>$types,'sources'=>$sources]);
    }

    public function store(Request $request)
    {
        $years = range(1995, date('Y'));
        $parts = range(1, 100);
        $types = Material::types();
        $sources = Material::sources();
        $request->validate([
            'course_id' => ['required', 'numeric', Rule::exists('courses', 'id')],
            'title' => 'required|string|max:191',
            'year' => ['required', 'numeric', Rule::in($years)],
            'type' => ['required', 'string', Rule::in($types)],
            'part' => ['required', 'numeric', Rule::in($parts)],
            'source' => ['required', 'string', Rule::in($sources)],
            'material_upload' => ['nullable', Rule::requiredIf($request->source == 'Uploading')],
            'material_external_host' => ['nullable', Rule::requiredIf($request->source == 'External_Host'), 'url', 'min:10'],
            'material_youtube' => ['nullable', Rule::requiredIf($request->source == 'Youtube'), 'string', 'min:8']
        ]);
        $course = Course::findOrFail($request->course_id);
        $validatedData = $request->except(['token', 'material_upload', 'material_external_host', 'material_youtube']);
        $File_Extension='mp4';
        switch ($request->type) {
            case 'video':
                if ($request->source == 'Youtube') {
                    $validatedData['path'] = $request->material_youtube;
                } elseif ($request->source == 'External_Host') {
                    $validatedData['path'] = $request->material_external_host;
                } else {
                    $message = 'Can\'t Upload Videos !! ';
                    fail($message);
                    return redirect()->back()->withErrors(['file' => $message])->withInput();
                }
                break;
            case 'audio':
                if ($request->source == 'External_Host') {
                    $validatedData['path'] = $request->material_external_host;
                } else {
                    $message = 'Can\'t Upload Audios !! ';
                    fail($message);
                    return redirect()->back()->withErrors(['file' => $message])->withInput();
                }
                break;
            default:
                if ($request->source == 'Uploading') {
                    $validatedData['mimeType'] = $request->file('material_upload')->getMimeType();
                    $validatedData['fileSize'] = $request->file('material_upload')->getSize();
                    $courseDirectory = 'course_' . $course->name . '_' . $course->id;
                    $path = public_path('uploads') . DIRECTORY_SEPARATOR . 'materials' . DIRECTORY_SEPARATOR . $courseDirectory;
                    if (!Storage::exists($path)) {
                        Storage::makeDirectory($path);
                    }
                    $fileName = $course->name . '-' . $request->type . '-' . time() . rand(1, 1000);
                    $fileExtension = $request->file('material_upload')->getClientOriginalExtension();
                    $request->file('material_upload')->move($path, $fileName . '.' . $fileExtension);
                    $validatedData['path'] = 'uploads/materials/' . $courseDirectory . '/' . $fileName . '.' . $fileExtension;
                    $File_Extension=$fileExtension;
                } elseif ($request->source == 'External_Host') {
                    $validatedData['path'] = $request->material_external_host;
                    $File_Extension=explode('.',$request->material_external_host);
                    $File_Extension=end($File_Extension);
                } else {
                    $message = 'Invalid Source !! ';
                    fail($message);
                    return redirect()->back()->withErrors(['file' => $message])->withInput();
                }
                break;
        }
        $validatedData['download_name'] = Str::slug($request->title . '-' . $request->year . '-' . $request->type, '-');
        $validatedData['download_name'].='.'.$File_Extension;
        $material = Material::create($validatedData);
        $material ? success() : fail();
        return redirect()->route('course.show',$course->id);
    }

    public function edit($id){
        $material=Material::findOrFail($id);
        $types=Material::types();
        $sources=Material::sources();
        return view('dashboard.materials.edit',['material'=>$material,'types'=>$types,'sources'=>$sources]);
    }

    public function update(Request $request,$id){
        $material=Material::findOrFail($id);
        $course=$material->course;
        $years = range(1995, date('Y'));
        $parts = range(1, 100);
        $types = Material::types();
        $sources = Material::sources();
        $File_Extension=null;
        $request->validate([
            'course_id' => ['required', 'numeric', Rule::exists('courses', 'id')],
            'title' => 'required|string|max:191',
            'year' => ['required', 'numeric', Rule::in($years)],
            'type' => ['required', 'string', Rule::in($types)],
            'part' => ['required', 'numeric', Rule::in($parts)],
            'source' => ['required', 'string', Rule::in($sources)],
            'material_upload' => ['nullable'],
            'material_external_host' => ['nullable', Rule::requiredIf($request->source == 'External_Host'), 'url', 'min:10'],
            'material_youtube' => ['nullable', Rule::requiredIf($request->source == 'Youtube'), 'string', 'min:8']
        ]);
        $validatedData = $request->except(['token', '_method','material_upload', 'material_external_host', 'material_youtube']);
        switch ($request->type) {
            case 'video':
                $validatedData['mimeType'] = null;
                $validatedData['fileSize'] = null;
                if ($request->source == 'Youtube') {
                    $validatedData['path'] = $request->material_youtube;
                } elseif ($request->source == 'External_Host') {
                    $validatedData['path'] = $request->material_external_host;
                } else {
                    $message = 'Can\'t Upload Videos !! ';
                    fail($message);
                    return redirect()->back()->withErrors(['file' => $message])->withInput();
                }
                break;
            case 'audio':
                $validatedData['mimeType'] = null;
                $validatedData['fileSize'] = null;
                if ($request->source == 'External_Host') {
                    $validatedData['path'] = $request->material_external_host;
                } else {
                    $message = 'Can\'t Upload Audios !! ';
                    fail($message);
                    return redirect()->back()->withErrors(['file' => $message])->withInput();
                }
                break;
            default:
                if ($request->source == 'Uploading') {

                    if ($request->hasFile('material_upload')){
                        $validatedData['mimeType'] = $request->file('material_upload')->getMimeType();
                        $validatedData['fileSize'] = $request->file('material_upload')->getSize();
                        $courseDirectory = 'course_' . $course->name . '_' . $course->id;
                        $path = public_path('uploads') . DIRECTORY_SEPARATOR . 'materials' . DIRECTORY_SEPARATOR . $courseDirectory;
                        if (!Storage::exists($path)) {
                            Storage::makeDirectory($path);
                        }
                        $fileName = $course->name . '-' . $request->type . '-' . time() . rand(1, 1000);
                        $fileExtension = $request->file('material_upload')->getClientOriginalExtension();
                        $request->file('material_upload')->move($path, $fileName . '.' . $fileExtension);
                        $validatedData['path'] = 'uploads/materials/' . $courseDirectory . '/' . $fileName . '.' . $fileExtension;
                        $File_Extension=$fileExtension;
                        if ($material->source == 'Uploading'){
                            Storage::disk('my_desk')->delete($material->path);
                        }
                    }else{
                        $validatedData['path']=$material->path;
                        $File_Extension=explode('.',$request->material_external_host);
                        $File_Extension=end($File_Extension);
                    }
                } elseif ($request->source == 'External_Host') {
                    $validatedData['path'] = $request->material_external_host;
                } else {
                    $message = 'Invalid Source !! ';
                    fail($message);
                    return redirect()->back()->withErrors(['file' => $message])->withInput();
                }
                break;
        }

        $validatedData['download_name'] = Str::slug($request->title . '-' . $request->year . '-' . $request->type, '-');
        $validatedData['download_name'].='.'.$File_Extension;
        $material->update($validatedData) ? success() : fail();
        return redirect()->route('course.show',$course->id);
    }

    public function destroy($id){
        $material=Material::findOrFail($id);
        if ($material->source == 'Uploading')
            Storage::disk('my_desk')->delete($material->path);
        $material->delete()?success():fail();
        return redirect()->back();
    }
}
