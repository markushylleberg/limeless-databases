<?php require_once('components/header.php'); ?>

<?php 
if(empty($_GET)) {
    header("Location: index.php");
}

$nCreditCardId = $_GET['id'];
?>

<form id="frmUpdateCreditcard" action="" method="POST">

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
            $sqlQuery = 'SELECT * FROM tcreditcard WHERE nCreditCardId = :nCreditCardId';
            $stmt = $pdo->prepare($sqlQuery);
            $stmt->execute([
                'nCreditCardId'=>$nCreditCardId
            ]);
            $creditcard = $stmt->fetchObject();
            ?>
            <div class="form-section">
                <p class="strong">Creditcard information</p>
                <input type="hidden" name="iCreditCardId" value="<?=$creditcard->nCreditCardId;?>">
                <div class="input-pair">
                    <label for="txtIBAN">IBAN</label>
                    <input id="txtIBAN" type="text" name="txtIBAN" value="<?=$creditcard->cIBAN;?>">
                </div>
                <div class="input-pair">
                    <label for="txtCCV">CCV</label>
                    <input id="txtCCV" type="text" name="txtCCV" value="<?=$creditcard->cCCV;?>">
                </div>
                <div class="input-pair">
                    <label for="txtExpiration">Expiration</label>
                    <input id="txtExpiration" type="text" name="txtExpiration" value="<?=$creditcard->dExpiration;?>">
                </div>
            </div>
            <button id="btnSubmitCreditcardUpdate" type="submit" name="btnSubmitUserUpdate" onclick="submitCreditcardUpdate(this)">Submit
        updates</button>
</form>

<?php require_once('components/footer.php'); ?>