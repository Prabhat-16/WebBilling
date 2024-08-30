<?php
include_once('../connection.php');

if (isset($_POST['party_group'])) {
    $party_type = $_POST['party_group'];
    $sql = "SELECT party_id, party_name FROM tbl_party WHERE party_type = ?";
    
    $stmt = $con->prepare($sql);
    
    if ($stmt) {
        $stmt->bind_param("s", $party_type);
        
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            $party_data = array();

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $party_data[] = array(
                        'party_id' => $row['party_id'],
                        'party_name' => $row['party_name']
                    );
                }
                echo json_encode($party_data);
            } else {
                echo json_encode(['error' => 'No party names found']);
            }
        } else {
            echo json_encode(['error' => 'Error executing SQL statement']);
        }
    } else {
        echo json_encode(['error' => 'Statement preparation failed']);
    }
} else {
    echo json_encode(['error' => 'Party group not set']);
}
?>
