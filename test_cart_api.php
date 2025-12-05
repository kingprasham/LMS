<?php
// Test Cart API - Debug Script
session_start();

echo "<h1>Cart API Debug Test</h1>";

// Check if user is logged in
echo "<h2>1. Session Check</h2>";
echo "<pre>";
echo "Session ID: " . session_id() . "\n";
echo "Logged in: " . (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] ? 'YES' : 'NO') . "\n";
if (isset($_SESSION['user_id'])) {
    echo "User ID: " . $_SESSION['user_id'] . "\n";
    echo "User Email: " . ($_SESSION['email'] ?? 'Not set') . "\n";
    echo "User Role: " . ($_SESSION['role'] ?? 'Not set') . "\n";
}
echo "</pre>";

// Test database connection
echo "<h2>2. Database Connection</h2>";
require_once('includes/db_connect.php');
if ($conn) {
    echo "<p style='color:green'>✓ Database connected successfully</p>";
} else {
    echo "<p style='color:red'>✗ Database connection failed</p>";
}

// Test CSRF token generation
echo "<h2>3. CSRF Token</h2>";
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
echo "<pre>CSRF Token: " . $_SESSION['csrf_token'] . "</pre>";

// Test API endpoint
echo "<h2>4. API Response Test</h2>";
echo "<p>Testing: <code>pages/cart_api.php?action=csrf_token</code></p>";

// Simulate API call
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://localhost/LMS/pages/cart_api.php?action=csrf_token");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_COOKIE, session_name() . '=' . session_id());
$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

echo "<p>HTTP Code: <strong>" . $httpCode . "</strong></p>";
echo "<pre>" . htmlspecialchars($response) . "</pre>";

// Test cart count
if (isset($_SESSION['user_id'])) {
    echo "<h2>5. Cart Count Query</h2>";
    $user_id = $_SESSION['user_id'];
    $stmt = $conn->prepare("SELECT COUNT(*) as count FROM cart WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();
    echo "<p>Cart items for user {$user_id}: <strong>" . $result['count'] . "</strong></p>";
    $stmt->close();
}

// JavaScript test
echo "<h2>6. JavaScript Path Test</h2>";
echo "<script>
document.write('<p>Current pathname: <code>' + window.location.pathname + '</code></p>');
document.write('<p>Includes /pages/: <strong>' + window.location.pathname.includes('/pages/') + '</strong></p>');
const apiPath = window.location.pathname.includes('/pages/')
    ? 'cart_api.php'
    : 'pages/cart_api.php';
document.write('<p>API path to use: <code>' + apiPath + '</code></p>');
</script>";

echo "<h2>7. Test Add to Cart</h2>";
echo "<button onclick='testAddToCart()'>Test Add Course</button>";
echo "<div id='test-result'></div>";

echo "<script>
async function testAddToCart() {
    const resultDiv = document.getElementById('test-result');
    resultDiv.innerHTML = 'Testing...';
    
    try {
        // Get CSRF token first
        const tokenResponse = await fetch('pages/cart_api.php?action=csrf_token');
        const tokenData = await tokenResponse.json();
        console.log('Token response:', tokenData);
        
        if (!tokenData.success) {
            resultDiv.innerHTML = '<p style=\"color:red\">Failed to get CSRF token: ' + tokenData.message + '</p>';
            return;
        }
        
        // Try to add a test course
        const response = await fetch('pages/cart_api.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': tokenData.csrf_token
            },
            body: JSON.stringify({
                action: 'add',
                csrf_token: tokenData.csrf_token,
                course_id: 999,
                course_title: 'Test Course',
                course_price: 499,
                course_original_price: 999,
                course_image: 'test.jpg',
                course_instructor: 'Test Instructor',
                course_rating: 4.5,
                course_duration: '10 hours',
                course_lectures: '50 lectures'
            })
        });
        
        const data = await response.json();
        console.log('Add to cart response:', data);
        
        if (data.success) {
            resultDiv.innerHTML = '<p style=\"color:green\">✓ Success! Cart count: ' + data.count + '</p>';
        } else {
            resultDiv.innerHTML = '<p style=\"color:red\">✗ Failed: ' + data.message + '</p>';
        }
    } catch (error) {
        resultDiv.innerHTML = '<p style=\"color:red\">✗ Error: ' + error.message + '</p>';
        console.error('Error:', error);
    }
}
</script>";
?>
