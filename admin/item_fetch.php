<?php
    include_once('../connection.php');

    $response = array();

    if(isset($_POST['edit']))
    {
        if(isset($_POST['id']))
        {
            $fetchSql = "CALL fetchItem('".$_POST['id']."')";
            $result = mysqli_query($con,$fetchSql);
            while($row = mysqli_fetch_array($result))
            {
                $response["item_id"] = $row["item_id"];
                $response["item_name"] = $row["item_name"];
                $response["quality_id"] = $row["quality_id"];
                $response["category_id"] = $row["category_id"];
                $response["size_id"] = $row["size_id"];
                $response["gsm_id"] = $row["gsm_id"];
                $response["gst_slab_id"] = $row["gst_slab_id"];
                $response["quantity"] = $row["quantity"];
                $response["amount"] = $row["amount"];
                $response["op_stock"] = $row["op_stock"];
                $response["is_active"] = $row["is_active"];
                $response["item_photo"] = $row["item_photo"];
            }
        }
    }
    else
    {
        $response["Fail"] = 1;
    }
    echo json_encode($response);
?>