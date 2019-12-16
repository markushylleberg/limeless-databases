<?php require_once('components/header.php'); ?>

<?php 
/**
 * Single page
 * Pantry item
 * Only for editing a pantry item
 */

$nRecipeId      = $_GET['recipeid'];
$nFoodItemId    = $_GET['fooditemid'];

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

$sqlQuery = "SELECT * FROM trecipeingredient WHERE nRecipeId = :nRecipeId AND nFoodItemId = :nFoodItemId";
$stmt = $pdo->prepare($sqlQuery);
$stmt->execute([
    'nRecipeId'     => $nRecipeId,
    'nFoodItemId'   => $nFoodItemId,
]);
$recipeitem = $stmt->fetchObject();
// echo json_encode($recipeitem);
?>


<div class="recipeitem">
    <form action="" method="POST" id="frmUpdateRecipeItem">
        

        <div class="input-pair">
            <input id="nOldRecipeItemRecipeId" name="nOldRecipeItemRecipeId" type="hidden" value="<?=$recipeitem->nRecipeId?>">
            <label for="nNewRecipeItemRecipeId">Recipe</label>
            <select id="nNewRecipeItemRecipeId" name="nNewRecipeItemRecipeId" type="text">
                <?php
                    $sqlQuery           = "SELECT nRecipeId, cTitle FROM trecipe";
                    $stmt               = $pdo->prepare($sqlQuery);
                    $stmt->execute();
                    $rows               = $stmt->fetchAll();
                    foreach($rows as $row) { ?>
                        <option value="<?=$row->nRecipeId;?>" <?php if($row->nRecipeId == $recipeitem->nRecipeId){echo 'selected';} ?>><?=$row->cTitle;?></option>
                    <?php } ?>
            </select>
        </div>

        <div class="input-pair">
            <input id="nOldRecipeItemFoodItemId" name="nOldRecipeItemFoodItemId" type="hidden" value="<?=$recipeitem->nFoodItemId?>">
            <label for="nNewRecipeItemFoodItemId">FoodItem</label>
            <select id="nNewRecipeItemFoodItemId" name="nNewRecipeItemFoodItemId" type="text">
                <?php
                    $sqlQuery           = "SELECT nFoodItemId, cName FROM tfooditem";
                    $stmt               = $pdo->prepare($sqlQuery);
                    $stmt->execute();
                    $rows               = $stmt->fetchAll();
                    foreach($rows as $row) { ?>
                        <option value="<?=$row->nFoodItemId;?>" <?php if($row->nFoodItemId == $recipeitem->nFoodItemId){echo 'selected';} ?>><?=$row->cName;?></option>
                    <?php } ?>
            </select>
        </div>

        <div class="input-pair">
            <label for="nNewRecipeItemAmount">Amount</label>
            <input id="nNewRecipeItemAmount" name="nNewRecipeItemAmount" type="text" value="<?=$recipeitem->nAmount;?>">
        </div>

        <div class="input-pair">
            <label for="nNewRecipeItemMeassurementId">Meassurement</label>
            <select id="nNewRecipeItemMeassurementId" name="nNewRecipeItemMeassurementId" type="text">
                <?php
                    $sqlQuery           = "SELECT nMeassurementId, cName FROM tmeassurement";
                    $stmt               = $pdo->prepare($sqlQuery);
                    $stmt->execute();
                    $rows               = $stmt->fetchAll();
                    foreach($rows as $row) { ?>
                        <option value="<?=$row->nMeassurementId;?>" <?php if($row->nMeassurementId == $recipeitem->nMeassurementId){echo 'selected';} ?>><?=$row->cName;?></option>
                    <?php } ?>
            </select>
        </div>

        <div id="btnUpdateRecipeItem" type="submit" name="btnUpdateRecipeItem" onclick="updateRecipeItem(this)">Update recipe ingredient</div>
    </form>
</div>

<?php require_once('components/footer.php'); ?>