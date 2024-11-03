<!DOCTYPE html>

<!-- =========================================================
* Sneat - Bootstrap 5 HTML Admin Template - Pro | v1.0.0
==============================================================

* Product Page: https://themeselection.com/products/sneat-bootstrap-html-admin-template/
* Created by: ThemeSelection
* License: You must have a valid license purchased in order to legally use the theme for your project.
* Copyright ThemeSelection (https://themeselection.com)

=========================================================
 -->
<!-- beautify ignore:start -->
<html
  lang="en"
  class="light-style customizer-hide"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../assetsLogin/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>Login Basic - Pages | Sneat - Bootstrap 5 HTML Admin Template - Pro</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../assetsLogin/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="../assetsLogin/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="../assetsLogin/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="../assetsLogin/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="../assetsLogin/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="../assetsLogin/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="../assetsLogin/vendor/css/pages/page-auth.css" />
    <!-- Helpers -->
    <script src="../assetsLogin/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="../assetsLogin/js/config.js"></script>
  </head>

  <body>
    <!-- Content -->
    
    <section>
        @yield('auth-container')
    </section>


    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="../assetsLogin/vendor/libs/jquery/jquery.js"></script>
    <script src="../assetsLogin/vendor/libs/popper/popper.js"></script>
    <script src="../assetsLogin/vendor/js/bootstrap.js"></script>
    <script src="../assetsLogin/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="../assetsLogin/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->
    <script src="../assetsLogin/js/main.js"></script>

    <!-- Page JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if ($message = Session::get('success'))
        <script>
          Swal.fire("{{ $message }}");
        </script>
    @endif

    @if ($message = Session::get('failed'))
        <script>
          Swal.fire("{{ $message }}");
        </script>
    @endif

    
    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
  </body>
</html>
