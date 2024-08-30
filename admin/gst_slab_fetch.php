<?php
    include_once('../connection.php');

    $response = array();

    if(isset($_POST['edit']))
    {
        if(isset($_POST['id']))
        {
            $fetchSql = "CALL fetchGst('".$_POST['id']."')";
            $result = mysqli_query($con,$fetchSql);
            while($row = mysqli_fetch_array($result))
            {
                $response["gst_slab_id"] = $row["gst_slab_id"];
                $response["gst_slab_name"] = $row["gst_slab_name"];
                $response["cgst"] = $row["cgst"];
                $response["sgst"] = $row["sgst"];
                $response["igst"] = $row["igst"];
                
            }
        }
    }
    else
    {
        $response["Fail"] = 1;
    }
    echo json_encode($response);
?>