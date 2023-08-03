<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Commande;

use Illuminate\Http\Request;

class ClientController extends Controller
{

    public function index()
    {
        $commandes = Commande::all();
        $clients = Client::with('commandes')->paginate(5);
        return view('admin.clients.client', compact('clients', 'commandes'));
    }
}
