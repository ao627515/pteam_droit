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
