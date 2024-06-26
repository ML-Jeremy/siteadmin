@extends('simple-user.user_type.auth')

@section('content')

<div>
    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header pb-0 px-3">
                <h6 class="mb-0">{{ __('Demande') }}</h6>
            </div>
            <div class="card-body pt-4 p-3">
                <form action="{{route('demandes.store')}}" method="POST" role="form text-left" enctype="multipart/form-data" >
                    @csrf
                    @method('post')
                    @if($errors->any())
                        <div class="mt-3  alert alert-primary alert-dismissible fade show" role="alert">
                            <span class="alert-text text-white">
                            {{$errors->first()}}</span>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                <i class="fa fa-close" aria-hidden="true"></i>
                            </button>
                        </div>
                    @endif
                    @if(session('success'))
                        <div class="m-3  alert alert-success alert-dismissible fade show" id="alert-success" role="alert">
                            <span class="alert-text text-white">
                            {{ session('success') }}</span>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                <i class="fa fa-close" aria-hidden="true"></i>
                            </button>
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="type-demande" class="form-control-label">{{ __('Type de demande') }}</label>
                                <div class="@error('type')border border-danger rounded-3 @enderror">
                                    <input class="form-control" value="" type="select" placeholder="Quelle est votre demande" id="type-demande" name="type_demande">

                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="fichier-demande" class="form-control-label">{{ __('Fichier') }}</label>
                                <div class="@error('projet')border border-danger rounded-3 @enderror">
                                    <input class="form-control" value="" type="file"  id="demande-fichier" name="projet">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="about">{{ 'Commentaire' }}</label>
                        <div class="@error('demande.commentaire')border border-danger rounded-3 @enderror">
                            <textarea class="form-control" id="about" rows="3" placeholder="Un commentaire sur votre demande" name="commentaire"></textarea>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn bg-gradient-dark btn-md mt-4 mb-4">{{ 'Envoyer la demande' }}</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection
