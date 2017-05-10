<nav class="navbar navbar-default">
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

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <!-- <ul class="nav navbar-nav">
        <li class="active"> <a href="#">Home<span class="sr-only">(current)</span></a> </li>
        <li> <a href="#">Services</a> </li>
        <li> <a href="#">About</a> </li>

        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">Separated link</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">One more separated link</a></li>
          </ul>
        </li>
      </ul> -->
      
      <ul class="nav navbar-nav navbar-right">
        <li><a href="/posts/create"><i class="fa fa-sticky-note" aria-hidden="true"></i> Create a post</a></li>
        <li><a href="/messages"><i class="fa fa-envelope" aria-hidden="true"></i> <span>My messages</span></a></li>
        <li><a href="/account"><i class="fa fa-user-circle" aria-hidden="true"></i> My account</a></li>
        <li><a href="/wish-list"><i class="fa fa-heart" aria-hidden="true"></i> Wish list </a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="/login">Log in</a></li>
            <li><a href="/signup">Sign up</a></li>
            <li><a href="/profile">Profile</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="/logout">Log out</a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<!-- .well -->
<div class="well">
  <h1 class="text-info">Welcome to Globil!</h1> 
  <h3>Let's find something great.</h3>
  <h4>Search in oursite. You can find thousands of results.</h4>
  
  <div class="panel panel-default col-md-6 col-md-offset-3">
    <form action="/search" method="POST">
      <div class="input-group form-group  panel-header">

        <span class="input-group-btn">
          <a href="#" class="expand-advanced-search btn btn-default">More filters</a>
        </span>
        <input type="text" class="form-control" placeholder="Search">
        <span class="input-group-btn">
          <button type="submit" class="btn btn-success">Find</button>
        </span>
      </div>

      <div class="advanced-filtering panel-body " style="display:none;">
        <h1>Here goes advanced filtering..</h1>
      </div>

    </form>
  </div>
      
    
</div>