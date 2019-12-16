<?php
/**
 * ****************************************
 * API
 * Insert recipe ingredient into database
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
$options    = [PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION];

/**
 * PDO
 * Catch potential error messages
 */try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

$nRecipeId          = $_POST['nRecipeId'];
$nFoodItemId        = $_POST['nFoodItemId'];
$nMeassurementId    = $_POST['nMeassurementId'];
$nAmount            = $_POST['nIngredientAmount'];

$sqlQuery = "INSERT INTO trecipeingredient(nRecipeId, nFoodItemId, nAmount, nMeassurementId) VALUES(:nRecipeId, :nFoodItemId, :nIngredientAmount, :nMeassurementId)";
$stmt = $pdo->prepare($sqlQuery);
$stmt->bindParam(':nRecipeId', $nRecipeId, PDO::PARAM_INT);
$stmt->bindParam(':nFoodItemId', $nFoodItemId, PDO::PARAM_INT);
$stmt->bindParam(':nIngredientAmount', $nAmount, PDO::PARAM_INT);
$stmt->bindParam(':nMeassurementId', $nMeassurementId, PDO::PARAM_INT);
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