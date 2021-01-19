<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home'); 
    }
    public function test()
    {
        return view('backend.test'); 
    }
    public function dashboard(){
        $order_count    = DB::table('orders')->count();
        $user_count     = DB::table('users')->count();
        $products_count = DB::table('products')->count();
        $feedback_count = DB::table('feedback')->count();
        
        //die($order_count);
            
        /*
            Report Order
        */
            $order_last = DB::table('orders') 
                            ->select( 'orders.*')
                            ->orderByRaw('id DESC')->limit(10)->get();
        /*
            Report Last user
        */
            $users_last = DB::table('users')
                            ->select( 'users.*')
                            ->orderByRaw('id DESC')->limit(5)->get();
        /*
            Report Last products
        */
            $products_last = DB::table('products')
                            ->join('category', 'products.category_id', '=', 'category.id')
                            ->select( 'products.*', 'category.title as cat_title'
                        )->orderByRaw('id DESC')->limit(5)->get();
        /*
            Report Last Feedback
        */
            $feedback_last = DB::table('feedback')
                            ->select( 'feedback.*')
                            ->orderByRaw('id DESC')->limit(5)->get();
        /*
            Report Last Comments
        */

        return view('backend.dashboard',[
            'order_count'       => $order_count,
            'user_count'        => $user_count,
            'products_count'    => $products_count,
            'feedback_count'    => $feedback_count,

            'order_last'    => $order_last,
            'users_last'    => $users_last,
            'products_last' => $products_last,
            'feedback_last' => $feedback_last, 

        ]);  
    }

    
    public function aboutus_store(Request $request){ 
        $data = [
                    'title'         =>   $request->title,
                    'description'   =>   $request->description,
                    'content'       =>   $request->content,
                    'keyword'       =>   $request->keyword,
                ];        
        if($request->hasfile('photo')){
            $filename=$request->file('photo')->getClientOriginalName();
            $request->file('photo')->move(
                base_path() . '/public/upload/', $filename
            );           
            $data['photo'] =   $filename;
        }
        DB::table('aboutus')->where('id', 1)->update($data);          
        return redirect()->route('backend.aboutus')->with(['messenge'=>"Config successful...!"]);
    }
    public function aboutus(){
        $aboutus = DB::table('aboutus')->limit(1)->get();
        return view('backend.aboutus',['data'=>$aboutus[0] ]);
    }
    public function config_store(Request $request){
        $data = [
                   'site_name'         =>   $request->site_name,
                    'site_keyword'      =>   $request->site_keyword,
                    'site_description'  =>   $request->site_description,
                    'site_hotline'      =>   $request->site_hotline,
                    'site_logo'         =>   $request->site_logo,
                    'site_flogo'        =>   $request->site_flogo,
                    'site_email'        =>   $request->site_email,
                    'site_slogon_vn'    =>   $request->site_slogon_vn,
                    'site_slogon_en'    =>   $request->site_slogon_en,
                    'site_address_vn'   =>   $request->site_address_vn,
                    'site_address_en'   =>   $request->site_address_en,
                    'site_companyname_vn'  =>   $request->site_companyname_vn,
                    'site_companyname_en'  =>   $request->site_companyname_en
                ];        
        if($request->hasfile('site_logo')){
            $filename=$request->file('site_logo')->getClientOriginalName();
            $request->file('site_logo')->move(
                base_path() . '/public/upload/', $filename
            );           
            $data['site_logo'] =   $filename;
        }
        DB::table('config')->where('id', 1)->update($data);          
        return redirect()->route('backend.config')->with(['messenge'=>"Config successful...!"]); 
    }
    public function config(){
        $config = DB::table('config')->limit(1)->get();
        return view('backend.config',['data'=>$config[0] ]);
    }

    public function upload(Request $request){
        if($request->hasfile('image')){
            $filename=$request->file('image')->getClientOriginalName();
            $request->file('image')->move(
                base_path() . '/public/upload/Images/', $filename
            );
            $link = "http://".$_SERVER['HTTP_HOST']."/upload/Images/".$filename;
            $res = array(
                "data" => array( 
                    "link" => $link, 
                    "width" => '', 
                    "height" => ''
                )
            );       
            echo json_encode($res);
        }else{
            echo "upload loi";
        } 
    }
    //---------- end class
}
