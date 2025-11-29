<div class="container mt-5">
    <div class="card shadow border-0">
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0"><i class="bi bi-pencil-square me-2"></i>Edit Service</h3>
        </div>
        <div class="card-body">
            <?php if(session()->getFlashdata('success')): ?>
                <div class="alert alert-success">
                    <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>

            <?php if(session()->getFlashdata('errors')): ?>
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        <?php foreach(session()->getFlashdata('errors') as $error): ?>
                            <li><?= esc($error) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form action="<?= base_url('admin/update-service/'.$service['id']) ?>" method="post">
                <div class="mb-3">
                    <label for="name" class="form-label fw-bold">Service Name</label>
                    <input type="text" class="form-control form-control-lg" id="name" name="name" value="<?= esc($service['name']) ?>" required>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label fw-bold">Description</label>
                    <textarea class="form-control form-control-lg" id="description" name="description" rows="5" required><?= esc($service['description']) ?></textarea>
                </div>

                <div class="mb-3">
                    <label for="price" class="form-label fw-bold">Price</label>
                    <input type="number" class="form-control form-control-lg" id="price" name="price" value="<?= esc($service['price']) ?>" step="0.01" required>
                </div>

                <div class="d-flex justify-content-end">
                    <a href="<?= base_url('admin/manage-services') ?>" class="btn btn-outline-secondary me-2">Cancel</a>
                    <button type="submit" class="btn btn-success"><i class="bi bi-check-circle me-1"></i>Update Service</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Bootstrap 5 CSS & Icons (ensure this is loaded in your layout) -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
