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
<style>
    .kpr-calculator {
        max-width: 90%;
        margin: 60px auto 30px;
        background-color: #fff;
        padding: 5%;
        border-radius: 10px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
    }

    .kpr-calculator h2 {
        font-size: 1.75rem;
        text-align: center;
        margin-bottom: 1.5rem;
        font-weight: 600;
    }

    .form-group {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }

    .form-item {
        position: relative;
    }

    .kpr-calculator label {
        display: block;
        font-weight: bold;
        margin-bottom: 0.5rem;
        color: #444;
    }

    .input-wrapper {
        display: flex;
        align-items: center;
    }

    .kpr-calculator input[type="number"],
    .kpr-calculator input[type="text"] {
        width: 100%;
        padding: 0.75rem;
        border: 1px solid #bbddff;
        border-radius: 5px;
        box-sizing: border-box;
        font-size: 1rem;
        background-color: #f0f8ff;
    }

    .unit {
        margin-left: 10px;
        color: #0066cc;
        font-size: 0.875rem;
        font-weight: 600;
        white-space: nowrap;
    }

    .result {
        background-color: #e6f7ff;
        padding: 1.25rem;
        border-radius: 5px;
        margin-top: 1.875rem;
        text-align: center;
        border: 1px solid #99ccff;
    }

    .result h2 {
        color: #305b9c;
        margin-bottom: 1.25rem;
    }

    #harga_properti_cocok {
        font-size: 1.75rem;
        font-weight: bold;
        display: block;
        margin-bottom: 0.625rem;
        color: #0066cc;
    }

    #cicilan_perbulan {
        font-size: 1rem;
        color: #444;
        display: block;
        margin-bottom: 1.25rem;
    }

    #propertySearchForm {
        text-align: center;
        margin-top: 1.875rem;
    }

    #searchPropertyBtn {
        background-color: #0f2182;
        color: #fff;
        padding: 0.875rem 1.5rem;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 1.125rem;
        font-weight: bold;
        transition: background-color 0.3s, transform 0.1s;
    }

    #searchPropertyBtn:hover {
        background-color: #0e195a;
        transform: translateY(-2px);
    }

    #searchPropertyBtn:disabled {
        background-color: #dddddd;
        color: #888;
        cursor: not-allowed;
        transform: none;
    }

    @media (max-width: 768px) {
        .kpr-calculator {
            padding: 1.25rem;
        }

        .form-group {
            grid-template-columns: 1fr;
        }

        .kpr-calculator input[type="number"],
        .kpr-calculator input[type="text"] {
            font-size: 0.875rem;
        }

        .unit {
            font-size: 0.75rem;
        }

        #harga_properti_cocok {
            font-size: 1.5rem;
        }

        #cicilan_perbulan {
            font-size: 0.875rem;
        }

        #searchPropertyBtn {
            font-size: 1rem;
            padding: 0.75rem 1.25rem;
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
                    <span class="breadcrumb"><a href="<?php echo base_url('/'); ?>">Beranda</a> / Kredit Kepemilikan Rumah</span>
                    <h3>Kredit Kepemilikan Rumah</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="kpr-calculator">
        <h2>Kalkulator KPR</h2>
        <p>Gunakan kalkulator ini untuk menghitung estimasi biaya KPR dari harga hunian:</p>
        <form>
            <div class="form-group">
                <div class="form-item">
                    <label for="pendapatan_pokok">Pendapatan Pokok</label>
                    <div class="input-wrapper">
                        <input type="number" id="pendapatan_pokok" name="pendapatan_pokok"  placeholder="Pendapatan bersih gabungan" required>
                        <span class="unit">per bulan</span>
                    </div>
                </div>
                <div class="form-item">
                    <label for="cicilan_lain">Estimasi Cicilan Lain</label>
                    <div class="input-wrapper">
                        <input type="number" id="cicilan_lain" name="cicilan_lain" placeholder="Cicilan lainnya" required>
                        <span class="unit">per bulan</span>
                    </div>
                </div>
                <div class="form-item">
                    <label for="lama_pinjaman">Lama Pinjaman</label>
                    <div class="input-wrapper">
                        <input type="number" id="lama_pinjaman" name="lama_pinjaman" min="5" max="25" value="20" required>
                        <span class="unit">tahun</span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="form-item">
                    <label for="bunga_pinjaman">Bunga Pinjaman</label>
                    <div class="input-wrapper">
                        <input type="text" id="bunga_pinjaman" name="bunga_pinjaman" value="6.25%" disabled>
                        <span class="unit">per tahun</span>
                    </div>
                </div>
                <div class="form-item">
                    <label for="uang_muka">Uang Muka (DP)</label>
                    <div class="input-wrapper">
                        <input type="text" id="uang_muka" name="uang_muka" readonly>
                        <span class="unit">20%</span>
                    </div>
                </div>
                <div class="form-item">
                    <label for="kemampuan_angsuran">Kemampuan Angsuran</label>
                    <div class="input-wrapper">
                        <input type="number" id="kemampuan_angsuran" name="kemampuan_angsuran" min="1" max="100" value="30" required>
                        <span class="unit">% dari pendapatan</span>
                    </div>
                </div>
            </div>
        </form>

        <div class="result">
            <h2>Hasil Simulasi:</h2>
            <span id="harga_properti_cocok">Rp0</span>
            <span id="cicilan_perbulan">Cicilan per bulan: Rp0</span>
        </div>

        <form id="propertySearchForm" action="<?= site_url('home/properties') ?>" method="GET">
            <input type="hidden" id="max_price" name="max_price" value="">
            <button type="submit" id="searchPropertyBtn" disabled>Lihat Hunianmu!</button>
        </form>
    </div>
