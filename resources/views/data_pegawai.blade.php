@extends('layouts.app')

@section('content')
    <style>
        /* Mainbar */
        .mainbar {
            flex: 1%;
            background-color: #D9D9D9 !important;
            padding-top: 20px;
            /* Jarak dari topbar */
            margin-left: 235px;
            overflow-y: auto;
            height: calc(100vh - 70px);
            width: calc(100% - 235px);
            font-family: 'Inter', sans-serif;
            !important;
        }

        .container {
            padding: 20px;
            background-color: #F7F7F7;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            border-radius: 15px;
            width: 95%;
            margin-left: 35px;
            font-family: 'Inter', sans-serif;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            border-bottom: 1px solid #e0e0e0;
        }

        .header h2 {
            font-size: 16px;
            margin: 0;
            color: #636362;
            margin-bottom: 10px;
            display: flex;
            justify-content: center;
            text-align: center;
        }

        .filters {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 10px;
            margin: 20px 0;
            font-size: 12px;
        }

        .filters select.pilihtanggal {
            width: 140px !important;
        }

        /* Dropdown tanggal */
        .filters select.pilihtanggal,
        .filters .input-icon input[type="text"] {
            padding: 8px 12px;
            /* Padding yang sama */
            height: 36px;
            /* Tinggi yang sama */
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 12px;
            color: #636362;
            box-shadow: 0px 1px 2px rgba(0, 0, 0, 0.2);
        }

        /* Input pencarian dan ikon */
        .filters .input-icon {
            position: relative;
            width: 250px;
            /* Lebar lebih pendek untuk input pencarian */
        }

        .filters input[type="text"] {
            width: 100%;
            height: 36px;
            padding: 8px 35px 8px 12px;
            /* Tambahkan padding untuk ikon */
            border: 1px solid #cc;
            border-radius: 5px;
            font-size: 12px;

        }

        .caridata {
            color: #636362 !important;
        }


        .filters .input-icon i {
            position: absolute;
            padding-right: 10px;
            top: 50%;
            color: #636362;
        }

        /* Tombol aksi */
        .filters .actions {
            display: flex;
            gap: 10px;
            margin-left: auto;
        }

        .filters .actions button {
            padding: 8px 12px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            font-size: 12px;
            gap: 10px;
        }

        .filters .actions .btn {
            background-color: #104367;
            color: white;
        }

        .filters .actions .btn.add {
            background-color: #71bc74;
            transform: translateX(-2px);


        }

        .filters .actions .btn.export {
            background-color: #e0b063;
            transform: translateX(-2px);

        }

        /* Tabel */
        .table-container {
            overflow-x: auto;
            font-size: 11px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            /* Agar garis antar sel menyatu */
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(230, 238, 241, 0.1);

        }

        table th,
        table td {
            padding: 8px;
            text-align: center;
            border: 1px solid #636362;
            /* Garis antar sel */
            color: #636362;
            font-size: 11px;
        }

        table th {
            border-bottom: 1px solid #636362;
            /* Garis tebal untuk header */
        }

        table td button {
            padding: 8px 10px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            background-color: #104367;
            color: white;
            font-size: 11px;

        }

        table td button.edit {
            background-color: #3498db;
        }

        table td button.delete {
            background-color: #e74c3c;
        }

        /* Pagination */
        .pagination-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
        }

        .showing-entries {
            font-size: 12px;
            color: #636362;
        }

        .pagination {
            list-style: none;
            display: flex;
            gap: 7px;
        }

        .pagination li {
            display: inline-block;
        }

        .pagination button {
            background-color: #E6E3E3;
            border: 1px solid #ddd;
            padding: 5px 10px;
            cursor: pointer;
            border-radius: 7px;
            color: #636362;
            font-size: 12px;
        }

        .pagination button:hover {
            background-color: #104367;
            color: white;
            opacity: 85%;
        }

        .input-icon {
            position: relative;
            width: 100%;
            max-width: 100px;
            /* Sesuaikan dengan kebutuhan */
        }

        .input-icon i {
            position: absolute;
            right: 5px !important;
            /* Pindahkan ikon ke sisi kanan */
            top: 50%;
            transform: translateY(-50%);
            color: #636362;
            /* Warna ikon */
        }

        .input-icon input {
            width: 100%;
            padding: 10px 40px 10px 10px;
            /* Tambahkan padding kanan untuk ruang ikon */
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
            outline: none;

        }

        .input-icon input:focus {
            border-color: #104367;
            /* Ubah warna border saat fokus */
        }

        /* Modal container */
        .horizontalline1 {
            /* Warna teks, tidak berpengaruh pada <hr> */
            border: none;
            /* Hapus border default */
            border-bottom: 0.5px solid #ccc;
            width: 100%;
            /* Lebar penuh */
            margin: 5px 0 15px 0;
            /* Margin atas, kanan, bawah, kiri */
            opacity: 0.5;
            /* Nilai opasitas (1 = tidak transparan) */
            padding-top: 20px;
        }

        .btn.export {
            display: flex;
            align-items: center;
            /* Mengatur ikon dan teks dalam satu baris */
            color: white;
            /* Mengatur warna teks menjadi putih */
            border: none;
            /* Menghapus border default */
            /* Menambahkan padding */
            cursor: pointer;
            /* Menambahkan kursor pointer */
        }

        .btn.export img {
            /* Jarak antara ikon dan teks */
            filter: brightness(0) invert(1);


        }

        .search-input::placeholder {
            color: #636362;
            /* Ganti dengan warna yang diinginkan */
            opacity: 1;
            /* Mengatur opasitas jika perlu */
        }

        .fixed-width {
            width: 60px;
            /* Anda bisa menyesuaikan lebar sesuai kebutuhan */
            max-width: 60px;
            /* Membatasi lebar maksimum */
            min-width: 50px;
            /* Membatasi lebar minimum */
            white-space: nowrap;
            /* Mencegah teks untuk wrap ke baris baru */
            overflow: hidden;
            /* Menyembunyikan teks yang melebihi lebar kolom */
            text-overflow: ellipsis;
            /* Mengganti teks yang terpotong dengan elipsis (...) */
        }
    </style>

    <div class="mainbar">
        <div class="container">
            <div class="header">
                <h2>Data Pegawai</h2>
            </div>

            <!-- Filter Section -->
            <div class="filters">
                <select class="pilihtanggal">
                    <option>Pilih Departemen</option>
                    <option>Kupas</option>
                    <option>Produksi</option>
                    <option>Office</option>
                    <option>IPAL</option>

                </select>
                <div class="input-icon">
                    <input type="text" placeholder="Cari Data" class="search-input">
                    <i class="fas fa-search"></i> <!-- Ikon pencarian (search icon) -->
                </div>
                <div class="actions">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <button class="btn export">
                        <img width="10" height="10" src="https://img.icons8.com/forma-thin/24/export.png"
                            alt="export" /> Export
                    </button>


                    <a href="{{ route('data_pegawai.tambah_data_pegawai') }}"><button id="openFormBtn" class="btn add">+ Tambah
                            Data</button></a>
                </div>
            </div>

            <!-- Table Section -->

            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th class="fixed-width">TGL JOIN</th>
                            <th class="fixed-width">TGL OUT</th>
                            <th>ID Pegawai</th>
                            <th>Nama Pegawai</th>
                            <th>Posisi</th>
                            <th>Departemen</th>
                            <th>Kontrak Pegawai</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pegawais as $pegawai)
                             <tr>
                                 <td>{{ $loop->iteration }}</td>
                                 <td>{{ $pegawai->tgl_join }}</td>
                                 <td>{{ $pegawai->tgl_out }}</td>
                                 <td>{{ $pegawai->id_pegawai }}</td>
                                 <td>{{ $pegawai->nama }}</td>
                                 <td>{{ $pegawai->posisi }}</td>
                                 <td>{{ $pegawai->departemen }}</td>
                                 <td>{{ $pegawai->kepagawaian }}</td>
                                 <td><button>{{ $pegawai->status }}</button>
                                 </td>
                                 <td>
                                    <a href="{{ route('data_pegawai.edit', $pegawai->id) }}"><button class="edit">Edit</button></a>
                                     <form action="{{ route('data_pegawai.destroy', $pegawai->id) }}"
                                         method="POST" style="display: inline;">
                                         @csrf
                                         @method('DELETE')
                                         <button type="submit" class="delete"
                                             data-id="{{ $pegawai->id }}">Delete</button>
                                     </form>
                                 </td>
                             </tr>
                         @endforeach
                    </tbody>
                </table>
            </div>


            <!-- Pagination Section -->
            <hr class="horizontalline1">
            <div class="pagination-container">

                <div class="showing-entries">
                    Showing <span id="start"></span> to <span id="end"></span> from <span id="total"></span>
                    entries
                </div>

                <ul class="pagination">
                    <li><button onclick="prevPage()">&#60;</button></li>
                    <li><button onclick="goToPage(1)">1</button></li>
                    <li><button onclick="goToPage(2)">2</button></li>
                    <li><button onclick="goToPage(3)">3</button></li>
                    <li><button onclick="goToPage(4)">4</button></li>
                    <li><button onclick="nextPage()">&#62;</button></li>
                </ul>
            </div>




            <!-- Script to close the modal -->
            <script>
                document.querySelector('.close').addEventListener('click', function() {
                    document.querySelector('.modal').style.display = 'none';
                });
            </script>

        </div>
    </div>
    </div>
    </div>
