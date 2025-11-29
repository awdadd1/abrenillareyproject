<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Appointment</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 20px;
        }
        h1 {
            color: #2980b9;
            text-align: center;
            margin-bottom: 30px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.1);
        }
        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ccc;
        }
        th {
            background-color: #2980b9;
            color: white;
        }
        form {
            margin-top: 20px;
        }
        button {
            padding: 10px 15px;
            background-color: #2980b9;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #3498db;
        }
    </style>
</head>
<body>
    <h1>View Appointment</h1>
    <table>
        <tr>
            <th>ID:</th>
            <td><?= esc($appointment['id']) ?></td>
        </tr>
        <tr>
            <th>Service:</th>
            <td><?= esc($appointment['service_name']) ?></td>
        </tr>
        <tr>
            <th>Date:</th>
            <td><?= esc($appointment['appointment_date']) ?></td>
        </tr>
        <tr>
            <th>Status:</th>
            <td><?= esc($appointment['status']) ?></td>
        </tr>
        <tr>
            <th>Full Name:</th>
            <td><?= esc($appointment['full_name']) ?></td>
        </tr>
        <tr>
            <th>Email:</th>
            <td><?= esc($appointment['email']) ?></td>
        </tr>
        <tr>
            <th>Phone:</th>
            <td><?= esc($appointment['phone']) ?></td>
        </tr>
    </table>
    <form action="/admin/update-appointment/<?= esc($appointment['id']) ?>" method="post">
        <label for="status">Status:</label>
        <select name="status" id="status">
            <option value="pending" <?= $appointment['status'] == 'pending' ? 'selected' : '' ?>>Pending</option>
            <option value="confirmed" <?= $appointment['status'] == 'confirmed' ? 'selected' : '' ?>>Confirmed</option>
            <option value="completed" <?= $appointment['status'] == 'completed' ? 'selected' : '' ?>>Completed</option>
            <option value="cancelled" <?= $appointment['status'] == 'cancelled' ? 'selected' : '' ?>>Cancelled</option>
        </select>
        <button type="submit">Update</button>
    </form>
</body>
</html>
