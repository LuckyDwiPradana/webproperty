<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Deal</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .deal-card {
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 30px;
            margin-bottom: 30px;
        }
        .deal-image {
            width: 100%;
            height: 300px;
            object-fit: cover;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            cursor: pointer;
        }
        .deal-info i {
            width: 25px;
            color: #007bff;
        }
        .logo {
            position: absolute;
            top: 10px;
            left: 10px;
            width: 130px;
            height: auto;
        }
        .fullscreen-image {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.9);
            z-index: 1000;
            justify-content: center;
            align-items: center;
        }
        .fullscreen-image img {
            max-width: 90%;
            max-height: 90%;
            object-fit: contain;
        }
        .close-btn {
            position: absolute;
            top: 20px;
            right: 30px;
            color: #fff;
            font-size: 30px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="logo">
        <img src="<?= base_url('temp/assets/images/logdark.png') ?>" alt="Logo" class="img-fluid">
    </div>
    <div class="container mt-5">
        <h1 class="mb-4 text-center">Detail Kesepakatan</h1>
        <div class="deal-card">
            <div class="row">
                <div class="col-md-6">
                    <img src="<?= esc($deal['documentation_url']) ?>" class="deal-image mb-4" alt="Dokumentasi Deal" onclick="openFullscreen(this.src)">
                </div>
                <div class="col-md-6">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th><i class="fas fa-hashtag"></i> ID Deal</th>
                                <td><?= esc($deal['id']) ?></td>
                            </tr>
                            <tr>
                                <th><i class="fas fa-home"></i> Properti</th>
                                <td><?= esc($deal['property_name']) ?></td>
                            </tr>
                            <tr>
                                <th><i class="fas fa-user-tie"></i> Agen</th>
                                <td><?= esc($deal['agent_name']) ?></td>
                            </tr>
                            <tr>
                                <th><i class="fas fa-money-bill-wave"></i> Harga</th>
                                <td>Rp <?= number_format($deal['price'] ?? 0, 0, ',', '.') ?></td>
                            </tr>
                            <tr>
                                <th><i class="fas fa-user"></i> Pembeli</th>
                                <td><?= esc($deal['buyer_name'] ?? '') ?></td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="mb-4">
                        <h5><i class="fas fa-info-circle"></i> Deskripsi:</h5>
                        <p><?= esc($deal['closing_description'] ?? 'Tidak ada deskripsi') ?></p>
                    </div>
                    <a href="/agent/deals/index" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Kembali</a>
                </div>
            </div>
        </div>
    </div>

    <div class="fullscreen-image" id="fullscreenImage">
        <span class="close-btn" onclick="closeFullscreen()">&times;</span>
        <img src="" alt="Fullscreen Image">
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function openFullscreen(src) {
            document.getElementById('fullscreenImage').style.display = 'flex';
            document.getElementById('fullscreenImage').querySelector('img').src = src;
        }

        function closeFullscreen() {
            document.getElementById('fullscreenImage').style.display = 'none';
        }
    </script>
</body>
</html>