@endsection

@section('scripts')
    <script>
        // Sample data
        const data = [{
                no: 1,
                tanggal: "12 Agustus 2024",
                nama: "Marcella",
                sp: "S",
                bruto: 50,
                potongan: 0,
                hasil: 150,
                detail: "Hasil Timbangan"
            },
            {
                no: 2,
                tanggal: "12 Agustus 2024",
                nama: "Zhuxin",
                sp: "P",
                bruto: 75,
                potongan: 0,
                hasil: null,
                detail: "Hasil Timbangan"
            },
            {
                no: 3,
                tanggal: "12 Agustus 2024",
                nama: "Monica",
                sp: "S",
                bruto: 25,
                potongan: 0,
                hasil: null,
                detail: "Hasil Timbangan"
            },
            {
                no: 4,
                tanggal: "12 Agustus 2024",
                nama: "Aurora",
                sp: "S",
                bruto: 240,
                potongan: 0,
                hasil: 240,
                detail: "Hasil Timbangan"
            },
            {
                no: 5,
                tanggal: "12 Agustus 2024",
                nama: "Layla",
                sp: "P",
                bruto: 125,
                potongan: 0,
                hasil: 250,
                detail: "Hasil Timbangan"
            },
            {
                no: 6,
                tanggal: "12 Agustus 2024",
                nama: "Sonya",
                sp: "S",
                bruto: 125,
                potongan: 0,
                hasil: null,
                detail: "Hasil Timbangan"
            },
            // Tambahkan lebih banyak data sesuai kebutuhan
        ];

        const rowsPerPage = 5;
        let currentPage = 1;
        const totalPages = Math.ceil(data.length / rowsPerPage);

        document.getElementById("total").innerText = data.length;

        function displayData() {
            const tableBody = document.getElementById("table-body");
            tableBody.innerHTML = "";

            const start = (currentPage - 1) * rowsPerPage;
            const end = start + rowsPerPage > data.length ? data.length : start + rowsPerPage;

            document.getElementById("start").innerText = start + 1;
            document.getElementById("end").innerText = end;

            for (let i = start; i < end; i++) {
                const row = document.createElement("tr");
                row.innerHTML = `
            <td>${data[i].no}</td>
            <td>${data[i].tanggal}</td>
            <td>${data[i].nama}</td>
            <td>${data[i].sp}</td>
            <td>${data[i].bruto}</td>
            <td>${data[i].potongan}</td>
            <td>${data[i].hasil ? data[i].hasil : "-"}</td>
            <td><button>${data[i].detail}</button></td>
            <td><button>Edit</button><button>Delete</button></td>
        `;
                tableBody.appendChild(row);
            }
        }

        function prevPage() {
            if (currentPage > 1) {
                currentPage--;
                displayData();
            }
        }

        function nextPage() {
            if (currentPage < totalPages) {
                currentPage++;
                displayData();
            }
        }

        function goToPage(page) {
            if (page >= 1 && page <= totalPages) {
                currentPage = page;
                displayData();
            }
        }

        // Load initial data
        displayData();
    </script>
