<?= $this->include('home/layouts/header')?>
<?= $this->include('home/layouts/navbar')?>

<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>Properti - Total Property</title>

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
          <span class="breadcrumb"><a href="<?php echo base_url('home/index'); ?>">Beranda</a> / Properti</span>
          <h3>Properti</h3>
        </div>
      </div>
    </div>
  </div>

<div class="search-container">
    <form action="<?= site_url('home/properties') ?>" method="GET" class="mb-4">
        <input type="text" name="keyword" class="form-control" placeholder="Lokasi, kata kunci, area, proyek, pengembang..." value="<?= $keyword ?? '' ?>">
        <input type="hidden" name="type" id="propertyType" value="<?= $type ?? '' ?>">
        <button type="submit">Cari</button>
    </form>
</div>

<div class="section properties">
    <div class="container">
        <ul class="properties-filter">
            <li>
                <a class="<?= empty($type) ? 'is_active' : '' ?>" href="<?= site_url('home/properties' ) ?>">Semua</a>
            </li>
            <li>
                <a class="<?= ($type ?? '') == 'Apartemen' ? 'is_active' : '' ?>" href="<?= site_url('home/properties?type=Apartemen' . ($keyword ? "&keyword=$keyword" : '')) ?>">Apartemen</a>
            </li>
            <li>
                <a class="<?= ($type ?? '') == 'Villa' ? 'is_active' : '' ?>" href="<?= site_url('home/properties?type=Villa' . ($keyword ? "&keyword=$keyword" : '')) ?>">Villa</a>
            </li>
            <li>
                <a class="<?= ($type ?? '') == 'Hotel' ? 'is_active' : '' ?>" href="<?= site_url('home/properties?type=Hotel' . ($keyword ? "&keyword=$keyword" : '')) ?>">Hotel</a>
            </li>
            <li>
                <a class="<?= ($type ?? '') == 'Ruko' ? 'is_active' : '' ?>" href="<?= site_url('home/properties?type=Ruko' . ($keyword ? "&keyword=$keyword" : '')) ?>">Ruko</a>
            </li>
            <li>
                <a class="<?= ($type ?? '') == 'Rumah' ? 'is_active' : '' ?>" href="<?= site_url('home/properties?type=Rumah' . ($keyword ? "&keyword=$keyword" : '')) ?>">Rumah</a>
            </li>
            <li>
                <a class="<?= ($type ?? '') == 'Tanah' ? 'is_active' : '' ?>" href="<?= site_url('home/properties?type=Tanah' . ($keyword ? "&keyword=$keyword" : '')) ?>">Tanah</a>
            </li>
            <li>
                <a class="<?= ($type ?? '') == 'Gudang' ? 'is_active' : '' ?>" href="<?= site_url('home/properties?type=Gudang' . ($keyword ? "&keyword=$keyword" : '')) ?>">Gudang</a>
            </li>
        </ul>
    </div>
<div class="row properties-box">
     <?php if ($totalProperties == 0): ?>
        <div class="col-12">
            <div class="alert alert-warning">
                Tidak ada properti yang ditemukan. Silakan coba pencarian lain.
            </div>
        </div>
    <?php else: ?>
