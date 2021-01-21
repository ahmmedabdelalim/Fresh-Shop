<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Hospital;
use App\Models\Phone;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Models\User ;

class RelationController extends Controller
{
    public function hasOneRelation()
    {
        //$user = \App\Models\User::find(15);
       // $phone = \App\Models\Phones::find(1);
    //return response()->json($user);
        
    $user = User::with(['phone'=>function($q){

        $q->select('code','phone','user-id');
    }])->find(15);

    return  response()->json($user);  

    

    /*
        //to access any attribute in database and the relation
        return $user->phones->code;
        return $user->phones->code;
        */
        
    }

    public function ReverseHasOne()
    {
        /*
        $phone= Phone::find(1);
        // to visible any data 
        $phone->makeVisible(['user-id']);
        // to hide any data
        //$phone->makeHidden(['code']);
        //return $phone; 

        return $phone->User; // return user of this phone */

        $phone = Phone::with(['user' => function($q){

            $q->select('id','name','email','age');

        }])->find(1);
        $phone->makeVisible(['user-id']);
        //return $phone->user->email;
        return $phone;
    }

    public function gethasphone()
    {
        //return User::whereHas('phone')->get();
       // return User::whereDoesntHave('phone')->get();
        ## if we need write condition with select 
        

    }

    ## get user when has phone and with condition 
    public   function getwithcondition()
    {
        ## if we need write condition with select 
        $user = User::whereHas('phone',function  ($q)
        {
            $q->where('code','02');
        })->get();

        return $user;

    }



    /////////////////// has many relation ////

    public function hasmany()
    {  
        $hospital = Hospital::find(2);
        $hospital -> doctor ;
       // return $hospital; 
        $hospital = Hospital::with('doctor')->find(1); // for get doctors that work in specific hospitall
        //return $hospital->name; // to get any item in db

        

        
        ## to get all data in for loop

        $doctors = $hospital ->doctor;
        foreach($doctors as $doctor)
        {
            echo $doctor->name ."<br>";
        }
    }

    ///////////////// show the hospital and his doctors
    public function getHospital()
        {
            $hospitals = Hospital::select('id','name','address')->get();
            return  view('site',compact('hospitals'));
        }

        public function getDoctors($hospital_id)
        {
            $hospitals = Hospital::find($hospital_id);
            $doctors= $hospitals-> doctor;
            return  view('doctors',compact('doctors'));
        }


    ////////////////// many to many

    public function manytomany()
    {
        $doctor= Doctor::with('service')->find(4);
        echo $doctor  . "<br>";
        echo $doctor->service . "<br>";
        echo $doctor->name . "<br>" ;
    }

    public function inversemanytomany()
    {
        $service = Service::with('doctor')->find(1);
        echo $service;

        $service = Service::with(['doctor'=>function($q)
        {
            $q->select('doctors.id','name','title');
        }])->find(1);

        echo $service;
    }


    #### show the service fo data 

    public function getService($doctor_id)
        {
            $doctors = Doctor::find($doctor_id);
            $services= $doctors->service;
            $showdoctors = Doctor::select('id','name')->get();
            $showservices = Service::select('id','name')->get();

            return  view('services',compact('services','showdoctors','showservices'));
        }

        public function SaveServices(Request $request)

        {
            $doctor = Doctor::find($request->doctor_id);

            if(!$doctor)
            return abort('404');
            $doctor->service()->syncWithoutDetaching($request->service_id); // for add without duobliy
            return redirect()->back() ;
        }




}
