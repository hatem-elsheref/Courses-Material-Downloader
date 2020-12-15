<?php

namespace App\Http\Controllers;

use App\Rules\Email;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function indexAdmins(Request $request){
        if (auth()->user()->role != MANAGER){
            fail("You Dont Have Access To See This Content !!");
            return redirect()->route('dashboard');
        }
        $users=$this->getUserInfo(ADMIN,$request);
        return view('dashboard.users.user',compact('users'))->with('type',ADMIN);
    }

    public function indexUsers(Request $request){
        $users=$this->getUserInfo(USER,$request);
        return view('dashboard.users.user',compact('users'))->with('type',USER);
    }

    private function getUserInfo($role,Request $request){
        return User::where('role',$role)->where(function ($query) use($request){
            $query->when($request->search,function ($q) use ($request){
                $q->where('name','like','%'.$request->search.'%')
                    ->orWhere('email','like','%'.$request->search.'%');
            });
        })->orderByDesc('id')->paginate(PAGINATION);
    }

    public function updateRole($id){
        $user=User::findOrFail($id);
        $user->role=($user->role == ADMIN)?USER:ADMIN;
        $user->save();
        success();
        return redirect()->back();
    }

    public function showProfile(){
        $user=auth()->user();
        return view('front.profile',compact('user'));
    }

    public function updateProfile(Request $request){
        $user=auth()->user();
       $password=null;
        if ($request->has('password') and !empty($request->password)){
            $password=true;
            $request->validate([
                'name'          =>['required','string','max:191'],
                'email'         =>['required','email','max:191',new Email(),Rule::unique('users','email')->ignore($user->id)],
                'password'      => ['required', 'string', 'min:8', 'confirmed'],
                'old_password'  => ['required', 'string', 'min:8'],
            ]);
        }else{
            $password=false;
            $request->validate([
                'name'      =>['required','string','max:191'],
                'email'     =>['required','email','max:191',new Email(),Rule::unique('users','email')->ignore($user->id)],
            ]);
        }

        $user->name=$request->name;
        $user->email=$request->email;
        if ($password){
            if (Hash::check($request->old_password,$user->password)){
                $user->password=Hash::make($request->password);
            }else{
                return redirect()->back()->withInput()->withErrors(['old_password'=>'Invalid Old Password']);
            }

        }
        $user->save();
        auth()->loginUsingId($user->id);
        return redirect()->back()->with('response',['type'=>'success','message'=>'Account Updated Successfully']);
    }
}
