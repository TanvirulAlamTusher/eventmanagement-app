<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
   protected $fillable=['title','description','date','time','location','attendance','user_id','category_id'];

   public function user()
   {
       return $this->belongsTo(User::class);
   }

   
}
