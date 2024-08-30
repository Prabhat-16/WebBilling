<?php
    include_once('../connection.php');

    $response = array();

    if(isset($_POST['edit']))
    {
        if(isset($_POST['id']))
        {
            $fetchSql = "CALL fetchParty('".$_POST['id']."')";
            $result = mysqli_query($con,$fetchSql);
            while($row = mysqli_fetch_array($result))
            {
                $response["party_id"] = $row["party_id"];
                $response["party_name"] = $row["party_name"];
                $response["party_type"] = $row["party_type"];
                $response["contact_no"] = $row["contact_no"];
                $response["email"] = $row["email"];
                $response["op_balance"] = $row["op_balance"];
                $response["address"] = $row["address"];
                $response["discount"] = $row["discount"];
                $response["state_id"] = $row["state_id"];
                $response["gstin"] = $row["gstin"];
                $response["penalty"] = $row["penalty"];
                $response["credit_period"] = $row["credit_period"];
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