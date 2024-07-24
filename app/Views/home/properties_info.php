<?= $this->include('home/layouts/header')?>
<?= $this->include('home/layouts/navbar')?>

<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title><?= esc($property['name']) ?> - Detail Properti</title>

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="<?= base_url() ?>/temp/assets//assets/css/fontawesome.css">
    <link rel="stylesheet" href="<?= base_url() ?>/temp/assets/2/assets/css/templatemo-villa-agency.css">
    <link rel="stylesheet" href="<?= base_url() ?>/temp/assets//assets/css/owl.css">
    <link rel="stylesheet" href="<?= base_url() ?>/temp/assets//assets/css/animate.css">
    <link rel="stylesheet"href="https://unpkg.com/swiper@7/swiper-bundle.min.css"/>
    
<!--

TemplateMo 591 villa agency

https://templatemo.com/tm-591-villa-agency

-->
  </head>

<body>

  <!-- ***** Preloader Start ***** -->
  <div id="js-preloader" class="js-preloader">
    <div class="preloader-inner">
      <span class="dot"></span>
      <div class="dots">
        <span></span>
        <span></span>
        <span></span>
      </div>
    </div>
  </div>
  <!-- ***** Preloader End ***** -->

  <!-- ***** Header Area End ***** -->

  <div class="page-heading header-text">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <span class="breadcrumb"><a href="<?php echo base_url('/'); ?>">Beranda</a> / Properti/ Properti Detail</span>
          <h3>Properti Detail</h3>
        </div>
      </div>
    </div>
  </div>

<div class="container mt-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= site_url('home/index') ?>">Beranda</a></li>
            <li class="breadcrumb-item"><a href="<?= site_url('home/properties') ?>">Properti</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= esc($property['name']) ?></li>
        </ol>
    </nav>

 <div class="row">
        <div class="col-md-8">
            <!-- Image carousel with rounded corners -->
            <?php if (!empty($property['photos'])): ?>
                <div id="propertyCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <?php foreach ($property['photos'] as $index => $photo): ?>
                            <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                                <img src="<?= esc($photo['url']) ?>" class="d-block w-100 rounded" alt="Foto Properti" style="border-radius: 15px;">
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <?php if (count($property['photos']) > 1): ?>
                        <button class="carousel-control-prev" type="button" data-bs-target="#propertyCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#propertyCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    <?php endif; ?>
                </div>
            <?php else: ?>
                <div class="alert alert-info">Tidak ada foto tersedia</div>
            <?php endif; ?>
        </div>
        <div class="col-md-4">
            <!-- Property title and price -->
            <h1 class="h2"><?= esc($property['name']) ?></h1>
            <span class="added-date">Terdaftar Pada: <?= date('d M Y', strtotime($property['created_at'])) ?></span>
            <h2 class="text-primary h3">Rp <?= number_format($property['price'], 0, ',', '.') ?></h2>
            <p class="text-muted"><?= esc($property['area']) ?></p>

            <!-- Quick specs with yellow background -->
           <div class="specs mb-3">
                <span class="badge bg-secondary">LT <?= esc($property['land_area']) ?> m²</span>
                <span class="badge bg-secondary">LB <?= esc($property['building_size']) ?> m²</span>
                <span class="badge bg-secondary">K. Tidur <?= esc($property['bedroom']) ?></span>
                <span class="badge bg-secondary">K. Mandi <?= esc($property['bathroom']) ?></span>
            </div>

            <!-- Agent info with photo -->
            <?php if (isset($property['agent'])): ?>
                <div class="agent-info border p-3 rounded">
                    <div class="d-flex align-items-center mb-2">
                         <a href="<?= base_url('home/agent_info/' . $property['agent']['id']) ?>">
                        <?php if (isset($property['agent']['agent_photo_url']) && !empty($property['agent']['agent_photo_url'])): ?>
                            <img src="<?= esc($property['agent']['agent_photo_url']) ?>" alt="Agen" class="rounded-circle mr-2" style="width: 40px; height: 40px; object-fit: cover;">
                        <?php else: ?>
                            <div class="rounded-circle mr-2 bg-secondary" style="width: 40px; height: 40px;"></div>
                        <?php endif; ?>
                        <div>
                            <strong><?= esc($property['agent']['agent_name'] ?? 'Nama Agen') ?></strong><br>
                            <small>Total Property <?= esc($property['agent']['agency'] ?? 'Agency') ?></small>
                        </div>
                    </div>
                    <div class="d-flex gap-3 mt-4">
    <a href="tel:<?= esc($property['agent']['phone'] ?? '') ?>" class="btn btn-outline-primary btn-sm py-1 px-2" style="font-size: 0.75rem; margin-right: 10px;">
        <i class="fas fa-phone me-1"></i> Hubungi
    </a>
    <a href="https://wa.me/<?= esc($property['agent']['phone'] ?? '') ?>" class="btn btn-success btn-sm py-1 px-2" style="font-size: 0.75rem;">
        <i class="fab fa-whatsapp me-1"></i> WhatsApp
    </a>
