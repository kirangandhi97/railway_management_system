<?php
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php?page=login");
    exit;
}
?>

<?php include 'partials/header.php'; ?>

<div class="container mt-4">
    <h2 class="mb-4">Search for Trains</h2>
    <form action="index.php?page=dashboard" method="POST" class="p-4 border rounded bg-light shadow-sm">
        <?php if (isset($_REQUEST['error'])) { ?>
            <div class="row mb-3">
                <div class="col-12">
                    <div class="alert alert-danger" role="alert">
                        <?php echo $_REQUEST['error']; ?>
                    </div>
                </div>
            </div>
        <?php } ?>
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="source" class="form-label">Source</label>
                <input type="text" name="source" id="source" class="form-control" placeholder="Enter Source" required>
            </div>
            <div class="col-md-6">
                <label for="destination" class="form-label">Destination</label>
                <input type="text" name="destination" id="destination" class="form-control" placeholder="Enter Destination" required>
            </div>
        </div>
        <button type="submit" class="btn btn-primary w-100">Search</button>
    </form>

    <?php if (isset($trains) && count($trains) > 0) : ?>
        <h3 class="mt-4">Available Trains</h3>
        <table class="table table-bordered table-striped mt-3">
            <thead class="table-dark">
                <tr>
                    <th>Train Name</th>
                    <th>Source</th>
                    <th>Destination</th>
                    <th>Book</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($trains as $train) : ?>
                    <tr>
                        <td><?php echo htmlspecialchars($train['train_name']); ?></td>
                        <td><?php echo htmlspecialchars($train['source']); ?></td>
                        <td><?php echo htmlspecialchars($train['destination']); ?></td>
                        <td>
                            <form action="index.php?page=book" method="POST">
                                <input type="hidden" name="train_id" value="<?php echo $train['id']; ?>">
                                <input type="number" name="seats" class="form-control d-inline w-50" placeholder="Seats" required min="1">
                                <button type="submit" class="btn btn-success btn-sm">Book</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php elseif (isset($trains) && count($trains) === 0) : ?>
        <div class="alert alert-warning mt-3">No trains found for the selected route.</div>
    <?php endif; ?>
</div>

<?php include 'partials/footer.php'; ?>