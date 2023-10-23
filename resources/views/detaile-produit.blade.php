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

            <!-- Main content -->
            <section class="container content form-group">
         <h3></h3>

        </div>

        <section class="page-title-wrap position-relative bg-light">
            <div id="particles_js"></div>
            <div class="container">
                <div class="row">
                    <div class="col-11">
                        <div class="page-title position-relative pt-5 pb-5">
                            <ul class="custom-breadcrumb roboto list-unstyled mb-0 clearfix" data-animate="fadeInUp" data-delay="1.2">
                                <li><a href="index.html">Accueil</a></li>
                                <li><i class="fas fa-angle-double-right"></i></li>
                                <li><a href="#">Publications</a></li>
                            </ul>
                            <h1 data-animate="fadeInUp" data-delay="1.3">DROIT CONSTITUTIONNEL</h1>
                        </div>
                    </div>
                    <div class="col-1">
                        <div class="world-map position-relative">
                            <img src="img/map.svg" alt="" alt="" data-no-retina class="svg">>
                        </div>
                    </div>
                </div>
            </div>
        </section>
            <!-- Blog -->
            <section class="blog pt-7 pb-7">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 order-last">
                            <!-- Posts -->
                            <div class="row">
                                @foreach([1, ] as $produit )
                                <div class="col-md-12">
                                    <div class="single-post" data-delay=".1">
                                        <div class="image-hover-wrap">
                                            <img src="{{asset('assets/img/produit.jpg')}}"  >

                                        </div>
                                        <span class="text-dark">Publié le <a class="text-dark" href="#">19/09/2017</a></span>

                                        <a href="" class="text-primary">Droit administratif</a>
                                        <h4 class="text-warning">
                                          5.000 fcfa
                                      </h4>
                                      <h4 class="text-end"> stock : 5545 </h4>
                                        <div class="text-dark">

                                          Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellendus, odit ab iusto ullam ea in dicta doloribus impedit, dolores iste neque, unde provident voluptatem ad vero quas fugiat corrupti sapiente.
                                          Lorem ipsum dolor sit amet consectetur adipisicing elit. Autem, voluptates eligendi deleniti earum minima iste doloremque eveniet reprehenderit officia inventore ad labore laboriosam necessitatibus omnis distinctio similique, animi veritatis ut?
                                          Lorem ipsum dolor sit amet consectetur adipisicing elit. Alias, temporibus sint. Id, recusandae libero! Nemo laudantium maxime accusamus neque quibusdam consequuntur error illum necessitatibus, minima, eos vero consequatur aliquam optio?
                                          Lorem ipsum dolor sit amet consectetur adipisicing elit. Exercitationem, labore sapiente dignissimos itaque, sint reiciendis dolorum atque obcaecati eius vero repudiandae alias possimus pariatur voluptatem suscipit reprehenderit molestias ipsam velit.

                                        </div>
                                        <div >
                                            <div class="btn btn-primary btn-flat"> <a href="{{route('paiement.create')}}">Payer</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                               @endforeach
                            </div>

                            <!-- Pagination -->
                            <ul class="custom-pagination list-inline text-center text-uppercase mt-4" data-animate="fadeInUp" data-delay=".1">
                                <li class="float-left disabled"><a href="#"><i class="fas fa-caret-left"></i> Prev</a></li>
                                <li class="active"><a href="#">01</a></li>
                                <li><a href="#">02</a></li>
                                <li><a href="#">03</a></li>
                                <li><a href="#">04</a></li>
                                <li><a href="#">05</a></li>
                                <li class="float-right"><a href="#">Next <i class="fas fa-caret-right"></i></a></li>
                            </ul>
                        </div>

                        <!-- Sidebar -->
                        <div class="col-md-4">
                            <aside>
                                <div class="single-widget" data-animate="fadeInUp" data-delay=".1">
                                    <form action="#">
                                        <div class="form-group position-relative mb-0">
                                            <input class="form-control" type="text" placeholder="Rechercher" data-parsley-required-message="Please type at least one word." data-parsley-minlength="3" data-parsley-minlength-message="Please type at least one word." required>
                                            <button type="submit"><i class="fas fa-search"></i></button>
                                        </div>
                                    </form>
                                </div>

                                <div class="single-widget" data-animate="fadeInUp" data-delay=".1">
                                    <h3 data-animate="fadeInUp" data-delay=".2">Categories</h3>
                                    <ul class="widget-categories list-unstyled mb-0">
                                        <li data-animate="fadeInUp" data-delay=".25"><a href="#"><span>Droit du travail</span><span class="count">55</span></a></li>
                                        <li data-animate="fadeInUp" data-delay=".3"><a href="#"><span>Droit du commerce</span><span class="count">10</span></a></li>
                                        <li data-animate="fadeInUp" data-delay=".35"><a href="#"><span>Droit civil</span><span class="count">23</span></a></li>
                                        <li data-animate="fadeInUp" data-delay=".4"><a href="#"><span>Droit penal</span><span class="count">46</span></a></li>

                                    </ul>
                                </div>

                                {{-- <div class="single-widget" data-animate="fadeInUp" data-delay=".1">
                                    <h3 data-animate="fadeInUp" data-delay=".2">Publications Récentes</h3>
                                    <ul class="recent-posts list-unstyled mb-0">
                                        <li data-animate="fadeInUp" data-delay=".25"><a href="#">How to Watch Smith VS Holzken Live Online From Anywhere?</a></li>
                                        <li data-animate="fadeInUp" data-delay=".3"><a href="#">In Major Hiring Push, Web Hosting Powerhouse Go Daddy to Expand</a></li>
                                        <li data-animate="fadeInUp" data-delay=".35"><a href="#">Lorem ipsum dolor sit amet, consectetur adipisicing elit fastus.</a></li>
                                        <li data-animate="fadeInUp" data-delay=".4"><a href="#">How to Watch Emmett VS Stephens at UFC Fight Night FOX 28?</a></li>
                                        <li data-animate="fadeInUp" data-delay=".45"><a href="#">UK children being subjected to invasive data retention</a></li>
                                    </ul>
                                </div> --}}

                                <div class="single-widget text-center" data-animate="fadeInUp" data-delay=".1">
                                    <h3 data-animate="fadeInUp" data-delay=".2">Publicité</h3>
                                    <img src="{{asset('assets/img/camera.jpg')}}" alt="" data-animate="fadeInUp" data-delay=".25">
                                </div>
                            </aside>
                        </div>
                    </div>
                </div>
            </section>
            <!-- End of Blog -->

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
