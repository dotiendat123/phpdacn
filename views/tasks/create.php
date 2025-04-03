<?php
ob_start();
?>

<h2 class="text-xl font-bold mb-4">Tạo Công việc mới</h2>
<p>Form tạo công việc ở đây.</p>

<?php
$content = ob_get_clean();
include BASE_PATH . '/views/layouts/main.php';
