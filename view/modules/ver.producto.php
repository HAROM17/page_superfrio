<div class="modal fade tp-product-modal" id="producQuickViewModal" tabindex="-1" aria-labelledby="producQuickViewModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="tp-product-modal-content d-lg-flex align-items-start">
                <button type="button" class="tp-product-modal-close-btn" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fa-regular fa-xmark"></i>
                </button>

                <div class="tp-product-details-thumb-wrapper tp-tab d-sm-flex">
                    <div class="tab-content m-img" id="productDetailsNavContent">
                        <div class="tab-pane fade show active" id="nav-1" role="tabpanel" aria-labelledby="nav-1-tab" tabindex="0">
                            <div class="tp-product-details-nav-main-thumb">
                                <img src="" alt="Imagen del producto">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tp-product-details-wrapper">
                    <h5 class="tp-product-details-category" id="categoria">categoria</h5>
                    <div class="tp-product-details-category" >
                        <span id="subcatnom">sub cat nom</span>
                    </div>

                    <h3 class="tp-product-details-title" id="sabor">sabor</h3>

                    <!-- inventory details -->

                    <div class="tp-product-details-inventory d-flex align-items-center mb-10">
                        <div class="tp-product-details-stock mb-10">
                            <span>In Stock</span>
                        </div>

                        <div class="tp-product-details-rating-wrapper d-flex align-items-center mb-10">
                            <div class="tp-product-details-rating">
                                <span><i class="fa-solid fa-star"></i></span>
                                <span><i class="fa-solid fa-star"></i></span>
                                <span><i class="fa-solid fa-star"></i></span>
                                <span><i class="fa-solid fa-star"></i></span>
                                <span><i class="fa-solid fa-star-half-stroke"></i></span>
                            </div>
                            <div class="tp-product-details-reviews">
                                <span>(36 Reviews)</span>
                            </div>
                        </div>
                    </div>

                    <p id="productDescription">
                        descripcion
                    </p>


                    <!-- price -->

                    <div class="tp-product-details-price-wrapper mb-20">
                        <span class="tp-product-details-price new-price" id="precio">S/ 1.00</span>
                    </div>


                    <div class="tp-product-details-action-wrapper">
                        <h3 class="tp-product-details-action-title">Cantidad</h3>

                        <div class="tp-product-details-action-item-wrapper d-sm-flex align-items-center">
                            <div class="tp-product-details-quantity">
                                <div class="tp-product-quantity mb-15 mr-15">
                                    <span class="tp-cart-minus">
                                        <svg width="11" height="2" viewBox="0 0 11 2" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M1 1H10" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                                    </span>

                                    <input class="tp-cart-input" type="text" value="1"></input>

                                    <span class="tp-cart-plus">
                                        <svg width="11" height="12" viewBox="0 0 11 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M1 6H10" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M5.5 10.5V1.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                                    </span>
                                </div>
                            </div>

                            <div class="tp-product-details-add-to-cart mb-15 w-100">
                                <button class="tp-product-details-add-to-cart-btn w-100">Agregar al Carrito</button>
                            </div>
                        </div>

                        <button class="tp-product-details-buy-now-btn w-100">Comprar Ahora</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>