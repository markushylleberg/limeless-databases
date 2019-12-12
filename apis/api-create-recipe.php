<?php
/**
 * ****************************************
 * API
 * Insert recipe into database
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
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'myvirtualpantry';
$dsn = "mysql:host=$host;dbname=$db";
$options = [
    PDO::ATTR_ERRMODE               => PDO::ERRMODE_EXCEPTION,
];

/**
 * PDO
 * Catch potential error messages
 */
try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

// Set variables
$cTitle                         = $_POST['txtTitle'];
$cDescription                   = $_POST['txtDescription'];

$nRecipeIngredient1             = $_POST['selRecipeIngredient1']; 
$nRecipeIngredientMeassurement1 = $_POST['selRecipeIngredientMeassurement1']; 
$nRecipeIngredientAmount1       = $_POST['intRecipeIngredientAmount1'];

$nRecipeIngredient2             = $_POST['selRecipeIngredient2']; 
$nRecipeIngredientMeassurement2 = $_POST['selRecipeIngredientMeassurement2']; 
$nRecipeIngredientAmount2       = $_POST['intRecipeIngredientAmount2'];

$nRecipeIngredient3             = $_POST['selRecipeIngredient3']; 
$nRecipeIngredientMeassurement3 = $_POST['selRecipeIngredientMeassurement3']; 
$nRecipeIngredientAmount3       = $_POST['intRecipeIngredientAmount3'];

$nRecipeIngredient4             = $_POST['selRecipeIngredient4']; 
$nRecipeIngredientMeassurement4 = $_POST['selRecipeIngredientMeassurement4']; 
$nRecipeIngredientAmount4       = $_POST['intRecipeIngredientAmount4'];

$aIngredientList = '{
    {
        "0" => {
            "ingredient" = $nRecipeIngredient1,
            "meassurement" = $nRecipeIngredientMeassurement1,
            "amount" = $nRecipeIngredientAmount1,
        }
    },
    {
        "1" => {
            "ingredient" = $nRecipeIngredient1,
            "meassurement" = $nRecipeIngredientMeassurement1,
            "amount" = $nRecipeIngredientAmount1,
        }
    },
    {
        "2" => {
            "ingredient" = $nRecipeIngredient1,
            "meassurement" = $nRecipeIngredientMeassurement1,
            "amount" = $nRecipeIngredientAmount1,
        }
    },
    {
        "3 => {
            "ingredient" = $nRecipeIngredient1,
            "meassurement" = $nRecipeIngredientMeassurement1,
            "amount" = $nRecipeIngredientAmount1,
        }
        }
}';




/**
 * SQL query 
 * Insert recipe into db
 */
$sql = "INSERT INTO trecipe (cTitle, cDescription)
        VALUES(:cTitle, :cDescription)";
$stmt = $pdo->prepare($sql);
$stmt->execute([
    'cTitle'         => $cTitle,
    'cDescription'   => $cDescription,
    ]);
    
    
/**
 * SQL query 
 * Insert recipe ingredients into db
 * */
$nRecipeId = $pdo->lastInsertId();
echo count($aIngredientList);
//  $nRecipeId = $pdo->lastInsertId();
//  for($i=0; $i<$aIngredientList.length(); $i++) {
//      echo $i;
//      echo $aIngredientList->$i->ingredient;
//  }
// for($i=0; $i<sizeof($aIngredientList); $i++) {
//     //  echo $ingredientitem;
//      $sql = "INSERT INTO trecipeingredient (nRecipeId, nFoodItemId, nAmount, nMeassurementId)
//             VALUES(:nRecipeId, :nFoodItemId, :nAmount, :nMeassurementId)";
//             $stmt = $pdo->prepare($sql);
//             $stmt->execute([
//                 'nRecipeId'         => $nRecipeId,
//                 'nFoodItemId'       => $ingredientitem[$i],
//                 'nAmount'           => $ingredientitem[$i],
//                 'nMeassurementId'   => $ingredientitem[$i]
//                 ]);

// }
 

$pdo = null;
echo '{"status:1, "message":"Success", "line":"'.__LINE__.'"}';
//******************** FUNCTIONS ********************/
function sendErrorMessage($sMessage, $iLine) {
    echo '{"status:0, "message":"'.$sMessage.'", "line":"'.$iLine.'"}';
    exit;
}