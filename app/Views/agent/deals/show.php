<!DOCTYPE html>
<html>
<head>
    <title>Detail Deal</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h1>Detail Deal</h1>
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label>ID Deal:</label>
                    <p><?= esc($deal['id']) ?></p>
                </div>
                <div class="mb-3">
                    <label>Properti:</label>
                    <p><?= esc($deal['property_id']) ?></p>
                </div>
                <div class="mb-3">
                    <label>Deskripsi:</label>
                    <p><?= esc($deal['closing_description'] ?? 'No description') ?></p>
                </div>
                <div class="mb-3">
                    <label>Harga:</label>
                    <p>Rp <?= number_format($deal['price'] ?? 0, 0, ',', '.') ?></p>
                </div>
                <div class="mb-3">
                    <label>Pembeli:</label>
                    <p><?= esc($deal['buyer_name'] ?? '') ?></p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label>Dokumentasi:</label>
                    <img src="<?= esc($deal['documentation_url']) ?>" class="img-fluid">
                </div>
            </div>
        </div>
        <a href="/agent/deals/index" class="btn btn-primary">Kembali</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>