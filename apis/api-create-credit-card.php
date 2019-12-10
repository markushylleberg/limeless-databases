<?php
/**
 * ****************************************
 * API
 * Insert credit card into database
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
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'myvirtualpantry';
$dsn = "mysql:host=$host;dbname=$db";
$options = [
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
$cIBAN          = $_POST['txtIBAN'];
$cCCV           = $_POST['txtCCV'];
$dExpiration    = $_POST['dExpiration'];
$nUserId        = $_POST['nUserId'];


/**
 * SQL query 
 * Insert user into db
 */
$sql = "INSERT INTO tcreditcard (cIBAN, cCCV, dExpiration, nUserId)
        VALUES(:cIBAN, :cCCV, :dExpiration, :nUserId)";
$stmt = $pdo->prepare($sql);
$stmt->execute([
    'cIBAN'         => $cIBAN,
    'cCCV'          => $cCCV,
    'dExpiration'   => $dExpiration,
    'nUserId'       => $nUserId
    ]);

    
$pdo = null;
echo '{"status:1, "message":"Success", "line":"'.__LINE__.'"}';
//******************** FUNCTIONS ********************/
function sendErrorMessage($sMessage, $iLine) {
    echo '{"status:0, "message":"'.$sMessage.'", "line":"'.$iLine.'"}';
    exit;
}