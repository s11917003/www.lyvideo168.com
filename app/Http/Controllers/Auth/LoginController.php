<?php

namespace App\Http\Controllers\Auth;
use Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //protected $redirectTo = '/home';
/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('auth.login'); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function loggedIn(Request $request){
   
    $input = Request::all();
    if (Auth::viaRemember())
    {
        $user = Auth::guard('web')->User();
        //    // $user->generateToken();
        return Redirect::intended('/');
    }

    $rules = ['email'=>'required|email',
              'password'=>'required'
              ];
 
    $validator = Validator::make($input, $rules);

    $remember =false;
    if( array_key_exists('remember',$input)){
        $remember =true;
    }
   

    if ($validator->passes()) {  
        if (Auth::attempt(['email' => $input['email'],'password' => $input['password']],$remember)) {
            $user = Auth::guard('web')->User();
        //    // $user->generateToken();
            return Redirect::intended('/');
        }

        return Redirect::to('login')
        ->with('success',  'Email or password is wrong!');
    }
 
    //fails
    return Redirect::to('login')
                ->withErrors($validator)
                ->withInput(Request::except('password'));
       // return "logged in";
    }
    public function Home(){
        return view('homeIndex');
    }
    public function logOut(){
        // $user = Auth::guard('api')->user();

        // if ($user) {
        //     $user->api_token = null;
        //     $user->save();
        // }
    
        Auth::logout();
       // header("Location:/");	
         return Redirect::to('/')  ;
        // ->with('success',  'log out');;
    }
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
