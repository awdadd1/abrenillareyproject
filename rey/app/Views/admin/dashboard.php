<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            font-family: 'Roboto', sans-serif;
            background-color: #f7f9fc;
            display: flex;
        }

        .sidebar {
            width: 240px;
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

        /* System Mode Switch */
        .system-mode {
            margin-top: 20px;
            background-color: #2c2f33;
            border-radius: 10px;
            padding: 15px;
            text-align: center;
        }

        .switch-label {
            font-size: 0.95em;
            margin-bottom: 10px;
            display: block;
            color: #f0f0f0;
        }

        .switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 30px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #e74c3c;
            transition: .4s;
            border-radius: 30px;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 22px;
            width: 22px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            transition: .4s;
            border-radius: 50%;
        }

        input:checked + .slider {
            background-color: #2ecc71;
        }

        input:checked + .slider:before {
            transform: translateX(30px);
        }

        .main-content {
            margin-left: 240px;
            padding: 30px;
            width: calc(100% - 240px);
        }

        .main-content h2 {
            color: #333;
            margin-top: 0;
            margin-bottom: 20px;
            font-size: 2em;
            font-weight: 600;
            border-bottom: 3px solid #ffcc00;
            padding-bottom: 10px;
            text-align: center;
        }

        .statistics {
            display: flex;
            justify-content: center;
            gap: 30px;
            margin-top: 60px;
            flex-wrap: wrap;
        }

        .stat-card {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 30px;
            width: 250px;
            text-align: center;
            color: #333;
            transition: transform 0.3s;
        }

        .stat-card:hover {
            transform: scale(1.05);
        }

        .stat-card h3 {
            font-size: 2.5em;
            margin: 0;
            color: black;
        }

        .stat-card p {
            font-size: 1.2em;
            color: #666;
            margin: 0;
        }

        /* Notification */
        .notification {
            position: fixed;
            top: 20px;
            right: 20px;
            background-color: #2ecc71;
            color: white;
            padding: 15px 25px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            font-weight: 500;
            display: none;
            z-index: 9999;
        }

        .notification.error {
            background-color: #e74c3c;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }

            .main-content {
                margin-left: 0;
                width: 100%;
            }

            .statistics {
                flex-direction: column;
                align-items: center;
                margin-top: 40px;
            }

            .stat-card {
                width: 90%;
                margin-bottom: 20px;
            }
        }
        table tbody tr:hover {
    background-color: #f0f0f0;
}

table th, table td {
    font-size: 0.95em;
}

    </style>
</head>

<body>
    <div class="notification" id="notification"></div>

<div class="sidebar">
    <h1>Admin Dashboard</h1>
    <a href="<?= site_url('admin/home') ?>"><i class="fas fa-home"></i> Home</a>
    <a href="<?= site_url('admin/manage-users') ?>"><i class="fas fa-users"></i> Manage Users</a>
    <a href="<?= site_url('admin/manage-services') ?>"><i class="fas fa-concierge-bell"></i> Manage Services</a>
    <a href="<?= site_url('admin/manage-appointments') ?>"><i class="fas fa-calendar-check"></i> Manage Appointments</a>

    <!-- System Mode Switch -->
    <div class="system-mode">
        <span class="switch-label">System Mode</span>
        <form id="modeForm" action="<?= site_url('admin/toggle-system') ?>" method="post">
            <label class="switch">
                <input type="checkbox" name="mode" onchange="toggleMode(this)" <?= $systemMode === 'online' ? 'checked' : '' ?>>
                <span class="slider"></span>
            </label>
            <p style="margin-top:8px;font-size:0.9em;color:#ccc;">
                <strong id="modeText"><?= ucfirst($systemMode) ?></strong>
            </p>
        </form>
    </div>

    <div class="logout">
        <a href="<?= site_url('login') ?>"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>
</div>

    <div class="main-content">
        <h2>Welcome to the Admin Dashboard</h2>

        <div class="statistics">
            <div class="stat-card">
                <h3><?= $totalUsers ?></h3>
                <p>Total Users</p>
            </div>
            <div class="stat-card">
                <h3><?= $totalServices ?></h3>
                <p>Total Services</p>
            </div>
            <div class="stat-card">
                <h3><?= $totalAppointments ?></h3>
                <p>Total Appointments</p>
            </div>
        </div>
        <div style="margin-top:50px;">
    <div style="display:flex; justify-content:space-between; align-items:center;margin-left:20px;">
        <h2>Network Logs</h2>
        <a href="/admin/clear-network-logs" 
           style="background:#e74c3c; color:white; padding:8px 12px; border-radius:5px; text-decoration:none;">
           <i class="fas fa-trash"></i> Clear Logs
        </a>
    </div>

    <div style="overflow-x:auto; margin-top:15px;">
        <table style="width:100%; border-collapse:collapse;margin-left:20px;">
            <thead>
                <tr style="background:#23272b; color:white; text-align:left;">
                    <th style="padding:10px; border-bottom:1px solid #ddd;">#</th>
                    <th style="padding:10px; border-bottom:1px solid #ddd;">User ID</th>
                    <th style="padding:10px; border-bottom:1px solid #ddd;">Action</th>
                    <th style="padding:10px; border-bottom:1px solid #ddd;">IP Address</th>
                    <th style="padding:10px; border-bottom:1px solid #ddd;">MAC Address</th>
                    <th style="padding:10px; border-bottom:1px solid #ddd;">Timestamp</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($networkLogs)): ?>
                    <?php foreach ($networkLogs as $log): ?>
                        <tr>
                            <td style="padding:10px; border-bottom:1px solid #ddd;"><?= $log['id'] ?></td>
                            <td style="padding:10px; border-bottom:1px solid #ddd;"><?= $log['username'] ?? 'System' ?></td>
                            <td style="padding:10px; border-bottom:1px solid #ddd;"><?= $log['action'] ?></td>
                            <td style="padding:10px; border-bottom:1px solid #ddd;"><?= $log['ip_address'] ?></td>
                            <td style="padding:10px; border-bottom:1px solid #ddd;"><?= $log['mac_address'] ?></td>
                            <td style="padding:10px; border-bottom:1px solid #ddd;"><?= $log['created_at'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" style="padding:10px; text-align:center;">No network logs found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
    </div>
    <!-- ========================= NETWORK LOGS ========================= -->



    <script>
        function toggleMode(checkbox) {
            const mode = checkbox.checked ? 'online' : 'maintenance';
            const text = document.getElementById('modeText');
            const notification = document.getElementById('notification');

            text.textContent = mode.charAt(0).toUpperCase() + mode.slice(1);

            // Show notification
            notification.textContent = `Switched to ${mode} mode`;
            notification.className = 'notification';
            if (mode === 'maintenance') notification.classList.add('error');
            notification.style.display = 'block';

            setTimeout(() => {
                notification.style.display = 'none';
            }, 2500);

            // Submit form after a short delay
            setTimeout(() => {
                document.getElementById('modeForm').submit();
            }, 800);
        }
    </script>
</body>
</html>
