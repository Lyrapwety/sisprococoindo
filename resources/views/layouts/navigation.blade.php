<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<style>
    /* Sidebar */
    .sidebar {
        height: 100vh;
        /* Sidebar memiliki tinggi penuh layar */
        background-color: #104367;
        padding-top: 10px;
        position: fixed;
        overflow-y: auto;
        /* Aktifkan scroll secara vertikal */
    }

    /* Gaya Logo Sidebar */
    .sidebar-logo-container {
        display: flex;
        align-items: center;
        padding: 0 20px;
        margin-bottom: 15px;
    }

    .sidebarlogo {
        width: 30%;
        height: auto;
        margin-top: 10px;
        padding: 0;
        transform: translateX(-5px);
        transform: translateY(-12px);
    }

    .sidebar-logo-container p {
        color: white;
        font-weight: 400;
        margin-left: 20px;
        font-size: 11px;
        line-height: 2;
        text-align: center !important;
        letter-spacing: 0.5px;
        transform: translateX(-8px) translateY(-11px);
        margin-bottom: 0;
    }

    /* Gaya untuk garis horizontal */
    .horizontal-line {
        border: none;
        border-bottom: 0.5px solid white;
        margin-top: 5px;
        width: 100%;
        margin-bottom: 15px;
        opacity: 70%;
        transform: translateY(-15px);
    }

    /* Dropdown Button */
    .dropdown-btn {
        padding: 15px 20px;
        font-size: 12px;
        color: white;
        border: none;
        background: none;
        text-align: left;
        cursor: pointer;
        width: 100%;
        outline: none;
        display: flex;
        justify-content: flex-start;
        vertical-align: middle;
        align-items: center;
        gap: 10px;
        /* Menambahkan jarak antara ikon dan teks */
    }

    .dropdown-btn img {
        width: 25px;
        height: 25px;
        margin-right: 15px;
        vertical-align: middle;
        padding-left: 0;
        color: white;
    }

    .dropdown-btn:hover {
        background-color: #3e759d;
    }

    /* Dropdown Arrow */
    .dropdown-arrow {
        margin-left: auto;
        right: 30px;
    }

    /* Dropdown Container */
    .dropdown-container {
        display: none;
        background-color: #104367;
        padding-left: 80px;
    }

    .dropdown-container a {
        padding: 10px 0;
        text-decoration: none;
        font-size: 12px;
        color: white;
        display: block;
    }

    .dropdown-container a:hover {
        background-color: #3e759d;
    }


    .fa-folder-open,
    .fa-file-lines,
    .fa-gears,
    .fa-house,
    .fa-box-archive {
        color: white;
        vertical-align: middle;
    }

    .fa-house {
        margin-right: 11px;
        transform: translateX(-3px);
        font-size: 21px;
    }

    .fa-folder-open {
        margin-right: 15px;
        font-size: 19px;
    }

    .fa-file-lines {
        margin-right: 18px;
        font-size: 23px;
    }

    .fa-gears {
        margin-right: 12px;
        font-size: 21px;
    }

    .fa-box-archive {
        margin-right: 18px;
        font-size: 21px;
    }

    .fa-search {
        align-items: right;
    }


    .sidebar::-webkit-scrollbar {
        width: 6px;
    }

    .sidebar::-webkit-scrollbar-thumb {
        background-color: #306a97;
        border-radius: 6px;
    }

    .sidebar::-webkit-scrollbar-track {
        background-color: #104367;
    }

    .user-folder {
        width: 24px;
        height: 24px;
        filter: invert(1);
    }

    .no_underline {
        text-decoration: none;
    }

    .dash {
        text-decoration: none;
        color: white;

    }
