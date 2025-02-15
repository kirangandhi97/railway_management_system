<?php include 'partials/header.php'; ?>

<div class="container w-25 mt-5">
    <h2 class="text-center">Login</h2>
    <form action="index.php?page=login" method="POST">
        <?php if (isset($_REQUEST['error'])): ?>
            <div class="alert alert-danger my-3" role="alert">
                <?= $_REQUEST['error'] ?>
            </div>
        <?php endif; ?>
        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Login</button>
    </form>
    <p class="mt-3 text-center">Don't have an account? <a href="index.php?page=register">Register here</a></p>
</div>
</div>

<?php include 'partials/footer.php'; ?>