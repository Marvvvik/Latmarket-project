<header>
    <div class="logo">
        <a href="/"><i class="fas fa-tag"></i>Latmarket</a>
    </div>

    <nav class="navigation-menu">
        <a href="/#search" class="nav-link"><i class="fas fa-search"></i>Meklēt</a>
        <a href="/#news" class="nav-link"><i class="fas fa-newspaper"></i>Jaunumi</a>
        <a href="/atsaukmes.php" class="nav-link"><i class="far fa-comment"></i>Atsauksmes</a>

        <?php if (!isset($_SESSION['lietotajvardsHOMIK'])){ ?>
            <button id="openLoginModal" class="btn-login"><i class="fas fa-user"></i>Autorizēties</button>
        <?php } if(session_status() === PHP_SESSION_ACTIVE && isset($_SESSION['lietotajvardsHOMIK'])){ ?>
            <div class="profile-settings">
                <div class="profile-image-header" data-target="#profileMenu">
                    <img src="" class="avatar-img">
                </div>

                <div class="profile-menu" id="profileMenu">
                    <button id="settingsBtn"><i class="fas fa-cog" id="spin"></i>Iestatījumi</button>
                    <button id="favoritesBtn"><i class="fas fa-star"  id="spin"></i>Favorīti</button>
                    <button id="offerBtn"><i class="fas fa-money-bill-wave" id="rotate-spin"></i>Sludinājumi</button>
                    <button id="messagesBtn"><i class="fas fa-message" id="rotate-spin"></i>Sarakstes</button>
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
            <button class="active" id="login-tab-button">Autorizēties</button>
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
                <button class="profile-nav-btn" id="messagesSectionBtn"><i class="fas fa-message" id="rotate-spin"></i>Sarakstes</button>
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
                    <div class="password-Chanege-Switcher" data-target="#onPasswordChange" id="onPasswordChange"><p>Manit paroli</p></div>
                    <i class="fas fa-close close-Modal" data-target="#onPasswordChange"></i>

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
            <div class="favorites-Filter">

                <div class= "filt-cont">
                    <div class="select">
                        <select id="Kategorijas_select" name="Kategorijas_select" disabled>
                            <option value='' hidden>Kategorija</option>

                            <option value=''>-</option>

                        </select>
                    </div>
                </div>

                <div class= "filt-cont">
                    <div class="select">
                        <select id="Papildus_select" name="Papildus_select" disabled>

                            <option value=''>Pec kategorijās</option>
                            <option value=''>Cenas, sākot no augstākās</option>
                            <option value=''>Cenas, sākot no zemākās</option>
                            <option value=''>Pedejas pievienotais</option>
                            <option value=''>Pirmais pievienotais</option>

                        </select>
                    </div>
                </div>
            </div>

            <div class="favorites-buttons"></div>
            <div class="favorites-container" id="favorites-container"></div>

        </div>

        <div id="offerSection" class="profile-section">
            <h1>hello slud</h1>
        </div>

        <div id="messagesSection" class="profile-section">

            <div class="contacts-Container">
                <div class="contacts-Header">
                    <form id="contactsSearch">
                        <div class="input-Icon">
                            <i class="fa fa-search"></i><input type="">
                        </div>
                    </form>
                </div>

                <div class="contacts-List">
                    <div class="box active"><div class="avatar-Container"></div><div class="contacts-Name"><h1>Maksims Viktorovs</h1></div></div>
                    <div class="box"><div class="avatar-Container"></div><div class="contacts-Name"><h1>Maksims Viktorovs</h1></div></div>
                    <div class="box"><div class="avatar-Container"></div><div class="contacts-Name"><h1>Maksims Viktorovs</h1></div></div>
                </div>
            </div>

            <div class="chat-Container">
                <div class="chatInfo"></div>
                <div class="chatText"></div>
                <div class="inputChat">
                    <form>
                        <input type="text">
                        <button class="sarBtn"><i class="fas fa-paper-plane"></i>Nosutīt</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php }; ?>