<?php 
require_once 'templates/layout/header.php';

// ----- FILTRO DE BÚSQUEDA -----
$search = isset($_GET['search']) ? trim($_GET['search']) : '';

if ($search !== '') {
    $sales = array_filter($sales, function($sale) use ($search) {
        return stripos($sale->producto, $search) !== false;
    });
}

// ----- PAGINACIÓN -----
$ventasPorPagina = 5; 
$totalVentas = count($sales);
$totalPaginas = ceil($totalVentas / $ventasPorPagina);

$paginaActual = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($paginaActual < 1) $paginaActual = 1;
if ($paginaActual > $totalPaginas) $paginaActual = $totalPaginas;

$inicio = ($paginaActual - 1) * $ventasPorPagina;
$ventasPagina = array_slice($sales, $inicio, $ventasPorPagina);
?>

<div class="container my-5">
  <h2 class="mb-4 text-center">📦 Lista de Ventas</h2>

  <!-- Mostrar texto si se hizo una búsqueda -->
  <?php if ($search !== ''): ?>
    <p class="text-center text-muted">
      Resultados para: <strong>"<?= htmlspecialchars($search) ?>"</strong>
    </p>
  <?php endif; ?>

  <div class="table-responsive shadow-sm rounded">
    <table class="table table-striped table-hover align-middle text-center">
      <thead class="table-dark">
        <tr>
          <th>#</th>
          <th>Producto</th>
          <th>Precio</th>
        </tr>
      </thead>
      <tbody>
        <?php if (!empty($ventasPagina)): ?>
          <?php foreach($ventasPagina as $index => $sale): ?>
            <tr>
              <td><?= $inicio + $index + 1 ?></td>
              <td><?= htmlspecialchars($sale->producto) ?></td>
              <td>$<?= number_format($sale->precio, 2, ',', '.') ?></td>
            </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr>
            <td colspan="3" class="text-muted">No hay ventas disponibles.</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>

  <!-- PAGINACIÓN -->
  <?php if ($totalPaginas > 1): ?>
    <nav aria-label="Page navigation" class="mt-4">
      <ul class="pagination justify-content-center">
        <!-- Botón Anterior -->
        <li class="page-item <?= ($paginaActual <= 1) ? 'disabled' : '' ?>">
          <a class="page-link" 
             href="?page=<?= $paginaActual - 1 ?>&search=<?= urlencode($search) ?>" 
             aria-label="Anterior">
            <span aria-hidden="true">&laquo;</span>
          </a>
        </li>

        <!-- Números de página -->
        <?php for ($i = 1; $i <= $totalPaginas; $i++): ?>
          <li class="page-item <?= ($paginaActual == $i) ? 'active' : '' ?>">
            <a class="page-link" 
               href="?page=<?= $i ?>&search=<?= urlencode($search) ?>">
               <?= $i ?>
            </a>
          </li>
        <?php endfor; ?>

        <!-- Botón Siguiente -->
        <li class="page-item <?= ($paginaActual >= $totalPaginas) ? 'disabled' : '' ?>">
          <a class="page-link" 
             href="?page=<?= $paginaActual + 1 ?>&search=<?= urlencode($search) ?>" 
             aria-label="Siguiente">
            <span aria-hidden="true">&raquo;</span>
          </a>
        </li>
      </ul>
    </nav>
  <?php endif; ?>
</div>

<?php require_once 'templates/layout/footer.php'; ?>
