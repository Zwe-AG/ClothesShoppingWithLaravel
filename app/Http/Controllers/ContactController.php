<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    // contact page
    public function contact()
    {
        return view('user.contact.usercontact');
    }

    // contact create 
    public function contactCreate(Request $request)
    {
        $this->contactValidation($request);
        $data = $this->contactData($request);
        Contact::create($data);
        return redirect()->route('user#home');
    }

    // contact validation 
    public function contactData($request)
    {
        $response = [
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message
        ];
        return $response;
    }

     // contact validation 
     public function contactValidation($request)
     {
         $response = [
             'name' => 'required',
             'email' => 'required',
             'message' => 'required'
         ];
         Validator::make($request->all(),$response)->validate();
     }

}
