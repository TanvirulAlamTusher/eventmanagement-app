<?php

namespace App\Http\Controllers;

use Exception;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;

class EventController extends Controller
{
  public function EventPage(){
    return view('pages.event-page');
  }

//    public function CreateEvent(Request $request){
//     try{
//         $user_id = auth()->user()->id;
    
//          Event::where('user_id',$user_id)->create([
//             'title' => $request->input('title'),
//             'description' => $request->input('description'),
//             'date' => $request->input('date'),
//             'time' => $request->input('time'),
//             'location' => $request->input('location'),
//             'user_id' => $user_id
//         ]);
    
//         return  response()->json([
//           'status' => 'success',
//           'message' => 'Event created successfully'
//         ],200);

//     }catch(Exception $e){
//         return  response()->json([
//             'status' => 'failure',
//             'message' => 'something went wrong'
//           ],200);

//     }
  


//    }

//req serversite velidation
public function CreateEvent(Request $request){
    try {
        $user_id = auth()->user()->id;
    
        // Define validation rules
        $rules = [
            'title' => 'required|string|max:50',
            'description' => 'required|string',
            'date' => 'required|date',
            'location' => 'required|string',
        ];
    
        // Validate the request data
        $validator = Validator::make($request->all(), $rules);
    
        if ($validator->fails()) {
            return response()->json([
                'status' => 'failure',
                'message' => 'Validation error',
                'errors' => $validator->errors(),
            ], 200);
        }
    
        // Create the event
        Event::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'date' => $request->input('date'),
            'time' => $request->input('time'),
            'location' => $request->input('location'),
            'user_id' => $user_id
        ]);
    
        return response()->json([
            'status' => 'success',
            'message' => 'Event created successfully'
        ], 200);
    } catch (Exception $e) {
        return response()->json([
            'status' => 'failure',
            'message' => 'Something went wrong'
        ], 200);
    }
}



   public function GetEvent(){
    $user_id = auth()->user()->id;
    return Event::where('user_id',$user_id)->get();
    
   }


  //  public function UpdateEvent(Request $request){
  //   try{
  //     $user_id = auth()->user()->id;
  //     $event_id = $request->input('id');
  
  //    Event::where('user_id',$user_id)
  //        ->where('id',$event_id)->update([
  //         'title' => $request->input('title'),
  //         'description' => $request->input('description'),
  //         'date' => $request->input('date'),
  //         'time' => $request->input('time'),
  //         'location' => $request->input('location'),
  //        ]);
  
  //        return  response()->json([
  //         'status' => 'success',
  //         'message' => 'Event created successfully'
  //       ],200);

  //   }catch(Exception $e){
  //     return  response()->json([
  //       'status' => 'failure',
  //       'message' => 'something went wrong'
  //     ],200);

  //   }
  
    
  //  }

  
public function UpdateEvent(Request $request){
  try {
      $user_id = auth()->user()->id;
      $event_id = $request->input('id');

      // Define validation rules
      $rules = [
          'title' => 'required|string|max:50',
          'description' => 'required|string',
           'date' => 'required|date',
         'location' => 'required|string',
      ];

      // Validate the request data
      $validator = Validator::make($request->all(), $rules);

      if ($validator->fails()) {
          return response()->json([
              'status' => 'failure',
              'message' => 'Validation error',
              'errors' => $validator->errors(),
          ], 400);
      }

      // Update the event
      Event::where('user_id', $user_id)
          ->where('id', $event_id)
          ->update([
              'title' => $request->input('title'),
              'description' => $request->input('description'),
              'date' => $request->input('date'),
              'time' => $request->input('time'),
              'location' => $request->input('location'),
          ]);

      return response()->json([
          'status' => 'success',
          'message' => 'Event updated successfully'
      ], 200);
  } catch (Exception $e) {
      return response()->json([
          'status' => 'failure',
          'message' => 'Something went wrong'
      ], 500);
  }
}

   public function DeleteEvent(Request $request){
    $user_id = auth()->user()->id;
    $event_id = $request->input('id');

    return Event::where('user_id',$user_id)
    ->where('id',$event_id)->delete();

    
    
   }

   public function EventById(Request $request){
    $user_id = auth()->user()->id;
    $event_id = $request->input('id');

    return Event::where('user_id',$user_id)
    ->where('id',$event_id)->first();
    
   }
}
