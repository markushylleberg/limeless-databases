<?php
/**
 * ****************************************
 * API
 * Update credit card
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
 */try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

// Set variables
$iCreditCardId  = $_POST['iCreditCardId'];
$cIBAN          = $_POST['txtIBAN'];
$cCCV           = $_POST['txtCCV'];
$dExpiration    = $_POST['txtExpiration'];
echo $dExpiration;

/**
 * SQL query 
 * Update user into db
 */
$sql = "UPDATE tcreditcard 
SET 
cIBAN = :cIBAN,
cCCV = :cCCV,
dExpiration = :dExpiration
WHERE nCreditCardId = :iCreditCardId";

$stmt = $pdo->prepare($sql);
$stmt->bindParam(':iCreditCardId', $iCreditCardId, PDO::PARAM_INT);
$stmt->bindParam(':cIBAN', $cIBAN, PDO::PARAM_STR);
$stmt->bindParam(':cCCV', $cCCV, PDO::PARAM_STR);
$stmt->bindParam(':dExpiration', $dExpiration, PDO::PARAM_STR);
$stmt->execute();


    
$pdo = null;
echo '{"status:1, "message":"Success", "line":"'.__LINE__.'"}';
//******************** FUNCTIONS ********************/
function sendErrorMessage($sMessage, $iLine) {
    echo '{"status:0, "message":"'.$sMessage.'", "line":"'.$iLine.'"}';
    exit;
}