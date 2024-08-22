<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
     <!-- plugins:css -->
     <link rel="stylesheet" href="{{ asset('assets/vendors/feather/feather.css') }}">
     <link rel="stylesheet" href="{{ asset('assets/vendors/mdi/css/materialdesignicons.min.css') }}">
     <link rel="stylesheet" href="{{ asset('assets/vendors/ti-icons/css/themify-icons.css') }}">
     <link rel="stylesheet" href="{{ asset('assets/vendors/font-awesome/css/font-awesome.min.css') }}">
     <link rel="stylesheet" href="{{ asset('assets/vendors/typicons/typicons.css') }}">
     <link rel="stylesheet" href="{{ asset('assets/vendors/simple-line-icons/css/simple-line-icons.css') }}">
     <link rel="stylesheet" href="{{ asset('assets/vendors/css/vendor.bundle.base.css') }}">
     <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">
     <!-- endinject -->
     <!-- Plugin css for this page -->
     <link rel="stylesheet" href="{{ asset('assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">
     <link rel="stylesheet" type="text/css" href="{{ asset('assets/js/select.dataTables.min.css') }}">
     <!-- End plugin css for this page -->
     <!-- inject:css -->
     <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
     <!-- endinject -->
     <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" />
     <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="d-flex justify-content-center align-items-center vh-100">
        <div class="card shadow-lg" style="width: 28rem;">
            <div class="card-body">
                <h1 class="card-title text-center">Register</h1>
    
                <form method="POST" action="{{ route('register') }}">
                    @csrf
    
                    <div class="form-group mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}">
                    </div>
    
                    <div class="form-group mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}">
                    </div>
    
                    <div class="form-group mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" id="password" name="password" class="form-control">
                    </div>
    
                    <div class="form-group mb-4">
                        <label for="confirm_password" class="form-label">Confirm Password</label>
                        <input type="password" id="confirm_password" name="confirm_password" class="form-control">
                    </div>
    
                    <button class="btn btn-primary w-100" type="submit">Register</button>
    
                    @if ($errors->any())
                        <div class="alert alert-danger mt-3">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </form>
    
                <p class="text-center mt-4">Already have an account? <a href="{{ route('login') }}">Login</a></p>
            </div>
        </div>
    </div>    
</body>
</html>
