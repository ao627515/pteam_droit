<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mondroit.bf | Connexion</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  @include('includes.head_import')
  <link rel="stylesheet" href="assets/css/login.css">
</head>
<body>
  @include('includes.navbar')
  <main class="d-flex align-items-center min-vh-50 py-3 py-md-0">
    <div class="container">
      <div class="card login-card">
        <div class="row no-gutters">
          <div class="col-md-5">
            <img src="{{asset('assets/img/login2.jpg')}}" alt="login" class="login-card-img">
          </div>
          <div class="col-md-7">
            <div class="card-header">
                <h3 class="border-bottom">Compte {{$type_compte->nom}}</h3>
                <h2 class="text-prmiary">Activation {{$type_compte->frais}} FCFA </h2>
            </div>
            <div class="card-body py-1">
                <p class="p-3 text-danger"><em>Vous devez payer les frais pour activer votre compte et profiter des services</em></p>
    <input type="hidden" name="mode-reglement" id="mode-reglement" >
  <div class="row">
    <div class="col-6 text-center">
        <button type="button" class="btn btn-primary p-3" id="btn-orange-money" onclick="selectMode('orange-money')">
        <img src="{{asset('assets/img/omoney.jpg')}}" alt="" width="90" >
        <h4 class="p-1">Orange money</h4>
        </button>
    </div>
    <div class="col-6 text-center">
        <button type="button" class="btn btn-light p-3" id="btn-moov-money" onclick="selectMode('moov-money')">
            <img src="{{asset('assets/img/mmoney.jpg')}}" alt="" width="90" >
            <h4 class="p-1">Moov money</h4>
        </button>
    </div>
  </div>

  <div class="row mx-md-5 mt-3 p-3 border bg-light" id="pay_form">
    <div class="col-12 p-3 mb-3 text-center bg-white">
        <small>Obtenez un code OTP de validation en composant</small> <br>
        <a href="tel:000" class="btn btn-link" title="composer">#000*{{$type_compte->frais}}#</a> <br>
        <small>Entrez le code OTP dans le champ ci-dessous après avoir entré le numéro utilisé pour paiement</small>
    </div>
    <div class="col-md-12 mb-3 text-center">
        <label for="phone"><b>Numéro mobile money</b></label>
        <input type="tel" required minlength="8" maxlength="8" class="form-control text-center bg-white border-0 @error('phone') is-invalid @enderror"
            name="phone" id="phone" placeholder="xxxxxxxx" style="height: 45px; font-weight: bold; letter-spacing:5px" value="{{old('phone')}}">

        @error('phone')
        <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>
    <div class="col-md-12 text-center">
        <label for="otp"><b>Code OTP</b></label>
        <input type="tel" required minlength="6" maxlength="6" class="form-control text-center bg-white border-0 @error('otp') is-invalid @enderror"
            name="otp" id="otp" placeholder="XXXXXX" style="height: 45px; font-weight: bold; letter-spacing:5px" value="{{old('otp')}}">

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

@include("includes.script_import")
<script>
function selectMode(mode) {
    if(mode == 'orange-money'){
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
    $("#btn-payer").attr("disabled",false);
}
</script>
</body>
</html>

