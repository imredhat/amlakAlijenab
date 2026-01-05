<?php
try {
    $m = new MongoDB\Client('mongodb://localhost:27017');
    echo "MongoDB connection successful!\n";
    $databases = $m->listDatabases();
    echo "Databases found!\n";
} catch (Exception $e) {
    echo "Connection failed: " . $e->getMessage() . "\n";
}
?>
