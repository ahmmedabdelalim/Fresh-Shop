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
            
            $rules = $this -> getRules();
            $messages = $this -> getMessages();
            $validator = Validator::make($request->all(),$rules ,$messages); 

            if ($validator->fails())
            {
                return  redirect()->back()->withErrors($validator)->withInput($request->all());
            }

            //////////// save pohto in folder (images/photo)

            $file_name = $this -> saveimage($request -> photo , 'images/offers');
            

            $offer = Offer::create([
                'name'=> $request -> name ,
                'price'=> $request -> price,
                'photo' => $file_name, 
            ]);
                // if success return it and this wy for ajax  
            if ($offer){
            return response()->json([
                'status'=> true , 
                'msg' => 'add done',
            ]);}
            
            else
            {
                return response()->json([
                    'status'=> false , 
                    'msg' => 'add faild',
                ]);
            }
    }

    protected function getRules()
    {
    return $rules=[

            'name'=> 'required|max:100|Unique:offers,name', 
            'price'=> 'required|numeric|Unique:offers,price',
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

    ///// create method for display data from db 

    public function all()
    {
        $offers= Offer::select('id','name','price','photo')->get();
        return view('ajaxoffers.display',compact('offers'));

    }

    public function delete(Request $request)
    {
        $offer = Offer::find( $request->id );
        $offer->delete();
        return response()->json([
            'id'=> $request->id,
        'message' => 'Data deleted successfully!'
        ]);
    }
    

    // method for edite 
    public function editoffer(Request $request)
    {
        $offer = Offer::find($request->offer_id);

        if(!$offer)
        return response()->json([
            'status' =>false ,
        'message' => 'Data not found !'
        ]);
    
        $offer =   Offer::select('id','name','price','photo')->find($request->offer_id);
    
        return view('ajaxoffers.edit',compact('offer'));
    }
        ///// method for update 
        public function updateoffer(Request $request)
        {
            $offer = Offer::find($request->offer_id);

            if(!$offer)
            return response()->json([
                'status' =>false ,
            'message' => 'Data not found !'
            ]);
            $offer->update($request->all());

            return response()->json([
                'status'=> true , 
                'msg' => 'update done',
            ]);

        }

    

}

