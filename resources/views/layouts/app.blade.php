<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="utf-8">
    {{-- <meta http-equiv="x-ua-compatible" content="ie=edge"> --}}
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>Investor</title>
    <meta name="robots" content="index, follow">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('logo.png') }}">
    <!-- Google font-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Work+Sans:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,500;1,600;1,700;1,800;1,900&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap">
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/dashboard/css/bootstrap.css') }}">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/dashboard/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/dashboard/css/custom.css') }}">

    {{-- Fancy Box Links --}}
    <link href="https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.umd.js"></script>

    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> --}}
    {{-- //DataTabel --}}
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/2.0.3/css/dataTables.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/3.0.1/css/buttons.dataTables.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" rel="stylesheet">
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    @include('company.css')
</head>

<body>

    <!-- page-wrapper Start-->
    <div class="page-wrapper">
        <!-- Page Header Start-->
        @yield('header')
        <!-- Page Header Ends -->
        <div class="page-body-wrapper">
            <!-- SideBar-->
            @yield('sidebar')
            <!-- SideBar Ends-->
            <div class="page-body">
                <!-- content-->
                @yield('content')
                <!-- content Ends-->
            </div>
            <!-- footer start-->

            <!-- footer end-->
        </div>
    </div>


    <!-- latest jquery-->
    {{-- <script src="{{ asset('assets/dashboard/assets/js/jquery-3.3.1.min.js') }}"></script> --}}
    <!-- Bootstrap js-->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    @include('admin.js')
    @include('company.js')

    <!-- Bootstrap js-->
    <script src="{{ asset('assets/dashboard/js/bootstrap.bundle.min.js') }}"></script>
    <!-- feather icon js-->
    <script src="{{ asset('assets/dashboard/js/icons/feather-icon/feather.min.js') }}"></script>
    <script src="{{ asset('assets/dashboard/js/icons/feather-icon/feather-icon.js') }}"></script>
    <!-- Sidebar jquery-->
    <script src="{{ asset('assets/dashboard/js/sidebar-menu.js') }}"></script>
    <script src="https://cdn.datatables.net/2.0.3/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.1/js/dataTables.buttons.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.1/js/buttons.dataTables.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.1/js/buttons.print.min.js"></script>

    <script>
        new DataTable('#example', {
            layout: {
                topStart: {
                    buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
                }
            }
        });
    </script>

    {{-- //toaster script and code link// --}}
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script>
        @if(Session::has('message'))
        toastr.options = {
            "closeButton": true
            , "progressBar": true
        }
        toastr.success("{{ session('message') }}");
        @endif

        @if(Session::has('error'))
        toastr.options = {
            "closeButton": true
            , "progressBar": true
        }
        toastr.error("{{ session('error') }}");
        @endif

    </script>
</body>

</html>
