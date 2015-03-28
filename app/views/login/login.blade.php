@extends('layouts.login')
@section('body')
	<div class="container">
		<div class="col-md-12">
			<h1 class="margin-bottom-15">Login</h1>
				{{ Form::open(array('url' => 'login', 'class'=>'form-horizontal templatemo-container templatemo-login-form-1 margin-bottom-30')) }}
			        <div class="form-group">
			        		<noscript>Para Poder Navegar Livremente Pelo Site, Têm De Ativar O JavaScript<br><br></noscript>
			                @if(Session::has('success'))
								<script>
									window.onload = function showError() {
										return sweetAlert("{{ Session::get('success') }}", "", "success");
									}
								</script>
			                @endif
			            	@if($errors->any())
								<div class="alert alert-danger">
								 	<button type="button" class="close" data-dismiss="alert">&times;</button>
								    {{implode('', $errors->all('<li class="error">:message</li>'))}}
								</div>
							@endif
			            <div class="col-md-12">
			                <div class="control-wrapper">
			        <label for="user" class="control-label fa-label"><i class="fa fa-user fa-medium"></i></label>
			        {{Form::text('user', '', array('placeholder' => 'Utilizador', 'class'=>'form-control'))}}
			                </div>
			            </div>
			        </div>

			        <div class="form-group">
			            <div class="col-md-12">
			                <div class="control-wrapper">
			        <label for="password" class="control-label fa-label"><i class="fa fa-lock fa-medium"></i></label>
			        {{Form::password('password', array('placeholder' => 'Password', 'class'=>'form-control'))}}
			                </div>
			            </div>
			        </div>
					@if(settings::get("captchaStatus") == 1)
			        <div class="form-group">
			            <div class="col-md-12">
			                <div class="control-wrapper">
			        <label class="control-label fa-label"><i class="fa fa-male fa-medium"></i></label>
			        {{Form::captcha()}}
			                </div>
			            </div>
			        </div>
					@endif

					<hr>
			
			        <div class="form-group">
			            <div class="col-md-12">
			                <div class="control-wrapper">
			                    {{Form::submit('Login', array('class'=>'btn btn-info'))}}
			                    <a href="{{  URL::to('forgot')}}" class="text-right pull-right">Esqueci-me da Password?</a>
			                </div>
			            </div>
			        </div>

			    {{ Form::close() }}
		</div>
	</div>
@stop