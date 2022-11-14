<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    // User Home Direct
    public function userHome()
    {
        $products = Product::get();
        $categories = Category::get();
        $carts = Cart::where('user_id',Auth::user()->id)->get();
        return view('user.home.homePage',compact('products','categories','carts'));
    }

    // Filter
    public function filterProduct($id)
    {
        $products = Product::where('category_id',$id)->get();
        $categories = Category::get();
        $carts = Cart::where('user_id',Auth::user()->id)->get();
        return view('user.home.homePage',compact('products','categories','carts'));
    }

    // cart List
    public function cartList()
    {
        $cartLists = Cart::select('carts.*','products.name as product_name','products.price as product_price','products.image as product_image')
                        ->leftJoin('products','products.id','carts.product_id')
                        ->where('carts.user_id',Auth::user()->id)->get();
        $totalPrice = 0;
        foreach ($cartLists as $key) {
            $totalPrice += $key->product_price * $key->qty;
        };
        return view('user.cart.cartList',compact('cartLists','totalPrice'));
    }

    // product detail
    public function productdetail($id)
    {
        $product = Product::where('id',$id)->first();
        return view('user.cart.productDetail',compact('product'));
    }

    // User Profile Direct
    public function userProfile()
    {
        return view('user.profile.index');
    }

    // Password change for user
    public function userPasswordChange(Request $request)
    {
        $this->passwordValidation($request);
        $currentUser = Auth::user()->id;
        $dbPassword = User::select('password')->where('id',$currentUser)->first();
        $dbPassword = $dbPassword->password;
        if(Hash::check($request->oldPassword, $dbPassword)){
            $data = [
                'password' => Hash::make($request->newPassword),
            ];
            User::where('id',$request->id)->update($data);
            return back();
        }
        return back()->with(['notMatch' => 'Old password does not match  with db password']);
    }

    // edit profile
    public function userProfileEdit($id)
    {
        $users = User::where('id',$id)->first();
        return view('user.profile.edit',compact('users'));
    }

    //  Profile Update
    public function userProfileUpdate($id,Request $request)
    {
        $this->userProfileValidation($request);
        $data = $this->userProfileData($request);
        if($request->hasFile('image')){
            $oldImage = User::where('id',$id)->first();
            $oldImage = $oldImage->image;
            if($oldImage != null){
                Storage::delete('public/'.$oldImage);
            }
            $filename = uniqid() . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public',$filename);
            $data['image'] = $filename;
        }
        User::where('id',$id)->update($data);
        return redirect()->route('user#profile');
    }


    // Profile Data Store
    private function userProfileData($request)
    {
        return [
            'name' => $request->name,
            'email' => $request->email,
            'gender' => $request->gender,
            'phone' => $request->phone,
            'address' => $request->address
        ];
    }

    // Profile Validation
    private function userProfileValidation($request)
    {
        $inputValidation = [
            'name' => 'required',
            'email' => 'required',
            'gender' => 'required',
            'phone' => 'required',
            'image' => 'mimes:png,jpg,jpeg,webp|file',
            'address' => 'required',
        ];
        Validator::make($request->all(),$inputValidation)->validate();
    }

    // password validation
    public function passwordValidation($request)
    {
        $message = [
            'oldPassword' => 'required|min:6|max:10',
            'newPassword' =>  'required|min:6|max:10',
            'confirmPassword' => 'required|min:6|max:10|same:newPassword',
        ];
        Validator::make($request->all(),$message)->validate();
    }

}
