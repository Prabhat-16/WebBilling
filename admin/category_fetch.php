<?php
    include_once('../connection.php');

    $response = array();

    if(isset($_POST['edit']))
    {
        if(isset($_POST['id']))
        {
            $sqlfetch = "CALL fetchCategory('".$_POST['id']."')";
            $result = mysqli_query($con,$sqlfetch);
            while($row = mysqli_fetch_array($result))
            {
                $response["category_id "] = $row["category_id"];
                $response["category_code"] = $row["category_code"];
                $response["category_name"] = $row["category_name"];
                $response["is_active"] = $row["is_active"];
            }
        }
    }
    else
    {
        $response["fail"]=1;
    }
    echo json_encode($response);
?>