
<?php 
helper('form');

   // Inisialisasi variabel untuk nomor urut
$no = 1; // Variabel untuk nomor urut, dimulai dari 1 
?>
<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Properti</title>
    
    
    
    <link rel="shortcut icon" href="<?= base_url('/admin/compiled/svg/favicon.svg')?>" type="image/x-icon">
    <link rel="shortcut icon" href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACEAAAAiCAYAAADRcLDBAAAEs2lUWHRYTUw6Y29tLmFkb2JlLnhtcAAAAAAAPD94cGFja2V0IGJlZ2luPSLvu78iIGlkPSJXNU0wTXBDZWhpSHpyZVN6TlRjemtjOWQiPz4KPHg6eG1wbWV0YSB4bWxuczp4PSJhZG9iZTpuczptZXRhLyIgeDp4bXB0az0iWE1QIENvcmUgNS41LjAiPgogPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4KICA8cmRmOkRlc2NyaXB0aW9uIHJkZjphYm91dD0iIgogICAgeG1sbnM6ZXhpZj0iaHR0cDovL25zLmFkb2JlLmNvbS9leGlmLzEuMC8iCiAgICB4bWxuczp0aWZmPSJodHRwOi8vbnMuYWRvYmUuY29tL3RpZmYvMS4wLyIKICAgIHhtbG5zOnBob3Rvc2hvcD0iaHR0cDovL25zLmFkb2JlLmNvbS9waG90b3Nob3AvMS4wLyIKICAgIHhtbG5zOnhtcD0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wLyIKICAgIHhtbG5zOnhtcE1NPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvbW0vIgogICAgeG1sbnM6c3RFdnQ9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZUV2ZW50IyIKICAgZXhpZjpQaXhlbFhEaW1lbnNpb249IjMzIgogICBleGlmOlBpeGVsWURpbWVuc2lvbj0iMzQiCiAgIGV4aWY6Q29sb3JTcGFjZT0iMSIKICAgdGlmZjpJbWFnZVdpZHRoPSIzMyIKICAgdGlmZjpJbWFnZUxlbmd0aD0iMzQiCiAgIHRpZmY6UmVzb2x1dGlvblVuaXQ9IjIiCiAgIHRpZmY6WFJlc29sdXRpb249Ijk2LjAiCiAgIHRpZmY6WVJlc29sdXRpb249Ijk2LjAiCiAgIHBob3Rvc2hvcDpDb2xvck1vZGU9IjMiCiAgIHBob3Rvc2hvcDpJQ0NQcm9maWxlPSJzUkdCIElFQzYxOTY2LTIuMSIKICAgeG1wOk1vZGlmeURhdGU9IjIwMjItMDMtMzFUMTA6NTA6MjMrMDI6MDAiCiAgIHhtcDpNZXRhZGF0YURhdGU9IjIwMjItMDMtMzFUMTA6NTA6MjMrMDI6MDAiPgogICA8eG1wTU06SGlzdG9yeT4KICAgIDxyZGY6U2VxPgogICAgIDxyZGY6bGkKICAgICAgc3RFdnQ6YWN0aW9uPSJwcm9kdWNlZCIKICAgICAgc3RFdnQ6c29mdHdhcmVBZ2VudD0iQWZmaW5pdHkgRGVzaWduZXIgMS4xMC4xIgogICAgICBzdEV2dDp3aGVuPSIyMDIyLTAzLTMxVDEwOjUwOjIzKzAyOjAwIi8+CiAgICA8L3JkZjpTZXE+CiAgIDwveG1wTU06SGlzdG9yeT4KICA8L3JkZjpEZXNjcmlwdGlvbj4KIDwvcmRmOlJERj4KPC94OnhtcG1ldGE+Cjw/eHBhY2tldCBlbmQ9InIiPz5V57uAAAABgmlDQ1BzUkdCIElFQzYxOTY2LTIuMQAAKJF1kc8rRFEUxz9maORHo1hYKC9hISNGTWwsRn4VFmOUX5uZZ36oeTOv954kW2WrKLHxa8FfwFZZK0WkZClrYoOe87ypmWTO7dzzud97z+nec8ETzaiaWd4NWtYyIiNhZWZ2TvE946WZSjqoj6mmPjE1HKWkfdxR5sSbgFOr9Ll/rXoxYapQVik8oOqGJTwqPL5i6Q5vCzeo6dii8KlwpyEXFL519LjLLw6nXP5y2IhGBsFTJ6ykijhexGra0ITl5bRqmWU1fx/nJTWJ7PSUxBbxJkwijBBGYYwhBgnRQ7/MIQIE6ZIVJfK7f/MnyUmuKrPOKgZLpEhj0SnqslRPSEyKnpCRYdXp/9++msneoFu9JgwVT7b91ga+LfjetO3PQ9v+PgLvI1xkC/m5A+h7F32zoLXug38dzi4LWnwHzjeg8UGPGbFfySvuSSbh9QRqZ6H+Gqrm3Z7l9zm+h+iafNUV7O5Bu5z3L/wAdthn7QIme0YAAAAJcEhZcwAADsQAAA7EAZUrDhsAAAJTSURBVFiF7Zi9axRBGIefEw2IdxFBRQsLWUTBaywSK4ubdSGVIY1Y6HZql8ZKCGIqwX/AYLmCgVQKfiDn7jZeEQMWfsSAHAiKqPiB5mIgELWYOW5vzc3O7niHhT/YZvY37/swM/vOzJbIqVq9uQ04CYwCI8AhYAlYAB4Dc7HnrOSJWcoJcBS4ARzQ2F4BZ2LPmTeNuykHwEWgkQGAet9QfiMZjUSt3hwD7psGTWgs9pwH1hC1enMYeA7sKwDxBqjGnvNdZzKZjqmCAKh+U1kmEwi3IEBbIsugnY5avTkEtIAtFhBrQCX2nLVehqyRqFoCAAwBh3WGLAhbgCRIYYinwLolwLqKUwwi9pxV4KUlxKKKUwxC6ZElRCPLYAJxGfhSEOCz6m8HEXvOB2CyIMSk6m8HoXQTmMkJcA2YNTHm3congOvATo3tE3A29pxbpnFzQSiQPcB55IFmFNgFfEQeahaAGZMpsIJIAZWAHcDX2HN+2cT6r39GxmvC9aPNwH5gO1BOPFuBVWAZue0vA9+A12EgjPadnhCuH1WAE8ivYAQ4ohKaagV4gvxi5oG7YSA2vApsCOH60WngKrA3R9IsvQUuhIGY00K4flQG7gHH/mLytB4C42EgfrQb0mV7us8AAMeBS8mGNMR4nwHamtBB7B4QRNdaS0M8GxDEog7iyoAguvJ0QYSBuAOcAt71Kfl7wA8DcTvZ2KtOlJEr+ByyQtqqhTyHTIeB+ONeqi3brh+VgIN0fohUgWGggizZFTplu12yW8iy/YLOGWMpDMTPXnl+Az9vj2HERYqPAAAAAElFTkSuQmCC" type="image/png">
    
