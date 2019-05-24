@extends('partial.master') @section('css')
<link href="{{asset('/css/dashboard.css')}}" rel="stylesheet">
@endsection @section('content')

<div class="container-fluid display-table">
	<div class="row display-table-row">
		<div
			class="col-md-2 col-sm-1 hidden-xs display-table-cell v-align box"
			id="navigation">
			<div class="navi">
				<ul>
					<li class="active"><a href="{{url('/')}}"><i class="fa fa-home"
							aria-hidden="true"></i><span class="hidden-xs hidden-sm">Inicio</span></a></li>
					<li><a href="{{url('logout')}}"><i class="fa fa-close" aria-hidden="true"></i><span
					class="hidden-xs hidden-sm">Cerrar sesión</span></a></li>
				</ul>
			</div>
		</div>

		<div class="col-md-10 col-sm-11 display-table-cell v-align">
			<div class="row">
				<header>
					<div class="col-md-12">
						<div class="search hidden-xs hidden-sm">
							<input type="text" placeholder="Buscar por nombre, email o id" id="search">
						</div>
					</div>
				</header>
			</div>

			<div class="user-dashboard">
				<h1>Listado de clientes</h1> 
				<div class="row">
					<div class="col-md-12">
					@if($all->count() > 0)
					<a href="{{url('customer/generate-pdf/'.$like)}}"  class="btn btn-light btn-sm float-left">
						<i class="fa fa-file-pdf-o" aria-hidden="true"></i> Exportar
					</a>
					<a href="{{url('customer/download-excel/'.$like)}}"  class="btn btn-light btn-sm float-left">
						<i class="fa fa-file-excel-o" aria-hidden="true"></i> Exportar
					</a>
					@endif
					
					<a href="{{url('customer/create-by-user')}}" class="btn btn-outline-secondary btn-sm float-right">
						<i class="fa fa-user-plus" aria-hidden="true"></i>
					</a>
					
					<a href="{{url('customer/dashboard')}}" class="btn btn-outline-secondary btn-sm float-right">
						<i class="fa fa-repeat" aria-hidden="true"></i>
					</a>
					
					@if($all->count() > 0)
					<table class="table">
						<thead class="thead-dark text-center">
							<tr>
								<th scope="col">#</th>
								<th scope="col">Nombre</th>
								<th scope="col">Email</th>
								<th scope="col">Fecha de nacimiento</th>
								<th scope="col">Acciones</th>
							</tr>
						</thead>
						<tbody class="text-center">
							@foreach($all as $user)
							<tr>
								<th scope="row">{{$user->id}}</th>
								<td>{{$user->name}} {{$user->lastName}}</td>
								<td>{{$user->email}}</td>
								<td>{{ ( !empty($user->birthDate))? \Carbon\Carbon::parse($user->birthDate)->format('d/m/Y'): 'N/A' }}</td>
								<th><a href="{{url('customer/edit-by-user/'.$user->id)}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> | <a class="deleteUser" href="{{url('customer/delete-by-user/'.$user->id)}}"><i class="fa fa-trash-o" aria-hidden="true"></i></a></th>
							</tr>
							@endforeach
						</tbody>
					</table>
					
					<div class="pull-right">
						{{ $all->links() }}
					</div>
					@else
						<br>
						<h1 class="text-center">No se encontraron resultados para su búsqueda.</h1>
					@endif
					</div>
				</div>
			</div>

		</div>
	</div>
</div>
@endsection @section('js')
<script type="text/javascript">
$(function() {
   $('[data-toggle="offcanvas"]').click(function(){
       $("#navigation").toggleClass("hidden-xs");
   });


   $("a.deleteUser").click(function() {	
		var a = $(this).attr("href");
		var m = confirm("¿Estas seguro de eliminar el cliente?")
		if(m) {
			window.location.href = a;
		} 
		return false;   
   });
});
</script>
@endsection
