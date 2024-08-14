<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>

    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>

<body>
    <div class="container p-4">

        <form method="POST" action="{{ route('register') }}">
            @csrf

            {{-- Email --}}
            <div class="mb-3 form-floating">
                <input required type="email" autofocus class="form-control" id="email" name="email"
                    aria-describedby="emailHelp" placeholder="" />
                <label for="exampleInputEmail1" class="form-label">Email</label>
                <div id="emailHelp" class="form-text">
                    We'll never share your email with anyone else.
                </div>
            </div>

            {{-- Username --}}
            <div class="mb-3 form-floating">
                <input required type="text" class="form-control" id="username" name="username"
                    aria-describedby="emailHelp" placeholder="" />
                <label for="exampleInputEmail1" class="form-label">Username</label>
            </div>
            
            {{-- First Name --}}
            <div class="mb-3 form-floating">
                <input required type="text" class="form-control" id="first_name" name="first_name"
                    aria-describedby="emailHelp" placeholder="" />
                <label for="exampleInputEmail1" class="form-label">First Name</label>
            </div>
            
            {{-- Last Name --}}
            <div class="mb-3 form-floating">
                <input required type="text" class="form-control" id="last_name" name="last_name"
                    aria-describedby="emailHelp" placeholder="" />
                <label for="exampleInputEmail1" class="form-label">Last Name</label>
            </div>
            
            {{-- Contact Number --}}
            <div class="mb-3 form-floating">
                <input required type="text" class="form-control" id="contact_number" name="contact_number"
                    aria-describedby="emailHelp" placeholder="" />
                <label for="exampleInputEmail1" class="form-label">Contact Number</label>
            </div>

            {{-- Password --}}
            <div class="mb-3 form-floating">
                <input required type="password" id="password" name="password" class="form-control"
                    aria-describedby="passwordHelpBlock" placeholder="" />
                <label for="inputPassword5" class="form-label">Password</label>
            </div>

            {{-- Confirm Password --}}
            <div class="mb-3 form-floating">
                <input required type="password" id="password_confirmation" name="password_confirmation"
                    class="form-control" aria-describedby="passwordHelpBlock" placeholder="" />
                <label for="inputPassword5" class="form-label">Confirm Password</label>
                <div id="passwordHelpBlock" class="form-text">
                    Your password must be 8-20 characters long, contain letters and
                    numbers, and must not contain spaces, special characters, or
                    emoji.
                </div>
            </div>

            <div class="d-grid my-3">
                <button class="btn btn-primary" type="submit">Sign up</button>
            </div>

        </form>

    </div>
</body>

</html>