</div>

        </div>
            <?php endif; ?>
        </div>
    </div>


    <div class="row mt-4">
        <div class="col-md-8">
            <!-- Detail Properti -->
            <h3>Detail Properti</h3>
            <table class="table table-striped">
                <tr>
                    <th>Status</th>
                    <td><?= esc($property['status']) ?></td>
                </tr>
                <tr>
                    <th>Tipe Listing</th>
                    <td><?= esc($property['listing_type']) ?></td>
                </tr>
                <tr>
                    <th>Tipe Properti</th>
                    <td><?= esc($property['property_type']) ?></td>
                </tr>
                <tr>
                    <th>Tahun Dibangun</th>
                    <td><?= esc($property['year_built']) ?></td>
                </tr>
                <tr>
                    <th>Area</th>
                    <td><?= esc($property['area']) ?></td>
                </tr>
                <tr>
                    <th>ID Referensi</th>
                    <td><?= esc($property['reference_id']) ?></td>
                </tr>
            </table>

            <!-- Deskripsi -->
            <h3>Deskripsi</h3>
            <p><?= nl2br(esc($property['description'])) ?></p>
        </div>
       <div class="col-md-4">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Lokasi</h5>
            <?php
            $location = $property['location'];
            $mapUrl = "https://www.google.com/maps/search/?api=1&query=" . urlencode($location);
            ?>
            <p class="card-text">
                <a href="<?= esc($mapUrl) ?>" target="_blank" title="Lihat di Google Maps">
                    <i class="fas fa-map-marker-alt"></i> 
                    <?= esc($location) ?>
                </a>
            </p>
            <div id="map" style="width: 100%; height: 300px;">
                <iframe
                    width="100%"
                    height="100%"
                    frameborder="0" 
                    style="border:0"
                    src="https://www.google.com/maps?q=<?= urlencode($location) ?>&output=embed" 
                    allowfullscreen>
                </iframe>
            </div>
        </div>
    </div>
</div>




 <!-- Scripts -->
  <!-- Bootstrap core JavaScript -->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="<?= base_url() ?>/temp/assets/2/vendor/jquery/jquery.min.js"></script>
  <script src="<?= base_url() ?>/temp/assets/2/vendor/bootstrap/js/bootstrap.min.js"></script>
  <script src="<?= base_url() ?>/temp/assets/2/assets/js/isotope.min.js"></script>
  <script src="<?= base_url() ?>/temp/assets/2/assets/js/owl-carousel.js"></script>
  <script src="<?= base_url() ?>/temp/assets/2/assets/js/counter.js"></script>
  <script src="<?= base_url() ?>/temp/assets/2/assets/js/custom.js"></script>
  </body>
</html>

       <?= $this->include('home/layouts/footer')?>

</body>

</html>