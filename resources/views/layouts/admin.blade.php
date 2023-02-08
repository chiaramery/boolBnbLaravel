<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- Vite --}}
    @vite(['resources/js/app.js'])

    {{-- Fontawesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title></title>
</head>
<body>
    {{-- @yield('content') --}}
    
    <body> 
        <div> 
            {{-- Header --}} 
            <header class="navbar navbar-dark bg-primary sticky-top  flex-md-nowrap p-2 shadow"> 
                <div class="row justify-content-between"> 
                    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="/">BoolBnB</a> 
                    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" 
                        data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" 
                        aria-expanded="false" aria-label="Toggle navigation"> 
                        <span class="navbar-toggler-icon"></span> 
                    </button> 
                </div> 
                <div class="navbar-nav"> 
                    <div class="nav-item text-nowrap ms-2"> 
                        <a class="nav-link" href="{{ route('logout') }}" 
                            onclick="event.preventDefault(); 
                            document.getElementById('logout-form').submit();"> 
                            {{ __('Logout') }} 
                        </a> 
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none"> 
                            @csrf 
                        </form> 
                    </div> 
                </div> 
            </header> 
            {{-- /Header --}} 
     
            <div class="container-fluid vh-100"> 
                <div class="row h-100"> 
                    {{-- Sidebar --}} 
                    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-primary navbar-dark sidebar collapse"> 
                        <div class="position-sticky pt-3"> 
                            <ul class="nav flex-column"> 
                                <li class="nav-item"> 
                                    <a class="nav-link text-white {{ Route::currentRouteName() === 'admin.dashboard' ? 'bg-info' : '' }}" 
                                        href="{{ route('admin.dashboard') }}"> 
                                        <i class="fa-solid fa-list"></i> 
                                        Dashboard 
                                    </a> 
                                </li> 
                                <li class="nav-item"> 
                                    <a class="nav-link text-white {{ Route::currentRouteName() === 'admin.apartments.index' ? 'bg-info' : '' }}" 
                                        href="{{ route('admin.apartments.index') }}"> 
                                        <i class="fa-regular fa-building"></i>
                                        Appartamenti 
                                    </a> 
                                </li> 
                                <li class="nav-item"> 
                                    <a class="nav-link text-white {{ Route::currentRouteName() === 'admin.apartments.create' ? 'bg-info' : '' }}" 
                                        href="{{ route('admin.apartments.create') }}"> 
                                        <i class="fa-solid fa-plus"></i>
                                        Crea
                                    </a> 
                                </li> 
                            </ul> 
                        </div> 
                    </nav> 
                    {{-- /Sidebar --}} 
     
                    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4"> 
                        @yield('content') 
                    </main> 
                </div> 
            </div> 
        </div> 
    </body>
</body>
</html>