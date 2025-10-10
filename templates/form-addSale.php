<?php require_once 'templates/layout/header.php'; ?>

<div class="container my-5">
  <div class="card shadow-sm rounded p-4">
    <h2 class="mb-4 text-center">🧾 Registrar Nueva Venta</h2>

    <form action="addVenta" method="POST">
      <!-- Producto -->
      <div class="mb-3">
        <label for="producto" class="form-label">Producto</label>
        <input 
          type="text" 
          class="form-control form-control-lg" 
          id="producto" 
          name="producto" 
          placeholder="Ej: Teclado Mecánico" 
          required>
      </div>

      <!-- Precio -->
      <div class="mb-3">
        <label for="precio" class="form-label">Precio ($)</label>
        <input 
          type="number" 
          step="0.01" 
          class="form-control" 
          id="precio" 
          name="precio" 
          placeholder="Ej: 25000" 
          required>
      </div>

      <!-- Vendedor -->
      <div class="mb-3">
        <label for="vendedor" class="form-label">Vendedor</label>
        <select class="form-select" id="vendedor" name="vendedor" required>
          <option value="" disabled selected>Seleccioná un vendedor</option>
          <?php foreach($sellers as $seller): ?>
            <option value="<?= $seller->id ?>"><?= htmlspecialchars($seller->nombre) ?></option>
          <?php endforeach; ?>
        </select>
      </div>

      <!-- Fecha -->
      <div class="mb-4">
        <label for="fecha" class="form-label">Fecha de Venta</label>
        <input 
          type="date" 
          class="form-control form-control-sm" 
          id="fecha" 
          name="fecha" 
          required>
      </div>

      <!-- Botón -->
      <div class="text-center">
        <button type="submit" class="btn btn-primary btn-lg px-5">
          💾 Guardar Venta
        </button>
      </div>
    </form>
  </div>
</div>

<?php require_once 'templates/layout/footer.php'; ?>
