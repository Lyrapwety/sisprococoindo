@extends('layouts.app')

@section('content')
    <style>
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

        .table-container {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(230, 238, 241, 0.1);
            font-size: 11px;
        }

        th,
        td {
            padding-right: 5px;
            padding-left: 5px;
            padding-bottom: 10px;
            padding-top: 10px;
            text-align: center;
            border: 1px solid #636362;
            /* Garis antar sel */
            color: #636362;
            vertical-align: middle;
        }

        th {
            background-color: #f0f0f0;
        }

        .merge-col {
            border-right: none;
        }

        .merge-col+td {
            border-left: none;
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


        /* Modal Overlay */
        .modal {
            display: none;
            /* Modal tidak tampil secara default */
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.6);
            /* Transparan hitam */
            justify-content: center;
            align-items: center;
        }

        /* Modal Konten */
        .modal-content {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            width: 450px;
            max-width: 90%;
            height: 95%;
            overflow-y: auto;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            position: relative;
            animation: fadeIn 0.3s ease-in-out;
        }

        .modal-content h2 {
            font-size: 16px;
            margin: 0 auto;
            margin-bottom: 20px;

        }


        @keyframes fadeIn {
            from {
                transform: scale(0.8);
                opacity: 0;
            }

            to {
                transform: scale(1);
                opacity: 1;
            }
        }


        .close-btn {
            position: absolute;
            top: 10px;
            right: 15px;
            font-size: 24px;
            color: #555;
            cursor: pointer;
        }

        .close-btn:hover {
            color: red;
        }


        .form-group {
            margin-bottom: 10px;
            margin-top: 10px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-size: 12px;


        }

        . .form-control {
            width: 100%;
            padding: 8px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: inset 0px 1px 2px rgba(0, 0, 0, 0.1);
            font-size: 12px;
        }

        .form-control {
            width: 100%;
            padding: 8px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #fff;
            box-shadow: inset 0px 1px 2px rgba(0, 0, 0, 0.1);
            appearance: none;
            /* Hilangkan gaya default browser */

            background-position: right 10px center;
            background-size: 16px;
            cursor: pointer;
        }

        .form-control:focus {
            border-color: #104367;
            outline: none;
            box-shadow: 0 0 5px rgba(8, 22, 57, 0.5);
        }

        /* Style untuk option */
        .form-control option {
            padding: 8px;
        }

        .form-control:focus {
            border-color: #104367;
            outline: none;
            box-shadow: 0 0 5px rgba(8, 22, 57, 0.5);
        }


        .submit-btn {
            background-color: #104367;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
            margin-top: 10px;
        }

        .submit-btn:hover {
            background-color: #104367;
        }

        .inline-form,
        .inline-form2 {
            display: flex;
            flex-wrap: wrap;
            /* Agar tetap responsif */
            gap: 15px;
            /* Jarak antar elemen */
            justify-content: space-between;
        }

        .inline-form .form-group,
        .inline-form2 .form-group {
            flex: 1;
            /* Membuat elemen sejajar dan proporsional */
            min-width: 45%;
            /* Mencegah elemen terlalu kecil */
        }
    </style>

    <div class="mainbar">
        <div class="container">
            <div class="header">
                <h2>Card Stock Santan</h2>
            </div>

            <!-- Filter Section -->
            <div class="filters">
                <select class="pilihtanggal">
                    <option>Pilih Tanggal</option>
                    <option>12 Agustus 2024</option>
                    <option>13 Agustus 2024</option>
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

                    <button id="openFormBtn" class="btn add" onclick="openModal()">+ Tambah Data</button>
                </div>

            </div>

            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th rowspan="2">Date<br>日期</th>
                            <th rowspan="2">Remark<br>评论</th>
                            <th rowspan="2">Making Product<br>制作产品</th>
                            <th rowspan="2">Fat<br>胖的</th>
                            <th rowspan="2">PH<br>酸碱度</th>
                            <th rowspan="2">Begin<br>开始</th>
                            <th colspan="2">IN<br>入库</th>
                            <th rowspan="2">Out<br>出库</th>
                            <th colspan="6">Remain<br>库存</th>
                            <th rowspan="2">Remark<br>评论</th>
                        </tr>
                        <tr>
                            <th>Bags<br>包</th>
                            <th>Box<br>盒子</th>
                            <th>5 kg</th>
                            <th>4 kg</th>
                            <th>3 kg</th>
                            <th>2 kg</th>
                            <th>1 kg</th>
                            <th> Box </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($stoksantans as $stoksantan)
                            <tr>
                                <td class="remark-column">{{ $stoksantan->tanggal }}</td>
                                <td>{{ $stoksantan->keterangan }}</td>
                                <td>{{ $stoksantan->making_product }}</td>
                                <td>{{ $stoksantan->fat }}</td>
                                <td>{{ $stoksantan->ph }}</td>
                                <td>{{ $stoksantan->begin }}</td>
                                <td>{{ $stoksantan->in_bags }}</td>
                                <td>{{ $stoksantan->in_box }}</td>
                                <td>{{ $stoksantan->out }}</td>
                                <td>{{ $stoksantan->jenis_berat === '5KG' ? $stoksantan->in_box * 20 : '-' }}</td>
                                <td>{{ $stoksantan->jenis_berat === '4KG' ? $stoksantan->in_box * 20 : '-' }}</td>
                                <td>{{ $stoksantan->jenis_berat === '3KG' ? $stoksantan->in_box * 20 : '-' }}</td>
                                <td>{{ $stoksantan->jenis_berat === '2KG' ? $stoksantan->in_box * 20 : '-' }}</td>
                                <td>{{ $stoksantan->jenis_berat === '1KG' ? $stoksantan->in_box * 20 : '-' }}</td>
                                <td>{{ $stoksantan->remain }}</td>
                                <td>{{ $stoksantan->catatan }}</td>
                            </tr>
                        @endforeach

                    </tbody>

                </table>
            </div>

            <hr class="horizontalline1">
            <div class="pagination-container">
                <div class="showing-entries">
                    Showing <span id="start">1</span> to <span id="end">5</span> from <span
                        id="total">50</span> entries
                </div>
                <ul class="pagination">
                    <li><button class="page-btn prev-btn" onclick="prevPage()">&#60;</button></li>
                    <li><button class="page-btn" onclick="goToPage(1)">1</button></li>
                    <li><button class="page-btn" onclick="goToPage(2)">2</button></li>
                    <li><button class="page-btn" onclick="goToPage(3)">3</button></li>
                    <li><button class="page-btn" onclick="goToPage(4)">4</button></li>
                    <li><button class="page-btn next-btn" onclick="nextPage()">&#62;</button></li>
                </ul>
            </div>
        </div>

        <!-- Modal -->
        <div id="modal" class="modal">
            <div class="modal-content">
                <span class="close-btn" onclick="closeModal()">&times;</span>
                <h2>Form Input Stok Packing Santan</h2>

                <form id="stokForm" action="{{ route('card_stock.santan.store') }}" method="POST"
                        enctype="multipart/form-data">

                        @csrf
                        <input type="hidden" name="id" id="id">
                    <div class="form-group">
                        <label for="tanggal">Tanggal</label>
                        <input type="date" class="form-control @error('tanggal') is-invalid @enderror"
                        id="tanggal" name="tanggal" value="{{ old('tanggal') }}" required>
                    @error('tanggal')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                    @enderror
                    </div>
                    <div class="inline-form">


                        <div class="form-group">
                            <label for="activity_type">Tipe Aktivitas</label>
                            <select class="form-control @error('activity_type') is-invalid @enderror"
                            id="activity_type" name="activity_type" value="{{ old('activity_type') }}" required>
                                <option value="" disabled selected>Pilih Jenis Aktivitas</option>
                                <option value="produksi">Produksi</option>
                                <option value="ekspor">Ekspor</option>
                            </select>
                            @error('activity_type')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                        </div>
                        <div class="form-group">
                            <label for="jenis_berat">Jenis Berat</label>
                            <select class="form-control @error('jenis_berat') is-invalid @enderror"
                            id="jenis_berat" name="jenis_berat" value="{{ old('jenis_berat') }}" required>
                                <option value="" disabled selected>Pilih Jenis Berat</option>
                                <option value="5KG">5KG</option>
                                <option value="4KG">4KG</option>
                                <option value="3KG">3KG</option>
                                <option value="2KG">2KG</option>
                                <option value="1KG">1KG</option>
                            </select>
                            @error('jenis_berat')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                        </div>
                    </div>


                    <div class="inline-form">
                        <div class="form-group">
                            <label for="making_product">Making Product</label>
                            <input type="text" class="form-control @error('making_product') is-invalid @enderror"
                            id="making_product" name="making_product" value="{{ old('making_product') }}">
                            @error('making_product')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="jumlah_box">Jumlah Box</label>
                            <input type="number" class="form-control @error('jumlah') is-invalid @enderror"
                            id="jumlah" name="jumlah" value="{{ old('jumlah') }}">
                            @error('jumlah')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                    </div>
                    <div class="inline-form2">
                        <div class="form-group">
                            <label for="fat">Fat</label>
                            <input type="text" class="form-control @error('fat') is-invalid @enderror"
                            id="fat" name="fat" value="{{ old('fat') }}">
                            @error('fat')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="ph">PH</label>
                            <input type="number" class="form-control @error('ph') is-invalid @enderror"
                            id="ph" name="ph" value="{{ old('ph') }}">
                            @error('ph')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>


                    </div>


                    <div class="form-group">
                        <label for="keterangan">Keterangan (Remark)</label>
                        <textarea id="keterangan" name="keterangan" class="form-control" required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="catatan">Catatan</label>
                        <textarea id="catatan" name="catatan" class="form-control" required></textarea>
                    </div>


                    <button type="submit" class="submit-btn">Simpan</button>
                </form>
            </div>
        </div>
    @endsection

    @section('scripts')
        <script>
            function openModal() {
                document.getElementById("modal").style.display = "flex";
            }

            function closeModal() {
                document.getElementById("modal").style.display = "none";
            }

            window.onclick = function(event) {
                const modal = document.getElementById("modal");
                if (event.target === modal) {
                    modal.style.display = "none";
                }
            };

            function goToPage(page) {
                if (page >= 1 && page <= totalPages) {
                    currentPage = page;
                    displayData();
                    updatePagination();
                }
            }

            function updatePagination() {
                const buttons = document.querySelectorAll('.page-btn');
                buttons.forEach((button) => button.classList.remove('active'));

                const currentButton = document.querySelector(`.pagination .page-btn:nth-child(${currentPage + 1})`);
                if (currentButton) {
                    currentButton.classList.add('active');
                }
            }


            displayData();
            updatePagination();
        </script>
    @endsection
