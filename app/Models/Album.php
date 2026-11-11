<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Image;

class Album extends Model
{
    public function Photos(){
        return $this->hasMany('App\Models\AlbumImagesDetail', 'albumId', 'id')->orderBy("sortIndex","asc");
    }

 }
