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
        $Hote = Hotesse::all();
        $Eve = Evenement::all();
        return view('Admin.pages.File_Hotesse.Hotesse', compact('Hote', 'Eve'));
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
            'nomHote' =>  'required',
            'emailHote' =>  'required',
            'telephoneHote' =>  'required',
        );



        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            Alert::error('Message', 'Add error');
            return redirect()->back()->withErrors($error)->withInput();
        }


        try {
            $form_data = array(
                'nomEvn' => $request->nomEvn,
                'evn_id' =>   $request->evn_id,
                'nomHote' => $request->nomHote,
                'emailHote' => $request->emailHote,
                'telephoneHote' => $request->telephoneHote,
            );

            Hotesse::create($form_data);
            Alert::success('Message', 'Add successfully');
            return redirect()->route('Hotesse.index');
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
        $Hote = Hotesse::find($id);
        return response()->json([
            'status' => 200,
            'Hotesse' => $Hote,
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

        $Hote_id = $request->input('id');
        $prog = Hotesse::find($Hote_id);
        try {
            $prog->nomHote = $request->input('nomHote');
            $prog->emailHote = $request->input('emailHote');
            $prog->telephoneHote = $request->input('telephoneHote');
            $prog->evn_id = $request->input('evn_id');
            $prog->update();
            Alert::success('Message', 'Update successfully');
            return redirect()->route('Hotesse.index');
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


        $data_id = $request->input('deleteHote');
        $data = Hotesse::find($data_id);

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

        return redirect()->route('Hotesse.index');
    }

    private function getAffectedTables($errorMessage)
    {
        preg_match_all("/`(.+?)`/", $errorMessage, $matches);
        return $matches[1];
    }
}
