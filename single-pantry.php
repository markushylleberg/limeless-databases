<?php require_once('components/header.php'); ?>

<?php 
/**
 * Single page
 * Pantry
 */

$nPantryId  = $_GET['id'];


$host       = 'localhost';
$user       = 'root';
$pass       = '';
$db         = 'myvirtualpantry';
$dsn        = "mysql:host=$host;dbname=$db";
$options    = [
    PDO::ATTR_DEFAULT_FETCH_MODE    => PDO::FETCH_OBJ,
    PDO::ATTR_ERRMODE               => PDO::ERRMODE_EXCEPTION
];
$pdo    = new PDO($dsn, $user, $pass, $options);

$sqlQuery = "SELECT * FROM tpantry WHERE tpantry.nPantryId = :nPantryId";
$stmt = $pdo->prepare($sqlQuery);
$stmt->execute([
    'nPantryId'=>$nPantryId
]);
$pantry = $stmt->fetchObject(); 
?>

<div id="pantry-<?=$pantry->nPantryId?>" class="pantry">
    <h3 class="title"><?=$pantry->cName;?></h3>
    <p><?=$pantry->nUserId;?></p>
    <ul>
        <?php
            $sqlQuery = "SELECT tfooditem.cName AS cFoodItemName, 
            tmeassurement.cName AS cMeassurementName, 
            tpantryitem.nAmount AS nPantryIngredientAmount,
            tpantryitem.dExpiration AS nPantryIngredientExpiration
            FROM tpantryitem
            INNER JOIN tfooditem ON tfooditem.nFoodItemId = tpantryitem.nFoodItemId
            INNER JOIN tmeassurement ON tmeassurement.nMeassurementId = tpantryitem.nMeassurementId 
            WHERE nPantryId = :nPantryId";
            $stmt = $pdo->prepare($sqlQuery);
            $stmt->execute(['nPantryId' => $nPantryId]);
            $ingredients = $stmt->fetchAll(); 
            foreach($ingredients as $ingredient) { ?> 
                <li class="ingredient"><?="$ingredient->nPantryIngredientAmount $ingredient->cMeassurementName $ingredient->cFoodItemName, expires: $ingredient->nPantryIngredientExpiration";?></li>
            <?php } ?>
    </ul>
</div>
<?php require_once('components/footer.php'); ?>