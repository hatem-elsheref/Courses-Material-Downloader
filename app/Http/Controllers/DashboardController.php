<?php

namespace App\Http\Controllers;
use App\Category;
use App\Contact;
use App\Course;
use App\Instructor;
use App\Material;
use App\User;

class DashboardController extends Controller
{

    public function index()
    {
        $data['admins']=User::where('role',ADMIN)->count();
        $data['users']=User::where('role',USER)->count();
        $data['instructors']=Instructor::count();
        $data['categories']=Category::count();
        $data['courses']=Course::count();
        $data['materials']=Material::count();
        return view('dashboard.index',$data);
    }

    public function contacts(){
        $contacts=Contact::whereIn('status',['read','unread'])->orderByDesc('created_at')->paginate(PAGINATION);
        return view('dashboard.contacts',compact('contacts'));
    }

    public function destroyContact($id){
        $contact=Contact::findOrFail($id);
        $contact->delete()?success():fail();
        return redirect()->route('contacts.show');
    }

    public function updateContact($id){
        $contact=Contact::findOrFail($id);
        if ($contact->status =='read')
            $contact->status='unread';
        else
            $contact->status='read';
        $contact->save()?success():fail();
        return redirect()->route('contacts.show');
    }
}
