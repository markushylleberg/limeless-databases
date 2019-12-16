<?php require_once('components/header.php'); ?>

<?php 
/**
 * Single page
 * Pantry item
 * Only for editing a pantry item
 */

$nPantryId      = $_GET['pantryid'];
$nFoodItemId    = $_GET['fooditemid'];
$dExpiration    = $_GET['expiration'];

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

$sqlQuery = "SELECT * FROM tpantryitem WHERE nPantryId = :nPantryId AND nFoodItemId = :nFoodItemId AND dExpiration = :dExpiration";
$stmt = $pdo->prepare($sqlQuery);
$stmt->execute([
    'nPantryId'     => $nPantryId,
    'nFoodItemId'   => $nFoodItemId,
    'dExpiration'   => $dExpiration
]);
$pantryitem = $stmt->fetchObject();
?>


<div class="pantryitem">
    <form action="" method="POST" id="frmUpdatePantryItem">
        

        <div class="input-pair">
            <input id="nOldPantryItemPantryId" name="nOldPantryItemPantryId" type="hidden" value="<?=$pantryitem->nPantryId?>">
            <label for="nNewPantryItemPantryId">Pantry</label>
            <select id="nNewPantryItemPantryId" name="nNewPantryItemPantryId" type="text">
                <?php
                    $sqlQuery           = "SELECT nPantryId, cName FROM tpantry";
                    $stmt               = $pdo->prepare($sqlQuery);
                    $stmt->execute();
                    $rows               = $stmt->fetchAll();
                    foreach($rows as $row) { ?>
                        <option value="<?=$row->nPantryId;?>" <?php if($row->nPantryId == $pantryitem->nPantryId){echo 'selected';} ?>><?=$row->cName;?></option>
                    <?php } ?>
            </select>
        </div>

        <div class="input-pair">
            <input id="nOldPantryItemFoodItemId" name="nOldPantryItemFoodItemId" type="hidden" value="<?=$pantryitem->nFoodItemId?>">
            <label for="nNewPantryItemFoodItemId">FoodItem</label>
            <select id="nNewPantryItemFoodItemId" name="nNewPantryItemFoodItemId" type="text">
                <?php
                    $sqlQuery           = "SELECT nFoodItemId, cName FROM tfooditem";
                    $stmt               = $pdo->prepare($sqlQuery);
                    $stmt->execute();
                    $rows               = $stmt->fetchAll();
                    foreach($rows as $row) { ?>
                        <option value="<?=$row->nFoodItemId;?>" <?php if($row->nFoodItemId == $pantryitem->nFoodItemId){echo 'selected';} ?>><?=$row->cName;?></option>
                    <?php } ?>
            </select>
        </div>

        <div class="input-pair">
            <input id="nOldPantryItemExpiration" name="nOldPantryItemExpiration" type="hidden" value="<?=$pantryitem->dExpiration?>">
            <label for="nNewPantryItemExpiration">Expiration</label>
            <input id="nNewPantryItemExpiration" name="nNewPantryItemExpiration" type="date" value="<?=$pantryitem->dExpiration;?>">
        </div>

        <div class="input-pair">
            <label for="nNewPantryItemAmount">Amount</label>
            <input id="nNewPantryItemAmount" name="nNewPantryItemAmount" type="text" value="<?=$pantryitem->nAmount;?>">
        </div>

        <div class="input-pair">
            <label for="nNewPantryItemMeassurementId">Meassurement</label>
            <select id="nNewPantryItemMeassurementId" name="nNewPantryItemMeassurementId" type="text">
                <?php
                    $sqlQuery           = "SELECT nMeassurementId, cName FROM tmeassurement";
                    $stmt               = $pdo->prepare($sqlQuery);
                    $stmt->execute();
                    $rows               = $stmt->fetchAll();
                    foreach($rows as $row) { ?>
                        <option value="<?=$row->nMeassurementId;?>" <?php if($row->nMeassurementId == $pantryitem->nMeassurementId){echo 'selected';} ?>><?=$row->cName;?></option>
                    <?php } ?>
            </select>
        </div>

        <div id="btnUpdatePantryItem" type="submit" name="btnUpdatePantryItem" onclick="updatePantryItem(this)">Update pantry item</div>
    </form>
</div>

<?php require_once('components/footer.php'); ?>