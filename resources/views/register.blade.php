<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/style.css">
</head>

<body class="d-flex flex-column justify-content-center" style="height: 100vh">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4 form-signup">
                <form action="/register" method="POST">
                    @csrf
                    <h1 class="h3 my-3 fw-normal text-center">Sign Up</h1>
                    <div class="form-floating">
                        <input type="text" class="form-control rounded-top @error('name') is-invalid @enderror"
                               name="name" id="name" placeholder="Name" required value="{{ old('name') }}">
                        <label for="name">Name</label>
                        @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-floating">
                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                               id="email"
                               placeholder="name@example.com" required value="{{ old('email') }}">
                        <label for="email">Email address</label>
                        @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-floating">
                        <input type="password" name="password"
                               class="form-control rounded-bottom @error('password') is-invalid @enderror" id="password"
                               placeholder="Password" required>
                        <label for="password">Password</label>
                        @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <button class="w-100 btn btn-lg btn-primary mt-3" type="submit">Create Account</button>
                </form>
                <small class="text-center d-block mt-2">Already have an account? <a class="text-decoration-none"
                       href="/login">Login</a></small>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
</body>

</html>
