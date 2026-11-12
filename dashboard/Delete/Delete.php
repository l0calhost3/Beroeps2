<?php
require_once __DIR__ . '/../../database.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

$query = $db->prepare('DELETE FROM CRUD WHERE ID = :id');
$query->execute(['id' => filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT)]);

header('Location: ../index.php');
exit;
