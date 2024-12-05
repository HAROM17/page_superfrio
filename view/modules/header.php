<header>
    <div class="tp-header-area p-relative z-index-11">
        <div class="tp-header-top black-bg p-relative z-index-1 d-none d-md-block">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="tp-header-welcome d-flex align-items-center">
                            <span><svg width="22" height="19" viewBox="0 0 22 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M14.6364 1H1V12.8182H14.6364V1Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M14.6364 5.54545H18.2727L21 8.27273V12.8182H14.6364V5.54545Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M5.0909 17.3636C6.3461 17.3636 7.36363 16.3461 7.36363 15.0909C7.36363 13.8357 6.3461 12.8182 5.0909 12.8182C3.83571 12.8182 2.81818 13.8357 2.81818 15.0909C2.81818 16.3461 3.83571 17.3636 5.0909 17.3636Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M16.9091 17.3636C18.1643 17.3636 19.1818 16.3461 19.1818 15.0909C19.1818 13.8357 18.1643 12.8182 16.9091 12.8182C15.6539 12.8182 14.6364 13.8357 14.6364 15.0909C14.6364 16.3461 15.6539 17.3636 16.9091 17.3636Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </span>
                            <p>
                                Envio Gratis A Partir de S/. 900
                            </p>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="tp-header-top-right d-flex align-items-center justify-content-end">
                            <div class="tp-header-top-menu d-flex align-items-center justify-content-end">
                                <div class="tp-header-top-menu-item tp-header-setting">
                                    <?php if (isset($_SESSION['cli_id'])): ?>
                                        <!-- Usuario autenticado -->
                                        <a href="<?php echo $url ?>view/modules/logout.php" style="color: white;">Cerrar Sesión</a>
                                    <?php else: ?>
                                        <a href="#" id="openModalButton" data-bs-toggle="modal" data-bs-target="#authModal" style="color: white;">Ingresar</a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- header main start -->

        <div class="tp-header-main tp-header-sticky">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-2 col-lg-2 col-md-4 col-6">
                        <div class="logo">
                            <a href="index.html">
                                <img src="assets/img/logo/superfrio.png" alt="logo" height="45">
                            </a>
                        </div>
                    </div>

                    <div class="col-xl-6 col-lg-7 d-none d-lg-block">
                        <div class="tp-header-search pl-70">
                            <form action="#">
                                <div class="tp-header-search-wrapper d-flex align-items-center">
                                    <div class="tp-header-search-box">
                                        <input
                                            type="text"
                                            placeholder="Buscar Producto..."></input>
                                    </div>

                                    <div class="tp-header-search-category">
                                        <select>
                                            <option>Categorias</option>
                                            <option>Helados Artesanales</option>
                                            <option>Helados Industriales</option>
                                        </select>
                                    </div>

                                    <div class="tp-header-search-btn">
                                        <button type="submit">
                                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M9 17C13.4183 17 17 13.4183 17 9C17 4.58172 13.4183 1 9 1C4.58172 1 1 4.58172 1 9C1 13.4183 4.58172 17 9 17Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                <path d="M19 19L14.65 14.65" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="col-xl-4 col-lg-3 col-md-8 col-6">
                        <div class="tp-header-main-right d-flex align-items-center justify-content-end">
                            <div class="tp-header-login d-none d-lg-block">
                                <a href="#" id="accountLink" class="d-flex align-items-center">
                                    <div class="tp-header-login-icon">
                                        <span>
                                            <?php if (isset($_SESSION['cli_img']) && !empty($_SESSION['cli_img'])): ?>
                                                <img src="<?php echo $url_back ?>assets/imagenes/clientes/<?= $_SESSION['cli_img']; ?>" alt="Foto de Perfil" style="width: 40px; height: 40px; border-radius: 50%;">
                                            <?php else: ?>
                                                <svg width="17" height="21" viewBox="0 0 17 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <circle cx="8.57894" cy="5.77803" r="4.77803" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></circle>
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M1.00002 17.2014C0.998732 16.8655 1.07385 16.5337 1.2197 16.2311C1.67736 15.3158 2.96798 14.8307 4.03892 14.611C4.81128 14.4462 5.59431 14.336 6.38217 14.2815C7.84084 14.1533 9.30793 14.1533 10.7666 14.2815C11.5544 14.3367 12.3374 14.4468 13.1099 14.611C14.1808 14.8307 15.4714 15.27 15.9291 16.2311C16.2224 16.8479 16.2224 17.564 15.9291 18.1808C15.4714 19.1419 14.1808 19.5812 13.1099 19.7918C12.3384 19.9634 11.5551 20.0766 10.7666 20.1304C9.57937 20.2311 8.38659 20.2494 7.19681 20.1854C6.92221 20.1854 6.65677 20.1854 6.38217 20.1304C5.59663 20.0773 4.81632 19.9641 4.04807 19.7918C2.96798 19.5812 1.68652 19.1419 1.2197 18.1808C1.0746 17.8747 0.999552 17.5401 1.00002 17.2014Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                </svg>
                                            <?php endif; ?>
                                        </span>
                                    </div>
                                    <div class="tp-header-login-content d-none d-xl-block">
                                        <?php if (isset($_SESSION['cli_nom']) && isset($_SESSION['cli_ape'])): ?>
                                            <span>Hola, <?= $_SESSION['cli_nom']; ?> <?= $_SESSION['cli_ape']; ?></span>
                                            <h5 class="tp-header-login-title">Tu Cuenta</h5>
                                            <?php else: ?>
                                            <span>Iniciar Sesión</span>
                                        <?php endif; ?>
                                    </div>
                                </a>
                            </div>


                            <div class="tp-header-action d-flex align-items-center ml-50">
                                <div class="tp-header-action-item d-none d-lg-block">
                                    <a href="compare.html" class="tp-header-action-btn">
                                        <svg width="20" height="19" viewBox="0 0 20 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M14.8396 17.3319V3.71411" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M19.1556 13L15.0778 17.0967L11 13" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M4.91115 1.00056V14.6183" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M0.833496 5.09667L4.91127 1L8.98905 5.09667" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                                    </a>
                                </div>
                                <div class="tp-header-action-item d-none d-lg-block">
                                    <a href="wishlist.html" class="tp-header-action-btn">
                                        <svg width="22" height="20" viewBox="0 0 22 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M11.239 18.8538C13.4096 17.5179 15.4289 15.9456 17.2607 14.1652C18.5486 12.8829 19.529 11.3198 20.1269 9.59539C21.2029 6.25031 19.9461 2.42083 16.4289 1.28752C14.5804 0.692435 12.5616 1.03255 11.0039 2.20148C9.44567 1.03398 7.42754 0.693978 5.57894 1.28752C2.06175 2.42083 0.795919 6.25031 1.87187 9.59539C2.46978 11.3198 3.45021 12.8829 4.73806 14.1652C6.56988 15.9456 8.58917 17.5179 10.7598 18.8538L10.9949 19L11.239 18.8538Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M7.26062 5.05302C6.19531 5.39332 5.43839 6.34973 5.3438 7.47501" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                                        <span class="tp-header-action-badge">4</span>
                                    </a>
                                </div>
                                <div class="tp-header-action-item">
                                    <button type="button" class="tp-header-action-btn cartmini-open-btn">
                                        <svg width="21" height="22" viewBox="0 0 21 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M6.48626 20.5H14.8341C17.9004 20.5 20.2528 19.3924 19.5847 14.9348L18.8066 8.89359C18.3947 6.66934 16.976 5.81808 15.7311 5.81808H5.55262C4.28946 5.81808 2.95308 6.73341 2.4771 8.89359L1.69907 14.9348C1.13157 18.889 3.4199 20.5 6.48626 20.5Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M6.34902 5.5984C6.34902 3.21232 8.28331 1.27803 10.6694 1.27803V1.27803C11.8184 1.27316 12.922 1.72619 13.7362 2.53695C14.5504 3.3477 15.0081 4.44939 15.0081 5.5984V5.5984" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M7.70365 10.1018H7.74942" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M13.5343 10.1018H13.5801" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                                        <span class="tp-header-action-badge">99</span>
                                    </button>
                                </div>
                                <div class="tp-header-action-item d-lg-none">
                                    <button type="button" class="tp-header-action-btn tp-offcanvas-open-btn">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="16" viewBox="0 0 30 16">
                                            <rect x="10" width="20" height="2" fill="currentColor"></rect>
                                            <rect x="5" y="7" width="25" height="2" fill="currentColor"></rect>
                                            <rect x="10" y="14" width="20" height="2" fill="currentColor"></rect>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- header bottom start -->

        <div class="tp-header-bottom tp-header-bottom-border d-none d-lg-block">
            <div class="container">
                <div class="tp-mega-menu-wrapper p-relative">
                    <div class="row align-items-center">
                        <div class="col-xl-6 col-lg-6">
                            <div class="main-menu menu-style-1">
                                <nav class="tp-main-menu-content">
                                    <ul>
                                        <li><a href="<?php echo $url ?>">Inicio</a></li>
                                        <li class="has-dropdown has-mega-menu">
                                            <a href="<?php echo $url ?>">Productos</a>

                                            <ul class="tp-submenu tp-mega-menu mega-menu-style-2">
                                                <!-- first col -->

                                                <li class="has-dropdown">
                                                    <a href="shop.html" class="mega-menu-title">Helados Artesanales</a>
                                                    <ul class="tp-submenu">
                                                        <li><a href="shop-category.html">Clasi Cream</a></li>
                                                        <li><a href="shop-filter-offcanvas.html">Premiun Cream</a></li>
                                                        <li><a href="shop.html">Super Escolar</a></li>
                                                        <li><a href="shop-list.html">Tropica Ice</a></li>
                                                    </ul>
                                                </li>

                                                <!-- third col -->

                                                <li class="has-dropdown">
                                                    <a href="product-details.html" class="mega-menu-title">Helados Industriales</a>
                                                    <ul class="tp-submenu">
                                                        <li><a href="product-details.html">Bañaños</a></li>
                                                        <li><a href="product-details-video.html">Hiela Zoos</a></li>
                                                        <li><a href="product-details-countdown.html">Pincipes</a></li>
                                                        <li><a href="product-details-presentation.html">Torbellino</a></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </li>

                                        <li><a href="galeria.html">Galeria</a></li>
                                        <li><a href="coupon.html">Acerca de nosotros</a></li>
                                        <li><a href="contact.html">Contáctanos</a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>

                        <div class="col-xl-3 col-lg-3">
                            <div class="tp-header-contact d-flex align-items-center justify-content-end">
                                <div class="tp-header-contact-icon">
                                    <span>
                                        <svg width="21" height="20" viewBox="0 0 21 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M1.96977 3.24859C2.26945 2.75144 3.92158 0.946726 5.09889 1.00121C5.45111 1.03137 5.76246 1.24346 6.01544 1.49057H6.01641C6.59631 2.05874 8.26011 4.203 8.35352 4.65442C8.58411 5.76158 7.26378 6.39979 7.66756 7.5157C8.69698 10.0345 10.4707 11.8081 12.9908 12.8365C14.1058 13.2412 14.7441 11.9219 15.8513 12.1515C16.3028 12.2459 18.4482 13.9086 19.0155 14.4894V14.4894C19.2616 14.7414 19.4757 15.0537 19.5049 15.4059C19.5487 16.6463 17.6319 18.3207 17.2583 18.5347C16.3767 19.1661 15.2267 19.1544 13.8246 18.5026C9.91224 16.8749 3.65985 10.7408 2.00188 6.68096C1.3675 5.2868 1.32469 4.12906 1.96977 3.24859Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M12.936 1.23685C16.4432 1.62622 19.2124 4.39253 19.6065 7.89874" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M12.936 4.59337C14.6129 4.92021 15.9231 6.23042 16.2499 7.90726" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                                    </span>
                                </div>
                                <div class="tp-header-contact-content">
                                    <h5>Contacto:</h5>
                                    <p><a href="tel:51 956 854 187">+51 956 854 187</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>


