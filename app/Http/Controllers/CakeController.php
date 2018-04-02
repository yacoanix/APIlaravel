<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cake;
use App\Http\Requests;

class CakeController extends Controller
{
    public function store(Request $request){
        // Creamos las reglas de validación
        $rules = [
            'titulo' => 'required',
            'ingred_princ' => 'required',
            'receta' => 'required'
        ];

        try {
            // Ejecutamos el validador y en caso de que falle devolvemos la respuesta
            $validator = \Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return [
                    'created' => false,
                    'errors' => $validator->errors()->all()
                ];
            }

            Cake::create($request->all());
            return ['created' => true];
        } catch (Exception $e) {
            \Log::info('Error creating cake: ' . $e);
            return \Response::json(['created' => false], 500);
        }
    }

    public function update(Request $request, Cake $cake){
        $cake->update($request->all());
        return ['updated' => true];
    }

    public function destroy(Cake $cake){
        $id=$cake->id;
        try {
            Cake::destroy($id);
            return ['deleted' => true];

        } catch (Exception $e){
            \Log::info('Error destroy cake: ' . $e);
            return \Response::json(['created' => false], 500);
        }
    }

    public function index(){
        return Cake::all();
    }

    public function show(Cake $cake){
        return $cake;
    }
}
