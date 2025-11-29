<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Available Services</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
    <!-- Font Awesome for Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            margin: 0;
            font-family: 'Montserrat', sans-serif;
            background-image: url('https://wallpapercave.com/wp/wp3067059.jpg');
            background-size: cover;
            background-position: center;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .form-container {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
        }

        h1 {
            font-size: 2.5rem;
            color: #2980b9;
            text-align: center;
            margin-bottom: 30px;
        }

        label {
            font-weight: 600;
            color: #555;
            margin-top: 15px;
            display: block;
        }

        input, select {
            width: 93%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1rem;
            font-family: 'Montserrat', sans-serif;
        }

        button {
            width: 100%;
            padding: 15px;
            background-color: #2980b9;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 1.2rem;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #3498db;
        }

        .form-group {
            position: relative;
        }

        .form-group i {
            position: absolute;
            top: 38px;
            left: 10px;
            color: #999;
        }

        input[type="text"], input[type="email"], input[type="tel"], input[type="date"] {
            padding-left: 35px;
        }

        /* Back button styling */
        .back-btn {
            position: fixed;
            top: 10px;
            left: 10px;
            background-color: #87CEEB;
            color: #fff;
            padding: 10px 15px;
            font-size: 1rem;
            font-weight: 600;
            border-radius: 5px;
            text-decoration: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .back-btn:hover {
            background-color: #00BFFF;
        }
    </style>
</head>
<body>
    <!-- Back button outside the container, fixed in top-left of the viewport -->
    <a href="javascript:history.back()" class="back-btn"><i class="fas fa-arrow-left"></i> Back</a>

<div class="form-container">
    <h1>Available Services</h1>
    <form method="post" action="<?= site_url('user/book-appointment') ?>">
        <?= csrf_field() ?>
        <div class="form-group">
            <label for="service_id">Select Service:</label>
            <select name="service_id" id="service_id" required>
                <?php foreach ($services as $service): ?>
                    <option value="<?= $service['id'] ?>"><?= $service['name'] ?> - ₱<?= $service['price'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="full_name">Full Name:</label>
            <i class="fas fa-user"></i>
            <input type="text" name="full_name" id="full_name" placeholder="Full Name" required>
        </div>

        <div class="form-group">
            <label for="email">Email Address:</label>
            <i class="fas fa-envelope"></i>
            <input type="email" name="email" id="email" placeholder="Email Address" required>
        </div>

        <div class="form-group">
            <label for="phone">Phone Number:</label>
            <i class="fas fa-phone"></i>
            <input type="tel" name="phone" id="phone" placeholder="Phone Number" required>
        </div>

        <div class="form-group">
            <label for="appointment_date">Appointment Date:</label>
            <i class="fas fa-calendar-alt"></i>
            <input type="date" name="appointment_date" id="appointment_date" required>
        </div>

        <button type="submit"><i class="fas fa-calendar-check"></i> Book Appointment</button>
    </form>
</div>
</body>
</html>

