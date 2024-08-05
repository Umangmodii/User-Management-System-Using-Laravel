<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users | Dashboard</title>
    <!-- Bootstrap CSS CDN -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        body {
            padding-top: 56px; /* Adjust based on navbar height */
        }
        .navbar {
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Optional shadow */
        }
        .container {
            margin-top: 20px;
        }
        .footer {
            background-color: #f8f9fa; /* Matching color with navbar */
            padding: 15px;
            text-align: center;
            border-top: 1px solid #e9ecef;
            margin-top: 20px;
            color: #343a40; /* Text color matching the navbar links */
        }
        .navbar {
            background-color: #ffc107; /* Yellow background color */
            color: #343a40; /* Text color matching the footer */
        }
        .navbar .nav-link {
            color: #343a40; /* Text color matching the footer */
        }
        .navbar .navbar-brand {
            color: #343a40; /* Text color matching the footer */
        }
        .navbar .nav-link:hover,
        .navbar .navbar-brand:hover {
            color: #212529; /* Darker shade on hover */
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-warning fixed-top">
    <a class="navbar-brand" href="#">Web Users</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="{{ url('/dashboard') }}">Dashboard <span class="sr-only">(current)</span></a>
            </li>
            <!-- Add more navigation links as needed -->
        </ul>
        <ul class="navbar-nav ml-auto">
            <!-- Display user email -->
            @auth
                <li class="nav-item">
                    <a class="nav-link" href="#">{{ Auth::user()->email }}</a>
                </li>
                <!-- Logout Form -->
                <li class="nav-item">
                    <form action="{{ route('logout') }}" method="POST" class="form-inline">
                        @csrf
                        <button type="submit" class="btn btn-link nav-link">Logout</button>
                    </form>
                </li>
            @endauth
        </ul>
    </div>
</nav>

<div class="container">
    <div class="card mb-4">
        <div class="card-body">
            <h4 class="card-title">Welcome to your Dashboard, {{ Auth::user()->name }}!</h4>
        </div>
    </div>      

    <div class="card">
        <div class="card-body">
            <h3 class="mb-4">Users List</h3>
            <form method="GET" action="{{ url('/dashboard') }}" class="mb-3">
                <div class="input-group">
                    <input type="text" class="form-control" id="search" name="search" placeholder="Search for users..." value="{{ isset($search) ? $search : '' }}">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">Search</button>
                    </div>
                </div>
            </form>
            @if($users->isEmpty())
                <div class="alert alert-info" role="alert">
                    No results found.
                </div>
            @else
                <div class="table-container">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Pagination Links -->
                    <div class="d-flex justify-content-center mt-3">
                        {{ $users->onEachSide(1)->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

<footer class="footer">
    <p>&copy; {{ date('Y') }} Web Users. All rights reserved.</p>
</footer>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
