<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{

    // Admin Home Direct
    public function adminHome()
    {
        return view('admin.home.index');
    }

    // Admin Home Direct
    public function adminProfile()
    {
        $admins = User::where('role','admin')->paginate(5);
        // dd($admins[0]['role']);
        return view('admin.profile.listPage',compact('admins'));
    }

    // Admin edit
    public function adminProfileEdit($id)
    {
        $admin = User::where('id',$id)->first();
        return view('admin.profile.edit',compact('admin'));
    }

    // Admin Update
    public function adminProfileUpdate($id,Request $request)
    {
        $this->profileValidation($request);
        $data = $this->storeData($request);
        if($request->hasFile('image')){
            $oldImageDb = User::where('id',$id)->first();
            $oldImageDb = $oldImageDb->image;
            if($oldImageDb != null){
                Storage::delete('public/'.$oldImageDb);
            }
            $filename = uniqid() . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public',$filename);
            $data['image'] = $filename;
        }
        User::where('id',$id)->update($data);
        return redirect()->route('admin#profile');
    }

    // Change Password Page Direct
    public function adminChangePasswordPage()
    {
        return view('admin.profile.changepassword');
    }

    // Change Password
    public function adminChangePassword(Request $request)
    {
        $this->passwordValidation($request);
        $currentUser = Auth::user()->id;
        $dbPassword = User::select('password')->where('id',$currentUser)->first();
        $dbHashPassword = $dbPassword->password;
        if (Hash::check($request->oldPassword,$dbHashPassword)) {
            $data = [
                'password' => Hash::make($request->newPassword),
            ];
            User::where('id',$currentUser)->update($data);
            return back()->with(['changeSuccess' => 'စကားဝှက်ကို အောင်မြင်စွာ ပြောင်းလဲခဲ့သည်။']);
        }
        return back()->with(['notMatch' => 'Old password does not match  with db password']);
    }

    // User List Page
    public function userListPage()
    {
        $userLists = User::where('role','user')->paginate(5);
        return view('admin.user.listPage',compact('userLists'));
    }

    // ajax change role for user list page
    public function ajaxChangeRole(Request $request)
    {
       User::where('id',$request->userId)->update([
          'role' => $request->role
       ]);
    }

    // ajax change role for admin
    public function ajaxAdminChangeRole(Request $request)
    {
        User::where('id',$request->adminId)->update([
            'role' => $request->role
        ]);
    }

    // feedback list
    public function feedback()
    {
        $userContacts = Contact::paginate(5);
        return view('admin.feedback.feedbacklist',compact('userContacts'));
    }

    // feedback 
    public function feedbackDetail($id)
    {
        $data = Contact::where('id',$id)->first();
        return view('admin.feedback.feedbackdetail',compact('data'));
    }

    // order List Billing
    public function orderListBilling()
    {
        $orders = Order::select('orders.*','users.name as user_name')
                ->leftJoin('users','users.id','orders.user_id')
                ->get();
        return view('admin.billing.orderList',compact('orders'));
    }

    // Profile Data Store
    private function storeData($request)
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
    private function profileValidation($request)
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

    // Change Password Validation
    private function passwordValidation($request)
    {
        $inputValidation = [
            'oldPassword' => 'required|min:6|max:10',
            'newPassword' =>  'required|min:6|max:10',
            'confirmPassword' => 'required|min:6|max:10|same:newPassword',
        ];
        Validator::make($request->all(),$inputValidation)->validate();
    }


}
