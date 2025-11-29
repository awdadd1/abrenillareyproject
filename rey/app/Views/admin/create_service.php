<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Service</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f3f4f6;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            color: #333;
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

        .main-content {
            margin-left: 240px;
            padding: 40px;
            width: calc(100% - 240px);
        }

        .main-content h1 {
            color: #333;
            margin-top: 0;
            margin-bottom: 30px;
            font-size: 2em;
            font-weight: 700;
            border-bottom: 3px solid #ffcc00;
            padding-bottom: 10px;
        }

        .form-container {
            background-color: #ffffff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 10px;
            font-size: 1.1em;
            color: #333;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 15px;
            border-radius: 8px;
            border: 1px solid #ddd;
            font-size: 1em;
            color: #333;
            background-color: #f9f9f9;
            transition: border-color 0.3s ease;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            border-color: #3b82f6;
            background-color: #ffffff;
            outline: none;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2);
        }

        .form-group textarea {
            resize: vertical;
            min-height: 120px;
        }

        .form-group .error {
            color: #e74c3c;
            font-size: 0.9em;
            margin-top: 5px;
        }

        .form-container button {
            width: 100%;
            padding: 15px;
            background-color: #3b82f6;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 1.2em;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
        }

        .form-container button:hover {
            background-color: #2563eb;
            box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
        }

        .form-container button:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.5);
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
                padding: 20px;
            }

            .form-container {
                padding: 20px;
            }
        }
    </style>
</head>

<body>
    <div class="sidebar">
        <h1>Admin Dashboard</h1>
        <a href="/admin/manage-users"><i class="fas fa-users"></i> Manage Users</a>
        <a href="/admin/manage-services"><i class="fas fa-concierge-bell"></i> Manage Services</a>
        <a href="/admin/manage-appointments"><i class="fas fa-calendar-check"></i> Manage Appointments</a>
        <a href="/admin/manage-staff"><i class="fas fa-user-tie"></i> Manage Staff</a>
        <a href="/admin/manage-payments"><i class="fas fa-credit-card"></i> Manage Payments</a>
    </div>
    <div class="main-content">
        <h1>Create Service</h1>
        <div class="form-container">
            <?php if (session()->getFlashdata('errors')): ?>
                <div class="flash-message">
                    <?php foreach (session()->getFlashdata('errors') as $error): ?>
                        <p><?= $error ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            <form action="/admin/store-service" method="post">
                <?= csrf_field() ?>

                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" value="<?= old('name') ?>" required>
                    <?php if (isset($validation) && $validation->hasError('name')): ?>
                        <div class="error"><?= $validation->getError('name') ?></div>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea id="description" name="description" required><?= old('description') ?></textarea>
                    <?php if (isset($validation) && $validation->hasError('description')): ?>
                        <div class="error"><?= $validation->getError('description') ?></div>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="text" id="price" name="price" value="<?= old('price') ?>" required>
                    <?php if (isset($validation) && $validation->hasError('price')): ?>
                        <div class="error"><?= $validation->getError('price') ?></div>
                    <?php endif; ?>
                </div>

                <button type="submit">Create Service</button>
            </form>
        </div>
    </div>
</body>

</html>
