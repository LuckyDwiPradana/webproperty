<?= $this->include('home/layouts/header')?>
<?= $this->include('home/layouts/navbar')?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>Informasi - Total Property</title>

    <!-- Bootstrap CSS -->


    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="<?= base_url() ?>/temp/assets//assets/css/fontawesome.css">
    <link rel="stylesheet" href="<?= base_url() ?>/temp/assets/2/assets/css/templatemo-villa-agency.css">
    <link rel="stylesheet" href="<?= base_url() ?>/temp/assets//assets/css/owl.css">
    <link rel="stylesheet" href="<?= base_url() ?>/temp/assets//assets/css/animate.css">
    <link rel="stylesheet"href="https://unpkg.com/swiper@7/swiper-bundle.min.css"/>

    <style>

        .hero-section {
    text-align: center;
    padding: 30px 0;
        }

        .hero-images img {
            width: 100%;
            max-width: 960px;
            margin: 0 auto;
            display: block;
        }

        .info-section {
            background-color: #ffffff;
            padding: 50px 0;
        }

        .info-card {
            background: linear-gradient(to bottom, #99ccff, #ffffff);
            color: #305b9c;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            transition: all 0.3s ease;
            border: 2px solid #305b9c;
            height: 100%;
        }

        .info-card:hover {
            box-shadow: 0 5px 15px rgba(0,85,170,0.3);
            transform: translateY(-5px);
        }

        .info-card h3 {
            color: #305b9c;
            font-size: 1.5rem;
        }

        .steps-section {
             background: linear-gradient(to bottom, #99ccff, #ffffff);
            color: #305b9c;
            padding: 50px 0;
        }

        .step-card {
            background: #ffffff;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            transition: all 0.3s ease;
            height: 100%;
            color: #305b9c;
        }

        .step-card:hover {
            box-shadow: 0 5px 15px rgba(255,255,255,0.2);
            transform: translateY(-5px);
        }

        .step-number {
            background-color: #305b9c;
            color: #ffffff;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            font-weight: bold;
            margin: 0 auto 20px;
        }

        .slogan-section {
            background: linear-gradient(to right, #305b9c, #003366);
            padding: 40px 0;
            margin-top: 50px;
        }

        .slogan {
            font-size: 2.5rem;
            font-weight: bold;
            color: #ffffff;
            text-align: center;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .slogan-detail {
            font-size: 1.2rem;
            color: #ffffff;
            text-align: center;
            margin-top: 15px;
        }

        @media (max-width: 991px) {
            .hero-images img {
                width: 90%;
            }

            .info-card h3 {
                font-size: 1.3rem;
            }

            .slogan {
                font-size: 2rem;
            }

            .slogan-detail {
                font-size: 1.1rem;
            }
        }

        @media (max-width: 767px) {
            .hero-images img {
                width: 100%;
            }

            .info-card, .step-card {
                margin-bottom: 30px;
            }

            .slogan {
                font-size: 1.8rem;
            }

            .slogan-detail {
                font-size: 1rem;
            }
        }

        @media (max-width: 575px) {
            .hero-section {
                padding: 20px 0;
            }

            .info-section, .steps-section {
                padding: 30px 0;
            }

            .info-card h3 {
                font-size: 1.2rem;
            }

            .slogan {
                font-size: 1.5rem;
            }

            .slogan-detail {
                font-size: 0.9rem;
            }
        }
    </style>
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
          <span class="breadcrumb"><a href="<?php echo base_url('/'); ?>">Beranda</a> / Informasi</span>
          <h3>Informasi</h3>
        </div>
      </div>
    </div>
  </div>
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="hero-images">
            <img src="<?= base_url() ?>/temp/assets/2/assets/images/banner.png" alt="Banner 1" class="img-fluid">
        </div>
    </section>

    <!-- Informasi Section -->
    <section class="info-section">
        <div class="container">
            <h2 class="text-center mb-5">Informasi Penjualan Properti</h2>
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="info-card">
                        <h3>Jenis Properti</h3>
                        <p>Kami menawarkan berbagai jenis properti, mulai dari rumah, apartemen, villa, Gudang, hotel, ruko, hingga tanah.</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="info-card">
                        <h3>Lokasi Strategis</h3>
                        <p>Properti kami tersebar di lokasi-lokasi strategis dengan akses mudah ke berbagai fasilitas.</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="info-card">
                        <h3>Harga Kompetitif</h3>
                        <p>Kami menawarkan harga yang kompetitif dengan berbagai pilihan metode pembayaran.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Second Banner -->
    <section class="hero-section">
        <div class="hero-images">
            <img src="<?= base_url() ?>/temp/assets/2/assets/images/banner1.png" alt="Banner 2" class="img-fluid">
        </div>
    </section>


    <!-- 6 Langkah Cara Mudah Membeli Properti Section -->
    <section class="steps-section">
        <div class="container">
            <h2 class="text-center mb-5">Langkah-Langkah Menuju Kepemilikan Properti Impian Anda</h2>
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="step-card">
                        <div class="step-number">1</div>
                        <h3 class="text-center">Temukan Impian Anda</h3>
                        <p>Mulailah perjalanan Anda menuju kepemilikan properti dengan menjelajahi katalog properti kami yang telah dikurasi dengan cermat. Manfaatkan fitur pencarian pintar kami untuk menyaring pilihan berdasarkan preferensi Anda, seperti lokasi, harga, atau fitur khusus. Visualisasikan masa depan Anda dalam setiap properti melalui foto-foto berkualitas tinggi, tur virtual, dan deskripsi detail yang kami sediakan.</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="step-card">
                        <div class="step-number">2</div>
                        <h3 class="text-center">Terhubung dengan Para Ahli</h3>
                        <p>Hubungkan diri Anda dengan para ahli properti kami yang berpengalaman dan berpengetahuan luas. Tim kami siap memberikan rekomendasi yang dipersonalisasi berdasarkan kebutuhan dan keinginan unik Anda. Manfaatkan wawasan pasar eksklusif dari para profesional kami untuk membuat keputusan yang terinformasi dan strategis dalam pembelian properti Anda.</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="step-card">
                        <div class="step-number">3</div>
                        <h3 class="text-center">Rasakan Pengalaman Langsung</h3>
                        <p>Nikmati pengalaman nyata dengan mengatur tur VIP ke properti-properti pilihan Anda. Ini adalah kesempatan Anda untuk melihat dari dekat dan merasakan atmosfer setiap rumah potensial. Jelajahi lingkungan sekitar, cek fasilitas terdekat, dan bayangkan kehidupan sehari-hari Anda di lokasi tersebut. Tur ini akan membantu Anda membuat keputusan yang lebih mantap dan percaya diri.</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="step-card">
                        <div class="step-number">4</div>
                        <h3 class="text-center">Analisis Keuangan</h3>
                        <p>Selidiki keuangan Anda dengan bantuan tim ahli keuangan kami. Kami akan membantu Anda mengeksplorasi berbagai opsi pembiayaan yang disesuaikan dengan situasi finansial Anda, termasuk berbagai pilihan KPR dan skema pembayaran. Langkah ini akan memastikan Anda memiliki fondasi fiskal yang kuat sebelum melanjutkan ke tahap berikutnya.</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="step-card">
                        <div class="step-number">5</div>
                        <h3 class="text-center">Finalisasi Kesepakatan</h3>
                        <p>Navigasikan proses negosiasi dengan kepercayaan diri seorang profesional. Tim kami akan membimbing Anda dalam menyusun penawaran yang kompetitif dan menarik. Kami akan membantu Anda menegosiasikan harga, syarat, dan kondisi yang menguntungkan, memastikan Anda mendapatkan kesepakatan terbaik untuk properti impian Anda.</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="step-card">
                        <div class="step-number">6</div>
                        <h3 class="text-center">Perjalanan Mulus Menuju Kepemilikan</h3>
                        <p>Nikmati proses administratif yang lancar menuju kepemilikan. Tim kami akan memandu Anda melalui semua dokumen yang diperlukan, memastikan setiap detail terurus dengan baik. Kami akan mengawal Anda melalui proses transaksi yang mulus, dari penandatanganan kontrak hingga serah terima kunci. Akhirnya, Anda bisa merayakan awal baru Anda sebagai pemilik properti dengan penuh kegembiraan dan kepuasan.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Slogan Section -->
    <section class="slogan-section">
        <div class="container">
            <h2 class="slogan">TOP</h2>
            <p class="slogan-detail">Trustful + Objective + Professional</p>
        </div>
    </section>

     <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="<?= base_url() ?>/temp/assets/2/assets/js/isotope.min.js"></script>
    <script src="<?= base_url() ?>/temp/assets/2/assets/js/owl-carousel.js"></script>
    <script src="<?= base_url() ?>/temp/assets/2/assets/js/counter.js"></script>
    <script src="<?= base_url() ?>/temp/assets/2/assets/js/custom.js"></script>

    <?= $this->include('home/layouts/footer')?>
</body>
</html>