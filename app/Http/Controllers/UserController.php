<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $hidden = [
        'provider_name', 'provider_id', 'password', 'remember_token',
    ];
    
    public function index()
    {
        $users = User::paginate(10); 
        return view('backend.Users.list', ['data'=> $users] );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.Users.add' );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $user = new User();
        $user->name         = $request->name;
        $user->email        = $request->email;
        $user->phone        = isset($request->phone)? $request->phone:  '';
        $user->userId       = isset($request->userId)? $request->userId: '';
        $user->firstName    = isset($request->firstName)? $request->firstName: '';
        $user->lastName     = isset($request->lastName)? $request->lastName: '';
        $user->is_admin     = isset($request->is_admin)? $request->is_admin: 0;
        if(isset($request->password))   $user->password     = Hash::make($request->password); // change password
        if($request->hasFile('avatar')){
            $filename = $request->file('avatar')->getClientOriginalName();
            $request->file('avatar')->move(
                base_path() . '/public/upload/Avatar/', $filename
            );
        }
        $user->save();
        return redirect('backend.listuser')->with(['message'=> 'Successfully Create User!!']);
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);  
        return view('backend.Users.edit',['data'=>$user]);
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
        $user = User::find($id);
        $user->name         = $request->name;
        $user->email        = $request->email;
        $user->phone        = $request->phone;
        $user->userId       = $request->userId;
        $user->firstName    = $request->firstName;
        $user->lastName     = $request->lastName;
        $user->is_admin     = isset($request->is_admin)? $request->is_admin: 0;
        if(isset($request->password)){
            if($request->password != $user->password){
                $user->password   = Hash::make($request->password);
            }            
        }
        if($request->hasFile('avatar')){
            $filename = $request->file('avatar')->getClientOriginalName();
            $request->file('avatar')->move(
                base_path() . '/public/upload/Avatar/', $filename
            );
            $user->avatar= $filename;
        }
        $user->save();
        return redirect()->route('backend.listuser')->with(['message'=> 'Successfully Updated User!!']);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete(); 
        return redirect()->route('backend.listuser')->with(['message'=> 'Successfully deleted!!']);
    }
    public function profile(Request $request){
        if (Auth::check()) { 
            $user = Auth::user();
            return view('fontend.user.profile',['data'=>$user]);
        }
    }
    public function update_profile(Request $request)
    {
        if (Auth::check()) { 
            $user = Auth::user();
            $user->name         = $request->name;
            $user->email        = $request->email;
            $user->phone        = $request->phone;
            $user->userId       = $request->userId;
            $user->firstName    = $request->firstName;
            $user->lastName     = $request->lastName;
            if(isset($request->password)){
                if($request->password != $user->password){
                    $user->password   = Hash::make($request->password);
                }            
            }
            if($request->hasFile('avatar')){
                $filename = $request->file('avatar')->getClientOriginalName();
                $request->file('avatar')->move(
                    base_path() . '/public/upload/Avatar/', $filename
                );
                $user->avatar= $filename;
            }
            $user->save();
            return redirect()->route('fontent.profile')->with(['message'=> 'Successfully Updated User!!']);
        }
    } 
    public function dologin(request $request, $next){ 
        $captcha=   $request->captcha; 
        $secret =   '6LfdGe4ZAAAAAPix_09CeJHBG1Thw3Qktgf31Ius';
        $ip     =   $_SERVER['REMOTE_ADDR'];
        $site   =   "https://www.google.com/recaptcha/api/siteverify?";
        $request_param = [
            'secret'    => $secret,
            'response'  => $captcha,
            'remoteip'  => $ip            
        ];
        $response=file_get_contents( $site."secret=".$secret."&response=".$captcha."&remoteip=".$ip );
        $responseKeys = json_decode($response,true);
        
        if(intval($responseKeys['success']) != 1 ){            
            return response()->json([
                    'success'   => 0,
                    'title'     => "Liên hệ chưa thành công",
                    'msg'       => "Xin mời bạn nhập lại thông tin, hoặc liên hệ với chúng tôi theo số Hotline: 0906.6262.17",
                    'data'      => json_encode($responseKeys),
                    'captcha'   => $captcha
                ],404
            );
        }
        $request->validate([
            'email'      =>'require',
            'password'  =>'require']
        );
        $credential =   $request->except(['_token']);
        $user = new User(); 
        $user->name         = $request->name;
        $user->email        = $request->email;
        $user->phone        = $request->phone;
        $user->password     = $request->name;
        //  $user->token    = $request->token;
        $user->save();
        Auth::login($user, true);
        /*
            check status account
        */
        return redirect()->route('login')->with(['messenge'=>trim($step1->message)]);
               
    }
    public function reg_register(request $request)
    {
        $captcha=   $request->captcha; 
        $secret =   '6LfdGe4ZAAAAAPix_09CeJHBG1Thw3Qktgf31Ius';
        $ip     =   $_SERVER['REMOTE_ADDR'];
        $site   =   "https://www.google.com/recaptcha/api/siteverify?";
        $request_param = [
            'secret'    => $secret,
            'response'  => $captcha,
            'remoteip'  => $ip            
        ];
        $response=file_get_contents( $site."secret=".$secret."&response=".$captcha."&remoteip=".$ip );
        $responseKeys = json_decode($response,true);
        
        if(intval($responseKeys['success']) != 1 ){            
            return response()->json([
                    'success'   => 0,
                    'title'     => "Liên hệ chưa thành công",
                    'msg'       => "Xin mời bạn nhập lại thông tin, hoặc liên hệ với chúng tôi theo số Hotline: 0906.6262.17",
                    'data'      => json_encode($responseKeys),
                    'captcha'   => $captcha
                ],404
            );
        }
        $user = new User();
        $user->name         = $request->name;
        $user->email        = $request->email;
        $user->phone        = isset($request->phone)? $request->phone:  ''; 
        $user->firstName    = isset($request->fname)? $request->fname: '';        
        $user->is_admin     = isset($request->is_admin)? $request->is_admin: 0;
        if(isset($request->password))   $user->password     = Hash::make($request->password);  
        $user->save();
        Auth::login($user, true);
        return redirect()->back()->with(['messenge'=>'Register Successfully']);
        //return view('fontend.user.register')->with(['messenge'=>trim($step1->message)]);
    }
    

    /*
        registration
    */
    public function register_show_1()
    {
        return view('fontend.user.register');
    }
    public function _register_1(request $request){
        /*
            check validate infomation
        */
        $url    =   '/user/registration';
        $request_param = [
                    'userId'    => "",
                    'email'             => $request->email,
                    'firstName'         => $request->name,
                    'lastName'          => $request->lastname,
                    'phoneNumber'       => $request->phone,
                    'password'          => $request->password,
                    'confirmPassword'   => $request->passwordconfirm,
                    'token'     =>''
                ];
        session()->put('profile', $request_param);
        $data = $this->send_request($url, $request_param);
        if($data){
            if(isset($data->result)){
                if($data->result==1){
                    session()->put('user_reponse_1', $data->data);
                    return redirect()->route('fontent.reg_step2')->with(['messenge'=> $data->message,'data'=>$data]);
                }
            }else{
                echo "<pre>";print_r($data);
                echo "statusCode:".$data->statusCode;
                if(isset($data->statusCode)){

                    return redirect()->route('fontent.reg_step1')->with(['messenge'=> $data->statusCode]);
                }
            }
        }
    }

    public function forget_password(){
        return view('fontend.user.email');
    }

}