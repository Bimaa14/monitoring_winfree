<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Winfree Monitoring - Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome untuk ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Leaflet.js CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" crossorigin="" />

    <style>
        body {
            font-family: 'Inter', sans-serif;
            overflow: hidden;
        }
        .sidebar {
            width: 80px;
            transition: width 0.3s;
        }
        .sidebar:hover {
            width: 256px;
        }
        .sidebar .menu-text {
            opacity: 0;
            transition: opacity 0.2s;
            white-space: nowrap;
            overflow: hidden;
            display: inline-block;
        }
        .sidebar:hover .menu-text {
            opacity: 1;
        }
        /* Style untuk peta Leaflet */
        #map {
            height: 100%;
            width: 100%;
        }
        .popup-container {
            font-family: 'Inter', sans-serif;
        }
        .status-online {
            color: #22c55e;
            font-weight: 600;
        }
        .status-offline {
            color: #ef4444;
            font-weight: 600;
        }
        .gmaps-button {
            display: inline-block;
            margin-top: 1rem;
            padding: 0.5rem 1rem;
            color: white;
            background-color: #3b82f6;
            border-radius: 0.5rem;
            text-decoration: none;
            box-shadow: 0 1px 2px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body class="flex bg-gray-100 min-h-screen">

    <!-- Sidebar -->
    <aside class="sidebar bg-white shadow-lg flex flex-col items-center py-4 transition-all duration-300">
        <!-- Logo -->
        <div class="mb-8">
            <img src="{{ asset('images/images.png') }}" alt="WinFree Logo" class="h-10">
        </div>

        <!-- Menu Navigasi -->
        <nav class="flex-grow">
            <ul class="space-y-4">
                <li>
                    <a href="#" class="flex items-center justify-center lg:justify-start lg:space-x-4 p-3 text-gray-600 hover:bg-blue-100 hover:text-blue-600 rounded-xl transition-colors duration-200">
                        <i class="fas fa-th-large text-xl"></i>
                        <span class="menu-text hidden lg:inline-block">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="flex items-center justify-center lg:justify-start lg:space-x-4 p-3 text-gray-600 hover:bg-blue-100 hover:text-blue-600 rounded-xl transition-colors duration-200">
                        <i class="fas fa-database text-xl"></i>
                        <span class="menu-text hidden lg:inline-block">Data Master</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="flex items-center justify-center lg:justify-start lg:space-x-4 p-3 text-gray-600 hover:bg-blue-100 hover:text-blue-600 rounded-xl transition-colors duration-200">
                        <i class="fas fa-users text-xl"></i>
                        <span class="menu-text hidden lg:inline-block">User Management</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="flex items-center justify-center lg:justify-start lg:space-x-4 p-3 text-gray-600 hover:bg-blue-100 hover:text-blue-600 rounded-xl transition-colors duration-200">
                        <i class="fas fa-map-marker-alt text-xl"></i>
                        <span class="menu-text hidden lg:inline-block">Maps Winfree</span>
                    </a>
                </li>
                <!-- Tambahkan menu lain di sini -->
            </ul>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-grow p-8 overflow-y-auto">
        <!-- Header Dashboard -->
        <header class="flex items-center justify-between p-4 bg-white rounded-lg shadow-md mb-8">
            <h1 class="text-xl font-bold text-gray-800">Dashboard Winfree 2025</h1>
            <div class="flex items-center space-x-4">
                <!-- Icon/Profil Pengguna -->
                <button class="flex items-center space-x-2 text-gray-600 hover:text-gray-800">
                    <span>Halo, Admin!</span>
                    <div class="w-8 h-8 rounded-full bg-gray-300"></div>
                </button>
                <a href="#" class="text-blue-600 hover:underline">Logout</a>
            </div>
        </header>

        <!-- Statistik Utama -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Kartu 1: Total Titik Winfree -->
            <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
                <h2 class="text-lg font-semibold text-gray-600 mb-2">Total Titik Winfree</h2>
                <p class="text-4xl font-bold text-gray-800">107</p>
            </div>

            <!-- Kartu 2: Winfree Aktif -->
            <div class="bg-green-500 text-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
                <h2 class="text-lg font-semibold mb-2">Winfree Aktif</h2>
                <p class="text-4xl font-bold">54</p>
            </div>

            <!-- Kartu 3: Winfree Mati -->
            <div class="bg-red-500 text-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
                <h2 class="text-lg font-semibold mb-2">Winfree Mati</h2>
                <p class="text-4xl font-bold">53</p>
            </div>

            <!-- Kartu 4: Titik Baru Tahun Ini -->
            <div class="bg-blue-500 text-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
                <h2 class="text-lg font-semibold mb-2">Titik Baru 2025</h2>
                <p class="text-4xl font-bold">107</p>
            </div>
        </div>

        <!-- Bagian Peta -->
        <div class="mt-8">
            <div class="bg-white p-6 rounded-lg shadow-md" style="height: 70vh;">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Peta Lokasi Winfree</h2>
                <div id="map" style="height: 100%; width: 100%;"></div>
            </div>
        </div>
    </main>
    
    <!-- Leaflet.js JavaScript -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" crossorigin=""></script>
    
    {{-- Skrip khusus untuk halaman peta --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const mapElement = document.getElementById('map');
            const map = L.map(mapElement).setView([-6.9175, 107.6191], 13);
            
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            const resizeObserver = new ResizeObserver(() => {
                map.invalidateSize();
            });
            resizeObserver.observe(mapElement);

            const greenIcon = new L.Icon({
                iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-green.png',
                shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
                iconSize: [25, 41],
                iconAnchor: [12, 41],
                popupAnchor: [1, -34],
                shadowSize: [41, 41]
            });
            const redIcon = new L.Icon({
                iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-red.png',
                shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
                iconSize: [25, 41],
                iconAnchor: [12, 41],
                popupAnchor: [1, -34],
                shadowSize: [41, 41]
            });

            const markerLayer = L.layerGroup().addTo(map);

            async function fetchLocations() {
                try {
                    const response = await fetch('{{ url('/api/locations') }}');
                    if (!response.ok) {
                        throw new Error('Gagal mengambil data lokasi.');
                    }
                    const locations = await response.json();
                    
                    markerLayer.clearLayers();
                    locations.forEach(loc => {
                        const icon = loc.status === 'ONLINE' ? greenIcon : redIcon;
                        const marker = L.marker([loc.latitude, loc.longitude], { icon: icon });
                        const statusClass = loc.status === 'ONLINE' ? 'status-online' : 'status-offline';
                        const popupContent = `<div class="popup-container"><strong>Nama Lokasi:</strong><br>${loc.nama_lokasi}<br><br><strong>Status:</strong><br><span class="${statusClass}">${loc.status}</span><br><a href="https://www.google.com/maps?q=${loc.latitude},${loc.longitude}" target="_blank" class="gmaps-button">Buka di Google Maps</a></div>`;
                        marker.bindPopup(popupContent);
                        markerLayer.addLayer(marker);
                    });
                } catch (error) {
                    console.error('Ada yang salah:', error);
                }
            }

            fetchLocations();
        });
    </script>
</body>
</html>
