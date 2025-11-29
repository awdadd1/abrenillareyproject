<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Appointments</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #f4f7f6;
            color: #333;
            margin: 0;
            padding: 20px;
        }

        h1 {
            font-size: 2.5rem;
            color: #2980b9;
            text-align: center;
            margin-bottom: 30px;
        }

        .back-button {
            display: inline-block;
            margin-bottom: 20px;
            padding: 10px 15px;
            background-color: #2980b9;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            font-weight: 600;
            transition: background-color 0.3s ease;
        }

        .back-button:hover {
            background-color: #3498db;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        thead {
            background-color: #2980b9;
            color: #fff;
        }

        th, td {
            padding: 15px;
            text-align: left;
            font-size: 1rem;
        }

        th {
            font-weight: 600;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #d9eaf4;
        }

        .action-buttons {
            display: flex;
            gap: 10px;
        }

        .action-button {
            padding: 10px 15px;
            border-radius: 5px;
            text-align: center;
            text-decoration: none;
            font-weight: 600;
            transition: background-color 0.3s ease;
            cursor: pointer;
            display: inline-block;
        }

        .reschedule-button {
            background-color: #2980b9;
            color: #fff;
        }

        .reschedule-button:hover {
            background-color: #3498db;
        }

        .cancel-button {
            background-color: #e74c3c;
            color: #fff;
        }

        .cancel-button:hover {
            background-color: #c0392b;
        }

        p {
            text-align: center;
            font-size: 1.2rem;
            color: #555;
        }
    </style>
</head>
<body>

<h1>Your Appointments</h1>

<a href="<?= site_url('user/dashboard') ?>" class="back-button">Back to Dashboard</a>

<?php if (!empty($appointments)): ?>
    <table>
        <thead>
            <tr>
                <th>Appointment ID</th>
                <th>Service</th>
                <th>Full Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Date</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($appointments as $appointment): ?>
            <tr>
                <td><?= esc($appointment['id']) ?></td>
                <td><?= esc($appointment['service_name']) ?></td>
                <td><?= esc($appointment['full_name']) ?></td>
                <td><?= esc($appointment['email']) ?></td>
                <td><?= esc($appointment['phone']) ?></td>
                <td><?= esc($appointment['appointment_date']) ?></td>
                <td><?= esc($appointment['status']) ?></td>
                <td>
                    <div class="action-buttons">
                        <a href="/user/reschedule-appointment/<?= esc($appointment['id']) ?>" class="action-button reschedule-button">Reschedule</a>
                        <a href="/user/cancel-appointment/<?= esc($appointment['id']) ?>" class="action-button cancel-button" onclick="return confirm('Are you sure you want to cancel this appointment?')">Cancel</a>
                    </div>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <p>You have no appointments.</p>
<?php endif; ?>

</body>
</html>
