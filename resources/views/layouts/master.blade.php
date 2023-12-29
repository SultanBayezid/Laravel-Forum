<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Sultan Bayezid">
    <title>Forum - Assignment Project</title>
    <link href="{{asset('design/css/feather.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('design/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('design/css/custom.css')}}" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand navbar-light bg-light  p-0">
    <div class="container justify-content-center"> 
        <a class="navbar-brand mr-2" href="index.html">
            <img src="{{asset('template/img/logo.svg')}}" alt>
        </a>
        <form class="d-none d-sm-inline-block form-inline mr-auto my-2 my-md-0 mw-100 navbar-search">
          <div class="input-group">
            <input type="text" class="form-control shadow-none border-0" placeholder="Search people, jobs & more..." aria-label="Search" aria-describedby="basic-addon2">
            <div class="input-group-append">
              <button class="btn" type="button">
                <i class="feather-search"></i>
              </button>
            </div>
          </div>
        </form>
  
     
        <ul class="navbar-nav ml-auto d-flex align-items-center">
          <li class="nav-item dropdown no-arrow d-sm-none">
            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="feather-search mr-2"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right p-3 shadow-sm animated--grow-in" aria-labelledby="searchDropdown">
              <form class="form-inline mr-auto w-100 navbar-search">
                <div class="input-group">
                  <input type="text" class="form-control border-0 shadow-none" placeholder="Search people, jobs and more..." aria-label="Search" aria-describedby="basic-addon2">
                  <div class="input-group-append">
                    <button class="btn" type="button">
                      <i class="feather-search"></i>
                    </button>
                  </div>
                </div>
              </form>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('posts.index') }}">
              <i class="feather-briefcase mr-2"></i>
              <span class="d-none d-lg-inline">Posts</span>
            </a>
          </li>
     
   
          @if(Auth::check())
    
          <li class="nav-item dropdown no-arrow ml-1">
            <a class="nav-link dropdown-toggle pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          {{Auth::user()->name}}
            </a>
            <div class="dropdown-menu dropdown-menu-right shadow-sm">
              <div class="p-3 d-flex align-items-center">
                <div class="font-weight-bold">
                  <div class="text-truncate">{{Auth::user()->name}}</div>
                  <div class="small text-gray-500">{{auth::user()->email}}</div>
                </div>
              </div>
        
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="{{ route('logout') }}"  onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        
                <i class="feather-log-out mr-1"></i>  {{ __('Logout') }}
              </a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
            </div>

           

                          
          </li>
          @else
          <li class="nav-item">
        <a class="nav-link" href="{{ route('login') }}">Login</a>
    </li>
@endif
        </ul>
     
    </div>
</nav>


    <div class="py-4">
        <div class="container">
            <div class="row">
                <main class="col col-xl-9 col-lg-12 col-md-12 col-sm-12 col-12 mx-auto">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    @yield('content')
                </main>
            </div>
        </div>
    </div>
    <script src="{{asset('design/js/jquery-3.6.0.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('design/js/bootstrap.bundle.min.js')}}" type="text/javascript"></script>
    @stack('scripts')

</body>
</html>
