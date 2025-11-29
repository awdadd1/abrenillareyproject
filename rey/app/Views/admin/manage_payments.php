<h1>Manage Payments</h1>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Appointment ID</th>
            <th>Amount</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($payments as $payment): ?>
        <tr>
            <td><?= $payment['id'] ?></td>
            <td><?= $payment['appointment_id'] ?></td>
            <td><?= $payment['amount'] ?></td>
            <td><?= $payment['status'] ?></td>
            <td>
                <a href="/admin/view-payment/<?= $payment['id'] ?>">View</a>
                <?php if ($payment['status'] !== 'refunded'): ?>
                    <a href="/admin/issue-refund/<?= $payment['id'] ?>" onclick="return confirm('Issue refund?')">Refund</a>
                <?php endif; ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
