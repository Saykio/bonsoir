<?php
 header('Content-Type: application/json');
 // Status : On Dev
 
/*
 * Following code will list all the products
 */
 
// array for JSON response
$response = array();
 
// include db connect class
require_once __DIR__ . '/db_connect.php';
 
// connecting to dbNOMBRE_ETOILE_VISITE
$db = new DB_CONNECT();
 
// get all products from products table
if (isset($_GET['ID_HEBERGEMENT']) && isset($_GET['']) && isset($_GET['CONTRE_VISITE']) && isset($_GET['COMMENTAIRE_VISITE'])) {
    $ID_HEBERGEMENT = $_GET['ID_HEBERGEMENT'];
    $NOMBRE_ETOILE_VISITE = $_GET['NOMBRE_ETOILE_VISITE'];
    $CONTRE_VISITE = $_GET['CONTRE_VISITE'];
    $COMMENTAIRE_VISITE = $_GET['COMMENTAIRE_VISITE'];
 $con = $db->connect();
    
    // mysql inserting a new row
    $result = $con->query("Udpate visiter set NOMBRE_ETOILE_VISITE ='$NOMBRE_ETOILE_VISITE' , CONTRE_VISITE = '$CONTRE_VISITE' , COMMENTAIRE_VISITE = '$COMMENTAIRE_VISITE' where ID_HEBERGEMENT = '$ID_HEBERGEMENT'");
 
    // check if row inserted or not
    if ($result) {
        // successfully inserted into database
        $response["success"] = 1;
        $response["message"] = "Visite successfully modified.";
 
        // echoing JSON response
        echo json_encode($response);
    } else {
        // failed to insert row
        $response["success"] = 0;
        $response["message"] = "Oops! An error occurred.";
        $response["error"] = $con -> error;
 
        // echoing JSON response
        echo json_encode($response);
    }
} else { 
    // required field is missing
    $response["success"] = 0;
    $response["message"] = "Required field(s) is missing";
 
    // echoing JSON response
    echo json_encode($response);
    
}
?>