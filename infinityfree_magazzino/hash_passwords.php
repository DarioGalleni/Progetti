<?php
$hashedPassword1 = password_hash('password1', PASSWORD_DEFAULT);
$hashedPassword2 = password_hash('password2', PASSWORD_DEFAULT);

echo "Password 1: $hashedPassword1\n";
echo "Password 2: $hashedPassword2\n";
?>
