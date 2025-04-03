<?php
ob_start();
?>

<h2 class="text-xl font-bold mb-4">Chỉnh sửa Công việc</h2>
<p>Form chỉnh sửa công việc ở đây.</p>

<?php
$content = ob_get_clean();
include BASE_PATH . '/views/layouts/main.php';
