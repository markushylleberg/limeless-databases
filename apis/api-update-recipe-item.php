<?php
/**
 * ****************************************
 * API
 * Update recipe ingredient
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
$options    = [
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
$OLDnRecipeId           = $_POST['nOldRecipeItemRecipeId'];
$NEWnRecipeId           = $_POST['nNewRecipeItemRecipeId'];

$OLDnFoodItemId         = $_POST['nOldRecipeItemFoodItemId'];
$NEWnFoodItemId         = $_POST['nNewRecipeItemFoodItemId'];

$NEWnAmount             = $_POST['nNewRecipeItemAmount'];

$NEWnMeassurementId     = $_POST['nNewRecipeItemMeassurementId'];



/**
 * SQL query 
 * Update user into db
 */
$sqlQuery = "UPDATE trecipeingredient 
            SET nRecipeId = :NEWnRecipeId,
                nFoodItemId = :NEWnFoodItemId,
                nAmount = :NEWnAmount,
                nMeassurementId = :NEWnMeassurementId
            WHERE nRecipeId = :OLDnRecipeId AND nFoodItemId = :OLDnFoodItemId";
$stmt = $pdo->prepare($sqlQuery);
$stmt->execute([
    'NEWnRecipeId'          => $NEWnRecipeId,
    'NEWnFoodItemId'        => $NEWnFoodItemId,
    'NEWnAmount'            => $NEWnAmount,
    'NEWnMeassurementId'    => $NEWnMeassurementId,
    'OLDnRecipeId'          => $OLDnRecipeId,
    'OLDnFoodItemId'        => $OLDnFoodItemId,
]);

    
$pdo = null;
echo '{"status:1, "message":"Success", "line":"'.__LINE__.'"}';
//******************** FUNCTIONS ********************/
function sendErrorMessage($sMessage, $iLine) {
    echo '{"status:0, "message":"'.$sMessage.'", "line":"'.$iLine.'"}';
    exit;
}