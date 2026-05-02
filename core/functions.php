<?php
session_start();

$dbPath = __DIR__ . '/../data/database.json';

function getDB() {
    global $dbPath;
    if (!file_exists($dbPath)) {
        return ["urunler" => [], "ayarlar" => [], "mesajlar" => []];
    }
    return json_decode(file_get_contents($dbPath), true);
}

function saveDB($data) {
    global $dbPath;
    file_put_contents($dbPath, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
}

function checkLogin() {
    if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
        header("Location: login.php");
        exit;
    }
}
?>
