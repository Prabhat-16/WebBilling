<?php
    include_once('../connection.php');

    $response = array();

    if(isset($_POST['edit']))
    {
        if(isset($_POST['id']))
        {
            $fetchSql = "CALL fetchUser('".$_POST['id']."')";
            $result = mysqli_query($con,$fetchSql);
            while($row = mysqli_fetch_array($result))
            {
                $response["user_id"] = $row["user_id"];
                $response["full_name"] = $row["full_name"];
                $response["email"] = $row["email"];
                $response["phone"] = $row["phone"];
                $response["username"] = $row["username"];
                $response["password"] = $row["password"];
                $response["is_active"] = $row["is_active"];
                $response["user_profile"] = $row["user_profile"];
            }
        }
    }
    else
    {
        $response["Fail"] = 1;
    }
    echo json_encode($response);
?>