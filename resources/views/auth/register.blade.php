@extends('master')

@section('content')
<div class="containerX">
	<div class="row">
		<div class="col-md-12 col-md-offset-0">
			<div class="panel panel-default">
				<div class="panel-heading">Register</div>
				<div class="panel-body">
					<form class="form-horizontal" role="form" method="POST" action="{{ route('register') }}">
						{{ csrf_field() }}

						<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
							<label for="name" class="col-md-4 control-label">User name</label>

							<div class="col-md-6">
								<input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" requiredX autofocus>

								@if ($errors->has('name'))
									<span class="help-block">
										<strong>{{ $errors->first('name') }}</strong>
									</span>
								@endif
							</div>
						</div>

						<div class="form-group{{ $errors->has('fname') ? ' has-error' : '' }}">
							<label for="fname" class="col-md-4 control-label">First Name</label>

							<div class="col-md-6">
								<input id="fname" type="text" class="form-control" name="fname" value="{{ old('fname') }}" requiredX autofocus>

								@if ($errors->has('fname'))
									<span class="help-block">
										<strong>{{ $errors->first('fname') }}</strong>
									</span>
								@endif
							</div>
						</div>

						<div class="form-group{{ $errors->has('lname') ? ' has-error' : '' }}">
							<label for="lname" class="col-md-4 control-label">Last Name</label>

							<div class="col-md-6">
								<input id="lname" type="text" class="form-control" name="lname" value="{{ old('lname') }}" requiredX autofocus>

								@if ($errors->has('lname'))
									<span class="help-block">
										<strong>{{ $errors->first('lname') }}</strong>
									</span>
								@endif
							</div>
						</div>

						<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
							<label for="email" class="col-md-4 control-label">E-Mail Address</label>

							<div class="col-md-6">
								<input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" requiredX>

								@if ($errors->has('email'))
									<span class="help-block">
										<strong>{{ $errors->first('email') }}</strong>
									</span>
								@endif
							</div>
						</div>
						<!-- ------------- PASSWORD ---------------- -->
						<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
							<label for="password" class="col-md-4 control-label">Password</label>

							<div class="col-md-6">
								<input id="password" type="password" class="form-control" name="password" requiredX>

								@if ($errors->has('password'))
									<span class="help-block">
										<strong>{{ $errors->first('password') }}</strong>
									</span>
								@endif
							</div>
						</div>

						<div class="form-group">
							<label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

							<div class="col-md-6">
								<input id="password-confirm" type="password" class="form-control" name="password_confirmation" requiredX>
							</div>
						</div>
						<!-- ------------------------------------- -->

						<div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
							<label for="phone" class="col-md-4 control-label">Phone</label>

							<div class="col-md-6">
								<input id="phone" type="text" class="form-control input-medium bfh-phone" name="phone" value="{{ old('phone') }}" data-format="+1 (ddd) ddd-dddd" requiredX>

								@if ($errors->has('phone'))
									<span class="help-block">
										<strong>{{ $errors->first('phone') }}</strong>
									</span>
								@endif
							</div>
						</div>

						<div class="form-group {{ $errors->has('lname') ? 'has-error' : '' }}">
							<label for="country" class="col-md-4 control-label">Country</label>

								<!-- <input type="hidden" value="" name="country"> -->
							<div class="col-md-6 bfh-selectbox bfh-countries " data-name="country" data-country="US" data-flags="true">
								<input type="hidden" value="">

									<a class="bfh-selectbox-toggle" role="button" data-toggle="bfh-selectbox" href="#">
										<span class="bfh-selectbox-option input-medium" data-option=""></span>
										<b class="caret"></b>
									</a>
									<div class="bfh-selectbox-options">
										<input type="text" class="bfh-selectbox-filter">
										<div role="listbox">
										<ul role="option">
										</ul>
										</div>
									</div>
							
							</div>
						</div>
						
						<div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
							<label for="city" class="col-md-4 control-label">City</label>

							<div class="col-md-6">
								<input id="city" type="text" class="form-control" name="city" value="{{ old('city') }}" requiredX>

								@if ($errors->has('city'))
									<span class="help-block">
										<strong>{{ $errors->first('city') }}</strong>
									</span>
								@endif
							</div>
						</div>

						<div class="form-group{{ $errors->has('zip') ? ' has-error' : '' }}">
							<label for="zip" class="col-md-4 control-label">Zip code</label>

							<div class="col-md-6">
								<input id="zip" type="text" class="form-control" name="zip" value="{{ old('zip') }}" requiredX>

								@if ($errors->has('zip'))
									<span class="help-block">
										<strong>{{ $errors->first('zip') }}</strong>
									</span>
								@endif
							</div>
						</div>


						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									Register
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
