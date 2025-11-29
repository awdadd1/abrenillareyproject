<h1>Manage Staff</h1>
<a href="/admin/create-staff">Add New Staff</a>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Position</th>
            <th>Availability</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($staff as $member): ?>
        <tr>
            <td><?= $member['id'] ?></td>
            <td><?= $member['name'] ?></td>
            <td><?= $member['position'] ?></td>
            <td><?= $member['availability'] ?></td>
            <td>
                <a href="/admin/edit-staff/<?= $member['id'] ?>">Edit</a>
                <a href="/admin/delete-staff/<?= $member['id'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
