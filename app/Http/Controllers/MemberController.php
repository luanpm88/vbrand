<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DateTime,File,Input,DB; 

use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;

use PayPal\Api\Payer;
use PayPal\Api\Item;

use PayPal\Api\ItemList;
use PayPal\Api\Amount;
use PayPal\Api\Transaction;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Payment;

use PayPal\Api\Details;
use PayPal\Api\PaymentExecution;

use Mail;
use App\Mail\sendorder;

use App\Products;
use App\Category;
use App\Template;
use App\Package;
use App\Orders;
use App\Ordersdetail;
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
        $user       = Auth::user();
        $data       = array();
        //echo "<pre>"; print_r($user->template);echo "</pre>";
        // check package
        if(empty($user->package_id)){
            $package  = Package::where('status',1)->orderBy('id','ASC')->get();
            $data['package']     = $package;
        }elseif(empty($user->template_id)){

            $template  = Template::where('status',1)->orderBy('id','ASC')->get();
            $data['template']     = $template;
        }
        //echo "<pre>";print_r($data);echo "</pre>";
        return view('fontend.Member.dashboard',['user'=> $user, 'data'=> $data ]);
    }
    public function dashboard_update( Request $request ){
        $user       = Auth::user();
        if(isset($request->template_id)){ 
            $user->template_id = $request->template_id;
            $user->save();
            return redirect()->back()->with(['messenge'=> 'Successfully !!']);
        }
        if(isset($request->package_id)){
            $user->package_id = $request->package_id; 
            $user->save();
            return redirect()->back()->with(['messenge'=> 'Successfully !!']);
        }
        if(isset($request->dot) && isset($request->domain)){
            $user->domain = trim($request->domain).$request->dot; 
            $user->save();
            return redirect()->back()->with(['messenge'=> 'Successfully !!']);
        }
        if(isset($request->paybtn)){
            $order = new Orders();
            $order->user_id     = $user->id;
            $order->total       = $request->paymenttotal;
            $tygia              = 24000;
            $order->currency    = 'USD';
            $order->save(); 

            switch ($request->paymenttype) {
                case 'Paypal':
                    $payer = new Payer();
                    $payer->setPaymentMethod("PayPal");
                    // Set redirect URLs
                    $redirectUrls = new RedirectUrls();
                    $redirectUrls->setReturnUrl( url('/').'/member/payment-success/'.$order->id )
                                ->setCancelUrl( url('/').'/member/payment-cancel/'.$order->id );
                    
                    $cart       = session()->get('cart');
                    $product    = array();
                    $setSubtotal    =   0;
                    $setTotal       =   0;
                    $setShipping    =   2;
                    $setTax         =   2;
                    
                    if($user->template_id){
                        $setSubtotal    +=  round($user->template->price/24000 , 2);  
                        //$setSubtotal    += 10;
                        $product[]  = [
                            'name'      => $user->template->title,
                            'price'     =>  round( $user->template->price/24000, 2),
                            'currency'  =>'USD',
                            'quantity'  => 1,
                            'sku'       => $user->template->id
                        ];
                    }
                    if($user->package_id){
                        $setSubtotal    +=   round($user->package->price/24000 ,2) ;
                        //$setSubtotal    += 8;
                        $product[]  = [
                            'name'      => $user->package->title,
                            'price'     =>  round( $user->package->price/24000, 2),
                            'currency'  =>'USD', 
                            'quantity'  => 1,
                            'sku'       => $user->package->id
                        ];
                    }

                    $setTotal       =   $setSubtotal + $setTax + $setShipping;
                    
                    //echo "setTotal:".$setTotal;echo "<pre>";print_r($product);die('');



                    $details        = new Details();
                    $details->setShipping($setShipping)->setTax($setTax)->setSubtotal($setSubtotal);
                    $amount         = new Amount();
                    $amount->setCurrency("USD")->setTotal($setTotal)->setDetails($details);            
                    $itemList       = new ItemList();
                    $itemList->setItems( $product );
                    $transaction = new Transaction();
                    $transaction->setAmount($amount)
                                ->setDescription("thanh toan goi website va giao dien web cho brandviet")
                                ->setItemList($itemList)
                                ->setInvoiceNumber(uniqid());
                    $payment = new Payment();
                    $payment->setIntent('sale')->setPayer($payer)->setRedirectUrls($redirectUrls)->setTransactions(array($transaction));
                    //----------------------------------
                    $clientId = 'AVmu5EItIs2ky1qQ3aeolxM6NfVNjOmmx1lmzpKDi5xVCOXmd_AL4YmOzHGrv2WqGi_RfHg3dMLCh9NL';
                    $clientSecret = 'EPTLTn5COD4L-l3Zk3c7tzHmYtad_zoWdZ6z4Y0Vp85sX5l6--359W_zZbsjeWZ4UsUZm79mrVyFQ10v';
                    $apiContext = new ApiContext(
                        new OAuthTokenCredential(
                            $clientId,
                            $clientSecret
                        )
                    );
                    /*
                        make login form paypal contact
                    */
                    try {
                        $payment->create($apiContext);
                        $approvalUrl = $payment->getApprovalLink();// Redirect the customer to $approvalUrl

                    } catch (PayPal\Exception\PayPalConnectionException $ex) {
                        echo $ex->getCode();
                        echo $ex->getData();
                        die($ex);
                    } catch (Exception $ex) {
                        die($ex);
                    }
                    /*
                        return and show form paypal contact
                    */
                    return redirect($approvalUrl);
                    break;
                case 'ATM':
                    # code...
                    break;
                case 'ZaloPay':
                    # code...
                    break;
                case 'MoMo':
                    # code...
                    break;
                case 'Payoo':
                    # code...
                    break;                    
                default:
                    # code...
                    break;
            }
             
            
        }
        

    } 
    
    public function accountsetting(){ 
        return view('fontend.Member.accountsetting',['data'=> Auth::user() ]);
    }
    public function accountsetting_store(Request $request){ 
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
    public function package_store (Request $request){  
        $user       = Auth::user();
        $user->package_id = $request->package_id;
        $user->save();
        return redirect()->route('fontend.packagelist')->with(['messenge'=>'Cập nhật thành công!!!']); 
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
        $user       = Auth::user();
        $user->template_id = $request->template_id;
        $user->save();
        return redirect()->route('fontend.templatelist')->with(['messenge'=>'Cập nhật thành công!!!']); 
    }
    public function template_details_store(Request $request)
    {
        $slug       = $request->slug;
        $template   = Template::where('slug', $slug)->firstOrFail();
        $user       = Auth::user();
        $user->template_id = $template->id;
        $user->save();
        return redirect()->route('fontend.templatelist')->with(['messenge'=>'Cập nhật thành công!!!']); 
    }

    



}
