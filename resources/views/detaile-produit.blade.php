@extends('layout')


@section('content')

<section class="content form-group">
    <!-- Default box -->
  <div class="form-group">
    <div class="card card-solid" >
      <div class="card-body">
        <div class="row">
          <div class="col-12 col-sm-6">
              <h3 class="d-inline-block d-sm-none">Description</h3>
              <h3 class="d-inline-block d-sm-none">Stocke : {{ $produit->stock }}</h3>
            <div class="col-12">
                {{ $produit->imgInit() }}
              <img src="{{ $produit->image }}" alt="logo" width="50%">

            </div>
          </div>
          <div class="col-12 col-sm-6">
            <h3 class="my-3">Stocke : {{ $produit->stock }}</h3>
            <h3 class="my-3">Description</h3>
            <p>
                {{ $produit->description }}
            </p>

            <hr>
            </div>

          </div>
        </div>
      <!-- /.card-body -->
    </div>
  </div>

    <!-- /.card -->
  </section>
  <!-- /.content -->


@endsection
