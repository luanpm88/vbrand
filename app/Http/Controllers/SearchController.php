<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Producs;
use DB;
class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('fontend.search');
    } 

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $keysearch  = $request->txtkeyword;
        $products   = DB::table('products') ->where('keyword','like',$keysearch)
                                            ->orwhere('title','like',"%$keysearch%")
                                            ->orderBy('title','ASC')
                                            ->paginate(10);        
        return view('fontend.search', ['data'=> $products] );
    }
    
    public function destroy($id)
    {
        //
    }
}
