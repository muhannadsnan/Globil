@extends('master')

@section ('title', " | Conversations")

<style>
	.conversations{}
	.conversations div, .conversations a, .conversations img{
		padding:0 !important; margin:0 !important}

	.conversations .user_conv{
		padding: 10px !important; margin-bottom: 5px !important; border-bottom: 1px solid #ccc; background-color: #eee}
	.conversations caption{margin-left: 5px;}
	
	.user_img{border-radius: 100%; padding: 0 !important;}
	.conv_messages{border: 1px solid #ccc; padding:10px 10px;}
	.conv_messages .header{ border-bottom: 1px solid #ccc; height: 80px !important; padding:10px; margin-bottom: 10px; 
		 background-color: #fff; }
	.conv_messages .header a{
		line-height: 60px; vertical-align: middle;
		 }
	.conv_messages .header .user_img{ width:auto; height:60px;}
	.conv_messages .header span{float: left; margin-left: 10px}
	.msg {text-align: left ; margin:10px !important	; padding: 10px; }
	.message_text{ padding: 5px 10px; }
	.message_text span{ color: #fff;  background-color: blue; border-radius: 5px;
		 margin:5px ; padding: 5px 10px;}
	.me{float:right !important; }
	.me span{background-color: #eee; color: #666;}
	.datetime{margin:0px 22px;}
</style>


@section ('content')

	<div class="col-sm-4 conversations">
		<input type="search" placeholder="Search conversations.." class="form-control">
		<hr>

		<conversations @conv-clicked="convClicked"></conversations>

		<!-- <a href="#Spideman" class="col-sm-12 user_conv">
			<img src="{{asset('images/default_user.png')}}" class="col-xs-4 user_img">
			<div class=" col-xs-8 caption">
				<p class="user">Spideman</p>
				<p class="latest_msg">...</p>
			</div>
		</a>
	
		<a href="#Batman" class="col-sm-12 user_conv">
			<img src="{{asset('images/default_user.png')}}" class="col-xs-4 user_img">
			<div class=" col-xs-8 caption">
				<p class="user">Batman</p>
				<p class="latest_msg">...</p>
			</div>
		</a> -->

	</div>

	<div class="col-sm-7 conv_messages">
		

		<messages></messages>

		

	</div>

@endsection
	