<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    //direct change password page
    public function changePasswordPage() {
        return view('admin.account.changePassword');
    }

    // change password
    public function changePassword(Request $request) {
        $this->passwordValidationCheck($request);
        $user = User::select('password')->where('id',Auth::user()->id)->first();
        $dbPassword = $user->password;// hash value

        // $clientPassword = Hash::make('admin123');
        if(Hash::check($request->oldPassword, $dbPassword)) {
            $data = [
                'password' => Hash::make($request->newPassword)
            ];
            User::where('id',Auth::user()->id)->update($data);
            return redirect()->route('category#list')->with(['passwordChanged' => 'Change Password Successfully!']);
        }
            return back()->with(['notMatch' => 'The Old Password not Match. Try Again!']);
    }

    //direct profile details page
    public function details() {
        return view('admin.account.details');
    }

    //edit admin profile
    public function edit() {
        return view('admin.account.edit');
    }

    //update admin profile
    public function update($id,Request $request) {
        $this->accountValidationCheck($request);
        $data = $this->getUserData($request);

        //for image
        if($request->hasFile('image')) {
            //getting image from data base
            $dbImage = User::where('id',$id)->first();
            $dbImage = $dbImage->image;

            //delecting image if there is an image in database
            if($dbImage != null) {
                Storage::delete('public/'.$dbImage);
            }

            //storing image
            $fileName = uniqid() . $request->file('image')->getClientOriginalName(); //getting image from user
            $request->file('image')->storeAs('public',$fileName); //storing image in project
            $data['image'] = $fileName; //storing image in database

        }

        User::where('id',$id)->update($data);
        return redirect()->route('admin#details')->with(['updateSuccess' => 'Admin Account Updated...']);
    }

    //admin list
    public function list() {
        $admin = User::when(request('key'),function($query) {
                    $query->orWhere('name','like','%'.request('key').'%')
                          ->orWhere('email','like','%'.request('key').'%')
                          ->orWhere('gender','like','%'.request('key').'%')
                          ->orWhere('phone','like','%'.request('key').'%')
                          ->orWhere('address','like','%'.request('key').'%');
                })
                ->where('role','admin')
                ->paginate(3);
        $admin->appends(request()->all());
        return view('admin.account.list',compact('admin'));
    }

    //admin delete
    public function delete($id) {
        User::where('id',$id)->delete();
        return back()->with(['deleteSuccess' => 'Admin account deleted successfully!']);
    }

    //change role
    public function changeRole($id) {
        $account = User::where('id',$id)->first();
        return view('admin.account.changeRole',compact('account'));
    }

    //change role
    public function change($id,Request $request) {
        $data = $this->requestDataToChangeRole($request);
        User::where('id',$id)->update($data);
        return redirect()->route('admin#list');
    }

    //direct user contact lists page
    public function userContactListPage() {
        $userContacts = Contact::get();
        return view('admin.contact.contact',compact('userContacts'));
    }

    //request user data to change role
    private function requestDataToChangeRole($request) {
        return [
            'role' => $request->role
        ];
    }

    //delete user contact
    public function userContactDelete($id) {
        Contact::where('id',$id)->delete();
        return back();
    }

    //update validation check
    private function accountValidationCheck($request) {
        Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required',
            'gender' => 'required',
            'phone' => 'required',
            'image' => 'mimes:png,jpg,jpeg,webp|file',
            'address' => 'required',
        ])->validate();
    }

    //get user data for update
    private function getUserData($request) {
        return [
            'name' => $request->name,
            'email' => $request->email,
            'gender' => $request->gender,
            'phone' => $request->phone,
            'address' => $request->address,
        ];
    }

    //password validation check
    private function passwordValidationCheck($request) {
        Validator::make($request->all(),[
            'oldPassword' => 'required|min:6|',
            'newPassword' => 'required|min:6|',
            'confirmNewPassword' => 'required|min:6|same:newPassword',
        ])->validate();
    }
}
