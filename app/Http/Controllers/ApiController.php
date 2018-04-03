<?php

namespace App\Http\Controllers;
use App\Token;
use Illuminate\Http\Request;

use App\Http\Requests;

class apiController extends Controller
{
    protected function store(Request $request){
        $datos=$request->only('api_token');
        Token::create($datos);
        return ['created' => true];
    }
}
