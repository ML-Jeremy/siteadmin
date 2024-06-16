<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Demande;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class InfoUserController extends Controller
{

    public function create()
    {
        return view('laravel-examples/user-profile');
    }

    public function list_demande()
    {
        $demande = DB::table('demandes')
            ->join('users', 'demandes.userId', '=', 'users.id')
            ->join('services', 'demandes.type_demande', '=', 'services.id')
            ->select('users.nom','users.prenom','users.numero','users.email','demandes.id','users.adresse','demandes.type_demande','demandes.projet','demandes.rendu_projet','demandes.statut','demandes.commentaire','demandes.created_at','services.libelle' )
            ->get();
        $dateLimite = Carbon::now()->subDays(30);
        $projets = Demande::where('created_at', '>=', $dateLimite)->count();
        return view('dashboard', ['demande'=>$demande,'projets'=>$projets]);

    }

    public function edit(string $id)
    {
         $model=Demande::find($id);

       return view('modif-demande',['model'=>$model]);
    }

    public function update(Request $request)
    {
        $demande_modif=Demande::find($request->input('id_demande'));
        $demande_modif->prix=$request->input('prix');
        $demande_modif->save();

        return Redirect::to('/dashboard');
    }

    public function store(Request $request)
    {

        $attributes = request()->validate([
            'name' => ['required', 'max:50'],
            'email' => ['required', 'email', 'max:50', Rule::unique('users')->ignore(Auth::user()->id)],
            'phone'     => ['max:50'],
            'location' => ['max:70'],
            'about_me'    => ['max:150'],
        ]);
        if($request->get('email') != Auth::user()->email)
        {
            if(env('IS_DEMO') && Auth::user()->id == 1)
            {
                return redirect()->back()->withErrors(['msg2' => 'You are in a demo version, you can\'t change the email address.']);

            }

        }
        else{
            $attribute = request()->validate([
                'email' => ['required', 'email', 'max:50', Rule::unique('users')->ignore(Auth::user()->id)],
            ]);
        }


        User::where('id',Auth::user()->id)
        ->update([
            'name'    => $attributes['name'],
            'email' => $attribute['email'],
            'phone'     => $attributes['phone'],
            'location' => $attributes['location'],
            'about_me'    => $attributes["about_me"],
        ]);


        return redirect('/user-profile')->with('success','Profile updated successfully');
    }
}
