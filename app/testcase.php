<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class testcase extends Model
{
   public $fillable = ['id','module','module_id','summary','description','fileextension','filesize','filename','token'];
}
