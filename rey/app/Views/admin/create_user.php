<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create User</title>
</head>
<body>
    <h1>Create New User</h1>
    <form action="/admin/store-user" method="post">
        <?= csrf_field() ?>

        <label for="username">Username:</label>
        <input type="text" name="username" id="username" required>
        <br>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required>
        <br>

        <label for="role">Role:</label>
        <select name="role" id="role">
            <option value="admin">Admin</option>
            <option value="user">User</option>
        </select>
        <br>

        <button type="submit">Create User</button>
        <a href="/admin/manage-users">Back to User List</a>
    </form>
</body>
</html>
