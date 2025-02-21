<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\User;
use DataTables;
use Illuminate\Support\Facades\Hash;
use App\Jobs\SendUserListEmailJob;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;





class UserController extends Controller
{
    public function index()
    {
        return view('users.index');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'mobile' => 'required|numeric|digits:10|unique:users,mobile',
            'password' => 'required|min:6',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'password' => Hash::make($request->password),
        ]);

        return response()->json(['success' => 'User registered successfully!', 'user' => $user]);
    }

    public function getUsers(Request $request)
    {
        if ($request->ajax()) {
            $users = User::select(['id', 'name', 'email', 'mobile', 'created_at']);
            return DataTables::of($users)->make(true);
        }
    }

    public function exportAndSendEmail()
    {
        $filePath = 'public/user_list.xlsx'; 
        if (Storage::exists($filePath)) {
         Storage::delete($filePath);
        }
        Excel::store(new UsersExport, $filePath, 'local');
        $fullPath = storage_path('app/' . $filePath);
        // dd($fullPath);
        if (!file_exists($fullPath)) {
            return back()->with('error', 'File could not be created.');
        }
            $email = 'robinsonisaiah017@gmail.com';
            SendUserListEmailJob::dispatch($email, $fullPath)->onQueue('emails');

            return redirect()->route('users.index')->with('success', 'Email is being processed in queue');
        }
}
