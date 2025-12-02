<?php
require_once('./config.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asset Verification - LMS</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            background: #f5f5f5;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        h1 {
            color: #333;
            border-bottom: 3px solid #667eea;
            padding-bottom: 10px;
        }
        h2 {
            color: #667eea;
            margin-top: 30px;
        }
        .asset-list {
            list-style: none;
            padding: 0;
        }
        .asset-item {
            padding: 10px;
            margin: 5px 0;
            background: #f8f9fc;
            border-radius: 4px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .asset-item.exists {
            background: #e8f5e9;
            border-left: 4px solid #4caf50;
        }
        .asset-item.missing {
            background: #ffebee;
            border-left: 4px solid #f44336;
        }
        .status {
            font-weight: bold;
            padding: 5px 15px;
            border-radius: 20px;
        }
        .status.success {
            background: #4caf50;
            color: white;
        }
        .status.error {
            background: #f44336;
            color: white;
        }
        .asset-path {
            font-family: monospace;
            color: #555;
        }
        .summary {
            background: #e3f2fd;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
            border-left: 4px solid #2196f3;
        }
        .test-link {
            display: inline-block;
            margin: 5px 10px 5px 0;
            padding: 8px 16px;
            background: #667eea;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            font-size: 14px;
        }
        .test-link:hover {
            background: #764ba2;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🔍 LMS Asset Verification</h1>

        <div class="summary">
            <strong>Base Path:</strong> <code><?php echo htmlspecialchars(getBasePath()); ?></code><br>
            <strong>Document Root:</strong> <code><?php echo htmlspecialchars($_SERVER['DOCUMENT_ROOT']); ?></code><br>
            <strong>Script Name:</strong> <code><?php echo htmlspecialchars($_SERVER['SCRIPT_NAME']); ?></code>
        </div>

        <?php
        $assets = [
            'CSS Files' => [
                'css/style.css',
                'css/course-detail.css',
                'css/cart.css',
                'css/checkout.css',
                'css/order-success.css',
                'css/about.css',
                'css/faq.css',
                'css/legal.css',
                'css/contact.css',
                'css/careers.css'
            ],
            'JavaScript Files' => [
                'js/main.js',
                'js/course-detail.js',
                'js/cart.js',
                'js/checkout.js',
                'js/order-success.js'
            ],
            'PHP Pages' => [
                'pages/cart.php',
                'pages/checkout.php',
                'pages/order-success.php',
                'pages/about.php',
                'pages/faq.php',
                'pages/privacy-policy.php',
                'pages/terms.php',
                'pages/course-detail.php',
                'pages/contact.php',
                'pages/careers.php'
            ]
        ];

        $totalFiles = 0;
        $existingFiles = 0;

        foreach ($assets as $category => $files) {
            echo "<h2>$category</h2>";
            echo "<ul class='asset-list'>";

            foreach ($files as $file) {
                $totalFiles++;
                $fullPath = __DIR__ . '/' . $file;
                $exists = file_exists($fullPath);
                if ($exists) $existingFiles++;

                $statusClass = $exists ? 'exists' : 'missing';
                $statusText = $exists ? 'EXISTS' : 'MISSING';
                $statusBadge = $exists ? 'success' : 'error';

                $urlPath = getBasePath() . $file;

                echo "<li class='asset-item $statusClass'>";
                echo "<span class='asset-path'>$file</span>";
                echo "<span class='status $statusBadge'>$statusText</span>";
                echo "</li>";
            }

            echo "</ul>";
        }

        $percentage = round(($existingFiles / $totalFiles) * 100, 1);
        $summaryClass = $percentage == 100 ? '#4caf50' : ($percentage >= 80 ? '#ff9800' : '#f44336');
        ?>

        <div class="summary" style="border-left-color: <?php echo $summaryClass; ?>; background: <?php echo $summaryClass; ?>20;">
            <h3 style="margin-top: 0;">📊 Summary</h3>
            <strong>Total Files:</strong> <?php echo $totalFiles; ?><br>
            <strong>Existing Files:</strong> <?php echo $existingFiles; ?><br>
            <strong>Missing Files:</strong> <?php echo ($totalFiles - $existingFiles); ?><br>
            <strong>Completion:</strong> <?php echo $percentage; ?>%
        </div>

        <h2>🔗 Test Pages</h2>
        <p>Click these links to test if the pages load correctly with proper CSS/JS:</p>

        <h3>Shopping Flow</h3>
        <a href="<?php echo getBasePath(); ?>pages/cart.php" class="test-link" target="_blank">Shopping Cart</a>
        <a href="<?php echo getBasePath(); ?>pages/checkout.php" class="test-link" target="_blank">Checkout</a>
        <a href="<?php echo getBasePath(); ?>pages/order-success.php" class="test-link" target="_blank">Order Success</a>

        <h3>Information Pages</h3>
        <a href="<?php echo getBasePath(); ?>pages/about.php" class="test-link" target="_blank">About Us</a>
        <a href="<?php echo getBasePath(); ?>pages/faq.php" class="test-link" target="_blank">FAQ</a>
        <a href="<?php echo getBasePath(); ?>pages/contact.php" class="test-link" target="_blank">Contact</a>
        <a href="<?php echo getBasePath(); ?>pages/careers.php" class="test-link" target="_blank">Careers</a>

        <h3>Legal Pages</h3>
        <a href="<?php echo getBasePath(); ?>pages/privacy-policy.php" class="test-link" target="_blank">Privacy Policy</a>
        <a href="<?php echo getBasePath(); ?>pages/terms.php" class="test-link" target="_blank">Terms & Conditions</a>

        <h3>Course Pages</h3>
        <a href="<?php echo getBasePath(); ?>pages/course-detail.php" class="test-link" target="_blank">Course Detail</a>

        <h3>Utilities</h3>
        <a href="<?php echo getBasePath(); ?>test-paths.php" class="test-link" target="_blank">Path Debug Tool</a>
        <a href="<?php echo getBasePath(); ?>index.php" class="test-link" target="_blank">Home Page</a>

        <hr style="margin: 30px 0;">
        <p style="color: #666; font-size: 14px;">
            <strong>Note:</strong> This verification page checks if files exist in the filesystem.
            To verify that CSS and JS load correctly in the browser, click the test links above and check the browser console (F12) for any 404 errors.
        </p>
    </div>
</body>
</html>
