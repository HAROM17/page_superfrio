<nav class="navbar navbar-expand-lg navbar-landing navbar-white fixed-top" id="navbar">
    <div class="container d-flex flex-column">
        <div class="d-flex justify-content-between align-items-center w-100 py-1">
            <a class="navbar-brand" href="<?php echo $url; ?>" style="margin-right: 20px;">
                <img src="<?php echo $url_backend; ?>assets/imagenes/empresas/<?php echo $logo_emp_1; ?>" class="card-logo" height="50">
            </a>
            <div class="d-flex align-items-center">
                <div class="btn btn-link fw-medium text-decoration-none text-dark me-2 ">
                    <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle" id="page-header-cart-dropdown" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-haspopup="true" aria-expanded="true">
                        <i class="bx bx-cart fs-23"></i>
                        <span class="position-absolute topbar-badge cartitem-badge fs-10 translate-middle badge rounded-pill bg-info" id="cart-item-count">7</span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-xl dropdown-menu-end p-0 dropdown-menu-cart" aria-labelledby="page-header-cart-dropdown">
                        <div class="p-3 border-top-0 border-start-0 border-end-0 border-dashed border">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h6 class="m-0 fs-16 fw-semibold"> Mi Carrito </h6>
                                </div>
                                <div class="col-auto">
                                    <span class="badge badge-soft-warning fs-13"><span id="cart-item-count-badge">7</span> items</span>
                                </div>
                            </div>
                        </div>
                        <div data-simplebar style="max-height: 300px;">
                            <div class="p-2">
                                <div class="text-center empty-cart" id="empty-cart">
                                    <div class="avatar-md mx-auto my-3">
                                        <div class="avatar-title bg-soft-info text-info fs-36 rounded-circle">
                                            <i class='bx bx-cart'></i>
                                        </div>
                                    </div>
                                    <h5 class="mb-3">Tu Carro Esta Vacio!</h5>
                                    <a href="apps-ecommerce-products.html" class="btn btn-success w-md mb-3">Shop Now</a>
                                </div>
                                <!-- Aquí van los productos del carrito -->
                                <div id="cart-items">
                                    <div class="d-block dropdown-item dropdown-item-cart text-wrap px-3 py-2 cart-item" data-price="320">
                                        <div class="d-flex align-items-center">
                                            <img src="assets/images/products/img-1.png" class="me-3 rounded-circle avatar-sm p-2 bg-light" alt="user-pic">
                                            <div class="flex-1">
                                                <h6 class="mt-0 mb-1 fs-14">
                                                    <a href="apps-ecommerce-product-details.html" class="text-reset">Branded T-Shirts</a>
                                                </h6>
                                                <p class="mb-0 fs-12 text-muted">
                                                    Quantity: <span>10 x $32</span>
                                                </p>
                                            </div>
                                            <div class="px-2">
                                                <h5 class="m-0 fw-normal">$<span class="cart-item-price">320</span></h5>
                                            </div>
                                            <div class="ps-2">
                                                <button type="button" class="btn btn-icon btn-sm btn-ghost-secondary remove-item-btn"><i class="ri-close-fill fs-16"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-block dropdown-item dropdown-item-cart text-wrap px-3 py-2 cart-item" data-price="89">
                                        <div class="d-flex align-items-center">
                                            <img src="assets/images/products/img-2.png" class="me-3 rounded-circle avatar-sm p-2 bg-light" alt="user-pic">
                                            <div class="flex-1">
                                                <h6 class="mt-0 mb-1 fs-14">
                                                    <a href="apps-ecommerce-product-details.html" class="text-reset">Bentwood Chair</a>
                                                </h6>
                                                <p class="mb-0 fs-12 text-muted">
                                                    Quantity: <span>5 x $18</span>
                                                </p>
                                            </div>
                                            <div class="px-2">
                                                <h5 class="m-0 fw-normal">$<span class="cart-item-price">89</span></h5>
                                            </div>
                                            <div class="ps-2">
                                                <button type="button" class="btn btn-icon btn-sm btn-ghost-secondary remove-item-btn"><i class="ri-close-fill fs-16"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Agrega más items del carrito aquí -->
                                </div>
                            </div>
                        </div>
                        <div class="p-3 border-bottom-0 border-start-0 border-end-0 border-dashed border" id="checkout-elem">
                            <div class="d-flex justify-content-between align-items-center pb-3">
                                <h5 class="m-0 text-muted">Total:</h5>
                                <div class="px-2">
                                    <h5 class="m-0" id="cart-item-total">$1258.58</h5>
                                </div>
                            </div>
                            <a href="<?php echo $url ?>view/confirmar/confirmar.php" class="btn btn-success text-center w-100">Verificar</a>
                        </div>
                    </div>
                </div>
                <button class="navbar-toggler py-0 fs-20 text-body" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="mdi mdi-menu"></i>
                </button>
            </div>

        </div>



        <div class="collapse navbar-collapse w-100" id="navbarSupportedContent">
            <ul class="navbar-nav mx-auto mt-2 mt-lg-0" id="navbar-example" style="margin-top: -60px;">
                <li class="nav-item">
                    <a class="nav-link active" href="<?php echo $url; ?>#home">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $url; ?>#servicio">Servicios</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $url; ?>#productos">Productos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $url; ?>#team">Team</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $url; ?>#galeria">Galeria</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $url; ?>#contacto">Contacto</a>
                </li>
            </ul>

            <div class="d-flex align-items-center">
                <?php if (isset($_SESSION["cli_id"])) { ?>
                    <span class="text-dark"><?php echo $_SESSION["cli_correo"]; ?></span>
                    <div class="dropdown">
                        <button type="button" class="btn" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="d-flex align-items-center">
                            <?php if (!empty($_SESSION["cli_img"])) { ?>
                                <img class="rounded-circle header-profile-user" src="<?php echo $url_backend ?>assets/imagenes/clientes/<?php echo $_SESSION["cli_img"];?>" alt="Header Avatar">
                            <?php } else { ?>
                                <img class="rounded-circle header-profile-user" src="<?php echo $url; ?>assets/imagenes/no_login.jpg" alt="Header Avatar">
                            <?php } ?>
                                <span class="text-start ms-xl-2">
                                    <span class="d-none d-xl-inline-block ms-1 fw-medium user-name-text"><?php echo $_SESSION["cli_nom"]; ?></span>
                                </span>
                            </span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a class="dropdown-item" href="<?php echo $url; ?>view/perfil/"><i class="mdi mdi-account-circle text-muted fs-16 align-middle me-1"></i> <span class="align-middle">Perfil</span></a>
                            <a class="dropdown-item" href="<?php echo $url; ?>view/pedidos/"><i class="mdi mdi-message-text-outline text-muted fs-16 align-middle me-1"></i> <span class="align-middle">Pedidos</span></a>
                            <a class="dropdown-item" href="apps-chat.html"><i class="mdi mdi-message-text-outline text-muted fs-16 align-middle me-1"></i> <span class="align-middle">Mensajes</span></a>
                            <a class="dropdown-item" href="pages-faqs.html"><i class="mdi mdi-lifebuoy text-muted fs-16 align-middle me-1"></i> <span class="align-middle">Ayuda</span></a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="pages-profile.html"><i class="mdi mdi-wallet text-muted fs-16 align-middle me-1"></i> <span class="align-middle">Puntos : <b>23</b></span></a>
                            <a class="dropdown-item" href="<?php echo $url; ?>view/logout/logout.php"><i class="mdi mdi-logout text-muted fs-16 align-middle me-1"></i> <span class="align-middle" data-key="t-logout">Cerrar Sesión</span></a>
                        </div>
                    </div>
                <?php } else { ?>
                    <a href="<?php echo $url; ?>view/login/login.php?e=1" class="btn btn-link fw-medium text-decoration-none text-dark">Iniciar Sesión</a>
                    <a href="<?php echo $url; ?>view/register/" class="btn btn-primary">Crear Cuenta</a>
                    <div class="dropdown">
                        <button type="button" class="btn" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="d-flex align-items-center">
                                <img class="rounded-circle header-profile-user" src="<?php echo $url; ?>assets/imagenes/no_login.jpg" alt="Header Avatar">
                            </span>
                        </button>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</nav>




<style>
    .navbar {
        padding: 0.1rem 1rem;
    }

    .navbar .navbar-toggler {
        margin-left: auto;
    }

    .search-form {
        max-width: 300px;
        /* Ajusta el ancho máximo del formulario */
    }

    .search-form .form-control {
        max-width: 200px;
        /* Ajusta el ancho máximo del campo de entrada */
    }

    @media (min-width: 992px) {
        .search-form {
            margin-top: -80px;
        }

        .navbar .container {
            align-items: center;
        }

        .navbar .navbar-collapse {
            justify-content: center;
            align-items: center;
        }

        .navbar-nav {
            flex-direction: row;
        }

        .navbar-collapse {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
        }

        ul.navbar-nav {
            margin-top: -40px;
        }
    }

    @media (max-width: 767.98px) {
        .dropdown-menu-cart {
            width: 90% !important;
            left: 5% !important;
        }

        .search-form {
            max-width: 90%;
            margin: 0 auto;
        }
    }
</style>


<script>
    document.querySelectorAll('.navbar-nav .nav-link').forEach(function(el) {
        el.addEventListener('click', function() {
            if (window.innerWidth < 992) {
                document.querySelector('.navbar-toggler').click();
            }
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        const cartItems = document.getElementById('cart-items');
        const emptyCartMessage = document.getElementById('empty-cart');
        const totalPriceElement = document.getElementById('cart-item-total');
        const itemCountBadge = document.getElementById('cart-item-count');
        const itemCountBadgeDetail = document.getElementById('cart-item-count-badge');
        const removeItemButtons = document.querySelectorAll('.remove-item-btn');

        function updateCart() {
            const cartItemElements = cartItems.querySelectorAll('.cart-item');
            let total = 0;
            let itemCount = 0;

            cartItemElements.forEach(item => {
                const price = parseFloat(item.getAttribute('data-price'));
                total += price;
                itemCount++;
            });

            totalPriceElement.textContent = `$${total.toFixed(2)}`;
            itemCountBadge.textContent = itemCount;
            itemCountBadgeDetail.textContent = itemCount;

            if (cartItemElements.length > 0) {
                emptyCartMessage.style.display = 'none';
            } else {
                emptyCartMessage.style.display = 'block';
            }
        }

        removeItemButtons.forEach(button => {
            button.addEventListener('click', function() {
                const cartItem = this.closest('.cart-item');
                cartItem.remove();
                updateCart();
            });
        });

        updateCart();
    });
</script>






<!-- ################################################################## -->
