<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Form Validation in Laravel</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
</head>

<body>
    <div class="container mt-5">

        @if (Session::has('success'))
            <div class="alert alert-success text-center">
                {{ Session::get('success') }}
            </div>
        @endif

        <form method="post" action="{{ route('login') }}">

            @csrf

            <div class="form-group mb-2">
                <label>otp</label>
                <input type="text" class="form-control @error('otp') is-invalid @enderror" name="otp"
                    id="otp">

                @error('otp')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group mb-2">
                <label>Phone</label>
                <input type="text" class="form-control @error('mobile') is-invalid @enderror" name="mobile"
                    id="mobile">

                @error('mobile')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="d-grid mt-3">
                <input type="submit" name="send" value="Submit" class="btn btn-dark btn-block">
            </div>
        </form>
    </div>
</body>

</html>
