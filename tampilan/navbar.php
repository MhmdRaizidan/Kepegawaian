<?php
session_start();

// Cek login
if(!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Dapatkan base URL
$base_url = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . '/pemrograman_basis_data/kepegawaian/';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HR System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body class="bg-gray-200">
<nav class="bg-gray-800 text-orange-400 p-4 shadow-md">
    <div class="container mx-auto flex justify-between items-center">
        <div class="text-xl font-bold">
            <a href="<?php echo $base_url; ?>dashboard.php" class="hover:text-orange-300 transition duration-300">
                Sistem Manajemen
            </a>
        </div>
        <div class="flex space-x-4">
            <a href="<?php echo $base_url; ?>dashboard.php" class="hover:bg-gray-700 px-3 py-2 rounded transition duration-300 
                <?php echo (basename($_SERVER['PHP_SELF']) == 'dashboard.php') ? 'bg-gray-700 text-orange-300' : ''; ?>">
                Dashboard
            </a>
            <a href="<?php echo $base_url; ?>pages/pegawai/index.php" class="hover:bg-gray-700 px-3 py-2 rounded transition duration-300
                <?php echo (strpos($_SERVER['PHP_SELF'], 'pegawai') !== false) ? 'bg-gray-700 text-orange-300' : ''; ?>">
                Pegawai
            </a>
            <a href="<?php echo $base_url; ?>pages/departemen/index.php" class="hover:bg-gray-700 px-3 py-2 rounded transition duration-300
                <?php echo (strpos($_SERVER['PHP_SELF'], 'departemen') !== false) ? 'bg-gray-700 text-orange-300' : ''; ?>">
                Departemen
            </a>
            <a href="<?php echo $base_url; ?>pages/jabatan/index.php" class="hover:bg-gray-700 px-3 py-2 rounded transition duration-300
                <?php echo (strpos($_SERVER['PHP_SELF'], 'jabatan') !== false) ? 'bg-gray-700 text-orange-300' : ''; ?>">
                Jabatan
            </a>
            <a href="<?php echo $base_url; ?>logout.php" class="bg-red-600 px-3 py-2 rounded transition duration-300">
                Logout
            </a>
        </div>
    </div>
</nav>
