<?php
/**
 * ****************************************
 * API
 * Update food item
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
$nFoodItemId        = $_POST['nFoodItemId'];
$cName              = $_POST['txtName'];
$nMeassurementId    = $_POST['nMeassurementId'];
$nCategoryId        = $_POST['nCategoryId'];

/**
 * SQL query 
 * Update user into db
 */
$sql = "UPDATE tfooditem 
SET cName = :cName, nMeassurementId = :nMeassurementId, nCategoryId = :nCategoryId WHERE nFoodItemId = :nFoodItemId";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':cName', $cName, PDO::PARAM_STR);
$stmt->bindParam(':nMeassurementId', $nMeassurementId, PDO::PARAM_STR);
$stmt->bindParam(':nCategoryId', $nCategoryId, PDO::PARAM_STR);
$stmt->bindParam(':nFoodItemId', $nFoodItemId, PDO::PARAM_INT);
$stmt->execute();






    
$pdo = null;
echo '{"status:1, "message":"Success", "line":"'.__LINE__.'"}';
//******************** FUNCTIONS ********************/
function sendErrorMessage($sMessage, $iLine) {
    echo '{"status:0, "message":"'.$sMessage.'", "line":"'.$iLine.'"}';
    exit;
}