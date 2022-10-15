<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
        return view('category.index');
    }

    public function getData(Request $request){
        if ($request->id) {
            $data = Category::find($request->id);
        }else{
            $data = Category::get();
            foreach ($data as $index => $item) {
                $item->no = $index+1;
            }
        }
        return response()->json($data);
    }

    public function createData(Request $request){
        $validate = $request->validate([
            'name'=>'required|unique:Category,name',
            'description'=>'',
        ]);

        $data = new Category();
        $data->name = $validate['name'];
        $data->description = $validate['description'];
        $data->save();

        return $this->result('Data berhasil di create!', $data, true);


    }

    public function updateData(Request $request,$id){
        $validate = $request->validate([
            'name'=>'required|unique:Category,name',
            'description'=>'',
        ]);

        $data = Category::find($id);
        $data->name = $validate['name'];
        $data->description = $validate['description'];
        $data->save();

        return $this->result('Data berhasil di update!', $data, true);


    }

    public function deleteData($id){

        $data = Category::find($id);
        $data->delete();

        return $this->result('Data berhasil di delete!', $data, true);

    }



    // public function create(){
    //     return view('category.create',['page'=>'category']);

    // }

    // public function store(Request $request){
    //     $data = Category::where('name',$request->name)->first();
    //     if($data){
    //         session()->flash('message',"Nama $request->name sudah digunakan, Please try again!!");
    //         return redirect('/category/create');
    //     }

    //     $data = new Category();
    //     $data->name = $request->name;
    //     $data->description = $request->description;
    //     $data->save();
    //     session()->flash('message','Data berhasil ditambahkan!!');
    //     return redirect('/category');
    // }
}
