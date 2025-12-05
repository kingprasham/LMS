<?php
// Test Login Script
session_start();
header('Content-Type: text/html; charset=UTF-8');

require_once('../includes/db_connect.php');
require_once('../includes/auth_functions.php');

echo "<h2>Login Test</h2>";

// Test 1: Database Connection
echo "<h3>Test 1: Database Connection</h3>";
if ($conn) {
    echo "✅ Database connected successfully<br>";
} else {
    echo "❌ Database connection failed<br>";
    die();
}

// Test 2: Check if users table exists
echo "<h3>Test 2: Check Users Table</h3>";
$result = $conn->query("SHOW TABLES LIKE 'users'");
if ($result && $result->num_rows > 0) {
    echo "✅ Users table exists<br>";
} else {
    echo "❌ Users table not found<br>";
    die();
}

// Test 3: Get admin user
echo "<h3>Test 3: Get Admin User</h3>";
$stmt = $conn->prepare("SELECT user_id, full_name, email, role FROM users WHERE email = ?");
$email = 'admin@example.com';
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    echo "✅ Admin user found:<br>";
    echo "- User ID: " . $user['user_id'] . "<br>";
    echo "- Name: " . $user['full_name'] . "<br>";
    echo "- Email: " . $user['email'] . "<br>";
    echo "- Role: " . $user['role'] . "<br>";
} else {
    echo "❌ Admin user not found<br>";
}
$stmt->close();

// Test 4: Verify password
echo "<h3>Test 4: Verify Password</h3>";
$testUser = verifyUser($conn, 'admin@example.com', 'admin123');
if ($testUser) {
    echo "✅ Password verification successful<br>";
    echo "- User: " . $testUser['full_name'] . " (" . $testUser['role'] . ")<br>";
} else {
    echo "❌ Password verification failed<br>";
}

// Test 5: Test login_process.php with POST
echo "<h3>Test 5: Test Login Process (Simulated POST)</h3>";
echo "<form method='POST' action='login_process.php'>";
echo "<input type='hidden' name='test' value='direct'>";
echo "<button type='submit'>Test Login Directly (via form POST)</button>";
echo "</form>";

echo "<h3>Test 6: Test via JSON API</h3>";
echo "<button onclick='testLoginAPI()'>Test Login via Fetch API</button>";
echo "<div id='api-result'></div>";

echo "<script>
async function testLoginAPI() {
    const resultDiv = document.getElementById('api-result');
    resultDiv.innerHTML = 'Testing...';
    
    try {
        const response = await fetch('login_process.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ 
                email: 'admin@example.com', 
                password: 'admin123' 
            })
        });
        
        const data = await response.json();
        
        resultDiv.innerHTML = '<strong>Response:</strong><br>' + 
                             'Success: ' + data.success + '<br>' +
                             'Message: ' + data.message + '<br>' +
                             'Redirect: ' + (data.redirect || 'N/A');
        
        if (data.success) {
            resultDiv.innerHTML += '<br><br>✅ Login API Working! Redirect to: ' + data.redirect;
        } else {
            resultDiv.innerHTML += '<br><br>❌ Login Failed: ' + data.message;
        }
    } catch (error) {
        resultDiv.innerHTML = '❌ Error: ' + error.message;
    }
}
</script>";

?>
