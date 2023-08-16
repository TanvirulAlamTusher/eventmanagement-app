<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventCategoty;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EventCategotyController extends Controller
{
   public function CategoryPage():View
   {
    return view('pages.event-cate-page');
   }

   public function category_create(Request $request){
    $user_id = auth()->user()->id;
    return Event::where('user_id',$user_id)->create([
        'name'=>$request->input('name')
    ]);
}

public function category_read(){
    $user_id = auth()->user()->id;
    return Event::where('user_id',$user_id)->get();

}

public function category_update(Request $request){
    $user_id = auth()->user()->id;
    $categoryId=$request->input('id');

        return Event::where('user_id',$user_id)
                ->where('id', $categoryId)->update([
                    'name'=>$request->input('name')
                ]);
}



public function category_delete(Request $request){
    $user_id = auth()->user()->id;
         $categoryId=$request->input('id');
    
         return Event::where('user_id',$user_id)
                     ->where('id', $categoryId)->delete();

}

}
