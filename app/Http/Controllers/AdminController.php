<?php

namespace App\Http\Controllers;

use App\Models\RequestedDocument;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    
    public function index() {
       return  view('admin.dashboard');
    }

    
    public function updatePassword() {
        return view('admin.updatePassword');
    }

    public function changePassword(User $student) {
        // Validate the request inputs
        $validated = request()->validate([
            "current_password" => "required|min:8",
            "new_password" => [
                'required',
                'string',
                'min:8',
                'confirmed',
                'regex:/[a-z]/', // must contain at least one lowercase letter
                'regex:/[A-Z]/', // must contain at least one uppercase letter
                'regex:/[0-9]/', // must contain at least one number
                'regex:/[@$!%*?&#]/' // must contain a special character
            ],
        ], [
            'new_password.regex' => 'Password must contain at least one lowercase letter, one uppercase letter, one number, and one special character.'
        ]);
        
        // Check if the old password matches the current password
        if (!Hash::check($validated["current_password"], $student->password)) {
            // Redirect back with an error if the current password does not match
            return redirect()->back()->with('failed', "Your current password is incorrect.");
        };
        
        // Update the user's password
        $student->update([
            "password" => Hash::make($validated["new_password"])
        ]);

        return redirect()->route('admin.profile')->with("success", "Password updated successfully");
    }

    public function trackRequest(RequestedDocument $document) {
        
        return view("admin.trackRequest", [
            "requestDocument" => $document,
            
        ]);
    }

    
    public function deleteRequest(RequestedDocument $document) {
        
        $document->delete();
        
        return redirect()->route('admin.listOfRequestForms')->with('success', "Deleted Successfully");
    }

    public function rejectRequest(RequestedDocument $document) {
        $document->update([
            "status" => "rejected"
        ]);
        
        return redirect()->route('admin.listOfRequestForms')->with('success', "The request is rejected");
    }

    public function approveRequest(RequestedDocument $document) {

        $document->update([
            "status" => "completed"
        ]);
        
        return redirect()->route('admin.listOfRequestForms')->with('success', "The request is approved!");
    }

    public function approve(UserProfile $user){
        $user->isPending = 'approved'; // Set the attribute directly
        $user->save(); 

        return redirect()->route("admin.approvals")->with("success", "Approved Successfully!");
    }

    public function enable(UserProfile $user){
        $user->user_status = 'enable'; // Set the attribute directly
        $user->save(); 

        return redirect()->route("admin.activeUsers")->with("success", "Enabled Successfully!");
    }

    public function disable(UserProfile $user){
        $user->user_status = 'disabled'; 
        $user->save(); 

        return redirect()->route("admin.activeUsers")->with("success", "Disabled Successfully!");
    }

    public function profile() {
        return  view('admin.profile');
    }

    public function editProfile() {

        $editing = true;
        return  view('admin.profile', compact("editing"));
    }

    
    public function updateProfile(User $student) {
        
        $requiredFields = ['name', 'email', 'username', 'age', 'course', 'sex', 'birthday', 'address'];
        
        foreach ($requiredFields as $field) {
            if (empty(request($field))) {
                return back()->withErrors(['general' => 'All fields must be filled up.']);
            }
        }

        $validated = request()->validate([
            "name" => "nullable|string|max:40",
            "email" => "required|email",
            "username" => "required|max:40",
            "sex" => "required",
            "age" => "required",
            "course" => "required",
            "address" => "required",
            "birthday" => "required",
        ]);

        $student->userProfile()->update([
            "name" => $validated["name"],
            "email" => $validated["email"],
            "age" => $validated["age"],
            "course" => $validated["course"],
            "sex" => $validated["sex"],
            "address" => $validated["address"],
            "birthday" => $validated["birthday"],
        ]);

        $student->update([
            "username" => $validated["username"],
        ]); 

        return redirect()->route('admin.profile')->with("success", "Profile updated successfully");
       
    }


    public function listOfRequestForms() {

        $requestForms = RequestedDocument::orderBy('created_at', 'desc')
        ->whereIn('status', ['pending','for deletion']);

        if (request()->has('search')) {
            $searchQuery = request()->get('search');
            $requestForms->where('requested_document', 'like', '%' . $searchQuery . '%');
        }
            

        return view('admin.listOfRequestForms', [
            "forms" => $requestForms->paginate(7)
        ]);
    }

    public function approvals() {

        $users = UserProfile::orderBy('created_at', 'desc' )
        ->where('isPending', 'pending');

        if (request()->has('search')) {
            $searchQuery = request()->get('search');
            $users->where('name', 'like', '%' . $searchQuery . '%');
        }

        return  view('admin.approvals',[
            "users" => $users->paginate(7)
        ]);

    }
    public function activeUsers() {
        $users = UserProfile::orderBy('created_at', 'desc' )
        ->where('isPending', 'approved')
        ->whereIn('user_status' ,['enable', 'disabled'])
        ->where('user_type', 'student');

        if (request()->has('search')) {
            $searchQuery = request()->get('search');
            $users->where('name', 'like', '%' . $searchQuery . '%');
        }

        return  view('admin.activeUsers',[
            "users" => $users->paginate(7)
        ]);
    }

    public function requestLogs() {
        $requestForms = RequestedDocument::orderBy('created_at', 'desc')
        ->whereIn('status', ['completed', 'rejected', 'for deletion']);
        
        if (request()->has('search')) {
            $searchQuery = request()->get('search');
            $requestForms->where('requested_document', 'like', '%' . $searchQuery . '%');
        }
        

        return  view('admin.requestLogs',[
            "forms" => $requestForms->paginate(7)
        ]);
    }

    public function manageDigitalForms() {
        return  view('admin.profile');
    }
}
