<?php 

session_start();

?>

<header>

    <div class="logo">

        <a href="/"><i class="fas fa-tag"></i>Latmarket</a>

    </div>


    <div class="navmenu">

        <a href="/#search" class="btna"><i class="fas fa-search"></i>Meklēt</a>

        <a href="/#search" class="btna"><i class="fas fa-newspaper"></i>Jaunumi</a>

        <a href="/atsaukmes.php" class="btna"><i class="far fa-comment"></i>Atsaukmes</a>

        <?php if(!isset($_SESSION['lietotajvardsHOMIK'])){ ?>

        <button id="OpenLogReg"><i class="fas fa-user"></i>Autorizeties</button>

        <?php 
        
        } 
        
        if(isset($_SESSION['lietotajvardsHOMIK'])){

        ?>

        <div class="profset">

            <div class="proimage" data-target="#profmenu">

                <img src="<?php echo $_SESSION['avatarHOMIK']; ?>" alt="">

            </div>

            <div class="profmenu" id="profmenu">

                <button id="iestbtn"><i class="fas fa-cog" id="spin"></i>Iestatijumi</button>

                <button id="favbtn"><i class="fas fa-star" id="spin"></i>Favoriti</button>

                <button id="sludbtn"><i class="fas fa-money-bill-wave" id="rotate-spin"></i>Sludinajumi</button>

                <button id="sarbtn"><i class="fa-solid fa-message" id="rotate-spin"></i>Saraksti</button>

                <a href="/database/logout.php" id="logout"><i class="fa fa-sign-out"></i>Iziet</a>

            </div>
        </div>

        <?php
        
        }

        ?>

    </div>

</header>


<div class="logmodal">

    <div class="log-reg">

        <i class="fas fa-close close-ml"></i>

        <div class="reg-log-btn">

            <button class="active" id="logBtn">Autorizeties</button>

            <button id="regBtn">Reģistreties</button>

        </div>

        <div class="login-form active">

            <form action="/database/login.php" method="POST">

                <div class='logmes'>
                    <?php
                        if(isset($_SESSION['log_paz'])){
                            echo $_SESSION['log_paz'];
                            unset($_SESSION['log_paz']);
                        }   
                    ?>
                </div>

                <div class="fomrtext">
                    
                    <h1>Laipni lūgti atpakaļ!</h1>

                </div>

                <div class="form-control">

                    <input type="text" name="lietotajvards" id="lusername"required>

                    <label>

                        <span style="transition-delay:0ms">U</span><span style="transition-delay:50ms">s</span><span style="transition-delay:100ms">e</span><span style="transition-delay:150ms">r</span><span style="transition-delay:200ms">n</span><span style="transition-delay:250ms">a</span><span style="transition-delay:300ms">m</span><span style="transition-delay:350ms">e</span>
                    
                    </label>

                </div>

                <div class="form-control">

                    <input type="password" name="parole" id="lpassword"required>

                    <label>

                        <span style="transition-delay:0ms">P</span><span style="transition-delay:50ms">a</span><span style="transition-delay:100ms">s</span><span style="transition-delay:150ms">s</span><span style="transition-delay:200ms">w</span><span style="transition-delay:250ms">o</span><span style="transition-delay:300ms">r</span><span style="transition-delay:350ms">d</span>
                    
                    </label>

                    <div class="resPass">

                        <a href="">Aizmirsi paroli?</a>

                    </div>

                    <div class="lookpassL">

                        <img src="image/icons/view.png">

                    </div>

                </div>

                <button class="btnlog" type="submit" name="ielogoties" id="loginbtn" disabled>Autorizeties</button>

            </form>

        </div>

        <div class="reg-form">

            <form id="registerForm">

                <div class="fomrtext">
                    
                    <h1>Izveidot Profilu!</h1>
                    
                </div>

                <div class="form-control">

                    <input type="text" id="username" required>

                    <label>

                        <span style="transition-delay:0ms">U</span><span style="transition-delay:50ms">s</span><span style="transition-delay:100ms">e</span><span style="transition-delay:150ms">r</span><span style="transition-delay:200ms">n</span><span style="transition-delay:250ms">a</span><span style="transition-delay:300ms">m</span><span style="transition-delay:350ms">e</span>
                    
                    </label>

                </div>

                <div class="form-control" id="form-control—pass1">

                    <input type="password" id="rpassword1" required maxlength="20">

                    <label id="pas1lab">

                        <span style="transition-delay:0ms">P</span><span style="transition-delay:50ms">a</span><span style="transition-delay:100ms">s</span><span style="transition-delay:150ms">s</span><span style="transition-delay:200ms">w</span><span style="transition-delay:250ms">o</span><span style="transition-delay:300ms">r</span><span style="transition-delay:350ms">d</span>
                    
                    </label>

                    <div class="configpass">

                        <p id="lBurts">Lielais burts*</p>
                        <p id="mBurts">Mazais burts*</p>
                        <p id='sSimbols'>Specialai slimbols</p>
                        <p id="cipars">Vismaz viens cipars*</p>
                        <p id="Garums">Parole garums 8-20 simboli*</p>

                    </div>

                </div>

                <div class="form-control" id="form-control—pass2">

                    <input type="password" id="rpassword2" required maxlength="20">

                    <label id="pas2lab">

                        <span style="transition-delay:0ms">P</span><span style="transition-delay:50ms">a</span><span style="transition-delay:100ms">s</span><span style="transition-delay:150ms">s</span><span style="transition-delay:200ms">w</span><span style="transition-delay:250ms">o</span><span style="transition-delay:300ms">r</span><span style="transition-delay:350ms">d</span>
                    
                    </label>

                    <div class="lookpassR">

                        <img src="image/icons/view.png">

                    </div>

                </div>

                <button class="btnreg" type="submit" id="registerBtn" disabled>Reģistreties</button>

            </form>

        </div>

    </div>
