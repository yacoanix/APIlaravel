<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Requests;

class UserController extends Controller
{

    public function store(Request $request)
    {
        // Creamos las reglas de validación
        $rules = [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required'
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

            User::create($request->all());
            return ['created' => true];
        } catch (Exception $e) {
            \Log::info('Error creating user: ' . $e);
            return \Response::json(['created' => false], 500);
        }
    }

    public function update(Request $request, User $user)
    {

        $user->update($request->all());
        return ['updated' => true];
    }

    public function show(User $user)
    {
        return $user;
    }

    public function destroy(User $user)
    {
        $id=$user->id;
        try {
            User::destroy($id);
            return ['deleted' => true];

        } catch (Exception $e){
            \Log::info('Error destroy user: ' . $e);
            return \Response::json(['created' => false], 500);
        }
    }

    public function index()
    {
        return User::all();
    }








}
