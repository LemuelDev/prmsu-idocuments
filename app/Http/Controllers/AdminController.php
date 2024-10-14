<?php

namespace App\Http\Controllers;

use App\Jobs\BackupJob;
use App\Mail\ApproveEmail;
use App\Mail\ApproveRequestDocument;
use App\Mail\RejectRequest;
use App\Models\AvailableDocuments;
use App\Models\Backup;
use App\Models\Courses;
use App\Models\RequestedDocument;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    
    public function index() {


       return  view('admin.dashboard', );
    }

    public function backup() {
        $lastBackup = Backup::latest('created_at')->first();
        $lastBackupDate = $lastBackup ? $lastBackup->created_at->format('F j, Y g:i a') : 'No currently backup';

        return  view('admin.backups', compact('lastBackupDate'));
     }
     public function createBackup()
     {
         try {
             // Dispatch the BackupJob to the queue
             BackupJob::dispatch();
            
             // Redirect with a success message
             return redirect()->route('admin.backups')->with('success', 'Backup completed');
     
         } catch (\Exception $exception) {
             // Log the error for debugging purposes
             Log::error('Failed to dispatch backup job: ' . $exception->getMessage());
     
             // Redirect with a failure message
             return redirect()->route('admin.backups')->with('error', 'Failed to dispatch backup job.');
         }
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

        $validated = request()->validate([
            'reason' => 'required|string'
        ]);
        $document->update([
            "status" => "rejected",
            "reject_reason" => $validated['reason']
        ]);

        $message = "Your requested document is rejected. You can contact the admin regarding with your rejected request.";
        Mail::to($document->userProfile->email )->send(new RejectRequest($message));
        
        return redirect()->route('admin.listOfRequestForms')->with('success', "The request is rejected");
    }

    public function approveRequest(RequestedDocument $document) {

        $document->update([
            "status" => "completed"
        ]);
        
        $message = "Your requested document is now approved. You can download the pdf from your history logs and view your request of document.";
        Mail::to($document->userProfile->email )->send(new ApproveRequestDocument($message));
        
        return redirect()->route('admin.listOfRequestForms')->with('success', "The request is approved!");
    }

    public function approve(UserProfile $user){
        $user->isPending = 'approved'; // Set the attribute directly
        $user->save(); 

        $message = "Your account is finally active. You can now log in and request documents to the registrar office.";
        Mail::to($user->email)->send(new ApproveEmail(
            $message, 
        ));

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

    public function trackUser(UserProfile $id) {
        $editing = true;

        $courses = Courses::orderBy('courses', 'asc')->get();

        return view("admin.trackUser",[
            "editing" => $editing,
            "user" => $id,
            "courses" => $courses
        ]);


    }

    public function getProfile(UserProfile $id){
        $courses = Courses::orderBy('courses', 'asc')->get();

        return view("admin.updateUser",[
            "user" => $id,
            "courses" => $courses
        ]);
    }


    public function updateUser(UserProfile $id) {
        $requiredFields = ['name', 'email', 'course', 'sex', 'address', 'year' , 'phone_number'];
    
        foreach ($requiredFields as $field) {
            if (empty(request($field))) {
                return back()->withErrors(['general' => 'All fields must be filled up.'])->withInput();
            }
        }


        $validated = request()->validate([
            "name" => "required",
            "email" => "required",
            "course"=> "required",
            "sex" => "required",
            "address" => "required",
            "year" => "required",
            "phone_number"=> "required",
        ]);

        $id->update([
            "course" => $validated["course"]
        ]);

        return redirect()->route("admin.activeUsers")->with("success", "User updated successfully!");

    }


    public function deleteUser(Userprofile $id){

        $id->delete();

        return redirect()->route("admin.activeUsers")->with("success", "User deleted successfully!");

    }

    public function profile() {
        return  view('admin.profile');
    }

    public function editProfile() {

        $editing = true;
        return  view('admin.profile', compact("editing"));
    }

    
    public function updateProfile(User $student) {
        
        $requiredFields = ['firstname', 'lastname', 'email', 'username', 'age', 'sex', 'birthday', 'address', 'phone_number'];
        
        foreach ($requiredFields as $field) {
            if (empty(request($field))) {
                return back()->withErrors(['general' => 'All fields must be filled up.']);
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
            "age" => "required",
            "address" => "required",
            "birthday" => "required",
            "phone_number" => "required",
        ]);

        $name = $validated["firstname"];
        if (!empty($validated["middlename"])) {
            $name .= ' ' . $validated["middlename"];
        }
        $name .= ' ' . $validated["lastname"];
        if (!empty($validated["extensionname"])) {
            $name .= ' ' . $validated["extensionname"];
        }

        $student->userProfile()->update([
            "firstname" => $validated["firstname"],
            "middlename" => $validated["middlename"],
            "lastname" => $validated["lastname"],
            "extensionname" => $validated["extensionname"],
            "name" => $name,
            "email" => $validated["email"],
            "age" => $validated["age"],
            "sex" => $validated["sex"],
            "address" => $validated["address"],
            "birthday" => $validated["birthday"],
            "phone_number" => $validated["phone_number"]
        ]);

        $student->update([
            "username" => $validated["username"],
        ]); 

        return redirect()->route('admin.profile')->with("success", "Profile updated successfully");
       
    }


    public function listOfRequestForms() {
        // Array mapping full document names to their abbreviations
        $documentAbbreviations = [
            'certificate of grades' => 'cog',
            'certificate of enrollment' => 'cor',
            'transcript of records' => 'tor',
            'original diploma' => 'diploma',
            'copy of diploma' => 'diploma',

        ];
        $requestForms = RequestedDocument::orderBy('created_at', 'desc')
            ->whereIn('status', ['pending', 'for deletion']);
    
        if (request()->has('search')) {
            $searchQuery = request()->get('search');
            $lowercaseSearchQuery = strtolower($searchQuery);
            
            // Check if the search query matches an abbreviation
            $abbreviation = array_search($lowercaseSearchQuery, array_map('strtolower', $documentAbbreviations));
            
            if ($abbreviation !== false) {
                // If an abbreviation is found, search by the full name
                $requestForms->where('requested_document', 'like', '%' . $abbreviation . '%');
            } else {
                // Otherwise, perform a normal search
                $requestForms->where('requested_document', 'like', '%' . $searchQuery . '%');
            }
        }
    
        return view('admin.listOfRequestForms', [
            'forms' => $requestForms->paginate(7)
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
    public function activeUsers(Request $request) {

        $users = UserProfile::orderBy('created_at', 'desc' )
        ->where('isPending', 'approved')
        ->whereIn('user_status' ,['enable', 'disabled'])
        ->where('user_type', 'student');

        if (request()->has('search')) {
            $searchQuery = request()->get('search');
            $users->where('name', 'like', '%' . $searchQuery . '%');
        }

        // Handle course filter
        if ($request->has('sortCourse')) {
            $course = $request->get('sortCourse');
            if (!empty($course)) {
                $users->where('course', $course);
            }
        }

           // Handle year filter
        if ($request->has('sortYear')) {
            $year = $request->get('sortYear');
            if (!empty($year)) {
                $users->where('year', $year);
            }
        }

        $courses = Courses::orderBy('courses', 'asc')->get();

        return  view('admin.activeUsers',[
            "users" => $users->paginate(7),
            "courses" => $courses
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

    
    public function allRequest()
    {
        return $this->requestLogs();
    }

    public function lastTwoWeeks()
    {
        $requestForms = $this->historyOfRequestQuery()
            ->where('created_at', '>=', now()->subDays(14));

        return view('admin.requestLogs', [
            "forms" => $requestForms->paginate(7)
        ]);
    }

    public function lastMonth()
    {
        $requestForms = $this->historyOfRequestQuery()
            ->where('created_at', '>=', now()->subMonth());

        return view('admin.requestLogs', [
            "forms" => $requestForms->paginate(7)
        ]);
    }

    public function completed()
    {
        $requestForms = $this->historyOfRequestQuery()
            ->where('status', 'completed');

        return view('admin.requestLogs', [
            "forms" => $requestForms->paginate(7)
        ]);
    }

    public function rejected()
    {
        $requestForms = $this->historyOfRequestQuery()
            ->where('status', 'rejected');

        return view('admin.requestLogs', [
            "forms" => $requestForms->paginate(7)
        ]);
    }

    public function forDeletion()
    {
        $requestForms = $this->historyOfRequestQuery()
            ->where('status', 'for deletion');

        return view('admin.requestLogs', [
            "forms" => $requestForms->paginate(7)
        ]);
    }

    private function historyOfRequestQuery()
    {
        return RequestedDocument::orderBy('created_at', 'desc')
            ->whereIn('status', ['completed', 'rejected', 'for deletion']);
    }
    

    public function manageCourses() {

        $courses = Courses::orderBy('created_at', 'desc');

        return  view('admin.manageCourses', [
            "courses" => $courses->paginate(5)
        ]);
    }

    public function createCourse(){

       return view("admin.createCourse");
    }

    public function saveCourse(){

        $validated = request()->validate([
            "courses" => "required",
            "courses_abr" => "required"
        ]);

         // Check if a course with the same name or abbreviation already exists
          $existingCourse = Courses::where('courses', $validated['courses'])
            ->orWhere('courses_abr', $validated['courses_abr'])
            ->first();

        if ($existingCourse) {
            // Redirect back with a custom error message if a duplicate is found
            return redirect()->back()->with('error', 'The course or abbreviation already exists.');
        }

        Courses::create([
            "courses" => $validated["courses"],
            "courses_abr" => $validated["courses_abr"]
        ]);

        return redirect()->route("admin.manageCourses")->with("success", "Created Successfully!");
    }

    public function editCourse(Courses $id) {
        
        return view('admin.trackCourse', compact('id'));
    }

    public function updateCourse(Courses $id){

        $validated = request()->validate([
            "courses" => "required",
            "courses_abr" => "required"
        ]);

        // Check if another course with the same name or abbreviation exists, excluding the current one
        $existingCourse = Courses::where(function($query) use ($validated) {
            $query->where('courses', $validated['courses'])
                ->orWhere('courses_abr', $validated['courses_abr']);
        })
        ->where('id', '!=', $id->id) // Exclude the current course from the check
        ->first();

        if ($existingCourse) {
            // Redirect back with a custom error message if a duplicate is found
            return redirect()->back()->with('error', 'The course or abbreviation already exists.');
        }

        $id->update([
            "courses" => $validated["courses"],
            "courses_abr" => $validated["courses_abr"]
        ]);

        return redirect()->route("admin.manageCourses")->with("success", "Updated Successfully!");
    }

    
    public function deleteCourse(Courses $course){
       $course->delete();

        return redirect()->route("admin.manageCourses")->with("success", "Deleted Successfully!");
    }

    public function manageAvailableDocuments() {

        $documents = AvailableDocuments::orderBy('created_at', 'desc');

        return  view('admin.manageAvailableDocuments', [
            "documents" => $documents->paginate(5)
        ]);
    }

    public function createDocument(){

       return view("admin.createDocument");
    }
    public function saveDocument(){

        $validated = request()->validate([
          "available_documents" => "required",
      ]);
      
      // Check if a course with the same name or abbreviation already exists
      $existingDocs = AvailableDocuments::where('available_documents', operator: $validated['available_documents'])->first();

        if ($existingDocs) {
            // Redirect back with a custom error message if a duplicate is found
            return redirect()->back()->with('error', 'The request document already exists.');
        }

        AvailableDocuments::create([
            "available_documents" => $validated["available_documents"],
        ]);
      
      return redirect()->route("admin.manageAvailableDocuments")->with("success", "Created Successfully!");
  }

    public function editDocument(AvailableDocuments $id) {

        return view('admin.trackDocument', compact("id"));
   
    }

    public function updateDocument(AvailableDocuments $id)
    {
        // Validate the request data
        $validated = request()->validate([
            "available_documents" => "required|string|max:255",
        ]);
        
        // Check if another document with the same name exists, excluding the current one
        $existingDoc = AvailableDocuments::where('available_documents', $validated['available_documents'])
            ->where('id', '!=', $id->id)
            ->first();
    
    
        if ($existingDoc) {
            // Redirect back with a custom error message if a duplicate is found
            return redirect()->back()->with('error', 'The requested document already exists.');
        }
    
        $id->update([
            "available_documents" => $validated["available_documents"]   
        ]);
    
        // Redirect to the manage documents route with a success message
        return redirect()->route("admin.manageAvailableDocuments")->with("success", "Document updated successfully!");
    }
    
    
    

    public function deleteDocument(AvailableDocuments $document){

        $document->delete();
 
         return redirect()->route("admin.manageAvailableDocuments")->with("success", "Deleted Successfully!");
     }
}
