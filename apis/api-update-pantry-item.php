<?php
/**
 * ****************************************
 * API
 * Update pantry item
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
$OLDnPantryId       = $_POST['nOldPantryItemPantryId'];
$NEWnPantryId          = $_POST['nNewPantryItemPantryId'];

$OLDnFoodItemId     = $_POST['nOldPantryItemFoodItemId'];
$NEWnFoodItemId        = $_POST['nNewPantryItemFoodItemId'];

$OLDdExpiration     = $_POST['nOldPantryItemExpiration'];
$NEWdExpiration        = $_POST['nNewPantryItemExpiration'];

$NEWnAmount            = $_POST['nNewPantryItemAmount'];

$NEWnMeassurementId    = $_POST['nNewPantryItemMeassurementId'];



/**
 * SQL query 
 * Update user into db
 */
$sqlQuery = "UPDATE tpantryitem 
            SET nPantryId = :NEWnPantryId,
                nFoodItemId = :NEWnFoodItemId,
                dExpiration = :NEWdExpiration,
                nAmount = :NEWnAmount,
                nMeassurementId = :NEWnMeassurementId
            WHERE nPantryId = :OLDnPantryId AND nFoodItemId = :OLDnFoodItemId AND dExpiration = :OLDdExpiration";
$stmt = $pdo->prepare($sqlQuery);
$stmt->execute([
    'NEWnPantryId'          => $NEWnPantryId,
    'NEWnFoodItemId'        => $NEWnFoodItemId,
    'NEWdExpiration'        => $NEWdExpiration,
    'NEWnAmount'            => $NEWnAmount,
    'NEWnMeassurementId'    => $NEWnMeassurementId,
    'OLDnPantryId'          => $OLDnPantryId,
    'OLDnFoodItemId'        => $OLDnFoodItemId,
    'OLDdExpiration'        => $OLDdExpiration
]);

    
$pdo = null;
echo '{"status:1, "message":"Success", "line":"'.__LINE__.'"}';
//******************** FUNCTIONS ********************/
function sendErrorMessage($sMessage, $iLine) {
    echo '{"status:0, "message":"'.$sMessage.'", "line":"'.$iLine.'"}';
    exit;
}