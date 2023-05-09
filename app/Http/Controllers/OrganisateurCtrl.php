<?php

namespace App\Http\Controllers;

use App\Models\Organisateur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use RealRashid\SweetAlert\Facades\Alert;
class OrganisateurCtrl extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

       $org=Organisateur::all();

        return view('Admin.pages.File_Organisation.Organisateur',compact('org'));
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
            'nomOrg' =>  'required',
            'num1Org' =>  'required',
            'num2Org' =>  'required',
            'emailOrg' =>  'required',
            'whatsappNum' =>  'required',
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            Alert::danger('Message','Add error');
            return response()->json(['errors' => $error->errors()->all()]);
        }



        $form_data = array(
            'nomOrg' =>   $request->nomOrg,
            'num1Org' =>   $request->num1Org,
            'num2Org' =>   $request->num2Org,
            'emailOrg' =>   $request->emailOrg,
            'whatsappNum' =>   $request->whatsappNum,
        );

        Organisateur::create($form_data);
        Alert::success('Message','Add successfully');
        return redirect()->route('organisateur.index');
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
    //cette route edit me permet de recuperer id par api en json lorqu'on clique sur le button edit
      $org=Organisateur::find($id);
      return response()->json([
         'status'=>200,
         'organisateur'=>$org,
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
        //la route update a été détacher de la route ressource  (faite un php artisan route:list)
       $org_id= $request->input('id');
       $org=Organisateur::find($org_id);
       $org->nomOrg= $request->input('nomOrg');
       $org->num1Org= $request->input('num1Org');
       $org->num2Org= $request->input('num2Org');
       $org->whatsappNum= $request->input('whatsappNum');
       $org->save();
       Alert::success('Message','Update successfully');
       return redirect()->route('organisateur.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $data= $request->input('deleteOrg');
        $data=Organisateur::find($data);
        $data->delete();
        Alert::success('Message','Delete successfully');
        return redirect()->route('organisateur.index');
    }
}
