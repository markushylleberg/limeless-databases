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

$sqlQuery = "SELECT * FROM trecipe WHERE trecipe.nRecipeId = :nRecipeId";
$stmt = $pdo->prepare($sqlQuery);
$stmt->execute([
    'nRecipeId'=>$nRecipeId
]);
$recipe = $stmt->fetchObject(); 
?>

<div id="recipe-<?=$recipe->nRecipeId?>" class="recipe">
    <form action="" method="POST" id="frmUpdateRecipe">
    <input type="hidden" name="intRecipeId" value="<?=$recipe->nRecipeId?>">
        <div class="input-pair">
            <label for="txtNewRecipeTitle">
            <input id="txtNewRecipeTitle" name="txtNewRecipeTitle" type="text" value="<?=$recipe->cTitle?>">
        </div>
        <div class="input-pair">
            <label for="txtNewRecipeDescription">
            <input id="txtNewRecipeDescription" name="txtNewRecipeDescription" type="text" value="<?=$recipe->cDescription?>">
        </div>
        <div id="btnUpdateRecipe" type="submit" name="btnUpdateRecipe" onclick="updateRecipe(this)">Update recipe</div>
    </form>
</div>

<?php require_once('components/footer.php'); ?>