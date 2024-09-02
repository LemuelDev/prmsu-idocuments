<?php

namespace App\Http\Controllers;

use App\Mail\WelcomeEmail;
use App\Models\Courses;
use App\Models\User;
use App\Models\UserProfile;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
      //

      public function register(){

        $courses = Courses::orderBy('courses', 'asc' )->get();

        return view ("shared.signup", [
            "courses" => $courses
        ]);
    }

    public function login(){
        return view ("shared.login");
    }
    public function store() {

        $requiredFields = ['lastname', 'firstname', 'email', 'username', 'password', 'course', 'sex', 'birthday', 'address', 'year' , 'phone_number'];
    
        foreach ($requiredFields as $field) {
            if (empty(request($field))) {
                return back()->withErrors(['general' => 'All fields must be filled up.'])->withInput();
            }
        }
        
        $validated = request()->validate([
            "lastname" => "required|string|max:40",
            "firstname" => "required|string|max:40",
            "middlename" => "nullable|string|max:40",
            "extensionname" => "nullable|string|max:40",
            "email" => "required|email",
            "username" => "required|max:40",
            "sex" => "required",
            "course" => "required",
            "year" => "required",
            "phone_number" => "required",
            "address" => "required",
            "birthday" => "required",
            "password" => [
                'required',
                'string',
                'min:8',
                'regex:/[a-z]/', // must contain at least one lowercase letter
                'regex:/[A-Z]/', // must contain at least one uppercase letter
                'regex:/[0-9]/', // must contain at least one number
                'regex:/[@$!%*?&#]/' // must contain a special character
            ],
        ], [
            'password.regex' => 'Password must contain at least one lowercase letter, one uppercase letter, one number, and one special character.'
        ]);

        // Check if email already exists in users table
        

    
        $name = $validated["firstname"];
        if (!empty($validated["middlename"])) {
            $name .= ' ' . $validated["middlename"];
        }
        $name .= ' ' . $validated["lastname"];
        if (!empty($validated["extensionname"])) {
            $name .= ' ' . $validated["extensionname"];
        }

          // Calculate the age using Carbon
        $age = Carbon::parse($validated['birthday'])->age;
        
        // Create the user profile
        $userProfile = UserProfile::create([
            "firstname" => $validated["firstname"],
            "middlename" => $validated["middlename"],
            "lastname" => $validated["lastname"],
            "extensionname" => $validated["extensionname"],
            "name" => $name,
            "email" => $validated["email"],
            "age" => $age,
            "course" => $validated["course"],
            "sex" => $validated["sex"],
            "address" => $validated["address"],
            "birthday" => $validated["birthday"],
            "year" => $validated["year"],
            "phone_number" => $validated["phone_number"],
            "avatar" => "avatar.png"
        ]);
    
        // Create the user and associate it with the user profile
        User::create([
            "username" => $validated["username"],
            "password" => Hash::make($validated["password"]),
            "userprofile_id" => $userProfile->id 
        ]);
    
        session()->put('email', $validated['email']);
    
        // Send email notification
        $message = "Thanks for Signing up! Your Account is still for approval. We will contact you once your account is approved and ready to use.";
        Mail::to($validated["email"])->send(new WelcomeEmail(
            $message, 
            $name, // Use concatenated name here
            $validated["username"], 
            $validated["email"], 
            $age,
            $validated["course"],
            $validated["year"],
            $validated["sex"],
            $validated["address"],
            $validated["birthday"],
            $validated["phone_number"],

        ));
    
        return redirect()->route("confirmation");
    }
    
    

    public function authenticate(){
        
        $validated = request()->validate([
            'username' => 'required',
            'password' => 'required',
        ], [
            'required' => 'All fields must be filled up', // Custom message for required fields
        ]);

         if (auth()->attempt($validated)){
        
            // $user = auth()->user()->load('userProfile');
            // dd($user, $user->userProfile); 
            $user = auth()->user();
            if ($user->userProfile->isPending == 'pending'){

                return redirect()->route("login")->with('failed', 'Your account is still for approval.');
            }else if ($user->userProfile->user_status == 'disabled'){
                
                return redirect()->route("login")->with('failed', 'Your account is disabled.');
            }else {

                request()->session()->regenerate();

                if ($user->userProfile->user_type === 'admin') {
                         
                    return redirect()->route('admin.dashboard');
                } else {
                    return redirect()->route('student.dashboard');
                }
            }

        }else {
                    // Check if the username exists in the database
                $usernameExists = User::where('username', request('username'))->exists();

                if ($usernameExists) {
                    // If username exists but password is wrong
                    return redirect()->route("login")->withErrors([
                        "password" => "Incorrect password. Please try again."
                    ])->withInput(request()->only('username'));
                } else {
                    // If username doesn't exist
                    return redirect()->route("login")->withErrors([
                        "username" => "Invalid login credentials. Please try again."
                    ]);
                }
        }
        
    }

    public function logout(){
        auth()->logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();
        
        return redirect()->route("login")->with("success","Logout Successfully");
    }


    public function destroy(User $user) {
        
        $user->userProfile()->delete();
        $user->delete();

        // route

    }

    public function confirmation() {
        return view('shared.confirmation');
    }


    

}
