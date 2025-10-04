<?php
// Password hash generator for POS system users
// Run this script to generate correct password hashes

$password = 'password123';
$hash = password_hash($password, PASSWORD_BCRYPT);

echo "Password: " . $password . "\n";
echo "Hash: " . $hash . "\n\n";

echo "SQL UPDATE statements:\n\n";

// Generate SQL updates for each user
echo "UPDATE users SET password = '$hash' WHERE username = 'manager1';\n";
echo "UPDATE users SET password = '$hash' WHERE username = 'cashier1';\n";
echo "UPDATE users SET password = '$hash' WHERE username = 'inventory1';\n";

echo "\n\nAlternatively, you can run these individual statements:\n\n";

// Generate individual hashes for each user
for ($i = 1; $i <= 3; $i++) {
    $newHash = password_hash($password, PASSWORD_BCRYPT);
    $users = ['manager1', 'cashier1', 'inventory1'];
    echo "UPDATE users SET password = '$newHash' WHERE username = '{$users[$i-1]}';\n";
}
?>