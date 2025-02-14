<?php
include '../../tampilan/navbar.php';
require_once '../../config/config.php';
?>

<div class="container mx-auto px-4 py-8">
    <div class="max-w-md mx-auto bg-gray-200 text-gray-900 shadow-lg rounded-lg px-8 pt-6 pb-8 mb-4">
        <h2 class="text-2xl font-bold mb-6 text-center text-orange-600">Tambah Departemen Baru</h2>

        <form action="../../proses/departemen/tambah.php" method="POST" class="space-y-4">
            <div>
                <label for="nama_departemen" class="block text-orange-700 text-sm font-bold mb-2">
                    Nama Departemen
                </label>
                <input type="text" name="nama_departemen" id="nama_departemen" required 
                    class="shadow appearance-none border border-orange-500 bg-gray-100 text-gray-900 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:ring-2 focus:ring-orange-400"
                    placeholder="Masukkan nama departemen">
            </div>

            <div>
                <label for="deskripsi" class="block text-orange-700 text-sm font-bold mb-2">
                    Deskripsi
                </label>
                <textarea name="deskripsi" id="deskripsi" rows="4"
                    class="shadow appearance-none border border-orange-500 bg-gray-100 text-gray-900 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:ring-2 focus:ring-orange-400"
                    placeholder="Masukkan deskripsi departemen"></textarea>
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