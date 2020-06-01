<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Client;

class ClientController extends Controller
{
          /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Hsttp\Response
     */
    public function index()
    {
        $clients = Client::all();
        return view('clients.index', compact('clients'));
    }

        /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('clients.create');
    }

        /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'ragione_sociale'          => 'required|max:255',
            'nome_referente'   => 'max:255',
            'cognome_referente'    => 'max:255',
            'email'      => 'required|email',
            'ssid'    => 'required|max:7',
            'pec'      => 'required|email',
            'partita_iva'    => 'required|size:11',
        ]);

        if ($validator->fails()) {
            return redirect('client/create')
                ->withErrors($validator)
                ->withInput();
            }
        
        $client = new Client;
        $client->ragione_sociale = $request->input('ragione_sociale');
        $client->nome_referente = $request->input('nome_referente');
        $client->cognome_referente = $request->input('cognome_referente');
        $client->email = $request->input('email');
        $client->ssid = $request->input('ssid');
        $client->pec = $request->input('pec');
        $client->partita_iva = $request->input('partita_iva');
        $client->save();

        //Client::create($input);
        
        return redirect('/');
    }

        /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $elemento = Client::find($id);
        
        return view('clients.show', compact('elemento'));
    }

        /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $elemento = Client::find($id);
        $elemento->delete();
    }
}
