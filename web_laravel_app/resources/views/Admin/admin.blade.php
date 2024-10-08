<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Login</title>
    <!-- Bootstrap CSS CDN -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
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
</head>
<body>

    @include('Users.header')

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
        <form id="login_Form" action="{{ route('admin.login.submit') }}" method="POST">
            @csrf
            <div class="card mb-4">
                <h5 class="card-header alert-warning">Admin Login</h5>
                <div class="card-body">
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Enter email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
                    </div>
                    <br>
                    <input type="submit" class="btn btn-primary" value="Login"> 
                </div>
            </div>
        </form>
    </div>

    <br><br>

    @include('Users.footer')

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        document.getElementById('login_Form').addEventListener('submit', function(event){
            var email = document.getElementById('email').value;

            if (!email) {
                alert('Email field is required.');
                event.preventDefault(); // Prevent form submission
            } else if (!validateEmail(email)) {
                alert('Please enter a valid email address.');
                event.preventDefault(); // Prevent form submission
            }
        });

        function validateEmail(email) {
            var re = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
            return re.test(email);
        }
    </script>

</body>
</html>
