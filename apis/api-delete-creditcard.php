<?php
/**
 * ****************************************
 * API
 * Delete creditcard from database
 * ****************************************
 */

// Exit if nothing sent
if( empty($_GET) ) {
    sendErrorMessage('Nothing sent', __LINE__);
}

/**
 * Creditcard to delete
 * Id passed via $_GET
 */
$nCreditCardId = $_GET['id'];

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
 * Delete credit card
 * Foreign key constraint is SET NULL for nCreditCardId in tpayment 
 */
$sql = "DELETE FROM tcreditcard WHERE nCreditCardId = :nCreditCardId";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':nCreditCardId', $nCreditCardId, PDO::PARAM_INT);
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