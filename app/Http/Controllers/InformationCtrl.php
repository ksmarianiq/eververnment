<?php

namespace App\Http\Controllers;

use App\Models\Evenement;
use App\Models\InformationSup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class InformationCtrl extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Info=InformationSup::all();
        $Eve=Evenement::all();

        return view('Admin.pages.File_Information.Information',compact('Info','Eve'));
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
            'titre' =>  'required',
            'evn_id' =>  'required',
            'codeInf' =>  'required',
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            Alert::error('Message','Add error');
            return redirect()->back()->withErrors($error)->withInput();
        }



        $form_data = array(
            'titre' =>   $request->titre,
            'evn_id' =>   $request->evn_id,
            'codeInf' =>   $request->codeInf,
        );

        InformationSup::create($form_data);
        Alert::success('Message','Add successfully');
        return redirect()->route('Information.index');
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
        $Information=InformationSup::find($id);
        return response()->json([
           'status'=>200,
           'Information'=>$Information,
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
        $Info_id= $request->input('id');
        $Info=InformationSup::find($Info_id);
        $Info->titre= $request->input('titre');
        $Info->codeInf= $request->input('codeInf');
        $Info->evn_id= $request->input('evn_id');
        $Info->update();
        Alert::success('Message','Update successfully');
        return redirect()->route('Information.index');
    }


    public function check(Request $request)
    {
        $inputCheckbox = $request->input('inputCheckbox');
        $value = $request->input('value');
        $result = $inputCheckbox ? 'Case cochée, valeur : ' . $value : 'Case décochée, valeur : ' . $value;
        return response()->json($result);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {

        $data_id = $request->input('deleteInf');
        $data = InformationSup::find($data_id);

        try {
            $data->delete();
            Alert::success('Message','Delete successfully');
        } catch (\Illuminate\Database\QueryException $exception) {
            $errorInfo = $exception->errorInfo;

            if ($errorInfo[0] === '23000' && $errorInfo[1] === 1451) {
                $affectedTables = $this->getAffectedTables($errorInfo[2]);
                $errorMessage = "Impossible de supprimer l'événement. Il est référencé dans les tableaux suivants : " . implode(", ", $affectedTables);
                Alert::error('Error', $errorMessage);
            } else {
                Alert::error('Error', $exception->getMessage());
            }
        }

        return redirect()->route('Information.index');
    }

    private function getAffectedTables($errorMessage)
    {
        preg_match_all("/`(.+?)`/", $errorMessage, $matches);
        return $matches[1];

    }
}
