<?php

namespace App\Http\Controllers;

use App\Models\RequestedDocument;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{

    public function index() {
       return  view('student.dashboard');
    }

    public function profile() {
        return  view('student.profile');
    }

    public function editProfile() {

        $editing = true;
        return  view('student.profile', compact("editing"));
    }

    public function updateProfile(User $student) {
        
        $requiredFields = ['name', 'email', 'username', 'age', 'course', 'sex', 'birthday', 'address', 'year', 'phone_number'];
        
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
            "year" => "required",
            "phone_number" => "required",
        ]);

        $student->userProfile()->update([
            "name" => $validated["name"],
            "email" => $validated["email"],
            "age" => $validated["age"],
            "course" => $validated["course"],
            "sex" => $validated["sex"],
            "address" => $validated["address"],
            "birthday" => $validated["birthday"],
            "year" => $validated["year"],
            "phone_number" => $validated["phone_number"],
        ]);

        $student->update([
            "username" => $validated["username"],
        ]); 

        return redirect()->route('student.profile')->with("success", "Profile updated successfully");
       
    }



    public function listOfRequestForms() {

        $requestForms = RequestedDocument::orderBy('created_at', 'desc')
        ->where('userprofile_id', auth()->user()->userProfile->id)
        ->where('status', 'pending');

        if (request()->has('search')) {
            $searchQuery = request()->get('search');
            $requestForms->where('requested_document', 'like', '%' . $searchQuery . '%');
        }
        

        return view('student.listOfRequestForms', [
            "forms" => $requestForms->paginate(7)
        ]);
    }

    public function historyOfRequest() {
        
        $requestForms = RequestedDocument::orderBy('created_at', 'desc')
        ->where('userprofile_id', auth()->user()->userProfile->id)
        ->whereIn('status', ['completed', 'rejected', 'for deletion']);
        
        if (request()->has('search')) {
            $searchQuery = request()->get('search');
            $requestForms->where('requested_document', 'like', '%' . $searchQuery . '%');
        }
        
        
        return  view('student.historyOfRequest',[
            "forms" => $requestForms->paginate(7)
        ]);
    }

    public function allRequest()
    {
        return $this->historyOfRequest();
    }

    public function lastTwoWeeks()
    {
        $requestForms = $this->historyOfRequestQuery()
            ->where('created_at', '>=', now()->subDays(14));

        return view('student.historyOfRequest', [
            "forms" => $requestForms->paginate(7)
        ]);
    }

    public function lastMonth()
    {
        $requestForms = $this->historyOfRequestQuery()
            ->where('created_at', '>=', now()->subMonth());

        return view('student.historyOfRequest', [
            "forms" => $requestForms->paginate(7)
        ]);
    }

    public function completed()
    {
        $requestForms = $this->historyOfRequestQuery()
            ->where('status', 'completed');

        return view('student.historyOfRequest', [
            "forms" => $requestForms->paginate(7)
        ]);
    }

    public function rejected()
    {
        $requestForms = $this->historyOfRequestQuery()
            ->where('status', 'rejected');

        return view('student.historyOfRequest', [
            "forms" => $requestForms->paginate(7)
        ]);
    }

    public function forDeletion()
    {
        $requestForms = $this->historyOfRequestQuery()
            ->where('status', 'for deletion');

        return view('student.historyOfRequest', [
            "forms" => $requestForms->paginate(7)
        ]);
    }

    private function historyOfRequestQuery()
    {
        return RequestedDocument::orderBy('created_at', 'desc')
            ->where('userprofile_id', auth()->user()->userProfile->id)
            ->whereIn('status', ['completed', 'rejected', 'for deletion']);
    }

    public function updatePassword() {
        return view('student.updatePassword');
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

        return redirect()->route('student.profile')->with("success", "Password updated successfully");
    }

    public function createNewRequest() {
        return  view('student.createNewRequest');
    }

    public function request(){
        
        $validate = request()->validate([          
            "requested_document" => "required",
            "num-ctc" => "required",
            "num-orig" => "required",
            "purpose" => "required",
            "birthplace" => "required",
            "student_number" => "required",
            "check_graduate" => "required",
            "last_term"  => "nullable|string|max:40",
            "last_school_year" => "nullable|string|max:40",
            "check_correction" => "required",
            "orig_name"  => "nullable|string|max:40",
        ]);


        if($validate["check_graduate"] === 'Yes' && (!empty($validate["last_term"]) || !empty($validate["last_school_year"])) ){
            return back()->withErrors(['general' => 'Invalid inputs. Please try again.']);
        }
        
        if ($validate["check_correction"] === 'No' && !empty($validate["orig_name"])){
            return back()->withErrors(['general' => 'Invalid inputs. Please try again.']);
        }


        if(!empty($validate["last_term"]) && !empty($validate["last_school_year"])){
            RequestedDocument::create([
                "userprofile_id" => auth()->user()->userProfile->id,
                "requested_document" => $validate["requested_document"],
                "copies_ctc" => $validate["num-ctc"],
                "copies_orig" => $validate["num-orig"],
                "purpose" => $validate["purpose"],
                "status" => 'pending',
                "birthplace" =>  $validate["birthplace"],
                "student_number" =>  $validate["student_number"],
                "check_graduate" =>  $validate["check_graduate"],
                "check_correction" => $validate["check_correction"],
                "last_term" =>  $validate["last_term"],
                "last_school_year" =>  $validate["last_school_year"],
            ]);
        }elseif(!empty($validate["last_term"]) && !empty($validate["last_school_year"]) && !empty($validate["orig_name"])){
            RequestedDocument::create([
                "userprofile_id" => auth()->user()->userProfile->id,
                "requested_document" => $validate["requested_document"],
                "copies_ctc" => $validate["num-ctc"],
                "copies_orig" => $validate["num-orig"],
                "purpose" => $validate["purpose"],
                "status" => 'pending',
                "birthplace" =>  $validate["birthplace"],
                "student_number" =>  $validate["student_number"],
                "check_graduate" =>  $validate["check_graduate"],
                "check_correction" => $validate["check_correction"],
                "last_term" =>  $validate["last_term"],
                "last_school_year" =>  $validate["last_school_year"],
                "orig_name" =>  $validate["orig_name"],
            ]);
        }else {
            RequestedDocument::create([
                "userprofile_id" => auth()->user()->userProfile->id,
                "requested_document" => $validate["requested_document"],
                "copies_ctc" => $validate["num-ctc"],
                "copies_orig" => $validate["num-orig"],
                "purpose" => $validate["purpose"],
                "status" => 'pending',
                "birthplace" =>  $validate["birthplace"],
                "student_number" =>  $validate["student_number"],
                "check_graduate" =>  $validate["check_graduate"],
                "check_correction" => $validate["check_correction"],
            ]);
        }

        return redirect()->route('student.listOfRequestForms')->with('success', "Requested Successfully");

    }

    public function trackRequest(RequestedDocument $document) {
        
        return view("student.trackRequest", [
            "requestDocument" => $document,
            
        ]);
    }

    public function deleteRequest(RequestedDocument $document) {
        
        $document->update([
           "status" => "For Deletion" 
        ]);
        
        return redirect()->route('student.listOfRequestForms')->with('success', "Deleted Successfully");

    }
}
