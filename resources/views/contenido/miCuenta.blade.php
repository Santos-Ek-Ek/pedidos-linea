<!DOCTYPE html>
<html lang="en">

    
<!-- Mirrored from uiparadox.co.uk/public/templates/royalfare/shop-list.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 04 Sep 2024 05:22:22 GMT -->
<head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="RoyalFare - Restaurant html template">

        <title>La Terraza</title>

        <!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="assets/media/favicon.png">

        <!-- All CSS files -->
        <link rel="stylesheet" href="assets/css/vendor/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/vendor/all.min.css">
        <link rel="stylesheet" href="assets/css/vendor/ion.rangeSlider.css">
        <link rel="stylesheet" href="assets/css/vendor/slick.css">
        <link rel="stylesheet" href="assets/css/vendor/slick-theme.css">
        <link rel="stylesheet" href="assets/css/vendor/nice-select.css">
        <link rel="stylesheet" href="assets/css/app.css">
        
    </head>
    <style>
        .account-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 30px 15px;
        }
        
        .account-card {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            padding: 30px;
            margin-bottom: 30px;
        }
        
        .account-header {
            display: flex;
            align-items: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 1px solid #eee;
        }
        
        .account-avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: #f5f5f5;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 20px;
            overflow: hidden;
        }
        
        .account-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .account-title {
            font-size: 24px;
            margin-bottom: 5px;
        }
        
        .account-subtitle {
            color: #777;
            font-size: 14px;
        }
        
        .account-section {
            margin-bottom: 30px;
        }
        
        .account-section-title {
            font-size: 18px;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .account-info-item {
            display: flex;
            margin-bottom: 15px;
        }
        
        .account-info-label {
            width: 150px;
            font-weight: 500;
            color: #555;
        }
        
        .account-info-value {
            flex: 1;
        }
        
        .order-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 0;
            border-bottom: 1px solid #eee;
        }
        
        .order-item:last-child {
            border-bottom: none;
        }
        
        .order-status {
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
        }
        
        .status-pending {
            background: #fff3cd;
            color: #856404;
        }
        
        .status-completed {
            background: #d4edda;
            color: #155724;
        }
        
        .status-cancelled {
            background: #f8d7da;
            color: #721c24;
        }
        
        .btn-edit {
            background: none;
            border: none;
            color: #007bff;
            cursor: pointer;
            padding: 0;
            font-size: 14px;
        }
        
        .btn-edit:hover {
            text-decoration: underline;
        }
        
        .account-actions {
            display: flex;
            gap: 15px;
            margin-top: 30px;
        }
        
        @media (max-width: 768px) {
            .account-header {
                flex-direction: column;
                text-align: center;
            }
            
            .account-avatar {
                margin-right: 0;
                margin-bottom: 15px;
            }
            
            .account-info-item {
                flex-direction: column;
            }
            
            .account-info-label {
                width: 100%;
                margin-bottom: 5px;
            }
            
            .order-item {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .order-details {
                margin-bottom: 10px;
            }
        }
    </style>
    <body id="body">
        <!-- Preloader -->
        <div id="preloader">
            <div class="loading">
                <span data-text="L">L</span>
                <span data-text="A">A</span>
                <span data-text="T">T</span>
                <span data-text="E">E</span>
                <span data-text="R">R</span>
                <span data-text="R">R</span>
                <span data-text="A">A</span>
                <span data-text="Z">Z</span>
                <span data-text="A">A</span>
            </div>
        </div>

        <!--  Begin scroll container -->
        <div id="smooth-wrapper">
            <div id="smooth-content" class="x-hidden">
                <main>
                    <!-- Hero Section Start -->
                    <section class="inner-page-banner">
                        <!-- Header start -->
                        <header id="ui-header">
                            <div class="ui-header-inner container-fluid"> 

                                <div class="ui-header-col">
                                    <!-- header Logo  -->
                                    <div class="ui-logo"> 
                                        <a href="">
                                            <img src="img/laterraza.png" class="ui-logo-light" alt="Logo"> <!-- logo light -->
                                            <img src="img/laterraza.png" class="ui-logo-dark" alt="Logo"> <!-- logo dark -->
                                        </a>
                                    </div>
                                </div>

                                <div class="ui-header-col">
                                    <!-- Begin overlay menu toggle button -->
                                    <div id="ui-ol-menu-toggle-btn-wrap">
                                        <div class="ui-ol-menu-toggle-btn-text">
                                            <span class="text-menu" data-hover="Abrir">Menu</span>
                                            <span class="text-close">Cerrar</span>
                                        </div>
                                        <div class="ui-ol-menu-toggle-btn-holder">
                                            <a href="#" class="ui-ol-menu-toggle-btn"><span></span></a>
                                        </div>
                                    </div>
                                    <!-- End overlay menu toggle button -->

                                    <!-- Begin overlay menu -->
                                    <nav class="ui-overlay-menu">
                                        <div class="ui-ol-menu-holder">
                                            <div class="ui-ol-menu-inner ui-wrap">
                                                <div class="">
                                                    <div class="container-fluid">
                                                        <div class="ui-ol-menu-content">
                                                            <div class="col-xxl-3 col-xl-3 col-lg-4 d-xl-block d-none">
                                                                <div class="ui-menu-img-block">
                                                                    <img src="assets/media/images/menu-img.png" alt="">
                                                                </div>
                                                            </div>
                                                            <div class="col-xxl-6 col-xl-5 col-md-6 ui-menu-nav">
                                                                <!-- Begin menu list -->
                                                                <ul class="ui-ol-menu-list">

                                                                    <li class="ui-ol-submenu-wrap">
                                                                        <!-- <div class="ui-ol-submenu-trigger">
                                                                            <a href="#">Inicio</a>
                                                                            <div class="ui-ol-submenu-caret-wrap">
                                                                                <div class="ui-ol-submenu-caret"></div>
                                                                            </div> 
                                                                        </div> -->
                                                                        <div class="ui-ol-submenu">
                                                                            <ul class="ui-ol-submenu-list">
                
                                                                                <!-- Begin submenu -->
                                                                                <li class="ui-ol-submenu-wrap">

                                                                                        <a href="inicio" class="ui-ol-submenu-link">Principal</a>


                                                                                </li>

                                                                                
                                                                            </ul>
                                                                        </div> 
                                                                    </li>

                                                                    <!-- Begin submenu (submenu master) -->
                                                                    <li class="ui-ol-submenu-wrap">
                                                                        <div class="ui-ol-submenu-trigger">
                                                                            <a href="#">Ventas</a>
                                                                            <div class="ui-ol-submenu-caret-wrap">
                                                                                <div class="ui-ol-submenu-caret"></div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="ui-ol-submenu">
                                                                            <ul class="ui-ol-submenu-list">
                
                                                                                <!-- Begin submenu -->
                                                                                <li class="ui-ol-submenu-wrap">

                                                                                        <a href="productosVenta" class="ui-ol-submenu-link">Productos</a>


                                                                                </li>

                                                                                
                                                                            </ul>
                                                                        </div> 
                                                                    </li>
                                                                    <!-- End submenu (sub-master) -->
                
                                                                    <li><a href="contactanos">Contactanos</a></li>
                
                                                                </ul>
                                                                <!-- End menu list -->
                                                            </div>
                                                            <div class="col-xxl-3 col-xl-3 col-md-6 d-md-block d-none">
                                                                <div class="company-info">
                                                                    <img src="assets/media/vector/menu-vector.png" alt="" class="vector">
                                                                    <div class="mb-32">
                                                                        <h6 class="color-primary mb-8">Horario</h6>
                                                                        <p class="lead dark-gray">Todos los dias de 09:00am a 11:00pm</p>
                                                                    </div>
                                                                    <div class="mb-32">
                                                                        <h6 class="mb-8">Contactanos</h6>
                                                                        <p class="lead dark-gray mb-16"><span><a href="tel:123456789">+52 999 109 6674</a></span></p>
                                                                        <a class="lead dark-gray mb-16" href="mailto:info@example.com">gilmereb37@gmail.com</a>
                                                                        <p class="lead dark-gray">Calle 21a X20 Y 22 Centro Cacalchén, Yucatán, México</p>
                                                                    </div>
                                                                    <!-- <ul class="social-icons-list unstyled">
                                                                        <li><a href="#"><img src="assets/media/icons/Facebook.svg" alt=""></a></li>
                                                                        <li><a href="#"><img src="assets/media/icons/Twitter.svg" alt=""></a></li>
                                                                        <li><a href="#"><img src="assets/media/icons/Instagram.svg" alt=""></a></li>
                                                                        <li><a href="#"><img src="assets/media/icons/Linkedin.svg" alt=""></a></li>
                                                                    </ul> -->
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> 
                                            </div> 
                                        </div> 

                                    </nav> 
                                    <!-- End overlay menu -->

                                    <!-- Being header tools -->
                                    <div class="ui-header-tools">
                                        @auth
    <div class="dropdown ui-header-tools-item">
        <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fa-regular fa-user"></i>
        </a>
        <ul class="dropdown-menu dropdown-menu-end">
            <li><a class="dropdown-item" href="miCuenta">Mi Cuenta</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="misCompras">Mis Compras</a></li>
            <li><hr class="dropdown-divider"></li>
            <li>
                <form method="POST" action="{{ route('logoutUser') }}">
                    @csrf
                    <button type="submit" class="dropdown-item">Cerrar Sesión</button>
                </form>
            </li>
        </ul>
    </div>
@else
    <a href="{{ route('loginUser') }}" class="ui-header-tools-item"><i class="fa-regular fa-user"></i></a>
@endauth
                                        <a href="carrito" class="ui-header-tools-item cart-button"><i class="fa-regular fa-cart-shopping"></i></a>
                                    </div>
                                    <!-- End header tools -->
                                </div> 

                            </div> 
                        </header>
                        <!-- Header End -->

                        <!-- Page Title Banner Start -->
                        <h2 class="page-title">Mi Cuenta</h2>
                        <!-- Page Title Banner End -->
                    </section>
                    <!-- Hero Section End -->  

                    <!-- Start Page Content -->
                    <div class="page-content">  
                    <div class="account-container">
                        <div class="account-card">
                            <div class="account-header">
                                <!-- <div class="account-avatar">
                                    <img src="assets/media/images/default-avatar.jpg" alt="Avatar del usuario">
                                </div> -->
                                <div>
                                    <h1 class="account-title">Bienvenido, {{ Auth::user()->name }}</h1>
                                   
                                </div>
                            </div>
                            
                            <div class="account-section">
                                <h2 class="account-section-title">
                                    Información Personal
                                    <button class="btn-edit" onclick="editPersonalInfo()">
                                        <i class="fas fa-edit"></i> Editar
                                    </button>
                                </h2>
                                
                                <div class="account-info">
                                    <div class="account-info-item">
                                        <div class="account-info-label">Nombre completo:</div>
                                        <div class="account-info-value" id="user-name">{{ Auth::user()->name }} {{ Auth::user()->lastname }}</div>
                                    </div>
                                    
                                    <div class="account-info-item">
                                        <div class="account-info-label">Correo electrónico:</div>
                                        <div class="account-info-value" id="user-email">{{ Auth::user()->email }}</div>
                                    </div>
                                    
                                    <div class="account-info-item">
                                        <div class="account-info-label">Teléfono:</div>
                                        <div class="account-info-value" id="user-phone">{{ Auth::user()->telefono ?? 'No proporcionado' }}</div>
                                    </div>
                                    
                                    <div class="account-info-item">
                                        <div class="account-info-label">Dirección:</div>
                                        <div class="account-info-value" id="user-address">
                                            {{ Auth::user()->direccion ?? 'No proporcionada' }} 
                                        </div>
                                    </div>

                                    <div class="account-info-item">
                                        <div class="account-info-label">Referencia de envío:</div>
                                        <div class="account-info-value" id="user-reference">
                                            {{ Auth::user()->referencia_envio ?? 'No proporcionada' }} 
                                        </div>
                                    </div>
                                </div>
                            </div>
                            

                            
                            <div class="account-actions">
                                <button class="btn btn-outline-primary" onclick="changePassword()">
                                    <i class="fas fa-lock"></i> Cambiar contraseña
                                </button>
                                <form method="POST" action="{{ route('logoutUser') }}">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-danger">
                                        <i class="fas fa-sign-out-alt"></i> Cerrar sesión
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                        </section>
                        <!-- Blogs Section End -->
                        
                    </div>  
                    <!-- End Page Content -->
                    <!-- Newsletter Section start  -->
                    <!-- Newsletter Section end  -->
        
                    <!-- Footer Area Start -->
                    <!-- Footer Area end -->
                </main>
            </div>
        </div>
        <!-- End scroll container -->

        <!-- Search Popup Start -->
        <div class="search-popup">
            <div class="search-popup__overlay search-toggler"></div>
            <div class="search-popup__content text-center">
                <form role="search" method="get" class="search-popup__form" action="https://uiparadox.co.uk/public/templates/royalfare/shop-list-1.html">
                    <div class="blur-layer">
                        <input type="text" id="search" autocomplete="off" placeholder="Search Here...">
                    </div>
                    <button type="submit"><i class="fal fa-search"></i></button>
                </form>
            </div>
        </div>
        <!-- Search Popup End -->

        <!-- Mini Cart Start -->
        <aside id="sidebar-cart">
    <div class="d-flex align-items-center justify-content-between mb-32">
        <h5>Tu carrito</h5>
        <a href="#" class="close-button"><i class="fa-regular fa-xmark close-icon"></i></a>
    </div>
    <div class="vr-line mb-32"></div>
    <ul class="product-list" id="cart-items">
        <!-- Los elementos del carrito se agregarán aquí dinámicamente -->
        <li class="empty-cart-message">Tu carrito está vacío</li>
    </ul>

    <div class="price-total mb-24">
        <h6>Subtotal</h6>
        <h5 class="color-primary" id="cart-subtotal">$0.00</h5>
    </div>
    <div class="vr-line mb-24"></div>
    <div class="action-buttons">
        <a href="carrito" class="cus-btn outline">
            <span class="icon-wrapper">
                <svg class="icon-svg" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                    <path d="M16.2522 11.9789C14.4658 10.1925 13.7513 6.14339 15.6567 4.23792M15.6567 4.23792C14.565 5.3296 11.4885 7.21521 7.91576 3.64246M15.6567 4.23792L4.34301 15.5516" stroke="#FCFDFD" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <svg class="icon-svg icon-svg-copy" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                    <path d="M16.2522 11.9789C14.4658 10.1925 13.7513 6.14339 15.6567 4.23792M15.6567 4.23792C14.565 5.3296 11.4885 7.21521 7.91576 3.64246M15.6567 4.23792L4.34301 15.5516" stroke="#FCFDFD" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </span>
            Ver carrito
        </a>
        <a href="checkout" class="cus-btn dark">
            <span class="icon-wrapper">
                <svg class="icon-svg" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                    <path d="M16.2522 11.9789C14.4658 10.1925 13.7513 6.14339 15.6567 4.23792M15.6567 4.23792C14.565 5.3296 11.4885 7.21521 7.91576 3.64246M15.6567 4.23792L4.34301 15.5516" stroke="#FCFDFD" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <svg class="icon-svg icon-svg-copy" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                    <path d="M16.2522 11.9789C14.4658 10.1925 13.7513 6.14339 15.6567 4.23792M15.6567 4.23792C14.565 5.3296 11.4885 7.21521 7.91576 3.64246M15.6567 4.23792L4.34301 15.5516" stroke="#FCFDFD" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </span>
            Pagar
        </a>
    </div>
</aside>
        <div id="sidebar-cart-curtain"></div>
        <!-- Mini Cart End -->

        <!-- Jquery Js -->
        <script src="assets/js/vendor/jquery-3.6.3.min.js"></script>
        <script src="assets/js/vendor/bootstrap.min.js"></script>
        <script src="assets/js/vendor/gsap.min.js"></script>
        <script src="assets/js/vendor/scrollTrigger.min.js"></script>
        <script src="assets/js/vendor/ScrollToPlugin.min.js"></script>
        <script src="assets/js/vendor/ScrollSmoother.min.js"></script>
        <script src="assets/js/vendor/jquery-appear.js"></script>
        <script src="assets/js/vendor/jquery-validator.js"></script>
        <script src="assets/js/vendor/ion.rangeSlider.js"></script>
        <script src="assets/js/vendor/jquery.nice-select.min.js"></script>
        <script src="assets/js/vendor/slick.min.js"></script>
        <script src="assets/js/app.js"></script>

        <script>
        // Función para editar información personal
        function editPersonalInfo() {
    // Obtener los valores actuales
    const name = document.getElementById('user-name')?.textContent || '';
    const email = document.getElementById('user-email')?.textContent || '';
    const phone = document.getElementById('user-phone')?.textContent || '';
    const address = document.getElementById('user-address')?.textContent || '';
    const reference = document.getElementById('user-reference')?.textContent || '';
    
    // Crear formulario de edición con validación de elementos
    const formHtml = `
        <form id="edit-info-form">
            <div class="mb-3">
                <label for="edit-name" class="form-label">Nombre completo</label>
                <input type="text" class="form-control" id="edit-name" value="${name}">
            </div>
            <div class="mb-3">
                <label for="edit-email" class="form-label">Correo electrónico</label>
                <input type="email" class="form-control" id="edit-email" value="${email}">
            </div>
            <div class="mb-3">
                <label for="edit-phone" class="form-label">Teléfono</label>
                <input type="tel" class="form-control" id="edit-phone" value="${phone === 'No proporcionado' ? '' : phone}">
            </div>
            <div class="mb-3">
                <label for="edit-address" class="form-label">Dirección</label>
                <textarea class="form-control" id="edit-address" rows="3">${address === 'No proporcionada' ? '' : address}</textarea>
            </div>
            <div class="mb-3">
                <label for="edit-reference" class="form-label">Referencia de envío</label>
                <textarea class="form-control" id="edit-reference" rows="3">${reference === 'No proporcionada' ? '' : reference}</textarea>
            </div>
            <div class="d-flex justify-content-end gap-2">
                <button type="button" class="btn btn-secondary" onclick="cancelEdit()">Cancelar</button>
                <button type="button" class="btn btn-primary" onclick="savePersonalInfo()">Guardar</button>
            </div>
        </form>
    `;
    
    // Reemplazar la sección de información con el formulario
    const accountInfoSection = document.querySelector('.account-info');
    if (accountInfoSection) {
        accountInfoSection.innerHTML = formHtml;
    } else {
        console.error('No se encontró la sección de información de la cuenta');
        showToast('Error al cargar el formulario de edición', true);
    }
}
        
        // Función para cancelar la edición
        function cancelEdit() {
            // Recargar la página para mostrar los datos originales
            location.reload();
        }
        
        function savePersonalInfo() {
    // Obtener los nuevos valores
    const newName = document.getElementById('edit-name').value;
    const newEmail = document.getElementById('edit-email').value;
    const newPhone = document.getElementById('edit-phone').value;
    const newAddress = document.getElementById('edit-address').value;
    const newReference = document.getElementById('edit-reference').value;
    
    // Validar campos obligatorios
    if (!newName || !newEmail) {
        showToast('Nombre y correo electrónico son campos obligatorios', true);
        return;
    }
    
    // Mostrar estado de carga
    const saveButton = document.querySelector('#edit-info-form button[onclick="savePersonalInfo()"]');
    const originalText = saveButton.innerHTML;
    saveButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Guardando...';
    saveButton.disabled = true;
    
    // Enviar datos al servidor
    fetch('{{ route("actualizar.perfil") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
        },
        body: JSON.stringify({
            name: newName,
            email: newEmail,
            phone: newPhone,
            address: newAddress,
            reference: newReference
        })
    })
    .then(response => {
        if (!response.ok) {
            return response.json().then(err => { throw err; });
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            showToast('Información actualizada correctamente');
            
            // Reconstruir la sección de información con los nuevos datos
            const accountInfoHTML = `
                <div class="account-info-item">
                    <div class="account-info-label">Nombre completo:</div>
                    <div class="account-info-value" id="user-name">${data.user.name}</div>
                </div>
                
                <div class="account-info-item">
                    <div class="account-info-label">Correo electrónico:</div>
                    <div class="account-info-value" id="user-email">${data.user.email}</div>
                </div>
                
                <div class="account-info-item">
                    <div class="account-info-label">Teléfono:</div>
                    <div class="account-info-value" id="user-phone">${data.user.telefono || 'No proporcionado'}</div>
                </div>
                
                <div class="account-info-item">
                    <div class="account-info-label">Dirección:</div>
                    <div class="account-info-value" id="user-address">
                        ${data.user.direccion || 'No proporcionada'}
                    </div>
                </div>

                <div class="account-info-item">
                    <div class="account-info-label">Referencia de envío:</div>
                    <div class="account-info-value" id="user-reference">
                        ${data.user.referencia_envio || 'No proporcionada'}
                    </div>
                </div>
            `;
            
            document.querySelector('.account-info').innerHTML = accountInfoHTML;
            
            // Volver a asignar el evento de edición
            document.querySelector('.account-section-title button').onclick = editPersonalInfo;
        } else {
            throw new Error(data.message || 'Error al actualizar');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showToast(error.message || 'Ocurrió un error al actualizar tu información', true);
    })
    .finally(() => {
        saveButton.innerHTML = originalText;
        saveButton.disabled = false;
    });
}
        
        // Función para cambiar contraseña
        function changePassword() {
            const modalHtml = `
                <div class="modal fade" id="changePasswordModal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Cambiar contraseña</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="change-password-form">
                                    <div class="mb-3">
                                        <label for="current-password" class="form-label">Contraseña actual</label>
                                        <input type="password" class="form-control" id="current-password" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="new-password" class="form-label">Nueva contraseña</label>
                                        <input type="password" class="form-control" id="new-password" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="confirm-password" class="form-label">Confirmar nueva contraseña</label>
                                        <input type="password" class="form-control" id="confirm-password" required>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <button type="button" class="btn btn-primary" onclick="submitPasswordChange()">Guardar cambios</button>
                            </div>
                        </div>
                    </div>
                </div>
            `;
            
            // Agregar el modal al body
            document.body.insertAdjacentHTML('beforeend', modalHtml);
            
            // Mostrar el modal
            const modal = new bootstrap.Modal(document.getElementById('changePasswordModal'));
            modal.show();
            
            // Eliminar el modal cuando se cierre
            document.getElementById('changePasswordModal').addEventListener('hidden.bs.modal', function() {
                this.remove();
            });
        }
        
        function submitPasswordChange() {
    const currentPassword = document.getElementById('current-password').value;
    const newPassword = document.getElementById('new-password').value;
    const confirmPassword = document.getElementById('confirm-password').value;
    
    // Validaciones básicas
    if (!currentPassword || !newPassword || !confirmPassword) {
        alert('Todos los campos son obligatorios');
        return;
    }
    
    if (newPassword !== confirmPassword) {
        alert('Las contraseñas nuevas no coinciden');
        return;
    }
    
    if (newPassword.length < 8) {
        alert('La contraseña debe tener al menos 8 caracteres');
        return;
    }

    // Mostrar loader
    const submitBtn = document.querySelector('#changePasswordModal button[onclick="submitPasswordChange()"]');
    const originalText = submitBtn.innerHTML;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Cambiando...';
    submitBtn.disabled = true;

    // Enviar al servidor
    fetch('{{ route("cambiar.contrasena") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
        },
        body: JSON.stringify({
            current_password: currentPassword,
            new_password: newPassword,
            new_password_confirmation: confirmPassword
        })
    })
    .then(response => {
        if (!response.ok) {
            return response.json().then(err => { throw err; });
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            showToast('Contraseña cambiada exitosamente');
            // Cerrar el modal
            bootstrap.Modal.getInstance(document.getElementById('changePasswordModal')).hide();
            // Limpiar el formulario
            document.getElementById('change-password-form').reset();
        } else {
            throw new Error(data.message || 'Error al cambiar la contraseña');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showToast(error.message || 'Error al cambiar la contraseña', true);
    })
    .finally(() => {
        submitBtn.innerHTML = originalText;
        submitBtn.disabled = false;
    });
}
    </script>

        <script>
