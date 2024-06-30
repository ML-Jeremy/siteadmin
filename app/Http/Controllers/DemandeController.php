<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Demande;
use App\Models\Service;
use Illuminate\Support\Facades\DB;

class DemandeController extends Controller
{
    public function index() {

        $demandes = DB::table('demandes')
            ->rightjoin('users', 'demandes.userId', '=', 'users.id')
            ->join('services','demandes.type_demande','=','services.id')
            ->where('demandes.userId', '=', auth()->id())
            ->select('demandes.id','demandes.type_demande','demandes.prix','demandes.statut','demandes.commentaire','demandes.created_at','demandes.projet','demandes.rendu_projet','services.libelle' )
            ->get();
        return view('demandes.index', ['demandes' => $demandes]);
    }

    public function create() {
        $services = Service::all();
        return view('demandes.creation',['services' =>$services]);
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

    public function acceptPrice($id){
        $data = Demande::find($id);
        $data->statut = 1;
        $data->save();
        return redirect(route('demandes.index'))->with('success','Prix validé avec succès');
    }

    public function refusePrice($id){
        $data = Demande::find($id);
        $data->statut = 2;
        $data->save();
        return redirect(route('demandes.index'))->with('success','Prix refusé avec succès');
    }

    public function destroy($id){
        $data = Demande::find($id);
        $data->delete();
        return redirect(route('demandes.index'))->with('succes','Demande supprimée avec succès');
    }
}
