<?php
ob_start();
?>

<h2 class="text-xl font-bold mb-4">Tạo Mục tiêu mới</h2>
<p>Form tạo mục tiêu ở đây.</p>

<?php
$content = ob_get_clean();
include BASE_PATH . '/views/layouts/main.php';
