<?php
ob_start();
?>

<h2 class="text-xl font-bold mb-4">Tạo Thói quen mới</h2>
<p>Form tạo thói quen ở đây.</p>

<?php
$content = ob_get_clean();
include BASE_PATH . '/views/layouts/main.php';
