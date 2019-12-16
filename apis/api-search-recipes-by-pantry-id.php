<?php

/**
 * ****************************************
 * API
 * Return recipe information based on the pantry ID submitted
 * ****************************************
 */

// Exit if nothing sent

    if(empty($_GET)) {
        sendErrorMessage('Nothing posted', __LINE__);
    }

    /**
 * Database connection
 * Change $host and $root if needed
 */
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'myvirtualpantry';
$dsn = "mysql:host=$host;dbname=$db";
$options = [
    PDO::ATTR_ERRMODE               => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE    => PDO::FETCH_ASSOC
];
try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

// Set variables
$pantryId = $_GET['id'];

/**
 * SQL query 
 * Insert user into db
 */
$sql = "CALL pGetRecipesBasedOnPantryId(:nPantryId)";
$stmt = $pdo->prepare($sql);
$stmt->execute([
    'nPantryId'             => $pantryId
    ]);

    echo json_encode($stmt->fetchAll());
    
$pdo = null;


    //******************** FUNCTIONS ********************/
function sendErrorMessage($sMessage, $iLine) {
    echo '{"status:0, "message":"'.$sMessage.'", "line":"'.$iLine.'"}';
    exit;
}