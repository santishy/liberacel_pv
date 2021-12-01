<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Http\Resources\ClientResource;
use Illuminate\Validation\Rule;

class ClientController extends Controller
{
    public function index(){

        $this->authorize('view',new Client);
        if(request()->wantsJson())
            return new ClientResource(Client::paginate(20));
        return view('clients.index');
    }

    public function create(){
        $this->authorize('create',new Client);
        return view('clients.create');

    }

    public function store(Request $request){

        $this->authorize('create',new Client);
        $clientValidated = $this->validateNewClient($request);
        $client = Client::create($clientValidated);
        return ClientResource::make($client);
    }

    public function validateNewClient($request){
        return $request->validate([
            'name' => 'required',
            'address' => 'required',
            'phone_number' => ['required',Rule::unique('clients')->ignore($request->id)],
            'email' => "required|email|unique:clients,email,$request->id",
            'company' => 'required',
            'assigned_price' => 'required'
        ],
        [
            'name.required' => 'El nombre es requerido',
            'address.required' => 'La dirección es requerida',
            'phone_number.required' => 'El número telefonico es requerido',
            'phone_number.unique' => 'El número telefonico ya existe en la base de datos',
            'email.required' => 'El email es requerido',
            'email.email' => 'El email debe ser valido',
            'email.unique' => 'El email ya existe en la base de datos',
            'company.required' => 'La empresa o negocio es requerido.',
            'assigned_price.required' => 'El precio es requerido'
        ]);
    }
    public function edit(Client $client){

        $this->authorize('update',$client);
        return view('clients.edit',compact('client'));
    }

    public function update(Request $request,Client $client){

        $this->authorize('update',$client);
        $clientValidated = $this->validateNewClient($request);
        $client->update($clientValidated);
        return new ClientResource($client);
    }

    public function destroy(Client $client){

        $this->authorize('delete',$client);
        return $client->delete();
    }
}
