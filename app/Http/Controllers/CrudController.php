<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Unique;
//use Illuminate\Validation\Validator;

class CrudController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    public function create()
    {
        return view('offer.create');
    }
    public function store(Request $request)
    {
            //  validate data before insert data in DB 
            
            $rules = $this -> getRules();
            $messages = $this -> getMessages();
            $validator = Validator::make($request->all(),$rules ,$messages); 

            if ($validator->fails())
            {
                return  redirect()->back()->withErrors($validator)->withInput($request->all());
            }

            Offer::create([
                'name'=> $request -> name ,
                'price'=> $request -> price,
                'photo' => $request -> photo, 
            ]);
                // if success return it
            return redirect()->back()->with([ 'success'=>'تم اضافه العرض بنجاح']);
    }

    protected function getRules()
    {
    return $rules=[

            'name'=> 'required|max:100|Unique:offers,name', 
            'price'=> 'required|numeric',
            'photo'=> 'required',
        ];
    }

    protected function getMessages()
    {
        return $messages=[

            'name.required'=> trans('messages.offer name required'),
            'name.unique'=> trans('messages.offer name exist'),
            'price.required'=>trans('messages.offer price required'),
            'price.numeric'=> trans('messages.offer price wrong'),
            'photo.required'=>trans('messages.offer photo required'),
            
            
        ];
    }



    /* public function store()
    {
        Offer::create(['name'=>'ahmed','price'=>'100','photo'=>'iam']);
        return "done";
    }*/

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    
}
