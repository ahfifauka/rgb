<header class="bg-gray-800 p-4 shadow-md">
    <div class="container mx-auto flex justify-between items-center">
        <!-- Logo -->
        <a href="{{ route('dashboard') }}">
            <div class="flex justify-start items-center gap-2">
                <img src="{{ asset('images/logo/logorgb.png') }}" alt="Logo" class="h-12">
                <b>
                    <p class="text-lg text-gray-200">PT. Rajawali <br> Buana 86</p>
                </b>
            </div>
        </a>

        <!-- navigation.blade.php -->
        <div class="relative">
            <div id="profileDropdownToggle" class="flex flex-col cursor-pointer">
                <b>
                    <p class="text-lg">{{ Auth::user()->name }}</p>
                </b>
                <p class="text-sm text-gray-400">{{ Auth::user()->jabatan }}</p>
            </div>

            <!-- Dropdown -->
            <div id="profileDropdown"
                class="hidden absolute right-0 mt-2 w-48 bg-gray-600 rounded-md shadow-lg py-2 z-20">
                <a href="{{ route('profile.edit', Auth::user()->id) }}"
                    class="block px-4 py-2 text-sm text-gray-200 hover:bg-gray-800">
                    Profile
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="block w-full text-left px-4 py-2 text-sm text-gray-200 hover:bg-gray-800">
                        Logout
                    </button>
                </form>
            </div>
        </div>
</header>

<!-- Kontainer Dashboard -->
<!-- <div class="container mx-auto p-4 mt-6 mb-16">
    
    <div class="text-center">
        <h1 class="text-3xl font-bold text-gray-200">Selamat Datang dan Bertugas</h1>
    </div>

</div> -->

<!-- Navbar Bawah (Fixed) -->
<nav class="fixed bottom-0 left-0 bg-gray-800 shadow-lg w-full z-50">
    <div class="container mx-auto p-4 flex justify-between">

        <!-- Home Icon -->
        <a href="{{ route('dashboard') }}" class="text-center flex justify-center items-center gap-2 flex-col nav-item"
            id="home">
            <i class="fas fa-home text-2xl text-gray-300"></i>
            <span class="text-sm text-gray-300">Home</span>
        </a>

        <!-- Keuangan Icon -->
        @if( Auth::user()->jabatan == 'administrasi' || Auth::user()->jabatan == 'direktur')
        <a href="{{ route('keuangan.index') }}"
            class="text-center flex justify-center items-center gap-2 flex-col nav-item" id="keuangan">
            <i class="fas fa-wallet text-2xl text-gray-300"></i>
            <span class="text-sm text-gray-300">Keuangan</span>
        </a>
        @endif

        <!-- Operational Icon -->
        @if( Auth::user()->jabatan == 'oprational' || Auth::user()->jabatan == 'direktur')
        <a href="{{ route('oprational.index') }}"
            class="text-center flex justify-center items-center gap-2 flex-col nav-item" id="operational">
            <i class="fas fa-cogs text-2xl text-gray-300"></i>
            <span class="text-sm text-gray-300">Operational</span>
        </a>
        @endif

        <!-- HRD Icon -->
        @if( Auth::user()->jabatan == 'hrd' || Auth::user()->jabatan == 'direktur')
        <a href="{{ route('hrd.index') }}" class="text-center flex justify-center items-center gap-2 flex-col nav-item"
            id="hrd">
            <i class="fas fa-users text-2xl text-gray-300"></i>
            <span class="text-sm text-gray-300">HRD</span>
        </a>
        @endif

        <!-- Profile Icon -->
        @if( Auth::user()->jabatan == 'marketing' || Auth::user()->jabatan == 'direktur')
        <a href="{{ route('marketing.index') }}"
            class="text-center flex justify-center items-center gap-2 flex-col nav-item" id="marketing">
            <i class="fas fa-building text-2xl text-gray-300"></i>
            <span class="text-sm text-gray-300">Marketing</span>
        </a>
        @endif

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
<script>
    // Toggle dropdown visibility
    document.getElementById('profileDropdownToggle').addEventListener('click', function() {
        const dropdown = document.getElementById('profileDropdown');
        dropdown.classList.toggle('hidden');
    });

    // Close dropdown when clicking outside of it
    window.addEventListener('click', function(event) {
        const dropdown = document.getElementById('profileDropdown');
        const toggle = document.getElementById('profileDropdownToggle');

        if (!toggle.contains(event.target) && !dropdown.contains(event.target)) {
            dropdown.classList.add('hidden');
        }
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