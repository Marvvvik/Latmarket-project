<?php

require "../con_db_transports.php";

$marka = isset($_POST['marka']) ? $_POST['marka'] : null;

if ($marka) {
   
    $stmt = $savienojums->prepare("SELECT * FROM Cars WHERE marka = ?");
    $stmt->bind_param("s", $marka);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $model = [];
    while ($modelis = $result->fetch_assoc()) {
        $model[] = array('modelis' => $modelis['Modelis']);
    }

    echo json_encode($model);
} else {
    echo json_encode([]);
}


?>