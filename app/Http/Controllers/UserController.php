<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function index(){
        return view('user.index');
    }

    public function getData(Request $request){
        if ($request->id) {
            $data = User::find($request->id);
        }else{
            $data = User::get();
            foreach ($data as $index => $item) {
                $item->no = $index+1;
            }
        }
        return response()->json($data);
    }

    public function createData(Request $request){
        $validate = $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|min:6|max:255',
            'level'=>'required',
        ]);

        $data = new User();
        $data->name = $validate['name'];
        $data->email = $validate['email'];
        $password = Hash::make($validate['password']);
        $data->password = $password;
        $data->level = $request->level;
        $data->save();

        return $this->result('Data berhasil di create!', $data, true);


    }

    public function updateData(Request $request,$id){
        $validate = $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:users,id',
            'password'=>'required|min:6|max:255',
            'level'=>'required',
        ]);

        $data = User::find($id);
        $data->name = $validate['name'];
        $data->email = $validate['email'];
        $password = Hash::make($validate['password']);
        $data->password = $password;
        $data->level = $request->level;
        $data->save();

        return $this->result('Data berhasil di update!', $data, true);


    }

    public function deleteData($id){

        $data = User::find($id);
        $data->delete();

        return $this->result('Data berhasil di delete!', $data, true);

    }


    // public function create(){
    //     return view('user.create',['page'=>'user']);
    // }

    // public function store(Request $request){
    //     $data = User::where('email',$request->email)->first();
    //     if($data){
    //         session()->flash('message',"Email $request->email sudah digunakan, Please try again!!");
    //         return redirect('/user/create');
    //     }

    //     $data = new User();
    //     $data->name = $request->name;
    //     $data->email = $request->email;
    //     $password = Hash::make($request->password);
    //     $data->password = $password;
    //     $data->save();

    //     session()->flash('message','Data berhasil di tambahkan!!');
    //     return redirect('/user');
    // }


}
