<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Panel')</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>    
    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/laravel-echo@1.11.3/dist/echo.iife.js"></script>

    <style>
        body {
            overflow: hidden; /* Hilangkan overflow horizontal */
        }
        .content {
            height: calc(100vh - 56px); /* Sesuaikan dengan tinggi navbar */
            overflow-y: auto; /* Biar cuma content yang bisa di-scroll */
        }
        #sidebar {
            width: 256px;
        }
        .border-left-primary {
        border-left: 0.25rem solid #4e73df !important;
        }
        .border-left-success {
            border-left: 0.25rem solid #1cc88a !important;
        }
        .border-left-info {
            border-left: 0.25rem solid #36b9cc !important;
        }
        /* Sidebar di mobile jadi fixed dan bisa disembunyikan */
        @media (max-width: 991.98px) {
            #sidebar {
                position: fixed;
                top: 89px;
                left: -264px;
                height: 100vh;
                transition: left 0.3s ease-in-out;
                z-index: 1000;
            }

            #sidebar.show {
                left: 0;
            }

            .navbar {
                position: fixed;
                top: 0;
                height: 89px;
                width: 100%;
                z-index: 1050;
            }
            .content {
                padding-top: 89px !important;
                width: 100%;
            }
        }
    </style>
    @stack('styles')
</head>
<body>
    @include('components.navbar')
    <div class="d-flex">
        @include('components.sidebar')
        <div class="content flex-grow-1 p-4 isi-content" style="background-color: #FAFAFA;">
            @yield('content')
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.toggler-btn').on('click', function () {
                $('#sidebar').toggleClass('show');
            });
        });
    </script>
    @stack('scripts')
</body>
</html>