<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAnnouncementValidation;
use App\Http\Resources\AnnouncmentsResource;
use App\Models\Announcement;
use Illuminate\Support\Facades\Auth as Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AnnouncmentsApiController extends Controller
{
    public function index()
    {
        //select * from Announcements;
        $Announcments = Announcement::get();

        //code to return collection (All) of Announcements
        return AnnouncmentsResource::collection($Announcments);
    }



    public function show($AnnounceID)
    {
        //code to search for Announcement by id
      $singleAnnounceFromDB = Announcement::findOrFail($AnnounceID);
        //code to return instance(Single) Announcement
        return new AnnouncmentsResource($singleAnnounceFromDB);
    }



    public function store(StoreAnnouncementValidation  $request)
    {
        $title = $request->title;
        $content = $request->content;
        $slug=strtolower(implode('-',explode(' ',$request->title)));
        $userid = Auth::user()->id;
       //code to save file as string
       $fileName = time() . '.' . $request->file->extension();
       $request->file->move(storage_path('app/public/images'), $fileName);

        //code to create new instance of Announcements
        $newAnnouncement = Announcement::create([
            'title' => $title,
            'slug' =>$slug,
            'content' => $content,
            'file' => 'images/' . $fileName,
            'user_id' => $userid
        ]);

        $newAnnouncement->refresh();
        
    
        //return instance of Announcement
        return new AnnouncmentsResource($newAnnouncement);
    }

    public function update(StoreAnnouncementValidation $request,$AnnounceId)
    {
        //code to search for Announcement by id
        $singleAnnouncmentFromDB = Announcement::findOrFail($AnnounceId);
        //code to validate the data

        $title = $request->title;
        $content = $request->content;
        $slug=strtolower(implode('-',explode(' ',$request->title)));
        $userid = Auth::user()->id;

        // code to check if there is a file and update it with new one and delete the old one
            if($request->hasFile('file'))
            {
                $file= time() . '.' . $request->file->extension();
                $request->file->move(storage_path('app/public/images'), $file);
                $fileName = 'images/' . $file;
                $old_path = $singleAnnouncmentFromDB->file;
                //dd($old_path);
                if(isset($old_path)){
                    File::delete(storage_path('app/public/'.$old_path));

                }
            }
            else{
                $fileName = $singleAnnouncmentFromDB->file;
            }
            //code to update The instance of The Announcement
            $singleAnnouncmentFromDB->update([
            'title' => $title,
            'slug' =>$slug,
            'content' => $content,
            'file' => $fileName,
            'user_id' => $userid
            ]);
            //code to reurn instance of the Announcement
         return new AnnouncmentsResource($singleAnnouncmentFromDB);
        }

    public function destroy($AnnounceId)
    {
         //code to search for Announcement by id
        $Announce = Announcement::findOrFail($AnnounceId);
        //code to fetch Announcement File
        $image_path = storage_path($Announce->file);
        //dd($Announce->file);
        if(isset($image_path))
        {
            File::delete(storage_path('app/public/'.$image_path));
        }
        $Announce->delete();


        return response()->json(['message' => 'Deleted Sucesufully' , 'code' => '200']);
    }
}
