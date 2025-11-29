<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            margin: 0;
            font-family: 'Roboto', sans-serif;
            background-color: #f0f2f5;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            color: #333;
        }

        .form-container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
        }

        .form-container h1 {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 20px;
            font-size: 1.8em;
            border-bottom: 2px solid #3498db;
            padding-bottom: 10px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 8px;
            font-size: 1.1em;
            color: #333;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 12px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 1em;
            color: #333;
            background-color: #f9f9f9;
            transition: border-color 0.3s ease;
        }

        .form-group input:focus,
        .form-group select:focus {
            border-color: #3498db;
        }

        .form-container button {
            width: 100%;
            padding: 15px;
            background-color: #3498db;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 1.1em;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .form-container button:hover {
            background-color: #2980b9;
        }

        .form-container i {
            margin-right: 10px;
            color: #3498db;
        }

        .form-container select {
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="form-container">
        <h1><i class="fas fa-user-edit"></i> Edit User</h1>
        <form action="/admin/update-user/<?= $user['id'] ?>" method="post">
            <div class="form-group">
                <label for="username"><i class="fas fa-user"></i> Username:</label>
                <input type="text" id="username" name="username" value="<?= $user['username'] ?>" required>
            </div>
            <div class="form-group">
                <label for="email"><i class="fas fa-envelope"></i> Email:</label>
                <input type="email" id="email" name="email" value="<?= $user['email'] ?>" required>
            </div>
            <div class="form-group">
                <label for="role"><i class="fas fa-user-tag"></i> Role:</label>
                <select id="role" name="role" required>
                    <option value="admin" <?= $user['role'] == 'admin' ? 'selected' : '' ?>>Admin</option>
                    <option value="user" <?= $user['role'] == 'user' ? 'selected' : '' ?>>User</option>
                </select>
            </div>
            <button type="submit"><i class="fas fa-save"></i> Update User</button>
        </form>
    </div>
</body>

</html>
