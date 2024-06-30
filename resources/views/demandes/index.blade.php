@extends('simple-user.user_type.auth')

@section('content')

<div>
    <div class="row">
        <div class="col-12">
            <div class="card mb-4 mx-4">
                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-0">Toutes vos demandes</h5>
                        </div>
                        <a href="{{route('demandes.creation')}}" class="btn bg-gradient-primary btn-sm mb-0" type="button">+&nbsp; Nouvelle demande</a>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Type de demande
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Demande
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Status
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Prix
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Projet final
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Date de création
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($demandes as $demande)
                                    <tr>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">{{$demande->libelle}}</p>
                                        </td>
                                        <td class=" text-sm text-center">
                                            <a href="{{ asset('images/' . $demande->projet) }}" target="_blank"><i class="fa fa-file-pdf text-lg " aria-hidden="true" style="color: red;"></i></a>
                                        </td>
                                        <td class="text-center">
                                            @if($demande->statut == 0)
                                                <span class="badge badge-sm bg-gradient-warning">Envoyée</span>
                                            @elseif($demande->statut == 1)
                                                <span class="badge badge-sm bg-gradient-success">Validée</span>
                                            @elseif($demande->statut == 2)
                                                <span class="badge badge-sm bg-gradient-danger">Non validée</span>
                                            @elseif($demande->statut == 3)
                                                <span class="badge badge-sm bg-gradient-secondary">Terminée</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">{{$demande->prix}}€</p>
                                        </td>
                                        @if (!empty($demande->rendu_projet))
                                            <td class=" text-sm text-center">
                                                <a href="{{ asset('images/' . $demande->rendu_projet) }}" target="_blank"><i class="fa fa-file-pdf text-lg " aria-hidden="true" style="color: red;"></i></a>
                                            </td>
                                         @else
                                         <td class="text-center">Non disponible</td>
                                        @endif
                                        <td class="text-center">
                                            <span class="text-secondary text-xs font-weight-bold">{{$demande->created_at}}</span>
                                        </td>
                                        <td class="text-center">
                                            @if ($demande->prix !=0  && $demande->statut != 3)
                                                <a href="{{route('demandes.accept', $demande->id)}}" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Valider le prix">
                                                    <i class="cursor-pointer fas fa-check text-success"></i></a>
                                                <a href="{{route('demandes.refuse', $demande->id)}}" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Refuser le prix">
                                                    <i class="cursor-pointer fas fa-times text-danger"></i></a>
                                            @endif
                                            <a href="{{route('demandes.destroy', $demande->id)}}" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Supprimer la demande">
                                                <i class="cursor-pointer fas fa-trash text-secondary"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
