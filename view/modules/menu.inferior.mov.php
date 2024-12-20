<div id="tp-bottom-menu-sticky" class="tp-mobile-menu d-lg-none">
    <div class="container">
        <div class="row row-cols-5">

            <!-- Store -->
            <div class="col">
                <div class="tp-mobile-item text-center">
                    <a href="<?php echo $url; ?>view/productos/" class="tp-mobile-item-btn">
                        <i class="flaticon-store"></i>
                        <span>Tienda</span>
                    </a>
                </div>
            </div>

            <!-- Search -->
            <div class="col">
                <div class="tp-mobile-item text-center">
                    <button class="tp-mobile-item-btn tp-search-open-btn">
                        <i class="flaticon-search-1"></i>
                        <span>Buscar</span>
                    </button>
                </div>
            </div>

            <!-- Wishlist -->
            <div class="col">
                <div class="tp-mobile-item text-center" >
                <?php if (isset($_SESSION['cli_id'])): ?>
                    <a href="#" class="tp-mobile-item-btn" id="favoritesButtonMovil">
                        <i class="flaticon-love"></i>
                        <span>Favoritos</span>
                    </a>
                <?php else: ?>
                    <a href="#" id="loginPromptFavorites3" class="tp-mobile-item-btn" id="loginPromptFavorites3">
                        <i class="flaticon-love"></i>
                        <span>Favoritos</span>
                    </a>
                <?php endif; ?>
                </div>
            </div>

            <!-- Account -->
            <div class="col">
                <div class="tp-mobile-item text-center">
                    <?php if (isset($_SESSION['cli_id'])): ?>
                        <!-- Si el usuario está autenticado -->
                        <div class="dropdown">
                            <a href="#" class="tp-mobile-item-btn dropdown-toggle no-caret" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                <?php if (isset($_SESSION['cli_img']) && !empty($_SESSION['cli_img'])): ?>
                                    <img src="<?php echo $url_back ?>assets/imagenes/clientes/<?= $_SESSION['cli_img']; ?>"
                                        alt="Foto de Perfil" style="width: 40px; height: 40px; border-radius: 50%;">
                                <?php else: ?>
                                    <i class="flaticon-user"></i>
                                <?php endif; ?>
                                <span><?= $_SESSION['cli_nom'] ?? 'Usuario'; ?></span>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="userDropdown">
                                <li><a class="dropdown-item" href="#">Perfil</a></li>
                                <li><a class="dropdown-item" href="<?php echo $url ?>view/modules/logout.php">Cerrar sesión</a></li>
                            </ul>
                        </div>
                    <?php else: ?>
                        <!-- Si no está autenticado -->
                        <a href="#" id="accountLinkMovil" class="tp-mobile-item-btn">
                            <i class="flaticon-user"></i>
                            <span>Ingresar</span>
                        </a>
                    <?php endif; ?>
                </div>
            </div>



            <!-- Menu -->
            <div class="col">
                <div class="tp-mobile-item text-center">
                    <button class="tp-mobile-item-btn tp-offcanvas-open-btn">
                        <i class="flaticon-menu-1"></i>
                        <span>Menu</span>
                    </button>
                </div>
            </div>

        </div>
    </div>
</div>