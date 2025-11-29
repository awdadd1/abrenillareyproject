<form action="/admin/update-staff/<?= $staff['id'] ?>" method="post">
    <label for="name">Name:</label>
    <input type="text" name="name" id="name" value="<?= $staff['name'] ?>" required>

    <label for="position">Position:</label>
    <input type="text" name="position" id="position" value="<?= $staff['position'] ?>" required>

    <label for="availability">Availability:</label>
    <textarea name="availability" id="availability" required><?= $staff['availability'] ?></textarea>

    <button type="submit">Update Staff</button>
</form>
