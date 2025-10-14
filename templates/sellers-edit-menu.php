<?php
require_once 'templates/layout/header.php';
// hace print del icono de empleado para facilitar la legibilidad
function icon(){
  echo '
  <svg 
  xmlns="http://www.w3.org/2000/svg"
  class="bi" viewBox="0 0 16 16" aria-hidden="true">
    <path d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1v-1z" />
    <path d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5h3zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3z" />
    </svg>';
}
$vendedoresPorPagina = 5;
$totalVendedores = count($sellers);
$totalPaginas = ceil($totalVendedores / $vendedoresPorPagina);

$paginaActual = isset($_GET['page']) ? (int) $_GET['page'] : 1;
if ($paginaActual < 1)
  $paginaActual = 1;
if ($paginaActual > $totalPaginas)
  $paginaActual = $totalPaginas;

$inicio = ($paginaActual - 1) * $vendedoresPorPagina;
$vendedoresPagina = array_slice($sellers, $inicio, $vendedoresPorPagina);
if ($paginaActual>1)
  $pagina = "?page=" . "$paginaActual";
else 
  $pagina = "";
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
          <th>Correo Electronico</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php if (!empty($vendedoresPagina)): ?>
          <?php
          foreach ($vendedoresPagina as $index => $seller):
            // SI EL ID DEL VENDEDOR QUE SE VA A MOSTRAR EN LA TABLA ES EL QUE SE ELIGIO PARA EDITAR, MUESTRO INPUTS PARA EDITAR DATOS
            if ($seller->id == $sellerToEdit) { ?>
            <!-- Genero un form para hacer el update -->
              <form action="<?= BASE_URL ?>updateSeller/<?=htmlspecialchars($sellerToEdit)?>" method="post">
                <tr>
                  <td><?= $inicio + $index + 1 ?></td>
                  <td><input type="text" name="nombre" value="<?= htmlspecialchars($seller->nombre) ?>" required></td>                  
                  <td><input type="text" name="telefono" value="<?= htmlspecialchars($seller->telefono) ?>" pattern="\d*" required></td>
                  <td><input type="email" name="email" value="<?= htmlspecialchars($seller->email) ?>" required></td>
                  <td><button class="btn btn-outline-success">💾Guardar</button></td>
                </tr>
              </form>

            <?php } else { ?>
              <tr>
                <td><?= $inicio + $index + 1 ?></td>
                <!-- Link para mostrar items (ventas) por categoria (vendedor) -->
                <td><a href="<?= BASE_URL ?>vendedores/<?= $seller->id ?>"
                    class="icon-link icon-link-hover fw-bolder text-capitalize"><?= icon(), htmlspecialchars($seller->nombre) ?></a></td>

                <td><?= htmlspecialchars($seller->telefono) ?></td>
                <td><?= htmlspecialchars($seller->email) ?></td>
                <td>
                <a href="<?= BASE_URL ?>editarVendedor/<?= $seller->id . $pagina?>" class="link-warning text-wrap"> ✏️Editar</a>
                <a href="<?= BASE_URL ?>deleteSeller/<?= $seller->id ?>" class="link-danger text-wrap"> ❌Eliminar</a>
                </td>
              </tr>

            <?php } ?>

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
          <a class="page-link" href="<?= BASE_URL ?>vendedores/?page=<?= $paginaActual - 1 ?>" aria-label="Anterior">
            <span aria-hidden="true">&laquo;</span>
          </a>
        </li>

        <?php for ($i = 1; $i <= $totalPaginas; $i++): ?>
          <li class="page-item <?= ($paginaActual == $i) ? 'active' : '' ?>">
            <a class="page-link" href="<?= BASE_URL ?>vendedores/?page=<?= $i ?>"><?= $i ?></a>
          </li>
        <?php endfor; ?>

        <li class="page-item <?= ($paginaActual >= $totalPaginas) ? 'disabled' : '' ?>">
          <a class="page-link" href="<?= BASE_URL ?>vendedores/?page=<?= $paginaActual + 1 ?>" aria-label="Siguiente">
            <span aria-hidden="true">&raquo;</span>
          </a>
        </li>
      </ul>
    </nav>
  <?php endif; ?>
</div>

<?php require_once 'templates/layout/footer.php'; ?>