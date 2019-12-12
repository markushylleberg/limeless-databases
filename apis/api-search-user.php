<?php

    /**
     * Username to search via $_GET
     * Along with date registred passed via $_GET
     */
    $userName = $_GET['name'];
    $firstUserRegDate = $_GET['firstdate'];
    $secondUserRegDate = $_GET['seconddate'];

    // echo $userRegDate;

    /**
     * Exit if empty somehow
     */
    if( $userName == '' && $firstUserRegDate == '' && $secondUserRegDate == '' ) {
        echo '[]';
        exit;
        // sendErrorMessage('Nothing sent', __LINE__);
    }

/**
 * Database connection
 * Change $host and $root if needed
 */
$host   = 'localhost';
$user   = 'root';
$pass   = '';
$db     = 'myvirtualpantry';
$dsn    = "mysql:host=$host;dbname=$db";
$options = [
    PDO::ATTR_ERRMODE               => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE    => PDO::FETCH_ASSOC
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


/**
 * SQL query 
 */

if ( $firstUserRegDate == '' && $secondUserRegDate == '' ){
    $sql = "SELECT cName, cSurname, cEmail, cAddress, cPhoneNo, dRegistration FROM tuser WHERE cName LIKE CONCAT('%', :userName, '%')";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'userName'      => $userName,
        ]);
} else if ( $userName == '' ){

    $sql = "SELECT cName, cSurname, cEmail, cAddress, cPhoneNo, dRegistration FROM tuser WHERE dRegistration BETWEEN :firstUserRegDate AND :secondUserRegDate";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'firstUserRegDate'   => $firstUserRegDate,
        'secondUserRegDate'   => $secondUserRegDate
        ]);
} else {
    $sql = "SELECT cName, cSurname, cEmail, cAddress, cPhoneNo, dRegistration FROM tuser WHERE cName LIKE CONCAT('%', :userName, '%') AND dRegistration BETWEEN :firstUserRegDate AND :secondUserRegDate";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'userName'      => $userName,
        'firstUserRegDate'   => $firstUserRegDate,
        'secondUserRegDate'   => $secondUserRegDate
        ]);
}


echo json_encode($stmt->fetchAll());


$pdo = null;
// echo '{"status:1, "message":"Success", "line":"'.__LINE__.'"}';
/**
 * ****************************************
 * FUNCTIONS
 * ****************************************
 */

    // function sendErrorMessage($sMessage, $iLine) {
    //     echo '{"status:0, "message":"'.$sMessage.'", "line":"'.$iLine.'"}';
    //     exit;
    // }