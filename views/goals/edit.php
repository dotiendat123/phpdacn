<?php
ob_start();
?>

<h2 class="text-xl font-bold mb-4">Chỉnh sửa Mục tiêu</h2>
<p>Form chỉnh sửa mục tiêu ở đây.</p>

<?php
$content = ob_get_clean();
include BASE_PATH . '/views/layouts/main.php';
