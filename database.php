<?php

$databasePath = __DIR__ . '/dashboard/CRUD-DB.sqlite';

try {
    $db = new PDO('sqlite:' . $databasePath);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    $columns = $db->query('PRAGMA table_info(CRUD)')->fetchAll();
    $hasImageColumn = array_filter($columns, static fn (array $column): bool => $column['name'] === 'Image');
    if (!$hasImageColumn) {
        $db->exec("ALTER TABLE CRUD ADD COLUMN Image TEXT NOT NULL DEFAULT ''");
    }
} catch (PDOException $exception) {
    error_log($exception->getMessage());
    exit('Databaseverbinding mislukt.');
}
