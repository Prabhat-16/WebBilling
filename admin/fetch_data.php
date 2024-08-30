<?php
    include_once('../connection.php');

    $sql_view = "CALL viewCashMemo";
$rs_view = mysqli_query($con, $sql_view);

if (!$rs_view) {
    die(json_encode(['error' => 'View Not Found.', 'details' => mysqli_error($con)]));
}

$data = array();
while ($row_view = mysqli_fetch_assoc($rs_view)) {
    $data[] = $row_view;
}

echo json_encode($data);
?>