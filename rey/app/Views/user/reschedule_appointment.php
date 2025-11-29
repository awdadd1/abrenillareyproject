<!-- app/Views/user/reschedule_appointment.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reschedule Appointment</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Styles -->
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f4f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background-color: #fff;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
            position: relative;
        }
        h1 {
            text-align: center;
            color: #333;
            font-weight: 500;
        }
        .form-group {
            margin-bottom: 1.5rem;
        }
        .form-group label {
            display: block;
            font-weight: 500;
            margin-bottom: 0.5rem;
            color: #555;
        }
        .form-group input {
            width: 100%;
            padding: 0.8rem;
            font-size: 1rem;
            border: 1px solid #ddd;
            border-radius: 5px;
            outline: none;
            transition: border-color 0.3s;
        }
        .form-group input:focus {
            border-color: #5a67d8;
        }
        .btn {
            width: 100%;
            padding: 0.8rem;
            font-size: 1rem;
            background-color: #5a67d8;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: 500;
            transition: background-color 0.3s;
        }
        .btn:hover {
            background-color: #434190;
        }
        .back-btn {
            position: absolute;
            top: 10px;
            left: 10px;
            background-color: #ddd;
            color: #333;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
            transition: background-color 0.3s;
        }
        .back-btn:hover {
            background-color: #bbb;
        }
        .icon {
            margin-right: 8px;
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="javascript:history.back()" class="back-btn"><i class="fas fa-arrow-left"></i> Back</a>
        
        <h1><i class="fas fa-calendar-alt icon"></i> Reschedule Appointment</h1>
        
        <form action="<?= site_url('user/reschedule-appointment/'.$appointmentId) ?>" method="post">
            <div class="form-group">
                <label for="new_date"><i class="fas fa-calendar-day icon"></i> New Date</label>
                <input type="date" id="new_date" name="new_date" required>
            </div>
            <div class="form-group">
                <label for="new_time"><i class="fas fa-clock icon"></i> New Time</label>
                <input type="time" id="new_time" name="new_time" required>
            </div>
            <div class="form-group">
                <button type="submit" class="btn"><i class="fas fa-check icon"></i> Reschedule</button>
            </div>
        </form>
    </div>
</body>
</html>
