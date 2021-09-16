<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;
    protected $fillable = ['id','name','parent_id','slug'];

    public function getCategoryItem(){
        return $this->hasMany(Category::class,'parent_id');
    }

}

