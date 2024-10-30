<?php include 'fragmentos/header.php'; ?>

<div class="container mt-4">
    <?php
    require "modelo/conexion.php";

    // Obtener el ID del producto desde la URL
    $productId = isset($_GET['id']) ? intval($_GET['id']) : 0;

    // Consulta para obtener el producto específico
    $productoSql = $conexion->query("SELECT p.*, c.category_name FROM products p JOIN categories c ON p.category_id = c.category_id WHERE p.product_id = $productId");

    if ($productoSql->num_rows > 0) {
        $producto = $productoSql->fetch_object();
    ?>
        <div class="row">
            <div class="col-md-6">
                <img src="<?= htmlspecialchars($producto->product_image) ?>" class="img-fluid" alt="<?= htmlspecialchars($producto->product_name) ?>">
            </div>
            <div class="col-md-6">
                <h2 class="mb-3 mt-md-5"><?= htmlspecialchars($producto->product_name) ?></h2>
                <h4 class="mb-3">$<?= htmlspecialchars($producto->product_price) ?> MXN</h4>
                <p><?= htmlspecialchars($producto->product_description) ?></p>

                <!-- Tabla de Tallas -->
                <div class="mb-4">
                    <a href="#" class="text-dark" data-bs-toggle="modal" data-bs-target="#sizeChartModal">☻ Tabla de Tallas</a>
                </div>

                <!-- Selector de Tallas -->
                <div class="mb-4">
                    <span class="me-2">Talla:</span>
                    <button class="btn btn-outline-dark me-1">S</button>
                    <button class="btn btn-outline-dark me-1">M</button>
                    <button class="btn btn-outline-dark me-1">L</button>
                    <button class="btn btn-outline-dark me-1">XL</button>
                    <button class="btn btn-outline-dark">XXL</button>
                </div>

                <button class="btn btn-outline-dark add-to-cart btn-lg mb-4 fw-bold w-100" type="button" data-id="<?= htmlspecialchars($producto->product_id) ?>" data-name="<?= htmlspecialchars($producto->product_name) ?>" data-price="<?= htmlspecialchars($producto->product_price) ?>" data-image="<?= htmlspecialchars($producto->product_image) ?>">
                    <i class="fa-solid fa-bag-shopping"></i> Agregar al Carrito
                </button>


                <!-- Descripción y Detalles -->
                <div class="accordion mb-1" id="productAccordion">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingDescription">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseDescription" aria-expanded="true" aria-controls="collapseDescription">
                                Descripción
                            </button>
                        </h2>
                        <div id="collapseDescription" class="accordion-collapse collapse show" aria-labelledby="headingDescription" data-bs-parent="#productAccordion">
                            <div class="accordion-body">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus lacinia odio vitae vestibulum.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingDetails">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseDetails" aria-expanded="false" aria-controls="collapseDetails">
                                Detalles
                            </button>
                        </h2>
                        <div id="collapseDetails" class="accordion-collapse collapse" aria-labelledby="headingDetails" data-bs-parent="#productAccordion">
                            <div class="accordion-body">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Carrusel de Productos Sugeridos -->
        <h3 class="mt-5 mb-3">Productos Sugeridos</h3>

        <!-- Carrusel para vista móvil -->
        <div id="suggestedProductsCarousel" class="carousel slide d-md-none" data-bs-ride="carousel">
            <div class="carousel-inner">
                <?php
                // Obtener productos aleatorios, excluyendo el producto actual
                $productosSql = $conexion->query("SELECT * FROM products WHERE product_id != $productId ORDER BY RAND() LIMIT 8");
                $activeClass = 'active';
                while ($datos = $productosSql->fetch_object()) { ?>
                    <div class="carousel-item <?= $activeClass ?>">
                        <div class="d-flex justify-content-center">
                            <div class="card text-center border-0 shadow-sm" style="width: 80%;">
                                <a href="producto.php?id=<?= htmlspecialchars($datos->product_id) ?>" class="text-decoration-none">
                                    <img src="<?= htmlspecialchars($datos->product_image) ?>" class="card-img-top" alt="<?= htmlspecialchars($datos->product_name) ?>">
                                </a>
                                <div class="card-body">
                                    <h5 class="card-title">
                                        <a href="producto.php?id=<?= htmlspecialchars($datos->product_id) ?>" class="text-dark text-decoration-none">
                                            <?= htmlspecialchars($datos->product_name) ?>
                                        </a>
                                    </h5>
                                    <h6 class="card-price mb-0">$<?= htmlspecialchars($datos->product_price) ?></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                    $activeClass = ''; // Desactivar la clase activa después de la primera
                } ?>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#suggestedProductsCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#suggestedProductsCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

        <!-- Tarjetas de Productos para vista de escritorio -->
        <div class="row gx-4 gy-4 d-none d-md-flex">
            <?php
            // Resetear el puntero a la consulta
            $productosSql->data_seek(0);
            while ($datos = $productosSql->fetch_object()) { ?>
                <div class="col-6 col-md-4 col-lg-3 product-card fira-sans-medium" data-category="<?= htmlspecialchars($datos->category_id) ?>">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="d-flex justify-content-center align-items-center" style="min-height: 250px;">
                            <a href="producto.php?id=<?= htmlspecialchars($datos->product_id) ?>" class="text-decoration-none">
                                <img src="<?= htmlspecialchars($datos->product_image) ?>" class="card-img-top img-fluid w-100" alt="<?= htmlspecialchars($datos->product_name) ?>">
                            </a>
                        </div>
                        <div class="card-body text-start">
                            <h5 class="card-title">
                                <a href="producto.php?id=<?= htmlspecialchars($datos->product_id) ?>" class="text-dark text-decoration-none">
                                    <?= htmlspecialchars($datos->product_name) ?>
                                </a>
                            </h5>
                            <p class="card-text mb-3"><?= htmlspecialchars($datos->product_description) ?></p>
                            <div class="d-flex justify-content-between align-items-center">
                                <h6 class="card-price mb-0">$<?= htmlspecialchars($datos->product_price) ?></h6>
                                <button class="btn btn-outline-dark add-to-cart" type="button" data-id="<?= htmlspecialchars($datos->product_id) ?>" data-name="<?= htmlspecialchars($datos->product_name) ?>" data-price="<?= htmlspecialchars($datos->product_price) ?>" data-image="<?= htmlspecialchars($datos->product_image) ?>">
                                    <i class="fa-solid fa-bag-shopping"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>

        <!-- Botón para regresar a la lista de productos -->
        <div class="d-flex justify-content-center mt-5">
            <a href="index.php" class="btn btn-outline-dark fw-bold" style="width: calc(200px + 10rem);"> <!-- Ajusta el tamaño según los botones de tallas -->
                <i class="fa-solid fa-arrow-left"></i> Volver a la colección
            </a>
        </div>



    <?php
    } else {
        echo "<p>Producto no encontrado.</p>";
    }
    ?>
</div>

<!-- Modal para Tabla de Tallas -->
<div class="modal fade" id="sizeChartModal" tabindex="-1" aria-labelledby="sizeChartModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="sizeChartModalLabel">Tabla de Tallas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img src="ruta/a/tu/imágen.jpg" class="img-fluid" alt="Tabla de Tallas">
            </div>
        </div>
    </div>
</div>

<!-- CARRITO DE COMPRAS -->
<?php include 'fragmentos/OffCart.php'; ?>

<!-- FOOTER -->
<?php include 'fragmentos/footer.php'; ?>