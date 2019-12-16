<?php
/**
 * ****************************************
 * API
 * Insert pantry food item into database
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

$nPantryPantryId            = $_POST['nPantryPantryId'];
$nPantryFoodItemId          = $_POST['nPantryFoodItemId'];
$dPantryItemExpiration      = $_POST['dPantryItemExpiration'];
$nPantryIngredientAmount    = $_POST['nPantryIngredientAmount'];
$nPantryMeassurementId      = $_POST['nPantryMeassurementId'];


$sqlQuery = "INSERT INTO tpantryitem(nPantryId, nFoodItemId, dExpiration, nAmount, nMeassurementId)
                VALUES(:nPantryId, :nFoodItemId, :dExpiration, :nAmount, :nMeassurementId)";
$stmt = $pdo->prepare($sqlQuery);
$stmt->execute([
    'nPantryId'         => $nPantryPantryId,
    'nFoodItemId'       => $nPantryFoodItemId,
    'dExpiration'       => $dPantryItemExpiration,
    'nAmount'           => $nPantryIngredientAmount,
    'nMeassurementId'   => $nPantryMeassurementId
]);


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