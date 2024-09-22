<?php

namespace App\Repositories;

use App\data_display_options_interface;
use App\DataDisplayOptionsInterface;
use App\Http\Requests\StoreDataValidation;
use App\Http\Resources\DataDisplayOptionResource;
use App\Models\DataDisplayOption;
use Illuminate\Support\Facades\Auth as Auth;

class DataDisplayOptionsRepository implements DataDisplayOptionsInterface
{
    protected $model;
    public function __construct(DataDisplayOption $model)
    {
        $this->model = $model;
    }
    public function index()
    {
        //select * from Data_options Where User_ID = 1 or any number for the Authorized User;
        $Options = $this->model->where('user_id',Auth::user()->id)->firstOrFail();

        //code to return collection (All) of Data_Options
        return new DataDisplayOptionResource($Options);
    }

    public function store(StoreDataValidation  $request)
    {
        $type = $request->type;
        $userid = Auth::user()->id;

        
        $Data = $this->model->updateOrCreate(
            ['user_id' =>  $userid ],
            ['type' => $type ]
        );

        
    
        //return instance of Data_Options
        return new DataDisplayOptionResource($Data);
    }
    public function destroy($DataId)
    {
         //code to search for Data_Options by id
        $DataOptions = $this->model->findOrFail($DataId);
        $DataOptions->delete();


        return response()->json(['message' => 'Deleted Sucesufully' , 'code' => '200']);
    }
}
