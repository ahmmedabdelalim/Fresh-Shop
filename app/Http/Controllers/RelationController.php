<?php

namespace App\Http\Controllers;

use App\Models\Phone;
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




}