// Carrito como array de objetos
let cart = [];
// Función para configurar los controles de cantidad en los productos
function setupQuantityControls() {
    // Primero eliminamos cualquier evento previo para evitar duplicados
    document.querySelectorAll('.quantity-wrap').forEach(wrap => {
        const input = wrap.querySelector('.number');
        const decrement = wrap.querySelector('.decrement');
        const increment = wrap.querySelector('.increment');
        
        // Clonamos los elementos para eliminar los event listeners
        const newDecrement = decrement.cloneNode(true);
        const newIncrement = increment.cloneNode(true);
        decrement.parentNode.replaceChild(newDecrement, decrement);
        increment.parentNode.replaceChild(newIncrement, increment);
    });

    // Ahora configuramos los controles correctamente
    document.querySelectorAll('.quantity-wrap').forEach(wrap => {
        const input = wrap.querySelector('.number');
        const decrement = wrap.querySelector('.decrement');
        const increment = wrap.querySelector('.increment');
        
        // Obtener valores mínimos y máximos
        const getMin = () => parseInt(input.getAttribute('min')) || 1;
        const getMax = () => {
            const productCard = wrap.closest('[data-available]');
            return productCard ? parseInt(productCard.dataset.available) : 
                  (parseInt(input.getAttribute('max')) || 999);
        };
        
        // Actualizar el valor del input respetando los límites
        const updateValue = (newValue) => {
            const min = getMin();
            const max = getMax();
            
            if (newValue < min) {
                input.value = min;
            } else if (newValue > max) {
                input.value = max;
                showToast(`No hay suficiente stock. Máximo: ${max}`, true);
            } else {
                input.value = newValue;
            }
        };
        
        // Evento para incrementar - con prevención de doble clic
        increment.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopImmediatePropagation(); // Prevenir otros manejadores del mismo evento
            updateValue(parseInt(input.value || getMin()) + 1);
        }, {once: false});
        
        // Evento para decrementar - con prevención de doble clic
        decrement.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopImmediatePropagation(); // Prevenir otros manejadores del mismo evento
            updateValue(parseInt(input.value || getMin()) - 1);
        }, {once: false});
        
        // Evento para cambios manuales
        input.addEventListener('change', function() {
            updateValue(parseInt(input.value) || getMin());
        });
        
        // Validación inicial
        updateValue(parseInt(input.value) || getMin());
    });
}
// Función para mostrar notificación tipo toast
function showToast(message, isError = false) {
    const toast = document.createElement('div');
    toast.className = `toast-notification ${isError ? 'error' : ''}`;
    toast.textContent = message;
    document.body.appendChild(toast);
    
    setTimeout(() => {
        toast.classList.add('fade-out');
        setTimeout(() => toast.remove(), 500);
    }, 3000);
}

