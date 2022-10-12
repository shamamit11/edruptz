<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="{{ asset('assets/js/dashboard.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/calander.js') }}"></script>

<script src="{{ asset('assets/plugins/sweetalert/sweetalert.min.js') }}"></script>
<script>
$('form input[type=text]').focus(function(){
	$(this).siblings(".error").hide();
});
$('form textarea').focus(function(){
	$(this).siblings(".error").hide();
});
$('form textarea').focus(function(){
	$(this).siblings(".error").hide();
});
</script>