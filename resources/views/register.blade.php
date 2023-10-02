<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mondroit.bf | Inscription</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

    <link rel="stylesheet" href="assets/css/login.css">
    @include('includes.head_import')
</head>

<body>
    @include('includes.navbar')

    <form action="{{ route('auth.register') }}" method="post" enctype="multipart/form-data">
        <main class="d-flex align-items-center min-vh-50 py-3 py-md-0">
            <div class="container">
                @csrf
                <div class="card login-card">
                    <div class="row no-gutters">
                        <div class="col-md-6">
                            <div class="card-body">
                                <p class="login-card-description text-primary">Créez un compte</p>
                                <fieldset class="border p-3 mt-5 mb-4">
                                    <legend>Type de compte</legend>
                                    <div class="form-group">
                                        <input type="text" class="form-control"
                                            value="{{ $type->nom }} -- {{ $type->frais }} FCFA" readonly>
                                        <input type="hidden" name="type" id="type"
                                            value="{{ $type->short_name }}">
                                    </div>
                                    <p class="text-right"> <a href="/#register" class="text-primary">Modifier</a></p>
                                </fieldset>

                                <fieldset class="border p-3 mt-5 mb-4">
                                    <legend>Informations de personnelles</legend>

                                    <div class="form-group">
                                        {{-- <label for="nom">Nom</label> --}}
                                        <input type="text" class="form-control @error('nom') is-invalid @enderror"
                                            name="nom" id="nom" placeholder="Nom" value="{{ old('nom') }}">
                                        @error('nom')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        {{-- <label for="prenom">Prénoms</label> --}}
                                        <input type="text" class="form-control @error('prenom') is-invalid @enderror"
                                            name="prenom" id="prenom" placeholder="Prénoms"
                                            value="{{ old('prenom') }}">
                                        @error('prenom')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        {{-- <label for="telephone">Téléphone</label> --}}
                                        <input type="tel" class="form-control @error('phone') is-invalid @enderror"
                                            name="telephone" id="telephone" placeholder="Téléphone"
                                            value="{{ old('telephone') }}">
                                        @error('telephone')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        {{-- <label for="email">Email</label> --}}
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                            name="email" id="email" placeholder="E-mail"
                                            value="{{ old('email') }}">
                                        @error('email')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-2">
                                        {{-- <label for="password">Mot de passe</label> --}}
                                        <input type="password"
                                            class="form-control @error('password') is-invalid @enderror" name="password"
                                            id="password" placeholder="Mot de passe" value="{{ old('password') }}">
                                        @error('password')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </fieldset>

                                @if ($t == 'physique')
                                    <div class="row">
                                        <div class="col-12">
                                            <span onclick="goToPay()" class="btn btn-primary btn-block">Suivant</span>
                                        </div>
                                    </div>
                                    <p class="mb-5 mt-3 text-right">Vous avez déja un compte? <a
                                            href="{{ route('auth.loginform') }}" class="text-primary">Se connecter</a>
                                    </p>

                                    <nav class="login-card-footer-nav text-right">
                                        <a href="#!" class="text-primary">Termes et Conditions</a>
                                        {{-- <a href="{{route('auth.registerform',['t'=>'partenaire'])}}">Devenir Partenaire</a> --}}
                                    </nav>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            @if ($t == 'physique')
                                <img src="{{ asset('assets/img/login1.jpg') }}" alt="login" class="login-card-img">
                            @else
                                <div class="card-body">
                                    <fieldset class="border p-3 mt-5 mb-4">
                                        <legend>Informations de l'entreprise</legend>

                                        <div class="row">
                                            <div class="form-group p-1 my-2 border col-8">
                                                <label for="logo" class="form-label">Logo </label>
                                                <input type="file" id="logo" name="logo" value="{{ old('logo') }}">
                                                {{-- <input type="file" name="photograph" id="photo" required="true" /> --}}
                                                @error('logo')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="col-4 text-center">
                                                <img src="{{asset('assets/img/550x550.jpg')}}" id="imgPreview" alt="Logo" />
                                                {{-- <img src="#" alt="pic" /> --}}
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <input type="text"
                                                class="form-control @error('nom_pro') is-invalid @enderror"
                                                name="nom_pro" id="nom_pro" placeholder="Raison sociale"
                                                value="{{ old('nom_pro') }}">
                                            @error('nom_pro')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <input type="tel"
                                                class="form-control @error('phone_pro') is-invalid @enderror"
                                                name="phone_pro" id="phone_pro" placeholder="Téléphone entrepise"
                                                value="{{ old('phone_pro') }}">
                                            @error('phone_pro')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <input type="email"
                                                class="form-control @error('email_pro') is-invalid @enderror"
                                                name="email_pro" id="email_pro" placeholder="E-mail entreprise"
                                                value="{{ old('email_pro') }}">
                                            @error('email_pro')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="domaine">Domaine d'activité</label>
                                            <select class="form-control p-2 @error('domaine') is-invalid @enderror"
                                                name="domaine" id="domaine" placeholder="Choisir"
                                                value="{{ old('domaine') }}">
                                                @foreach ($domaines as $item)
                                                    <option value="{{ $item->id }}">{{ $item->nom }}</option>
                                                @endforeach
                                            </select>
                                            @error('domaine')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="description">Description</label>
                                            <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description"
                                                value="{{ old('description') }}" placeholder="Decrivez brievement les services de votre entreprise"
                                                cols="30" rows="3"></textarea>
                                            @error('description')
                                                <p class="text-danger text-center">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="form-group p-1 my-2 border">
                                            <label for="val_doc_1" class="form-label">RCCM: </label>
                                            <input type="file" id="val_doc_1" name="val_doc_1"
                                                value="{{ old('val_doc_1') }}">
                                            @error('val_doc_1')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="form-group p-1 my-2 border">
                                            <label for="val_doc_2" class="form-label">DOC2: </label>
                                            <input type="file" id="val_doc_2" name="val_doc_2"
                                                value="{{ old('val_doc_2') }}">
                                            @error('val_doc_2')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </fieldset>
                                    <div class="row">
                                        <div class="col-12">
                                            @if ($t == 'morale' || $t == 'partenaire')
                                                <span onclick="goToPay()"
                                                    class="btn btn-primary btn-block">Suivant</span>
                                            @else
                                                <button type="submit"
                                                    class="btn btn-primary btn-block">Inscription</button>
                                            @endif
                                        </div>
                                    </div>
                                    <p class="mb-5 mt-3 text-right">Vous avez déja un compte? <a
                                            href="{{ route('auth.loginform') }}" class="text-primary">Se
                                            connecter</a></p>

                                    <nav class="login-card-footer-nav text-right">
                                        <a href="#!" class="text-primary">Termes et Conditions</a>
                                        {{-- <a href="{{route('auth.registerform',['t'=>'partenaire'])}}">Devenir Partenaire</a> --}}
                                    </nav>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </main>


        <main class="d-none align-items-center min-vh-50 pb-5 pt-5 py-md-0" id="pay">
            <div class="container pt-5">
                <div class="card login-card">
                    <div class="row no-gutters">
                        <div class="col-md-5">
                            <img src="{{ asset('assets/img/login2.jpg') }}" alt="login" class="login-card-img">
                        </div>
                        <div class="col-md-7">
                            <div class="card-header">
                                <h3 class="border-bottom">Compte {{ $type->nom }}</h3>
                                <h2 class="text-prmiary">Activation {{ $type->frais }} FCFA </h2>
                            </div>
                            <div class="card-body py-1">
                                <p class="p-3 text-danger"><em>Vous devez payer les frais pour activer votre compte et
                                        profiter des services</em></p>
                                <input type="hidden" name="mode-reglement" id="mode-reglement">
                                <div class="row">
                                    <div class="col-6 text-center">
                                        <button type="button" class="btn btn-primary p-3" id="btn-orange-money"
                                            onclick="selectMode('orange-money')">
                                            <img src="{{ asset('assets/img/omoney.jpg') }}" alt=""
                                                width="90">
                                            <h4 class="p-1">Orange money</h4>
                                        </button>
                                    </div>
                                    <div class="col-6 text-center">
                                        <button type="button" class="btn btn-light p-3" id="btn-moov-money"
                                            onclick="selectMode('moov-money')">
                                            <img src="{{ asset('assets/img/mmoney.jpg') }}" alt=""
                                                width="90">
                                            <h4 class="p-1">Moov money</h4>
                                        </button>
                                    </div>
                                </div>

                                <div class="row mx-md-5 mt-3 p-3 border bg-light" id="pay_form">
                                    <div class="col-12 p-3 mb-3 text-center bg-white">
                                        <small>Obtenez un code OTP de validation en composant</small> <br>
                                        <a href="tel:000" class="btn btn-link"
                                            title="composer">#000*{{ $type->frais }}#</a> <br>
                                        <small>Entrez le code OTP dans le champ ci-dessous après avoir entré le numéro
                                            utilisé pour paiement</small>
                                    </div>
                                    <div class="col-md-12 mb-3 text-center">
                                        <label for="phone"><b>Numéro mobile money</b></label>
                                        <input type="tel" minlength="8" maxlength="8"
                                            class="form-control text-center bg-white border-0 @error('phone') is-invalid @enderror"
                                            name="phone" id="phone" placeholder="xxxxxxxx"
                                            style="height: 45px; font-weight: bold; letter-spacing:5px"
                                            value="{{ old('phone') }}">

                                        @error('phone')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col-md-12 text-center">
                                        <label for="otp"><b>Code OTP</b></label>
                                        <input type="tel" minlength="6" maxlength="6"
                                            class="form-control text-center bg-white border-0 @error('otp')is-invalid @enderror"
                                            name="otp" id="otp" placeholder="XXXXXX"
                                            style="height: 45px; font-weight: bold; letter-spacing:5px"
                                            value="{{ old('otp') }}">
                                        @error('otp')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer text-center">
                                <button type="submit" class="btn btn-primary">Payer</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

    </form>

    @include('includes.script_import')
    <script>
        $(document).ready(()=>{
      $('#logo').change(function(){
        const file = this.files[0];
        // console.log(file);
        if (file){
          let reader = new FileReader();
          reader.onload = function(event){
            // console.log(event.target.result);
            $('#imgPreview').attr('src', event.target.result);
          }
          reader.readAsDataURL(file);
        }
      });
    });


        function changeLocation(type) {
            window.location.href = '/register?t=' + type;
        }

        function goToPay() {
            $("#pay").removeClass("d-none");
            $("#pay").addClass("d-flex");
            $([document.documentElement, document.body]).animate({
                scrollTop: $("#pay").offset().top
            }, 1000);
        }

        function selectMode(mode) {
            if (mode == 'orange-money') {
                $("#btn-orange-money").removeClass("btn-light");
                $("#btn-orange-money").addClass("btn-primary");
                $("#btn-moov-money").removeClass("btn-primary");
                $("#btn-moov-money").addClass("btn-light");
                $("#mode-reglement").val("orange-money");
            } else {
                $("#btn-moov-money").removeClass("btn-light");
                $("#btn-moov-money").addClass("btn-primary");
                $("#btn-orange-money").removeClass("btn-primary");
                $("#btn-orange-money").addClass("btn-light");
                $("#mode-reglement").val("moov-money");
            }
            $("#pay_form").show();
            $("#btn-payer").attr("disabled", false);
        }
    </script>
</body>

</html>