<link rel="stylesheet" href="<?= base_url('/admin/extensions/quill/quill.snow.css') ?>">
<link rel="stylesheet" href="<?= base_url('/admin/extensions/quill/quill.bubble.css') ?>">
<link rel="stylesheet" href="<?= base_url('/admin/extensions/simple-datatables/style.css') ?>">
    <link rel="stylesheet" href="<?= base_url('/admin/compiled/css/table-datatable.css') ?>">
<link rel="stylesheet" href="<?= base_url('/admin/compiled/css/app.css') ?>">
<link rel="stylesheet" href="<?= base_url('/admin/compiled/css/app-dark.css') ?>">
<link rel="stylesheet" href="<?= base_url('/admin/compiled/css/iconly.css') ?>">
</head>


<?= $this->include('admin/layouts/navbar') ?>
<body>
<script src="<?= base_url('/admin/static/js/initTheme.js') ?>"></script>   
  <div id="app">
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            <?= $this->include('admin/layouts/sidebar') ?>

   <div class="page-heading">
    <div class="page-title">
          <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-light-success color-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle"></i>
                <?= session()->getFlashdata('success') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-light-danger color-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-circle"></i>
                <?= session()->getFlashdata('error') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Data Properti</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/admin/index">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Tambah Properti</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
              <!-- Form tambah properti -->
