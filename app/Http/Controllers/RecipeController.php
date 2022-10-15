<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Recipe;
use Illuminate\Http\Request;

use function PHPUnit\Framework\fileExists;

class RecipeController extends Controller
{
    public function index(){
        $data = Category::get();
        return view('recipe.index', compact('data'));
    }

    public function getData(Request $request){
        if ($request->id) {
            $data = Recipe::find($request->id);
        }else{
            $data = Recipe::with('category')->get();
            foreach ($data as $index => $item) {
                $item->no = $index+1;
            }
        }
        return response()->json($data);
    }

    public function createData(Request $request){
        $validate = $request->validate([
            'title'=>'required',
            'category_id'=>'required',
            'content'=>'required',
        ]);

        $data = new Recipe();
        $data->title = $validate['title'];
        $data->category_id = $validate['category_id'];
        $data->content = $validate['content'];

        // if (empty($validate['gambar'])){
        //     $data->gambar = '';
        // }else {
        //     $file_name = time().rand().'.'.$validate['gambar']->getClientOriginalExtension();
        //     $validate['gambar']->move(public_path().'/image/content',$file_name);
        //     $data->gambar = $file_name;
        // }

        $data->save();

        return $this->result('Data berhasil di create!', $data, true);


    }

    public function updateData(Request $request,$id){
        $validate = $request->validate([
            'title'=>'required',
            'category_id'=>'required',
            'content'=>'required',
        ]);

        $data = Recipe::find($id);
        $data->title = $validate['title'];
        $data->category_id = $validate['category_id'];
        $data->content = $validate['content'];

        // if (empty($validate['gambar'])){
        //     $data->gambar = '';
        //     $file = public_path('/image/content/').$data->gambar;
        //     if(fileExists($file)){
        //         @unlink($file);
        //     }

        // }else {
        //     if(empty($data->gambar)){
        //         $file_name = time().rand().'.'.$validate['gambar']->getClientOriginalExtension();
        //         $validate['gambar']->move(public_path().'/image/content',$file_name);
        //         $data->gambar = $file_name;
        //     }else {
        //         $file_name = $data->gambar;
        //         $validate['gambar']->move(public_path().'/image/content',$file_name);
        //         $data->gambar = $file_name;
        //     }
        // }

        $data->save();

        return $this->result('Data berhasil di update!', $data, true);

    }

    public function deleteData($id){

        $data = Recipe::find($id);
        // $file = public_path('/image/content').$data->gambar;
        // if (file_exists($file)){
        //     @unlink($file);
        // }
        $data->delete();

        return $this->result('Data berhasil di hapus!', $data, true);
    }

    public function trash(){
        return view('recipe.trash');
    }

    public function getDataTrash(){

        $data = Recipe::with('category')->onlyTrashed()->get();
        foreach ($data as $index=>$item) {
            $item->no = $index+1;
        }

        return response()->json(['data'=>$data]);
    }

    public function restoreData($id){

        $data = Recipe::where('id',$id)->onlyTrashed()->restore();
        if(!$data){
            return $this->result('Data sudah di restore!');
        }
        return $this->result('Data berhasil di restore!', $data, true);


    }

    public function deleteTrash($id){

        $data = Recipe::where('id',$id)->forceDelete();
        if(!$data){
            return $this->result('Data sudah terhapus sebelumnya!!');
        }
        return $this->result('Data sukses dihapus!!', $data, true);

    }
}