// Función para guardar el carrito en localStorage
function saveCartToStorage() {
    if (cart.length > 0) {
        localStorage.setItem('shoppingCart', JSON.stringify(cart));
    } else {
        localStorage.removeItem('shoppingCart');
    }
    window.dispatchEvent(new Event('cartUpdated'));
}

// Función para cargar el carrito desde localStorage
function syncCartFromStorage() {
    const cartData = localStorage.getItem('shoppingCart');
    cart = cartData ? JSON.parse(cartData) : [];
    updateAvailableStock(); 
    updateCartView();
}

// Función para limpiar el carrito
function clearCart() {
    cart = [];
    localStorage.removeItem('shoppingCart');
    updateCartView();
    window.dispatchEvent(new Event('cartCleared'));
}

// Función para actualizar el stock disponible en los productos
function updateAvailableStock() {
    document.querySelectorAll('.product-list-card').forEach(card => {
        const productId = card.dataset.productId;
        const originalAvailable = parseInt(card.dataset.originalAvailable || card.dataset.available);

        if (!card.dataset.originalAvailable) {
            card.dataset.originalAvailable = originalAvailable;
        }
        
        
        // Calcular la cantidad total en el carrito para este producto
        let inCart = 0;
        cart.forEach(item => {
            if (item.id === productId) {
                inCart += item.quantity;
            }
        });
        
        // Calcular el nuevo disponible
        const newAvailable = originalAvailable - inCart;
        card.dataset.available = newAvailable;
        
        // Actualizar el input de cantidad
        const quantityInput = card.querySelector('.number');
        const decrementBtn = card.querySelector('.decrement');
        const incrementBtn = card.querySelector('.increment');
        const addToCartBtn = card.querySelector('.cart-button');
        const notaInput = card.querySelector('.nota-producto');
        if (quantityInput) {
            quantityInput.max = newAvailable;
            
            const isDisabled = newAvailable <= 0;
            
            quantityInput.disabled = isDisabled;
            if (decrementBtn) decrementBtn.disabled = isDisabled;
            if (incrementBtn) incrementBtn.disabled = isDisabled;
            if (notaInput) notaInput.disabled = isDisabled;
            if (addToCartBtn) {
                addToCartBtn.style.pointerEvents = isDisabled ? 'none' : 'auto';
                addToCartBtn.style.opacity = isDisabled ? '0.5' : '1';
                addToCartBtn.onclick = isDisabled ? null : function() { addToCart(this); };
            }
            
            // Mostrar mensaje si no hay stock
            const stockMessage = card.querySelector('.stock-message');
            if (isDisabled) {
                if (!stockMessage) {
                    const message = document.createElement('div');
                    message.className = 'stock-message text-danger mt-2';
                    message.textContent = 'Agotado';
                    const actionBlock = card.querySelector('.action-block');
                    if (actionBlock) {
                        actionBlock.appendChild(message);
                    }
                }
            } else if (stockMessage) {
                stockMessage.remove();
            }
        }
    });
}

