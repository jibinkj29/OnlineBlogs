<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Yajra\DataTables\DataTables;
use Carbon\Carbon; 
use Mail; 
use Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except([
            'logout', 'dashboard','profile','profileEdit','profileUpdate'
        ]);
        $this->middleware('auth')->only('logout', 'dashboard','profile','profileEdit','profileUpdate');
        $this->middleware('verified')->only('dashboard','profile','profileEdit','profileUpdate');  
    }

    public function index()
    {

        return view('user.login');
    }

    public function showRegistrationForm()
    {

        return view('user.register');
    }
    

    public function login(Request $request)
    {

      
        $validatedData = $request->validate([
                      'username'      => 'required|min:1|max:256', 
                      'password'       => 'required|min:1|max:256'
        ]);
        
        $input = ([
            'email'      => request('username'), 
            'password'       => request('password')
        ]);
      //  dd($input);

        if(Auth::guard('web')->attempt($input)){
 
        return redirect()->route('user.dashboard');

        }else{
            return redirect()->route('user.index')->with('error', 'Error.');
            
        }
       
       

    }


    
    public function register(Request $request)
    {
       
        $validatedData = $request->validate([
            'username' => 'required|min:1|max:256',
            'email' => 'required|email|unique:users|min:1|max:255', 
            'password' => 'required|min:3|max:256', 
        ]);
    
       
        $user = User::create([
            'name' => $validatedData['username'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
        ]);
    
       
        event(new Registered($user));


    return redirect()->route('user.index')->with('success', 'Registration successful. Please check your email to verify your account.'); 
  }

public function showForgetPasswordForm()
      {
         return view('user.forgetPassword');
      }
  
      /**
       * Write code on Method
       *
       * @return response()
       */
      public function submitForgetPasswordForm(Request $request)
      {
          $request->validate([
              'email' => 'required|email|exists:users',
          ]);
  
          $token = Str::random(64);
  
          DB::table('password_reset_tokens')->insert([
              'email' => $request->email, 
              'token' => $token, 
              'created_at' => Carbon::now()
            ]);
  
          Mail::send('user.emails.forgetPassword', ['token' => $token], function($message) use($request){
              $message->to($request->email);
              $message->subject('Reset Password');
          });
  
          return back()->with('message', 'We have e-mailed your password reset link!');
      }
      /**
       * Write code on Method
       *
       * @return response()
       */
      public function showResetPasswordForm($token) { 
         return view('user.forgetPasswordLink', ['token' => $token]);
      }
  
      /**
       * Write code on Method
       *
       * @return response()
       */
      public function submitResetPasswordForm(Request $request)
      {
          $request->validate([
              'email' => 'required|email|exists:users',
              'password' => 'required|string|min:3|confirmed',
              'password_confirmation' => 'required'
          ]);
  
          $updatePassword = DB::table('password_reset_tokens')
                              ->where([
                                'email' => $request->email, 
                                'token' => $request->token
                              ])
                              ->first();
  
          if(!$updatePassword){
              return back()->withInput()->with('error', 'Invalid token!');
          }
  
          $user = User::where('email', $request->email)
                      ->update(['password' => Hash::make($request->password)]);
 
          DB::table('password_reset_tokens')->where(['email'=> $request->email])->delete();
  
          return redirect('/')->with('success', 'Your password has been changed!');
      }
    
    public function dashboard(Request $request)
    {

        $user = Auth::user();
        if ($user->hasRole('admin')) {
             
            $category = Category::pluck('name','id')->all();
            $users = User::pluck('name','id')->all();
        } else {
            $users = User::where('id', auth()->id())->get();
            $category = Category::where('user_id', $user->id)->pluck('name', 'id');
        }
       
        if ($request->ajax()) {
            $query = Blog::with('categories');
        
            if ($user->hasRole('admin')) {
               
                if ($request->filled('user')) {
                    $query->where('user_id', $request->input('user'));
                }
            } else {
              
                $query->where('user_id', auth()->id());
            }
        
            if ($request->filled('postname')) {
                $query->where('name', 'like', '%' . $request->input('postname') . '%');
            }
        
            if ($request->filled('category')) {
                $query->whereHas('categories', function ($categoryQuery) use ($request) {
                    $categoryQuery->whereIn('categories.id', $request->input('category'));
                });
            }
        
            return DataTables::of($query)
                ->addIndexColumn()
                ->editColumn('image', function ($row) {
                    return '<img src="' . asset('storage/'.$row->image) . '" alt="Image" width="50" height="50">';
                })
                ->editColumn('content', function ($row) {
                    return $row->content;
                })
                ->addColumn('category', function ($row) {
                    $categories = $row->categories->pluck('name')->implode(', ');
                    return $categories;
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="' . route('blogs.edit', ['blog' => ($row->id)]) . '" class="btn btn-sm btn-icon">Edit</a>';
                    $actionBtn .= '<button class="btn btn-sm btn-icon delete-record" data-id="' . $row->id . '"><i class="ti ti-trash"></i></button>';
                    return $actionBtn;
                })
                ->rawColumns(['image', 'action', 'content', 'category'])
                ->make(true);
        }
        
        return view('user.index', compact('category','users'));
    }

    public function profile(Request $request)
    {
        $user = Auth::user();  
       
        if ($request->ajax()) {
            $query = User::query();
        
            if (!$user->hasRole('admin')) {
                $query->where('id', auth()->id());
            }
        
            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="' . route('user.profileEdit', ['user_id' => $row->id]) . '" class="btn btn-sm btn-icon">Edit</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }


        return view('user.profile');
    }

    public function profileEdit($user_id)
{
// dd("Hi");
    $User = User::where('id', $user_id)->get();

   
    return view('user.profileEdit', compact('User'));
}





public function profileUpdate(Request $request)
{
    $user_id=$request->input('dbid');
    $user = User::where('id', $user_id)->first();   
    $request->validate([
        'name' => 'required|min:3',
        'email' => [
            'required',
            'email',
            Rule::unique('users')->ignore($user_id), 
            'min:1',
            'max:255',
        ],
        'password' => 'nullable|min:6',
    ]);


  
    $userData = [
        'name' => $request->input('name'),
        'email' => $request->input('email'),
    ];

    
    if ($request->filled('password')) {
        $userData['password'] = bcrypt($request->input('password'));
    }

   
    $user->update($userData);

    return response()->json(['status' => true]);
}



    public function logout()
    {      
        Auth::guard('web')->logout();
        return redirect()->route('user.index');
    }

         
     

}
