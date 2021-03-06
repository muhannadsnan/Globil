<nav class="navbar my-theme">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="/home"><h2>Globil.no</h2></a>
    </div>

    
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" >
      
      <ul class="nav navbar-nav navbar-right">
        <li><a href="/messages"><i class="fa fa-envelope" aria-hidden="true"></i> My messages</a></li>
        
        @if(Auth::guest() || Auth::user()->type == "B")
          <li><a href="/cars/create"><i class="fa fa-plus" aria-hidden="true"></i> Post a car</a></li>
          <li><a href="/profile"><i class="fa fa-user-circle" aria-hidden="true"></i> My profile   @if( ! isset($loadVue) ||  $loadVue)   <span class="badge" v-cloak>@{{unreadNotifications.length}}</span> @endif</a></a></li>
          <li><a href="/wish-list"><i class="fa fa-heart" aria-hidden="true"></i> Wish list </a></li>
        @endif

        <li class="dropdown"> <!-------- DROPDOWN -------->
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
            
            @if(Auth::check())  
              <strong> {{Auth::user()->name}} </strong>
            @else  
              Menu 
            @endif 

            <span class="caret"></span>
          </a>

          <ul class="dropdown-menu">

            @if(Auth::check())

              @if(Auth::user()->type == "A")
                <li><a href="/control-panel">Control Panel</a></li>
              @else
                <li><a href="/profile">Profile <span class="badge" v-cloak>@{{unreadNotifications.length}}</span></a></li>                
                <li><a href="/my-cars">My Posts</a></li>                
              @endif

              <li role="separator" class="divider"></li>
              <li><a href="/logout">Log out</a></li>
            
            @else  <!-- GUEST -->
            
              <li><a href="/login">Log in</a></li>
              <li><a href="/register">Sign up</a></li>
            
            @endif
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>


<!-- @if($flash = session('message'))

  <div id="flash-message" class="alert alert-success">
    {{ $flash }}
  </div>

@endif -->