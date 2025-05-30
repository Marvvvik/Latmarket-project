<?php
require "../database/con_db_l.php";

// Файл для логов webhook (убирай в продакшене или фильтруй)
$logFile = __DIR__ . '/success_webhook.log';

// Логируем все запросы (для отладки)
file_put_contents($logFile, date('Y-m-d H:i:s') . " Request method: " . $_SERVER['REQUEST_METHOD'] . "\n", FILE_APPEND);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Получаем JSON из тела запроса
    $input = file_get_contents('php://input');
    file_put_contents($logFile, "POST data: " . $input . "\n", FILE_APPEND);

    $data = json_decode($input, true);

    if ($data && isset($data['status']) && $data['status'] === 'paid') {
        $announcement = $data['announcement'] ?? null;
        $table = $data['table'] ?? null;

        if ($announcement && $table) {
            // Защита от SQL Injection: проверяем имя таблицы (пример - список разрешенных)
            $allowedTables = ['cars', 'ads', 'announcements']; // <- подставь свои таблицы
            if (!in_array($table, $allowedTables)) {
                file_put_contents($logFile, "Invalid table name: $table\n", FILE_APPEND);
                http_response_code(400);
                echo json_encode(['status' => 'error', 'message' => 'Invalid table']);
                exit;
            }

            // Обновляем статус
            $stmt = $db->prepare("UPDATE $table SET Statuss = 'active' WHERE id = ?");
            $stmt->bind_param('i', $announcement);

            if ($stmt->execute()) {
                file_put_contents($logFile, "Status updated for ID $announcement in table $table\n", FILE_APPEND);
                http_response_code(200);
                echo json_encode(['status' => 'ok']);
            } else {
                file_put_contents($logFile, "DB error: " . $stmt->error . "\n", FILE_APPEND);
                http_response_code(500);
                echo json_encode(['status' => 'error', 'message' => 'DB update failed']);
            }
            exit;
        } else {
            file_put_contents($logFile, "Missing announcement or table in data\n", FILE_APPEND);
            http_response_code(400);
            echo json_encode(['status' => 'error', 'message' => 'Missing data']);
            exit;
        }
    } else {
        file_put_contents($logFile, "Invalid or unpaid status\n", FILE_APPEND);
        http_response_code(400);
        echo json_encode(['status' => 'error', 'message' => 'Invalid status']);
        exit;
    }
} else {
    // GET запрос — редиректим пользователя после оплаты
    header('Location: https://latmarket.ddev.site/');
    exit;
}
