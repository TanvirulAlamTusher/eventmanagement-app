<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventCategoty;
use Exception;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EventCategotyController extends Controller
{
   public function CategoryPage():View
   {
    return view('pages.event-cate-page');
   }

   public function CreateCategory(Request $request){
    try{
        $user_id = auth()->user()->id;
        EventCategoty::create([
            'name' => $request->input('name'),
            'user_id' => $user_id
        ]);
        return 1;

    }catch(Exception $e){
        return 0;

    }
   
}

public function CategoryList(){
    $user_id = auth()->user()->id;
    return EventCategoty::where('user_id',$user_id)->get();

}

public function UpdateCategory(Request $request){
    try{
        $user_id = auth()->user()->id;
        $categoryId=$request->input('id');
    
           EventCategoty::where('user_id',$user_id)
                    ->where('id', $categoryId)->update([
                        'name'=>$request->input('name')
        ]);
        return 1;

    }catch(Exception $e){
        return 0;
    }
   

}



public function DeleteCategory(Request $request){
    $user_id = auth()->user()->id;
     $categoryId=$request->input('id');
    
         return EventCategoty::where('user_id',$user_id)
                     ->where('id', $categoryId)->delete();

}
public function CategotyById(Request $request){
    $user_id = auth()->user()->id;
    $category_id = $request->input('id');

    return EventCategoty::where('user_id',$user_id)->where('id',$category_id)->first();

  }

}
