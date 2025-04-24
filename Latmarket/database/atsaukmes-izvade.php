<?php

require "con_db_l.php";
session_start();


$atsaukmesSQL = "SELECT * FROM Atsauksmes ORDER BY datums DESC";
$stmt = $savienojums->prepare($atsaukmesSQL);
$stmt->execute();
$atsakmesResult = $stmt->get_result();

while ($atsakmes = $atsakmesResult->fetch_assoc()) {

    $stars = $atsakmes['stars'];
    $button = null;
    $formModal = null;

    $starsHTML = '';
    for ($i = 1; $i <= 5; $i++) {
        $activeClass = $i <= $stars ? 'active' : '';
        $starsHTML .= "<i class='fas fa-star $activeClass'></i>";
    }

    $fotoUrl = 'data:image/jpeg;base64,' . base64_encode($atsakmes['avatar']); ;

    if($atsakmes['lietotaja_id'] === $_SESSION['IdHOMIK'] ){

        $button = "<i class='fa fa-trash' data-target='#deletmodal'></i>";

        $formModal = "<div class='deletmodal' id='deletmodal'> 
                        <div class='delforma'>

                            <form id='atsakmeDelet'>

                                <p>Vai jūs tiešām gribat dzēst komentāru?</p>

                                <div class='del-buttons'>

                                    <input type='hidden' value='{$atsakmes['atsakmes_id']}' id='atID'>

                                    <button id='yes'>Jā</button>

                                    <button type='button' id='no'>Nē</button>

                                </div>

                            </form>

                        </div>
                    </div>";

    }

    $datums = date('Y-m-d', strtotime($atsakmes['datums']));

    echo "
    
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

?>