// Función para añadir producto al carrito con validación de stock
function addToCart(button) {
    const productCard = button.closest('.product-list-card');
    const productId = productCard.dataset.productId;
    const productName = productCard.querySelector('.title').textContent;
    const productPrice = parseFloat(productCard.dataset.price);
    const quantityInput = productCard.querySelector('.number');
    const quantity = parseInt(quantityInput.value);
    const availableStock = parseInt(productCard.dataset.available);
    const nota = productCard.querySelector('.nota-producto').value;
    const productImage = productCard.querySelector('img').src;

    // Validar stock disponible
    if (quantity > availableStock) {
        showToast(`No hay suficiente stock. Solo quedan ${availableStock} unidades disponibles.`, true);
        quantityInput.value = availableStock > 0 ? availableStock : 1;
        return;
    }


    if (!productCard.dataset.originalAvailable) {
        productCard.dataset.originalAvailable = availableStock;
    }
    // Buscar producto existente con la misma nota
    const existingIndex = cart.findIndex(item => 
        item.id === productId && item.nota === nota
    );
    if (existingIndex >= 0) {
        // Verificar stock al actualizar cantidad
        const newTotalQuantity = cart[existingIndex].quantity + quantity;
        if (newTotalQuantity > cart[existingIndex].maxQuantity) {
            const available = cart[existingIndex].maxQuantity - cart[existingIndex].quantity;
            showToast(`Solo puedes agregar ${available} unidades más de este producto.`, true);
            return;
        }
        cart[existingIndex].quantity = newTotalQuantity;
    } else {
        cart.push({
            id: productId,
            name: productName,
            price: productPrice,
            quantity: quantity,
            image: productImage,
            nota: nota,
            maxQuantity: availableStock // Guardamos el stock máximo
        });
    }
    updateAvailableStock(); 
    updateCartView();
    saveCartToStorage();
    showToast(`${productName} añadido al carrito (${quantity} unidades)`);
}

