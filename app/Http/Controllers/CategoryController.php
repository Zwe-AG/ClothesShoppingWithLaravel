<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Category List Page
    public function categoryListPage()
    {
        $categories = Category::orderBy('created_at','desc')->paginate(5);
        return view('admin.category.listPage',compact('categories'));
    }

    // Category Create Page
    public function categoryCreatePage()
    {
        return view('admin.category.create');
    }

    // Category Create
    public function categoryCreate(Request $request)
    {
        $data = [
            'name' => $request->name,
        ];
        Category::create($data);
        return redirect()->route('category#listpage');
    }

     // Category Delete
     public function categoryDelete($id)
     {
         Category::where('id',$id)->delete();
         return redirect()->route('category#listpage');
     }
}
