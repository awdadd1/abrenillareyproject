<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
    <!-- Font Awesome for Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            margin: 0;
            font-family: 'Montserrat', sans-serif;
            background-image: url('https://github.com/codewithsadee/barber/blob/master/assets/images/hero-banner.jpg?raw=true');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            color: #fff;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 50px;
            background-color: rgba(0, 0, 0, 0.7);
        }

        .navbar a {
            color: #fff;
            text-decoration: none;
            font-weight: 600;
            margin: 0 15px;
        }

        .navbar a:hover {
            color: #f1c40f;
        }

        .container {
            text-align: center;
            margin-top: 150px;
        }

        h1 {
            font-size: 3rem;
            margin-bottom: 50px;
            color: #f1c40f;
        }

        .button-group {
            display: flex;
            justify-content: center;
            gap: 20px;
        }

        .button-group a {
            text-decoration: none;
            background-color: #2980b9;
            padding: 15px 30px;
            border-radius: 30px;
            color: #fff;
            font-size: 1.2rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            transition: background-color 0.3s ease;
        }

        .button-group a:hover {
            background-color: #3498db;
        }

        .button-group a i {
            margin-right: 10px;
        }

        .logout {
            margin-top: 50px;
        }

        .logout a {
            color: #e74c3c;
            text-decoration: none;
            font-weight: 600;
        }

        .logout a:hover {
            color: #c0392b;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <div class="logo">
            <h2>Haircut Reservation Management System</h2>
        </div>
       <div class="nav-links">
    <a href="<?= site_url('user/browse-services') ?>"><i class="fas fa-th-list"></i> Browse Services</a>
    <a href="<?= site_url('user/view-appointments') ?>"><i class="fas fa-calendar-alt"></i> View Appointments</a>
    <a href="<?= site_url('user/manage-profile') ?>"><i class="fas fa-user"></i> Manage Profile</a>
    <a href="<?= site_url('user/logout') ?>"><i class="fas fa-sign-out-alt"></i> Logout</a>
</div>

    </div>
</body>
</html>
