<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Models\Category;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function __construct(){
        $this->category = Category::get();
    }

    public function index(Request $request){
        if($request->category_id){
            $data = Recipe::where('category_id',$request->category_id)->get();
        }else{
            $data = Recipe::get();
        }
        return view('landingpage',[
            'data'=>$data,
            'category'=>$this->category
        ]);
    }

    public function detailrecipe($id){
        $data = Recipe::with('category')->find($id);
        return view('detailrecipe',[
            'data'=>$data,
            'category'=>$this->category,
        ]);
    }



}
