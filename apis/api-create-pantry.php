<?php
/**
 * ****************************************
 * API
 * Insert pantry into database
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


// Set variables
$cName                 = $_POST['txtPantryName'];
$nUserId                = $_POST['selPantryUserId'];


/**
 * PDO
 * Catch potential error messages
 */
try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

/**
 * SQL query 
 * Insert recipe into db
 */
$sql = "INSERT INTO tpantry (cName, nUserId)
        VALUES(:cName, :nUserId)";
$stmt = $pdo->prepare($sql);
$stmt->execute([
    'cName'     => $cName,
    'nUserId'   => $nUserId,
    ]);
 

$pdo = null;
// echo '{"status:1, "message":"Success", "line":"'.__LINE__.'"}';
//******************** FUNCTIONS ********************/
function sendErrorMessage($sMessage, $iLine) {
    echo '{"status:0, "message":"'.$sMessage.'", "line":"'.$iLine.'"}';
    exit;
}