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
            margin: 0 auto;
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
            width: 13%;
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

        table th,
        table td {
            text-align: center;
            padding: 8px;
            border: 1px solid #ccc;
        }

        thead th {
            background-color: #f0f0f0;
            font-weight: bold;
        }

        thead tr:nth-child(2) th {
            font-size: 12px;
            /* Ukuran lebih kecil untuk sub-header */
            font-weight: normal;
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

        .remark-column {
            text-align: left;
            padding-left: 10px;
            /* Tambahkan jarak jika diperlukan */
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
            gap: 15px;
            justify-content: space-between;
        }

        .inline-form .form-group,
        .inline-form2 .form-group {
            flex: 1;
            min-width: 45%;
        }
    </style>

    <div class="mainbar">
        <div class="container">
            <div class="header">
                <h2>Laporan Produksi Air Kelapa ( Coconut Water )</h2>
            </div>

            <!-- Filter Section -->
            <div class="filters">
                <select class="pilihtanggal">
                    <option>Pilih Periode</option>
                    <option>Januari</option>
                    <option>Februari</option>
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
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th rowspan="2">Date</th>
                                <th rowspan="2">Remark</th>
                                <th rowspan="2">Fat</th>
                                <th rowspan="2">PH</th>
                                <th rowspan="2">S/N</th>
                                <th colspan="2">Packaging</th>
                                <th rowspan="2">Begin</th>
                                <th colspan="2">In</th>
                                <th colspan="3">Out</th>
                                <th rowspan="2">Remain</th>
                            </tr>
                            <tr>
                                <th>Bags@1kgs</th>
                                <th>Bags@5kgs</th>


                                <th>Steril</th>
                                <th>Nonsteril</th>

                                <th>Reproses</th>
                                <th>Eksport</th>
                                <th>Adjust</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($produksiairkelapas as $produksiairkelapa)
                                <tr>
                                    <td class="remark-column">{{ \Carbon\Carbon::parse($produksiairkelapa->tanggal)->translatedFormat('d F Y') }}</td>
                                    <td>{{ $produksiairkelapa->keterangan }}</td>
                                    <td>{{ $produksiairkelapa->fat }}</td>
                                    <td>{{ $produksiairkelapa->ph }}</td>
                                    <td>{{ $produksiairkelapa->sn }}</td>
                                    <td>{{ $produksiairkelapa->briz }}</td>
                                    <td>{{ $produksiairkelapa->bags }}</td>
                                    <td>{{ $produksiairkelapa->begin }}</td>
                                    <td>{{ $produksiairkelapa->in_steril }}</td>
                                    <td>{{ $produksiairkelapa->in_nonstreil }}</td>
                                    <td>{{ $produksiairkelapa->out_rep }}</td>
                                    <td>{{ $produksiairkelapa->out_eks }}</td>
                                    <td>{{ $produksiairkelapa->out_adj }}</td>
                                    <td>{{ $produksiairkelapa->remain }}</td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
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


            <!-- Modal -->
            <div id="modal" class="modal">
                <div class="modal-content">
                    <span class="close-btn" onclick="closeModal()">&times;</span>
                    <h2>Form Input Stok Packing Air Kelapa</h2>

                    <form id="stokForm" action="{{ route('produksi.air_kelapa.store') }}" method="POST"
                        enctype="multipart/form-data">

                        @csrf
                        <input type="hidden" name="id" id="id">
                        <div class="form-group">
                            <label for="tanggal">Tanggal</label>
                            <input type="date" class="form-control @error('tanggal') is-invalid @enderror"
                                id="tanggal" name="tanggal" value="{{ old('tanggal') }}">
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
                                    <option value="" disabled selected></option>
                                    <option value="produksi">Produksi</option>
                                    <option value="adjust">Adjust</option>
                                    <option value="ekspor">Ekspor</option>
                                    <option value="reproses">Reproses</option>
                                </select>
                                @error('activity_type')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group d-none" id="sn">
                                <label for="sn">S/N</label>
                                <select class="form-control @error('sn') is-invalid @enderror"
                                    name="sn" value="{{ old('sn') }}">
                                    <option value="" disabled selected></option>
                                    <option value="steril">Steril</option>
                                    <option value="nonsteril">Nonsteril</option>
                                </select>
                                @error('sn')
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


                        <div class="inline-form">
                            <div class="form-group">
                                <label for="briz">Jumlah Bag@1kgs</label>
                                <input type="number" class="form-control @error('briz') is-invalid @enderror"
                                id="briz" name="briz" value="{{ old('briz') }}">
                                @error('briz')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="bags">Jumlah Bag@5kgs</label>
                                <input type="number" class="form-control @error('bags') is-invalid @enderror"
                                id="bags" name="bags" value="{{ old('bags') }}">
                                @error('bags')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                        </div>


                        <div class="form-group">
                            <label for="keterangan">Keterangan (Remark)</label>
                            <textarea class="form-control @error('keterangan') is-invalid @enderror"
                            id="keterangan" name="keterangan" value="{{ old('keterangan') }}">
                            @error('keterangan')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror</textarea>
                        </div>
                        <button type="submit" class="submit-btn">Simpan</button>
                    </form>
                </div>
            </div>
        @endsection

        @section('scripts')
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                        const activityType = document.getElementById('activity_type');
                        const snDiv = document.getElementById('sn');

                        activityType.addEventListener('change', function () {
                            if (this.value === 'produksi') {
                                snDiv.classList.remove('d-none');
                            } else {
                                snDiv.classList.add('d-none');
                            }
                        });
                    });

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

                // Load initial data
                displayData();
                updatePagination();
            </script>
        @endsection
