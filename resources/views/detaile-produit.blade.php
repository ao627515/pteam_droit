@extends('layout')

@section('content')
    {{ $produit->imgInit() }}
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-sm-6">
                    <div class="col-12">
                        <div class="card">
                            {{-- <img src="{{ asset('assets/img/produit.jpg') }}" alt="logo" width="50%" class="card-img-top"> --}}
                            <img src="{{ $produit->image }}" class="card-img-top" alt="Image">
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6">
                    <h1 class="text-center">{{ $produit->nom }}</h1> <br>
                    <div>
                        <h6>Stock : {{ $produit->stock }}</h6>
                        <h6>Prix : {{ $produit->prix }}</h6>
                        <h6>{{ $produit->getActionDate() }}</h6>
                    </div>
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
@endsection
