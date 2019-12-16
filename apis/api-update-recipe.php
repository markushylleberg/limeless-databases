<?php
/**
 * ****************************************
 * API
 * Insert user into database
 * Insert users credit card into database
 * ****************************************
 */

// Exit if nothing sent
if(empty($_POST)) {
    sendErrorMessage('Nothing posted', __LINE__);
}

/**
 * Database connection
 * Change $host and $root if needed
 */
$host       = 'localhost';
$user       = 'root';
$pass       = '';
$db         = 'myvirtualpantry';
$dsn        = "mysql:host=$host;dbname=$db";
$options    = [
    PDO::ATTR_ERRMODE               => PDO::ERRMODE_EXCEPTION,
];

/**
 * PDO
 * Catch potential error messages
 */
try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

// Set variables
$intRecipeId        = $_POST['intRecipeId'];
$NEWcTitle          = $_POST['txtNewRecipeTitle'];
$NEWcDescription    = $_POST['txtNewRecipeDescription'];

/**
 * SQL query 
 * Update user into db
 */
$sqlQuery = "UPDATE trecipe SET cTitle = :cTitle, cDescription = :cDescription WHERE nRecipeId = :nRecipeId";
$stmt = $pdo->prepare($sqlQuery);
$stmt->execute([
    'cTitle'        => $NEWcTitle,
    'cDescription'  => $NEWcDescription,
    'nRecipeId'     => $intRecipeId,
]);

$pdo = null;
echo '{"status:1, "message":"Success", "line":"'.__LINE__.'"}';
//******************** FUNCTIONS ********************/
function sendErrorMessage($sMessage, $iLine) {
    echo '{"status:0, "message":"'.$sMessage.'", "line":"'.$iLine.'"}';
    exit;
}