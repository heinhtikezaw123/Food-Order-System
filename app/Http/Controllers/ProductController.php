<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Storage;

class ProductController extends Controller
{
    //products list
    public function list() {
        $pizzas = Product::select('products.*','categories.name as category_name')->when(request('key'),function($query) {
                    $query->where('products.name','like','%'.request('key').'%');
                    })
                    ->leftJoin('categories','products.category_id','categories.id')
                    ->orderBy('products.created_at','desc')
                    ->paginate(5);
        $pizzas->appends(request()->all());
        return view('admin.products.pizzaList',compact('pizzas'));
    }

    //direct pizza create Page
    public function createPage() {
        $categories = Category::select('id','name')->get();
        return view('admin.products.create',compact('categories'));
    }

    //create pizza
    public function create(Request $request) {
        $this->productValidationCheck($request,'create');
        $data = $this->requestProductInfo($request);

        //storing image separately
        $fileName = uniqid(). $request->file('pizzaImage')->getClientOriginalName();
        $request->file('pizzaImage')->storeAs('public',$fileName);
        $data['image'] = $fileName;

        Product::create($data);
        return redirect()->route('product#list');
    }

    //delete pizza
    public function delete($id) {
        Product::where('id',$id)->delete();
        return redirect()->route('product#list')->with(['DeleteSuccess' => 'Deleted Product Successfully!']);
    }

    //view pizza details
    public function details($id) {
        $pizza = Product::select('products.*','categories.name as category_name')
                ->leftJoin('categories','products.category_id','categories.id')
                ->where('products.id',$id)->first();
        return view('admin.products.details',compact('pizza'));
    }

    //edit pizza
    public function edit($id) {
        $pizza = Product::where('id',$id)->first();
        $category = Category::get();
        return view('admin.products.edit',compact('pizza','category'));
    }

    //update pizza
    public function update(Request $request) {
        $this->productValidationCheck($request,'update');
        $data = $this->requestProductInfo($request);

        if($request->hasFile('pizzaImage')) {
            $oldImageName = Product::where('id',$request->pizzaId)->first();
            $oldImageName = $oldImageName->image;
            Storage::delete('public/'.$oldImageName);

            $fileName = uniqid().$request->file('pizzaImage')->getClientOriginalName();
            $request->file('pizzaImage')->storeAs('public',$fileName);
            $data['image'] = $fileName;

        }

        Product::where('id',$request->pizzaId)->update($data);
        return redirect()->route('product#list');
    }

    //request product Info
    private function requestProductInfo($request){
        return [
            'category_id' => $request->pizzaCategory,
            'name' => $request->pizzaName,
            'description' => $request->pizzaDescription,
            'price' => $request->pizzaPrice,
            'waiting_time' => $request->pizzaWaitingTime,
        ];
    }

    //product validation check
    private function productValidationCheck($request,$action) {
        $validatationRules = [
            'pizzaName' => 'required|unique:products,name,'.$request->pizzaId,
            'pizzaCategory' => 'required',
            'pizzaDescription' => 'required|min:10',
            'pizzaWaitingTime' => 'required',
            'pizzaPrice' => 'required',
        ];

        $validatationRules['pizzaImage'] = $action == 'create' ? 'required|mimes:jpg,jpeg,png,webp|file' : 'mimes:jpg,jpeg,png,webp|file' ;

        Validator::make($request->all(),$validatationRules)->validate();
    }
}