// Función para actualizar la vista del carrito
function updateCartView() {
    const cartItemsContainer = document.getElementById('cart-items');
    const subtotalElement = document.getElementById('cart-subtotal');
    const cartCountElement = document.getElementById('cart-count');
    
    cartItemsContainer.innerHTML = '';
    
    if (cart.length === 0) {
        cartItemsContainer.innerHTML = '<li class="empty-cart-message">Tu carrito está vacío</li>';
        subtotalElement.textContent = '$0.00';
        if (cartCountElement) cartCountElement.textContent = '0';
        return;
    }
    
    let subtotal = 0;
    let totalItems = 0;
    
    cart.forEach((product, index) => {
        const productTotal = product.price * product.quantity;
        subtotal += productTotal;
        totalItems += product.quantity;
        
        const productItem = document.createElement('li');
        productItem.className = 'product-item mb-24';
        productItem.innerHTML = `
            <a href="">
                <span class="item-image">
                    <img src="${product.image}" alt="${product.name}">
                </span>
            </a>
            <div class="product-text">
                <a href="">
                    <h6 class="mb-16 dark-gray">${product.name}</h6>
                    ${product.nota ? `<span class="nota-especial">Nota: ${product.nota}</span>` : ''}
                </a>
                <div class="qp_row">
                    <div class="quantity quantity-wrap">
                        <div class="decrement" onclick="updateCartQuantity(${index}, -1)"><i class="fa-solid fa-dash"></i></div>
                        <input type="number" name="quantity" value="${product.quantity}" min="1" 
                               max="${product.maxQuantity}" class="number" id="cart-qty-${index}"
                               onchange="validateCartQuantity(${index}, this)">
                        <div class="increment" onclick="updateCartQuantity(${index}, 1)"><i class="fa-solid fa-plus-large"></i></div>
                    </div>
                    <h5 class="dark-gray">$${productTotal.toFixed(2)}</h5>
                    <button class="remove-item" onclick="removeFromCart(${index})"><i class="fa-solid fa-trash"></i></button>
                </div>
            </div>
        `;
        
        cartItemsContainer.appendChild(productItem);
        
        if (index < cart.length - 1) {
            const divider = document.createElement('li');
            divider.className = 'vr-line mb-24';
            cartItemsContainer.appendChild(divider);
        }
    });
    
    subtotalElement.textContent = `$${subtotal.toFixed(2)}`;
    if (cartCountElement) cartCountElement.textContent = totalItems.toString();
}

