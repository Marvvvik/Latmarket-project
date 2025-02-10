<?php 

session_start();

?>

<header>

    <div class="logo">

        <a href="/"><img src="/image/Latmarket-logo.png" alt=""></a>

    </div>


    <div class="navmenu">

        <a href="/#search" class="btna">

            <div class="btn-box">

                <div class="btn-line"></div>

                <span>Meklet</span>

            </div>

        </a>

        <a href="/#search" class="btna">

            <div class="btn-box">

                <div class="btn-line"></div>

                <span>Jaunumi</span>

            </div>

        </a>

        <a href="/atsaukmes.php" class="btna">

            <div class="btn-box">

                <div class="btn-line"></div>

                <span>Atsaukmes</span>

            </div>

        </a>

        <?php if(!isset($_SESSION['lietotajvardsHOMIK'])){ ?>

        <button class="btna" id="OpenLogReg">

            <div class="btn-box">

                <div class="btn-line"></div>

                <span>Login/Signin</span>

            </div>

        </button>

        <?php 
        
        } 
        
        if(isset($_SESSION['lietotajvardsHOMIK'])){

        ?>

        <div class="profset">

            <div class="proimage" data-target="#profmenu">

                <img src="<?php echo $_SESSION['avatarHOMIK']; ?>" alt="">

            </div>

            <div class="profmenu" id="profmenu">

                <button data-target="#profiest"><i class="fas fa-cog" id="spin"></i>Iestatijumi</button>

                <button><i class="fas fa-star" id="spin"></i>Favoriti</button>

                <button><i class="fa-solid fa-message" id="rotate-spin"></i>Saraksti</button>

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

        <h2 class="modname">Autorizeties</h2>

    <div class="reg-log-btn">

        <button id="logBtn">Autorizeties</button>

        <p>/</p>

        <button id="regBtn">Reģistreties</button>

        <div class="cube"></div>

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

            </div>

            <button class="btna btnlog" type="submit" name="ielogoties" id="loginbtn" disabled>

                <div class="btn-box btnlogbox">

                    <div class="btn-line"></div>

                    <span class="btnlogspan">Login</span>

                </div>

            </button>

        </form>

    </div>

    <div class="reg-form">

        <form id="registerForm">

            <div class='regmes'></div>

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

            </div>

            <button class="btna btnreg" type="submit" id="registerBtn" disabled>

                <div class="btn-box btnlogbox">

                    <div class="btn-line"></div>

                    <span class="btnlogspan">Register</span>

                </div>

            </button>


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

                <a href=""><i class="fas fa-cog" id="spin"></i>Iestatijumi</a>

                <a href=""><i class="fas fa-star" id="spin"></i>Favoriti</a>

                <a href=""><i class="fa-solid fa-message" id="rotate-spin"></i>Saraksti</a>

            </div>

            <div class="logoutbtn">

                <a href="/database/logout.php"><i class="fa fa-sign-out"></i>Iziet</a>

            </div>

        </div>

        <div class="settings-menu">

            <form id="editForm">

                <div class="box-flex">
                
                    <div class="box avatar">

                        <div class="avatar-pre"></div>

                        <button type="button">Izvelies failu</button>

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

    </div>

</div>