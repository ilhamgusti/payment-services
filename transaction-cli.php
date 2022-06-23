<?php

if ($argc < 3) {
    exit("fill the requirement args");
}
require_once 'src/config/app.php';
require_once 'src/core/Database.php';

$referenceId = $argv[1];
$status = $argv[2];

try {
    $db = new Database;
    $db->query("UPDATE transactions SET status=:status WHERE id=:references_id");
    $db->bind("references_id", $referenceId);
    $db->bind("status", $status);
    $db->execute();
    echo "[".$db->rowCount()."]";
} catch (PDOException $e) {
    echo "[Failed] ". $e->getMessage();
}
