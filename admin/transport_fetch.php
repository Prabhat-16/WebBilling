<?php
    include_once('../connection.php');

    $response = array();

    if(isset($_POST['edit']))
    {
        if(isset($_POST['id']))
        {
            $fetchSql = "CALL fetchTransport('".$_POST['id']."')";
            $result = mysqli_query($con,$fetchSql);
            while($row = mysqli_fetch_array($result))
            {
                $response["transport_id"] = $row["transport_id"];
                $response["vehicle_name"] = $row["vehicle_name"];
                $response["vehicle_no"] = $row["vehicle_no"];
                $response["is_active"] = $row["is_active"];
                
            }
        }
    }
    else
    {
        $response["Fail"] = 1;
    }
    echo json_encode($response);
?>