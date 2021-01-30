<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use DB;
use App\Products;
use App\Orders;
use App\Ordersdetail;

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

use Illuminate\Http\Request;

use Mail;
use App\Mail\sendorder;

class PayPalsdkController extends Controller
{    
    public function paymentHandle($id, Request $request) // payWithpaypal
    {
        if (Auth::check()) {
            $user       = Auth::user();
            $order      = Orders::find($id);
            $currency   = 'USD';
            $order->user_id = $user->id;
            $order->recept_name     = $request->recept_name;
            $order->recept_phone    = $request->recept_phone;
            $order->recept_address  = $request->recept_address;
            $order->recept_email    = $request->recept_email;
            $order->recept_note     = $request->recept_note;
            $order->shipping        = $request->shipping;
            $order->currency        = $currency;            
            $order->save();
            
            if(isset($request->ordermaker)){
                // cap nhat thanh cong va gui don hang qua email
                $details    = DB::table('orders_detail')
                        ->join( 'products', 'products.id', 'orders_detail.product_id') 
                        ->select( 'orders_detail.*', 'products.photo','products.title')
                        ->where( 'order_id', '=', $request->id )
                        ->get();
                Mail::to($user->email)->send(new sendorder(  ($details), $order ));
                $cart = session()->get('cart');
                if(isset($cart)) { 
                    unset($cart);
                    session()->put('cart', '');
                }
                return redirect()->route('fontent.userorders')->with(['messenge'=>"Gửi đơn hàng thành công"]);


            }elseif(isset($request->pay)){
                
                // thuc hien thanh toan qua paypal
                $payer = new Payer();
                $payer->setPaymentMethod("PayPal");
                // Set redirect URLs
                $redirectUrls = new RedirectUrls();
                $redirectUrls->setReturnUrl('http://xetai.club/payment-success/'.$id)
                            ->setCancelUrl('http://xetai.club/payment-cancel/'.$id);
                $cart       = session()->get('cart');
                $product    = array();
                $setSubtotal    =   0;
                $setTotal       =   0;
                $setShipping    =   2;
                $setTax         =   2;
                if($cart){
                    foreach($cart as $product_id => $prouct_info){                
                        $setSubtotal    += $prouct_info['quantity'] * $prouct_info['price'] ;
                        $product[]  = [
                            'name'  => $prouct_info['name'],
                            'price' => $prouct_info['price'],
                            'currency'  =>'USD',
                            'quantity'  => $prouct_info['quantity'],
                            'sku'   => $product_id
                        ];
                    }
                }else{
                    $details    = DB::table('orders_detail')
                        ->join( 'products', 'products.id', 'orders_detail.product_id') 
                        ->select( 'orders_detail.*', 'products.photo','products.title')
                        ->where( 'order_id', '=', $request->id )
                        ->get();
                    foreach($details as $prouct_info){
                        $setSubtotal    += $prouct_info->quantity * $prouct_info->price ;
                        $product[]  = [
                            'name'  => $prouct_info->title,
                            'price' => $prouct_info->price,
                            'currency'  =>'USD',
                            'quantity'  => $prouct_info->quantity,
                            'sku'   => $prouct_info->id
                        ];   
                    }
                }
                $setTotal       =   $setSubtotal + $setTax + $setShipping;
                $details        = new Details();
                $details->setShipping($setShipping)->setTax($setTax)->setSubtotal($setSubtotal);
                $amount         = new Amount();
                $amount->setCurrency("USD")->setTotal($setTotal)->setDetails($details);            
                $itemList       = new ItemList();
                $itemList->setItems( $product );
                $transaction = new Transaction();
                $transaction->setAmount($amount)
                            ->setDescription("Payment description")
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
            }
        }
    }
    //---- cancel paypal function 
    public function paymentCancel($id)
    {
        dd('Your payment has been declend. The payment cancelation page goes here!');
    }
    //------ payment successful
    public function paymentSuccess($id, Request $request)
    {
        $clientId = 'AVmu5EItIs2ky1qQ3aeolxM6NfVNjOmmx1lmzpKDi5xVCOXmd_AL4YmOzHGrv2WqGi_RfHg3dMLCh9NL';
        $clientSecret = 'EPTLTn5COD4L-l3Zk3c7tzHmYtad_zoWdZ6z4Y0Vp85sX5l6--359W_zZbsjeWZ4UsUZm79mrVyFQ10v';
        $apiContext = new ApiContext(
            new OAuthTokenCredential(
                $clientId,
                $clientSecret
            )
        );
        $paymentId  = $_GET['paymentId'];
        $token      = $request->get('token');
        $payerId    = $request->get('PayerID');
        $payment    = Payment::get($paymentId, $apiContext);
        //  Execute payment with payer ID
        $execution = new PaymentExecution();
        $execution->setPayerId($payerId);
        try {   //  Execute payment
            $result = $payment->execute($execution, $apiContext);
                //  echo "<pre>";var_dump($result);echo "</pre>";
        } catch (PayPal\Exception\PayPalConnectionException $ex) {
            echo $ex->getCode();
            echo $ex->getData();
            die($ex);
        } catch (Exception $ex) {
            die($ex);
        }
        //--------------------------- tranfer ok
        if($result->getState() == 'approved'){
            $transactions = $result->getTransactions();
            $transaction = $transactions[0];
            $payee  = $transaction->payee;
            
            $listitems = $payment->transactions[0]->item_list;
            $Prolist = array();
            foreach ($listitems->items as $key => $value) {
                $Prolist[$value->sku]['paypal']  = $value;
                $Prolist[$value->sku]['product']  = Products::find($value->sku);
            }
            $shipping_address = $payment->transactions[0]->item_list->shipping_address;
            
            /*  
                store paypal transaction and match invoice_payment_status is paied.
            */
            $order = Orders::find($id);
            $order->paystatus   =   'paied';
            $order->payment     =   'PayPal';
            $order->payerId     =   $payerId;
            $order->paymentId   =   $paymentId;
            $order->datepay     =   date('Y-m-d');
            $order->invoice_id  =   $transaction->invoice_number;
            $order->save();
            $cart = session()->get('cart');
            if(isset($cart)) { 
                unset($cart);
                session()->put('cart', '');
            }
            
            $shipping_address = $payment->transactions[0]->item_list->shipping_address;
            $sale_info  = $payment->transactions[0]->related_resources[0]->sale;
            $amount     =   $sale_info->amount;

            // send email tranfer successfull
            

            //echo 'approved';
            return view('fontend.Order.paypal-tranfer-successful',[
                    'order'         =>  $order,
                    'data'          =>  $Prolist,
                    'invoice_number'=>  $transaction->invoice_number,
                    'paymentId'     =>  $paymentId,
                    'payerId'       =>  $payerId,
                    'payment'       =>  'PayPal',
                    'shipping'      =>  $shipping_address,
                    'datepay'       =>  date('Y-m-d'),
                    'amount'        =>  $amount
                ]);
        } 
        //----------------------- tranfer not ok ---
        // return redirect()->route(   'payment.PayPacancel'   );
    }

}