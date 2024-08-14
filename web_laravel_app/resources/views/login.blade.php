<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel PHP | Login</title>
    <!-- Bootstrap CSS CDN -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    @include('Users.header')

    <style>
        .alert-custom {
            background-color: #f8d7da;
            color: #721c24;
            border-color: #f5c6cb;
            border-radius: 5px;
        }
        .alert-custom .alert-heading {
            font-weight: bold;
        }
    </style>

    <div class="container mt-5">
        <!-- Display error message -->
        @if ($errors->any())
            <div class="alert alert-danger alert-custom">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <!-- Login Form -->
        <form id = "login_Form" action="{{ route('login') }}" method="POST">
            @csrf
            <div class="card mb-4">
                <h5 class="card-header alert-warning">User Login</h5>
                <div class="card-body">
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Enter email" >
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="Password" >
                    </div>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="remember" name="remember">
                        <label class="form-check-label" for="remember">Remember me</label>
                    </div>
                    <br>

                    <a href = "{{url('/forget_password')}}" class="link-warning"> Forget Password </a>

                  &nbsp;  <input type="submit" class="btn btn-primary" value="Login"> 
                    <a href="{{ route('register') }}" class="btn btn-danger">Register</a>
                </div>
            </div>
        </form>

        <!-- Bootstrap JS and dependencies -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </div>

    <br><br>

    @include('Users.footer')

    <script>
           
           document.getElementById('login_Form').addEventListener('submit',function(event){
                 var email = document.getElementById('email').value;
                 var password = document.getElementById('password').value;

                 if(!email || !password)
                 {
                    alert('Both email and password fields are required.');
                    event.preventDefault(); // Prevent form submission
                 }

                 else if(!ValidateEmail(email))
                 {
                    alert('Please enter a valid email address.');
                    event.preventDefault(); // Prevent form submission
                 }
            });

                 public function ValidateEmail(email){
                    var re = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
                    return re.test(email);
                 }

    </script>

</body>
</html>