// Función para validar cantidad manualmente ingresada
function validateCartQuantity(index, input) {
    const value = parseInt(input.value);
    const max = parseInt(input.max);
    
    if (isNaN(value)) {
        input.value = 1;
    } else if (value < 1) {
        input.value = 1;
    } else if (value > max) {
        input.value = max;
        showToast(`No puedes pedir más de ${max} unidades de este producto.`, true);
    }
    
    cart[index].quantity = parseInt(input.value);
    updateCartView();
    saveCartToStorage();
}

// Función para actualizar cantidad en el carrito
function updateCartQuantity(index, change) {
    const newQuantity = cart[index].quantity + change;
    const maxQuantity = cart[index].maxQuantity;
    
    if (newQuantity < 1) return;
    
    if (newQuantity > maxQuantity) {
        showToast(`No puedes pedir más de ${maxQuantity} unidades de este producto.`, true);
        return;
    }
    
    cart[index].quantity = newQuantity;
    updateAvailableStock();
    updateCartView();
    saveCartToStorage();
}

// Función para eliminar producto del carrito
function removeFromCart(index) {
    if (confirm('¿Estás seguro de que quieres eliminar este producto del carrito?')) {
        cart.splice(index, 1);
        updateAvailableStock();
        updateCartView();
        saveCartToStorage();
        showToast('Producto eliminado del carrito');
    }
}



