<header class="header site-header shadow-sm">
        <nav class="navbar navbar-expand-lg navbar-dark bg-black top-menu">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}"><img src="{{ asset('img/logo/retro-shrine-h.png')}}" alt=""></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>
            
                <div class="collapse navbar-collapse" id="navbarColor01">
                        <form class="form-inline mr-auto">
                            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-primary my-2 my-sm-0" type="submit"><i class="nav-icon fa fa-search text-cyan"></i></button>
                        </form>

                @include('partials.menus.main-right')
                </div>
            </div>
        </nav>
        @include('partials.menus.mega-menu')
  </header>