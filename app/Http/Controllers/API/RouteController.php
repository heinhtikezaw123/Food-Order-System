<?php

namespace App\Http\Controllers\API;

use Carbon\Carbon;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RouteController extends Controller
{
    //get all product lists
    public function productList() {
        $products = Product::get();
        return response()->json($products, 200);
    }

    //get all category lists
    public function categoryList() {
        $category = Category::orderBy('id','desc')->get();
        return response()->json($category, 200);
    }

    //create category
    public function createCategory(Request $request) {
        $data = [
            'name' => $request->name,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        $response = Category::create($data);
        return response()->json($response, 200);
    }

    //get contact lists
    public function contactList() {
        $data = Contact::orderBy('created_at','desc')->get();
        return response()->json($data, 200);
    }

    //create contact
    public function createContact(Request $request) {
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        $response = Contact::create($data);
        return response()->json($response, 200);
    }

    //delete category
    public function deleteCategory($id) {

        $data = Category::where('id',$id)->first();

        if(isset($data)) {
            Category::where('id',$id)->delete();
            return response()->json(['status' => true,'message' => 'successfully deleted'], 200);
        }

        return response()->json(['status' => false,'message' => 'There is no categories'], 200);

    }
}
