@extends('layout')

@section('content')
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Nos article</h1>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="container content form-group">

                <h3>DROIT CONSTITUTIONNEL</h3>
                <div class="row">
                    @foreach ([1, 2, 3, 4, 5] as $produit)
                        <div class="col-6">
                            <div class="form-group">
                                <div class="card card-solid mt-5">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12 col-sm-6">
                                                <h3 class="d-inline-block d-sm-none">Livre</h3>
                                                <div class="col-12">
                                                    <img src="{{ asset('assets/img/produit.jpg') }}" alt="logo"
                                                        width="50%">

                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-6">
                                                <h3 class="my-3">Nom du livre</h3>
                                                <p>
                                                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quidem
                                                    voluptate blanditiis placeat voluptas autem ipsa necessitatibus ea,
                                                    nulla fugit unde tempora corporis ducimus maxime, eveniet qui commodi
                                                    sed, minima assumenda.

                                                    Raw denim you probably haven't heard of them jean shorts Austin.
                                                    Nesciunt tofu stumptown aliqua butcher retro keffiyeh dreamcatcher
                                                    synth. Cosby sweater eu banh mi, qui irure terr.</p>

                                                <hr>
                                                <a href="{{ route('detail') }}">Voir plus</a>
                                                <div class="bg-gray py-2 px-3 mt-4">
                                                    <h2 class="mb-0">
                                                        5.000 fcfa
                                                    </h2>

                                                </div>

                                                <div class="mt-4">
                                                    <div class="btn btn-primary btn-lg btn-flat">
                                                        Payer
                                                    </div>


                                                </div>

                                            </div>
                                        </div>
                                        <!-- /.card-body -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

        </div>
        <!-- Default box -->

        </section>
        <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
        </div>
        <!-- ./wrapper -->

        <!-- jQuery -->
        <script src="../../plugins/jquery/jquery.min.js"></script>
        <!-- Bootstrap 4 -->
        <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- AdminLTE App -->
        <script src="../../dist/js/adminlte.min.js"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="../../dist/js/demo.js"></script>
        <script>
            $(document).ready(function() {
                $('.product-image-thumb').on('click', function() {
                    var $image_element = $(this).find('img')
                    $('.product-image').prop('src', $image_element.attr('src'))
                    $('.product-image-thumb.active').removeClass('active')
                    $(this).addClass('active')
                })
            })
        </script>
        </body>

    </html>
@endsection
