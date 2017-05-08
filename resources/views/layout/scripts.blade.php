<script>
	window.Laravel = <?php echo json_encode([ 'csrfToken' => csrf_token(), ]) ?>
</script>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    
<script src="js/app.js"></script>

<script src="https://npmcdn.com/tether@1.2.4/dist/js/tether.min.js"></script>

@yield('scripts')