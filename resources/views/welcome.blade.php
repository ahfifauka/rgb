<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="shortcut icon" href="{{asset('images/logo/logorgb.png')}}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body class="bg-gray-900 text-gray-200">

    <!-- Header dengan Logo -->
    <header class="bg-gray-800 p-4 shadow-md">
        <div class="container mx-auto flex justify-between items-center">
            <!-- Logo -->
            <div class="flex justify-start items-center gap-2">
                <img src="{{asset('images/logo/logorgb.png')}}" alt="Logo" class="h-12">
                <b>
                    <p class="text-lg text-gray-200">PT. Rajabuana</p>
                </b>
            </div>
            <div class="flex flex-col">
                <b>
                    <p class="text-lg">NAMA</p>
                </b>
                <p class="text-sm text-gray-400">Jabatan</p>
            </div>
        </div>
    </header>

    <!-- Kontainer Dashboard -->
    <div class="container mx-auto p-4 mt-6 mb-16">
        <!-- Judul Dashboard -->
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-200">Selamat Datang dan Bertugas</h1>
        </div>

        <!-- Grid Card -->
        <div class="grid grid-cols-2 gap-4 md:grid-cols-4">
            <!-- Card 1 -->
            <div class="bg-gray-800 shadow-md rounded-lg p-4 flex flex-col items-center">
                <div class="bg-blue-600 p-2 rounded-full mb-2">
                    <i class="fas fa-user text-white text-2xl"></i>
                </div>
                <h2 class="text-md font-semibold text-gray-200">Profile</h2>
            </div>

            <!-- Card 2 -->
            <div class="bg-gray-800 shadow-md rounded-lg p-4 flex flex-col items-center">
                <div class="bg-green-600 p-2 rounded-full mb-2">
                    <i class="fas fa-envelope text-white text-2xl"></i>
                </div>
                <h2 class="text-md font-semibold text-gray-200">Messages</h2>
            </div>

            <!-- Card 3 -->
            <div class="bg-gray-800 shadow-md rounded-lg p-4 flex flex-col items-center">
                <div class="bg-red-600 p-2 rounded-full mb-2">
                    <i class="fas fa-tasks text-white text-2xl"></i>
                </div>
                <h2 class="text-md font-semibold text-gray-200">Tasks</h2>
            </div>

            <!-- Card 4 -->
            <div class="bg-gray-800 shadow-md rounded-lg p-4 flex flex-col items-center">
                <div class="bg-yellow-600 p-2 rounded-full mb-2">
                    <i class="fas fa-bell text-white text-2xl"></i>
                </div>
                <h2 class="text-md font-semibold text-gray-200">Notifications</h2>
            </div>
        </div>
    </div>

    <!-- Navbar Bawah (Fixed) -->
    <nav class="fixed bottom-0 left-0 right-0 bg-gray-800 shadow-lg">
        <div class="container mx-auto p-4 flex justify-between">

            <!-- Home Icon -->
            <a href="#home" class="text-center flex justify-center items-center gap-2 flex-col nav-item" id="home">
                <i class="fas fa-home text-2xl text-gray-300"></i>
                <span class="text-sm text-gray-300">Home</span>
            </a>

            <!-- Keuangan Icon -->
            <a href="#keuangan" class="text-center flex justify-center items-center gap-2 flex-col nav-item" id="keuangan">
                <i class="fas fa-wallet text-2xl text-gray-300"></i>
                <span class="text-sm text-gray-300">Keuangan</span>
            </a>

            <!-- Operational Icon -->
            <a href="#operational" class="text-center flex justify-center items-center gap-2 flex-col nav-item" id="operational">
                <i class="fas fa-cogs text-2xl text-gray-300"></i>
                <span class="text-sm text-gray-300">Operational</span>
            </a>

            <!-- HRD Icon -->
            <a href="#hrd" class="text-center flex justify-center items-center gap-2 flex-col nav-item" id="hrd">
                <i class="fas fa-users text-2xl text-gray-300"></i>
                <span class="text-sm text-gray-300">HRD</span>
            </a>

            <!-- Profile Icon -->
            <a href="#marketing" class="text-center flex justify-center items-center gap-2 flex-col nav-item" id="marketing">
                <i class="fas fa-building text-2xl text-gray-300"></i>
                <span class="text-sm text-gray-300">Marketing</span>
            </a>

        </div>
    </nav>

    <script>
        // Fungsi untuk menambahkan class active ke link yang diklik
        const navLinks = document.querySelectorAll('.nav-item');

        // Tambahkan event listener ke semua link
        navLinks.forEach(link => {
            link.addEventListener('click', function() {
                // Hapus class active dari semua link
                navLinks.forEach(nav => nav.classList.remove('active'));

                // Tambahkan class active ke link yang diklik
                this.classList.add('active');
            });
        });
    </script>

    <!-- Style tambahan untuk class active -->
    <style>
        .active i {
            color: #92E8F1;
            /* Warna ikon saat active */
        }

        .active span {
            color: #92E8F1;
            /* Warna teks saat active */
        }
    </style>

</body>

</html>