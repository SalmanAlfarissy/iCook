<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Models\Category;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function index(){
        $category = Category::get();

        $data = Recipe::get();
        return view('landingpage',[
            'data'=>$data,
            'category'=>$category
        ]);
    }

    public function withCategory($id){
        $category = Category::get();
        $data = Recipe::where('category_id',$id)->get();
        return view('landingpage',[
            'data'=>$data,
            'category'=>$category
        ]);
    }
}
