

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<!-- Bootstrap JS -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<!-- BootstrapFormHelpers -->
	<script src="{{ asset('BootstrapFormHelpers/dist/js/bootstrap-formhelpers.min.js') }}"></script>

@if( ! isset($loadVue) ||  $loadVue)    
	<script src="{{ asset('js/app.js') }}"></script>
@else
	<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.0/js/toastr.min.js"></script>
@endif
<script src="{{ asset('js/main.js') }}"></script>



<script>
@if(session('message'))
	toastr.success("{{ session('message')}}"); 
@elseif(session('info'))
	toastr.info("{{ session('info')}}");
@elseif(session('error'))
	toastr.error("{{ session('error')}}"); 
@endif

window.csrf = { value: "{{ csrf_token() }}" }


</script>

@yield('scripts')