<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Http\Request;

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
            Offer::create([
                'name'=> $request -> name ,
                'price'=> $request -> price,
                'photo' => $request -> photo, 
            ]);
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
