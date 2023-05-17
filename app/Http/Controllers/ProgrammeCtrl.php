<?php

namespace App\Http\Controllers;

use App\Models\Evenement;
use App\Models\Programme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ProgrammeCtrl extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $prog=Programme::all();
        $Eve=Evenement::all();

        return view('Admin.pages.File_Programme.Programme',compact('prog','Eve'));
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
            'libProg' =>  'required',
            'dateProg' =>  'required',
            'heureProg' =>  'required',
            'lieuProg' =>  'required',
            'descriptionProg' =>  'required',
            'evn_id' =>  'required',
            'latitude' =>  'required',
            'longitude' =>  'required',
            'codeProg' =>  'required',
        );



        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            Alert::error('Message','Add error');
            return redirect()->back()->withErrors($error)->withInput();
        }



        $form_data = array(
            'libProg' =>   $request->libProg,
            'dateProg' =>   $request->dateProg,
            'heureProg' =>   $request->heureProg,
            'lieuProg' =>   $request->lieuProg,
            'descriptionProg' =>strip_tags($request->descriptionProg),
            'evn_id' =>   $request->evn_id,
            'latitude' =>   $request->latitude,
            'longitude' =>   $request->longitude,
            'codeProg' =>   $request->codeProg,
        );

        Programme::create($form_data);
        Alert::success('Message','Add successfully');
        return redirect()->route('programme.index');
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
      $prog=Programme::find($id);
      return response()->json([
         'status'=>200,
         'programme'=>$prog,
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
       $prog_id= $request->input('id');
       $prog=Programme::find($prog_id);
       $prog->libProg= $request->input('libProg');
       $prog->dateProg= $request->input('dateProg');
       $prog->heureProg= $request->input('heureProg');
       $prog->lieuProg= $request->input('lieuProg');
       $prog->descriptionProg=strip_tags($request->input('descriptionProg'));
       $prog->evn_id= $request->input('evn_id');
       $prog->latitude= $request->input('latitude');
       $prog->longitude= $request->input('longitude');
       $prog->update();
       Alert::success('Message','Update successfully');
       return redirect()->route('programme.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {

        $data_id = $request->input('deleteProg');
        $data = Programme::find($data_id);

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

        return redirect()->route('programme.index');
    }

    private function getAffectedTables($errorMessage)
    {
        preg_match_all("/`(.+?)`/", $errorMessage, $matches);
        return $matches[1];
    }
    }

