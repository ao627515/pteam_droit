<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Document Title -->
    <title>Mondroit.bf</title>

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/png" href="favicon.png">

    <!-- CSS Files -->
    @include("includes.head_import")
</head>

<body>

    <!-- <div class="container"> -->

        <!-- Preloader -->
        <div class="preLoader"></div>

        <!-- Main header -->
        @include("includes.navbar")
        <!-- End of Main header -->

        @yield("content")

        <!-- Footer -->
        @include("includes.footer")
        <!-- End of Footer -->

        <!-- Back to top -->
        <div class="back-to-top">
            <a href="#"> <i class="fas fa-arrow-up"></i></a>
        </div>
    <!-- </div> -->

    <!-- JS Files -->
    @include("includes.script_import")
    @yield('custom_script')
</body>

</html>