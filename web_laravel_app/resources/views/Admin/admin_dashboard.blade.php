<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | User Management System</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
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
            transition: transform 0.3s ease;
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
        .navbar-brand img {
            max-height: 40px;
            margin-right: 10px;
            border-radius: 50%;
        }
        .card {
            border-radius: 10px;
            border: none;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }
        .card-title {
            font-size: 1.25rem;
            color: #343a40;
        }
        .footer {
            background-color: #343a40;
            padding: 15px 0;
            text-align: center;
            color: #ffffff;
            border-top: 1px solid #495057;
            position: relative;
            bottom: 0;
            width: 100%;
        }
        .dropdown-menu {
            border-radius: 8px;
        }
        @media (max-width: 991px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: fixed;
                transform: translateX(-100%);
            }
            .sidebar.show {
                transform: translateX(0);
            }
            .main-content {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>

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

<div class="sidebar">
    <h4 class="text-center my-4">Admin Menu</h4>
    <a href="{{ url('/admin/users') }}"><i class="fas fa-users"></i> User Management</a>
    <a href="{{ url('/admin/reports') }}"><i class="fas fa-chart-line"></i> Reports</a>
    <a href="{{ url('/admin/settings') }}"><i class="fas fa-cogs"></i> Settings</a>
</div>

<div class="main-content">
    <button class="btn btn-warning d-lg-none mb-2" id="sidebarToggle">Menu</button>
    <div class="card mb-4">
        <div class="card-body">
            <br><br><br>
            <h4 class="card-title">Welcome to your Admin Dashboard, {{ Auth::user()->name }}!</h4>
            <p>Manage your users, view reports, and configure settings from the sidebar.</p>
        </div>
    </div>
   
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">Current User Logins</h5>
            <canvas id="userLoginChart"></canvas>
        </div>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <span>&copy; 2024 User Management System. All rights reserved.</span>
    </div>
</footer>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://kit.fontawesome.com/a076d05399.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.getElementById('sidebarToggle').addEventListener('click', function() {
        const sidebar = document.querySelector('.sidebar');
        sidebar.classList.toggle('show');
        sidebar.style.transform = sidebar.classList.contains('show') ? 'translateX(0)' : 'translateX(-100%)';
    });

    document.addEventListener('DOMContentLoaded', function () {
        var ctx = document.getElementById('userLoginChart').getContext('2d');
        var userLoginChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['January', 'February', 'March', 'April', 'May'],
                datasets: [{
                    label: 'User Logins',
                    data: [12, 19, 3, 5, 2],
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    });
</script>

</body>
</html>