<!-- Modal con pestañas para Iniciar Sesión y Crear Cuenta -->
<div class="modal fade" id="authModal" tabindex="-1" aria-labelledby="authModalLabel" aria-hidden="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header text-center d-flex justify-content-center">
                <h5 class="modal-title fw-bold mx-auto" id="authModalLabel">¡Bienvenido!</h5>
                <button type="button" class="btn-close position-absolute end-0 me-3" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul class="nav nav-tabs mb-3 justify-content-center" id="authTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="login-tab" data-bs-toggle="tab" data-bs-target="#login" type="button" role="tab" aria-controls="login" aria-selected="true">
                            Iniciar Sesión
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="register-tab" data-bs-toggle="tab" data-bs-target="#register" type="button" role="tab" aria-controls="register" aria-selected="false">
                            Crear Cuenta
                        </button>
                    </li>
                </ul>
                <div class="tab-content" id="authTabContent">
                    <!-- Iniciar Sesión -->
                    <div class="tab-pane fade show active" id="login" role="tabpanel" aria-labelledby="login-tab">
                        <form id="loginForm">
                            <div class="mb-3">
                                <label for="cli_correo" class="form-label">Correo Electrónico</label>
                                <input type="email" class="form-control" id="cli_correo" name="cli_correo" placeholder="Ingrese su correo electrónico" required>
                            </div>
                            <div class="mb-3">
                                <label for="cli_pass" class="form-label">Contraseña</label>
                                <input type="password" class="form-control" id="cli_pass" name="cli_pass" placeholder="Ingrese su contraseña" required>
                            </div>
                            <!-- Campo oculto para el ID de la empresa -->
                            <input type="hidden" id="emp_id" name="emp_id" value="">
                            <div class="d-grid">
                                <button type="submit" class="btn btn-success">Iniciar Sesión</button>
                            </div>
                            <br>
                            <div class="form-group" style="display: flex; justify-content: center; align-items: center;">
                                <!-- Configuración del botón de inicio de sesión con Google -->
                                <div id="g_id_onload"
                                    data-client_id="1083179140444-07mkb108cq8149dfdjhq3qnvomv6fii5.apps.googleusercontent.com"
                                    data-context="signin"
                                    data-ux_mode="popup"
                                    data-callback="handleCredentialResponse"
                                    data-auto_prompt="false">
                                </div>
                                <div class="g_id_signin"
                                    data-type="standard"
                                    data-shape="rectangular"
                                    data-theme="outline"
                                    data-text="signin_with"
                                    data-size="large"
                                    data-logo_alignment="left">
                                </div>
                            </div>
                        </form>
                        <div id="loginAlert" class="alert alert-danger mt-3 d-none" role="alert"></div>
                        <div id="loginAlert2" class="alert alert-primary mt-3 d-none" role="alert"></div>
                    </div>


                    <!-- Crear Cuenta -->
                    <div class="tab-pane fade" id="register" role="tabpanel" aria-labelledby="register-tab">
                        <form id="registerForm">
                            <div class="row mb-2">
                                <div class="col">
                                    <label for="registerFirstName" class="form-label">Nombre</label>
                                    <input type="text" class="form-control" id="registerFirstName" name="cli_nom" placeholder="Ingrese su nombre" required>
                                </div>
                                <div class="col">
                                    <label for="registerLastName" class="form-label">Apellido</label>
                                    <input type="text" class="form-control" id="registerLastName" name="cli_ape" placeholder="Ingrese su apellido" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="registerDNI" class="form-label">DNI</label>
                                    <input type="text" class="form-control" id="registerDNI" name="cli_dni" placeholder="Ingrese su DNI" required>
                                </div>
                                <div class="col">
                                    <label for="registerPassword" class="form-label">Contraseña</label>
                                    <input type="password" class="form-control" id="registerPassword" name="cli_pass" placeholder="Ingrese su contraseña" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="registerEmail" class="form-label">Correo Electrónico</label>
                                    <input type="email" class="form-control" id="registerEmail" name="cli_correo" placeholder="Ingrese su correo electrónico" required>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-success w-100 mb-3">Crear Cuenta</button>
                            <br>
                            <div class="form-group" style="display: flex; justify-content: center; align-items: center;">
                                <div id="g_id_onload"
                                    data-client_id="1083179140444-07mkb108cq8149dfdjhq3qnvomv6fii5.apps.googleusercontent.com"
                                    data-context="signup"
                                    data-ux_mode="popup"
                                    data-callback="handleGoogleRegister"
                                    data-auto_prompt="false">
                                </div>
                                <div class="g_id_signin"
                                    data-type="standard"
                                    data-shape="rectangular"
                                    data-theme="outline"
                                    data-text="signup_with"
                                    data-size="large">
                                </div>
                            </div>

                        </form>
                        <div id="loginAlert3" class="alert alert-danger mt-3 d-none" role="alert"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const isAuthenticated = <?php echo isset($_SESSION['cli_id']) ? 'true' : 'false'; ?>;
</script>