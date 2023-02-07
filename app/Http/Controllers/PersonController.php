<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Person;


class PersonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $persons= Person::all();

        $res=[
            'status'=>"ok",
            'message'=>'Lista de Personas',
            'code'=>1000,
            'data'=>$persons
        ];
        return $res;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $jsonP= $request->json()->all();
        $person= new Person($jsonP);
        // foreach($jsonP as $key=>$value){
        //     $person->$key = $value;
        // }
        $person->save();
        $res=[
            'status'=>"ok",
            'message'=> "Persona creada",
            'code'=>1003,
            'data'=>$person
        ];
        return $res;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $person= Person::find($id);
        if(isset($person)){
            $res=[
                'status'=>"ok",
                'message'=> "Persona por ID {$id}",
                'code'=>1001,
                'data'=>$person
            ];
        }else{
            $res=[
                'status'=>"error",
                'message'=> "Dicha persona no existe",
                'code'=>1001,
                'data'=>null
            ];
        }
        
        return $res;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $person= Person::find($id);
        if(isset($person)){
            $person->update($request->json()->all());
            $res=[
                'status'=>"ok",
                'message'=> "los datos fueron actualizados",
                'code'=>1005
            ];
            $person->save();
        }else{
            $res=[
                'status'=>"error",
                'message'=> "La persona no fue encontrada",
                'code'=>1015
            ];
        }
        
        return $res;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $person= Person::find($id);
        if(isset($person)){
            $person->delete();
            $res=[
                'status'=>"ok",
                'message'=> "Persona borrada",
                'code'=>1004
            ];
        }else{
            $res=[
                'status'=>"error",
                'message'=> "La persona no fue encontrada",
                'code'=>1014
            ];
        }
        
        return $res;
    }
}
