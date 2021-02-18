<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Library\Facebook\Messenger;

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
        $user = $request->user();
        $messenger = new Messenger($user->getData()['facebook']['authResponse']['accessToken']);

        // FIND ALL PAGES / ACCOUNTS
        $pages = $messenger->getPages();

        // GET ALL CONVERSATIONS OF A PAGE
        $conversations = $pages[0]->getConversations();

        return response()->json($conversations);
    }

    /**
     * get conversation. 
     *
     * @return \Illuminate\Http\Response
     */
    public function getConversation(Request $request)
    {
        $user = $request->user();
        $messenger = new Messenger($user->getData()['facebook']['authResponse']['accessToken']);

        // FIND ALL PAGES / ACCOUNTS
        $pages = $messenger->getPages();

        // GET ALL CONVERSATIONS OF A PAGE
        $conversation = $pages[0]->getConversation($request->id);

        // GET ALL MESSAGES OF A CONVERSATION
        $messages = $conversation->getMessages();

        return response()->json([
            'conversation' => $conversation,
            'messages' => $messages,
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
        $user = $request->user();
        $messenger = new Messenger($user->getData()['facebook']['authResponse']['accessToken']);

        // FIND ALL PAGES / ACCOUNTS
        $page = $messenger->getPages()[0];

        // Find conversation
        $conversation = $page->getConversation($request->to);

        // send message
        $result = $page->sendMessage($conversation->to, $request->message);

        // get message
        $message = $messenger->makeRequest([
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
        $user = $request->user();
        $messenger = new Messenger($user->getData()['facebook']['authResponse']['accessToken']);

        // FIND ALL PAGES / ACCOUNTS
        $page = $messenger->getPages()[0];

        // Find conversation
        $conversation = $page->getConversation($request->conversationId);

        // // send message
        // $result = $page->sendMessage($conversation->to, $request->message);

        // // get message
        // $message = $messenger->makeRequest([
        //     'path' => '/' . $result['message_id'] . '?fields=message,from,to',
        //     'token' => $page->accessToken,
        // ]);

        // event(new \App\Events\MessengerNotification('notification', [
        //     [
        //         'message' => [
        //             'text' => $message['message'],
        //         ],
        //         'sender' => [
        //             'id' => $message['from']['id'],
        //         ],
        //         'recipient' => [
        //             'id' => $message['to'][0]['id'],
        //         ],
        //     ],
        // ]));

        return view('client.messages.rightbar', [
            'messenger' => $messenger,
            'conversation' => $conversation,
        ]);
    }
}