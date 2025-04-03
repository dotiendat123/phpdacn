<?php
ob_start();
?>

<h2 class="text-xl font-bold mb-4">Danh sách Mục tiêu</h2>
<p>Hiển thị các mục tiêu ở đây.</p>

<?php
$content = ob_get_clean();
include BASE_PATH . '/views/layouts/main.php';
