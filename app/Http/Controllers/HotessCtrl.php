<?php

namespace App\Http\Controllers;

use App\Models\Evenement;
use App\Models\Hotesse;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class HotessCtrl extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Hote=Hotesse::all();
        $Eve=Evenement::all();
        return view('Admin.pages.File_Hotesse.Hotesse',compact('Hote','Eve'));
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
            'nomHote' =>  'required',
            'emailHote' =>  'required',
            'telephoneHote' =>  'required',
        );



        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }



        $form_data = array(
            'nomEvn' => $request->nomEvn,
            'evn_id' =>   $request->evn_id,
            'nomHote' =>$request->nomHote,
            'emailHote' =>$request->emailHote,
            'telephoneHote' =>$request->telephoneHote,
        );

        Hotesse::create($form_data);
        Alert::success('Message','Add successfully');
        return redirect()->route('Hotesse.index');
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
      $Hote=Hotesse::find($id);
      return response()->json([
         'status'=>200,
         'Hotesse'=>$Hote,
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
         $Hote_id= $request->input('id');
       $prog=Hotesse::find($Hote_id);
       $prog->nomHote= $request->input('nomHote');
       $prog->emailHote= $request->input('emailHote');
       $prog->telephoneHote= $request->input('telephoneHote');
       $prog->evn_id= $request->input('evn_id');
       $prog->update();
       Alert::success('Message','Update successfully');
       return redirect()->route('Hotesse.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $data= $request->input('deleteHote');
        $data=Hotesse::find($data);
        $data->delete();
        Alert::success('Message','Delete successfully');
        return redirect()->route('Hotesse.index');
    }
}
