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

						<div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
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

						<div class="form-group {{ $errors->has('fname') ? ' has-error' : '' }}">
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

						<div class="form-group {{ $errors->has('lname') ? ' has-error' : '' }}">
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

						<div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
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
						<div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
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
						<!-- -----------END : PASSWORD ------------------ -->
						

						<div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
							<label for="phone" class="col-md-4 control-label">Phone</label>

							<div class="col-md-6">
								<input id="phone" type='tel' name="phone" class="form-control" value="{{old('phone')}}">

								@if ($errors->has('phone'))
									<span class="help-block">
										<strong>{{ $errors->first('phone') }}</strong>
									</span>
								@endif
							</div>
						</div>

						<!-- -------------- COUNTRY --------------- -->
						<div class="form-group {{ $errors->has('country') ? 'has-error' : '' }}">
							<label for="country" class="col-md-4 control-label">Country</label>

							<div class="col-md-6 ">
								<select name="country" class="form-control">
									<option disabled selected>Select country..</option>

									@foreach($countries as $key => $country)
									
										<option value="{{$key}}" {{ old('country') == $key ? 'selected' : ''}}>
											{{ $country }}</option>
									
									@endforeach

								</select>

								@if ($errors->has('country'))
									<span class="help-block">
										<strong>{{ $errors->first('country') }}</strong>
									</span>
								@endif
									
							</div>
						</div><!-- -----------END : COUNTRY ------------------ -->
						
						<div class="form-group {{ $errors->has('city') ? ' has-error' : '' }}">
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

						<div class="form-group {{ $errors->has('zip') ? ' has-error' : '' }}">
							<label for="zip" class="col-md-4 control-label">Post</label>

							<div class="col-md-6">
								<input id="zip" type="text" class="form-control" name="zip" value="{{ old('zip') }}" requiredX>

								@if ($errors->has('zip'))
									<span class="help-block">
										<strong>{{ $errors->first('zip') }}</strong>
									</span>
								@endif
							</div>
						</div>

						<div class="form-group {{ $errors->has('type') ? ' has-error' : '' }}">
							<label for="type" class="col-md-4 control-label">Account type</label>

							<div class="col-md-6 text-left">
								<input type="radio" class="form-controlx" name="type" value="B" checked  {{ old('type') == 'B' ? 'checked' : '' }}  >
								<span>Personal</span>
							</div>
							<div class="col-md-6 text-left">
								<input type="radio" class="form-controlx" name="type" value="C"  {{ old('type') == 'C' ? 'checked' : '' }} >
								<span>Business</span>
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

@section ("scripts")

	<script src="{{asset('js/masked-input.min.js')}}"></script>

	<script>
		$("#phone").mask("+(99?9) 999-99-999 ? 99999");
	</script>

@endsection
	