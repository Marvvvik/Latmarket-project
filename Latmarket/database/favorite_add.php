<?php
require "con_db_l.php";

session_start();

$response = [];

// ---------------------------------------------------- Dati

$liet_id = $_SESSION['IdHOMIK'];
$tb_name = htmlspecialchars($_POST['tb_name']);
$item_id = htmlspecialchars($_POST['item_id']);

// ---------------------------------------------------- Parabde

if (!empty($liet_id) && !empty($tb_name) && !empty($item_id)) {

    $vaicajums = $savienojums->prepare("SELECT * FROM favoriti WHERE lietotaja_id = ? AND table_name = ? AND item_id = ?");
    $vaicajums->bind_param("isi", $liet_id, $tb_name, $item_id);
    $vaicajums->execute();
    $result = $vaicajums->get_result();

    if ($result->num_rows > 0) {

        $delete_query = $savienojums->prepare("DELETE FROM favoriti WHERE lietotaja_id = ? AND table_name = ? AND item_id = ?");
        $delete_query->bind_param("isi", $liet_id, $tb_name, $item_id);

        if ($delete_query->execute()) {
            $response['success'] = true;
            $response['message'] = "Sludinājums izņemts no favorītiem!";
            $response['star_icon'] = 'far fa-star fav'; 
        } else {
            $response['success'] = false;
            $response['error'] = "Kļūda izņemšanā no favorītiem.";
        }
    } else {

        $insert_query = $savienojums->prepare("INSERT INTO favoriti (lietotaja_id, table_name, item_id) VALUES (?, ?, ?)");
        $insert_query->bind_param("isi", $liet_id, $tb_name, $item_id);

        if ($insert_query->execute()) {
            $response['success'] = true;
            $response['message'] = "Sludinājums saglabāt favorītos!";
            $response['star_icon'] = 'fa fa-star fav'; 
        } else {
            $response['success'] = false;
            $response['error'] = "Sistēmas kļūda.";
        }
    }
} else {
    $response['success'] = false;
    $response['error'] = "Sistēmas kļūda.";
}

$savienojums->close();
echo json_encode($response);
exit;
?>
