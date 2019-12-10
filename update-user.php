<?php require_once('components/header.php'); ?>

<?php 
if(empty($_GET)) {
    header("Location: index.php");
}

$nUserId = $_GET['id'];
?>

<form id="frmUpdateUser" action="" method="POST">

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
            $sqlQuery = 'SELECT * FROM tuser WHERE nUserId = :nUserId';
            $stmt = $pdo->prepare($sqlQuery);
            $stmt->execute([
                'nUserId'=>$nUserId
            ]);
            $user = $stmt->fetchObject(); 
            // echo $user->cName;
            ?>
    <div class="form-section">
        <p class="strong">User information</p>
        <input type="hidden" name="iUserId" value="<?=$user->nUserId;?>">
        <div class="input-pair">
            <label for="txtName">Name</label>
            <input id="txtName" name="txtName" type="text" value="<?= $user->cName; ?>">
        </div>
        <div class="input-pair">
            <label for="txtSurname">Surname</label>
            <input id="txtSurname" name="txtSurname" type="text" value="<?= $user->cSurname; ?>">
        </div>
        <div class="input-pair">
            <label for="txtEmail">Email</label>
            <input id="txtEmail" name="txtEmail" type="text" value="<?= $user->cEmail; ?>">
        </div>
        <div class="input-pair">
            <label for="txtAddress">Address</label>
            <input id="txtAddress" name="txtAddress" type="text" value="<?= $user->cAddress; ?>">
        </div>
        <div class="input-pair">
            <label for="txtPhoneNo">PhoneNo</label>
            <input id="txtPhoneNo" name="txtPhoneNo" type="text" value="<?= $user->cPhoneNo; ?>">
        </div>
        <div class="input-pair">
            <label for="txtUsername">Username</label>
            <input id="txtUsername" name="txtUsername" type="text" value="<?= $user->cUsername; ?>">
        </div>
        <div class="input-pair">
            <label for="txtPassword">Password</label>
            <input id="txtPassword" name="txtPassword" type="text" value="<?= $user->cPassword; ?>">
        </div>
    </div>

    <button id="btnSubmitUserUpdate" type="submit" name="btnSubmitUserUpdate" onclick="submitUserUpdate(this)">Submit
        updates</button>
</form>

<?php require_once('components/footer.php'); ?>