<?php

require "con_db_l.php";
session_start();

$limit = 5;
$page = isset($_POST['page']) ? (int)$_POST['page'] : 1;
$offset = ($page - 1) * $limit;

$countQuery = "SELECT COUNT(*) AS total FROM Atsauksmes";
$countResult = $savienojums->query($countQuery);
$totalRows = $countResult->fetch_assoc()['total'];
$totalPages = ceil($totalRows / $limit);

$atsaukmesSQL = "SELECT * FROM Atsauksmes ORDER BY datums DESC LIMIT ? OFFSET ?";
$atsakme = $savienojums->prepare($atsaukmesSQL);
$atsakme->bind_param("ii", $limit, $offset);
$atsakme->execute();
$atsakmesResult = $atsakme->get_result();

$atsaukmesHTML = '';

while ($atsaukmes = $atsakmesResult->fetch_assoc()) {
    $stars = $atsaukmes['stars'];

    $starsHTML = '';
    for ($i = 1; $i <= 5; $i++) {
        $activeClass = $i <= $stars ? 'active' : '';
        $starsHTML .= "<i class='fas fa-star $activeClass'></i>";
    }

    $fotoUrl = 'data:image/jpeg;base64,' . base64_encode($atsaukmes['avatar']);

    $datums = date('Y-m-d', strtotime($atsaukmes['datums']));

    $atsaukmesHTML .= "
        <div class='box'>
            <div class='at-info'>
                <div class='av-name-st'>
                    <div class='avatarAt'>
                        <img src='$fotoUrl'>
                    </div>
                    <div class='name-star'>
                        <div class='name-form'>
                            <h1>{$atsaukmes['vards']} {$atsaukmes['uzvards']}</h1>
                        </div>
                        <div class='stars-at'>
                            $starsHTML
                        </div>
                    </div>
                </div>
                <div class='edit-buttons'>
                    <i class='fa fa-edit' id='edit'></i>
                    <i class='fa fa-ban rep' id='hidde'></i>
                    <i class='fa fa-trash' id='delet'></i>
                </div>
            </div>
            <div class='at-text'><p>{$atsaukmes['at_text']}</p></div>
            <div class='extraInfo'>

                <p>ID: {$atsaukmes['atsakmes_id']}</p>

                <p>Profila ID: {$atsaukmes['lietotaja_id']}</p>

                <p>Datums: $datums</p>

            </div>
        </div>";
}

echo json_encode([
    'comments' => $atsaukmesHTML,
    'totalPages' => $totalPages
]);
?>