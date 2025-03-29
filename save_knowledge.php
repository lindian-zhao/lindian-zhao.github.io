<?php
header('Content-Type: text/plain; charset=utf-8');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    die('只允许POST请求');
}

if (!isset($_POST['knowledge']) {
    http_response_code(400);
    die('缺少知识内容');
}

$knowledge = trim($_POST['knowledge']);
if (empty($knowledge)) {
    http_response_code(400);
    die('知识内容不能为空');
}

$filePath = 'smallzhishi.txt';

// 检查文件是否存在，不存在则创建
if (!file_exists($filePath)) {
    file_put_contents($filePath, '');
}

// 将新内容追加到文件
if (file_put_contents($filePath, "\n" . $knowledge, FILE_APPEND | LOCK_EX) === false) {
    http_response_code(500);
    die('写入文件失败');
}

echo '知识已成功添加';
?>
