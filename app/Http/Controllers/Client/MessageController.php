<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Library\Facebook\Messenger;
use App\Models\Contact;
use App\Models\CustomerOrder;

class MessageController extends Controller
{
    /**
     * Facebook messaging main page. 
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        \Auth::login(User::first());
        $user = $request->user();

        try {
            $messenger = new Messenger($user->getData()['facebook']['authResponse']['accessToken']);
        } catch(\Facebook\Exceptions\FacebookResponseException $e) {
            $request->session()->flash('error', $e->getMessage());
            return redirect()->action('Client\MessageController@connect');
        }
        
        // broadcast need user log in
        \Auth::login($user);

        // check facebook connect state
        if(!$messenger->accessToken) {
            return rediect()->action('Client\MessageController@connect');
        }
        
        // FIND ALL PAGES / ACCOUNTS
        $page = $messenger->getPages()[0];
        $page->fetchData();
        $page->subscribeHooks();

        // // GET ALL CONVERSATIONS OF A PAGE
        // $conversations = $pages[0]->getConversations();   

        // // GET ALL MESSAGES OF A CONVERSATION
        // $messages = $conversations[0]->getMessages();

        return view('client.messages.index', [
            'page' => $page,
        ]);
    }

    /**
     * Facebook login/connect. 
     *
     * @return \Illuminate\Http\Response
     */
    public function connect()
    {
        $messenger = new Messenger();

        return view('client.messages.connect', [
            'messenger' => $messenger,
        ]);
    }
    
    /**
     * Save facebook token. 
     *
     * @return \Illuminate\Http\Response
     */
    public function saveToken(Request $request)
    {
        $user = $request->user();

        $user->updateData([
            'facebook' => $request->data
        ]);
    }
    
    /**
     * get conversations. 
     *
     * @return \Illuminate\Http\Response
     */
    public function getConversations(Request $request)
    {
        // find user
        $user = $request->user();

        // @todo Get first page of user for test
        $page = $user->messenger()->getPages()[0];

        return response()->json($page->getConversations());
    }

    /**
     * get conversation. 
     *
     * @return \Illuminate\Http\Response
     */
    public function getConversation(Request $request)
    {
        // find user
        $user = $request->user();

        // @todo Get first page of user for test
        $page = $user->messenger()->getPages()[0];

        // GET ALL CONVERSATIONS OF A PAGE
        $conversation = $page->getConversation($request->id);

        return response()->json([
            'conversation' => $conversation,
            'messages' => $conversation->getMessages(),
        ]);
    }
    
    /**
     * messenger. 
     *
     * @return \Illuminate\Http\Response
     */
    public function webhooks(Request $request)
    {
        var_dump($request->all());

        // call events
        event(new \App\Events\MessengerNotification('notification', $request->all()));
    }

    /**
     * send message. 
     *
     * @return \Illuminate\Http\Response
     */
    public function sendMessage(Request $request)
    {
        // find user
        $user = $request->user();

        // @todo Get first page of user for test
        $page = $user->messenger()->getPages()[0];

        // Find conversation
        $conversation = $page->getConversation($request->to);

        // send message
        $result = $page->sendMessage($conversation->to, $request->message);

        // get message
        $message = $user->messenger()->makeRequest([
            'path' => '/' . $result['message_id'] . '?fields=message,from,to',
            'token' => $page->accessToken,
        ]);

        event(new \App\Events\MessengerNotification('notification', [
            'message' => [
                'text' => $message['message'],
            ],
            'sender' => [
                'id' => $message['from']['id'],
            ],
            'recipient' => [
                'id' => $message['to'][0]['id'],
            ],
        ]));
    }

    /**
     * Right bar. 
     *
     * @return \Illuminate\Http\Response
     */
    public function rightbar(Request $request)
    {
        // find user
        $user = $request->user();

        // @todo Get first page of user for test
        $page = $user->messenger()->getPages()[0];

        // Find conversation
        $conversation = $page->getConversation($request->conversationId);

        // Contact
        $contact = Contact::findByConversation($conversation);

        // First order
        $order = $contact->getCustomerOrder();

        return view('client.messages.rightbar', [
            'contact' => $contact,
            'order' => $order,
        ]);
    }

    /**
     * Save contact info. 
     *
     * @return \Illuminate\Http\Response
     */
    public function contactSave(Request $request, $id)
    {
        // find contact
        $contact = Contact::find($id);

        // update contact
        $contact->update($request->all());
        $contact->status = Contact::STATUS_MODIFIED;
        $contact->save();

        return response()->json(array_merge($contact->toArray(), [
            'status' => $contact->getStatus(),
        ]));
    }

    /**
     * Contact order. 
     *
     * @return \Illuminate\Http\Response
     */
    public function customerOrder(Request $request, $id)
    {
        // find contact
        $contact = Contact::find($id);

        // first order
        $order = $contact->getCustomerOrder();

        return view('client.messages.customerOrder', [
            'contact' => $contact,
            'order' => $order,
        ]);
    }

    /**
     * Add product. 
     *
     * @return \Illuminate\Http\Response
     */
    public function addProduct(Request $request, $order_id)
    {
        // find order
        $order = CustomerOrder::find($order_id);

        // add product
        $order->addProduct($request->product_id);
    }
    
    /**
     * Update product quantity. 
     *
     * @return \Illuminate\Http\Response
     */
    public function updateQuantity(Request $request, $order_id)
    {
        // find order
        $order = CustomerOrder::find($order_id);

        // update detail quantity
        $order->updateQuantity($request->detail_id, $request->quantity);
    }

    /**
     * Shipping fee table 
     *
     * @return \Illuminate\Http\Response
     */
    public function shippingFee(Request $request, $order_id)
    {
        // find order
        $order = CustomerOrder::find($order_id);

        // ward
        if ($request->ward_id) {
            $to_ward_code = \App\Models\Ward::find($request->ward_id)->ghn_id;
        } else {
            $to_ward_code = null;
        }

        // district
        if ($request->district_id) {
            $to_district_id = \App\Models\District::find($request->district_id)->ghn_id;
        } else {
            $to_district_id = null;
        }

        $service = new \App\Library\GHN\Service();
        $fee = $service->getFee([
            "to_district_id" => (int) $to_district_id,
            "to_ward_code" => (string) $to_ward_code,
        ])['data'];

        return view('client.messages.shippingFee', [
            'fee' => $fee,
        ]);
    }
}