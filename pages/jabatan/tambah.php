<?php
include '../../tampilan/navbar.php';
require_once '../../config/config.php';

// Query untuk mendapatkan daftar departemen
$query_departemen = "SELECT * FROM departemen";
$result_departemen = mysqli_query($koneksi, $query_departemen);
?>

<div class="container mx-auto px-4 py-8">
    <div class="max-w-md mx-auto bg-gray-200 text-gray-900 shadow-lg rounded-lg px-8 pt-6 pb-8 mb-4">
        <h2 class="text-2xl font-bold mb-6 text-center text-orange-600">Tambah Jabatan Baru</h2>
        
        <form action="../../proses/jabatan/tambah.php" method="POST" class="p-6">
            <div class="mb-4">
                <label for="nama_jabatan" class="block text-orange-700 text-sm font-bold mb-2">Nama Jabatan</label>
                <input type="text" name="nama_jabatan" id="nama_jabatan" required 
                    class="shadow appearance-none border border-orange-500 bg-gray-100 text-gray-900 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:ring-2 focus:ring-orange-400"
                    placeholder="Masukkan nama jabatan">
            </div>

            <div class="mb-4">
                <label for="nama_jabatan" class="block text-orange-700 text-sm font-bold mb-2">Departemen</>
                <select name="id_departemen" id="id_departemen" required
                            class="shadow appearance-none border border-orange-500 bg-gray-100 text-gray-900 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:ring-2 focus:ring-orange-400">
                    <option value="">Pilih Departemen</option>
                    <?php while($departemen = mysqli_fetch_assoc($result_departemen)): ?>
                        <option value="<?php echo $departemen['id']; ?>">
                            <?php echo htmlspecialchars($departemen['nama_departemen']); ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="mb-6">
                <label for="nama_jabatan" class="block text-orange-700 text-sm font-bold mb-2">Gaji</label>
                <input type="text" name="gaji" id="gaji" required 
                class="shadow appearance-none border border-orange-500 bg-gray-100 text-gray-900 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:ring-2 focus:ring-orange-400"
                placeholder="Masukkan Gaji"
                       onkeyup="formatRupiah(this)">
            </div>

            <div class="flex items-center justify-end space-x-4">
                <a href="index.php" class="inline-block align-baseline font-bold text-sm text-orange-600 hover:text-orange-500">
                    Batal
                </a>
                <button type="submit" class="bg-orange-600 hover:bg--700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

</body>
<script>
function formatRupiah(input) {
    // Hapus karakter selain angka
    let value = input.value.replace(/[^\d]/g, '');
    
    // Format dengan titik sebagai pemisah ribuan
    input.value = formatNumber(value);
}

function formatNumber(number) {
    return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}
</script>
</html>