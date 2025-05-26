<?php if (!empty($flash_error)): ?>
    <div class="mb-4 bg-red-100 text-red-700 px-4 py-2 rounded flash-message" id="flash-error">
        <ul class="list-disc pl-5">
            <?php foreach ($flash_error as $msg): ?>
                <li><?= htmlspecialchars($msg) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<?php if (!empty($flash_success)): ?>
    <div class="mb-4 bg-green-100 text-green-700 px-4 py-2 rounded flash-message" id="flash-success">
        <ul class="list-disc pl-5">
            <?php foreach ($flash_success as $msg): ?>
                <li><?= htmlspecialchars($msg) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<script>
    setTimeout(function() {
        document.querySelectorAll('.flash-message').forEach(function(el) {
            el.style.transition = "opacity 0.5s";
            el.style.opacity = 0;
            setTimeout(function() {
                el.remove();
            }, 500);
        });
    }, 1000 * 5); // 5 segundos
</script>