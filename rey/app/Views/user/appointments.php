<h1>Your Appointments</h1>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Service ID</th>
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
            <td><?= $appointment['id'] ?></td>
            <td><?= $appointment['service_id'] ?></td>
            <td><?= $appointment['full_name'] ?></td>
            <td><?= $appointment['email'] ?></td>
            <td><?= $appointment['phone'] ?></td>
            <td><?= $appointment['appointment_date'] ?></td>
            <td><?= $appointment['status'] ?></td>
            <td>
            <a href="<?= site_url('user/reschedule-appointment/'.$appointment['id']) ?>">Reschedule</a>
            <a href="<?= site_url('user/cancel-appointment/'.$appointment['id']) ?>" onclick="return confirm('Cancel appointment?')">Cancel</a>
        </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
