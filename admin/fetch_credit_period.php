<?php
   include_once('../connection.php');

// Check if party_id is set and valid
if(isset($_POST['party_id'])) {
    $party_id = $_POST['party_id'];

    // Fetch credit period from the database
    $query = "SELECT credit_period FROM tbl_party WHERE party_id = ?";
    $statement = $con->prepare($query);
    $statement->bind_param("i", $party_id);
    $statement->execute();
    $result = $statement->get_result();

    // Check if query executed successfully
    if($result) 
    {
        $row = $result->fetch_assoc();
        $credit_period = $row['credit_period'];

        // Return credit period as JSON response
        echo json_encode(array("status" => "success", "credit_period" => $credit_period));
    } 
        else 
    {
        // Handle database query error
        echo json_encode(array("status" => "error", "message" => "Error fetching credit period"));
    }
} else {
    // Handle invalid or missing party_id parameter
    echo json_encode(array("status" => "error", "message" => "Invalid party ID"));
}


?>