</style>
<div class="flex h-screen">
    <!-- Sidebar -->
    <aside class="sidebar w-64 bg-gray-100">
        <div x-data="{ open: false }" class="flex h-screen">
            <!-- Tombol hamburger untuk layar kecil -->
            <div class="absolute top-4 left-4 sm:hidden">
                <button @click="open = !open" class="p-2 text-white bg-blue-600 rounded-md">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
            <aside :class="{ 'block': open, 'hidden': !open }"
                class="sidebar bg-gray-100 fixed sm:block w-64 hidden sm:relative sm:flex-shrink-0 h-full z-50"
                @click.away="open = false">
                <div class="sidebar-logo-container">
                    <img src="{{ asset('img/logonobackground.png') }}" alt="Cocoindo Logo" class="sidebarlogo">
                    <p>COCOINDO ABADI<br> SUKSES</p>
                </div>
                <hr class="horizontal-line">

                <div>
                    <a href="{{ route('dashboard') }}" style="text-decoration: none; color: inherit;">
                        <button class="dropdown-btn">
                            <i class="fa-solid fa-house"></i>Dashboard
                        </button>
                    </a>
                </div>


                </button>
                <button class="dropdown-btn"><i class="fa-solid fa-file-lines"></i>Laporan Harian Hasil Kerja
                    <span class="dropdown-arrow">&#9662;</span>
                </button>
                <div class="dropdown-container">
                    <a href="{{ route('laporan.dkp.index') }}">DKP</a>
                    <a href="{{ route('laporan.dkp_reject.index') }}">DKP Reject</a>
                    <a href="{{ route('laporan.kulitari.index') }}">Kulit Ari </a>
                    <a href="{{ route('laporan.airkelapa.index') }}">Air Kelapa</a>
                    <a href="{{ route('laporan.tempurung.index') }}">Tempurung</a>
                </div>

                <button class="dropdown-btn"><i class="fa-regular fa-folder-open"></i>Rekap Hasil Kerja
                    <span class="dropdown-arrow">&#9662;</span>
                </button>
                <div class="dropdown-container">

                    <a href="{{ route('rekap_laporan.pembukaan_kulit_ari.index') }}">Kulit Ari - Parer</a>
                </div>

                <button class="dropdown-btn"><i class="fa-solid fa-gears"></i>Produksi
                    <span class="dropdown-arrow">&#9662;</span>
                </button>
                <div class="dropdown-container">
                    <a href="{{ route('produksi.santan.index') }}">Santan</a>
                    <a href="{{ route('produksi.air_kelapa.index') }}">Air Kelapa</a>
                </div>

                <button class="dropdown-btn"><i class="fa-solid fa-box-archive"></i>Stok Barang
                    <span class="dropdown-arrow">&#9662;</span>
                </button>
                <div class="dropdown-container">
                    <a href="{{ route('card_stock.dkp.index') }}">DKP</a>
                    <a href="{{ route('card_stock.kelapa_bulat') }}">Kelapa Bulat</a>
                    <a href="{{ route('card_stock.KB_Kelapa_Bulat.index') }}">KB Kelapa Bulat</a>
                    <a href="{{ route('card_stock.santan.index') }}">Santan</a>
                    <a href="{{ route('card_stock.air_kelapa.index') }}">Air Kelapa</a>
                    <a href="{{ route('card_stock.kulit_ari_kering.index') }}">Kulit Ari Kering</a>
                    <a href="{{ route('card_stock.kulit_ari_basah.index') }}">Kulit Ari Basah</a>
                    <a href="{{ route('card_stock.minyak_kelapa.index') }}">Minyak Kelapa</a>
                    <a href="{{ route('card_stock.dkp_reject_kering.index') }}">DKP Reject Kering</a>
                    <a href="{{ route('card_stock.dkp_reject_basah.index') }}">DKP Reject Basah</a>
                    <a href="{{ route('card_stock.tempurung_basah.index') }}">Tempurung Basah</a>
                    <a href="{{ route('card_stock.ampas_kering_putih.index') }}">Ampas Kering Putih</a>
                    <a href="{{ route('card_stock.ampas_kering_yellow.index') }}">Ampas Kering Yellow</a>

                </div>

                <a class="no_underline" href="{{ route('data_pegawai.index') }}">
                    <button class="dropdown-btn">
                        <img class="user-folder" src="https://img.icons8.com/material/24/user-folder.png"
                            alt="user-folder" />Data Pegawai
                    </button>
                </a>
        </div>
    </aside>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col">
        <!-- Topbar (Navbar) -->
        <nav class="bg-[#F7F7F7] border-b border-gray-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-20">
                    <div class="flex">

                    </div>

                    <!-- Settings Dropdown -->
                    <div class="hidden sm:flex sm:items-center sm:ms-6">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button
                                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500  hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                    <div>{{ Auth::user()->name }}</div>
                                    <div class="ms-1">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <x-dropdown-link :href="route('profile.edit')">
                                    {{ __('Profile') }}
                                </x-dropdown-link>

                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    </div>

                    <!-- Hamburger for Mobile -->
                    <div class="-me-2 flex items-center sm:hidden">
                        <button @click="open = ! open"
                            class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                                    stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16" />
                                <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden"
                                    stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Responsive Menu -->
            <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
                <div class="pt-2 pb-3 space-y-1">
                    <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-responsive-nav-link>
                </div>

                <!-- Responsive Settings -->
                <div class="pt-4 pb-1 border-t border-gray-200">
                    <div class="px-4">
                        <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                        <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                    </div>

                    <div class="mt-3 space-y-1">
                        <x-responsive-nav-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-responsive-nav-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-responsive-nav-link :href="route('logout')"
                                onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-responsive-nav-link>
                        </form>
                    </div>
                </div>
            </div>
        </nav>


        <script>
            // Mengambil semua elemen dengan class "dropdown-btn"
            var dropdowns = document.getElementsByClassName("dropdown-btn");

            for (var i = 0; i < dropdowns.length; i++) {
                dropdowns[i].addEventListener("click", function() {
                    // Toggle class "active" untuk mengubah tampilan dropdown
                    this.classList.toggle("active");

                    // Mendapatkan elemen dropdown berikutnya
                    var dropdownContent = this.nextElementSibling;

                    // Toggle tampilan dropdown
                    if (dropdownContent.style.display === "block") {
                        dropdownContent.style.display = "none";
                    } else {
                        dropdownContent.style.display = "block";
                    }
                });
            }

            // Mengambil semua elemen dengan tag <a> di dalam sidebar
            var sidebarLinks = document.querySelectorAll('.sidebar a');

            // Loop melalui setiap elemen <a> dan tambahkan event listener klik
            sidebarLinks.forEach(function(link) {
                link.addEventListener('click', function() {
                    // Menghapus kelas 'active' dari semua link
                    sidebarLinks.forEach(function(link) {
                        link.classList.remove('active');
                    });

                    // Menambahkan kelas 'active' ke link yang di-klik
                    this.classList.add('active');
                });
            });
        </script>
