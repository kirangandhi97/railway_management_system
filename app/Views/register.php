<?php include 'partials/header.php'; ?>

<div class="container w-25 mt-5">
    <h2 class="text-center">Register</h2>
    <form action="index.php?page=register" method="POST">
        <?php if (isset($_REQUEST['error'])): ?>
            <div class="alert alert-danger my-3" role="alert">
                <?= $_REQUEST['error'] ?>
            </div>
        <?php elseif (isset($_REQUEST['success'])): ?>
            <div class="alert alert-success my-3" role="alert">
                <?= $_REQUEST['success'] ?>
            </div>
        <?php endif; ?>
        <div class="mb-3">
            <label for="name" class="form-label">Full Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Register</button>
    </form>
    <p class="mt-3 text-center">Already have an account? <a href="index.php?page=login">Login here</a></p>
</div>

<?php include 'partials/footer.php'; ?>