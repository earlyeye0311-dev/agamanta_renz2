<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Product Management</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f4f6f9;
      font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
    }
    .page-header {
      margin-bottom: 30px;
    }
    .card {
      border: none;
      border-radius: 12px;
    }
    .table thead {
      background-color: #0d6efd;
      color: #fff;
    }
    .btn-custom {
      border-radius: 8px;
      font-weight: 500;
    }
    .modal-content {
      border-radius: 12px;
    }
    .modal-header {
      border-bottom: none;
    }
    .modal-footer {
      border-top: none;
    }
  </style>
</head>
<body>

<div class="container py-5">
  <!-- Page Header -->
  <div class="page-header text-center">
    <h2 class="fw-bold text-dark">Product Management</h2>
    <p class="text-muted">Add, edit, and manage your product records efficiently.</p>
  </div>

  <!-- Alerts -->
  <div class="mb-3">
    <?php getErrors(); ?>
    <?php getMessage(); ?>
  </div>

  <!-- Add Button -->
  <div class="d-flex justify-content-end mb-3">
    <button class="btn btn-primary btn-custom shadow-sm" data-bs-toggle="modal" data-bs-target="#addModal">
      Add Product
    </button>
  </div>

  <!-- Table Card -->
  <div class="card shadow-sm">
    <div class="card-body p-0">
      <table class="table table-hover align-middle mb-0 text-center">
        <thead>
          <tr>
            <th>Product Name</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Created At</th>
            <th>Updated At</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php if(!empty($getAll)): ?>
            <?php foreach($getAll as $product): ?>
              <tr>
                <td><?= htmlspecialchars($product['product_name']); ?></td>
                <td><?= htmlspecialchars($product['quantity']); ?></td>
                <td>₱<?= htmlspecialchars($product['Price']); ?></td>
                <td><?= htmlspecialchars($product['created_at']); ?></td>
                <td><?= htmlspecialchars($product['updated_at']); ?></td>
                <td>
                  <button class="btn btn-sm btn-outline-primary me-1" data-bs-toggle="modal" data-bs-target="#editModal<?= $product['id']; ?>">Edit</button>
                  <button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal<?= $product['id']; ?>">Delete</button>
                </td>
              </tr>

              <!-- Edit Modal -->
              <div class="modal fade" id="editModal<?= $product['id']; ?>" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <form action="/update-product/<?= $product['id']; ?>" method="POST">
                      <div class="modal-header bg-primary text-white rounded-top">
                        <h5 class="modal-title">Edit Product</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                      </div>
                      <div class="modal-body">
                        <input type="hidden" name="id" value="<?= $product['id']; ?>">
                        <div class="mb-3">
                          <label class="form-label">Product Name</label>
                          <input type="text" name="product_name" class="form-control" value="<?= $product['product_name']; ?>" required>
                        </div>
                        <div class="mb-3">
                          <label class="form-label">Quantity</label>
                          <input type="number" name="quantity" class="form-control" value="<?= $product['quantity']; ?>" required>
                        </div>
                        <div class="mb-3">
                          <label class="form-label">Price</label>
                          <input type="number" name="Price" class="form-control" value="<?= $product['Price']; ?>" required>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-custom">Update</button>
                        <button type="button" class="btn btn-light btn-custom" data-bs-dismiss="modal">Cancel</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>

              <!-- Delete Modal -->
              <div class="modal fade" id="deleteModal<?= $product['id']; ?>" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <form action="/delete-product/<?= $product['id']; ?>" method="POST">
                      <div class="modal-header bg-danger text-white rounded-top">
                        <h5 class="modal-title">Delete Product</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                      </div>
                      <div class="modal-body">
                        <p>Are you sure you want to delete <strong><?= $product['product_name'] ?></strong>?</p>
                        <input type="hidden" name="id" value="<?= $product['id']; ?>">
                      </div>
                      <div class="modal-footer">
                        <button type="submit" class="btn btn-danger btn-custom">Delete</button>
                        <button type="button" class="btn btn-light btn-custom" data-bs-dismiss="modal">Cancel</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>

            <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td colspan="6" class="text-muted">No products found.</td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- Add Modal -->
<div class="modal fade" id="addModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <form action="/create-user" method="POST">
        <div class="modal-header bg-success text-white rounded-top">
          <h5 class="modal-title">Add Product</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">Product Name</label>
            <input type="text" name="product_name" class="form-control" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Quantity</label>
            <input type="number" name="quantity" class="form-control" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Price</label>
            <input type="number" name="Price" class="form-control" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success btn-custom">Add</button>
          <button type="button" class="btn btn-light btn-custom" data-bs-dismiss="modal">Cancel</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="<?= BASE_URL; ?>/public/js/alert.js"></script>
</body>
</html>
