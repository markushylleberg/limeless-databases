<?php require_once('components/header.php'); ?>

<div class="content-wrapper">

    <!-- CREATE USER -->
    <section id="01">
        <h2 class="section-title">Add user</h2>

        <form action="" method="POST" id="frmSignup">
            <div class="form-section">
                <p class="strong">User information</p>
                <div class="input-pair">
                    <label for="txtName">Name</label>
                    <input id="txtName" name="txtName" type="text">
                </div>
                <div class="input-pair">
                    <label for="txtSurname">Surname</label>
                    <input id="txtSurname" name="txtSurname" type="text">
                </div>
                <div class="input-pair">
                    <label for="txtEmail">Email</label>
                    <input id="txtEmail" name="txtEmail" type="text">
                </div>
                <div class="input-pair">
                    <label for="txtAddress">Address</label>
                    <input id="txtAddress" name="txtAddress" type="text">
                </div>
                <div class="input-pair">
                    <label for="txtPhoneNo">PhoneNo</label>
                    <input id="txtPhoneNo" name="txtPhoneNo" type="text">
                </div>
                <div class="input-pair">
                    <label for="txtUsername">Username</label>
                    <input id="txtUsername" name="txtUsername" type="text">
                </div>
                <div class="input-pair">
                    <label for="txtPassword">Password</label>
                    <input id="txtPassword" name="txtPassword" type="text">
                </div>
            </div>
            <div class="form-section">
                <p class="strong">Credit card information</p>
                <div class="input-pair">
                    <label for="txtIBAN">IBAN</label>
                    <input id="txtIBAN" name="txtIBAN" type="text">
                </div>
                <div class="input-pair">
                    <label for="txtCCV">CCV</label>
                    <input id="txtCCV" name="txtCCV" type="text">
                </div>
                <div class="input-pair">
                    <label for="txtExpiration">Expiration date xxxx-xx-xx</label>
                    <input id="txtExpiration" name="txtExpiration" type="text">
                </div>
            </div>
            <button id="btnSubmitSignup" type="submit" name="btnSubmitSignup" onclick="submitSignup(this)">Signup</button>
        </form>

    </section>

    <!-- USER LIST -->
    <section id="02">
        <h2 class="section-title">Users</h2>
        <?php
            // $pdo defined in components/header.php
            $sqlQuery = 'SELECT * FROM tuser';
            $stmt = $pdo->prepare($sqlQuery);
            $stmt->execute();
            $users = $stmt->fetchAll(); ?>
            <div id="usersList">
                <table>
                    <tr>
                        <th>Id</th>
                        <th>Username</th>
                        <th>Password</th>
                        <th>Name</th>
                        <th>Surname</th>
                        <th>Address</th>
                        <th>Phone NO</th>
                        <th>Email</th>
                        <th>Date of registration</th>
                        <th>Day of cancellation</th>
                        <th>Monetary amount paid</th>
                    </tr>

                    <?php foreach($users as $user) { ?> 
                        <tr>
                            <td><?=$user->nUserId;?></td>
                            <td><?=$user->cUsername;?></td>
                            <td><?=$user->cPassword;?></td>
                            <td><?=$user->cName;?></td>
                            <td><?=$user->cSurname;?></td>
                            <td><?=$user->cAddress;?></td>
                            <td><?=$user->cPhoneNo;?></td>
                            <td><?=$user->cEmail;?></td>
                            <td><?=$user->dRegistration;?></td>
                            <td><?=$user->dCancellation;?></td>
                            <td><?=$user->nMonetaryAmount;?></td>
                            <td><a onclick="deleteUser(this)" data-user-id="<?=$user->nUserId;?>" href="#">Delete</a></td>
                            <td><a onclick="cancelUser(this)" data-user-id="<?=$user->nUserId;?>" href="#">Cancel</a></td>
                            <td><a href="update-user.php?id=<?= $user->nUserId; ?>">Update</a></td>
                        </tr>
                    <?php }; ?>

                </table>
            </div>
            <p class="strong">Search user</p>
            <form id="frmSearchUsers" action="">
            <div class="input-pair">
                <label for="txtFirstNameSearch">First Name</label>
                <input id="txtFirstNameSearch" oninput="searchUsers(this)" type="text" name="txtFirstNameSearch">
            </div>
            <div class="input-pair">
                <label for="firstDateRegistred">Member who registred betweeen this date: </label>
                <input id="firstDateRegistred" oninput="searchUsers(this)" type="date" name="firstDateRegistred">
                <label for="secondDateRegistred">and this date: </label>
                <input id="secondDateRegistred" oninput="searchUsers(this)" type="date" name="secondDateRegistred">
            </div>
        </form>

        <table id="searchResults">
            <tr>
                <th>First name</th>
                <th>Last name</th>
                <th>Email</th>
                <th>Address</th>
                <th>Phone</th>
                <th>Registration date</th>
            </tr>        
        </table>
    </section>

    <!-- CREDIT CARDS -->
    <section id="03">
        <h2 class="section-title">Creditcards</h2>
        <?php
            // $pdo defined in components/header.php
            $sqlQuery = 'SELECT * FROM tcreditcard';
            $stmt = $pdo->prepare($sqlQuery);
            $stmt->execute();
            $creditcards = $stmt->fetchAll(); ?>
               <div id="creditcardsList">
                <table>
                    <tr>
                        <th>Id</th>
                        <th>IBAN</th>
                        <th>CCV</th>
                        <th>Monetary amount</th>
                        <th>Owner</th>
                    </tr>
                    <?php foreach($creditcards as $creditcard) { ?> 
                        <tr>
                            <td><?=$creditcard->nCreditCardId;?></td>
                            <td><?=$creditcard->cIBAN;?></td>
                            <td><?=$creditcard->cCCV;?></td>
                            <td><?=$creditcard->nMonetaryAmount;?></td>
                            <td><?=$creditcard->nUserId;?></td>
                            <td><a onclick="deleteCreditcard(this)" data-creditcard-id="<?=$creditcard->nCreditCardId;?>" href="#">Delete</a></td>
                            <td><a href="update-creditcard.php?id=<?= $creditcard->nCreditCardId; ?>">Update</a></td>
                        </tr>
                    <?php }; ?>
                </table>
            </div>
    </section>

    <!-- ADD CREDIT CARD -->
    <section id="04">
        <h2 class="section-title">Add credit card</h2>
        <form id="frmCreateCreditCard" action="" method="POST">
            <p class="strong">Credit card info</p>
            <div class="input-pair">
                <label for="txtIBAN">IBAN</label>
                <input id="txtIBAN" type="text" name="txtIBAN">
            </div>
            <div class="input-pair">
                <label for="txtCCV">CCV</label>
                <input id="txtCCV" type="text" name="txtCCV">
            </div>
            <div class="input-pair">
                <label for="dExpiration">Expiration date xxxx-xx-xx</label>
                <input id="dExpiration" type="text" name="dExpiration">
            </div>
            <div class="input-pair">
                <label for="nUserId">User Id</label>
                <input id="nUserId" type="text" name="nUserId">
            </div>
            <button id="btnSubmitCreditCard" type="submit" name="btnSubmitCreditCard" onclick="createCreditCard(this)">Add</button>
        </form>
    </section>
    
    <!-- PAYMENTS -->
    <section id="05">
        <h2 class="section-title">Payments</h2>
        <form id="frmChargeSomeone" action="" method="">
            <p class="strong">Charge someone's credit card</p>
            <div class="input-pair">
                <label for="nAmount">Amount</label>
                <input id="nAmount" type="text" name="nAmount">
            </div>
            <div class="input-pair">
                <label for="nCreditCardId">Credit card id</label>
                <input id="nCreditCardId" type="text" name="nCreditCardId">
            </div>
            <button id="btnSubmitPayment" type="submit" name="btnSubmitPayment" onclick="submitPayment(this)">Charge</button>
        </form>
        <div id="paymentsList">
        <p class="strong">Payments</p>
        <?php
            // $pdo defined in components/header.php
            $sqlQuery = 'SELECT * FROM tpayment';
            $stmt = $pdo->prepare($sqlQuery);
            $stmt->execute();
            $payments = $stmt->fetchAll(); ?>
            <table>
                <tr>
                    <th>Date</th>
                    <th>Amount</th>
                    <th>Creditcard</th>
                </tr>
                <?php foreach($payments as $payment) { ?>
                    <tr>
                        <td><?=$payment->dTransaction;?></td>
                        <td><?=$payment->nAmount;?></td>
                        <td><?=$payment->nCreditCardId;?></td>
                    </tr>
                <?php } ?>
            </table>
        </div>
    </section>

    <!-- CATEGORIES -->
    <section id="06">
        <h2 class="section-title">Food item categories</h2>
        <div id="categoriesList">
        <?php
            // $pdo defined in components/header.php
            $sqlQuery = 'SELECT * FROM tcategory';
            $stmt = $pdo->prepare($sqlQuery);
            $stmt->execute();
            $categories = $stmt->fetchAll(); ?>
            <table>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                </tr>
                <?php foreach($categories as $category) { ?>
                    <tr>
                        <td><?=$category->nCategoryId;?></td>
                        <td><?=$category->cName;?></td>
                    </tr>
                <?php } ?>
            </table>
        </div>
    </section>

    <!-- MEASSUREMENTS -->
    <section id="07">
        <h2 class="section-title">Meassurements</h2>
        <div id="meassurementsList">
        <?php
            // $pdo defined in components/header.php
            $sqlQuery = 'SELECT * FROM tmeassurement';
            $stmt = $pdo->prepare($sqlQuery);
            $stmt->execute();
            $meassurements = $stmt->fetchAll(); ?>
            <table>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                </tr>
                <?php foreach($meassurements as $meassurement) { ?>
                    <tr>
                        <td><?=$meassurement->nMeassurementId;?></td>
                        <td><?=$meassurement->cName;?></td>
                    </tr>
                <?php } ?>
            </table>
        </div>
    </section>

    <!-- ADD FOOD ITEM -->
    <section id="08">
        <h2 class="section-title">Add food item</h2>
        <form id="frmCreateIngredient" action="" method="POST">
            <p class="strong">Food item info</p>
            <div class="input-pair">
                <label for="txtName">Name</label>
                <input id="txtName" type="text" name="txtName">
            </div>
            <div class="input-pair">
                <label for="nMeassurementId">Meassurement id</label>
                <input id="nMeassurementId" type="text" name="nMeassurementId">
            </div>
            <div class="input-pair">
                <label for="nCategoryId">Category id</label>
                <input id="nCategoryId" type="text" name="nCategoryId">
            </div>
            <button id="btnSubmitFoodItem" type="submit" name="btnSubmitFoodItem" onclick="createFoodItem(this)">Add</button>
        </form>
    </section>

    <!-- FOOD ITEMS LIST -->
    <section id="09">
        <h2 class="section-title">Food items</h2>
        <div id="fooditemsList">
            <?php
                // $pdo defined in components/header.php
                $sqlQuery = 'SELECT * FROM tfooditem';
                $stmt = $pdo->prepare($sqlQuery);
                $stmt->execute();
                $fooditems = $stmt->fetchAll(); ?>
                <table>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Category id</th>
                    </tr>
                    <?php foreach($fooditems as $fooditem) { ?>
                        <tr>
                            <td><?=$fooditem->nFoodItemId;?></td>
                            <td><?=$fooditem->cName;?></td>
                            <td><?=$fooditem->nCategoryId;?></td>
                            <td><a onclick="deleteFoodItem(this)" data-food-item-id="<?=$fooditem->nFoodItemId;?>" href="#">Delete</a></td>
                            <td><a href="update-food-item.php?id=<?= $fooditem->nFoodItemId; ?>">Update</a></td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
    </section>

    <!-- CREATE RECIPE -->
    <section id="10">
        <h2 class="section-title">Create recipe</h2>
        <form action="" method="POST" id="formCreateRecipe">
            <p class="strong">Recipe information</p>
            <div class="input-pair">
                <label for="txtTitle">Title</label>
                <input id="txtTitle" name="txtTitle" type="text">
            </div>
            <div class="input-pair">
                <label for="txtDescription">Description</label>
                <textarea rows="12" columns="4" id="txtDescription" name="txtDescription" type="text"></textarea>
            </div>
            <button id="btnCreateRecipe" type="submit" name="btnCreateRecipe" onclick="createRecipe(this)">Create</button>
        </form>
    </section>

    <!-- RECIPE LIST -->
    <section id="11">
        <h2 class="section-title">Recipes</h2>
            <table>
                <tr>
                    <th>Id</th>
                    <th>Title</th>
                    <th>Description</th>
                </tr>
                <?php 
                $sqlQuery = "SELECT * FROM trecipe";
                $stmt = $pdo->prepare($sqlQuery);
                $stmt->execute();
                $recipes = $stmt->fetchAll(); 
                foreach($recipes as $recipe) {?>
                    <tr>
                        <td><?=$recipe->nRecipeId;?></td>
                        <td><?=$recipe->cTitle;?></td>
                        <td><?=$recipe->cDescription;?></td>
                        <td><a href="single-recipe.php?id=<?=$recipe->nRecipeId;?>">Read full</a></td>
                    </tr>
                <?php } ?>
            </table>
    </section>

    <!-- ADD INGREDIENTS -->
    <section id="12">
        <h2 class="section-title">Add recipe ingredient</h2>
        <form id="frmAddRecipeIngredient" action="" method="POST">
            <div class="input-pair">
                <label for="nRecipeId">Recipe</label>
                <select name="nRecipeId" id="nRecipeId">
                    <?php 
                        $sql = "SELECT nRecipeId, cTitle FROM trecipe";
                        $stmt = $pdo->prepare($sql);
                        $stmt->execute();
                        $rows = $stmt->fetchAll();
                        foreach($rows as $row) { ?>
                        <option value="<?=$row->nRecipeId;?>"><?=$row->cTitle;?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="input-pair">
                <label for="nFoodItemId">Food item</label>
                <select name="nFoodItemId" id="nFoodItemId">
                    <?php 
                        $sql = "SELECT nFoodItemId, cName FROM tfooditem";
                        $stmt = $pdo->prepare($sql);
                        $stmt->execute();
                        $rows = $stmt->fetchAll();
                        foreach($rows as $row) { ?>
                        <option value="<?=$row->nFoodItemId;?>"><?=$row->cName;?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="input-pair">
                <label for="nMeassurementId">Meassurement</label>
                <select name="nMeassurementId" id="nMeassurementId">
                    <?php 
                        $sql = "SELECT nMeassurementId, cName FROM tmeassurement";
                        $stmt = $pdo->prepare($sql);
                        $stmt->execute();
                        $rows = $stmt->fetchAll();
                        foreach($rows as $row) { ?>
                        <option value="<?=$row->nMeassurementId;?>"><?=$row->cName;?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="input-pair">
                <label for="nIngredientAmount">Amount</label>
                <input id="nIngredientAmount" name="nIngredientAmount" type="text">
            </div>
            <button id="btnAddRecipeIngredient" type="submit" name="btnAddRecipeIngredient" onclick="addIngredientToRecipe(this)">Add ingredient</button>
        </form>
    </section>

    <!-- SEARCH RECIPES BY PANTRY ID -->
    <section id="13">
        <h2 class="section-title">Search recipes by pantry id</h2>
        <form action="" id="frmSearchRecipeByPantryId">
            <div class="input-pair">
                <label for="intPantryId">Pantry id</label>
                <input id="intPantryId" name="intPantryId" type="text">
            </div>
            <div id="btnSearchRecipesByPantryId" onclick="searchRecipesByPantryId(this)">Search</div>
        </form>
        <table id="recipesSearchResult">
            <tr>
                <th>Title</th>
                <th>Description</th>
            </tr>
        </table>
    </section>
</div>

<?php require_once('components/footer.php'); ?>



