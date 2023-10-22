<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Document Title -->
    <title>Mondroit.bf</title>

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/png" href="favicon.png">

    <style>
        #btn-action {
            height: 75px;
            width: 75px;
            top: 80vh;
            left: 70vw;
            opacity: 0.3;
        }

        #btn-action:hover {
            opacity: 1;
        }

        /* // Small devices (landscape phones, 576px and up) */
        @media (min-width: 576px) {
            #btn-action {
                left: 85vw;
            }
        }

        /* Extra large devices (large desktops, 1200px and up) */
        @media (min-width: 1200px) {
            #btn-action {
                left: 90vw;
            }
        }

        // Large devices (desktops, less than 1200px)
        @media (max-width: 1199.98px) {
            #btn-action {
                left: 95vw;
            }
        }
    </style>

    <!-- CSS Files -->
    @include('includes.head_import')
</head>

<body>
    @if(!auth()->user()->isUser())
        <a href="{{ route('articleAdmin.index') }}" class="text-decoration-none  text-light fw-bold">
            <div class="btn-group fixed-top " id="btn-action" style="">
                <button type="button" class="btn btn-primary rounded-circle p-3">
                    Admin
                </button>
            </div>
        </a>
    @endif
    <!-- <div class="container"> -->

    <!-- Preloader -->
    <div class="preLoader"></div>

    <!-- Main header -->
    @include('includes.navbar')
    <!-- End of Main header -->

    @yield('content')

    <!-- Footer -->
    @include('includes.footer')
    <!-- End of Footer -->

    <!-- Back to top -->
    <div class="back-to-top">
        <a href="#"> <i class="fas fa-arrow-up"></i></a>
    </div>
    <!-- </div> -->

    <!-- JS Files -->
    @include('includes.script_import')
    @yield('custom_script')
</body>

</html>
