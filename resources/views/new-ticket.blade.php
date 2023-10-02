@extends('layout')

@section('content')
<style>
  .thumbnail{
    height: 80px !important;
  }
</style>
<section class="page-title-wrap position-relative bg-light">
    <div id="particles_js"></div>
    <div class="container">
        <div class="row">
            <div class="col-11">
                <div class="page-title position-relative pt-5 pb-5">
                    <ul class="custom-breadcrumb roboto list-unstyled mb-0 clearfix" data-animate="fadeInUp" data-delay="1.2">
                        <li><a href="index.html">Accueil</a></li>
                        <li><i class="fas fa-angle-double-right"></i></li>
                        <li><a href="#">Nouveau ticket</a></li>
                    </ul>
                    <h1 data-animate="fadeInUp" data-delay="1.3">Nouveau ticket</h1>
                </div>
            </div>
            <div class="col-1">
                <div class="world-map position-relative">
                    <img src="img/map.svg" alt="" alt="" data-no-retina class="svg">
                </div>
            </div>
        </div>
    </div>
</section>


<main class="d-flex align-items-center min-vh-100 py-3 py-md-0">
    <div class="container">
      <div class="card login-card">
        <div class="row no-gutters">
          <div class="col-md-5">
            <img src="{{asset('assets/img/login2.jpg')}}" alt="login" class="login-card-img">
          </div>
          <div class="col-md-7 p-5">
            <div class="card-body p-5">
                <h1 class=" text-center">Demande d'assistance</h1>
              <p class="login-card-description text-center">Remplissez ce formulaire pour demander une assistance</p>

      <form action="{{route('ticket.store')}}" method="post">
        @csrf

        <input type="hidden" name="type" value="{{$partenaire ? 2 : 1}}">
        @if ($partenaire)
        <fieldset class="border p-3 mt-5 mb-4">
          <legend>Cabinet à contacter</legend>
          <div class="row">
            <div class="col-md-4">
              <img src="{{ asset($partenaire->logo)}}" class="thumbnail">
            </div>
            <div class="col-md-8">
              <h2>{{ $partenaire->nom }}</h2>
            </div>
              <input type="hidden" value="{{$partenaire->id}}" name="target_user_id">
          </div>
      </fieldset>
        @endif

        <div class="form-group">
            <label for="objet">Objet <span class="text-danger">*</span></label>
                <select class="custom-select form-control @error('objet') is-invalid @enderror" name="objet"
                id="objet" placeholder="Choisir"Ò value="{{old('objet')}}">
                    <option disabled selected>--Choisir--</option>
                    <option @if ($q==1) selected @endif>Besoin d'un actes juridiques</option>
                    <option @if ($q==2) selected @endif>Procédure judiciaire</option>
                    <option @if ($q==3) selected @endif>Besoin d'un avocat</option>
                    <option @if ($q==4) selected @endif>Documents de société</option>
                    <option @if ($q==5) selected @endif>Je souhaite discuter par appel</option>
                    <option @if ($q==6) selected @endif>Autre type de services</option>
                  </select>
            @error('objet')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group">
          <label for="msg">Message <span class="text-danger">*</span></label>
          <textarea class="form-control @error('msg') is-invalid @enderror" name="msg" id="msg" value="{{old('msg')}}"  placeholder="Decrivez brievement votre demande" cols="30" rows="6"></textarea>
          @error('msg')
          <p class="text-danger text-center">{{ $message }}</p>
          @enderror
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Envoyer</button>
          </div>
        </div>
      </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

@endsection