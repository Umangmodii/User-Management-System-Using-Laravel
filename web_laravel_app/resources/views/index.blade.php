<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Authentication</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .medium-img {
            max-width: 300px; /* Adjust size as needed */
            height: auto; /* Maintain aspect ratio */
        }
        .hero-section {
            background-color: #f8f9fa; /* Light gray background */
            padding: 50px 0; /* Padding top and bottom */
        }
        .card-custom {
            border: none; /* Remove card border */
            border-radius: 15px; /* Rounded corners */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Add shadow */
        }
    </style>
</head>
<body>

    <!-- Include Navigation Bar -->
    @include('Users.header')

    <!-- Hero Section -->
    <div class="hero-section text-center">
        <div class="container">
            <h1 class="display-4 mb-4">Welcome to User</h1>
            <p class="lead mb-4">Users Authentication security. </p>
            <img src="https://cdn-icons-png.flaticon.com/512/10270/10270032.png" alt="Authentication" class="img-fluid medium-img">
        </div>
    </div>

    <!-- Include Footer -->
    @include('Users.footer')

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
