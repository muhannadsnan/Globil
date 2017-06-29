

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<!-- Bootstrap JS -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<!-- BootstrapFormHelpers -->
	<script src="{{ asset('BootstrapFormHelpers/dist/js/bootstrap-formhelpers.min.js') }}"></script>
    
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/main.js') }}"></script>



<script>
<?php if(session('message')){ ?>
	toastr.success("<?php echo session('message'); ?>"); 
<?php } ?>

window.csrf = { value: "{{ csrf_token() }}" }

$(document).ready(function(){
       $('[data-toggle="tooltip"]').tooltip();
    });
</script>

@yield('scripts')