<?php require_once('components/header.php'); ?>

<?php 
if(empty($_GET)) {
    header("Location: index.php");
}

$nFoodItemId = $_GET['id'];
?>

<form id="frmUpdateFoodItem" action="" method="POST">

    <?php
            $host   = 'localhost';
            $user   = 'root';
            $pass   = '';
            $db     = 'myvirtualpantry';
            $dsn = "mysql:host=$host;dbname=$db";
            $pdo = new PDO($dsn, $user, $pass);
            $pdo->setAttribute(
                PDO::ATTR_DEFAULT_FETCH_MODE,
                PDO::FETCH_OBJ
            );
            $pdo->setAttribute(
                PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION
            );
            $sqlQuery = 'SELECT * FROM tfooditem WHERE nFoodItemId = :nFoodItemId';
            $stmt = $pdo->prepare($sqlQuery);
            $stmt->execute([
                'nFoodItemId'=>$nFoodItemId
            ]);
            $fooditem = $stmt->fetchObject();
            ?>
            <div class="form-section">
                <p class="strong">Creditcard information</p>
                <input type="hidden" name="nFoodItemId" value="<?=$fooditem->nFoodItemId;?>">
                <div class="input-pair">
                    <label for="txtName">Name</label>
                    <input id="txtName" type="text" name="txtName" value="<?=$fooditem->cName;?>">
                </div>
                <div class="input-pair">
                    <label for="nMeassurementId">Meassurement id</label>
                    <input id="nMeassurementId" type="text" name="nMeassurementId" value="<?=$fooditem->nMeassurementId;?>">
                </div>
                <div class="input-pair">
                    <label for="nCategoryId">Category id</label>
                    <input id="nCategoryId" type="text" name="nCategoryId" value="<?=$fooditem->nCategoryId;?>">
                </div>
            </div>
            <button id="btnSubmitFoodItemUpdate" type="submit" name="btnSubmitFoodItemUpdate" onclick="submitFoodItemUpdate(this)">Submit
        updates</button>
</form>

<?php require_once('components/footer.php'); ?>