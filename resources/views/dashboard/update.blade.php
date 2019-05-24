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
				<h1>
					Actualizar datos de <strong>{{$info->name}} {{$info->lastName}}</strong>
					<a class="pull-right" href="{{url('/')}}"><i class="fa fa-arrow-left" aria-hidden="true"></i>
					</a>
				</h1>
				<div class="row">
					<div class="col-md-12">
						<form method="post" action="{{url('customer/update-by-user')}}">
						@include('alert.error')
						@include('alert.success')
						<input type="hidden" name="_token" value="{{csrf_token()}}">
						  <div class="form-row">
						    <div class="form-group col-md-6">
						      <label for="name">Nombre</label>
						      <input type="hidden"  value="{{$id}}" name="id">
						      <input type="text" class="form-control" value="{{$info->name}}" name="name">
						    </div>
						    
						    <div class="form-group col-md-6">
						      <label for="lastname">Apellido(s)</label>
						      <input type="text" class="form-control" value="{{$info->lastName}}" name="lastname">
						    </div>
						  </div>
						  
						  <div class="form-row">
							 <div class="form-group col-md-4">
						      <label for="lastname">Fecha de nacimiento</label>
						      <input type="date" class="form-control" value="{{( !empty($info->birthDate))? \Carbon\Carbon::parse($info->birthDate)->format('Y-m-d'): '' }}" name="birthdate">
						    </div>
						    
						    <div class="form-group col-md-4">
						      <label for="lastname">Teléfono</label>
						      <input type="text" class="form-control" maxlength="10" value="{{$info->phone}}" onKeyPress="return soloNumeros(event)" name="phone">
						    </div>
						    
						    
						    <div class="form-group col-md-4">
						      <label for="lastname">Número de tarjeta de crédito</label>
						      <input type="text" class="form-control" maxlength="16" value="{{$info->card}}" onKeyPress="return soloNumeros(event)" name="card">
						    </div>
						  </div>
						  
						  <div class="form-row">
						    <div class="form-group col-md-4">
						      <label for="email">Email</label>
						      <input type="email" class="form-control" value="{{$info->email}}" name="email">
						    </div>
						    <div class="form-group col-md-4">
						      <label for="password">Password</label>
						      <input type="password" class="form-control" name="password" placeholder="*******">
						    </div>
						  
						    <div class="form-group col-md-4">
						      <label for="status">Estatus</label>
						      <select name="status" class="form-control">
						        <option value="">--Seleccione--</option>
						        @foreach($statusOption as $value)
						        <option {{($info->statusId == $value->id) ? 'selected': '' }} value="{{$value->id}}">{{$value->name}}</option>
						        @endforeach
						      </select>
						    </div>
						  </div>
						  <button type="submit" class="btn btn-primary btn-block">Actualizar</button>
						</form>
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
	});
</script>
@endsection