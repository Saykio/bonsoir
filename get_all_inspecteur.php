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
 
// connecting to db
$db = new DB_CONNECT();
 
// get all products from products table
$con = $db->connect();
$result = $con->query("SELECT * FROM inspecteur");
$row_cnt = $result->num_rows;
  
// check for empty result
if ($row_cnt > 0) {
    
    // looping through all results
    // products node
    $response["inspecteur"] = array();
    
     while ($row = mysqli_fetch_array($result)) {
        // temp user array
        $product = array();
        $product["ID_INSPECTEUR"] = $row["ID_INSPECTEUR"];
        $product["ID_SPECIALITE"] = $row["ID_SPECIALITE"];
        $product["NOM_INSPECTEUR"] = $row["NOM_INSPECTEUR"];
        $product["PRENOM_INSPECTEUR"] = $row["PRENOM_INSPECTEUR"];
        $product["LOGIN"] = $row["LOGIN"];
        $product["MDP"] = $row["MDP"];

 
        // push single product into final response array
        array_push($response["inspecteur"], $product);
    }
    
     // success
    $response["success"] = 1;
 
    // echoing JSON response
    echo json_encode($response);
} else {
        // no products found
    $response["success"] = 0;
    $response["message"] = "pas d'inspecteur trouvés";
 
    // echo no users JSON
    echo json_encode($response);
}
?>
