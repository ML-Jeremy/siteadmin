@extends('layouts.user_type.guest')

@section('content')

  <section class="min-vh-100 mb-8">
    <div class="page-header align-items-start min-vh-50 pt-5 pb-11 mx-3 border-radius-lg" style="background-image: url('../assets/img/curved-images/curved14.jpg');">
      <span class="mask bg-gradient-dark opacity-6"></span>
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-5 text-center mx-auto">
            <h1 class="text-white mb-2 mt-5">Bienvenue!</h1>
            <p class="text-lead text-white">Utilisez ces superbes formulaires pour vous connecter ou créer gratuitement un nouveau compte dans votre projet.</p>
          </div>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row mt-lg-n10 mt-md-n11 mt-n10">
        <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
          <div class="card z-index-0">
            <div class="card-header text-center pt-4">
              <h5>S'inscrire</h5>
            </div>
            <div class="card-body">
              <form role="form text-left" method="POST" action="register">
                @csrf
                <div class="mb-3 d-flex row">
                    <div class="col-6">
                        <input type="text" class="form-control" placeholder="Nom" name="nom" id="name" aria-label="Name" aria-describedby="name" value="{{ old('name') }}" required>
                        @error('name')
                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-6">
                        <input type="text" class="form-control" placeholder="Prénom" name="prenom" id="name" aria-label="Name" aria-describedby="name" value="{{ old('name') }}" required>
                        @error('name')
                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="mb-3">
                    <input type="text" class="form-control" placeholder="Adresse" name="adresse" id="name" aria-label="Name" aria-describedby="email-addon" value="{{ old('name') }}" required>
                    @error('name')
                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <select class="form-control" name="country_code" required>
                                <option value="+33" selected><span class="flag-icon flag-icon-fr"></span> +33 (France)</option>
                                <option value="+1"><span class="flag-icon flag-icon-us"></span> +1 (USA)</option>
                                <option value="+44"><span class="flag-icon flag-icon-gb"></span> +44 (UK)</option>
                                <!-- Ajoutez d'autres codes de pays et drapeaux selon vos besoins -->
                            </select>
                        </div>
                        <input type="text" class="form-control" placeholder="Téléphone" name="numero" id="adresse" aria-label="Phone" aria-describedby="phone-addon" value="{{ old('numero') }}" required>
                    </div>
                    @error('numero')
                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <input type="email" class="form-control" placeholder="Email" name="email" id="email" aria-label="Email" aria-describedby="email-addon" value="{{ old('email') }}" required>
                    @error('email')
                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                  <input type="password" class="form-control" placeholder="Mot de passe" name="password" id="password" aria-label="Password" aria-describedby="password-addon" required>
                  @error('password')
                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                  @enderror
                </div>
                <div class="mb-3">
                    <input type="password" class="form-control" placeholder="Confirmation de mot passe" name="password_confirmation" id="password" aria-label="Password" aria-describedby="password-addon" required>
                    @error('password')
                      <p class="text-danger text-xs mt-2">{{ $message }}</p>
                    @enderror
                  </div>
                <div class="form-check form-check-info text-left">
                  <input class="form-check-input" type="checkbox" name="agreement" id="flexCheckDefault" checked required>
                  <label class="form-check-label" for="flexCheckDefault">
                    J'accepte les<a href="javascript:;" class="text-dark font-weight-bolder">&nbsp;Termes et Conditions</a>
                  </label>
                  @error('agreement')
                    <p class="text-danger text-xs mt-2">Tout d’abord, acceptez les conditions générales, puis réessayez de vous inscrire.</p>
                  @enderror
                </div>
                <div class="text-center">
                  <button type="submit" class="btn bg-gradient-dark w-100 my-4 mb-2">S'inscrire</button>
                </div>
                <p class="text-sm mt-3 mb-0">Avez-vous déjà un compte? <a href="login" class="text-dark font-weight-bolder">Se connecter</a></p>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

@endsection