<div class="kpr-info" style="max-width: 1000px; margin: 60px auto 30px; background-color: #fff; padding: 30px; border-radius: 10px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15); font-family: 'Poppins', sans-serif;">
    <div style="text-align: justify;">

        <h2 style="font-size: 28px; text-align: center; margin-bottom: 40px; font-weight: 600;">Informasi KPR</h2>

        <h3 style="font-weight: bold; font-size: 22px; margin-top: 30px; margin-bottom: 20px;">Apa itu KPR</h3>
        <p style="line-height: 1.6;">KPR atau Kredit Pemilikan Rumah adalah fasilitas pinjaman yang diberikan oleh bank kepada nasabah untuk membeli rumah atau properti. Dengan KPR, nasabah dapat memiliki rumah dengan cara mencicil pembayaran dalam jangka waktu tertentu.</p>

       <h3 style="font-weight: bold; font-size: 22px; margin-top: 30px; margin-bottom: 20px;">Jenis KPR</h3>
<ol style="padding-left: 20px; line-height: 1.6;">
    <li>-<strong>KPR Konvensional.</strong> Menggunakan sistem bunga tetap atau mengambang. Bunga tetap memberikan kepastian cicilan, sementara bunga mengambang dapat berfluktuasi sesuai kondisi ekonomi.</li>
    <li>-<strong>KPR Syariah.</strong> Menggunakan prinsip-prinsip syariah tanpa bunga. Biasanya menggunakan akad murabahah (jual-beli) atau musyarakah mutanaqisah (kerjasama kepemilikan).</li>
    <li>-<strong>KPR Subsidi.</strong> Diperuntukkan bagi masyarakat berpenghasilan rendah dengan bantuan subsidi dari pemerintah. Memiliki suku bunga yang lebih rendah dan persyaratan yang lebih ringan.</li>
    <li>-<strong>KPR Refinancing.</strong> Untuk mengganti KPR yang sudah ada dengan KPR baru. Biasanya digunakan untuk mendapatkan suku bunga yang lebih rendah atau memperpanjang tenor.</li>
</ol>

<h3 style="font-weight: bold; font-size: 22px; margin-top: 30px; margin-bottom: 20px;">Syarat Pengajuan KPR</h3>
<ul style="padding-left: 20px; line-height: 1.6; list-style-type: none;">
    <li>1. Usia minimal 21 tahun dan maksimal 55 tahun saat KPR lunas.</li>
    <li>2. Memiliki pekerjaan tetap dengan penghasilan yang mencukupi.</li>
    <li>3. Menyediakan uang muka sesuai ketentuan bank.</li>
    <li>4. Melengkapi dokumen seperti KTP, KK, slip gaji, NPWP, dan lainnya.</li>
    <li>5. Memiliki riwayat kredit yang baik.</li>
</ul>

       <h3 style="font-weight: bold; font-size: 22px; margin-top: 30px; margin-bottom: 20px;">Contoh Simulasi KPR</h3>
<p style="line-height: 1.6;">
Berdasarkan simulasi KPR dengan pendapatan pokok Rp30.000.000 per bulan, cicilan lain Rp3.000.000, dan jangka waktu KPR 20 tahun dengan bunga 6,25% per tahun, hasil perhitungannya adalah sebagai berikut: Pendapatan bersih Anda Rp27.000.000 per bulan, dengan kemampuan angsuran maksimal 30% yaitu Rp8.100.000 per bulan. Dengan angsuran tersebut, Anda dapat membeli properti seharga Rp1.108.179.979. Uang muka yang diperlukan adalah 20% dari harga properti, yaitu Rp221.635.995,8, sehingga pokok pinjaman yang akan Anda ajukan ke bank sebesar Rp886.543.983,2. Cicilan per bulan yang harus Anda bayar selama 20 tahun adalah Rp8.100.000. Perlu diingat bahwa ini adalah estimasi dan angka sebenarnya dapat bervariasi tergantung pada kebijakan bank dan faktor lainnya.
</p>
        <p style="line-height: 1.6; margin-top: 20px;">Perlu diingat bahwa ini hanya contoh simulasi sederhana. Perhitungan aktual dapat berbeda tergantung pada kebijakan bank dan jenis KPR yang dipilih.</p>

    </div>
