<?php
include '../../tampilan/navbar.php';
require_once '../../config/config.php';

// Cek apakah ID pegawai diberikan
if (!isset($_GET['id']) || empty($_GET['id'])) {
    $_SESSION['error'] = "ID Pegawai tidak valid";
    header("Location: index.php");
    exit();
}

$id = mysqli_real_escape_string($koneksi, $_GET['id']);

// Query ambil data pegawai
$query = "SELECT * FROM pegawai WHERE id = '$id'";
$result = mysqli_query($koneksi, $query);

if (mysqli_num_rows($result) == 0) {
    $_SESSION['error'] = "Pegawai tidak ditemukan";
    header("Location: index.php");
    exit();
}

$pegawai = mysqli_fetch_assoc($result);

// Query untuk mendapatkan daftar departemen
$query_departemen = "SELECT * FROM departemen";
$result_departemen = mysqli_query($koneksi, $query_departemen);

// Query untuk mendapatkan daftar jabatan
$query_jabatan = "SELECT * FROM jabatan";
$result_jabatan = mysqli_query($koneksi, $query_jabatan);
?>

<div class="container mx-auto px-4 py-8">
    <div class="max-w-md mx-auto bg-gray-100 shadow-md rounded px-8 pt-6 pb-8 mb-4">
        <h2 class="text-2xl font-bold mb-6 text-center text-orange-600">Edit Pegawai</h2>
        
        <?php 
        if(isset($_SESSION['error'])) {
            echo '<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">' . 
                 $_SESSION['error'] . 
                 '</div>';
            unset($_SESSION['error']);
        }
        ?>

        <form action="../../proses/pegawai/edit.php" method="POST" class="space-y-4">
            <input type="hidden" name="id" value="<?php echo $pegawai['id']; ?>">

            <div>
            <label for="nip" class="block text-orange-700 text-sm font-bold mb-2">
                    NIP
                </label>
                <input 
                    type="text" 
                    id="nip" 
                    name="nip" 
                    required 
                    value="<?php echo htmlspecialchars($pegawai['nip']); ?>"
                    class="shadow appearance-none border border-orange-500 bg-gray-100 text-gray-900 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:ring-2 focus:ring-orange-400"
                    placeholder="Nomor Induk Pegawai"
                >
            </div>

            <div>
            <label for="nama" class="block text-orange-700 text-sm font-bold mb-2">
                    Nama Lengkap
                </label>
                <input 
                    type="text" 
                    id="nama" 
                    name="nama" 
                    required 
                    value="<?php echo htmlspecialchars($pegawai['nama']); ?>"
                    class="shadow appearance-none border border-orange-500 bg-gray-100 text-gray-900 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:ring-2 focus:ring-orange-400"
                    placeholder="Nama Lengkap Pegawai"
                >
            </div>

            <div>
                <label for="jenis_kelamin" class="block text-orange-700 text-sm font-bold mb-2">
                    Jenis Kelamin
                </label>
                <select 
                    id="jenis_kelamin" 
                    name="jenis_kelamin" 
                    required 
                    class="shadow appearance-none border border-orange-500 bg-gray-100 text-gray-900 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:ring-2 focus:ring-orange-400"
                >
                    <option value="Laki-laki" <?php echo $pegawai['jenis_kelamin'] == 'Laki-laki' ? 'selected' : ''; ?>>Laki-laki</option>
                    <option value="Perempuan" <?php echo $pegawai['jenis_kelamin'] == 'Perempuan' ? 'selected' : ''; ?>>Perempuan</option>
                </select>
            </div>

            <div>
                <label for="id_departemen" class="block text-orange-700 text-sm font-bold mb-2">
                    Departemen
                </label>
                <select 
                    id="id_departemen" 
                    name="id_departemen" 
                    required 
                    class="shadow appearance-none border border-orange-500 bg-gray-100 text-gray-900 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:ring-2 focus:ring-orange-400"
                >
                    <option value="">Pilih Departemen</option>
                    <?php while($departemen = mysqli_fetch_assoc($result_departemen)): ?>
                        <option 
                            value="<?php echo $departemen['id']; ?>"
                            <?php echo ($departemen['id'] == $pegawai['id_departemen']) ? 'selected' : ''; ?>
                        >
                            <?php echo htmlspecialchars($departemen['nama_departemen']); ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div>
                <label for="id_jabatan" class="block text-orange-700 text-sm font-bold mb-2">
                    Jabatan
                </label>
                <select 
                    id="id_jabatan" 
                    name="id_jabatan" 
                    required 
                    class="shadow appearance-none border border-orange-500 bg-gray-100 text-gray-900 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:ring-2 focus:ring-orange-400"
                >
                    <option value="">Pilih Jabatan</option>
                    <?php 
                    mysqli_data_seek($result_jabatan, 0); // Reset pointer
                    while($jabatan = mysqli_fetch_assoc($result_jabatan)): 
                    ?>
                        <option 
                            value="<?php echo $jabatan['id']; ?>"
                            <?php echo ($jabatan['id'] == $pegawai['id_jabatan']) ? 'selected' : ''; ?>
                        >
                            <?php echo htmlspecialchars($jabatan['nama_jabatan']); ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div>
                <label for="gaji" class="block text-orange-700 text-sm font-bold mb-2">
                    Gaji
                </label>
                <input 
                    type="text" 
                    id="gaji" 
                    name="gaji" 
                    required 
                    value="<?php echo number_format($pegawai['gaji'], 0, ',', '.'); ?>"
                    class="shadow appearance-none border border-orange-500 bg-gray-100 text-gray-900 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:ring-2 focus:ring-orange-400"
                    placeholder="Contoh: 5.000.000"
                    onkeyup="formatRupiah(this)"
                >
            </div>

            <div>
                <label for="tanggal_masuk" class="block text-orange-700 text-sm font-bold mb-2">
                    Tanggal Masuk
                </label>
                <input 
                    type="date" 
                    id="tanggal_masuk" 
                    name="tanggal_masuk" 
                    required 
                    class="shadow appearance-none border border-orange-500 bg-gray-100 text-gray-900 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:ring-2 focus:ring-orange-400"
                >
            </div>

            <div class="flex items-center justify-between">
                <a 
                    href="index.php" 
                    class="inline-block align-baseline font-bold text-sm text-orange-600 hover:text-orange-800"
                >
                    Kembali
                </a>
                <button 
                    type="submit" 
                    class="bg-orange-600 hover:bg-orange-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                >
                    Update Pegawai
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function formatRupiah(input) {
    // Hapus karakter selain angka
    let value = input.value.replace(/[^\d]/g, '');
    
    // Format dengan titik sebagai pemisah ribuan
    input.value = new Intl.NumberFormat('id-ID').format(value);
}
</script>

</body>
</html>


