<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Stayscape</title>
  <link rel="stylesheet" href="{{ asset('css/sign.css') }}">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

</head>
<body>
    <div class="container">
		<div class="screen" style="margin-top: 105px">
			<div class="screen__content">
                <div style="margin-top: 80px; margin-left: 30px;">
                    <h5 style="font-weight: 900; color: #8DA9C4">Welcome Back!</h5>
                </div>
				<form class="login" action="/auth/signIn" method="post">
                    @csrf
					<div class="login__field">
						<input type="email" class="login__input" placeholder="email" name="email" required>
					</div>
					<div class="login__field">
						<input type="password" class="login__input" placeholder="password" name="password" required>
					</div>
                    @if ($errors->any())
						<div class="alert alert-danger">
							@foreach ($errors->all() as $error)
								<p>{{ $error }}</p>
							@endforeach
						</div>
					@endif
					<button class="button login__submit" type="submit">
						Sign In
					</button>
				</form>
				<div class="social-login" style="margin-bottom: 70px">
                    <p style="font-size: 10px">Dont Have an Account?</p>
					<a href="/signUp" style="color: white"><h4>Create Account</h4></a>
				</div>
			</div>
			<div class="screen__background">
				<span class="screen__background__shape screen__background__shape4"></span>
				<span class="screen__background__shape screen__background__shape3"></span>
				<span class="screen__background__shape screen__background__shape2"></span>
				<span class="screen__background__shape screen__background__shape1"></span>
			</div>
		</div>
	</div>
</body>
</html>
