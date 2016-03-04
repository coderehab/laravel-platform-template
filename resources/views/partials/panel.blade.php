<section id="{{$id}}" class='panel {{$classes}}'>

	<header>
		@if($title)
		<h2>{{$title}}</h2>
		@yield('panel-header-'.$panelID)
		@endif
	</header>
	<section class='content'>
		@yield('panel-content-'.$panelID)
	</section>
</section>
