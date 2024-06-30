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
            ->select('users.nom','users.prenom','users.numero','users.email','demandes.id','users.adresse','demandes.type_demande','demandes.projet','demandes.rendu_projet','demandes.statut','demandes.commentaire','demandes.created_at','services.libelle','demandes.prix' )
            ->get();
        $dateLimite = Carbon::now()->subDays(30);
        $projets = Demande::where('created_at', '>=', $dateLimite)->count();
        return view('dashboard', ['demande'=>$demande,'projets'=>$projets]);

    }

    public function list_client()
    {
        $client = User::where('users.type','!=','1')->get();
        return view('laravel-examples.user-management',['client'=>$client]);
    }

    public function edit(string $id)
    {
         $model=Demande::find($id);

       return view('modif-demande',['model'=>$model]);
    }

    public function editdemande(string $id)
    {
         $model=Demande::find($id);

       return view('rendre-demande',['model'=>$model]);
    }



    public function updatePrice(Request $request)
    {
        $demande_modif=Demande::find($request->input('id_demande'));
        $demande_modif->prix=$request->input('prix');
        $demande_modif->save();

        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

        $headers .= "From: La plume entrepreneue". "\r\n";


        $message = '<html lang="en">' .
            '<head>' .
            '<meta charset="UTF-8">' .
            '<meta name="viewport" content="width=device-width, initial-scale=1.0">' .
            '<title>Facturation de projet</title>' .
            '</head>' .
            '<body>' .
            '<h1>Confirmation  de votre projet</h1>' .
            '<p>Bonjour '. Auth::user()->nom .',<br><br>Nous avons le plaisir de vous annoncer que votre projet a été pris en compte.Veuillez vous connecter à votre espace personnel pour confirmer votre commande.<br><br><br>Cordialement,<br>La plume entrepreneuse.</p>' .
            '</body>' .
            '</html>';


       $sender="contact@laplumeentrepreneuse.fr";
       $email=Auth::user()->email;
        if (mail($email, $sender, $message,$headers)) {

        }

        return Redirect(route('dashboard'));
    }

    public function updateDemande(Request $request)
    {
        $request->validate([
            'rendu_projet' => ['file','nullable','mimes:pdf,txt,png,jpg,svg','max:2048'],
        ]);

        $file_name = time() . '.' . request()->rendu_projet->getClientOriginalExtension();
        request()->rendu_projet->move(public_path('images'), $file_name);
        $demande_modif=Demande::find($request->input('id_demande'));
        $demande_modif->rendu_projet=$file_name;
        $demande_modif->statut=3;
        $demande_modif->save();

        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

        $headers .= "From: La plume entrepreneue". "\r\n";


        $message = '<html lang="en">' .
            '<head>' .
            '<meta charset="UTF-8">' .
            '<meta name="viewport" content="width=device-width, initial-scale=1.0">' .
            '<title>Rendu de projet</title>' .
            '</head>' .
            '<body>' .
            '<p>Bonjour '. Auth::user()->nom .',<br><br>Nous avons le plaisir de vous annoncer que votre projet a été finaliser.Veuillez trouvez ci-joint votre projet ou vous connecter à votre espace personnel pour le télécharger.<br><br><br>Cordialement,<br>La plume entrepreneuse.</p>' .
            '</body>' .
            '</html>';


       $sender="contact@laplumeentrepreneuse.fr";
       $email=Auth::user()->email;
        if (mail($email, $sender, $message,$headers)) {

        }

        return Redirect(route('dashboard'));
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
