<html>
    <head>
        <title>Data Penduduk</title>
        <!--Memanggil File CSS-->
        <link rel="stylesheet" type="text/css" href="style/style.css?version=51">
    </head>
    <body>
        <div class="header">
            <h1><center>Data Penduduk</center></h1>
        </div>

        <div class="sidebar-kiri">
            <?php
                include "includes/menu.php"; //ini untuk memanggil file menu
            ?>
        </div>

        <div class="konten">
            <?php
            include "koneksi/koneksi.php"; //untuk koneksi mysql
            switch($_GET['modul']){
                default:
                echo '<h1>Selamat Datang</h1>
                <p>Ini adalah contoh konten yang di dalam nya pada umumnya digunakan untuk menampilkan data dari database, konten gambar, tabel, dan lainnya</p>';
                break;
                case "penduduk": //barang adalah nama modul nya
                include "modul/penduduk.php";
                break;
                case "penduduk_masuk":
                include "modul/penduduk_masuk.php";
                break;
                case "penduduk_pindah":
                include "modul/penduduk_pindah.php";
                break;
                case "laporanbarangkeluar":
                include "modul/laporanbarangkeluar.php";
                break;
                case "laporanbarangmasuk":
                include "modul/laporanbarangmasuk.php";
                break;
            }
            ?>
        </div>
        <?php
        include "includes/footer.php"; //ini untuk memanggil file footer
        ?> 
    </body>
</html>