</div>
    <!-- Bootstrap core JavaScript -->
    <script src="<?= base_url() ?>/temp/assets/2/vendor/jquery/jquery.min.js"></script>
    <script src="<?= base_url() ?>/temp/assets/2/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?= base_url() ?>/temp/assets/2/assets/js/isotope.min.js"></script>
    <script src="<?= base_url() ?>/temp/assets/2/assets/js/owl-carousel.js"></script>
    <script src="<?= base_url() ?>/temp/assets/2/assets/js/counter.js"></script>
    <script src="<?= base_url() ?>/temp/assets/2/assets/js/custom.js"></script>
    <script>
   // Fungsi untuk memformat angka menjadi format mata uang Rupiah
function formatCurrency(number) {
    // Menggunakan Intl.NumberFormat untuk memformat angka menjadi mata uang IDR
    return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(number);
}

// Fungsi utama untuk menghitung KPR
function calculateKpr() {
    // Mengambil nilai input dan mengkonversinya ke tipe float, jika kosong maka nilai default 0
    const pendapatanPokok = parseFloat(document.getElementById('pendapatan_pokok').value) || 0;
    const cicilanLain = parseFloat(document.getElementById('cicilan_lain').value) || 0;
    const lamaPinjaman = parseFloat(document.getElementById('lama_pinjaman').value) || 20;
    const kemampuanAngsuran = parseFloat(document.getElementById('kemampuan_angsuran').value) || 30;

    // Menghitung pendapatan bersih (minimal 0)
    const pendapatanBersih = Math.max(pendapatanPokok - cicilanLain, 0);
    // Menghitung kemampuan angsuran maksimal berdasarkan persentase dari pendapatan bersih
    const kemampuanAngsuranMaksimal = pendapatanBersih * (kemampuanAngsuran / 100);

    // Jika pendapatan bersih atau kemampuan angsuran maksimal 0 atau negatif
    if (pendapatanBersih <= 0 || kemampuanAngsuranMaksimal <= 0) {
        // Set semua nilai output menjadi 0 atau kosong
        document.getElementById('harga_properti_cocok').textContent = formatCurrency(0);
        document.getElementById('cicilan_perbulan').textContent = `Cicilan per bulan: ${formatCurrency(0)}`;
        document.getElementById('uang_muka').value = formatCurrency(0);
        document.getElementById('max_price').value = 0;
        document.getElementById('searchPropertyBtn').disabled = true;
        return; // Keluar dari fungsi
    }

    // Menghitung bunga per bulan (6.25% per tahun dibagi 12 bulan)
    const bungaPerBulan = 0.0625 / 12;
    // Menghitung pembilang untuk rumus harga properti
    const pembilang = kemampuanAngsuranMaksimal * (Math.pow((1 + bungaPerBulan), (lamaPinjaman * 12)) - 1) / bungaPerBulan;
    // Menghitung penyebut untuk rumus harga properti
    const penyebut = Math.pow((1 + bungaPerBulan), (lamaPinjaman * 12));
    // Menghitung harga properti
    const hargaProperti = pembilang / penyebut;
    // Cicilan per bulan sama dengan kemampuan angsuran maksimal
    const cicilanPerBulan = kemampuanAngsuranMaksimal;
    // Menghitung uang muka (20% dari harga properti)
    const uangMuka = hargaProperti * 0.2;

    // Memastikan harga properti tidak negatif dan dibulatkan
    const hargaPropertiCocok = Math.max(Math.round(hargaProperti), 0);

    // Menampilkan hasil perhitungan ke dalam elemen-elemen HTML
    document.getElementById('harga_properti_cocok').textContent = formatCurrency(hargaPropertiCocok);
    document.getElementById('cicilan_perbulan').textContent = `Cicilan per bulan: ${formatCurrency(cicilanPerBulan)}`;
    document.getElementById('uang_muka').value = formatCurrency(uangMuka);

    // Set nilai max_price untuk pencarian properti
    document.getElementById('max_price').value = hargaPropertiCocok;
    // Mengaktifkan atau menonaktifkan tombol pencarian berdasarkan harga properti
    document.getElementById('searchPropertyBtn').disabled = hargaPropertiCocok <= 0;
}

// Menambahkan event listener untuk setiap input bertipe number
const inputs = document.querySelectorAll('input[type="number"]');
inputs.forEach(input => {
    // Memanggil fungsi calculateKpr setiap kali input berubah
    input.addEventListener('input', calculateKpr);
});

// Memanggil fungsi calculateKpr saat halaman dimuat
calculateKpr();
    </script>
 <?= $this->include('home/layouts/footer')?>

</body2>

</html>