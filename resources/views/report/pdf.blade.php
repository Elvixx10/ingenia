<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>{{ $title }}</title>
	<link rel="stylesheet"
	href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
	integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
	crossorigin="anonymous">
</head>

<body>
	<h1>{{ $title }}</h1>
	<table class="table">
		<thead class="thead-dark text-center">
			<tr>
				<th scope="col">#</th>
				<th scope="col">Nombre</th>
				<th scope="col">Email</th>
				<th scope="col">Fecha de nacimiento</th>
			</tr>
		</thead>
		<tbody class="text-center">
			@foreach($all as $user)
			<tr>
				<th scope="row">{{$user->id}}</th>
				<td>{{$user->name}} {{$user->lastName}}</td>
				<td>{{$user->email}}</td>
				<td>{{ ( !empty($user->birthDate))? \Carbon\Carbon::parse($user->birthDate)->format('d/m/Y'): 'N/A' }}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</body>
</html>