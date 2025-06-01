<?php

require "con_db_l.php";
session_start();

// ---------------------------------------------------- page

$limit = 5;
$page = isset($_POST['page']) ? (int)$_POST['page'] : 1;
$offset = ($page - 1) * $limit;

$countQuery = "SELECT COUNT(*) AS total FROM Atsauksmes";
$countResult = $savienojums->query($countQuery);
$totalRows = $countResult->fetch_assoc()['total'];
$totalPages = ceil($totalRows / $limit);

// ---------------------------------------------------- Atsakmes

$atsaukmesSQL = "SELECT * FROM Atsauksmes ORDER BY datums DESC LIMIT ? OFFSET ?";
$atsakmes = $savienojums->prepare($atsaukmesSQL);
$atsakmes->bind_param("ii", $limit, $offset);
$atsakmes->execute();
$atsakmesResult = $atsakmes->get_result();

// ---------------------------------------------------- Izvade

$atsaukmesHTML = '';

while ($atsakmes = $atsakmesResult->fetch_assoc()) {

    // ---------------------------------------------------- Svaigžnu izvade

    $stars = $atsakmes['stars'];
    $button = '';
    $formModal = '';
    $starsHTML = '';
    for ($i = 1; $i <= 5; $i++) {
        $activeClass = $i <= $stars ? 'active' : '';
        $starsHTML .= "<i class='fas fa-star $activeClass'></i>";
    }

    // ---------------------------------------------------- Foto Decode

    $fotoUrl = 'data:image/jpeg;base64,' . base64_encode($atsakmes['avatar']);

    // ---------------------------------------------------- Dzest forma

    if (isset($_SESSION['IdHOMIK']) && $atsakmes['lietotaja_id'] === $_SESSION['IdHOMIK']) {
        $button = "<i class='fa fa-trash deletBtn' data-target='#deletmodal-{$atsakmes['atsakmes_id']}'></i>";
        $formModal = "
            <div class='deletmodal' id='deletmodal-{$atsakmes['atsakmes_id']}'> 
                <div class='delforma'>
                    <form class='atsakmeDelet'>
                        <p>Vai jūs tiešām gribat dzēst komentāru?</p>
                        <div class='del-buttons'>
                            <input type='hidden' value='{$atsakmes['atsakmes_id']}' id='atID'>
                            <button id='yes'>Jā</button>
                            <button type='button' id='no'>Nē</button>
                        </div>
                    </form>
                </div>
            </div>";

    // ---------------------------------------------------- Report forma

    } elseif (isset($_SESSION['IdHOMIK'])) {
        $button = "<i class='fa fa-ban rep reportbtn' data-target='#repmodal-{$atsakmes['atsakmes_id']}'></i>";
        $formModal = "
            <div class='repmodal' id='repmodal-{$atsakmes['atsakmes_id']}'> 
                <div class='repForm'>
                    <i class='fas fa-close close-Modal' id='closeRep'></i>
                    <div class='repText'>
                        <h1>Ziņot par komentāru</h1>
                    </div>
                    <form class='reportForm'>
                        <div class='selectRep'>
                            <label>Pārkāpuma kategorija</label>
                            <select id='rep_title'>
                                <option value='' hidden>Pēc kategorijām</option>
                                <option value='Spam'>Spam</option>
                                <option value='Nepiedienīgs saturs'>Nepiedienīgs saturs</option>
                                <option value='Naida runa'>Naida runa</option>
                                <option value='Dezinformācija'>Dezinformācija</option>
                                <option value='Personas datu pārkāpums'>Personas datu pārkāpums</option>
                                <option value='Cits iemesls'>Cits iemesls</option>
                            </select>
                        </div>
                        <div class='repTextarea'>
                            <label>Apraksts</label>
                            <textarea id='rep_text'></textarea>
                            <input id='atsakmes_id' type='hidden' value='{$atsakmes['atsakmes_id']}'>
                        </div>
                        <button class='repbtn' type='submit'><i class='fas fa-paper-plane'></i>Iesniegt</button>
                    </form>
                </div>
            </div>";
    }

    // ---------------------------------------------------- Report forma

    $datums = date('Y-m-d', strtotime($atsakmes['datums']));

    $atsaukmesHTML .= "
        <div class='box'>
            <div class='at-info'>
                <div class='av-name-st'>
                    <div class='avatarAt'>
                        <img src='$fotoUrl'>
                    </div>
                    <div class='name-star'>
                        <div class='name-form'>
                            <h1>{$atsakmes['vards']} {$atsakmes['uzvards']}</h1>
                            $button
                        </div>
                        <div class='stars-at'>
                            $starsHTML
                        </div>
                    </div>
                </div>
                <div class='time'>
                    <p>$datums</p>
                </div>
            </div>
            <div class='at-text'><p>{$atsakmes['at_text']}</p></div>
            $formModal
        </div>";
}

echo json_encode([
    'comments' => $atsaukmesHTML,
    'totalPages' => $totalPages
]);
?>