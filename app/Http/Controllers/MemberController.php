<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DateTime,File,Input,DB; 
use App\Products;
use App\Category;
use App\Template;
use App\Package;

use App\myclass\Slug;

class MemberController extends Controller 
{
    private function make_slug($Products)
     {
        $slug   = new Slug();
        foreach ($Products as $pro) 
        {
            $pro->slug     = $slug->createSlug($pro->title);
            $pro->save();
        }
    }
    public function index()
    {
        $Products = Products::paginate(10);
        return view('fontend.Member.Products.list', ['data'=> $Products] );
    }
    public function create()
    {
        $category = Category::all();
        return view('fontend.Member.Products.add', ['category'=>$category ] );
    }
    public function store(Request $request)
    {
        $Products   = new Products();
        $slug = new Slug();
        $user       = Auth::user();
        $Products->category_id = $request->category;
        $Products->user_id = $user->id;
        $Products->title = $request->title;
        $Products->keyword = $request->keyword;
        $Products->currency = $request->currency;
        $Products->description = $request->description;
        $Products->price = $request->price;
        $Products->saleoff = $request->saleoff;
        $Products->content = $request->content;
        $Products->slug = $slug->createSlug($request->title);
        if($request->hasfile('photo')){
            $filename = $request->file('photo')->getClientOriginalName(); 
             $request->file('photo')->move(
                base_path() . '/public/upload/Product/', $filename
            );
            $Products->photo = $filename;
        }
        $Products->save();
        return redirect('backend.listProducts');
    }
    public function edit($id)
    {
        $Products   = Products::find($id);
        $category   = Category::all();
        return view('fontend.Member.Products.edit',['data'=>$Products,'category'=>$category]);
    }
    public function switchproduct(Request $request)
    {
        $products   = Products::find($request->proID);
        if($products){
            if($request->status=='true')
                $products->status = 1;
            else
                $products->status = 0;
            $products->save();
            return response()->json(['msg' => "successfully...!"], 200);
        } 
        return response()->json(['msg' => 'No result found!'], 404);
    }
    public function switchproducthot(Request $request)
    {
        $products   = Products::find($request->proID);
        if($products){
            if($request->status=='true')
                $products->hot = 1;
            else
                $products->hot = 0;
            $products->save();
            return response()->json(['msg' => "successfully...!"], 200);
        } 
        return response()->json(['msg' => 'No result found!'], 404);
    }
    public function update(Request $request, $id)
    {
        $slug       = new Slug();
        $Products   = Products::find($id);
        $user       = Auth::user();      
        if ($request->hasFile('photo')) {
            $filename=$request->file('photo')->getClientOriginalName();
            $request->file('photo')->move(
                base_path() . '/public/upload/Product/', $filename
            );
            $Products->photo = $filename;
        }
        if ($Products->slug != $request->slug) {
            $Products->slug = $slug->createSlug($request->slug, $id);
        }
        $Products->category_id = $request->category;
        $Products->user_id = $user->id;
        $Products->title = $request->title;
        $Products->currency = $request->currency;
        
        $Products->keyword = $request->keyword;
        $Products->description = $request->description;
        $Products->price = $request->price;
        $Products->saleoff = $request->saleoff;
        $Products->content = $request->content;
        $Products->save();
        return redirect()->route('backend.listProducts')->with(['messenge'=>'Cập nhật thành công!!!']); 
    }
    public function destroy($id)
    {
        $Products = Products::find($id);
        $Products->delete(); 
        return redirect()->route('backend.listProducts')->with(['message'=> 'Successfully deleted!!']);
    }
    public function dashboard(){ 
        return view('fontend.Member.dashboard');
    }

    
    public function accountsetting(){ 
        return view('fontend.Member.accountsetting',['data'=> Auth::user() ]);
    }
    public function accountsetting_store(){ 
        return view('fontend.Member.password',['data'=> Auth::user() ]);

    }
    
    public function promotion(){ 
        return view('fontend.Member.promotion',['data'=> Auth::user() ]);
    }

    public function voucher(){ 
        return view('fontend.Member.voucher',['data'=> Auth::user() ]);
    }
    public function card(){ 
        return view('fontend.Member.card',['data'=> Auth::user() ]);
    }

    public function statistical(){ 
        return view('fontend.Member.statistical',['data'=> Auth::user() ]);
    } 
    
    public function domain(){ 
        return view('fontend.Member.domain',['data'=> Auth::user() ]);
    }
    public function domain_store(Request $request){ 
        $user       = Auth::user();
        if($request->domain){
            if($user->domain){
                if( $request->domain != $user->domain) {
                    $user->domain = $request->domain;                
                    $user->save();
                    return redirect()->back()->with(['messenge'=> 'Change Successfully !!']);
                }else{
                    return redirect()->back()->with(['messenge'=> 'No change !!']);
                }
            }else{
                $user->domain = $request->domain;
                $user->save();
                return redirect()->back()->with(['messenge'=> 'Add Successfully !!']);
            }
        }
    }

    public function customer(){ 
        return view('fontend.Member.customer',['data'=> Auth::user() ]);
    }

    public function email(){ 
        return view('fontend.Member.email',['data'=> Auth::user() ]);
    } 

    public function alert(){ 
        return view('fontend.Member.alert',['data'=> Auth::user() ]);
    }
    public function alert_details(Request $request){ 
        return view('fontend.Member.password',['data'=> Auth::user() ]);
    }
 
    public function card_details(Request $request){ 
        return view('fontend.Member.password',['data'=> Auth::user() ]);
    }

    public function password(){ 
        return view('fontend.Member.password',['data'=> Auth::user() ]);
    }
    public function changepassword(Request $request){
        $user = Auth::user();
        if($input['currentpassword'] == $user->password){
            if( $input['newpassword']== $input['renewpassword'] ){
                $user->password =   $input['newpassword']; 
                $user->save();
                return view('fontend.Member.password',['data'=> $user ])->with(['message'=> 'Successfully !!']);
            }
        }
        return view('fontend.Member.password',['data'=> $user ])->with(['message'=>  "Don't change any things"]);
    }
    public function package (){ 
        $package  = Package::where('status',1)->orderBy('id','ASC')->get();
        return view('fontend.Member.package',['user'=> Auth::user(),'data' => $package ]);
    }
    public function payment(){ 
        return view('fontend.Member.payment',['data'=> Auth::user() ]);
    }    
    public function template(){
        $templates  = Template::where('status',1)->orderBy('id','DESC')->paginate(10);
        return view('fontend.Member.template',['user'=> Auth::user(), 'data'=> $templates ]);
    }
    public function template_details(Request $request){
        $slug       = $request->slug;
        $template   = Template::where('slug', $slug)->firstOrFail();
        return view( 'fontend.Member.template_details',[ 'user'=> Auth::user(),'data'=>$template ]);
    }
    public function template_store(Request $request)
    {
        $slug       = $request->slug;
        $template   = Template::where('slug', $slug)->firstOrFail();
        $user       = Auth::user();
        $user->template_id = $template->id;
        $user->save();
        return redirect()->route('fontend.templatelist')->with(['messenge'=>'Cập nhật thành công!!!']); 
    }

    



}
