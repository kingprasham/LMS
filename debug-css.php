<?php
include('config.php');
?>
<!DOCTYPE html>
<html>
<head>
    <title>CSS Debug Test</title>
</head>
<body>
    <h1>CSS Path Debugging</h1>

    <h2>From Root (index.php) - Localhost</h2>
    <?php
    // Simulate being in index.php on localhost
    $_SERVER['SCRIPT_NAME'] = '/LMS/index.php';
    $base = getBasePath();
    echo "<p><strong>SCRIPT_NAME:</strong> '/LMS/index.php'</p>";
    echo "<p><strong>Base Path:</strong> '$base'</p>";
    echo "<p><strong>CSS Path:</strong> '{$base}css/style.css'</p>";
    echo "<p><strong>Expected:</strong> '' (empty string)</p>";
    ?>

    <h2>From Pages Directory (pages/category.php) - Localhost</h2>
    <?php
    // Simulate being in pages/category.php on localhost
    $_SERVER['SCRIPT_NAME'] = '/LMS/pages/category.php';
    $base = getBasePath();
    echo "<p><strong>SCRIPT_NAME:</strong> '/LMS/pages/category.php'</p>";
    echo "<p><strong>Base Path:</strong> '$base'</p>";
    echo "<p><strong>CSS Path:</strong> '{$base}css/category.css'</p>";
    echo "<p><strong>Expected:</strong> '../'</p>";
    ?>

    <h2>From Root (index.php) - Production (GoDaddy)</h2>
    <?php
    // Simulate being in index.php on production
    $_SERVER['SCRIPT_NAME'] = '/index.php';
    $base = getBasePath();
    echo "<p><strong>SCRIPT_NAME:</strong> '/index.php'</p>";
    echo "<p><strong>Base Path:</strong> '$base'</p>";
    echo "<p><strong>CSS Path:</strong> '{$base}css/style.css'</p>";
    echo "<p><strong>Expected:</strong> '' (empty string)</p>";
    ?>

    <h2>From Pages Directory (pages/category.php) - Production (GoDaddy)</h2>
    <?php
    // Simulate being in pages/category.php on production
    $_SERVER['SCRIPT_NAME'] = '/pages/category.php';
    $base = getBasePath();
    echo "<p><strong>SCRIPT_NAME:</strong> '/pages/category.php'</p>";
    echo "<p><strong>Base Path:</strong> '$base'</p>";
    echo "<p><strong>CSS Path:</strong> '{$base}css/category.css'</p>";
    echo "<p><strong>Expected:</strong> '../'</p>";
    ?>

    <h2>Direct CSS File Access Tests</h2>
    <p>Click each link to verify the CSS file loads:</p>
    <ul>
        <li><a href="css/style.css" target="_blank">css/style.css</a></li>
        <li><a href="css/category.css" target="_blank">css/category.css</a></li>
        <li><a href="css/blog.css" target="_blank">css/blog.css</a></li>
        <li><a href="css/blog-detail.css" target="_blank">css/blog-detail.css</a></li>
        <li><a href="css/teach.css" target="_blank">css/teach.css</a></li>
    </ul>

    <h2>Test Actual CSS Loading</h2>
    <style>
        .test-box {
            padding: 20px;
            margin: 10px 0;
            border: 2px solid #ccc;
        }
    </style>

    <link rel="stylesheet" href="css/category.css">

    <div class="test-box">
        <p>If category.css loads, the box below should have the category page styling:</p>
        <div class="category-header-section" style="height: 100px;">
            This should have purple gradient background if CSS loads
        </div>
    </div>

    <h2>View Page Source</h2>
    <p>Right-click and "View Page Source" to see the actual HTML generated and verify CSS paths</p>
</body>
</html>
