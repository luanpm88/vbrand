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
    public function index()
    {
        $user = User::first();
        $messenger = new Messenger($user->getData()['facebook']['authResponse']['accessToken']);

        // broadcast need user log in
        \Auth::login($user);

        // check facebook connect state
        if(!$messenger->accessToken) {
            return rediect()->action('Client\MessageController@connect');
        }
        
        // FIND ALL PAGES / ACCOUNTS
        $page = $messenger->getPages()[0];
        $page->fetchData();

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
        $user = User::first();

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
        $user = User::first();
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
        $user = User::first();
        $messenger = new Messenger($user->getData()['facebook']['authResponse']['accessToken']);

        // FIND ALL PAGES / ACCOUNTS
        $pages = $messenger->getPages();

        // GET ALL CONVERSATIONS OF A PAGE
        $conversation = $pages[0]->getConversation($request->id);

        // GET ALL MESSAGES OF A CONVERSATION
        $messages = $conversation ->getMessages();

        return response()->json([
            'conversation' => $conversation,
            'messages' => $messages,
        ]);
    }
}