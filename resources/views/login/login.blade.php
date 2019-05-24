@extends('partial.master')

@section('css')
<link href="{{asset('/css/login.css')}}" rel="stylesheet">
@endsection

@section('content')
<div class="container">
	<div class="card card-container">
		<img id="profile-img" class="profile-img-card"
			src="//ssl.gstatic.com/accounts/ui/avatar_2x.png" />
		<p id="profile-name" class="profile-name-card"></p>
		<form method="post" action="{{url('login')}}" class="form-signin">
			@include('alert.error')
			<input type="hidden" name="_token" value="{{csrf_token()}}">
			<span id="reauth-email" class="reauth-email"></span> <input
				type="email" name="email" id="email" class="form-control"
				placeholder="Correo Electrónico" required  autofocus> 
				
				<input
				type="password" name="password" id="password" class="form-control"
				placeholder="Contraseña" required>
				
			<div class="checkbox">
				<label> <input type="checkbox" name="remember" id="remember" value="1"> Recordarme
				</label>
			</div>
			
			<button class="btn btn-lg btn-primary btn-block btn-signin"
				type="submit">Iniciar</button>
		</form>
		<!-- /form -->
		<!-- <a href="#" class="forgot-password"> Forgot the password? </a>-->
	</div>
	<!-- /card-container -->
</div>
<!-- /container -->
@endsection

@section('js')
<script type="text/javascript">
$(function(){
	getRemember();
	$("#remember").click(function(){
		let checked = $(this).is(":checked");
		if(checked) {
			sessionRemember($("#email").val(), $("#password").val());
		} else {
			window.localStorage.clear();
		    window.sessionStorage.clear();
		}
	});
});

let sessionRemember = function(email, password) {
    if (typeof(Storage) !== "undefined") {
      window.localStorage.setItem("email", email);
      window.localStorage.setItem("password", password);
      window.sessionStorage.setItem("email", email);
      window.sessionStorage.setItem("password", password);
    } else {
       alert('Sorry! No Web Storage support', 'Error!');
       return false;
    }
 }

let getRemember = function() {
    if( window.localStorage.length > 0 || window.sessionStorage.length > 0 ){
    	$("#email").val(window.localStorage.getItem('email') || window.sessionStorage.getItem('email'));
    	$("#password").val(window.localStorage.getItem('password') || window.sessionStorage.getItem('password'));
    	$("#remember").prop("checked", true);
      }
}
</script>
@endsection