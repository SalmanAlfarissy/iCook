<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Recipe extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "recipe";
    protected $id = "id";

    public function category(){
        $data = $this->belongsTo(Category::class,'category_id');
        return $data;
    }
}
