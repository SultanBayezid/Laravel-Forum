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

<nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom border-primary">
    <div class="container">
      <h4><span class="h1">P</span>roject Forum</h4>
    <ul class="navbar-nav mx-auto mt-3 ">
    <form action="{{route('search')}}" method="GET" class="mb-4">
        <div class="input-group">
        <input type="text" name="search" class="form-control" style="min-width:400px;" placeholder="Search posts with title, text or comments...">
            <button type="submit" class="btn btn-primary">Search</button>
        </div>
    </form>
        </ul>
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="{{ route('posts.index') }}">
              <i class="feather-briefcase mr-2"></i>
              <span class="d-none d-lg-inline">Home</span>
            </a>
          </li>
     
   
          @if(Auth::check())
    
          <li class="nav-item dropdown no-arrow ml-1">
            <a class="nav-link dropdown-toggle pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          {{auth::user()->name}}
            </a>
            <div class="dropdown-menu dropdown-menu-right shadow-sm">
              <div class="p-3 d-flex align-items-center">
                <div class="font-weight-bold">
                  <div class="text-truncate">{{auth::user()->name}}</div>
                  <div class="small text-gray-500">{{auth::user()->email}}</div>
                  @if(auth()->user()->email_verified_at)
                        <div class="small green">Verified</div>
                  @else
                        <div class="small red">Unverified</div>
                  @endif
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

    @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
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
