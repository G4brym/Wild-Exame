<!DOCTYPE html>
<head>
	<title>{{$title}}</title>
	<link rel="shortcut icon" type="image/ico" href="{{URL::to('/packages/images/favicon.ico')}}" />
	<meta name="keywords" content="" />
	<meta name="description" content="" />
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	{{ HTML::script(URL::to('/packages/resources/sweetalert/sweet-alert.js')) }}
    {{ HTML::style(URL::to('/packages/resources/sweetalert/sweet-alert.css')) }}
	{{ HTML::style('https://fonts.googleapis.com/css?family=Open+Sans:300,400,700') }}
	{{ HTML::style(URL::to('/packages/resources/font-awesome-4.2.0/css/font-awesome.min.css')) }}
	{{ HTML::style(URL::to('/packages/login/css/bootstrap.min.css')) }}
	{{ HTML::style(URL::to('/packages/login/css/bootstrap-theme.min.css')) }}
	{{ HTML::style(URL::to('/packages/login/css/templatemo_style.css')) }}	
</head>
<body class="templatemo-bg-gray">
	@yield('body')
	{{ HTML::script(URL::to('/packages/resources/js/jquery.js')) }}
	{{ HTML::script(URL::to('/packages/login/js/bootstrap.min.js')) }}
</body>
</html>