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
 */
try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

// Set variables
$cName              = $_POST['txtName'];
$cSurname           = $_POST['txtSurname'];
$cEmail             = $_POST['txtEmail'];
$cAddress           = $_POST['txtAddress'];
$cPhoneNo           = $_POST['txtPhoneNo'];
$cUsername          = $_POST['txtUsername'];
$cPassword          = $_POST['txtPassword'];
$cRegistrationDate  = date('Y-m-d');
$cIBAN              = $_POST['txtIBAN'];
$cCCV               = $_POST['txtCCV'];
$cExpiration        = $_POST['txtExpiration'];

/**
 * SQL query 
 * Insert user into db
 */
$sql = "INSERT INTO tuser (cName, cSurname, cEmail, cAddress, cPhoneNo, dRegistration, cUsername, cPassword)
        VALUES(:cName, :cSurname, :cEmail, :cAddress, :cPhoneNo, :dRegistration, :cUsername, :cPassword)";
$stmt = $pdo->prepare($sql);
$stmt->execute([
    'cName'         => $cName,
    'cSurname'      => $cSurname,
    'cEmail'        => $cEmail,
    'cAddress'      => $cAddress,
    'cPhoneNo'      => $cPhoneNo,
    'dRegistration' => $cRegistrationDate,
    'cUsername'     => $cUsername,
    'cPassword'     => $cPassword
    ]);

$nUserId = $pdo->lastInsertId();

/**
 * SQL query 
 * Insert credit card into db
 */
$sql = "INSERT INTO tcreditcard (cIBAN, cCCV, dExpiration, nUserId)
        VALUES(:cIBAN, :cCCV, :cExpiration, :nUserId)";
$stmt = $pdo->prepare($sql);
$stmt->execute([
    'cIBAN'         => $cIBAN,
    'cCCV'          => $cCCV,
    'cExpiration'   => $cExpiration,
    'nUserId'       => $nUserId
    ]);


    
$pdo = null;
echo '{"status:1, "message":"Success", "line":"'.__LINE__.'"}';
//******************** FUNCTIONS ********************/
function sendErrorMessage($sMessage, $iLine) {
    echo '{"status:0, "message":"'.$sMessage.'", "line":"'.$iLine.'"}';
    exit;
}