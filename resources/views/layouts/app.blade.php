<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Bitnow') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('fontend/css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap-datepicker3.css')}}"> 
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
    <!-- Scripts -->
    <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/home.js') }}"></script>
    <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="{{asset('js/bootstrap-datepicker.min.js')}}"></script>

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand header-button" href="{{ url('/') }}">
                        {{ config('app.name', 'Bitnow') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                            <li class="header-menu">
                                <select name="localization" id="localization" class="localization" onchange="on_changeLang();">
                                    <option value="en" @if(Config::get('app.locale') == 'en') selected @endif> English</option>
                                    <option value="kr" @if(Config::get('app.locale') == 'kr') selected @endif>한국어</option>
                                </select>
                            </li>
                        @if (Auth::guest())
                            <li><a href="{{ route('login') }}" class="header-menu">@lang('message.signin')</a></li>
                            <li><a href="{{ route('register') }}" class="header-menu">@lang('message.signup')</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle header-menu" data-toggle="dropdown" role="button" aria-expanded="false">
                                    <i class="fa fa-user-circle" aria-hidden="true"></i>&nbsp;{{ Auth::user()->first_name.' '.Auth::user()->last_name}} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('home') }}">
                                            Home
                                        </a>
                                        <a href="{{ route('profile') }}">
                                            Profile Details
                                        </a>
                                        <!-- <a href="{{ route('walletinfo') }}">
                                            Wallet Information
                                        </a> -->
                                        <a href="{{ route('paymentmethod') }}">
                                            View Payment Method
                                        </a>
                                        <a href="{{ route('faq') }}">
                                            FAQ
                                        </a>
                                        <a href="{{ route('transactions') }}">
                                            My Transactions
                                        </a>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')
    </div>



</body>
<script type="text/javascript">
function on_changeLang() {
    var lang = $("#localization").val();
    $.ajax({
                url: '/localization',
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType : 'json',
                data: {lang: lang},    
                success: function(res) {
                    console.log(res);
                   location.reload();
                }
            });

}
</script>
</html>
