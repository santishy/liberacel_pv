<?php

namespace App\Http\Responses;
use Illuminate\Contracts\Support\Responsable;

class SessionInactive implements Responsable
{
    protected $name;
    function __construct($name){
        $this->name = $name;
    }
    public function toResponse($request)
    {
        return response()->json(['data' => "La sesion de {$this->name} esta inactiva"]);
    }
}