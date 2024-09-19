<?php
require_once("../../config/conexion.php");
$url = Conectar::ruta();
$url_backend = Conectar::ruta_backend();
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_GET['subcat_id'])) {
    $subcat_id = intval($_GET['subcat_id']);
        
    // Preparar la llamada al procedimiento almacenado
    $stmt = Conectar::Conexion()->prepare("CALL mostrar_x_subcat(:subcat_id)");
    $stmt->bindParam(':subcat_id', $subcat_id, PDO::PARAM_INT);
    $stmt->execute();
    $productos = $stmt->fetchAll();
    $stmt->closeCursor();
}



?>
<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none">

<head>

    <meta charset="utf-8" />
    <title>Helados Super Frios</title>

    <?php require_once("../modules/head.php"); ?>


</head>

<body data-bs-spy="scroll" data-bs-target="#navbar-example">


    <div class="layout-wrapper landing">


        <?php require_once("../modules/nav.php"); ?>

        <br>

        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-8">
                        <div class="card">
                            <div class="card-body checkout-tab">

                                <form action="#">
                                    <div class="step-arrow-nav mt-n3 mx-n3 mb-3">

                                        <ul class="nav nav-pills nav-justified custom-nav" role="tablist">
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link fs-15 p-3  active" id="pills-bill-info-tab" data-bs-toggle="pill" data-bs-target="#pills-bill-info" type="button" role="tab" aria-controls="pills-bill-info" aria-selected="false" data-position="0">
                                                    <i class="ri-user-2-line fs-16 p-2 bg-soft-primary text-primary rounded-circle align-middle me-2"></i>
                                                    <font style="vertical-align: inherit;">
                                                        <font style="vertical-align: inherit;">Info. personal
                                                        </font>
                                                    </font>
                                                </button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link fs-15 p-3 " id="pills-bill-address-tab" data-bs-toggle="pill" data-bs-target="#pills-bill-address" type="button" role="tab" aria-controls="pills-bill-address" aria-selected="false" data-position="1">
                                                    <i class="ri-truck-line fs-16 p-2 bg-soft-primary text-primary rounded-circle align-middle me-2"></i>
                                                    <font style="vertical-align: inherit;">
                                                        <font style="vertical-align: inherit;">Datos de envío
                                                        </font>
                                                    </font>
                                                </button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link fs-15 p-3 " id="pills-payment-tab" data-bs-toggle="pill" data-bs-target="#pills-payment" type="button" role="tab" aria-controls="pills-payment" aria-selected="true" data-position="2">
                                                    <i class="ri-bank-card-line fs-16 p-2 bg-soft-primary text-primary rounded-circle align-middle me-2"></i>
                                                    <font style="vertical-align: inherit;">
                                                        <font style="vertical-align: inherit;">Info. de pago
                                                        </font>
                                                    </font>
                                                </button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link fs-15 p-3" id="pills-finish-tab" data-bs-toggle="pill" data-bs-target="#pills-finish" type="button" role="tab" aria-controls="pills-finish" aria-selected="false" data-position="3">
                                                    <i class="ri-checkbox-circle-line fs-16 p-2 bg-soft-primary text-primary rounded-circle align-middle me-2"></i>
                                                    <font style="vertical-align: inherit;">
                                                        <font style="vertical-align: inherit;">Finalizar
                                                        </font>
                                                    </font>
                                                </button>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="tab-content">
                                        <div class="tab-pane fade" id="pills-bill-info" role="tabpanel" aria-labelledby="pills-bill-info-tab">
                                            <div>
                                                <h5 class="mb-1">
                                                    <font style="vertical-align: inherit;">
                                                        <font style="vertical-align: inherit;">Info. de facturación</font>
                                                    </font>
                                                </h5>
                                                <p class="text-muted mb-4">
                                                    <font style="vertical-align: inherit;">
                                                        <font style="vertical-align: inherit;">Por favor complete toda la Info. a continuación</font>
                                                    </font>
                                                </p>
                                            </div>

                                            <div>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="mb-3">
                                                            <label for="billinginfo-firstName" class="form-label">
                                                                <font style="vertical-align: inherit;">
                                                                    <font style="vertical-align: inherit;">Nombre de pila</font>
                                                                </font>
                                                            </label>
                                                            <input type="text" class="form-control" id="billinginfo-firstName" placeholder="Introduce el nombre" value="">
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-6">
                                                        <div class="mb-3">
                                                            <label for="billinginfo-lastName" class="form-label">
                                                                <font style="vertical-align: inherit;">
                                                                    <font style="vertical-align: inherit;">Apellido</font>
                                                                </font>
                                                            </label>
                                                            <input type="text" class="form-control" id="billinginfo-lastName" placeholder="Introduzca el apellido" value="">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="mb-3">
                                                            <label for="billinginfo-email" class="form-label">
                                                                <font style="vertical-align: inherit;">
                                                                    <font style="vertical-align: inherit;">Email </font>
                                                                </font><span class="text-muted">
                                                                    <font style="vertical-align: inherit;">
                                                                        <font style="vertical-align: inherit;">opcional)</font>
                                                                    </font>
                                                                </span>
                                                            </label>
                                                            <input type="email" class="form-control" id="billinginfo-email" placeholder="Ingrese correo electrónico">
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-6">
                                                        <div class="mb-3">
                                                            <label for="billinginfo-phone" class="form-label">
                                                                <font style="vertical-align: inherit;">
                                                                    <font style="vertical-align: inherit;">Teléfono</font>
                                                                </font>
                                                            </label>
                                                            <input type="text" class="form-control" id="billinginfo-phone" placeholder="Ingrese el número de teléfono.">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="billinginfo-address" class="form-label">
                                                        <font style="vertical-align: inherit;">
                                                            <font style="vertical-align: inherit;">DIRECCIÓN</font>
                                                        </font>
                                                    </label>
                                                    <textarea class="form-control" id="billinginfo-address" placeholder="Ingresa la direccion" rows="3"></textarea>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="mb-3">
                                                            <label for="country" class="form-label">
                                                                <font style="vertical-align: inherit;">
                                                                    <font style="vertical-align: inherit;">País</font>
                                                                </font>
                                                            </label>
                                                            <div class="choices" data-type="select-one" tabindex="0" role="combobox" aria-autocomplete="list" aria-haspopup="true" aria-expanded="false">
                                                                <div class="choices__inner"><select class="form-select choices__input" id="country" data-plugin="choices" hidden="" tabindex="-1" data-choice="active">
                                                                        <option value="United States" data-custom-properties="[object Object]">
                                                                            <font style="vertical-align: inherit;">
                                                                                <font style="vertical-align: inherit;">Estados Unidos</font>
                                                                            </font>
                                                                        </option>
                                                                    </select>
                                                                    <div class="choices__list choices__list--single">
                                                                        <div class="choices__item choices__item--selectable" data-item="" data-id="1" data-value="United States" data-custom-properties="[object Object]" aria-selected="true">
                                                                            <font style="vertical-align: inherit;">
                                                                                <font style="vertical-align: inherit;">Estados Unidos</font>
                                                                            </font>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="choices__list choices__list--dropdown" aria-expanded="false"><input type="text" class="choices__input choices__input--cloned" autocomplete="off" autocapitalize="off" spellcheck="false" role="textbox" aria-autocomplete="list" aria-label="Seleccionar país..." placeholder="Resultados de búsqueda aquí">
                                                                    <div class="choices__list" role="listbox">
                                                                        <div id="choices--country-item-choice-1" class="choices__item choices__item--choice choices__placeholder choices__item--selectable is-highlighted" role="option" data-choice="" data-id="1" data-value="" data-select-text="Press to select" data-choice-selectable="" aria-selected="true">
                                                                            <font style="vertical-align: inherit;">
                                                                                <font style="vertical-align: inherit;">Seleccionar país...</font>
                                                                            </font>
                                                                        </div>
                                                                        <div id="choices--country-item-choice-2" class="choices__item choices__item--choice is-selected choices__item--selectable" role="option" data-choice="" data-id="2" data-value="United States" data-select-text="Press to select" data-choice-selectable="">
                                                                            <font style="vertical-align: inherit;">
                                                                                <font style="vertical-align: inherit;">Estados Unidos</font>
                                                                            </font>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="mb-3">
                                                            <label for="state" class="form-label">
                                                                <font style="vertical-align: inherit;">
                                                                    <font style="vertical-align: inherit;">Estado</font>
                                                                </font>
                                                            </label>
                                                            <div class="choices" data-type="select-one" tabindex="0" role="combobox" aria-autocomplete="list" aria-haspopup="true" aria-expanded="false">
                                                                <div class="choices__inner"><select class="form-select choices__input" id="state" data-plugin="choices" hidden="" tabindex="-1" data-choice="active">
                                                                        <option value="California" data-custom-properties="[object Object]">
                                                                            <font style="vertical-align: inherit;">
                                                                                <font style="vertical-align: inherit;">California</font>
                                                                            </font>
                                                                        </option>
                                                                    </select>
                                                                    <div class="choices__list choices__list--single">
                                                                        <div class="choices__item choices__item--selectable" data-item="" data-id="1" data-value="California" data-custom-properties="[object Object]" aria-selected="true">
                                                                            <font style="vertical-align: inherit;">
                                                                                <font style="vertical-align: inherit;">California</font>
                                                                            </font>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="choices__list choices__list--dropdown" aria-expanded="false"><input type="text" class="choices__input choices__input--cloned" autocomplete="off" autocapitalize="off" spellcheck="false" role="textbox" aria-autocomplete="list" aria-label="Seleccione estado..." placeholder="Resultados de búsqueda aquí">
                                                                    <div class="choices__list" role="listbox">
                                                                        <div id="choices--state-item-choice-19" class="choices__item choices__item--choice choices__placeholder choices__item--selectable is-highlighted" role="option" data-choice="" data-id="19" data-value="" data-select-text="Press to select" data-choice-selectable="" aria-selected="true">
                                                                            <font style="vertical-align: inherit;">
                                                                                <font style="vertical-align: inherit;">Seleccione estado...</font>
                                                                            </font>
                                                                        </div>
                                                                        <div id="choices--state-item-choice-1" class="choices__item choices__item--choice choices__item--selectable" role="option" data-choice="" data-id="1" data-value="Alabama" data-select-text="Press to select" data-choice-selectable="">
                                                                            <font style="vertical-align: inherit;">
                                                                                <font style="vertical-align: inherit;">Alabama</font>
                                                                            </font>
                                                                        </div>
                                                                        <div id="choices--state-item-choice-2" class="choices__item choices__item--choice choices__item--selectable" role="option" data-choice="" data-id="2" data-value="Alaska" data-select-text="Press to select" data-choice-selectable="">
                                                                            <font style="vertical-align: inherit;">
                                                                                <font style="vertical-align: inherit;">Alaska</font>
                                                                            </font>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="mb-3">
                                                            <label for="zip" class="form-label">
                                                                <font style="vertical-align: inherit;">
                                                                    <font style="vertical-align: inherit;">Código postal</font>
                                                                </font>
                                                            </label>
                                                            <input type="text" class="form-control" id="zip" placeholder="Ingresa tu código postal">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="d-flex align-items-start gap-3 mt-3">
                                                    <button type="button" class="btn btn-primary btn-label right ms-auto nexttab" data-nexttab="pills-bill-address-tab">
                                                        <i class="ri-truck-line label-icon align-middle fs-16 ms-2"></i>
                                                        <font style="vertical-align: inherit;">
                                                            <font style="vertical-align: inherit;">Continuar con el envío
                                                            </font>
                                                        </font>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end tab pane -->

                                        <div class="tab-pane fade" id="pills-bill-address" role="tabpanel" aria-labelledby="pills-bill-address-tab">
                                            <div>
                                                <h5 class="mb-1">
                                                    <font style="vertical-align: inherit;">
                                                        <font style="vertical-align: inherit;">Info. de envío</font>
                                                    </font>
                                                </h5>
                                                <p class="text-muted mb-4">
                                                    <font style="vertical-align: inherit;">
                                                        <font style="vertical-align: inherit;">Por favor complete toda la Info. a continuación</font>
                                                    </font>
                                                </p>
                                            </div>

                                            <div class="mt-4">
                                                <div class="d-flex align-items-center mb-2">
                                                    <div class="flex-grow-1">
                                                        <h5 class="fs-14 mb-0">
                                                            <font style="vertical-align: inherit;">
                                                                <font style="vertical-align: inherit;">Dirección guardada</font>
                                                            </font>
                                                        </h5>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        <!-- Button trigger modal -->
                                                        <button type="button" class="btn btn-sm btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addAddressModal">
                                                            <font style="vertical-align: inherit;">
                                                                <font style="vertical-align: inherit;">
                                                                    Añadir dirección
                                                                </font>
                                                            </font>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="row gy-3">
                                                    <div class="col-lg-4 col-sm-6">
                                                        <div class="form-check card-radio">
                                                            <input id="shippingAddress01" name="shippingAddress" type="radio" class="form-check-input" checked="">
                                                            <label class="form-check-label" for="shippingAddress01">
                                                                <span class="mb-4 fw-semibold d-block text-muted text-uppercase">
                                                                    <font style="vertical-align: inherit;">
                                                                        <font style="vertical-align: inherit;">Direccion de casa</font>
                                                                    </font>
                                                                </span>

                                                                <span class="fs-14 mb-2 d-block">
                                                                    <font style="vertical-align: inherit;">
                                                                        <font style="vertical-align: inherit;">Marco Alfaro</font>
                                                                    </font>
                                                                </span>
                                                                <span class="text-muted fw-normal text-wrap mb-1 d-block">
                                                                    <font style="vertical-align: inherit;">
                                                                        <font style="vertical-align: inherit;">4739 Bubby Drive Austin, TX 78729</font>
                                                                    </font>
                                                                </span>
                                                                <span class="text-muted fw-normal d-block">
                                                                    <font style="vertical-align: inherit;">
                                                                        <font style="vertical-align: inherit;">Lunes 012-345-6789</font>
                                                                    </font>
                                                                </span>
                                                            </label>
                                                        </div>
                                                        <div class="d-flex flex-wrap p-2 py-1 bg-light rounded-bottom border mt-n1">
                                                            <div>
                                                                <a href="#" class="d-block text-body p-1 px-2" data-bs-toggle="modal" data-bs-target="#addAddressModal"><i class="ri-pencil-fill text-muted align-bottom me-1"></i>
                                                                    <font style="vertical-align: inherit;">
                                                                        <font style="vertical-align: inherit;">Editar</font>
                                                                    </font>
                                                                </a>
                                                            </div>
                                                            <div>
                                                                <a href="#" class="d-block text-body p-1 px-2" data-bs-toggle="modal" data-bs-target="#removeItemModal"><i class="ri-delete-bin-fill text-muted align-bottom me-1"></i>
                                                                    <font style="vertical-align: inherit;">
                                                                        <font style="vertical-align: inherit;">Eliminar</font>
                                                                    </font>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-sm-6">
                                                        <div class="form-check card-radio">
                                                            <input id="shippingAddress02" name="shippingAddress" type="radio" class="form-check-input">
                                                            <label class="form-check-label" for="shippingAddress02">
                                                                <span class="mb-4 fw-semibold d-block text-muted text-uppercase">
                                                                    <font style="vertical-align: inherit;">
                                                                        <font style="vertical-align: inherit;">Dirección de la oficina</font>
                                                                    </font>
                                                                </span>

                                                                <span class="fs-14 mb-2 d-block">
                                                                    <font style="vertical-align: inherit;">
                                                                        <font style="vertical-align: inherit;">James Honda</font>
                                                                    </font>
                                                                </span>
                                                                <span class="text-muted fw-normal text-wrap mb-1 d-block">
                                                                    <font style="vertical-align: inherit;">
                                                                        <font style="vertical-align: inherit;">1246 Virgil Street Pensacola, FL 32501</font>
                                                                    </font>
                                                                </span>
                                                                <span class="text-muted fw-normal d-block">
                                                                    <font style="vertical-align: inherit;">
                                                                        <font style="vertical-align: inherit;">Lunes 012-345-6789</font>
                                                                    </font>
                                                                </span>
                                                            </label>
                                                        </div>
                                                        <div class="d-flex flex-wrap p-2 py-1 bg-light rounded-bottom border mt-n1">
                                                            <div>
                                                                <a href="#" class="d-block text-body p-1 px-2" data-bs-toggle="modal" data-bs-target="#addAddressModal"><i class="ri-pencil-fill text-muted align-bottom me-1"></i>
                                                                    <font style="vertical-align: inherit;">
                                                                        <font style="vertical-align: inherit;">Editar</font>
                                                                    </font>
                                                                </a>
                                                            </div>
                                                            <div>
                                                                <a href="#" class="d-block text-body p-1 px-2" data-bs-toggle="modal" data-bs-target="#removeItemModal"><i class="ri-delete-bin-fill text-muted align-bottom me-1"></i>
                                                                    <font style="vertical-align: inherit;">
                                                                        <font style="vertical-align: inherit;">Eliminar</font>
                                                                    </font>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="mt-4">
                                                    <h5 class="fs-14 mb-3">
                                                        <font style="vertical-align: inherit;">
                                                            <font style="vertical-align: inherit;">Método de envío</font>
                                                        </font>
                                                    </h5>

                                                    <div class="row g-4">
                                                        <div class="col-lg-6">
                                                            <div class="form-check card-radio">
                                                                <input id="shippingMethod01" name="shippingMethod" type="radio" class="form-check-input" checked="">
                                                                <label class="form-check-label" for="shippingMethod01">
                                                                    <span class="fs-20 float-end mt-2 text-wrap d-block fw-semibold">
                                                                        <font style="vertical-align: inherit;">
                                                                            <font style="vertical-align: inherit;">Gratis</font>
                                                                        </font>
                                                                    </span>
                                                                    <span class="fs-14 mb-1 text-wrap d-block">
                                                                        <font style="vertical-align: inherit;">
                                                                            <font style="vertical-align: inherit;">Entrega gratis</font>
                                                                        </font>
                                                                    </span>
                                                                    <span class="text-muted fw-normal text-wrap d-block">
                                                                        <font style="vertical-align: inherit;">
                                                                            <font style="vertical-align: inherit;">Entrega prevista de 3 a 5 días</font>
                                                                        </font>
                                                                    </span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-check card-radio">
                                                                <input id="shippingMethod02" name="shippingMethod" type="radio" class="form-check-input" checked="">
                                                                <label class="form-check-label" for="shippingMethod02">
                                                                    <span class="fs-20 float-end mt-2 text-wrap d-block fw-semibold">
                                                                        <font style="vertical-align: inherit;">
                                                                            <font style="vertical-align: inherit;">$24.99</font>
                                                                        </font>
                                                                    </span>
                                                                    <span class="fs-14 mb-1 text-wrap d-block">
                                                                        <font style="vertical-align: inherit;">
                                                                            <font style="vertical-align: inherit;">Entrega urgente</font>
                                                                        </font>
                                                                    </span>
                                                                    <span class="text-muted fw-normal text-wrap d-block">
                                                                        <font style="vertical-align: inherit;">
                                                                            <font style="vertical-align: inherit;">Entrega en 24 horas.</font>
                                                                        </font>
                                                                    </span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="d-flex align-items-start gap-3 mt-4">
                                                <button type="button" class="btn btn-light btn-label previestab" data-previous="pills-bill-info-tab"><i class="ri-arrow-left-line label-icon align-middle fs-16 me-2"></i>
                                                    <font style="vertical-align: inherit;">
                                                        <font style="vertical-align: inherit;">Volver a Info. personal</font>
                                                    </font>
                                                </button>
                                                <button type="button" class="btn btn-primary btn-label right ms-auto nexttab" data-nexttab="pills-payment-tab"><i class="ri-bank-card-line label-icon align-middle fs-16 ms-2"></i>
                                                    <font style="vertical-align: inherit;">
                                                        <font style="vertical-align: inherit;">Continuar con el pago</font>
                                                    </font>
                                                </button>
                                            </div>
                                        </div>
                                        <!-- end tab pane -->

                                        <div class="tab-pane fade active show" id="pills-payment" role="tabpanel" aria-labelledby="pills-payment-tab">
                                            <div>
                                                <h5 class="mb-1">
                                                    <font style="vertical-align: inherit;">
                                                        <font style="vertical-align: inherit;">Selección de pago</font>
                                                    </font>
                                                </h5>
                                                <p class="text-muted mb-4">
                                                    <font style="vertical-align: inherit;">
                                                        <font style="vertical-align: inherit;">Por favor seleccione e ingrese su Info. de facturación</font>
                                                    </font>
                                                </p>
                                            </div>

                                            <div class="row g-4">
                                                <div class="col-lg-4 col-sm-6">
                                                    <div data-bs-toggle="collapse" data-bs-target="#paymentmethodCollapse.show" aria-expanded="true" aria-controls="paymentmethodCollapse">
                                                        <div class="form-check card-radio">
                                                            <input id="paymentMethod01" name="paymentMethod" type="radio" class="form-check-input">
                                                            <label class="form-check-label" for="paymentMethod01">
                                                                <span class="fs-16 text-muted me-2"><i class="ri-paypal-fill align-bottom"></i></span>
                                                                <span class="fs-14 text-wrap">
                                                                    <font style="vertical-align: inherit;">
                                                                        <font style="vertical-align: inherit;">PayPal</font>
                                                                    </font>
                                                                </span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-sm-6">
                                                    <div data-bs-toggle="collapse" data-bs-target="#paymentmethodCollapse" aria-expanded="true" aria-controls="paymentmethodCollapse" class="">
                                                        <div class="form-check card-radio">
                                                            <input id="paymentMethod02" name="paymentMethod" type="radio" class="form-check-input" checked="">
                                                            <label class="form-check-label" for="paymentMethod02">
                                                                <span class="fs-16 text-muted me-2"><i class="ri-bank-card-fill align-bottom"></i></span>
                                                                <span class="fs-14 text-wrap">
                                                                    <font style="vertical-align: inherit;">
                                                                        <font style="vertical-align: inherit;">Tarjeta de crédito / débito</font>
                                                                    </font>
                                                                </span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="collapse show" id="paymentmethodCollapse">
                                                <div class="card p-4 border shadow-none mb-0 mt-4">
                                                    <div class="row gy-3">
                                                        <div class="col-md-12">
                                                            <label for="cc-name" class="form-label">
                                                                <font style="vertical-align: inherit;">
                                                                    <font style="vertical-align: inherit;">Nombre en la tarjeta</font>
                                                                </font>
                                                            </label>
                                                            <input type="text" class="form-control" id="cc-name" placeholder="Ingrese su nombre">
                                                            <small class="text-muted">
                                                                <font style="vertical-align: inherit;">
                                                                    <font style="vertical-align: inherit;">Nombre completo como se muestra en la tarjeta.</font>
                                                                </font>
                                                            </small>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <label for="cc-number" class="form-label">
                                                                <font style="vertical-align: inherit;">
                                                                    <font style="vertical-align: inherit;">Número de Tarjeta de Crédito</font>
                                                                </font>
                                                            </label>
                                                            <input type="text" class="form-control" id="cc-number" placeholder="xxxx xxxx xxxx xxxxx">
                                                        </div>

                                                        <div class="col-md-3">
                                                            <label for="cc-expiration" class="form-label">
                                                                <font style="vertical-align: inherit;">
                                                                    <font style="vertical-align: inherit;">Vencimiento</font>
                                                                </font>
                                                            </label>
                                                            <input type="text" class="form-control" id="cc-expiration" placeholder="MM/AA">
                                                        </div>

                                                        <div class="col-md-3">
                                                            <label for="cc-cvv" class="form-label">
                                                                <font style="vertical-align: inherit;">
                                                                    <font style="vertical-align: inherit;">CVV</font>
                                                                </font>
                                                            </label>
                                                            <input type="text" class="form-control" id="cc-cvv" placeholder="xxx">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="text-muted mt-2 fst-italic">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock text-muted icon-xs">
                                                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                                        <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                                    </svg>
                                                    <font style="vertical-align: inherit;">
                                                        <font style="vertical-align: inherit;">Su transacción está protegida con cifrado SSL
                                                        </font>
                                                    </font>
                                                </div>
                                            </div>

                                            <div class="d-flex align-items-start gap-3 mt-4">
                                                <button type="button" class="btn btn-light btn-label previestab" data-previous="pills-bill-address-tab"><i class="ri-arrow-left-line label-icon align-middle fs-16 me-2"></i>
                                                    <font style="vertical-align: inherit;">
                                                        <font style="vertical-align: inherit;">Volver a Envío</font>
                                                    </font>
                                                </button>
                                                <button type="button" class="btn btn-primary btn-label right ms-auto nexttab" data-nexttab="pills-finish-tab"><i class="ri-shopping-basket-line label-icon align-middle fs-16 ms-2"></i>
                                                    <font style="vertical-align: inherit;">
                                                        <font style="vertical-align: inherit;">Orden completa</font>
                                                    </font>
                                                </button>
                                            </div>
                                        </div>
                                        <!-- end tab pane -->

                                        <div class="tab-pane fade" id="pills-finish" role="tabpanel" aria-labelledby="pills-finish-tab">
                                            <div class="text-center py-5">

                                                <div class="mb-4">
                                                    <lord-icon src="https://cdn.lordicon.com/lupuorrc.json" trigger="loop" colors="primary:#0ab39c,secondary:#405189" style="width:120px;height:120px"></lord-icon>
                                                </div>
                                                <h5>
                                                    <font style="vertical-align: inherit;">
                                                        <font style="vertical-align: inherit;">Gracias ! ¡Su pedido está completo!</font>
                                                    </font>
                                                </h5>
                                                <p class="text-muted">
                                                    <font style="vertical-align: inherit;">
                                                        <font style="vertical-align: inherit;">Recibirá un correo electrónico de confirmación del pedido con los detalles de su pedido.</font>
                                                    </font>
                                                </p>

                                                <h3 class="fw-semibold">
                                                    <font style="vertical-align: inherit;">
                                                        <font style="vertical-align: inherit;">Número de pedido: </font>
                                                    </font><a href="<?php echo $url ?>view/pedidos/detalle.php" class="text-decoration-underline">
                                                        <font style="vertical-align: inherit;">
                                                            <font style="vertical-align: inherit;">VZ2451</font>
                                                        </font>
                                                    </a>
                                                </h3>
                                            </div>
                                        </div>
                                        <!-- end tab pane -->
                                    </div>
                                    <!-- end tab content -->
                                </form>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->
                    </div>
                    <!-- end col -->

                    <div class="col-xl-4">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <h5 class="card-title mb-0">
                                            <font style="vertical-align: inherit;">
                                                <font style="vertical-align: inherit;">Resumen del pedido</font>
                                            </font>
                                        </h5>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive table-card">
                                    <table class="table table-borderless align-middle mb-0">
                                        <thead class="table-light text-muted">
                                            <tr>
                                                <th style="width: 90px;" scope="col">
                                                    <font style="vertical-align: inherit;">
                                                        <font style="vertical-align: inherit;">Producto</font>
                                                    </font>
                                                </th>
                                                <th scope="col">
                                                    <font style="vertical-align: inherit;">
                                                        <font style="vertical-align: inherit;">Info. del producto</font>
                                                    </font>
                                                </th>
                                                <th scope="col" class="text-end">
                                                    <font style="vertical-align: inherit;">
                                                        <font style="vertical-align: inherit;">Precio</font>
                                                    </font>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <div class="avatar-md bg-light rounded p-1">
                                                        <img src="assets/images/products/img-8.png" alt="" class="img-fluid d-block">
                                                    </div>
                                                </td>
                                                <td>
                                                    <h5 class="fs-14"><a href="apps-ecommerce-product-details.html" class="text-dark">
                                                            <font style="vertical-align: inherit;">
                                                                <font style="vertical-align: inherit;">Sudadera para Hombre (Rosa)</font>
                                                            </font>
                                                        </a></h5>
                                                    <p class="text-muted mb-0">
                                                        <font style="vertical-align: inherit;">
                                                            <font style="vertical-align: inherit;">$ 119,99 x 2</font>
                                                        </font>
                                                    </p>
                                                </td>
                                                <td class="text-end">
                                                    <font style="vertical-align: inherit;">
                                                        <font style="vertical-align: inherit;">$ 239,98</font>
                                                    </font>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="avatar-md bg-light rounded p-1">
                                                        <img src="assets/images/products/img-7.png" alt="" class="img-fluid d-block">
                                                    </div>
                                                </td>
                                                <td>
                                                    <h5 class="fs-14"><a href="apps-ecommerce-product-details.html" class="text-dark">
                                                            <font style="vertical-align: inherit;">
                                                                <font style="vertical-align: inherit;">Reloj inteligente Noise Evolve</font>
                                                            </font>
                                                        </a></h5>
                                                    <p class="text-muted mb-0">
                                                        <font style="vertical-align: inherit;">
                                                            <font style="vertical-align: inherit;">$ 94,99 x 1</font>
                                                        </font>
                                                    </p>
                                                </td>
                                                <td class="text-end">
                                                    <font style="vertical-align: inherit;">
                                                        <font style="vertical-align: inherit;">$ 94,99</font>
                                                    </font>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="avatar-md bg-light rounded p-1">
                                                        <img src="assets/images/products/img-3.png" alt="" class="img-fluid d-block">
                                                    </div>
                                                </td>
                                                <td>
                                                    <h5 class="fs-14"><a href="apps-ecommerce-product-details.html" class="text-dark">Recipiente de vidrio para comestibles de 350 ml</a></h5>
                                                    <p class="text-muted mb-0">$ 24,99 x 1</p>
                                                </td>

                                                <td class="text-end">
                                                    $ 24,99
                                                </td>

                                            </tr>
                                            <tr>
                                                <td class="fw-semibold" colspan="2" style="vertical-align: inherit;">
                                                    Subtotal:
                                                </td>
                                                <td class="fw-semibold text-end">S/359,96</td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">Descuento <span class="text-muted">(VELZON15)</span> :</td>
                                                <td class="text-end"> -$50.00</td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">Costo de envío :</td>
                                                <td class="text-end">$ 24,99</td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">Impuesto estimado (12%):</td>
                                                <td class="text-end">$ 18,20</td>
                                            </tr>
                                            <tr class="table-active">
                                                <th colspan="2" style="font-weight: bold;">
                                                    Total (USD):
                                                </th>

                                                <td class="text-end">
                                                    <span class="fw-semibold" style="font-size: 16px; color: #333;">$353.15</span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>


    <?php require_once("../modules/footer.php"); ?>
    </div>
    <?php require_once("../modules/js.php"); ?>

</body>

</html>