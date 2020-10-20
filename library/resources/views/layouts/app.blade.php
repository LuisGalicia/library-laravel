<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Library</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/materialize.js') }}" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/materialize.css') }}" rel="stylesheet">

    <style>
          header, footer {
      padding-left: 300px;
    }
    main {
        padding-left: 320px;
    }

    @media only screen and (max-width : 992px) {
      header, main, footer {
        padding-left: 0;
      }
    }
    </style>
</head>
<body>
    <div id="app">
        <header>
            <nav>
                <div class="nav-wrapper light-blue darken-3">
                  <a href="#" class="brand-logo center">Lara Library</a>
                  <a href="#" data-target="slide-out" class="sidenav-trigger left"><i class="material-icons">menu</i></a>
                </div>
              </nav>
              <ul id="slide-out" class="sidenav sidenav-fixed">
                <li><div class="user-view">
                  <div class="background">
                    <img src="/images/fondo.jpg">
                  </div>
                  <a href="#user"><img class="circle" src="/images/library-table.jpg"></a>
                  <a href="#name"><span class="white-text name">Luis David Galicia</span></a>
                  <a href="#email"><span class="white-text email">david_galicia_garcia@outlook.es</span></a>
                </div></li>
                <li><a href="{{ route('book.show')  }}"><i class="material-icons">book</i>Books</a></li>
                <li><a href="{{ route('category.show')  }}"><i class="material-icons">bookmark_border</i>Categories</a></li>
                <li><a href="{{ route('guest.show')  }}"><i class="material-icons">person</i>Guests</a></li>
              </ul>
        </header>
        <main>
            @yield('content')
        </main>
    </div>
    <script>
       $(document).ready(function(){
           $('.modal').modal();
            $('.sidenav').sidenav();
            $('.datepicker').datepicker({
                format: 'yyyy-mm-dd'
            });
        });
    </script>
</body>
</html>
