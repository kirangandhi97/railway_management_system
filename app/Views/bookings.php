<?php
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php?page=login");
    exit;
}
?>

<?php include 'partials/header.php'; ?>

<div class="container mt-4">
    <h2>My Bookings</h2>
    <?php if (!empty($bookings)) : ?>
        <table class="table table-bordered table-striped mt-3">
            <thead class="table-dark">
                <tr>
                    <th>Train Name</th>
                    <th>Source</th>
                    <th>Destination</th>
                    <th>Seats</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($bookings as $booking) : ?>
                    <tr>
                        <td><?php echo htmlspecialchars($booking['train_name']); ?></td>
                        <td><?php echo htmlspecialchars($booking['source']); ?></td>
                        <td><?php echo htmlspecialchars($booking['destination']); ?></td>
                        <td><?php echo htmlspecialchars($booking['seats']); ?></td>
                        <td>
                            <span class="badge bg-<?php echo ($booking['status'] == 'confirmed') ? 'success' : 'warning'; ?>">
                                <?php echo ucfirst($booking['status']); ?>
                            </span>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else : ?>
        <p class="alert alert-warning">No bookings found.</p>
    <?php endif; ?>
</div>

<?php include 'partials/footer.php'; ?>