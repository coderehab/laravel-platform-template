<section id="{{$id}}" class='popup {{$classes}}'>
	<div class='bg'></div>

	<section class='inner'>
		<header>
			@if($title)
			<h2>{{$title}}</h2>
			@endif
			@yield('popup-header-'.$popupID)
		</header>
		<section class='content'>
			@yield('popup-content-'.$popupID)
		</section>
	</section>

</section>
