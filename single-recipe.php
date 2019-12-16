<?php require_once('components/header.php'); ?>

<?php 
/**
 * Single page
 * Recipe
 */

$nRecipeId  = $_GET['id'];
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
// $sqlQuery = 'SELECT trecipe.nRecipeId AS nRecipeId, 
//                     trecipe.cTitle AS cRecipeTitle, 
//                     trecipe.cDescription AS cRecipeDescription,
//                     tfooditem.cName AS cFoodItemName,
//                     tmeassurement.cName AS cMeassurementName,
//                     trecipeingredient.nAmount AS nRecipeIngredientAmount
//              FROM trecipeingredient
//              INNER JOIN trecipe ON trecipe.nRecipeId = trecipeingredient.nRecipeId
//              INNER JOIN tfooditem ON tfooditem.nFoodItemId = trecipeingredient.nFoodItemId
//              INNER JOIN tmeassurement ON tmeassurement.nMeassurementId = trecipeingredient.nMeassurementId 
//              WHERE trecipeingredient.nRecipeId = :nRecipeId';

$sqlQuery = "SELECT * FROM trecipe WHERE trecipe.nRecipeId = :nRecipeId";
$stmt = $pdo->prepare($sqlQuery);
$stmt->execute([
    'nRecipeId'=>$nRecipeId
]);
$recipe = $stmt->fetchObject(); 
// echo json_encode($recipe);
?>
<div id="recipe-<?=$recipe->nRecipeId?>" class="recipe">
    <h3 class="title"><?=$recipe->cTitle;?></h3>
    <p><?=$recipe->cDescription;?></p>
    <ul>
        <?php
            $sqlQuery = "SELECT tfooditem.cName AS cFoodItemName, 
            tmeassurement.cName AS cMeassurementName, 
            trecipeingredient.nAmount AS nRecipeIngredientAmount
            FROM trecipeingredient
            INNER JOIN tfooditem ON tfooditem.nFoodItemId = trecipeingredient.nFoodItemId
            INNER JOIN tmeassurement ON tmeassurement.nMeassurementId = trecipeingredient.nMeassurementId 
            WHERE nRecipeId = :nRecipeId";
            $stmt = $pdo->prepare($sqlQuery);
            $stmt->execute(['nRecipeId' => $nRecipeId]);
            $ingredients = $stmt->fetchAll(); 
            // echo json_encode($ingredients);
            foreach($ingredients as $ingredient) { ?> 
                <li class="ingredient"><?="$ingredient->nRecipeIngredientAmount $ingredient->cMeassurementName $ingredient->cFoodItemName"?></li>
            <?php } ?>

    </ul>
</div>
<?php require_once('components/footer.php'); ?>