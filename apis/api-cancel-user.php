<?php
/**
 * ****************************************
 * API
 * Cancel user from database
 * ****************************************
 */


// Exit if nothing sent
if( empty($_GET) ) {
    sendErrorMessage('Nothing sent', __LINE__);
}

/**
 * User to cancel
 * Id passed via $_GET
 */
$nUserId = $_GET['id'];

/**
 * Database connection
 * Change $host and $root if needed
 */
$host   = 'localhost';
$user   = 'root';
$pass   = '';
$db     = 'myvirtualpantry';
$dsn    = "mysql:host=$host;dbname=$db";
$options = [
    PDO::ATTR_ERRMODE               => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE    => PDO::FETCH_ASSOC
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


/**
 * SQL query 
 * Delete user
 * Foreign key constraint is SET NULL for nUserId in tcreditcard 
 */
$dCancellation = date('Y-m-d');
$sql = "UPDATE tuser SET dCancellation = :dCancellation WHERE nUserId = :nUserId";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':nUserId', $nUserId, PDO::PARAM_INT);
$stmt->bindParam(':dCancellation', $dCancellation, PDO::PARAM_STR);
$stmt->execute();



$pdo = null;
echo '{"status:1, "message":"Success", "line":"'.__LINE__.'"}';
/**
 * ****************************************
 * FUNCTIONS
 * ****************************************
 */
function sendErrorMessage($sMessage, $iLine) {
    echo '{"status:0, "message":"'.$sMessage.'", "line":"'.$iLine.'"}';
    exit;
}