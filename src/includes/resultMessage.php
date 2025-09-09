<?php if (!empty($_SESSION['success_message'])): ?>
    <div id="successMessage" class="successMessage">
        <i class="bi bi-check2-circle"></i>
        <p>
            <?= htmlspecialchars($_SESSION['success_message']);
            unset($_SESSION['success_message']); ?>
        </p>
    </div>
<?php elseif (!empty($_SESSION['error_message'])): ?>
    <div id="errorMessage" class="errorMessage">
        <i class="bi bi-x-circle"></i>
        <p>
            <?= htmlspecialchars($_SESSION['error_message']);
            unset($_SESSION['error_message']); ?>
        </p>
    </div>
<?php endif; ?>