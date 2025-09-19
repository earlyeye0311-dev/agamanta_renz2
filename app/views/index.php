<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Students Management</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #280724ff;
      font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
    }
   
    .card {
      border: none;
      border-radius: 10px;
      background-color: #891564ff;
    }
    .table {
      border: none; 
      border-radius: 15px;
      background-color: #891564ff;
      
    }
    .table thead {
      background-color: #891564ff;
      color: #891564ff;
    }
    .btn-custom {
      border-radius: 15px;
      font-weight: 600;
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

    th, td{ 
      border-right: 2px solid white;
     }
       .btn-custom {
    background-color: #650545ff; /* your custom color */
    border-color: #f34ebfff;
    border-radius:13px;
    color: #160202ff;
  }
  </style>
</head>
<body>

<div class="container py-5">
  <!-- Page Header -->
  <div class="page-header text-center">
    <h2 class="fw-bold text-dark"></h2>
    <p class="text-muted"></p>
  </div>

  <!-- Alerts -->
  <div class="mb-3">
    <?php getErrors(); ?>
    <?php getMessage(); ?>
  </div>

  <!-- Add Button -->
  <div class="d-flex justify-content-end mb-3">
    	<form action="<?=site_url('/');?>" method="get" class="col-sm-4 float-end d-flex">
		<?php
		$q = '';
		if(isset($_GET['q'])) {
			$q = $_GET['q'];
		}
		?>
        <input class="form-control me-2" name="q" type="text" placeholder="Search" value="<?=html_escape($q);?>">
        <button type="submit" class="btn btn-primary btn-custom me-5 " type="button">🔍</button>
	</form>
    <button class="btn btn-custom shadow-sm" data-bs-toggle="modal" data-bs-target="#addModal">
      INSERT
    </button>
  </div>

  <!-- Table Card -->
  <div class="card shadow-sm">
    <div class="card-body p-3">
      <table class="table table-hover align-middle mb-0 text-center table-dark">
        <thead>

          <tr>
            <th>first_name</th>
            <th>last_name</th>
            <th>Age</th>
            <th>email</th>
            <th>Created At</th>
            <th>✂️||🗑️</th>
          
          </tr>
        </thead>

        <tbody>
          <?php if(!empty($all)): ?>
            <?php foreach($all as $product): ?>
              <tr>
                <td><?= htmlspecialchars($product['first_name']); ?></td>
                <td><?= htmlspecialchars($product['last_name']); ?></td>
                <td><?= htmlspecialchars($product['Age']); ?></td>
                <td><?= htmlspecialchars($product['email']); ?></td>
                <td><?= htmlspecialchars($product['created_at']); ?></td>
                
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
                        <h5 class="modal-title">Edit</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                      </div>

                      <div class="modal-body">
                        <input type="hidden" name="id" value="<?= $product['id']; ?>">
                        <div class="mb-3">
                          <label class="form-label">first_name</label>
                          <input type="text" name="first_name" class="form-control" value="<?= $product['first_name']; ?>" required>
                        </div>
                         <div class="modal-body">
                        <input type="hidden" name="id" value="<?= $product['id']; ?>">
                        <div class="mb-3">
                          <label class="form-label">last_name</label>
                          <input type="text" name="last_name" class="form-control" value="<?= $product['last_name']; ?>" required>
                        </div>
                       
                        <div class="mb-3">
                          <label class="form-label">Age</label>
                          <input type="number" name="Age" class="form-control" value="<?= $product['Age']; ?>" required>
                        </div>
                      </div>

                      <div class="mb-3">
                          <label class="form-label">email</label>
                          <input type="text" name="email" class="form-control" value="<?= $product['email']; ?>" required>
                        </div>
                      </div>

                      <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-custom">Update</button>
                      
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
                        <h5 class="modal-title">Delete</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                      </div>
                      <div class="modal-body">
                        <p>Are you sure you want to delete <strong><?= $product['first_name'] ?></strong>?</p>
                        <input type="hidden" name="id" value="<?= $product['id']; ?>">
                      </div>
                      <div class="modal-footer">
                        <button type="submit" class="btn btn-danger btn-custom">Delete</button>
                        
                      </div>
                    </form>
                  </div>
                </div>
              </div>

            <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td colspan="6" class="text-muted">No  found.</td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
    	<?php
	echo $page;?>
  </div>
</div>

<!-- Add Modal -->
<div class="modal fade" id="addModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <form action="/create-user" method="POST">
        <div class="modal-header bg-success text-white rounded-top">
          <h5 class="modal-title">Insert</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">first_name</label>
            <input type="text" name="first_name" class="form-control" required>
          </div>

          <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">last_name</label>
            <input type="text" name="last_name" class="form-control" required>
          </div>
        
          <div class="mb-3">
            <label class="form-label">Age</label>
            <input type="number" name="Age" class="form-control" required>
          </div>
        </div>
        
         <div class="mb-3">
            <label class="form-label">email</label>
            <input type="text" name="email" class="form-control" required>
          </div>
        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-success btn-custom">Add</button>
          
        </div>
      </form>
    </div>
  </div>

  
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="<?= BASE_URL; ?>/public/js/alert.js"></script>
</body>
</html>
