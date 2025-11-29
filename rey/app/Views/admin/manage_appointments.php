<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Appointments</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f7f9fc;
            display: flex;
        }

        .sidebar {
            width: 220px;
            background-color: #23272b;
            color: #ffffff;
            padding: 20px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            display: flex;
            flex-direction: column;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
        }

        .sidebar h1 {
            font-size: 1.5em;
            text-align: center;
            margin-bottom: 40px;
            color: #f0f0f0;
            border-bottom: 2px solid #ffcc00;
            padding-bottom: 10px;
        }

        .sidebar a {
            display: flex;
            align-items: center;
            color: #ffffff;
            text-decoration: none;
            padding: 12px 15px;
            border-radius: 10px;
            margin-bottom: 15px;
            margin-top: 15px; /* Added margin to move buttons lower */
            transition: background 0.3s, transform 0.3s;
            font-size: 1.1em;
        }

        .sidebar a:hover {
            background-color: #2c2f33;
            transform: translateX(5px);
        }

        .sidebar a i {
            margin-right: 15px;
            font-size: 1.2em;
        }

        .sidebar .logout {
            margin-top: auto;
            border-top: 1px solid #34495e;
            padding-top: 20px;
        }

        .sidebar .logout a {
            color: #e74c3c;
            font-weight: bold;
        }

        .sidebar .logout a:hover {
            color: #ff6b6b;
        }

        .main-content {
            margin-left: 220px;
            padding: 30px;
            width: calc(100% - 220px);
        }

        .main-content h1 {
            color: #333;
            margin-top: 0;
            margin-bottom: 20px;
            font-size: 2em;
            font-weight: 600;
            border-bottom: 3px solid #ffcc00;
            padding-bottom: 10px;
            text-align: center; /* Center-align the heading */
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 12px;
            text-align: center;
        }

        thead {
            background-color: #23272b;
            color: #ffffff;
            font-size: 1.1em;
        }

        tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tbody tr:hover {
            background-color: #f1f1f1;
        }

        th, td {
            border-bottom: 1px solid #ddd;
        }

        .actions a {
            color: #007bff;
            text-decoration: none;
            margin-right: 10px;
            font-weight: bold;
            transition: color 0.3s;
        }

        .actions a:hover {
            color: #0056b3;
        }

        .actions i {
            margin-right: 5px;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
                box-shadow: none;
            }

            .main-content {
                margin-left: 0;
                width: 100%;
            }

            .sidebar a {
                font-size: 1em;
                padding: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h1>Admin Dashboard</h1>
        <a href="<?= site_url('admin/home') ?>"><i class="fas fa-home"></i> Home</a>
    <a href="<?= site_url('admin/manage-users') ?>"><i class="fas fa-users"></i> Manage Users</a>
    <a href="<?= site_url('admin/manage-services') ?>"><i class="fas fa-concierge-bell"></i> Manage Services</a>
    <a href="<?= site_url('admin/manage-appointments') ?>"><i class="fas fa-calendar-check"></i> Manage Appointments</a>
        <div class="logout">
            <a href="/login"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </div>
    </div>
    <div class="main-content">
        <h1>Manage Appointments</h1>
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
                        <td class="actions">
                            <a href="/admin/reschedule-appointment/<?= esc($appointment['id']) ?>">Reschedule</a>
                            <a href="/admin/cancel-appointment/<?= esc($appointment['id']) ?>" onclick="return confirm('Are you sure you want to cancel this appointment?')">Cancel</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No appointments found.</p>
        <?php endif; ?>
    </div>
</body>
</html>
