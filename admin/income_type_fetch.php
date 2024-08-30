<?php
    include_once('../connection.php');

    $response = array();

    if(isset($_POST['edit']))
    {
        if(isset($_POST['id']))
        {
            $fetchSql = "CALL fetchIncomeType('".$_POST['id']."')";
            $result = mysqli_query($con,$fetchSql);
            while($row = mysqli_fetch_array($result))
            {
                $response["income_type_id"] = $row["income_type_id"];
                $response["income_type"] = $row["income_type"];
                
            }
        }
    }
    else
    {
        $response["Fail"] = 1;
    }
    echo json_encode($response);
?>