<section id="multiple-column-form">
    <div class="row match-height">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Tambah Properti</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <?= form_open_multipart('/admin/properties/store') ?>
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="name">Nama</label>
                                    <input type="text" class="form-control" id="name" name="name" value="<?= old('name') ?>" required placeholder="Masukkan Nama Properti">
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select class="form-control" id="status" name="status" required>
                                        <option value="Jual" <?= old('status') == 'Jual' ? 'selected' : '' ?>>Jual</option>
                                        <option value="Sewa" <?= old('status') == 'Sewa' ? 'selected' : '' ?>>Sewa</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="location">Lokasi</label>
                                    <input type="text" class="form-control" id="location" name="location" value="<?= old('location') ?>" required placeholder="Masukkan Lokasi Properti">
                                    <div id="map"></div>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="bedroom">Jumlah Kamar Tidur</label>
                                    <input type="number" class="form-control" id="bedroom" name="bedroom" value="<?= old('bedroom') ?>" required placeholder="Masukkan Jumlah Kamar Tidur">
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="bathroom">Jumlah Kamar Mandi</label>
                                    <input type="number" class="form-control" id="bathroom" name="bathroom" value="<?= old('bathroom') ?>" required placeholder="Masukkan Jumlah Kamar Mandi">
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="building_size">Luas Bangunan</label>
                                    <input type="number" step="0.01" class="form-control" id="building_size" name="building_size" value="<?= old('building_size') ?>" required placeholder="Masukkan Luas Bangunan (m²)">
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="price">Harga</label>
                                    <input type="number" class="form-control" id="price" name="price" value="<?= old('price') ?>" required placeholder="Masukkan Harga Properti">
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="reference_id">Referensi ID</label>
                                    <input type="text" class="form-control" id="reference_id" name="reference_id" value="<?= 'REF-' . sprintf('%04d', rand(0, 9999)) ?>" readonly>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="area">Area</label>
                                    <input type="text" class="form-control" id="area" name="area" value="<?= old('area') ?>" placeholder="Masukkan Area">
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="listing_type">Tipe Listing</label>
                                    <select class="form-control" id="listing_type" name="listing_type" required>
                                        <option value="">- Pilih Tipe Listing -</option>
                                        <option value="HGB" <?= old('listing_type') == 'HGB' ? 'selected' : '' ?>>HGB</option>
                                        <option value="HGU" <?= old('listing_type') == 'HGU' ? 'selected' : '' ?>>HGU</option>
                                        <option value="Hak Pakai" <?= old('listing_type') == 'Hak Pakai' ? 'selected' : '' ?>>Hak Pakai</option>
                                        <option value="SHM" <?= old('listing_type') == 'SHM' ? 'selected' : '' ?>>SHM</option>
                                        <option value="HMSRS" <?= old('listing_type') == 'HMSRS' ? 'selected' : '' ?>>HMSRS</option>
                                        <option value="Girik" <?= old('listing_type') == 'Girik' ? 'selected' : '' ?>>Girik</option>
                                        <option value="Akta Jual Beli" <?= old('listing_type') == 'Akta Jual Beli' ? 'selected' : '' ?>>Akta Jual Beli</option>
                                        <option value="Surat Keterangan Tanah" <?= old('listing_type') == 'Surat Keterangan Tanah' ? 'selected' : '' ?>>Surat Keterangan Tanah</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="property_type">Tipe Properti</label>
                                    <select class="form-control" id="property_type" name="property_type" required>
                                        <option value="">- Pilih Tipe Properti -</option>
                                        <option value="Apartemen" <?= old('property_type') == 'Apartemen' ? 'selected' : '' ?>>Apartemen</option>
                                        <option value="Hotel" <?= old('property_type') == 'Hotel' ? 'selected' : '' ?>>Hotel</option>
                                        <option value="Ruko" <?= old('property_type') == 'Ruko' ? 'selected' : '' ?>>Ruko</option>
                                        <option value="Rumah" <?= old('property_type') == 'Rumah' ? 'selected' : '' ?>>Rumah</option>
                                        <option value="Tanah" <?= old('property_type') == 'Tanah' ? 'selected' : '' ?>>Tanah</option>
                                        <option value="Villa" <?= old('property_type') == 'Villa' ? 'selected' : '' ?>>Villa</option>
                                        <option value="Gudang" <?= old('property_type') == 'Gudang' ? 'selected' : '' ?>>Gudang</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="land_area">Luas Tanah</label>
                                    <input type="number" class="form-control" id="land_area" name="land_area" value="<?= old('land_area') ?>" placeholder="Masukkan Luas Tanah (m²)">
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="year_built">Tahun Dibangun</label>
                                    <input type="number" class="form-control" id="year_built" name="year_built" value="<?= old('year_built') ?>" placeholder="Masukkan Tahun Dibangun">
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="agent_id">Agent</label>
                                    <select class="form-control" id="agent_id" name="agent_id" required>
                                        <?php $agents = (new \App\Models\PropertyModel())->getAllAgents(); ?>
                                        <?php if (!empty($agents)): ?>
                                            <?php foreach ($agents as $agent): ?>
                                                <option value="<?= $agent['id'] ?>" <?= old('agent_id') == $agent['id'] ? 'selected' : '' ?>><?= $agent['agent_name'] ?></option>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <option value="">Tidak ada agen</option>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="description">Deskripsi</label>
                                    <textarea class="form-control" id="description" name="description" required placeholder="Masukkan Deskripsi Properti"><?= old('description') ?></textarea>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="photos">Foto</label>
                                    <div class="input-group">
                                        <input type="file" class="form-control" id="photos" name="photos[]" aria-label="Upload" multiple>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary me-1 mb-1">Simpan</button>
                                <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                            </div>
                        </div>
                        <?= form_close() ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

    <!-- Basic multiple Column Form section end -->
</div>

  <?= $this->include('admin/layouts/footer') ?>
</body>
</html>