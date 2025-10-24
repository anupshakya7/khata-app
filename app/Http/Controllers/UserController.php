<?php

namespace App\Http\Controllers;

use App\Helpers\PaginationHelper;
use App\Mail\UserVerificationMail;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::paginate(10);
        $users = PaginationHelper::addSerialNo($users);

        return view('user.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name'=>'required|string|min:3|max:50',
            'email'=>'required|string|email|unique:users,email',
            'password'=>'required|string|min:8|confirmed',
        ]);

        try{
            $validatedData['email_verification_token'] = Str::random(64);
            $user = User::create($validatedData);

            //Send Email Verify Mail
            Mail::to($user->email)->send(new UserVerificationMail($user));

            return redirect()->route('user.index')->with('success','Successfully created new user');
        }catch(Exception $e){
            Log::channel('user')->error($e->getMessage());
            return redirect()->back()->with('error','Fail to create new user');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('user.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'name'=>'required|string|min:3|max:50',
            'email'=>[
                'required',
                'string',
                'email',
                Rule::unique('users','email')->ignore($user->id)
            ],
            'password'=>'nullable|min:8|confirmed'
        ]);

        try{
            if(empty($validatedData['password'])){
                unset($validatedData['password']);
            }

            $user->update($validatedData);

            return redirect()->route('user.index')->with('success','Successfully updated new user');
        }catch(Exception $e){
            Log::channel('user')->error($e->getMessage());
            return redirect()->back()->with('error','Fail to update new user');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        try{
            $user->delete();

            return redirect()->route('user.index')->with('success','Successfully deleted!!!');
        }catch(Exception $e){
            Log::channel('user')->error($e->getMessage());
            return redirect()->back()->with('error','Fail to delete user');
        }
    }
}
