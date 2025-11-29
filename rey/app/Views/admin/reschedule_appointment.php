<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reschedule Appointment</title>
</head>
<body>
    <h1>Reschedule Appointment</h1>
    
    <form action="<?= site_url('admin/update-appointment/'.$appointmentId) ?>" method="post">
        <!-- Add the necessary fields for rescheduling here -->
        <div>
            <label for="new_date">New Date:</label>
            <input type="date" id="new_date" name="new_date" required>
        </div>
        <div>
            <label for="new_time">New Time:</label>
            <input type="time" id="new_time" name="new_time" required>
        </div>
        <button type="submit">Reschedule</button>
    </form>
</body>
</html>
