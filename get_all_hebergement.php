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
$result = $con->query("SELECT * FROM hebergement");
$row_cnt = $result->num_rows;
  
// check for empty result
if ($row_cnt > 0) {
    
    // looping through all results
    // products node
    $response["hebergement"] = array();
    
     while ($row = mysqli_fetch_array($result)) {
        // temp user array
        $product = array();
        $product["ID_HEBERGEMENT"] = $row["ID_HEBERGEMENT"];
        $product["ID_DEPARTEMENT"] = $row["ID_DEPARTEMENT"];
        $product["NOM_HEBERGEMENT"] = $row["NOM_HEBERGEMENT"];
        $product["ADRESSE_HEBERGEMENT"] = $row["ADRESSE_HEBERGEMENT"];
        $product["VILLE_HEBERGEMENT"] = $row["VILLE_HEBERGEMENT"];
        $product["HORAIRES"] = $row["HORAIRES"];
        // push single product into final response array
        array_push($response["hebergement"], $product);
    }
    
     // success
    $response["success"] = 1;
 
    // echoing JSON response
    echo json_encode($response);
} else {
        // no products found
    $response["success"] = 0;
    $response["message"] = "pas d'hebergement trouvés";
 
    // echo no users JSON
    echo json_encode($response);
}
?>
