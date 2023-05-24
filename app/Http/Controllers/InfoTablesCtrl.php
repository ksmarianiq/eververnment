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
        $Tables = IvnTables::all();
        $Eve = Evenement::all();
        return view('Admin.pages.File_Tables.Tables', compact('Tables', 'Eve'));
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
            'nomTableInv' =>  'required',
            'nbrePlaceInv' =>  'required',
            'descriptionTableInv' =>  'required',
        );

/*
 Organisateur au niveau du formulaire
 catégorie-> un champ sélecte ('enfant && adulte')
*/

        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            Alert::error('Message', 'Add error');
            return redirect()->back()->withErrors($error)->withInput();
        }

        try {
            $form_data = array(
                'evn_id' =>   $request->evn_id,
                'nomTableInv' => $request->nomTableInv,
                'nbrePlaceInv' => $request->nbrePlaceInv,
                'descriptionTableInv' => strip_tags($request->descriptionTableInv),
            );


            IvnTables::create($form_data);
            Alert::success('Message', 'Add successfully');
            return redirect()->route('Tables.index');
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
        //cette route edit me permet de recuperer id par api en json lorqu'on clique sur le button edit
        $Tables = IvnTables::find($id);
        return response()->json([
            'status' => 200,
            'Tables' => $Tables,
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
        $Tables_id = $request->input('id');
        $Tables = IvnTables::find($Tables_id);
        try {
            $Tables->nomTableInv = $request->input('nomTableInv');
            $Tables->nbrePlaceInv = $request->input('nbrePlaceInv');
            $Tables->descriptionTableInv = strip_tags($request->input('descriptionTableInv'));
            $Tables->evn_id = $request->input('evn_id');
            $Tables->update();
            Alert::success('Message', 'Update successfully');
            return redirect()->route('Tables.index');
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


        $data_id = $request->input('deleteTables');
        $data = IvnTables::find($data_id);
        try {
            $data->delete();
            Alert::success('Message', 'Delete successfully');
        } catch (\Illuminate\Database\QueryException $exception) {
            Alert::error('Error', 'Integrity constraint violation: 1451 Cannot delete');
        }
        return redirect()->route('Tables.index');






        $data_id = $request->input('deleteTables');
        $data = IvnTables::find($data_id);

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

        return redirect()->route('Tables.index');
    }

    private function getAffectedTables($errorMessage)
    {
        preg_match_all("/`(.+?)`/", $errorMessage, $matches);
        return $matches[1];
    }
}
