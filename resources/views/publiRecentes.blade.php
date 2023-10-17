@extends('layout')

@section('content')
    <div class="row">
        @foreach ($articles as $article)
            <div class="col-3">
                <div class="single-post" data-animate="fadeInUp" data-delay=".1">
                    <div class="image-hover-wrap">
                        <img src="{{ asset('assets/img/posts/post1.jpg') }}" alt="">
                        <div class="image-hover-content d-flex justify-content-center align-items-center text-center">
                            <ul class="list-inline">
                                <li><a href="#"><i class="fas fa-eye"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <span class="text-info">Par Autheur le 19 Jan 2022</span>
                    <h4 class="truncate-title">Torrent Pirates Prefer To Pay For Video Streaming Services</h4>
                    <a href="#">Lire l'article<i class="fas fa-caret-right"></i></a>
                </div>
            </div>
        @endforeach
    </div>
@endsection
