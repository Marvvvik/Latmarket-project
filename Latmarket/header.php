<header>
    <div class="logo">
        <a href="/"><i class="fas fa-tag"></i>Latmarket</a>
    </div>

    <nav class="navigation-menu">
        <a href="/#search" class="nav-link"><i class="fas fa-search"></i>Meklēt</a>
        <a href="/atsaukmes.php" class="nav-link"><i class="far fa-comment"></i>Atsauksmes</a>

        <?php if (!isset($_SESSION['lietotajvardsHOMIK'])){ ?>
            <button id="openLoginModal" class="btn-login"><i class="fas fa-user"></i>Pieslēgties</button>
        <?php } if(session_status() === PHP_SESSION_ACTIVE && isset($_SESSION['lietotajvardsHOMIK'])){ ?>
            <div class="profile-settings">
                <div class="profile-image-header" data-target="#profileMenu">
                    <img src="" class="avatar-img">
                </div>

                <div class="profile-menu" id="profileMenu">
                    <button id="settingsBtn"><i class="fas fa-cog" id="spin"></i>Iestatījumi</button>
                    <button id="favoritesBtn"><i class="fas fa-star"  id="spin"></i>Favorīti</button>
                    <button id="offerBtn"><i class="fas fa-money-bill-wave" id="rotate-spin"></i>Sludinājumi</button>
                    <a href="/database/logout.php" id="logoutBtn"><i class="fa fa-sign-out"></i>Iziet</a>
                </div>
            </div>
        <?php }; ?>
    </nav>
</header>

