<?php


namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\traits\Offerstrait;
class OfferController extends Controller
{
    use Offerstrait ;

    // create method to view the form to add this offer 
    public function create()
    {
        return view('ajaxoffers.create');

    }

    // create method to save the data into db using ajax
    public function store(Request $request)
    {
            //  validate data before insert data in DB 
            
           /* $rules = $this -> getRules();
            $messages = $this -> getMessages();
            $validator = Validator::make($request->all(),$rules ,$messages); 

            if ($validator->fails())
            {
                return  redirect()->back()->withErrors($validator)->withInput($request->all());
            }*/

            //////////// save pohto in folder (images/photo)

            //$file_name = $this -> saveimage($request -> photo , 'images/offers');
            

            Offer::create([
                'name'=> $request -> name ,
                'price'=> $request -> price,
                //'photo' => $file_name, 
            ]);
                // if success return it
            return redirect()->back()->with([ 'success'=>'تم اضافه العرض بنجاح']);
    }
/*
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
            'photo.required'=>trans('messages.photo is required'),
            
            
        ];
    }
*/

    

}
