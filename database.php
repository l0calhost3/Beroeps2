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

function saveUploadedRecipeImage(array $file): string
{
    $uploadError = $file['error'] ?? UPLOAD_ERR_NO_FILE;

    if ($uploadError === UPLOAD_ERR_NO_FILE) {
        return '';
    }

    $uploadErrors = [
        UPLOAD_ERR_INI_SIZE => 'De afbeelding is groter dan de server toestaat. Kies een kleiner bestand.',
        UPLOAD_ERR_FORM_SIZE => 'De afbeelding is groter dan toegestaan.',
        UPLOAD_ERR_PARTIAL => 'De afbeelding is niet volledig geüpload. Probeer het opnieuw.',
        UPLOAD_ERR_NO_TMP_DIR => 'De tijdelijke uploadmap van PHP ontbreekt.',
        UPLOAD_ERR_CANT_WRITE => 'De afbeelding kon niet naar de server worden geschreven.',
        UPLOAD_ERR_EXTENSION => 'Een PHP-extensie heeft de upload geblokkeerd.',
    ];

    if ($uploadError !== UPLOAD_ERR_OK) {
        throw new RuntimeException($uploadErrors[$uploadError] ?? 'De afbeelding kon niet worden geüpload.');
    }

    if (!isset($file['tmp_name']) || !is_uploaded_file($file['tmp_name'])) {
        throw new RuntimeException('De tijdelijke upload is niet beschikbaar. Probeer het opnieuw.');
    }

    $imageInfo = getimagesize($file['tmp_name']);
    $extensions = [
        'image/jpeg' => 'jpg',
        'image/png' => 'png',
        'image/gif' => 'gif',
        'image/webp' => 'webp',
    ];
    $mimeType = $imageInfo['mime'] ?? '';

    if (!$imageInfo || !isset($extensions[$mimeType])) {
        throw new RuntimeException('Gebruik een JPG-, PNG-, GIF- of WEBP-afbeelding.');
    }

    if (!function_exists('imagecreatetruecolor')) {
        throw new RuntimeException('De server ondersteunt het verkleinen van afbeeldingen niet.');
    }

    $uploadDirectory = __DIR__ . '/images/uploads';
    if (!is_dir($uploadDirectory) && !mkdir($uploadDirectory, 0755, true)) {
        throw new RuntimeException('De uploadmap kon niet worden aangemaakt.');
    }

    $fileName = bin2hex(random_bytes(16)) . '.' . $extensions[$mimeType];
    $targetPath = $uploadDirectory . '/' . $fileName;

    $sourceImage = match ($mimeType) {
        'image/jpeg' => imagecreatefromjpeg($file['tmp_name']),
        'image/png' => imagecreatefrompng($file['tmp_name']),
        'image/gif' => imagecreatefromgif($file['tmp_name']),
        'image/webp' => imagecreatefromwebp($file['tmp_name']),
    };

    if (!$sourceImage) {
        throw new RuntimeException('De afbeelding kon niet worden gelezen.');
    }

    $maxWidth = 1600;
    $maxHeight = 1200;
    $scale = min($maxWidth / $imageInfo[0], $maxHeight / $imageInfo[1], 1);
    $width = max(1, (int) round($imageInfo[0] * $scale));
    $height = max(1, (int) round($imageInfo[1] * $scale));
    $resizedImage = imagecreatetruecolor($width, $height);

    if ($mimeType === 'image/png' || $mimeType === 'image/webp') {
        imagealphablending($resizedImage, false);
        imagesavealpha($resizedImage, true);
    }

    imagecopyresampled(
        $resizedImage,
        $sourceImage,
        0,
        0,
        0,
        0,
        $width,
        $height,
        $imageInfo[0],
        $imageInfo[1]
    );

    $saved = match ($mimeType) {
        'image/jpeg' => imagejpeg($resizedImage, $targetPath, 85),
        'image/png' => imagepng($resizedImage, $targetPath, 6),
        'image/gif' => imagegif($resizedImage, $targetPath),
        'image/webp' => imagewebp($resizedImage, $targetPath, 85),
    };

    imagedestroy($sourceImage);
    imagedestroy($resizedImage);

    if (!$saved) {
        throw new RuntimeException('De afbeelding kon niet worden opgeslagen.');
    }

    return 'images/uploads/' . $fileName;
}
