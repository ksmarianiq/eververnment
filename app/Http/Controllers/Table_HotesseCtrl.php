<?php

namespace App\Http\Controllers;

use App\Models\Association;
use App\Models\Hotesse;
use App\Models\IvnTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class Table_HotesseCtrl extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Ivn = IvnTables::all();
        $Hote = Hotesse::all();
        $Table_Hotesse = Association::all();

        return view('Admin.pages.File_Table_Hotesse.Table_Hotesse', compact('Ivn', 'Hote', 'Table_Hotesse'));
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
           
        );

        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            Alert::error('Message', 'Add error');
            return redirect()->back()->withErrors($error)->withInput();
        }


        try {
            $form_data = array(
                'hote_id' =>   $request->hote_id,
                'ivn_table_id' =>   $request->ivn_table_id,
            );

            Association::create($form_data);
            Alert::success('Message', 'Add successfully');
            return redirect()->route('Table_Hotesse.index');
        } catch (\Illuminate\Database\QueryException $exception) {
            Alert::error('Error', 'Veuillez rempli tous champs');
            return redirect()->back()->withInput();
        }
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
        $Table_Hotesse = Association::find($id);
        return response()->json([
            'status' => 200,
            'Table_Hotesse' => $Table_Hotesse,
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
        $Table_Hotesse_id = $request->input('id');
        $Table_Hotesse = Association::find($Table_Hotesse_id);
        try {
            $Table_Hotesse->hote_id = $request->input('hote_id');
            $Table_Hotesse->ivn_table_id = $request->input('ivn_table_id');
            $Table_Hotesse->update();
            Alert::success('Message', 'Update successfully');
            return redirect()->route('Table_Hotesse.index');
        } catch (\Illuminate\Database\QueryException $exception) {
            Alert::error('Error', 'Veuillez rempli tous champs');
            return redirect()->back()->withInput();
        }
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {


        $data_id = $request->input('deleteTables_Hotesse');
        $data = Association::find($data_id);

        try {
            $data->delete();
            Alert::success('Message', 'Delete successfully');
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

        return redirect()->route('Table_Hotesse.index');
    }
}