<?php foreach ($properties as $property): ?>
    <div class="col-lg-4 col-md-6 align-self-center mb-30 properties-items col-md-6 <?= strtolower($property['property_type']) ?>">
        <div class="item property-card">
            <a href="<?= site_url('home/properties_info/' . $property['id']) ?>">
                <?php if (!empty($property['photos'])): ?>
                    <div id="propertyCarousel<?= esc($property['id']) ?>" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <?php foreach ($property['photos'] as $key => $photo): ?>
                                <div class="carousel-item <?= $key === 0 ? 'active' : '' ?>">
                                    <img src="<?= esc($photo['url']) ?>" class="d-block w-100" alt="Foto Properti" style="height: 200px; object-fit: cover;">
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <ol class="carousel-indicators">
                            <?php for ($i = 0; $i < count($property['photos']); $i++): ?>
                                <li data-target="#propertyCarousel<?= esc($property['id']) ?>" data-slide-to="<?= $i ?>" <?= $i === 0 ? 'class="active"' : '' ?>></li>
                            <?php endfor; ?>
                        </ol>
                    </div>
                <?php else: ?>
                    <img src="<?= base_url('path/to/default/image.jpg') ?>" alt="Default Property Image">
                <?php endif; ?>
            </a>
            <span class="category"><?= esc($property['property_type']) ?> </span>
            <span class="status"><?= esc($property['status'] ?? 'N/A') ?></span>
            <span class="added-date">Tayang Sejak: <?= date('d M Y', strtotime($property['created_at'])) ?></span>
            <h6 class="price">Rp<?= number_format($property['price'], 0, ',', '.') ?></h6>
            <h4><a href="<?= site_url('home/properties_info/' . $property['id']) ?>"><?= esc($property['name']) ?></a></h4>
            <!-- <p class="text-muted"><?= esc($property['area']) ?></p>
            <ul>
                <li>Kamar Tidur: <span><?= esc($property['bedroom']) ?></span></li>
                <li>Kamar Mandi: <span><?= esc($property['bathroom']) ?></span></li>
                <li>Luas Tanah: <span><?= esc($property['land_area']) ?>m²</span></li>
                <li>Luas Bangunan: <span><?= esc($property['building_size']) ?>m²</span></li>
                <li>
                    <?php
                    $location = $property['location'];
                    $mapUrl = (strpos($location, 'http') === 0) ? $location : "https://www.google.com/maps/search/?api=1&query=" . urlencode($location);
                    ?>
                    <a href="<?= esc($mapUrl) ?>" target="_blank" title="Lihat di Google Maps">
                        <i class="fas fa-map-marker-alt"></i> 
                        <?= esc(strpos($location, 'http') === 0 ? 'Lihat Lokasi' : $location) ?>
                    </a>
                </li>
            </ul> -->
            <div class="card-footer bg-white">
                <div class="d-flex align-items-center">
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
                <div class="mt-2">
                    <a href="tel:<?= esc($property['agent']['phone'] ?? '') ?>" class="btn btn-outline-secondary mr-2"><i class="fas fa-phone"></i></a>
                    <a href="https://wa.me/<?= esc($property['agent']['phone'] ?? '') ?>" class="btn btn-success"><i class="fab fa-whatsapp"></i> WhatsApp</a>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

    <?php endif; ?>
</div>
      <?php if ($totalPages > 1): ?>
    <div class="row">
        <div class="col-lg-12">
            <ul class="pagination">
                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <li>
                        <a class="<?= $i == $currentPage ? 'is_active' : '' ?>" 
                           href="<?= site_url('home/properties?' . http_build_query(array_merge($_GET, ['page' => $i]))) ?>">
                            <?= $i ?>
                        </a>
                    </li>
                <?php endfor; ?>
                <?php if ($currentPage < $totalPages): ?>
                    <li>
                        <a href="<?= site_url('home/properties?' . http_build_query(array_merge($_GET, ['page' => $currentPage + 1]))) ?>">
                            >>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
<?php endif; ?>

  <!-- Scripts -->
  <!-- Bootstrap core JavaScript -->
  <script src="<?= base_url() ?>/temp/assets/2/vendor/jquery/jquery.min.js"></script>
  <script src="<?= base_url() ?>/temp/assets/2/vendor/bootstrap/js/bootstrap.min.js"></script>
  <script src="<?= base_url() ?>/temp/assets/2/assets/js/isotope.min.js"></script>
  <script src="<?= base_url() ?>/temp/assets/2/assets/js/owl-carousel.js"></script>
  <script src="<?= base_url() ?>/temp/assets/2/assets/js/counter.js"></script>
  <script src="<?= base_url() ?>/temp/assets/2/assets/js/custom.js"></script>
  <script>
document.addEventListener('DOMContentLoaded', function() {
    var filterLinks = document.querySelectorAll('.properties-filter a');
    filterLinks.forEach(function(link) {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            var url = new URL(this.href);
            window.location.href = url.toString();
        });
    });
});
</script>
       <?= $this->include('home/layouts/footer')?>

</body>

</html>