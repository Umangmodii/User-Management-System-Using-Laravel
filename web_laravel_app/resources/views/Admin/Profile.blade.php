<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile | User Management System</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome for Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .sidebar {
            background-color: #343a40;
            color: #ffffff;
            height: 100vh;
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            overflow-y: auto;
            z-index: 1000;
            padding-top: 60px;
        }
        .sidebar a {
            color: #ffffff;
            text-decoration: none;
            display: block;
            padding: 15px;
            font-size: 1.1em;
            border-bottom: 1px solid #495057;
        }
        .sidebar a:hover {
            background-color: #495057;
        }
        .main-content {
            margin-left: 250px;
            padding: 20px;
        }
        .navbar-brand {
            display: flex;
            align-items: center;
        }
        .navbar-brand img {
            max-height: 40px;
            margin-right: 10px;
        }
        .card {
            border-radius: 8px;
            border: none;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .card-title {
            font-weight: 700;
            color: #343a40;
        }
        .footer {
            background-color: #343a40;
            padding: 10px;
            text-align: center;
            color: #ffffff;
            border-top: 1px solid #e9ecef;
            position: relative;
            bottom: 0;
            width: 100%;
            margin-top: 20px;
        }
        .dropdown-menu {
            border-radius: 8px;
        }
        .profile-header {
            background-color: #343a40;
            color: white;
            padding: 20px;
            text-align: center;
        }
        .profile-header img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            border: 4px solid #ffffff;
            margin-bottom: 10px;
        }
        .profile-form {
            padding: 20px;
            background-color: #ffffff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        .profile-form .form-group label {
            font-weight: 600;
        }
       
        .alert {
            margin-bottom: 20px;
        }
        @media (max-width: 991px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: fixed;
                transform: translateX(-100%);
                z-index: 1000;
            }
            .sidebar.show {
                transform: translateX(0);
            }
            .main-content {
                margin-left: 0;
            }
        }
        @media (max-width: 767px) {
            .navbar-toggler {
                display: block;
            }
        }
        @media (min-width: 768px) {
            .navbar-toggler {
                display: none;
            }
        }
        .navbar-nav {
            flex-direction: row;
        }
        .navbar-nav .nav-item {
            margin-left: 10px;
        }
        .sidebar .icon {
            margin-right: 10px;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <a class="navbar-brand" href="#">
        <img src="https://t4.ftcdn.net/jpg/05/18/26/65/360_F_518266508_88PE7n9461bvCqCwEgwG42Q53Oxu6GZ1.jpg" alt="Logo"> Admin Dashboard
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-user"></i> {{ Auth::user()->name }}
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('admin.profile') }}">Profile</a>
                    <a class="dropdown-item" href="#">Settings</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ url('/logout') }}">Logout</a>
                </div>
            </li>
        </ul>
    </div>
</nav>

<!-- Sidebar -->
<div class="sidebar">
    <h4 class="text-center my-4">Admin Menu</h4>
    <a href="{{ url('/admin/users') }}"><i class="fas fa-users icon"></i>User Management</a>
    <a href="{{ url('/admin/reports') }}"><i class="fas fa-chart-line icon"></i>Reports</a>
    <a href="{{ url('/admin/settings') }}"><i class="fas fa-cogs icon"></i>Settings</a>
</div>

<!-- Main Content -->
<div class="main-content">
    <button class="btn btn-danger d-lg-none mb-3" id="sidebarToggle">Menu</button>

    <!-- Success and Error Messages -->
    <br> <br> <br> <br>
   
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    

    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Update User Profile Details</strong> 
      </div>

    <div class="profile-form">

        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
        
        <!-- Profile Form -->
    <form action="{{ route('profile.update') }}" method="POST">
    @csrf

    <div class="form-group">
        <label for="email">Email address</label>
        <input type="email" class="form-control" id="email" name="email" value="{{ Auth::user()->email }}">
        @error('email')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="currentPassword">Current Password</label>
        <input type="password" class="form-control" id="currentPassword" name="currentPassword" value="{{ Auth::user()->password }}">
        @error('currentPassword')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="newPassword">New Password</label>
        <input type="password" class="form-control" id="newPassword" name="newPassword">
        @error('newPassword')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="newPassword_confirmation">Confirm New Password</label>
        <input type="password" class="form-control" id="newPassword_confirmation" name="newPassword_confirmation">
    </div>
    <button type="submit" class="btn btn-primary">Update Profile</button>
</form>
    </div>
</div>

<!-- Footer -->
<footer class="footer">
    <div class="container">
        <span>&copy; 2024 User Management System. All rights reserved.</span>
    </div>
</footer>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://kit.fontawesome.com/a076d05399.js"></script>
<script>
    // Toggle sidebar for mobile view
    document.getElementById('sidebarToggle').addEventListener('click', function() {
        document.querySelector('.sidebar').classList.toggle('show');
    });
</script>

</body>
</html>
