<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Leave;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register()
    {
        return view('auth.register');
    }

    public function registerSave(Request $request)
    {
        Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:6',
            'role' => 'required|in:admin,employee',
        ])->validate();

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role'=>$request->role,
            'type' => "0",

        ]);

        return redirect()->route('employee')->with('success','Registeration successfull');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
{
    // Validate login credentials including role
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
        'role' => 'required|in:admin,employee', // Validate role selection
    ]);

    $credentials = $request->only('email', 'password');

    // Attempt to log in the user
    if (Auth::attempt($credentials)) {
        $user = Auth::user();

        // Check if the user's role matches the selected role
        if ($user->role === $request->role) {
            // Redirect based on role
            if ($user->role === 'admin') {
                return redirect()->route('admin'); // Redirect to admin dashboard
            } elseif ($user->role === 'employee') {
                return redirect()->route('home');
            }
        } else {
            Auth::logout();
            return back()->withErrors(['role' => 'Selected role does not match our records.']);
        }
    }
    return back()->withErrors(['email' => 'Invalid email or password']);
}

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function home()
    {
        return view('home');
    }
     public function admin()
    {
        $leaveRequests = Leave::orderBy('created_at', 'desc')->get();
       return view('admin' ,compact('leaveRequests'));
    }
    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
    public function index(Request $request)
    {
        $employees = User::paginate(05);

        $query = User::query();

    // Apply filters if provided
    if ($request->has('name') && !empty($request->name)) {
        $query->where('name', 'LIKE', '%' . $request->name . '%');
    }

    if ($request->has('email') && !empty($request->email)) {
        $query->where('email', 'LIKE', '%' . $request->email . '%');
    }

    if ($request->has('role') && !empty($request->role)) {
        $query->where('role', $request->role);
    }

    // Paginate results
    $employees = $query->paginate(5);


        return view ('employee',compact('employees'));
    }

    public function edit($id)
{
    $employee = User::findOrFail($id); // Find the employee by ID
    return view('employee', compact('employee')); // Return the edit view
}

public function update(Request $request, $id)
{
    $employee = User::findOrFail($id);

    // Validate the updated data
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $employee->id,
        'role' => 'required|in:admin,employee',
    ]);

    // Update the employee record
    $employee->update([
        'name' => $request->name,
        'email' => $request->email,
        'role' => $request->role,
    ]);

    return redirect()->route('employee')->with('success', 'Employee updated successfully.');
}

    public function destroy($id){

        $employee = User::findOrFail($id);

        if (!$employee){
            return redirect()->route('employee')->with('error','Employee not found');
        }

        $employee->delete();

        return redirect()->route('employee')->with('success','Employee deleted successfully');
    }

    public function leave()

    {
        // Fetch all leave requests with their related user data
        $leaves = Leave::with('user')->get();

        return view('home', compact('leaves'));
    }

    public function leaveform()
    {
        // Get the authenticated user's name
        $authenticatedUserName = Auth::user()->name;

        // Fetch leave requests where employee_name matches the authenticated user's name
        $leaveRequests = DB::select("
            SELECT
                leave_.id,
                leave_.employee_name,
                leave_.start_date,
                leave_.end_date,
                leave_.reason,
                leave_.leave_type,
                leave_.status
            FROM leave_
            WHERE leave_.employee_name = ?
            ORDER BY leave_.created_at DESC
        ", [$authenticatedUserName]);

        // Pass the leave requests to the view
        return view('leave', compact('leaveRequests'));
    }

    public function leavestore(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after_or_equal:start_date',
            'reason' => 'required|string|max:255',
        ]);

        // Store the leave request with employee_name
        Leave::create([
            'employee_name' => Auth::user()->name,  // Store the employee's name
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'reason' => $request->reason,
            'leave_type'=>$request->leave_type,
            'status' => 'pending',
        ]);

        return redirect()->route('leave')->with('success', 'Leave request submitted successfully.');
    }




    // Handle Leave Request Submission


public function viewAll()
{
    $leaveRequests = Leave::orderBy('created_at', 'desc')->get();
    return view('admin', compact('leaveRequests'));
}

// Update leave request status
public function updateStatus(Request $request, $id)
{
    $request->validate([
        'status' => 'required|in:approved,rejected,pending',
    ]);

    $leaveRequest = Leave::findOrFail($id);
    $leaveRequest->status = $request->status;
    $leaveRequest->save();

    return redirect()->route('admin.leave-requests')->with('success', 'Leave request status updated successfully.');
}

}
