<?php

namespace App\Http\Controllers;

use App\Models\Evenement;
use App\Models\IvnTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class InfoTablesCtrl extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Tables=IvnTables::all();
        $Eve=Evenement::all();
        return view('Admin.pages.File_Tables.Tables',compact('Tables','Eve'));
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
            'evn_id' =>  'required',
            'nomTableInv' =>  'required',
            'nbrePlaceInv' =>  'required',
            'descriptionTableInv' =>  'required',
        );



        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }



        $form_data = array(
            'evn_id' =>   $request->evn_id,
            'nomTableInv' =>$request->nomTableInv,
            'nbrePlaceInv' =>$request->nbrePlaceInv,
            'descriptionTableInv' =>strip_tags($request->descriptionTableInv),
        );

        
        IvnTables::create($form_data);
        Alert::success('Message','Add successfully');
        return redirect()->route('Tables.index');
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
      $Tables=IvnTables::find($id);
      return response()->json([
         'status'=>200,
         'Tables'=>$Tables,
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
      $Tables_id= $request->input('id');
      $Tables=IvnTables::find($Tables_id);
      $Tables->nomTableInv= $request->input('nomTableInv');
      $Tables->nbrePlaceInv= $request->input('nbrePlaceInv');
      $Tables->descriptionTableInv= strip_tags($request->input('descriptionTableInv'));
      $Tables->evn_id= $request->input('evn_id');
      $Tables->update();
      Alert::success('Message','Update successfully');
      return redirect()->route('Tables.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $data= $request->input('deleteTables');
        $data=IvnTables::find($data);
        $data->delete();
        Alert::success('Message','Delete successfully');
        return redirect()->route('Tables.index');
    }
}
