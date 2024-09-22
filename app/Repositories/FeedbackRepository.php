<?php

namespace App\Repositories;

use App\FeedbackInterface;
use App\Http\Requests\StoreFeedbackValidation;
use App\Http\Resources\FeedbackResource;
use App\Models\Feedback;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth as Auth;
use Illuminate\Support\Facades\DB;

class FeedbackRepository implements FeedbackInterface
{
    protected $model;
    public function __construct(Feedback $model)
    {
        $this->model = $model;
    }
    public function index()
    {
        //select * from Feedback for Authenticated Person;
        $Feedback = $this->model->where('user_id',Auth::user()->id)->paginate(10);

       
        // //code to return single Feedback For Authenticated Person
        // return  FeedbackResource::collection($Feedback); 

        // Fetch feedbacks and initialize variables
        $feedbacks = Feedback::select('id', 'created_at')
        ->where('created_at', '>=', Carbon::now()->subMonths(12))
        ->get()
        ->groupBy(function ($date) {
            return Carbon::parse($date->created_at)->format('Y-m');
        });
    
    $monthNames = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
    $data = [];
    $months = [];
    
    for ($i = 11; $i >= 0; $i--) {
        $date = Carbon::now()->subMonths($i);
        $monthYear = $date->format('Y-m');
        $mYear = $date->format('Y');
        $monthName = $monthNames[$date->month - 1];
        $count = isset($feedbacks[$monthYear]) ? count($feedbacks[$monthYear]) : 0;
        $data[] = $count;
        $months[] = $monthName . ' ' .$mYear;
    }
    
    $response = [
        "feedbacks content" => FeedbackResource::collection($Feedback),
        "series" => [
            "name" => "Feedbacks",
            "data" => $data,
        ],
        "categories" => $months,
    ];
    
    return $response;
    // return response()->json($userArr);
    }



    public function show($FeedbackID)
    {
        //code to search for Announcement by id
      $singleFeedbackFromDB = $this->model->findOrFail($FeedbackID);
        //code to return instance(Single) Announcement
        return new FeedbackResource($singleFeedbackFromDB);
    }



    public function store(StoreFeedbackValidation  $request)
    {
        $message = $request->message;
        $userid = Auth::user()->id;
       

        //code to create new instance of Announcements
        $newFeedback = $this->model->create([
            'message' => $message,
            'user_id' => $userid
        ]);

        $newFeedback->refresh();
        
    
        //return instance of Announcement
        return new FeedbackResource($newFeedback);
    }

    public function update(StoreFeedbackValidation $request,$FeedbackId)
    {
        //code to search for Announcement by id
        $singleFeedbackFromDB = $this->model->findOrFail($FeedbackId);
        //code to validate the data

        $message = $request->message;
        $userid = Auth::user()->id;
       

            
            //code to update The instance of The Announcement
            $singleFeedbackFromDB->update([
                'message' => $message,
                'user_id' => $userid
            ]);
            //code to reurn instance of the Announcement
         return new FeedbackResource($singleFeedbackFromDB);
        }

    public function destroy($FeedbackID)
    {
         //code to search for Announcement by id
        $Feedback = $this->model->findOrFail($FeedbackID);
        $Feedback->delete();


        return response()->json(['message' => 'Deleted Sucesufully' , 'code' => '200']);
    }
}
