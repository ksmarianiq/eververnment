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

        $org = Organisateur::all();

        return view('Admin.pages.File_Organisation.Organisateur', compact('org'));
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

        if ($error->fails()) {
            Alert::error('Message', 'Add error');
            return redirect()->back()->withErrors($error)->withInput();
        }


        try {
            $form_data = array(
                'nomOrg' =>   $request->nomOrg,
                'num1Org' =>   $request->num1Org,
                'num2Org' =>   $request->num2Org,
                'emailOrg' =>   $request->emailOrg,
                'whatsappNum' =>   $request->whatsappNum,
            );

            Organisateur::create($form_data);
            Alert::success('Message', 'Add successfully');
            return redirect()->route('organisateur.index');
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
        $org = Organisateur::find($id);
        return response()->json([
            'status' => 200,
            'organisateur' => $org,
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
        $org_id = $request->input('id');
        $org = Organisateur::find($org_id);
        try {
            $org->nomOrg = $request->input('nomOrg');
            $org->num1Org = $request->input('num1Org');
            $org->num2Org = $request->input('num2Org');
            $org->whatsappNum = $request->input('whatsappNum');
            $org->save();
            Alert::success('Message', 'Update successfully');
            return redirect()->route('organisateur.index');
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

        $data_id = $request->input('deleteOrg');
        $data = Organisateur::find($data_id);

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

        return redirect()->route('organisateur.index');
    }

    private function getAffectedTables($errorMessage)
    {
        preg_match_all("/`(.+?)`/", $errorMessage, $matches);
        return $matches[1];
    }
}
