<?php
require_once 'database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_pelapor = mysqli_real_escape_string($conn, $_POST['nama_pelapor']);
    $nama_fasilitas = mysqli_real_escape_string($conn, $_POST['nama_fasilitas']);
    $lokasi = mysqli_real_escape_string($conn, $_POST['lokasi']);
    $id_kategori = (int) $_POST['id_kategori'];
    $deskripsi = mysqli_real_escape_string($conn, $_POST['deskripsi']);
    $prioritas = mysqli_real_escape_string($conn, $_POST['prioritas']);

    $query = "INSERT INTO laporan_kerusakan
        (nama_pelapor, nama_fasilitas, lokasi, id_kategori, deskripsi, prioritas)
        VALUES
        ('$nama_pelapor', '$nama_fasilitas', '$lokasi', $id_kategori, '$deskripsi', '$prioritas')";

    if (mysqli_query($conn, $query)) {
        header("Location: index.php?berhasil=1#daftar-laporan");
        exit;
    } else {
        echo "Gagal menyimpan laporan: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pelaporan Kerusakan Fasilitas Sekolah</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <!-- Bagian ini merupakan starter HTML. Belum ada koneksi database ataupun query. -->
    <header
    class="relative bg-cover bg-center text-white"
    style="background-image: linear-gradient(90deg, rgba(8, 25, 55, 0.88), rgba(8, 25, 55, 0.30)), url('sekolah.jpeg');"
>
    <div class="max-w-7xl mx-auto px-6 md:px-10 py-10 md:py-12">

        <div class="max-w-3xl">

            <div class="flex items-center gap-3 mb-5">
            </div>

            <h1 class="text-3xl md:text-4xl font-bold mb-3 leading-tight">
                Sistem Pelaporan Kerusakan Fasilitas Sekolah
            </h1>

            <p class="text-slate-200 text-sm md:text-base mb-7">
                Catat dan pantau laporan kerusakan fasilitas sekolah.
            </p>

            <nav aria-label="Navigasi utama" class="flex flex-wrap gap-3">

                <a
                    href="#form-laporan"
                    class="inline-block bg-white hover:bg-slate-100 !text-slate-900 px-5 py-2.5 rounded no-underline transition text-sm font-semibold"
                >
                    Buat Laporan
                </a>

                <a
                    href="#daftar-laporan"
                    class="inline-block border border-white/70 hover:bg-white hover:text-slate-900 text-white px-5 py-2.5 rounded no-underline transition text-sm font-semibold"
                >
                    Daftar Laporan
                </a>

            </nav>

        </div>

    </div>
</header>

    <main class="max-w-6xl mx-auto px-4 py-10">
        <section id="form-laporan" aria-labelledby="judul-form"
         class="bg-white p-4 md:p-6 rounded-xl shadow-sm border border-slate-200 mb-6 max-w-4xl mx-auto">
            <h2 id="judul-form" class="text-2xl font-bold text-slate-800 mb-2">Form Pelaporan Kerusakan</h2>
            <p class="text-sm text-slate-500 mb-6">Lengkapi data berikut untuk melaporkan fasilitas yang rusak.</p>

            <!-- TANTANGAN BONUS CREATE: Buat proses PHP agar POST menyimpan data. -->
            <form action="" method="post">
                <fieldset>
    <legend class="text-xl font-semibold text-slate-800 mb-4">
        Data Pelaporan
    </legend>

    <div class="mb-4">
        <label for="nama_pelapor" class="form-label fw-semibold text-slate-700">
            Nama pelapor
        </label>
        <input type="text" id="nama_pelapor" name="nama_pelapor"
            maxlength="100" class="form-control" required>
    </div>

    <div class="mb-4">
        <label for="nama_fasilitas" class="form-label fw-semibold text-slate-700">
            Nama fasilitas
        </label>
        <input type="text" id="nama_fasilitas" name="nama_fasilitas"
            maxlength="100" class="form-control" required>
    </div>

    <div class="mb-4">
        <label for="lokasi" class="form-label fw-semibold text-slate-700">
            Lokasi kerusakan
        </label>
        <input type="text" id="lokasi" name="lokasi"
            maxlength="100" class="form-control" required>
    </div>

    <div class="mb-4">
        <label for="id_kategori" class="form-label fw-semibold text-slate-700">
            Kategori fasilitas
        </label>
        <select id="id_kategori" name="id_kategori"
            class="form-select" required>
            <option value="">-- Pilih kategori --</option>
            <option value="1">Elektronik</option>
            <option value="2">Furnitur</option>
            <option value="3">Jaringan</option>
            <option value="4">Peralatan Kelas</option>
        </select>
    </div>

    <div class="mb-4">
        <label for="deskripsi" class="form-label fw-semibold text-slate-700">
            Deskripsi kerusakan
        </label>
        <textarea id="deskripsi" name="deskripsi" rows="4"
            class="form-control" required></textarea>
    </div>

    <div class="mb-4">
    <label for="prioritas" class="form-label text-sm font-semibold text-slate-700">
        Prioritas
    </label>

    <select
        id="prioritas"
        name="prioritas"
        class="form-select"
        required
    >
        <option value="">-- Pilih prioritas --</option>
        <option value="Rendah">Rendah</option>
        <option value="Sedang">Sedang</option>
        <option value="Tinggi">Tinggi</option>
    </select>
    </div>

    <button type="submit"
        class="btn btn-primary px-4 py-2">
        Kirim Laporan
    </button>
</fieldset>
            </form>
        </section>

        <section id="daftar-laporan" aria-labelledby="judul-daftar" class="bg-white p-6 md:p-8 rounded-2xl shadow-sm border border-slate-200 mb-8">
            <h2 id="judul-daftar" class="text-2xl font-bold text-slate-800 mb-2">Daftar Laporan Kerusakan</h2>
            <p class="text-sm text-slate-500 mb-6">Seluruh laporan yang tercatat pada database ditampilkan di bagian ini.</p>
<?php if (isset($_GET['berhasil'])): ?>
    <div class="alert alert-success" role="alert">
        Laporan berhasil dikirim!
    </div>
<?php endif; ?>
            <!-- TANTANGAN WAJIB:
                 1. Buat sendiri koneksi PHP ke MySQL.
                 2. Jalankan query SELECT untuk mengambil data dari laporan_kerusakan.
                 3. Ganti baris placeholder pada tbody dengan perulangan hasil query.
                 4. Jangan mengetik data database secara manual di HTML.
            -->
            <div class="table-responsive">
            <table class="table table-hover table-bordered align-middle">
                <thead>
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Fasilitas</th>
                        <th scope="col">Lokasi</th>
                        <th scope="col">Pelapor</th>
                        <th scope="col">Prioritas</th>
                        <th scope="col">Status</th>
                        <th scope="col">Tanggal</th>
                    </tr>
                </thead>
                <tbody>
    <?php
    $query = "SELECT * FROM laporan_kerusakan ORDER BY tanggal_laporan DESC";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $no = 1;

        while ($row = mysqli_fetch_assoc($result)) {
    ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= htmlspecialchars($row['nama_fasilitas']); ?></td>
                <td><?= htmlspecialchars($row['lokasi']); ?></td>
                <td><?= htmlspecialchars($row['nama_pelapor']); ?></td>
                <td><?= htmlspecialchars($row['prioritas']); ?></td>
                <td><?= htmlspecialchars($row['status']); ?></td>
                <td><?= htmlspecialchars($row['tanggal_laporan']); ?></td>
            </tr>
    <?php
        }
    } else {
    ?>
        <tr>
            <td colspan="7" class="text-center">
                Belum ada laporan kerusakan.
            </td>
        </tr>
    <?php
    }
    ?>
</tbody>
            </table>
            </div>
        </section>
    </main>

    <footer class="bg-slate-900 text-slate-300 text-center px-4 py-5">
        <p class="mb-0 text-sm">
            &copy; 2024 Sistem Pelaporan Kerusakan Fasilitas Sekolah.
        </p>
    </footer>
</body>
</html>
