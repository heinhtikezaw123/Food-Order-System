<?php

namespace App\Http\Controllers\User;

use Storage;
use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //user home page
    public function home() {
        $pizza = Product::orderBy('created_at','desc')->get();
        $category = Category::get();
        $cart = Cart::where('user_id',Auth::user()->id)->get();
        $history = Order::where('user_id',Auth::user()->id)->get();
        return view('user.main.home',compact('pizza','category','cart','history'));
    }

    //change password page
    public function changePasswordPage() {
        return view('user.password.change');
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
            return redirect()->route('user#changePasswordPage')->with(['passwordChanged' => 'Change Password Successfully!']);
        }
            return back()->with(['notMatch' => 'The Old Password not Match. Try Again!']);
    }

    //user account change page
    public function accountChangePage() {
        return view('user.profile.account');
    }

    //user account change
    public function accountChange($id,Request $request) {
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
        return redirect()->route('user#home')->with(['updateSuccess' => 'User Account Updated...']);
    }

    //filter pizza
    public function filter($categoryId) {
        $pizza = Product::where('category_id',$categoryId)->orderBy('created_at','desc')->get();
        $category = Category::get();
        $cart = Cart::where('user_id',Auth::user()->id)->get();
        $history = Order::where('user_id',Auth::user()->id)->get();
        return view('user.main.home',compact('pizza','category','cart','history'));
    }

    //direct pizza details
    public function pizzaDetails($pizzaId) {
        $pizza = Product::where('id',$pizzaId)->first();
        $pizzaList = Product::get();
        return view('user.main.details',compact('pizza','pizzaList'));
    }

    //cart list
    public function cartList() {
        $cartList = Cart::select('carts.*','products.name as pizza_name','products.price as pizza_price','products.image as product_image')
                        ->leftJoin('products','products.id','carts.product_id')
                        ->where('carts.user_id',Auth::user()->id)
                        ->get();
        $totalPrice = 0;



        foreach($cartList as $c) {
            $totalPrice += $c->pizza_price * $c->qty;
        }
        return view('user.main.cart',compact('cartList','totalPrice'));
    }

    //direct user history page
    public function history () {
        $order = Order::where('user_id',Auth::user()->id)->orderBy('created_at','desc')->paginate(3);
        return view('user.main.history',compact('order'));
    }

    //for admin control user
      //direct user list page
      public function userList() {
        $users = User::where('role','user')->paginate(3);
        return view('admin.user.list',compact('users'));
    }

    //change user role
    public function changeUserRole(Request $request){
        $changeRole = [
            'role' => $request->role
        ];

        User::where('id',$request->userId)->update($changeRole);
    }

    //direct contact us page
    public function userContact(){
        return view('user.contact.contact');
    }

    //create user contact
    public function createUserContact(Request $request){
        $this->userContactValidationCheck($request);
        $userInfo = $this->getUserContactInfo($request);

        Contact::create($userInfo);
        return redirect()->route('user#home');
    }


    //password validation check
    private function passwordValidationCheck($request) {
        Validator::make($request->all(),[
            'oldPassword' => 'required|min:6|',
            'newPassword' => 'required|min:6|',
            'confirmNewPassword' => 'required|min:6|same:newPassword',
        ])->validate();
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

    //user contact validation check
    private function userContactValidationCheck($request){

        Validator::make($request->all(),[
            'contactName' => 'required',
            'contactEmail' => 'required',
            'contactMessage' => 'required',
        ])->validate();
    }

    //insert user contact data
    private function getUserContactInfo($request){
        return [
            'name' => $request->contactName,
            'email' => $request->contactEmail,
            'message' => $request->contactMessage,
        ];

    }
}
