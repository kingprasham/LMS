<?php
/**
 * Categories List API
 */

require_once(__DIR__ . '/../api/config.php');

$result = $conn->query("SELECT category_id as id, name, slug, description, icon, color FROM categories ORDER BY name");

$categories = [];
while ($row = $result->fetch_assoc()) {
    $categories[] = $row;
}

sendSuccess($categories, 'Categories retrieved');
?>
