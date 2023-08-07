<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stayscape</title>
    <link rel="stylesheet" href="{{ asset('css/sign.css') }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

</head>

<body>
    <div style="margin-top: 50px; text-align:center" >
        <h5 style="font-weight: 900; color: #13315C">Register Account</h5>
    </div>
    <div class="container">
        <div class="screen">
            <div class="screen__content">
                <form class="login" action="/auth/signUp" method="post">
                    @csrf
                    <div class="login__field">
                        <input type="text" class="login__input" placeholder="Nama" name="nama" required />
                        @error('nama')
                        @enderror
                    </div>
                    <div class="login__field">
                        <input type="email" class="login__input" placeholder="Email" name="email" required />
                        @error('email')
                        @enderror
                    </div>
                    <div class="login__field">
                        <input type="password" class="login__input" placeholder="Password" name="password" required />
                        @error('password')
                        @enderror
                    </div>
                    <div class="login__field">
                        <input type="text" class="login__input" placeholder="No HP" name="no_hp" required />
                        @error('no_hp')
                        @enderror
                    </div>
                    <div class="login__field">
                        <label for="jenis-kelamin">Jenis Kelamin</label>
                        <select class="form-select" id="jenis-kelamin" aria-label="Default select example"
                            name="jenis_kelamin">
                            <option >Pilih</option>
                            <option value="perempuan">Perempuan</option>
                            <option value="laki-laki">Laki-laki</option>
                        </select>
                        </select>
                    </div>
                    <button class="button login__submit" type="submit">
                        <span class="button__text">Create Account</span>
                    </button>
                </form>
                @if ($errors->any())
                <div class="alert alert-danger mt-3">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <div class="social-login1" style="margin-bottom: 0px">
                    <p style="font-size: 10px">Do you Have an Account?</p>
                    <a href="/signIn" style="color: white">
                        <h4>Sign In</h4>
                    </a>
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
