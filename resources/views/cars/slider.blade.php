
  <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">

      @foreach($car->pictures as $key => $pic)
      	<li data-target="#myCarousel" data-slide-to="{{$key}}"  class="active"></li>
      @endforeach

    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner">
    <?php $active = true; ?>
    @foreach($car->pictures as $key => $pic)
    
    	<div class="item {{$active ? 'active' : ''}}">
        <img src="{{asset('storage/images'.'/'.$pic->id.'.'.$pic->ext)}}" alt="Los Angeles" style="width:100%;">
        <div class="carousel-caption">
          <h3>Los Angeles</h3>
          <p>LA is always so much fun!</p>
        </div>
      </div>
    	<?php $active = false; ?>
    @endforeach      

    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
