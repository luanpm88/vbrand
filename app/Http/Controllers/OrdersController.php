<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Auth;
use App\Products;
use App\Orders;
use App\Ordersdetail;
use DB;
class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /*
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    */
    public function index()
    {
        $Orders = Orders::paginate(10); 
        return view('backend.Orders.list', ['data'=> $Orders] );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::all();
        //echo "<pre>";print_r($category);echo "</pre>";
        return view('backend.Orders.add', ['category'=>$category ] );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $order = new Orders();
        $order->user_id = $request->user_id;
        $order->payment = $request->payment;;
        $order->total = $request->total;
        $order->currency = $request->currency;
        $order->paystatus = $request->paystatus; 

        $order->recept_name = $request->recept_name;
        $order->recept_phone = $request->recept_phone;
        $order->recept_address = $request->recept_address;
        $order->recept_email = $request->recept_email;

        $order->sendship = $request->sendship;
        $order->sendcreated = $request->sendcreated;
        $order->sendstatus = $request->sendstatus;

        $order->save();
        return redirect('backend.listorders')->with(['messege'=>'Create New Successfully !!!']);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response 
     */
    public function show($id)
    {
        $order      = Orders::find($id);
        //$details    = Ordersdetail::where('order_id',$id)->get(); 
        $details    = DB::table('orders_detail')
                    ->join( 'products', 'products.id', 'orders_detail.product_id') 
                    ->select( 'orders_detail.*', 'products.photo','products.title')
                    ->where( 'order_id', '=', $id )
                    ->get();
        //echo "<pre>";print_r($details);
        return view('backend.Orders.detail',['order'=>$order, 'data'=>$details]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $order = Orders::find($id);
        return view('backend.Orders.edit',['data'=>$order]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $order = Orders::find($id);
        $order->user_id = $request->user_id;
        $order->payment = $request->payment;;
        $order->total = $request->total;
        $order->currency = $request->currency;
        $order->paystatus = $request->paystatus;

        $order->recept_name = $request->recept_name;
        $order->recept_phone = $request->recept_phone;
        $order->recept_address = $request->recept_address;
        $order->recept_email = $request->recept_email;

        $order->sendship = $request->sendship;
        $order->sendcreated = $request->sendcreated;
        $order->sendstatus = $request->sendstatus;
        $order->save();
        //return redirect('admin/Products');
        return redirect('backend.listorders')->with(['messege'=>'Update Successfully !!!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) 
    {
        $order = Orders::find($id);
        $order->delete(); 
        return redirect()->route('backend.listorders')->with(['message'=> 'Successfully deleted!!']);
    }
    /*
        FOR FONTEND
    */
    public function details_user_order(Request $request){
        if (Auth::check()) { 
            $user = Auth::user();
            if(DB::table('orders')->where('id', $request->id)->where('user_id', $user->id)->exists() )
            {
                $order = Orders::find($request->id);               
                $details    = DB::table('orders_detail')
                        ->join( 'products', 'products.id', 'orders_detail.product_id') 
                        ->select( 'orders_detail.*', 'products.photo','products.title')
                        ->where( 'order_id', '=', $request->id )
                        ->get();
                if($order->invoice_id){
                    return view('fontend.Member.Order.detail',['data'=>$details,'user'=>$user,'order'=>$order]);
                }else{
                    return view('fontend.Member..Order.details_make_payment',['order'=>$order, 'details_products'=>$details])->with(['messege'=>'Chi tiết đơn hàng của bạn']);
                }
            }
            return redirect()->route('fontent.userorders')->with(['messenge'=>'Không tồn tại đơn hàng']);
        }
    }
    public function destroy_user_order(Request $request){
         if (Auth::check()) {
            $user = Auth::user();
            if(DB::table('orders')->where('id', $request->id)->where('user_id', $user->id)->exists() )
            {
                DB::table('orders')->where('order_id', $request->id)->delete();
                DB::table('orders_detail')->where('order_id', $request->id)->delete();
                return redirect()->route('fontent.userorders')->with(['order_messenge'=>'Xóa thành công']);
            }
            return redirect()->route('fontent.userorders')->with(['order_messenge'=>'Không có đơn hàng này']);
        }
    }

    public function list_user_order(Request $request){
        if (Auth::check()) { 
            $user = Auth::user();
            $order = Orders::where('user_id', '=', $user->id )->paginate(10);
            return view('fontend.Member.Order.list', ['data'=>$order, 'date'=> date('d-m-Y') ])->with(['messenge'=>'danh sách đơn hàng của bạn']);
        }
    }
    public function make_new_orders(Request $request)
    {        
        if (Auth::check()) { 
            $user = Auth::user();
            $order = new Orders();
            $cart = session()->get('cart');
            $order->user_id     = $user->id;
            $order->total       = $request->total;
            $order->recept_email = $user->email; 
            $order->save();
            //--- order details 
            foreach($cart as $product_id => $prouct_info){
                $Orderdetail                =   new Ordersdetail();
                $Orderdetail->order_id       =  $order->id;
                $Orderdetail->user_id       =   $user->id;
                $Orderdetail->product_id    =   $product_id;
                $Orderdetail->price         =   $prouct_info['price'];
                $Orderdetail->quantity      =   $prouct_info['quantity'];               
                $Orderdetail->save();
            }
            return redirect('orderpayment/'.$order->id)->with(['messege'=>'Create Order Successfully !!!']);
        } else {
            return redirect('login')->with(['order_messenge'=>'Bạn cần phải đăng nhập hệ thống !!!']); 
        }
    }
     public function make_payment($id)
    {
        if (Auth::check()) {
            $user = Auth::user();
            $order = Orders::find($id); 
            $cart = session()->get('cart');
            return view('fontend.Order.make_payment',['data'=>$cart,'user'=>$user,'order'=>$order]);
        }
    }

    public function make_update_orders(Request $request)
    {
        if (Auth::check()) { 
            $order = Orders::find($request->id); 
            $order->payment = $request->payment;
            $order->total = $request->total;
            //  $order->currency = $request->currency;
            //  $order->paystatus = $request->paystatus; 
            $order->recept_name = $request->recept_name;
            $order->recept_phone = $request->recept_phone;
            $order->recept_address = $request->recept_address;
            $order->recept_email = $request->recept_email;
            /*
                $order->sendship = $request->sendship;
                $order->sendcreated = $request->sendcreated;
                $order->sendstatus = $request->sendstatus;
            */
            $order->save();
            return view('fontend.Order.tranfer-successful');
            //redirect()->route('fontend.cart.thank')->with(['messege'=>'Create Order Successfully !!!']);
        }else{
            return redirect()->route('login')->with(['messege'=>"need login to system !!!"]);
        }
    }
   
    public function store_payment(){

    }
    
    /*
        For paypal
    */
    public function send_paypal(){

    }
    /*
        For tripe
    */
    public function send_tripe(){
        
    }
}