<?php if (!isset($_SESSION['lietotajvardsHOMIK'])){ ?>

<div class="auth-modal">
    <div class="auth-container">

        <i class="fas fa-close close-Modal" id="closeAuth"></i>

        <div class="auth-toggle-buttons">
            <button class="active" id="login-tab-button">Pieslēgties</button>
            <button id="register-tab-button">Reģistrēties</button>
        </div>

        <div class="login-form-container active">
            <form action="/database/login.php" method="POST">

                <div class='login-message'>
                    <?php
                        if (isset($_SESSION['loginMessage'])) {
                            echo $_SESSION['loginMessage'];
                            unset($_SESSION['loginMessage']);
                        }
                    ?>
                </div>

                <div class="form-header">
                    <h1>Laipni lūgti atpakaļ!</h1>
                </div>

                <div class="form-control">
                    <input type="hidden" name="redirect" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
                    <input type="text" name="username" id="login-username" required>

                    <label>
                        <span style="transition-delay:0ms">U</span><span style="transition-delay:50ms">s</span><span style="transition-delay:100ms">e</span><span style="transition-delay:150ms">r</span><span style="transition-delay:200ms">n</span><span style="transition-delay:250ms">a</span><span style="transition-delay:300ms">m</span><span style="transition-delay:350ms">e</span>
                    </label>
                </div>

                <div class="form-control">
                    <input type="password" name="password" id="login-password" required>

                    <label>
                        <span style="transition-delay:0ms">P</span><span style="transition-delay:50ms">a</span><span style="transition-delay:100ms">s</span><span style="transition-delay:150ms">s</span><span style="transition-delay:200ms">w</span><span style="transition-delay:250ms">o</span><span style="transition-delay:300ms">r</span><span style="transition-delay:350ms">d</span>
                    </label>

                    <div class="reset-password">
                        <a href="/Change_password.php">Aizmirsi paroli?</a>
                    </div>

                    <div class="toggle-password-visibility">
                        <img src="/image/icons/view.png" id="passworVisibilityLogin" alt="Skatīt paroli">
                    </div>
                </div>

                <button class="btn-login" type="submit" name="login" id="login-submit-button" disabled>Autorizēties</button>
            </form>
        </div>

        <div class="register-form-container">
            <form id="registerForm">
                <div class="form-header">
                    <h1>Izveidot Profilu!</h1>
                </div>

                <div class="form-control">
                    <input type="text" id="register-username" required>

                    <label>
                        <span style="transition-delay:0ms">U</span><span style="transition-delay:50ms">s</span><span style="transition-delay:100ms">e</span><span style="transition-delay:150ms">r</span><span style="transition-delay:200ms">n</span><span style="transition-delay:250ms">a</span><span style="transition-delay:300ms">m</span><span style="transition-delay:350ms">e</span>
                    </label>
                </div>

                <div class="form-control" id="register-password1-control">
                    <input type="password" id="register-password1" required minlength="8" maxlength="20">

                    <label id="register-password1-label">
                        <span style="transition-delay:0ms">P</span><span style="transition-delay:50ms">a</span><span style="transition-delay:100ms">s</span><span style="transition-delay:150ms">s</span><span style="transition-delay:200ms">w</span><span style="transition-delay:250ms">o</span><span style="transition-delay:300ms">r</span><span style="transition-delay:350ms">d</span>
                    </label>

                    <div class="password-requirements">
                        <p id="uppercase-requirement">Lielais burts*</p>
                        <p id="lowercase-requirement">Mazais burts*</p>
                        <p id="specialchar-requirement">Speciālais simbols*</p>
                        <p id="digit-requirement">Vismaz viens cipars*</p>
                        <p id="length-requirement">Paroles garums 8-20 simboli*</p>
                    </div>
                </div>

                <div class="form-control" id="register-password2-control">
                    <input type="password" id="register-password2" required minlength="8" maxlength="20">

                    <label id="register-password2-label">
                        <span style="transition-delay:0ms">P</span><span style="transition-delay:50ms">a</span><span style="transition-delay:100ms">s</span><span style="transition-delay:150ms">s</span><span style="transition-delay:200ms">w</span><span style="transition-delay:250ms">o</span><span style="transition-delay:300ms">r</span><span style="transition-delay:350ms">d</span>
                    </label>

                    <div class="toggle-password-visibility">
                        <img src="/image/icons/view.png" id="passwordVisibilityRegister" alt="Skatīt paroli">
                    </div>
                </div>

                <button class="btn-register" type="submit" id="register-submit-button" disabled>Reģistrēties</button>
            </form>
        </div>
    </div>
</div>

<?php }; if(session_status() === PHP_SESSION_ACTIVE && isset($_SESSION['lietotajvardsHOMIK'])){ ?>

<div class="modal" id="profileSettings">
    <div class="profile-container">
        <i class="fas fa-times close-Modal" id="closeProfileMdoal"></i>

        <div class="profile-control">
            <div class="profile-header">
                <div class="profile-image">
                    <img src="" class="avatar-img">
                </div>
                <div class="user-info">
                    <p id="userFullName"></p>
                    <p id="userEmail"></p>
                </div>
            </div>

            <div class="profile-navigation">
                <button class="profile-nav-btn" id="settingsSectionBtn"><i class="fas fa-cog" id="spin"></i>Iestatījumi</button>
                <button class="profile-nav-btn" id="favoritesSectionBtn"><i class="fas fa-star" id="spin"></i>Favorīti</button>
                <button class="profile-nav-btn" id="offersSectionBtn"><i class="fas fa-money-bill-wave" id="rotate-spin"></i>Sludinājumi</button>
                <a href="/database/logout.php" class="logout-link"><i class="fa fa-sign-out"></i>Iziet</a>
            </div>
        </div>
        
        <div id="settingsSection" class="profile-section">
            <form id="editProfileForm">
                
                <div class="content-group">
                    <div class="box avatar">
                        <h1 class="active" id="avatarTitle">Profila bilde:</h1>
                        <div class="close-Preview">
                            <div class="avatar-Preview">
                                <i class="fas fa-close avatar-Delet"></i>
                                <img id="avatarPreview">
                            </div>
                        </div>
                        <div class="input-file-row">
                            <label class="input-file">
                                <input type="file" multiple accept="image/jpeg, image/png" id="newAvatar" name="newAvatar">
                                <span>Izvelies failu</span>
                            </label>  
                        </div>
                    </div>

                    <div class="box" id="usernameWiev">
                        <p>Username: <span><?php echo $_SESSION['lietotajvardsHOMIK']; ?></span></p>
                    </div>
                </div>


                <div class="info-Change" id="informationChanmge">
                    <div class="input-lable">
                        <label>Vards:</label>
                        <input type="text" id="vards">
                    </div>
                    <div class="input-lable">
                        <label>Uzvards:</label>
                        <input type="text" id="uzvards">
                    </div>
                    <div class="input-lable">
                        <label>E-pasts:</label>
                        <input type="text" id="epasts">
                    </div>
                    <div class="input-lable">
                        <label>Telefons:</label>
                        <input type="text" id="telefons">
                    </div>
                </div>

                <div class="info-Change" id="passwordChange">
                    <div class="password-Chanege-Switcher" id="onPasswordChange"><p>Manit paroli</p></div>
                    <i class="fas fa-close close-Modal" id="ClosePasswordEdit"></i>

                    <div class="input-lable">
                        <label>Parole:</label>
                        <input type="password" id="password1-c">
                    </div>
                    <div class="input-lable">
                        <label>Atkartoti parole:</label>
                        <input type="password" id="password2-c">
                    </div>
                </div>

                <button class="setBtn" id="probtn"><i class="fas fa-check"></i>Saglabat</button>
            </form>
        </div>


        <div id="favoritesSection" class="profile-section">
             <div class="favoriti-Filter">

                <div class="car-filter__select-box">
                    <div class= "filt-cont">
                        <select id="filter-kfdjkfd"  class="car-filter__select">
                            <option value="" disabled selected hidden>Kategorija</option>

                            <optgroup label="Transport">
                                <option value="Vieglie auto">Vieglie auto</option>
                                <option value="Kravas automašīnas">Kravas automašīnas</option>
                                <option value="Moto transports">Moto transports</option>
                                <option value="Velosipēdi">Velosipēdi</option>
                                <option value="Remonts un rezerves daļas">Remonts un rezerves daļas</option>
                                <option value="Transporta noma">Transporta noma</option>
                            </optgroup>

                            <optgroup label="Darbs un bizness">
                                <option value="Bentley">Bentley</option>
                                <option value="BMW">BMW</option>
                                <option value="Bugatti">Bugatti</option>
                                <option value="Buick">Buick</option>
                                <option value="BYD">BYD</option>
                            </optgroup>

                            <optgroup label="Elektronika">
                                <option value="Cadillac">Cadillac</option>
                                <option value="Chevrolet">Chevrolet</option>
                                <option value="Chrysler">Chrysler</option>
                                <option value="Citroën">Citroën</option>
                            </optgroup>

                            <optgroup label="Mēbeles">
                                <option value="Cadillac">Cadillac</option>
                                <option value="Chevrolet">Chevrolet</option>
                                <option value="Chrysler">Chrysler</option>
                                <option value="Citroën">Citroën</option>
                            </optgroup>

                            <optgroup label="Apģērbi">
                                <option value="Cadillac">Cadillac</option>
                                <option value="Chevrolet">Chevrolet</option>
                                <option value="Chrysler">Chrysler</option>
                                <option value="Citroën">Citroën</option>
                            </optgroup>

                            <optgroup label="Celtniecība">
                                <option value="Cadillac">Cadillac</option>
                                <option value="Chevrolet">Chevrolet</option>
                                <option value="Chrysler">Chrysler</option>
                                <option value="Citroën">Citroën</option>
                            </optgroup>

                            <optgroup label="Bērniem">
                                <option value="Cadillac">Cadillac</option>
                                <option value="Chevrolet">Chevrolet</option>
                                <option value="Chrysler">Chrysler</option>
                                <option value="Citroën">Citroën</option>
                            </optgroup>

                            <optgroup label="Dzīvnieki">
                                <option value="Cadillac">Cadillac</option>
                                <option value="Chevrolet">Chevrolet</option>
                                <option value="Chrysler">Chrysler</option>
                                <option value="Citroën">Citroën</option>
                            </optgroup>

                            <optgroup label="Lauksaimniecība">
                                <option value="Cadillac">Cadillac</option>
                                <option value="Chevrolet">Chevrolet</option>
                                <option value="Chrysler">Chrysler</option>
                                <option value="Citroën">Citroën</option>
                            </optgroup>
                        </select>
                        <div class="box-arrow"><i class="fas fa-angle-down"></i></div>
                    </div>
                </div>

                <div class="car-filter__select-box">
                    <div class= "filt-cont">
                        <select id="filter-asgfasg" class="car-filter__select">
                            <option value="datums_desc">Datums (jaunākie)</option>
                            <option value="datums_asc">Datums (vecākie)</option>
                            <option value="cena_asc">Cena (zemākā)</option>
                            <option value="cena_desc">Cena (augstākā)</option>
                        </select>
                        <div class="box-arrow"><i class="fas fa-angle-down"></i></div>
                    </div>
                </div>
            </div>
            

            <div class="favorites-buttons"></div>
            <div class="favorites-container" id="favorites-container"></div>

        </div>

        <div id="offerSection" class="profile-section">
            <div class="slud-Filter">

                <div class="car-filter__select-box">
                    <div class= "filt-cont">
                        <select id="filter-agdfg" class="car-filter__select">
                            <option value="" disabled selected hidden>Kategorija</option>

                            <optgroup label="Transport">
                                <option value="Vieglie auto">Vieglie auto</option>
                                <option value="Kravas automašīnas">Kravas automašīnas</option>
                                <option value="Moto transports">Moto transports</option>
                                <option value="Velosipēdi">Velosipēdi</option>
                                <option value="Remonts un rezerves daļas">Remonts un rezerves daļas</option>
                                <option value="Transporta noma">Transporta noma</option>
                            </optgroup>

                            <optgroup label="Darbs un bizness">
                                <option value="Bentley">Bentley</option>
                                <option value="BMW">BMW</option>
                                <option value="Bugatti">Bugatti</option>
                                <option value="Buick">Buick</option>
                                <option value="BYD">BYD</option>
                            </optgroup>

                            <optgroup label="Elektronika">
                                <option value="Cadillac">Cadillac</option>
                                <option value="Chevrolet">Chevrolet</option>
                                <option value="Chrysler">Chrysler</option>
                                <option value="Citroën">Citroën</option>
                            </optgroup>

                            <optgroup label="Mēbeles">
                                <option value="Cadillac">Cadillac</option>
                                <option value="Chevrolet">Chevrolet</option>
                                <option value="Chrysler">Chrysler</option>
                                <option value="Citroën">Citroën</option>
                            </optgroup>

                            <optgroup label="Apģērbi">
                                <option value="Cadillac">Cadillac</option>
                                <option value="Chevrolet">Chevrolet</option>
                                <option value="Chrysler">Chrysler</option>
                                <option value="Citroën">Citroën</option>
                            </optgroup>

                            <optgroup label="Celtniecība">
                                <option value="Cadillac">Cadillac</option>
                                <option value="Chevrolet">Chevrolet</option>
                                <option value="Chrysler">Chrysler</option>
                                <option value="Citroën">Citroën</option>
                            </optgroup>

                            <optgroup label="Bērniem">
                                <option value="Cadillac">Cadillac</option>
                                <option value="Chevrolet">Chevrolet</option>
                                <option value="Chrysler">Chrysler</option>
                                <option value="Citroën">Citroën</option>
                            </optgroup>

                            <optgroup label="Dzīvnieki">
                                <option value="Cadillac">Cadillac</option>
                                <option value="Chevrolet">Chevrolet</option>
                                <option value="Chrysler">Chrysler</option>
                                <option value="Citroën">Citroën</option>
                            </optgroup>

                            <optgroup label="Lauksaimniecība">
                                <option value="Cadillac">Cadillac</option>
                                <option value="Chevrolet">Chevrolet</option>
                                <option value="Chrysler">Chrysler</option>
                                <option value="Citroën">Citroën</option>
                            </optgroup>
                        </select>
                        <div class="box-arrow"><i class="fas fa-angle-down"></i></div>
                    </div>
                </div>

                <div class="car-filter__select-box">
                    <div class= "filt-cont">
                        <select id="filter-asfas" class="car-filter__select">
                            <option value="datums_desc">Datums (jaunākie)</option>
                            <option value="datums_asc">Datums (vecākie)</option>
                            <option value="cena_asc">Cena (zemākā)</option>
                            <option value="cena_desc">Cena (augstākā)</option>
                        </select>
                        <div class="box-arrow"><i class="fas fa-angle-down"></i></div>
                    </div>
                </div>
            </div>

            <div class="slud-buttons"></div>
            <div class="slud-container" id="slud-container"></div>
        </div>
    </div>
</div>

<?php }; ?>