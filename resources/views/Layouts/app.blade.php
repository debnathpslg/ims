<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="description" content="" />
        <meta name="author" content="" />

        <link
            rel="icon"
            type="image/png"
            sizes="16x16"
            href="{{ asset('storage/assets/images/favicon.png') }}"
        />
        <title>
            {{ config('app.name', 'Laravel') }}
        </title>
        <link href="{{ asset('storage/assets/libs/fullcalendar/dist/fullcalendar.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('storage/assets/extra-libs/calendar/calendar.css') }}" rel="stylesheet" />
        <link href="{{ asset('storage/dist/css/style.min.css') }}" rel="stylesheet" />
    </head>
    <body>
        <div class="preloader">
            <div class="lds-ripple">
                <div class="lds-pos"></div>
                <div class="lds-pos"></div>
            </div>
        </div>

        <div id="main-wrapper">
            <x-header />

            <aside class="left-sidebar">
                <x-leftsidebar />
            </aside>

            <div class="page-wrapper">
                <x-breadcrumb :breadCrumbProps="$breadCrumbProps" />

                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    @if(session('success'))
                                        <div class="alert alert-success alert-dismissible fade show">
                                            {{ session('success') }}
                                        </div>
                                    @endif

                                    @if(session('error'))
                                        <div class="alert alert-danger alert-dismissible fade show">
                                            {{ session('error') }}
                                        </div>
                                    @endif

                                    @if(session('warning'))
                                        <div class="alert alert-warning alert-dismissible fade show">
                                            {{ session('warning') }}
                                        </div>
                                    @endif

                                    @if(session('info'))
                                        <div class="alert alert-info alert-dismissible fade show">
                                            {{ session('info') }}
                                        </div>
                                    @endif

                                    @yield('content')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="{{ asset('storage/assets/libs/jquery/dist/jquery.min.js') }}"></script>
        <script src="{{ asset('storage/assets/extra-libs/taskboard/js/jquery.ui.touch-punch-improved.js') }}"></script>
        <script src="{{ asset('storage/assets/extra-libs/taskboard/js/jquery-ui.min.js') }}"></script>

        <script src="{{ asset('storage/assets/libs/popper.js/dist/umd/popper.min.js') }}"></script>
        <script src="{{ asset('storage/assets/libs/bootstrap/dist/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('storage/dist/js/app.min.js') }}"></script>
        <script src="{{ asset('storage/dist/js/app.init.js') }}"></script>
        <script src="{{ asset('storage/dist/js/app-style-switcher.js') }}"></script>
        <script src="{{ asset('storage/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js') }}"></script>
        <script src="{{ asset('storage/assets/extra-libs/sparkline/sparkline.js') }}"></script>
        <script src="{{ asset('storage/dist/js/waves.js') }}"></script>
        <script src="{{ asset('storage/dist/js/sidebarmenu.js') }}"></script>
        <script src="{{ asset('storage/dist/js/custom.min.js') }}"></script>
        <script src="{{ asset('storage/assets/libs/moment/min/moment.min.js') }}"></script>
        <script src="{{ asset('storage/assets/libs/fullcalendar/dist/fullcalendar.min.js') }}"></script>
        <script src="{{ asset('storage/dist/js/pages/calendar/cal-init.js') }}"></script>
        <script src="{{ asset('storage/assets/extra-libs/DataTables/datatables.min.js') }}"></script>
        <script src="{{ asset('storage/dist/js/pages/datatable/datatable-basic.init.js') }}"></script>
    </body>
</html>