</div>

<div class="profelimenu" id="profiest">

    <div class="base">
        
        <i class="fas fa-close closemodal" data-target="#profiest"></i>

        <div class="selectmenu">

            <div class="profinfo">

                <div class="profile-image">

                    <img src="<?php echo $_SESSION['avatarHOMIK']; ?>" alt="">

                </div>

                <div class="prof-name">

                    <div class="name-i"><p></p></div>

                    <div class="email-i"><p></p></div>

                </div>

            </div>

            <div class="profbtns">

                <button><i class="fas fa-cog" id="spin"></i>Iestatijumi</button>

                <button><i class="fas fa-star" id="spin"></i>Favoriti</button>

                <button><i class="fas fa-money-bill-wave" id="rotate-spin"></i>Sludinajumi</button>

                <button><i class="fa-solid fa-message" id="rotate-spin"></i>Saraksti</button>

            </div>

            <div class="logoutbtn">

                <a href="/database/logout.php"><i class="fa fa-sign-out"></i>Iziet</a>

            </div>

        </div>

        <div class="menu" id="settings-menu">

            <form id="editForm">

                <div class="box-flex">
                
                    <div class="box avatar">

                        <div class="close-prew">

                            <div class="avatar-pre">

                                <i class="fas fa-close avatar-del"></i>

                                <img src="" id="avatar-preview">

                            </div>
                        
                        </div>

                        <div class="input-file-row">
                            <label class="input-file">
                                <input type="file" multiple accept="image/*" id="newavatar" name="newavatar">
                                <span>Izvelies failu</span>
                            </label>  
                        </div>

                    </div>

                    <div class="box username-p">

                        <p>Username: <span><?php echo $_SESSION['lietotajvardsHOMIK']; ?></span></p>

                    </div>

                </div>

                <div class="info-box">

                    <div class="input-l">
                        <label>Vards:</label>
                        <input type="text" id="vards">
                    </div>

                    <div class="input-l">
                        <label>Uzvards:</label>
                        <input type="text" id="uzvards">
                    </div>

                    <div class="input-l">
                        <label>E-pasts:</label>
                        <input type="text" id="epasts">
                    </div>

                    <div class="input-l">
                        <label>Telefons:</label>
                        <input type="text" id="telefons">
                    </div>

                    <input type="hidden" id="lietotajaId" value="<?php echo $_SESSION['IdHOMIK'];?>">

                </div>


                <div class="password-c">

                    <div class="passwordC" data-target="#activePass" id="activePass"><p>Manit paroli</p></div>

                    <i class="fas fa-close closemodal" data-target="#activePass"></i>

                    <div class="input-l">
                        <label>Parole:</label>
                        <input type="password" id="password1-c">
                    </div>

                    <div class="input-l">
                        <label>Atkartoti parole:</label>
                        <input type="password" id="password2-c">
                    </div>

                </div>

                <button class="btna" id="probtn">

                    <div class="btn-box">

                        <div class="btn-line"></div>

                        <span>Saglabat</span>

                    </div>

                </button>

            </form>

        </div>

        <div class="menu" id="favoriti-menu">

            <div class="page-btn">


            </div>

            <div class="fav-container" id="fav-container">

            </div>

        </div>

        <div class="menu" id="slud-menu">

            <h1>hello slud</h1>

        </div>

        <div class="menu" id="sar-menu">

            <h1>hello sar</h1>

        </div>

    </div>

</div>
