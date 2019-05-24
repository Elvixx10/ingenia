
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
	integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
	crossorigin="anonymous"></script>
	
@yield('js')
<script type="text/javascript">
	$(function(){
		$("#search").keypress(function(e) {
			let code = (e.keyCode ? e.keyCode : e.which);
	        if(code==13){
	        	window.location.href = "{{url('/customer/dashboard')}}/"+$.trim($(this).val());
	        }
		});
	});

	function soloNumeros(e){
		var key = window.Event ? e.which : e.keyCode
		return ((key >= 48 && key <= 57) || (key==8))
	}
</script>
</body>
</html>