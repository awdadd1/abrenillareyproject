<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #f4f4f4;
        }
        .card {
            border-radius: 15px;
        }
        .card-header {
            background-color: #2980b9;
            color: #fff;
            font-weight: 600;
            font-size: 1.25rem;
        }
        .btn-back {
            background-color: #e74c3c;
            color: #fff;
        }
        .btn-back:hover {
            background-color: #c0392b;
            color: #fff;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <a href="javascript:history.back()" class="btn btn-back mb-3"><i class="fas fa-arrow-left"></i> Back</a>

    <div class="card shadow-sm">
        <div class="card-header">
            Update Profile
        </div>
        <div class="card-body">
            <!-- Flash messages -->
            <?php if(session()->getFlashdata('error')): ?>
                <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
            <?php endif; ?>
            <?php if(session()->getFlashdata('success')): ?>
                <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
            <?php endif; ?>

            <!-- Profile Form -->
            <form method="post" action="/user/update-profile">
                <?= csrf_field() ?>
                
                <div class="mb-3">
                    <label for="full_name" class="form-label">Full Name</label>
                    <input type="text" id="full_name" name="full_name" class="form-control" 
                           value="<?= esc($user['full_name'] ?? '') ?>" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" id="email" name="email" class="form-control" 
                           value="<?= esc($user['email'] ?? '') ?>" required>
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label">Phone Number</label>
                    <input type="text" id="phone" name="phone" class="form-control" 
                           value="<?= esc($user['phone'] ?? '') ?>" required>
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" id="address" name="address" class="form-control" 
                           value="<?= esc($user['address'] ?? '') ?>">
                </div>

                <div class="mb-3">
                    <label for="age" class="form-label">Age</label>
                    <input type="number" id="age" name="age" class="form-control" 
                           value="<?= esc($user['age'] ?? '') ?>">
                </div>

                <button type="submit" class="btn btn-primary w-100">Update Profile</button>
            </form>
        </div>
    </div>
</div>

<!-- Bootstrap JS (optional for components like alerts) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
