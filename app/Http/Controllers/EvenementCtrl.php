<?php

namespace App\Http\Controllers;

use App\Models\Evenement;
use Illuminate\Http\Request;
use App\Models\Organisateur;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use RealRashid\SweetAlert\Facades\Alert;
class EvenementCtrl extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Eve=Evenement::all();
        $org=Organisateur::all();
        return view('Admin.pages.File_Evenement.Evenement',compact('Eve','org'));
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
            'nomEvn' =>  'required',
            'org_id' =>  'required',
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            Alert::danger('Message','Add error');
            return response()->json(['errors' => $error->errors()->all()]);
        }



        $form_data = array(
            'nomEvn' =>   $request->nomEvn,
            'org_id' =>   $request->org_id,
        );

        Evenement::create($form_data);
        Alert::success('Message','Add successfully');
        return redirect()->route('Evenement.index');
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
        $Eve=Evenement::find($id);
        return response()->json([
           'status'=>200,
           'Evenement'=>$Eve,
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
        $Eve_id=$request->input('id');
        $Eve=Evenement::find($Eve_id);
        $Eve->nomEvn= $request->input('nomEvn');
        $Eve->org_id= $request->input('org_id');
        $Eve->save();
        Alert::success('Message','Update successfully');
        return redirect()->route('Evenement.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $data= $request->input('deleteEve');
        $data=Evenement::find($data);
        $data->delete();
        Alert::success('Message','Delete successfully');
        return redirect()->route('Evenement.index');
    }
}
