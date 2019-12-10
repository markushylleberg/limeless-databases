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
$iUserId            = $_POST['iUserId'];
$cName              = $_POST['txtName'];
$cSurname           = $_POST['txtSurname'];
$cEmail             = $_POST['txtEmail'];
$cAddress           = $_POST['txtAddress'];
$cPhoneNo           = $_POST['txtPhoneNo'];
$cUsername          = $_POST['txtUsername'];
$cPassword          = $_POST['txtPassword'];

/**
 * SQL query 
 * Update user into db
 */
$sql = "UPDATE tuser 
SET 
cName = :cName,
cSurname = :cSurname,
cEmail = :cEmail,
cAddress = :cAddress,
cPhoneNo = :cPhoneNo,
cUsername = :cUsername,
cPassword = :cPassword WHERE nUserId = :nUserId";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':nUserId', $iUserId, PDO::PARAM_INT);
$stmt->bindParam(':cName', $cName, PDO::PARAM_STR);
$stmt->bindParam(':cSurname', $cSurname, PDO::PARAM_STR);
$stmt->bindParam(':cEmail', $cEmail, PDO::PARAM_STR);
$stmt->bindParam(':cAddress', $cAddress, PDO::PARAM_STR);
$stmt->bindParam(':cPhoneNo', $cPhoneNo, PDO::PARAM_STR);
$stmt->bindParam(':cUsername', $cUsername, PDO::PARAM_STR);
$stmt->bindParam(':cPassword', $cPassword, PDO::PARAM_STR);
$stmt->execute();






    
$pdo = null;
echo '{"status:1, "message":"Success", "line":"'.__LINE__.'"}';
//******************** FUNCTIONS ********************/
function sendErrorMessage($sMessage, $iLine) {
    echo '{"status:0, "message":"'.$sMessage.'", "line":"'.$iLine.'"}';
    exit;
}