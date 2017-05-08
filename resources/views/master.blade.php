<!DOCTYPE html>
<html lang="en">
  
  @include('layout.head')

  <body>

    @include('layout.nav')

    <div class="container">
      <div class="row">
        <div class="col-md-8 content">
        
          @yield('content')

        </div><!-- /.blog-main -->
        <div class="col-md-3 sidebar">

          @include('layout.sidebar')

        </div><!-- /.blog-sidebar -->
      </div><!-- /.row -->
    </div><!-- /.container -->
    
    @include('layout.footer')
    
  </body>
</html>
