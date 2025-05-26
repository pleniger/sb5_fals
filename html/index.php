<?php
header('Content-Type: text/plain');
echo "--- \$_SERVER ---\n";
print_r($_SERVER);

echo "\n--- Redis Test ---\n";
try {
	$redis = new Redis();
	$redis->connect('redis', 6379);
	$redis->set("test", "OK");
	echo "Redis funktioniert: " . $redis->get("test") . "\n";
} catch (Exception $e) {
	echo "Redis Fehler: " . $e->getMessage() . "\n";
}

echo "\n--- MongoDB Test ---\n";
try {
	$manager = new MongoDB\Driver\Manager("mongodb://admin:Falstaff2025@mongo:27017");
	$stats = $manager->executeCommand("admin", new MongoDB\Driver\Command(["serverStatus" => 1]));
	echo "MongoDB funktioniert: OK\n";
} catch (Exception $e) {
	echo "MongoDB Fehler: " . $e->getMessage() . "\n";
}

