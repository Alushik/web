<?php

$db_host = 'localhost:3306';
$db_user = 'root';
$db_pass = '12345678';
$db_name = 'lab1';

function db_connect() {
    global $db_host, $db_user, $db_pass, $db_name;
    
    list($host, $port) = explode(':', $db_host);
    
    try {
        $conn = new mysqli($host, $db_user, $db_pass, $db_name, $port);
        
        if ($conn->connect_error) {
            return [false, "Ошибка подключения: " . $conn->connect_error];
        }
        
        $conn->set_charset("utf8mb4");
        return [true, $conn];
        
    } catch (Exception $e) {
        return [false, "Ошибка: " . $e->getMessage()];
    }
}

function execute_query($sql) {
    $result = db_connect();
    
    if (!$result[0]) {
        return ['error' => $result[1]];
    }
    
    $conn = $result[1];
    $sql = trim($sql);
    
    if (empty($sql)) {
        $conn->close();
        return ['error' => 'Пустой SQL-запрос'];
    }
    
    $query_type = strtoupper(explode(' ', $sql)[0]);
    
    $query_result = $conn->query($sql);
    
    if ($query_result === false) {
        $error = $conn->error;
        $conn->close();
        return ['error' => "Ошибка SQL: $error"];
    }
    
    if (in_array($query_type, ['SELECT', 'SHOW', 'DESCRIBE', 'EXPLAIN'])) {
        $data = [];
        $columns = [];
        
        if ($query_result->num_rows > 0) {
            while ($field = $query_result->fetch_field()) {
                $columns[] = $field->name;
            }
            
            while ($row = $query_result->fetch_assoc()) {
                $data[] = $row;
            }
        }
        
        $conn->close();
        
        return [
            'type' => 'select',
            'data' => $data,
            'columns' => $columns,
            'rowcount' => count($data)
        ];
        
    } else {
        $affected_rows = $conn->affected_rows;
        $conn->close();
        
        return [
            'type' => 'update',
            'message' => "Выполнено. Затронуто строк: $affected_rows",
            'rowcount' => $affected_rows
        ];
    }
}

function check_connection() {
    $result = db_connect();
    
    if ($result[0]) {
        $conn = $result[1];
        
        $db_info = $conn->query("SELECT DATABASE() as db")->fetch_assoc();
        $conn->close();
        
        return ['success' => true, 'database' => $db_info['db']];
    } else {
        return ['success' => false, 'error' => $result[1]];
    }
}

if (isset($_GET['action']) && $_GET['action'] == 'check_connection') {
    header('Content-Type: application/json');
    echo json_encode(check_connection(), JSON_UNESCAPED_UNICODE);
    exit;
}

$result = null;
$error = null;
$query = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['sql_query'])) {
    $query = $_POST['sql_query'];
    $result = execute_query($query);
    
    if (isset($result['error'])) {
        $error = $result['error'];
        $result = null;
    }
}
?>