<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Leqqr managen</title>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

        <script type="text/javascript" src="//code.jquery.com/jquery-1.10.2.js"></script>
        <script type="text/javascript" src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
        <script type="text/javascript" src={{ url("assets/js/qz-tray/3rdparty/deployJava.js" )}}></script>
        <script type="text/javascript" src={{ url("assets/js/qz-tray/qz-websocket.js" )}}></script>
        <script type="text/javascript" src={{ url("assets/js/qz-print.js" )}}></script>
        <script type="text/javascript" src={{ url("assets/js/globals.js" )}}></script>

        <link rel="stylesheet" href="{{url('assets/css/admin.css')}}">

        @yield('head')

    </head>

    <body id='template-admin' class=''>
        @if(isset($form_route_name))
        {!! Form::open(array('route'=>array($form_route_name, isset($form_route_id) ? $form_route_id : null), 'files'=> true)) !!}
        {!! Form::hidden('_method', isset($form_method) ? $form_method : "POST") !!}
        @endif

        <header id='template'>
            <a href="{{route('dashboard')}}" class="logo"> </a>
            <section id="navigation">

                @if(isset($page_title))<h2 class="page-title">{{$page_title}}</h2>
                @else <h2 class="page-title">Pagina titel</h2>
                @endif;

                <nav id="main-nav">
                    <ul>
                        <li><a href=""></a></li>
                    </ul>
                </nav>
                <nav id="page-nav">
                    @yield('page-navigation')
                </nav>
            </section>
        </header>

        <aside id="template">

            <section class='user-info'>
                <h2>{{Auth::user()->companies()->first()->name}}</h2>
                @if(isset(Auth::user()->roles()->first()->display_name))<h5>{{Auth::user()->roles()->first()->display_name}}</h5>
                @else<h5>Rolnaam</h5>
                @endif

            </section>

            <nav>
                <ul>
                    <li><i class="fa fa-briefcase"></i><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li><i class="fa fa-briefcase"></i><a href="{{ route('admin.product.index') }}">Mijn producten</a></li>

                    <li><i class="fa fa-briefcase"></i><a href="{{ route('admin.order.index') }}">Mijn bestellingen</a></li>
                    <li><i class="fa fa-briefcase"></i><a href="{{ route('admin.company.show', Auth::user()->companies->first()->id) }}">Bedrijfsinformatie</a></li>
                </ul>


                @if(Auth::user()->can('manage_allergens'))
                <ul>
                    <li><i class="fa fa-briefcase"></i><a href="{{ route('admin.allergen.index') }}">Allergenen beheren</a></li>
                </ul>
                @endif





                <ul>
                    <li><i class="fa fa-user"></i><a href="{{ route('admin.account.show', Auth::user()->id)}}">Mijn Account</a></li>
                    <li><i class="fa fa-briefcase"></i><a href="{{ url('/logout') }}">Uitloggen</a></li>
                </ul>

            </nav>
        </aside>

        <section id="template-content" class='pagecontainer'>
            @if(count($errors) >0) <div class="cols-12 global-error-message">Er zijn fouten opgetreden. U dient deze te corrigeren om op te kunnen slaan.</div> @endif
            @yield('page-content')
        </section>

        @if(isset($form_route_name))
        {!! Form::close() !!}
        @endif

        @yield('page-after')

        @include('layouts.partials.socketio');
    </body>
</html>
