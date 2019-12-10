<?php
/**
 * ****************************************
 * API
 * Charge someone
 * Insert payment data into tpayment
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
    PDO::ATTR_DEFAULT_FETCH_MODE    => PDO::FETCH_ASSOC
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
$nAmount            = $_POST['nAmount'];
$nCreditCardId      = $_POST['nCreditCardId'];

/**
 * SQL query 
 * Insert payment into db
 */
$sqlQuery = "CALL pChargeCreditCard(:nAmount, :nCreditCardId)";
$stmt = $pdo->prepare($sqlQuery);
$stmt->execute([
    'nAmount'       => $nAmount,
    'nCreditCardId' => $nCreditCardId
]);


$pdo = null;
echo '{"status:1, "message":"Success", "line":"'.__LINE__.'"}';
//******************** FUNCTIONS ********************/
function sendErrorMessage($sMessage, $iLine) {
    echo '{"status:0, "message":"'.$sMessage.'", "line":"'.$iLine.'"}';
    exit;
}