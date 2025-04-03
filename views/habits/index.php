<?php
ob_start();
?>

<h2 class="text-xl font-bold mb-4">Danh sách Thói quen</h2>
<p>Hiển thị các thói quen ở đây.</p>

<?php
$content = ob_get_clean();
include BASE_PATH . '/views/layouts/main.php';
