<!DOCTYPE html>
<html lang="en">
<?php include 'fragmentos/header.php'; ?>

<body>
    <!-- Estructura de checkout -->
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 scrollable">
                <!--  Selector de envio-->
                <div class="container mt-5">
                    <h2>Entrega</h2>
                    <table class="table">
                        <tbody>
                            <tr>
                                <td>
                                    <label class="form-check">
                                        <input class="form-check-input" type="radio" name="options" id="envio" onclick="toggleOptions(this)" data-target="#info-envio">
                                        <span class="form-check-label">Envío</span>
                                        <i class="fas fa-truck float-end"></i>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label class="form-check">
                                        <input class="form-check-input" type="radio" name="options" id="recoger" onclick="toggleOptions(this)" data-target="#info-recoger">
                                        <span class="form-check-label">Recoger en tienda</span>
                                        <i class="fas fa-store float-end"></i>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label class="form-check">
                                        <input class="form-check-input" type="radio" name="options" id="uber" onclick="toggleOptions(this)" data-target="#info-uber">
                                        <span class="form-check-label">Uber</span>
                                        <i class="fas fa-car float-end"></i>
                                    </label>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <!-- Envio -->
                    <div id="info-envio" class="collapse mt-3">
                        <form>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="fullName" placeholder=" ">
                                <label for="fullName">Nombre Completo</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" id="email" placeholder=" ">
                                <label for="email">Correo Electrónico</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="tel" class="form-control" id="phone" placeholder=" ">
                                <label for="phone">Teléfono</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="address" placeholder=" ">
                                <label for="address">Dirección</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="address2" placeholder=" ">
                                <label for="address2">Dirección 2 (opcional)</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="city" placeholder=" ">
                                <label for="city">Ciudad</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="state" placeholder=" ">
                                <label for="state">Estado/Provincia</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="zip" placeholder=" ">
                                <label for="zip">Código Postal</label>
                            </div>
                            <div class="form-floating mb-3">
                                <select class="form-select" id="country" required>
                                    <option value="">Seleccione un país...</option>
                                    <option value="es">España</option>
                                    <option value="mx">México</option>
                                    <option value="us">Estados Unidos</option>
                                    <option value="ar">Argentina</option>
                                </select>
                                <label for="country">País</label>
                            </div>
                        </form>

                    </div>
                    <!-- Recoger en tienda -->
                    <div id="info-recoger" class="collapse mt-3">
                        <div class="row" style="border: 1px solid #ccc; border-radius: 5px; padding: 10px;">
                            <div class="col-6">
                                <h5 class="mb-1" style="font-size: 14px;">Nissarana Belleza <span class="text-muted" id="distance">(Calculando...)</span></h5>
                                <p class="mb-0" style="font-size: 12px;">18 Calle del Correo Mayor, Ciudad de México DF</p>
                            </div>
                            <div class="col-6 text-end">
                                <h5 class="mb-1" style="font-size: 14px;">Gratis</h5>
                                <p class="mb-0" style="font-size: 12px;">Normalmente está listo en 24 horas</p>
                            </div>
                        </div>

                    </div>
                    <!-- UBER -->
                    <div id="info-uber" class="collapse mt-3">
                        <div class="row" style="border: 1px solid #ccc; border-radius: 5px; padding: 10px;">
                            <div class="col-6">
                                <h5 class="mb-1" style="font-size: 14px;">Uber</h5>
                                <p class="mb-0" style="font-size: 12px;">Horario: Disponible de 9:00 AM a 9:00 PM</p>
                            </div>

                            <div class="col-6 text-end">
                                <h5 class="mb-1" style="font-size: 14px;">Gratis</h5>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Botones de Pago -->
                <div class="d-flex justify-content-center mb-3 mt-4">
                    <div class="text-center">
                        <button type="button" class="btn" style="background-color: #FFC439; color: #003087; border: 1px solid #003087; height: 50px; width: 250px;" id="paypal-button">
                            <i class="fab fa-paypal me-2"></i><span class="fw-bold">PayPal</span>
                        </button>
                    </div>

                </div>

                <button type="button" class="btn btn-success" id="transfer-button">Pago con Transferencia</button>

                <br>
                <br>


                <!-- Modal de Pago PayPal -->
                <div class="modal fade" id="payPalModal" tabindex="-1" aria-labelledby="payPalModalLabel" aria-hidden="true">
                    <div class="modal-dialog poppins-regular">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="payPalModalLabel"><i class="fa-brands fa-paypal"></i> Pago PayPal</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div id="paypal-button-container"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">

                <!-- Resumen de pedido -->
                <div class="sticky-top" style="background-color: white; z-index: 1020;">
                    <ul id="cart-items" class="list-group mb-3"></ul>
                    <div class="mb-3">
                        <strong>Total: $<span id="total-amount">0.00</span></strong>
                    </div>
                </div>
            </div>

        </div>
    </div>


    <script src="https://www.paypal.com/sdk/js?client-id=AUw6zSxW398baJ_-z5wRipGoCut-mmcFC1Kc37haJrPbii-WXgWK-2K1BBrPFm3d-oadaw7Yldf5Fgmy&currency=MXN"></script>

    <script>
        //FUNCION MAPA DISTANCIA:
        function calculateDistance() {
            var origin = 'C. la Verdolaga 308, Benito Juárez, 57000 Cdad. Nezahualcóyotl, Méx.';
            var destination = '18 Calle del Correo Mayor, Ciudad de México DF';
            var service = new google.maps.DistanceMatrixService();

            service.getDistanceMatrix({
                origins: [origin],
                destinations: [destination],
                travelMode: 'DRIVING',
                unitSystem: google.maps.UnitSystem.METRIC,
            }, callback);
        }

        function callback(response, status) {
            if (status === 'OK') {
                var distance = response.rows[0].elements[0].distance.text;
                document.getElementById('distance').innerText = `(${distance})`;
            } else {
                console.error('Error: ' + status);
            }
        }

        // Llama a la función al cargar la página
        window.onload = calculateDistance;

        function toggleOptions(selected) {
            // Ocultar todos los divs de información
            const infos = document.querySelectorAll('.collapse');
            infos.forEach(info => info.classList.remove('show'));

            // Mostrar solo la información correspondiente
            const targetId = selected.getAttribute('data-target');
            const targetInfo = document.querySelector(targetId);
            targetInfo.classList.add('show');
        }

        document.getElementById('paypal-button').addEventListener('click', function() {
            new bootstrap.Modal(document.getElementById('payPalModal')).show();
        });

        document.getElementById('transfer-button').addEventListener('click', function() {
            const total = document.getElementById('total-amount').innerText;
            const cartItems = JSON.parse(localStorage.getItem('cart')) || [];
            const encodedCartItems = encodeURIComponent(JSON.stringify(cartItems));
            window.location.href = 'pagoTran.php?total=' + total + '&cart=' + encodedCartItems;
        });

        function updateOrderAndRedirect(details) {
            const cartItems = JSON.parse(localStorage.getItem('cart')) || [];
            fetch('controlador/save_orderP.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        order_id: details.id,
                        name: details.payer.name.given_name + ' ' + details.payer.name.surname,
                        email: details.payer.email_address,
                        phone: '', // PayPal no proporciona número de teléfono
                        num_card: '', // No se proporciona número de tarjeta
                        total: details.purchase_units[0].amount.value,
                        order_date: new Date().toISOString().slice(0, 19).replace('T', ' '),
                        status_venta: 'pagado',
                        metodo_pago: 'paypal',
                        cart_items: cartItems
                    })
                })
                .then(response => response.json()) // Cambiado de response.text() a response.json()
                .then(data => {
                    console.log(data); // Añade esta línea para ver la respuesta completa
                    if (data.status === 'success') {
                        window.location.href = 'confirmation.php';
                    } else {
                        alert('Error al guardar el pedido: ' + (data.message || 'Error desconocido'));
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error al guardar el pedido.');
                });
        }

        paypal.Buttons({
            style: {
                color: 'blue',
                shape: 'pill',
                label: 'pay'
            },
            createOrder: function(data, actions) {
                const total = document.getElementById('total-amount').innerText;
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: total
                        }
                    }]
                });
            },
            onApprove: function(data, actions) {
                return actions.order.capture().then(function(details) {
                    updateOrderAndRedirect(details, 'confirmation.php');
                });
            },
            onCancel: function(data) {
                alert("Pago Cancelado");
                console.log(data);
            }
        }).render('#paypal-button-container');
    </script>

    <!-- CARRITO DE COMPRAS -->
    <?php include 'fragmentos/OffCart.php'; ?>

    <!-- FOOTER -->
    <?php include 'fragmentos/footer.php'; ?>