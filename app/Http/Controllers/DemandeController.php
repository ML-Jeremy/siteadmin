<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Demande;
use Illuminate\Support\Facades\DB;

class DemandeController extends Controller
{
    public function index() {

        $demandes = DB::table('demandes')
            ->rightjoin('users', 'demandes.userId', '=', 'users.id')
            ->where('demandes.userId', '=', auth()->id())
            ->select('demandes.id','demandes.type_demande','demandes.prix','demandes.statut','demandes.commentaire','demandes.created_at' )
            ->get();
        return view('demandes.index', ['demandes' => $demandes]);
    }

    public function create() {
        return view('demandes.creation');
    }

    public function store(Request $request) {
        $data = $request->validate([
            'type_demande' => ['required', 'max:30'],
            'projet' => ['file','nullable','mimes:pdf,txt,png,jpg,svg','max:2048'],
            'commentaire'=> ['required','max:180'],
        ]);

        $file_name = time() . '.' . request()->projet->getClientOriginalExtension();
        request()->projet->move(public_path('images'), $file_name);

        $data['userId'] = auth()->id();
        $data['projet'] = $file_name;

        $newDemande = Demande::create($data);

        return redirect(route('demandes.index'));
    }

    public function destroy($id){
        $data = Demande::find($id);
        $data->delete();
        return redirect(route('demandes.index'))->with('succes','Demande supprimée avec succès');
    }
}
