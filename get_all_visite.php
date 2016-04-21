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
if (isset($_GET['ID_INSPECTEUR'])) {
    $ID_INSPECTEUR = $_GET['ID_INSPECTEUR'];}
$con = $db->connect();
if (isset($ID_INSPECTEUR)){
	$result = $con->query("SELECT * FROM visiter where ID_INSPECTEUR = $ID_INSPECTEUR");
	} else { 
	$result = $con->query("SELECT * FROM visiter");
	}
$row_cnt = $result->num_rows;
  
// check for empty result
if ($row_cnt > 0) {
    
    // looping through all results
    // products node
    $response["visite"] = array();
    
     while ($row = mysqli_fetch_array($result)) {
        // temp user array
        $product = array();
        $product["ID_HEBERGEMENT"] = $row["ID_HEBERGEMENT"];
        $product["ID_INSPECTEUR"] = $row["ID_INSPECTEUR"];
        $product["ID_SAISON"] = $row["ID_SAISON"];
        $product["NOMBRE_ETOILE_VISITE"] = $row["NOMBRE_ETOILE_VISITE"];
	$product["DATE_HEURE_VISITE"] = $row["DATE_HEURE_VISITE"];
        $product["CONTRE_VISITE"] = $row["CONTRE_VISITE"];
        $product["COMMENTAIRE_VISITE"] = $row["COMMENTAIRE_VISITE"];
 
        // push single product into final response array
        array_push($response["visite"], $product);
    }
    
     // success
    $response["success"] = 1;
 
    // echoing JSON response
    echo json_encode($response);
} else {
        // no products found
    $response["success"] = 0;
    $response["message"] = "pas de visite trouvés";
 
    // echo no users JSON
    echo json_encode($response);
}
?>
