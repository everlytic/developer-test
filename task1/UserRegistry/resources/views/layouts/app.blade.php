<!doctype html>
<html lang="en">
	<head>
	    <meta charset="UTF-8" />
	    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" />
	    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
	    <title>User Listing</title>

	    <!-- Stylesheets -->
	    <link href="https://fonts.googleapis.com/css?family=Open+Sans|Roboto&display=swap" rel="stylesheet" />
	    <link rel="stylesheet" href="{{ URL::asset('css/style.css') }}" />

	    <!-- Scripts -->
	    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
	    <script src="https://kit.fontawesome.com/69c66c8ef0.js"></script>
	    <script src="{{ URL::asset('js/functions.js') }}"></script>
	</head>
	<body>
		@yield('content')
	</body>
</html>