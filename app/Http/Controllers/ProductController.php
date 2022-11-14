<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    // product List Page
    public function productListPage()
    {
        $products = Product::select('products.*','categories.name as category_name')
                    ->when(request('SearchKey'),function($query){
                        $key = request('SearchKey');
                        $query->where('products.name','like','%'.$key.'%');
                    })
                    ->leftJoin('categories','products.category_id','categories.id')
                    ->orderBy('created_at','desc')
                    ->paginate(5);
        $products->appends(request()->all());
       return view('admin.product.listPage',compact('products'));
    }

    // product Create Page
    public function productCreatePage()
    {
        $categories = Category::select('id','name')->get();
        return view('admin.product.create',compact('categories'));
    }

    // Product Create
    public function productCreate(Request $request)
    {
        $this->productCreateValidation($request);
        $data = $this->productDataStore($request);
        if($request->hasFile('image')){
            $filename = uniqid() . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public',$filename);
            $data['image'] = $filename;
        }
        Product::create($data);
        return redirect()->route('product#listpage');
    }

    // product delete
    public function productDelete($id)
    {
        Product::where('id',$id)->delete();
        return redirect()->route('product#listpage');
    }

    // product edit page
    public function productEditPage($id)
    {
        $product = Product::where('id',$id)->first();
        $categories = Category::get();
        return view('admin.product.edit',compact('product','categories'));
    }

    // product update
    public function productUpdate(Request $request)
    {
       $this->productUpdateValidation($request);
       $data = $this->productDataStore($request);
       if($request->hasFile('image')){
         $oldImageFromDB = Product::where('id',$request->productID)->first();
         $oldImageFromDB = $oldImageFromDB->image;
         if($oldImageFromDB != null){
            Storage::delete('public/'.$oldImageFromDB);
         }
         $filename = uniqid() . $request->file('image')->getClientOriginalName();
         $request->file('image')->storeAs('public',$filename);
         $data['image'] = $filename;
       }
       Product::where('id',$request->productID)->update($data);
       return redirect()->route('product#listpage');
    }

    // Product Data Store
    public function productDataStore($request)
    {
        $data = [
            "category_id" => $request->categoryProduct,
            "name" => $request->name,
            "description" => $request->description,
            "price" => $request->price,
        ];
        return $data;
    }

    // Product Create Validation
    private function productCreateValidation($request)
    {
       $inputValidation = [
            'name' => 'required|min:5',
            'image' => 'required|mimes:jpg,png,jpeg,webp|file',
            'description' => 'required|min:10',
            'price' => 'required',
            'categoryProduct' => 'required',
       ];
       Validator::make($request->all(),$inputValidation)->validate();
    }

    private function productUpdateValidation($request)
    {
        $inputValidation = [
            'name' => 'required|min:5|unique:products,name,'. $request->productID,
            'image' => 'mimes:jpg,png,jpeg,webp|file',
            'description' => 'required|min:10',
            'price' => 'required',
            'categoryProduct' => 'required',
        ];
        Validator::make($request->all(),$inputValidation)->validate();
    }
}
