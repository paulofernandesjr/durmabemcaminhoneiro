<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="assets/img/logo-fav.png">
    <title>@yield('title') | Durma bem caminhoneiro</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('lib/select2/css/select2.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('lib/material-design-icons/css/material-design-iconic-font.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('lib/jquery.gritter/css/jquery.gritter.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('lib/dropzone/dropzone.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('lib/datetimepicker/css/bootstrap-datetimepicker.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('lib/bootstrap-slider/css/bootstrap-slider.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/switch-text.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/gallery.css') }}" />
</head>

<body>
    <div class="be-wrapper be-fixed-sidebar">
        <nav class="navbar navbar-expand fixed-top be-top-header">
            <div class="container-fluid">
                <div class="be-navbar-header">
                    <a class="navbar-brand" href="index.html"></a>
                </div>
                <div class="be-right-navbar">
                    <ul class="nav navbar-nav float-right be-user-nav">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ auth()->user()->nome }}
                            </a>
                            <form action="{{ route('logout') }}" method="post">
                                {{ csrf_field() }}
                                <div class="dropdown-menu" role="menu">
                                    <div class="user-info">
                                        <div class="user-name">{{ auth()->user()->nome }}</div>
                                    </div>
                                    <button type="submit" class="dropdown-item" style="cursor: pointer;">
                                        <span class="icon mdi mdi-power"></span>Sair
                                    </button>
                                </div>
                            </form>
                        </li>
                    </ul>
                    <div class="page-title"><span>@yield('title')</span></div>
                </div>
            </div>
        </nav>
        <div class="be-left-sidebar">
            <div class="left-sidebar-wrapper"><a class="left-sidebar-toggle" href="{{ route('home') }}">Dashboard</a>
                <div class="left-sidebar-spacer">
                    <div class="left-sidebar-scroll">
                        <div class="left-sidebar-content">
                            <ul class="sidebar-elements">
                                <li class="divider">Menu</li>
                                <li class="{{ request()->is('admin/home') ? 'active' : '' }}">
                                    <a href="{{ route('home') }}"><i class="icon mdi mdi-home"></i><span>Dashboard</span></a>
                                </li>
                                <li class="{{ request()->is('admin/locais') || request()->is('admin/locais/*') ? 'active' : '' }}">
                                    <a href="{{ route('locais.index') }}"><i class="icon mdi mdi-gas-station"></i><span>Locais</span></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="be-content">
            <div class="page-head">
                <h2 class="page-head-title">@yield('title')</h2>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb page-head-nav">
                        @yield('breadcrumb')
                    </ol>
                </nav>
            </div>
            @yield('content')
        </div>
    </div>
    <script src="{{ asset('lib/jquery/jquery.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('lib/bootstrap/dist/js/bootstrap.bundle.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/app.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/jquery.mask.js') }}" type="text/javascript"></script>
    <script src="{{ asset('lib/jquery.gritter/js/jquery.gritter.js') }}" type="text/javascript"></script>
    <script src="{{ asset('lib/dropzone/dropzone.js') }}" type="text/javascript"></script>
    <script src="{{ asset('lib/jquery.magnific-popup/jquery.magnific-popup.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('lib/masonry-layout/masonry.pkgd.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/app-page-gallery.js') }}" type="text/javascript"></script>
    <script src="{{ asset('lib/moment.js/min/moment.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('lib/datetimepicker/js/bootstrap-datetimepicker.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('lib/select2/js/select2.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('lib/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('lib/bootstrap-slider/bootstrap-slider.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/app-form-elements.js') }}" type="text/javascript"></script>
    <script type="text/javascript">
        $(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });

        $(window).on('load', function() {
            App.pageGallery();
            App.formElements();
        });
    </script>
    @yield('scripts')
</body>

</html>
