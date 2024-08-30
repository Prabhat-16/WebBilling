<?php
    include_once('../connection.php');

    $response = array();

    if(isset($_POST['edit']))
    {
        if(isset($_POST['id']))
        {
            $fetchSql = "CALL fetchDriver('".$_POST['id']."')";
            $result = mysqli_query($con,$fetchSql);
            while($row = mysqli_fetch_array($result))
            {
                $response["driver_id"] = $row["driver_id"];
                $response["driver_name"] = $row["driver_name"];
                $response["email"] = $row["email"];
                $response["mobile"] = $row["mobile"];
                $response["is_active"] = $row["is_active"];
                $response["created_by"] = $row["created_by"];
                $response["added_date"] = $row["added_date"];
                
            }
        }
    }
    else
    {
        $response["Fail"] = 1;
    }
    echo json_encode($response);
?>