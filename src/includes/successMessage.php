<?php if (!empty($_SESSION['success_message'])): ?>
    <div id="successMessage" class="successMessage">
        <i class="bi bi-check2-circle text-blue-500 text-2xl"></i>
        <p class="text-gray-700 text-lg">
            <?= htmlspecialchars($_SESSION['success_message']);
            unset($_SESSION['success_message']); ?>
        </p>
    </div>
<?php endif; ?>