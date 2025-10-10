<?php 
require_once 'templates/layout/header.php';

$vendedoresPorPagina = 5;
$totalVendedores = count($sellers);
$totalPaginas = ceil($totalVendedores / $vendedoresPorPagina);

$paginaActual = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($paginaActual < 1) $paginaActual = 1;
if ($paginaActual > $totalPaginas) $paginaActual = $totalPaginas;

$inicio = ($paginaActual - 1) * $vendedoresPorPagina;
$vendedoresPagina = array_slice($sellers, $inicio, $vendedoresPorPagina);
?>

<div class="container my-5">
  <h2 class="mb-4 text-center">🧑‍💼 Lista de Vendedores</h2>

  <div class="table-responsive shadow-sm rounded">
    <table class="table table-striped table-hover align-middle text-center">
      <thead class="table-dark">
        <tr>
          <th>#</th>
          <th>Nombre</th>
          <th>Teléfono</th>
        </tr>
      </thead>
      <tbody>
        <?php if (!empty($vendedoresPagina)): ?>
          <?php foreach($vendedoresPagina as $index => $seller): ?>
            <tr>
              <td><?= $inicio + $index + 1 ?></td>
              <td><?= htmlspecialchars($seller->nombre) ?></td>
              <td><?= htmlspecialchars($seller->telefono) ?></td>
            </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr>
            <td colspan="3" class="text-muted">No hay vendedores registrados.</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>


  <?php if ($totalPaginas > 1): ?>
    <nav aria-label="Page navigation" class="mt-4">
      <ul class="pagination justify-content-center">

        <li class="page-item <?= ($paginaActual <= 1) ? 'disabled' : '' ?>">
          <a class="page-link" href="?page=<?= $paginaActual - 1 ?>" aria-label="Anterior">
            <span aria-hidden="true">&laquo;</span>
          </a>
        </li>

        <?php for ($i = 1; $i <= $totalPaginas; $i++): ?>
          <li class="page-item <?= ($paginaActual == $i) ? 'active' : '' ?>">
            <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
          </li>
        <?php endfor; ?>

        <li class="page-item <?= ($paginaActual >= $totalPaginas) ? 'disabled' : '' ?>">
          <a class="page-link" href="?page=<?= $paginaActual + 1 ?>" aria-label="Siguiente">
            <span aria-hidden="true">&raquo;</span>
          </a>
        </li>
      </ul>
    </nav>
  <?php endif; ?>
</div>

<?php require_once 'templates/layout/footer.php'; ?>
