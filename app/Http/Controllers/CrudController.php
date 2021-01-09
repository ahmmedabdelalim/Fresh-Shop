<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use App\traits\Offerstrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Unique;
use Prophecy\Doubler\Generator\Node\ReturnTypeNode;


class CrudController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    
    use Offerstrait ;
    /////////////////////********************  method for crude controller  */******************* */
////////// first insert data
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

            //////////// save pohto in folder (images/photo)

            $file_name = $this -> saveimage($request -> photo , 'images/offers');
            

            Offer::create([
                'name'=> $request -> name ,
                'price'=> $request -> price,
                'photo' => $file_name, 
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
            'photo.required'=>trans('messages.photo is required'),
            
            
        ];
    }


    // method for select data from DB

    public function getAllOffer()
    {
        $offers= Offer::select('id','name','price','photo')->get();
        return view('offer.display',compact('offers'));
    }

////////// ******** method for edite ****

public function editOffer($offer_id)
{

    $offer = Offer::find($offer_id);

    if(!$offer)
    return redirect()->back();

    $offer =   Offer::select('id','name','price','photo')->find($offer_id);

    return view('offer.edit',compact('offer'));

}

public function updateoffer(Request $request ,$offer_id)
{ 
    // validation and check if offer exit 
    $offer =   Offer::select('id','name','price','photo')->find($offer_id);

    if(!$offer)
    return redirect()->back();

    // update

    $offer->update($request->all());
    return redirect()->back()->with(['success'=>'update done']);


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
