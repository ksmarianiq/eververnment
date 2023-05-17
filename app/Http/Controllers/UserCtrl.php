<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class UserCtrl extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user= DB::table('users')
        ->where('role', '=', 2)
        ->get();

        return view('Admin.pages.File_User.User',compact('user'));
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

        $rules = array(
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role'=> 'required',
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            Alert::error('Message','Add error');
            return redirect()->back()->withErrors($error)->withInput();
        }



        $form_data = array(
            'name' =>   $request->name,
            'email' =>   $request->email,
            'role' =>   $request->role,
            'password' => Hash::make($request->password)
        );

        User::create($form_data);
        Alert::success('Message','Add successfully');
        return redirect()->route('user.index');
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
        $user=User::find($id);
        return response()->json([
           'status'=>200,
           'user'=>$user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user_id = $request->input('id');
        $user = User::find($user_id);

        $rules = array(
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => 'required',
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            Alert::error('Message','Update error');
            return redirect()->back()->withErrors($error)->withInput();
        }

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->role = $request->input('role');
        $user->password = Hash::make($request->password);
        $user->update();

        Alert::success('Message','Update successfully');
        return redirect()->route('user.index');
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
       $user_id = $request->input('deleteUser');
        $user = User::find($user_id);

        if(!$user)
        {
            Alert::error('Message','User not found');
            return redirect()->route('user.index');
        }

        if($user->delete())
        {
            Alert::success('Message','Delete successfully');
        }
        else
        {
            Alert::error('Message','Delete error');
        }

        return redirect()->route('user.index');

    }
}