// Inicialización del carrito
document.addEventListener('DOMContentLoaded', function() {
    // Limpiar carrito si viene de checkout
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has('clearCart')) {
        clearCart();
        window.history.replaceState({}, document.title, window.location.pathname);
    }
    updateAvailableStock(); 
    syncCartFromStorage();
    setupQuantityControls();
    
    // Escuchar eventos de storage entre pestañas
    window.addEventListener('storage', function(event) {
        if (event.key === 'shoppingCart') {
            syncCartFromStorage();
        }
    });
    
    // Escuchar eventos personalizados
    window.addEventListener('cartUpdated', syncCartFromStorage);
    window.addEventListener('cartCleared', syncCartFromStorage);
});

// Función para proceder al checkout con validación de stock
function proceedToCheckout() {
    if (cart.length === 0) {
        showToast('Tu carrito está vacío', true);
        return;
    }
    
    // Validar stock antes de proceder
    const outOfStockItems = cart.filter(item => item.quantity > item.maxQuantity);
    
    if (outOfStockItems.length > 0) {
        showToast('Algunos productos exceden el stock disponible. Ajusta las cantidades.', true);
        return;
    }
    
    // Guardar carrito temporalmente para el checkout
    sessionStorage.setItem('checkoutCart', JSON.stringify(cart));
    window.location.href = '/checkout';
}
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Elementos del DOM
    const priceMinInput = document.getElementById('price-min');
    const priceMaxInput = document.getElementById('price-max');
    const applyFilterBtn = document.getElementById('apply-filter');
    const resetFilterBtn = document.getElementById('reset-filter');
    const productListContainer = document.getElementById('product-list-container');
    const products = Array.from(document.querySelectorAll('.product-list-card'));
    const categoryCheckboxes = document.querySelectorAll('.filter-checkbox input[type="checkbox"]');
    const searchInput = document.getElementById('searchInput');
    
    // Establecer el valor máximo inicial
    if (products.length > 0) {
        const maxPrice = Math.max(...products.map(p => parseFloat(p.dataset.price)));
        priceMaxInput.value = maxPrice;
        priceMaxInput.setAttribute('max', maxPrice);
        priceMinInput.setAttribute('max', maxPrice);
    }
    
    // Validación de inputs
    priceMinInput.addEventListener('input', function() {
        if (parseFloat(this.value) > parseFloat(priceMaxInput.value)) {
            this.value = priceMaxInput.value;
        }
    });
    
    priceMaxInput.addEventListener('input', function() {
        if (parseFloat(this.value) < parseFloat(priceMinInput.value)) {
            this.value = priceMinInput.value;
        }
    });
    
    // Función para obtener las categorías seleccionadas
    function getSelectedCategories() {
        const selected = [];
        categoryCheckboxes.forEach(checkbox => {
            if (checkbox.checked) {
                selected.push(checkbox.nextElementSibling.textContent.trim());
            }
        });
        return selected;
    }
    
    // Función para filtrar productos
    function filterProducts() {
        const minPrice = parseFloat(priceMinInput.value) || 0;
        const maxPrice = parseFloat(priceMaxInput.value) || Infinity;
        const selectedCategories = getSelectedCategories();
        const searchTerm = searchInput.value.toLowerCase();
        
        products.forEach(product => {
            const productPrice = parseFloat(product.dataset.price);
            const productName = product.querySelector('.title').textContent.toLowerCase();
            const productDesc = product.querySelector('.desc').textContent.toLowerCase();
            const productCategory = product.getAttribute('data-category') || '';
            
            // Verificar filtros
            const priceMatch = productPrice >= minPrice && productPrice <= maxPrice;
            const categoryMatch = selectedCategories.length === 0 || 
                                 selectedCategories.includes(productCategory);
            const searchMatch = searchTerm === '' || 
                               productName.includes(searchTerm) || 
                               productDesc.includes(searchTerm);
            
            if (priceMatch && categoryMatch && searchMatch) {
                product.style.display = '';
            } else {
                product.style.display = 'none';
            }
        });
    }
    
    // Función para restablecer el filtro
    function resetFilter() {
        priceMinInput.value = 0;
        if (products.length > 0) {
            const maxPrice = Math.max(...products.map(p => parseFloat(p.dataset.price)));
            priceMaxInput.value = maxPrice;
        } else {
            priceMaxInput.value = 0;
        }
        
        // Desmarcar todos los checkboxes de categoría
        categoryCheckboxes.forEach(checkbox => {
            checkbox.checked = false;
        });
        
        // Limpiar búsqueda
        searchInput.value = '';
        
        // Mostrar todos los productos
        products.forEach(product => {
            product.style.display = '';
        });
    }
    
    // Event listeners
    applyFilterBtn.addEventListener('click', filterProducts);
    resetFilterBtn.addEventListener('click', resetFilter);
    
    // Filtrar al cambiar categorías
    categoryCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', filterProducts);
    });
    
    // Filtrar al buscar
    searchInput.addEventListener('input', filterProducts);
});

