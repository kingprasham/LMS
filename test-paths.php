<?php
require_once('./config.php');

echo "<h1>Path Detection Debug</h1>";
echo "<hr>";

echo "<h2>Server Variables:</h2>";
echo "<strong>SCRIPT_NAME:</strong> " . $_SERVER['SCRIPT_NAME'] . "<br>";
echo "<strong>SCRIPT_FILENAME:</strong> " . $_SERVER['SCRIPT_FILENAME'] . "<br>";
echo "<strong>DOCUMENT_ROOT:</strong> " . $_SERVER['DOCUMENT_ROOT'] . "<br>";
echo "<strong>REQUEST_URI:</strong> " . $_SERVER['REQUEST_URI'] . "<br>";

echo "<hr>";
echo "<h2>Path Detection Logic:</h2>";

$currentFile = $_SERVER['SCRIPT_NAME'];
$documentRoot = $_SERVER['DOCUMENT_ROOT'];
$scriptFilename = $_SERVER['SCRIPT_FILENAME'];

$relativePath = str_replace($documentRoot, '', dirname($scriptFilename));
$relativePath = str_replace('\\', '/', $relativePath);
$relativePath = ltrim($relativePath, '/');

$pathParts = explode('/', $relativePath);
$isInSubdirectory = !empty($pathParts[0]) && $pathParts[0] !== '';
$isLocalhost = (strpos($currentFile, '/LMS/') !== false || strpos($currentFile, '/lms/') !== false);
$isInSubfolder = $isInSubdirectory || $isLocalhost;

echo "<strong>Relative Path:</strong> " . $relativePath . "<br>";
echo "<strong>Path Parts:</strong> " . print_r($pathParts, true) . "<br>";
echo "<strong>Is In Subdirectory:</strong> " . ($isInSubdirectory ? 'YES' : 'NO') . "<br>";
echo "<strong>Is Localhost (contains /LMS/):</strong> " . ($isLocalhost ? 'YES' : 'NO') . "<br>";
echo "<strong>Final: Is In Subfolder:</strong> " . ($isInSubfolder ? 'YES' : 'NO') . "<br>";

if ($isInSubfolder) {
    $depth = substr_count($currentFile, '/') - 2;
} else {
    $depth = substr_count($currentFile, '/') - 1;
}

if ($depth < 0) $depth = 0;
$basePath = str_repeat('../', $depth);

echo "<strong>Calculated Depth:</strong> " . $depth . "<br>";
echo "<strong>Base Path:</strong> " . ($basePath === '' ? '[empty string - root]' : $basePath) . "<br>";

echo "<hr>";
echo "<h2>Generated Paths:</h2>";

echo "<strong>CSS Path:</strong> " . getBasePath() . "css/style.css<br>";
echo "<strong>JS Path:</strong> " . getBasePath() . "js/main.js<br>";
echo "<strong>Course Detail CSS:</strong> " . getBasePath() . "css/course-detail.css<br>";
echo "<strong>Cart CSS:</strong> " . getBasePath() . "css/cart.css<br>";
echo "<strong>Checkout CSS:</strong> " . getBasePath() . "css/checkout.css<br>";
echo "<strong>About CSS:</strong> " . getBasePath() . "css/about.css<br>";
echo "<strong>FAQ CSS:</strong> " . getBasePath() . "css/faq.css<br>";
echo "<strong>Legal CSS:</strong> " . getBasePath() . "css/legal.css<br>";

echo "<hr>";
echo "<h2>Test Links:</h2>";
echo "<strong>Main Pages:</strong><br>";
echo "<a href='index.php'>Index (Home)</a><br>";
echo "<a href='pages/course-detail.php'>Course Detail</a><br>";
echo "<a href='pages/contact.php'>Contact</a><br>";
echo "<a href='pages/careers.php'>Careers</a><br>";
echo "<a href='pages/about.php'>About Us</a><br>";
echo "<br><strong>Shopping Flow:</strong><br>";
echo "<a href='pages/cart.php'>Shopping Cart</a><br>";
echo "<a href='pages/checkout.php'>Checkout</a><br>";
echo "<a href='pages/order-success.php'>Order Success</a><br>";
echo "<br><strong>Legal Pages:</strong><br>";
echo "<a href='pages/faq.php'>FAQ</a><br>";
echo "<a href='pages/privacy-policy.php'>Privacy Policy</a><br>";
echo "<a href='pages/terms.php'>Terms & Conditions</a><br>";
?>
