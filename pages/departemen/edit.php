<?php
include '../../tampilan/navbar.php';
require_once '../../config/config.php';

// Periksa apakah ID departemen valid
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$id = mysqli_real_escape_string($koneksi, $_GET['id']);

// Ambil data departemen yang akan diedit
$query = "SELECT * FROM departemen WHERE id = '$id'";
$result = mysqli_query($koneksi, $query);

if (mysqli_num_rows($result) == 0) {
    header("Location: index.php");
    exit();
}

$departemen = mysqli_fetch_assoc($result);
?>

<div class="container mx-auto px-4 py-8">
    <div class="max-w-md mx-auto bg-gray-200 text-gray-900 shadow-lg rounded-lg px-8 pt-6 pb-8 mb-4">
        <h2 class="text-2xl font-bold mb-6 text-center text-orange-600">Edit Departemen</h2>
        
        <form action="../../proses/departemen/edit.php" method="POST" class="p-6">
            <input type="hidden" name="id" value="<?php echo $departemen['id']; ?>">
            
            <div class="mb-4">
                <label for="for=nama_departemen" class="block text-orange-700 text-sm font-bold mb-2">Nama Departemen</label>
                <input type="text" name="nama_departemen" id="nama_departemen" required 
                       value="<?php echo htmlspecialchars($departemen['nama_departemen']); ?>"
                       class="shadow appearance-none border border-orange-500 bg-gray-100 text-gray-900 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:ring-2 focus:ring-orange-400"
                    placeholder="Masukkan nama departemen">
            </div>

            <div class="mb-6">
                <label for="deskripsi" class="block text-orange-700 text-sm font-bold mb-2">Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi" 
                          class="shadow appearance-none border border-orange-500 bg-gray-100 text-gray-900 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:ring-2 focus:ring-orange-400"
                          placeholder="Masukkan deskripsi departemen" rows="4"><?php echo htmlspecialchars($departemen['deskripsi'] ?? ''); ?></textarea>
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
</html>