<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <base href="<?php echo BASE_URL ?>" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  <title>Tienda Computacion</title>
</head>

<body>
  <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Tienda de Computacion</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Home</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Menu
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="home">Home</a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item" href="vendedores">Vendedores</a></li>
              <li><a class="dropdown-item" href="nuevoVendedor">Nuevo vendedor</a></li>

            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="venta">Ventas</a></li>
            <li>  <?php if (isset($_SESSION['USER_ROLE']) && $_SESSION['USER_ROLE'] === 'admin'): ?>
                <a href="<?= BASE_URL ?>addVenta" class="btn btn-primary mb-3">Nueva venta</a>
                <?php endif; ?>
            </li>  


              <li>
                <hr class="dropdown-divider">
              </li>
              <!-- Agrego para que muestre login o logout dependiendo de si hay sesion iniciada -->
              <?php if (!isset($user)): ?>
              <li><a class="dropdown-item" href="showLogin">Login</a></li>
              <?php elseif (isset($user)): ?>
                <li><a class="dropdown-item" href="logout">Logout</a></li>
              <?php endif; ?>
            </ul>
          </li>
        </ul>
        <form class="d-flex" role="search" action="venta" method="GET">
          <input class="form-control me-2" type="search" name="search" placeholder="Buscar venta..."
            value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>" aria-label="Buscar">
          <button class="btn btn-outline-success" type="submit">Buscar</button>
        </form>

      </div>
    </div>
  </nav>