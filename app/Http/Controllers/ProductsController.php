<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DateTime,File,Input,DB; 
use App\Products;
use App\Category;
use App\myclass\Slug;

class ProductsController extends Controller
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
        return view('backend.Products.list', ['data'=> $Products] );
    }
    public function create()
    {
        $category = Category::all();
        return view('backend.Products.add', ['category'=>$category ] );
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
        return view('backend.Products.edit',['data'=>$Products,'category'=>$category]);
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
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */
    public function show_detail($id)
    {
        $category   = Category::all(); 
        $product    = Products::find($id);
        if($product){
            $parent     = $product->category;
            $product_same = $parent->products;
            return view('fontend.Products.detail', ['data'=> $product, 'parent'=> $parent,'category'=>$category, 'product_same'=>$product_same ] );
        }
        return '';
    }
    public function show_detail_slug($slug)
    {
        $category   = Category::all();
        $product    = Products::where('slug', $slug)->firstOrFail(); 
        if($product){
            $parent     = $product->category;
            $product_same = $parent->products;
            return view('fontend.Products.detail', ['data'=> $product, 'parent'=> $parent,'category'=>$category, 'product_same'=>$product_same ] );
        }
        return '';
    }
    public function product_of_category($id)
    {
        $parent     = Category::find($id);  // $products   = $parent->products->take(10)->get(); lien ket theo moi quan he
        $products   = Products::where('category_id',$id)->orderBy('title','ASC')->paginate(10);
        $category   = Category::all();
        return view('fontend.Products.list', ['data'=> $products, 'category'=>$category, 'parent'=> $parent] );
    }
    public function product_slug_category($slug)
    {
        $parent     = Category::where('slug', $slug)->firstOrFail();
        $products   = Products::where('category_id',$parent->id)->orderBy('title','ASC')->paginate(10);
        $category   = Category::all();
        return view('fontend.Products.list', ['data'=> $products, 'category'=>$category, 'parent'=> $parent,'title'=>$parent->title ] );
    }
    public function show()
    {
        $cart = session()->get('cart');
        $category   = Category::all();
        $saleoff    = Products::where('saleoff','>',0 )->orderBy('title','ASC')->get();
        $products   = Products::where('status', 1)->orderBy('title','ASC')->paginate(10);
        return view('fontend.Products.list', [ 'data'=> $products,'category'=>$category, 'saleoff'=>$saleoff ] );
    }
    public function search(Request $request)
    {
        $products   = Products::where('keyword','like',$request->txtkeysearch)->orderBy('title','ASC')->paginate(10);
        $category   = Category::all();
        return view('fontend.Products.list', ['data'=> $products, 'category'=>$category] );
    }    
    /*
       for commercial
    */
    public function cart(){
        $cart = session()->get('cart');
        if(!$cart){ // cart is empty
            return redirect()->route('product.list')->with(['messenge'=>"You don't have any product in cart"]);
        }
        return view('fontend.cart.home',['data'=>$cart])->with(['messenge'=>"Your Cart"]);
    }
    public function cart_add_product(Request $request){
        $product = products::find($request->id);
        if(!$product){
            return redirect()->route('fontend.Products')->with(['messenge'=>'List Products']);
        }
        $cart = session()->get('cart');
        if(!$cart){ // cart is empty
            $cart = [
                $request->id => [
                    'name'      =>  $product->title,
                    'quantity'  =>  $request->quantity,
                    'price'     =>  $product->price,
                    'currency'  =>  $product->currency,
                    'photo'     =>  $product->photo,
                ]
            ];
            session()->put('cart', $cart);
            return redirect()->route('cart.list')->with(['messenge'=>'Product added to cart successfully!']);
        }
        if(!empty($cart[$request->id])){
            $cart[$request->id]['quantity'] = $request->quantity;
            return redirect()->route('cart.list')->with(['messenge'=>'Product already in your card and update quantity successfully !!!']);    
        }
        $cart[$request->id] = [
                'name'      =>  $product->title,
                'quantity'  =>  $request->quantity,
                'price'     =>  $product->price,
                'currency'  =>  $product->currency,
                'photo'     =>  $product->photo,
        ];
        session()->put('cart', $cart);
        return redirect()->back()->with(['messenge'=>'Add new Product to cart successfully !!!']);
    }
    public function cart_add($id, $quantity=1){
        $product = products::find($id);
        if(!$product){
            return redirect()->route('fontend.Products')->with(['messenge'=>'List Products']);
        }
        $cart = session()->get('cart');
        if(!$cart){ // cart is empty
            $cart = [
                $id => [
                    'name'      =>  $product->title,
                    'quantity'  =>  $quantity,
                    'price'     =>  $product->price,
                    'currency'  =>  $product->currency,
                    'photo'     =>  $product->photo,
                ]
            ];
            session()->put('cart', $cart);
            return redirect()->back()->with(['messenge'=>'Product added to cart successfully!']);
        }
        if(!empty($cart[$id])){
            return redirect()->back()->with(['messenge'=>'Product already in your card !!!']);    
        }
        $cart[$id] = [
                'name'      =>  $product->title,
                'quantity'  =>  $quantity,
                'price'     =>  $product->price,
                'currency'  =>  $product->currency,
                'photo'     =>  $product->photo,
        ];
        session()->put('cart', $cart);
        return redirect()->back()->with(['messenge'=>'Add new Product to cart successfully !!!']);
    }
    public function cart_update(request $request){ 
        if( $request->id){
            if($request->quantity){ 
            $cart = session()->get('cart'); 
            $cart[$request->id]['quantity']= $request->quantity; 
            session()->put('cart',$cart);
            }
        } 
    }
    public function cart_remove(request $request){
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) { 
                unset($cart[$request->id]); 
                session()->put('cart', $cart);
            }
            session()->flash('messenge', 'Product removed successfully');
        }
    }
    /*
        for member function
    */
    public function product_list_user()   //show
    {
        if (Auth::check()) { 
            $user = Auth::user();
            $Products   = Products::where('user_id',$user->id)->orderBy('title','ASC')->paginate(10);
            return view('fontend.Products.userlist',['data'=>$Products]);
        }
    }
    public function product_add_user()    // show
    {
        if (Auth::check()) { 
            $category   = Category::all();
            return view('fontend.Products.useradd',['category'=>$category]);
        }
    }
    public function product_store_user(request $request)  // store
    {
        if (Auth::check()) { 
            $user = Auth::user();
            $Products   = new Products();
            $slug       = new Slug();
            $Products->user_id      = $user->id;
            $Products->category_id  = $request->category;
            $Products->title        = $request->title;
            $Products->keyword      = $request->keyword;
            $Products->description  = $request->description;
            $Products->price        = $request->price;
            $Products->saleoff      = $request->saleoff;
            $Products->content      = $request->content;
            $Products->slug         = $slug->createSlug($request->title);
            if($request->hasfile('photo')){
                $filename           = $request->file('photo')->getClientOriginalName(); 
                 $request->file('photo')->move(
                    base_path() . '/public/upload/Product/', $filename
                );
                $Products->photo    = $filename;
            }
            $Products->save();
            return redirect()->route('product.userlist')->with(['messenge_sm'=>"Add new products successfully...!"]);
        }
    }
    public function product_edit_user(Request $request)   // show edit
    {
        if (Auth::check()) { 
            $user = Auth::user();
            $Products   = Products::find($request->id); 
            $category   = Category::all();
            return view('fontend.Products.useredit',['data'=>$Products, 'category'=>$category]);
        }
    }
    public function product_update_user(request $request) // update
    {
        if (Auth::check()) { 
            $user = Auth::user();
            $Products   = Products::find($request->id);
            $slug       = new Slug();
            $Products->user_id      = $user->id;
            $Products->category_id  = $request->category;
            $Products->title        = $request->title;
            $Products->keyword      = $request->keyword;
            $Products->description  = $request->description;
            $Products->price        = $request->price;
            $Products->saleoff      = $request->saleoff;
            $Products->content      = $request->content;
            $Products->slug         = $slug->createSlug($request->title);
            if($request->hasfile('photo')){
                $filename           = $request->file('photo')->getClientOriginalName(); 
                 $request->file('photo')->move(
                    base_path() . '/public/upload/Product/', $filename
                );
                $Products->photo    = $filename;
            }
            $Products->save();
            return redirect()->route('product.userlist')->with(['messenge_sm'=>"Update products successfully...!"]);
        }
    }
    public function product_destroy_user($id)
    {
        if (Auth::check()) { 
            $user = Auth::user();
            $Products = Products::where(['id'=>$id, 'user_id'=>$user->id ])->get();
            $Products->each->delete(); 
            return redirect()->route('product.userlist')->with(['message_sm'=> 'Successfully deleted!!']);
        }
    }
    /*
        end function for member
    */
}