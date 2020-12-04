<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bitly.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            <div class="container-fluid">
               
                <div class="row">
                    <div class="col-4 divLeft">
                        <span class="list--total">5 Links</span>
                        <ul class="list-group divLeft">
                            <li class="list-group-item divLeft">
                                <a class="bitlink-item--MAIN" style="display:flex;color:#36383b">
                                    <div>
                                        <span class="bitlink-item--checkbox">
                                            <input id="2Hx1q38" type="checkbox" class="checkbox--input">
                                            <label tabindex="0" for="2Hx1q38" class="checkmark-icon checkbox-icon"></label>
                                        </span>
                                    </div>
                                    <div>
                                        <time class="bitlink-item--created-date" datetime="2019-03-20">Mar 20, 2019</time>
                                        <div class="bitlink-item--title">Artikel Essenzo</div>
                                        <div class="bitlink--MAIN" tabindex="-1" 
                                            title="bit.ly/tidurlebihnyenyakdanberkualitas">bit.ly
                                            <span class="bitlink--hash">
                                                /tidurlebihnyenyakdanberkualitas
                                            </span>
                                        </div>
                                    </div>
                                    
                                </a>
                            </li>
                            <li class="list-group-item divLeft">
                                <a class="bitlink-item--MAIN" style="display:flex;color:#36383b">
                                    <div>
                                        <span class="bitlink-item--checkbox">
                                            <input id="2Hx1q38" type="checkbox" class="checkbox--input">
                                            <label tabindex="0" for="2Hx1q38" class="checkmark-icon checkbox-icon"></label>
                                        </span>
                                    </div>
                                    <div>
                                        <time class="bitlink-item--created-date" datetime="2019-03-20">Mar 20, 2019</time>
                                        <div class="bitlink-item--title">Artikel Essenzo</div>
                                        <div class="bitlink--MAIN" tabindex="-1" 
                                            title="bit.ly/tidurlebihnyenyakdanberkualitas">bit.ly
                                            <span class="bitlink--hash">
                                                /tidurlebihnyenyakdanberkualitas
                                            </span>
                                        </div>
                                    </div>
                                    
                                </a>
                            </li>
                            <li class="list-group-item divLeft">
                                <a class="bitlink-item--MAIN" style="display:flex;color:#36383b">
                                    <div>
                                        <span class="bitlink-item--checkbox">
                                            <input id="2Hx1q38" type="checkbox" class="checkbox--input">
                                            <label tabindex="0" for="2Hx1q38" class="checkmark-icon checkbox-icon"></label>
                                        </span>
                                    </div>
                                    <div>
                                        <time class="bitlink-item--created-date" datetime="2019-03-20">Mar 20, 2019</time>
                                        <div class="bitlink-item--title">Artikel Essenzo</div>
                                        <div class="bitlink--MAIN" tabindex="-1" 
                                            title="bit.ly/tidurlebihnyenyakdanberkualitas">bit.ly
                                            <span class="bitlink--hash">
                                                /tidurlebihnyenyakdanberkualitas
                                            </span>
                                        </div>
                                    </div>
                                    
                                </a>
                            </li>
                            <li class="list-group-item divLeft">
                                <a class="bitlink-item--MAIN" style="display:flex;color:#36383b">
                                    <div>
                                        <span class="bitlink-item--checkbox">
                                            <input id="2Hx1q38" type="checkbox" class="checkbox--input">
                                            <label tabindex="0" for="2Hx1q38" class="checkmark-icon checkbox-icon"></label>
                                        </span>
                                    </div>
                                    <div>
                                        <time class="bitlink-item--created-date" datetime="2019-03-20">Mar 20, 2019</time>
                                        <div class="bitlink-item--title">Artikel Essenzo</div>
                                        <div class="bitlink--MAIN" tabindex="-1" 
                                            title="bit.ly/tidurlebihnyenyakdanberkualitas">bit.ly
                                            <span class="bitlink--hash">
                                                /tidurlebihnyenyakdanberkualitas
                                            </span>
                                        </div>
                                    </div>
                                    
                                </a>
                            </li>
                            <li class="list-group-item divLeft">
                                <a class="bitlink-item--MAIN" style="display:flex;color:#36383b;">
                                    <div>
                                        <span class="bitlink-item--checkbox">
                                            <input id="2Hx1q38" type="checkbox" class="checkbox--input">
                                            <label tabindex="0" for="2Hx1q38" class="checkmark-icon checkbox-icon"></label>
                                        </span>
                                    </div>
                                    <div>
                                        <time class="bitlink-item--created-date" datetime="2019-03-20">Mar 20, 2019</time>
                                        <div class="bitlink-item--title">Artikel Essenzo</div>
                                        <div class="bitlink--MAIN" tabindex="-1" 
                                            title="bit.ly/tidurlebihnyenyakdanberkualitas">bit.ly
                                            <span class="bitlink--hash">
                                                /tidurlebihnyenyakdanberkualitas
                                            </span>
                                        </div>
                                    </div>
                                    
                                </a>
                            </li>
                            <!-- <li class="list-group-item">Second item</li>
                            <li class="list-group-item">Third item</li> -->
                        </ul> 
                    </div>
                    <div class="col-8 detail">
                        One of three columns
                    </div>
                    
                </div>
            </div> 
        
        </main>
    </div>
</body>
</html>