</script>

<style>
/* Estilos para mejorar la experiencia del filtro */
.price-control-row {
    display: flex;
    gap: 15px;
    margin-bottom: 15px;
}

.price-control {
    flex: 1;
}

.price-control label {
    display: block;
    margin-bottom: 5px;
    font-weight: 500;
}

.price-control input {
    width: 100%;
    padding: 8px 12px;
    border: 1px solid #ddd;
    border-radius: 4px;
}

#apply-filter, #reset-filter {
    width: 100%;
    margin-top: 10px;
}

.product-list-card[style*="display: none"] {
    display: none !important;
}

.mt-2 {
    margin-top: 8px;
}
.nota-especial {
    display: block;
    font-size: 12px;
    color: #666;
    margin-bottom: 8px;
    font-style: italic;
}
</style>


<style>
    .quantity-wrap {
    display: flex;
    align-items: center;
    border: 1px solid #ddd;
    border-radius: 4px;
    overflow: hidden;
    width: fit-content;
}

.quantity-wrap button {
    padding: 8px 12px;
    background: #f5f5f5;
    border: none;
    cursor: pointer;
    font-size: 16px;
    transition: background 0.2s;
}

.quantity-wrap button:hover {
    background: #e0e0e0;
}

.quantity-wrap button:disabled {
    opacity: 0.5;
    cursor: not-allowed;
    background: #f5f5f5;
}

.quantity-wrap .number {
    width: 50px;
    text-align: center;
    border: none;
    border-left: 1px solid #ddd;
    border-right: 1px solid #ddd;
    padding: 8px 0;
    -moz-appearance: textfield;
    font-size: 16px;
}

.quantity-wrap .number::-webkit-outer-spin-button,
.quantity-wrap .number::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}
.empty-cart-message {
    text-align: center;
    padding: 20px;
    color: #666;
}

.remove-item {
    background: none;
    border: none;
    color: #ff4444;
    cursor: pointer;
    margin-left: 10px;
}

.remove-item:hover {
    color: #cc0000;
}

.qp_row {
    display: flex;
    align-items: center;
    gap: 15px;
}
</style>

    </body>


<!-- Mirrored from uiparadox.co.uk/public/templates/royalfare/shop-list.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 04 Sep 2024 05:22:23 GMT -->
</html>
