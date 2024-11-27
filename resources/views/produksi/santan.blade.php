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
        .modal {
            display: none;
            position: fixed;
            z-index: 9999;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
            justify-content: center;
            align-items: center;
        }

        .modal-back {
            background-color: #F7F7F7;
            border-radius: 8px;
        }

        .modal-content {
            background-color: #D9D9D9;
            margin: auto;
            padding: 20px;
            width: 80%;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 90%;
            display: flex;
            flex-direction: column;
            overflow-y: auto;
            height: 95%;
        }

        /* Gaya header modal */
        .modal-header {
            display: flex;
            align-items: center;
        }

        .modal-header h2 {
            font-size: 16px;
            margin: 0 auto;
            text-align: center;
            color: #333;
            font-weight: 500;
            margin-top: 25px;
            transform: translateX(20px);
        }

        .close {
            color: #aaa;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
            margin-right: 15px;
        }

        /* Gaya form */
        .form-group {
            margin-bottom: 15px;
            display: flex;
            margin-left: 5px;
            margin-top: 15px;
            flex-direction: row;
        }

        .form-group-total {
            margin-bottom: 15px;
            display: flex;
            margin-left: 10px;
            color: #636362;
            flex-direction: row;
            font-size: 12px;
            margin-top: 0;
            flex: 1;
            white-space: nowrap;
        }

        .form-group label {
            font-size: 14px;
            display: block;
            color: #636362;
            margin-bottom: 5px;
            margin-right: 15px;
            margin-left: 15px;
        }

        .form-row {
            display: flex;
            justify-content: space-between;
            gap: 5px;
            align-items: center;
        }

        .form-container {
            margin: 25px;
        }

        #total {
            flex-direction: row;
            text-align: center;
            justify-content: center;

        }

        #anggota-parer1 {
            width: 100%;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 8px;
            border-radius: 7px;
            color: #636362;
            border: 1px solid #ccc;
            box-shadow: 0px 1px 1px rgba(92, 90, 90, 0.602);
            font-size: 14px;
            box-sizing: border-box;
            /* Ini dapat diatur sesuai kebutuhan */
        }

        #nama-sheller {
            width: 80%;
            transform: translateX(-6px);
            /* Lebar nama sheller */
        }

        #tanggal-picker {
            width: 50%;
            /* Lebar date picker */
            height: 40px;
        }

        /* Gaya untuk kontainer keranjang */
        .basket-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            gap: 13px;
            margin-top: 15px;
            color: #636362;
            font-weight: bold;
        }

        .basket-container span {
            align-items: center;
            justify-content: center;
            flex-direction: column;
            display: flex;
        }

        .label-timbangan {
            color: #636362;
            text-align: center;
            margin-top: 20px;
            justify-content: center;
            align-items: center;
            display: block;
        }

        .basket-input {
            width: 58px;
            padding: 5px;
            text-align: center;
            border-radius: 4px;
            border: 1px solid #ccc;
            height: 30px;
            margin-top: 5px;
            margin-bottom: 5px;
            box-shadow: 0px 1px 2px rgba(92, 90, 90, 0.602);
        }

        /* Gaya untuk tombol */
        .submit-btn {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 20%;
            margin-top: 10px;
            font-size: 14px;
            display: block;
            /* Membuat tombol tetap dalam satu baris */
            margin-left: auto;
            /* Agar berada di sebelah kanan */
            margin-right: auto;
            /* Agar memusatkan tombol */
        }

        .submit-btn:hover {
            background-color: #3f8d43;
        }

        .add-member-btn {
            background-color: #4682B4;
            border: 0.5px solid #ccc;
            padding: 8px 10px;
            box-shadow: 0px 1px 2px rgba(92, 90, 90, 0.602);
            border-radius: 5px;
            cursor: pointer;
            display: block;
            align-items: right;
            margin-top: 5px;
            font-size: 14px;
            width: 15%;
            justify-content: right;
            color: #f5f5f5;
            align-self: flex-end;
        }

        .add-member-btn:hover {
            background-color: #104367;
            color: white;
        }

        #anggota-parer-container {
            display: flex;
            flex-direction: column;
            /* Atur arah kolom agar elemen ditumpuk secara vertikal */
            gap: 15px;
            /* Jarak antar elemen */
            flex-grow: 1;
            margin-bottom: 20px;
            /* Jarak bawah untuk memastikan tombol submit tidak menempel */
        }

        .add-member-btn img {
            margin-right: 5px;
        }

        /* Gaya untuk title */
        .title {
            font-size: 14px;
            text-align: center;
            font-weight: bold;
            margin: 10px 0;
        }

        /* Gaya untuk total */
        .total-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 10px;
        }

        .input.nama-sheller {
            display: block;
        }

        .span {
            color: #636362 !important;
        }

        /* Gaya untuk action buttons */
        .action-buttons {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: auto;
            /* Untuk memastikan tombol berada di bawah konten */
            flex-direction: column;
        }

        /* Gaya untuk garis horizontal */
        .hori-line {
            color: #565655;
            width: auto;
            opacity: 0.2;
            margin-top: 25px;
            margin-bottom: 10px;
            box-shadow: 0px 0.5px 1px rgba(0, 0, 0, 1);
        }

        .horizontalline1 {
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

        /* Gaya untuk tombol export */
        .btn.export {
            display: flex;
            align-items: center;
            /* Mengatur ikon dan teks dalam satu baris */
            color: white;
            /* Mengatur warna teks menjadi putih */
            border: none;
            /* Menghapus border default */
            cursor: pointer;
            /* Menambahkan kursor pointer */
        }

        .btn.export img {
            filter: brightness(0) invert(1);
        }
    </style>

    <div class="mainbar">
        <div class="container">
            <div class="header">
                <h2>Laporan Produksi Santan ( Coconut Milk )</h2>
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
                    <button class="btn export">
                        <img width="10" height="10" src="https://img.icons8.com/forma-thin/24/export.png"
                            alt="export" /> Export
                    </button>

                    <button id="openFormBtn" class="btn add">+ Tambah Data</button>
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
                                <th colspan="2">Packaging</th>
                                <th rowspan="2">Begin</th>
                                <th colspan="2">In</th> <!-- Kolom "In" dengan sub-kolom -->
                                <th rowspan="2">Out</th>
                                <th rowspan="2">Remain</th>
                            </tr>
                            <tr>
                                <th>Bags@1kgs</th>
                                <th>Bags@5kgs</th>
                                <!-- Sub-header tambahan jika diperlukan -->
                                <th>S</th> <!-- Kolom S -->
                                <th>N</th> <!-- Kolom N -->

                            </tr>
                        </thead>
                        <tbody>
                            <!-- Tambahkan data tabel -->
                            <tr>
                                <td>1</td>
                                <td class="remark-column">Reject 2 bags, Sample 3 bags, 31 bags tidak ketemu</td>
                                <td>26.0%</td>
                                <td>26.0%</td>
                                <td>6.05</td>
                                <td>2.662</td>
                                <td>1.698</td>
                                <td>500</td>
                                <td>300</td>
                                <td>200</td>
                                <td>964</td>


                            </tr>
                            <tr>
                                <td>26</td>
                                <td class="remark-column">Reject 2 bags, Sample 3 bags, 31 bags tidak ketemu</td>
                                <td>28.0%</td>
                                <td>28.0%</td>
                                <td>6.08</td>
                                <td>1.698</td>
                                <td>1.698</td>
                                <td>624</td>
                                <td>600</td>
                                <td>350</td>
                                <td>250</td>
                            </tr>
                            <tr>
                                <td>26</td>
                                <td class="remark-column">Adjust Produksi tanggal 26 </td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>2</td>
                                <td>1.698</td>
                                <td></td>
                                <td></td>
                                <td>20</td>
                                <td>1.688</td>
                            </tr>


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
            <div id="modal" class="modal">

                <div class="modal-content">
                    <div id="modal-back" class="modal-back">
                    <div class="modal-header">
                        <h2>FORM INPUT Laporan Produksi Santan ( Coconut Milk )</h2>
                        <span class="close">&times;</span>
                    </div>

                    <div class="form-container">
                        <div class="form-row">
                            <div class="form-group">
                                <label for="nama-sheller">Nama Sheller</label>
                                <input type="text" class="kotak" id="nama-sheller" value="Marcella Corazon">
                            </div>
                            <div class="form-group-total">
                                <label>Total: 250 kg</label>
                            </div>

                            <div class="form-group">
                                <label for="tanggal-picker">Pilih Tanggal</label>
                                <input type="date" id="tanggal-picker">
                            </div>
                        </div>

                        <!-- Container utama untuk anggota parer -->
                        <div id="anggota-parer-container">
                            <div class="anggota-block">
                                <div class="form-row">
                                    <div class="form-group">
                                        <label for="anggota-parer1">Anggota Parer 1</label>
                                        <input type="text" class="kotak" id="anggota-parer1">

                                    </div>


                                    <div class="form-group">
                                        <label for="total-keranjang">Total Keranjang</label>
                                        <input type="number" class="kotak" id="total-keranjang" min="0">

                                        <label for="tipe-keranjang">Tipe Keranjang</label>
                                        <select id="tipe-keranjang" class="custom-select">
                                            <option value="A">Keranjang Besar</option>
                                            <option value="B">Keranjang Kecil</option>
                                        </select>
                                    </div>
                                </div>
                                <span class="label-timbangan">Hasil Timbangan DKP</span>
                                <div class="basket-container">
                                    <!-- Input Basket -->
                                    @for ($i = 0; $i < 12; $i++)
                                        <input class="basket-input" type="text" value="">
                                    @endfor
                                </div>
                                <hr class="hori-line">
                            </div>
                        </div>

                        <div class="action-buttons">
                            <button class="add-member-btn" onclick="addAnggotaParer()">+ Anggota Parer</button>
                            <button class="submit-btn">Kirim</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection

    @section('scripts')
        <script>
            const modal = document.getElementById('modal');
            const openFormBtn = document.getElementById('openFormBtn');
            const closeBtn = document.querySelector('.close');

            // Open the modal when the "Tambah Data" button is clicked
            openFormBtn.addEventListener('click', () => {
                modal.style.display = 'block';
            });

            // Close the modal when the "X" is clicked
            closeBtn.addEventListener('click', () => {
                modal.style.display = 'none';
            });

            // Close the modal if user clicks outside the modal content
            window.addEventListener('click', (event) => {
                if (event.target === modal) {
                    modal.style.display = 'none';
                }
            });

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
