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
        $Eve = Evenement::with('organisateur')->get();
        $org = Organisateur::all();
        return view('Admin.pages.File_Evenement.Evenement', compact('Eve', 'org'));
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
    /*
Dans ce code, nous avons enveloppé la partie de création de l'événement avec un bloc try-catch
pour capturer l'exception de format de date invalide ou de valeur incorrecte pour la colonne org_id.
Si une telle exception est levée, nous utilisons $exception->getMessage() pour obtenir le message d'erreur
spécifique et l'afficher dans l'alerte d'erreur. De plus, nous renvoyons également l'utilisateur à la page précédente
avec les données saisies précédemment grâce à redirect()->back()->withInput().

*/
    $rules = array(
        'nomEvn' => 'required',
    );

    $error = Validator::make($request->all(), $rules);

    if ($error->fails()) {
        Alert::error('Message', 'Add error');
        return redirect()->back()->withErrors($error)->withInput();
    }

    try {
        $form_data = array(
            'nomEvn' => $request->nomEvn,
            'org_id' => $request->org_id,
        );

        Evenement::create($form_data);
        Alert::success('Message', 'Add successfully');
        return redirect()->route('Evenement.index');
    } catch (\Illuminate\Database\QueryException $exception) {
    Alert::error('Error', 'Une erreur s\'est produite lors de l\'ajout'  /*. $exception->getMessage()*/);
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
        $Eve = Evenement::find($id);
        return response()->json([
            'status' => 200,
            'Evenement' => $Eve,
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
        $Eve_id = $request->input('id');
        $Eve = Evenement::find($Eve_id);

        if (!$Eve) {
            Alert::error('Message', 'Evenement not found');
            return redirect()->route('Evenement.index');
        }

        $rules = array(
            'nomEvn' => ['required', 'string', 'max:255'],
            'org_id' => ['required'],
        );

        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            Alert::error('Message', 'Update error');
            return redirect()->back()->withErrors($error)->withInput();
        }
        try {
            $Eve->nomEvn = $request->input('nomEvn');
            $Eve->org_id = $request->input('org_id');
            $Eve->save();

            Alert::success('Message', 'Update successfully');
            return redirect()->route('Evenement.index');
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
        /*
         Dans ce code, nous utilisons un bloc try-catch pour capturer
         l'exception de violation de contrainte d'intégrité (foreign key constraint)
         lors de la suppression de l'événement. Si une telle exception est levée,
         nous utilisons $exception->getMessage() pour obtenir le message d'erreur spécifique
         et l'afficher dans l'alerte d'erreur.
        */


        $data_id = $request->input('deleteEve');
        $data = Evenement::find($data_id);

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

        return redirect()->route('Evenement.index');
    }

    private function getAffectedTables($errorMessage)
    {
        preg_match_all("/`(.+?)`/", $errorMessage, $matches);
        return $matches[1];
    }
}
