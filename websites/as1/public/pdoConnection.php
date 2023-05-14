<?php
$database = 'mysql';
$user = 'student';
$key = 'student';
$nameofdatabase = 'assignment1';

try {
    $nep = new PDO('mysql:dbname=' . $nameofdatabase . ';host=' . $database, $user, $key);
    $nep->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Additional configuration options can be set here, if needed
} catch (PDOException $error) {
    echo "Connection failed: " . $error->getMessage();
}
?>
