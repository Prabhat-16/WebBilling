<?php
include_once('../connection.php');

if(isset($_POST['item_id'])) 
{
    $item_id = mysqli_real_escape_string($con, $_POST['item_id']);

    $sql = "SELECT i.amount, i.gst_slab_id, gs.igst 
            FROM tbl_item i
            JOIN tbl_gst_slab gs ON i.gst_slab_id = gs.gst_slab_id
            WHERE i.item_id = $item_id";
    
    $result = mysqli_query($con, $sql);
    
    if($result) 
    {
       
        if(mysqli_num_rows($result) > 0) 
        {
            
            $row = mysqli_fetch_assoc($result);
            $rate = $row['amount'];
            $gst_slab_id = $row['gst_slab_id'];
            $igst = $row['igst'];
            
           
            echo json_encode(array('rate' => $rate, 'igst' => $igst));
        } else {
           
            echo json_encode(array('error' => 'Rate not found'));
        }
    } else {
      
        echo json_encode(array('error' => 'Error: ' . mysqli_error($con)));
    }
} else {
   
    echo json_encode(array('error' => 'Item ID not provided'));
}

// Close database connection
mysqli_close($con);
?>
