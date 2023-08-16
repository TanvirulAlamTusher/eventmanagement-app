<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class AllEventController extends Controller
{
   public function AllEvents(){
    return Event::all();
   }
}
