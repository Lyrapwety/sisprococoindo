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
            padding: 10px;
            text-align: center;
            border: 1px solid #636362;
            /* Garis antar sel */
            color: #636362;
            font-size: 12px;
        }

        table th {
            border-bottom: 1px solid #636362;
            /* Garis tebal untuk header */
        }

        table td button {
            padding: 8px 12px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            background-color: #104367;
            color: white;
            font-size: 12px;

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
            color: #636362;
        }

        .search-input::placeholder {
            color: #636362;
            /* Ganti dengan warna yang diinginkan */
            opacity: 1;
            /* Mengatur opasitas jika perlu */
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

        .

        /* Gaya untuk input saat fokus */
        .input-icon input:focus {
            border-color: #104367;
            /* Ubah warna border saat fokus */
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
            /* Jarak antara ikon dan teks */
            filter: brightness(0) invert(1);


        }

        .search-input::placeholder {
            color: #636362;
            /* Ganti dengan warna yang diinginkan */
            opacity: 1;
            /* Mengatur opasitas jika perlu */
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 999;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
            justify-content: center;
            align-items: center;
            padding: 10px;
        }

        .modal-back {
            background-color: #F7F7F7;
            border-radius: 8px;
            padding: 25px;
            /* Tambahan padding agar lebih rapi */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 100%;
            /* Batas maksimal lebar modal */
            width: 100%;
            overflow-y: auto;
        }

        .modal-content {
            position: relative;
            background-color: #D9D9D9;
            margin: auto;
            padding: 20px;
            width: 65%;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 90%;
            display: flex;
            flex-direction: column;
            height: auto;
            overflow-y: auto;
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;

        }

        .modal-header h2 {
            font-size: 16px;
            color: #636362;
            margin: 10px 0 15px;
            margin: 0 auto;
        }

        .modal-header .close {
            font-size: 18px;
            cursor: pointer;
            background: none;
            border: none;
        }

        .input h3 {
            font-size: 14px;
            font-weight: bold;
            margin: 0 auto;

        }

        .form-container {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
            gap: 15px;
        }

        .form-row {
            display: flex;
            justify-content: space-between;
            /* Jarak antar kolom */
            align-items: center;
            /* Pastikan input sejajar secara vertikal */
            gap: 20px;
            /* Jarak antar elemen */
            flex-wrap: nowrap;
            /* Tidak membiarkan elemen turun ke baris berikutnya */
        }

        .column {

            flex: 1;
            /* Membuat setiap kolom memiliki lebar yang sama */
            display: flex;
            flex-direction: column;
            /* Menumpuk label di atas input */
            min-width: 150px;
            /* Memberikan lebar minimum untuk kolom */
        }

        .column label {
            margin-bottom: 5px;
            /* Jarak antara label dan input */
            font-size: 14px;
            color: #636362;
        }


        .form-container input {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .form-container label {
            font-size: 14px;
        }

        .form-container .column {
            flex: 1;
            margin: 0 10px;
        }

        .form-container .column:first-child {
            margin-left: 0;
        }

        .form-container .column:last-child {
            margin-right: 0;
        }

        .buttons {
            display: flex;
            justify-content: flex-start;
            margin-bottom: 20px;
        }

        .buttons button {
            padding: 8px 15px;
            margin-right: 10px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .buttons button:last-child {
            margin-right: 0;
        }

        .buttons button:hover {
            background-color: #0056b3;
        }

        .timbangan-container {
            text-align: center;
            margin: 20px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            background-color: #f9f9f9;
        }

        .timbangan-container h3 {
            font-size: 16px;
            color: #636362;
            margin: 10px 0 20px;
        }

        .basket-container {
            margin-top: 15px;
        }

        .basket-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(60px, 1fr));
            gap: 10px;
            justify-content: center;
        }

        .basket-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            font-size: 12px;
            font-weight: bold;
            color: #636362;
        }

        .basket-item label {
            margin-bottom: 5px;
        }

        .basket-input {
            width: 100%;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
            text-align: center;
        }

        .total-container {
            margin-top: 20px;
            font-size: 14px;
            font-weight: bold;
        }

        .total-container label {
            margin-right: 10px;
        }

        .total-container input {
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
            width: 100px;
            text-align: center;
            font-weight: bold;
        }

        .timbangan-inputs {
            display: grid;
            justify-items: center;
            align-items: center;
            grid-template-columns: repeat(10, 1fr);
            /* 10 kolom dengan distribusi merata */
            gap: 10px 5px;
            /* Atur jarak antar input (atas-bawah dan kiri-kanan) */
            margin: 10px auto;
            /* Margin atas dan bawah grid */
            width: 85%;
            /* Lebar grid agar lebih rapat */
            height: 50%;
        }

        .timbangan-inputs input {
            text-align: center;
            font-size: 12px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0px 1px 1px rgba(0, 0, 0, 0.2);
            width: 80%;
            /* Ukuran input agar lebih kecil */
            margin: 0;
            /* Hilangkan margin default */
            padding: 3px;
            /* Padding kecil agar lebih rapi */
            text-align: center;
        }


        .timbangan-inputs div {
            display: flex;
            flex-direction: row;
            align-items: center;

        }

        .total-container {
            text-align: right;
            margin-top: 25px;
            font-size: 14px;
            color: #636362;
            margin-right: 70px;

        }

        .submit-btn {
            width: 20%;
            padding: 10px;
            border: none;
            background-color: #104367;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            color: white;
            margin-top: 20px;
            display: block;
            /* Membuat tombol tetap dalam satu baris */
            margin-left: auto;
            /* Agar berada di sebelah kanan */
            margin-right: auto;
        }

        .submit-btn:hover {
            background-color: #aaa;
        }

        .input-field,
        .input-select {
            width: 100%;
            /* Mengisi seluruh lebar kolom */
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-shadow: 0px 1px 1px rgba(0, 0, 0, 0.2);
            box-sizing: border-box;
            /* Pastikan padding tidak memengaruhi lebar */
            font-size: 14px;
            height: 35px;

        }

        .input-select {
            margin-top: 5px;
            padding: 8px !important;
        }

        .form-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            /* Jarak antar elemen */
            margin-bottom: 15px;
        }

        .tanggal-container {
            justify-items: center;
            align-items: center;
            margin-top: 20px;
            gap: 15px;
            display: flex;
            /* Membuat label di sebelah input */
            align-items: left;
            /* Menyelaraskan label dan input secara vertikal */
            margin-left: 40px;
        }

        .tanggal-container label {
            font-size: 14px;
            margin-top: 10px;
            color: #636362;

        }

        .tanggal-container .input-field {
            flex: 1;
            width: auto;
            height: 38px;
            margin-top: 10px;
        }


        .right-container {
            display: flex;
            justify-content: flex-end;
            flex: 3;
            margin-right: 10px;
        }

        .right-container .column {
            display: flex;
            flex-direction: column;
            min-width: 150px;
        }

        .right-container label {
            font-size: 14px;
            color: #636362;
        }

        .right-container .input-field {
            width: 75%;
            height: 38px;
            padding: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            text-align: center;

        }

        .right-container .input-select {
            width: 100%;
            height: 38px;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
    </style>

    <div class="mainbar">
        <div class="container">
            <div class="header">
                <h2>Laporan Harian Hasil Tempurung Basah</h2>
            </div>

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
                    <button id="openFormBtn" class="btn add">+ Tambah Data</button>
                </div>
            </div>

            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Bruto</th>
                            <th>Tipe Keranjang</th>
                            <th>Total Keranjang</th>
                            <th>Netto</th>
                            <th>Detail</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($laporantempurungs as $laporantempurung)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $laporantempurung->tanggal }}</td>
                                <td>{{ $laporantempurung->bruto }}</td>
                                <td>{{ $laporantempurung->tipe_keranjang }}</td>
                                <td>{{ $laporantempurung->total_keranjang }}</td>
                                <td>{{ $laporantempurung->timbangan_netto }}</td>
                                <td><button class="detail-btn" id="openModal2" data-id="{{ $laporantempurung->id }}">Hasil
                                        Timbangan</button></td>
                                <td>
                                    <button class="edit" data-id="{{ $laporantempurung->id }}">Edit</button>
                                    <form action="{{ route('laporan.tempurung.destroy', $laporantempurung->id) }}"
                                        method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="delete"
                                            data-id="{{ $laporantempurung->id }}">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>


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

            <div id="modal" class="modal">
                <div class="modal-content">
                    <div id="modal-back" class="modal-back">
                        <div class="modal-header">
                            <h2>FORM INPUT HASIL TEMPURUNG BASAH</h2>
                            <button class="close">&times;</button>
                        </div>
                        <form action="{{ route('laporan.tempurung.store') }}" method="POST" enctype="multipart/form-data">

                            @csrf
                            <input type="hidden" name="id" id="id">

                            <div class="form-container">
                                <div class="form-row">
                                    <div class="tanggal-container">
                                        <label for="tanggal"> Hasil Kerja Tanggal</label>
                                        <input type="date" class="form-control @error('tanggal') is-invalid @enderror"
                                            id="tanggal" name="tanggal" value="{{ old('tanggal') }}" required>
                                        @error('tanggal')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="right-container">
                                        <div class="column">
                                            <label for="tipe_keranjang">Tipe Keranjang</label>
                                            <select id="tipe_keranjang" name="tipe_keranjang"
                                                value="{{ old('tipe_keranjang') }}" class="input-select" required>
                                                <option value="Keranjang Besar">Keranjang Besar</option>
                                                <option value="Keranjang Kecil">Keranjang Kecil</option>
                                            </select>
                                            @error('tipe_keranjang')
                                                <div class="alert alert-danger mt-2">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="column">
                                            <label for="total_keranjang">Total Keranjang</label>
                                            <input type="number"
                                                class="form-control @error('total_keranjang') is-invalid @enderror"
                                                id="total_keranjang" name="total_keranjang"
                                                value="{{ old('total_keranjang') }}" required>
                                            @error('total_keranjang')
                                                <div class="alert alert-danger mt-2">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="timbangan-container">
                                <h3>Hasil Timbangan Tempurung Basah</h3>
                                <div class="basket-container">
                                    <div class="basket-grid">
                                        @for ($i = 0; $i < 50; $i++)
                                            <div class="basket-item">
                                                <!-- Nomor di atas input -->
                                                <label for="netto_{{ $i }}">{{ $i + 1 }}</label>
                                                <input class="basket-input" type="number" name="netto[]"
                                                    id="netto_{{ $i }}" value="{{ old('netto.' . $i, 0) }}"
                                                    oninput="calculateTotal()">
                                            </div>
                                        @endfor
                                    </div>
                                </div>
                                <div class="total-container">
                                    <label for="timbangan_netto">Total:</label>
                                    <input type="number" id="timbangan_netto" name="timbangan_netto"
                                        value="{{ old('timbangan_netto', 0) }}" readonly>
                                </div>
                                @error('netto')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="total-container">
                                <label id="total-label">Total: 0 kg</label>
                            </div>

                            <div class="action-buttons">
                                <button type="submit" class="submit-btn">Kirim</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>

    <script>
        document.querySelector('.close').addEventListener('click', function() {
            document.querySelector('.modal').style.display = 'none';
        });
    </script>
    </div>
    </div>
@endsection

@section('scripts')
    <script>
        function calculateTotal() {
            const inputs = document.querySelectorAll('.basket-input');
            let total = 0;

            inputs.forEach(input => {
                total += parseFloat(input.value) || 0; // Tambahkan angka atau 0 jika kosong
            });

            document.getElementById('timbangan_netto').value = total;
            document.getElementById('total-label').textContent = 'Total: ' + total + ' kg';
        }

        document.addEventListener("DOMContentLoaded", function() {
            const openFormBtn = document.getElementById('openFormBtn'); // Tombol Tambah Data
            const modal = document.getElementById('modal'); // Modal utama
            const closeModalBtn = document.querySelector('.close');
            const form = document.querySelector('form');

            // Fungsi untuk membuka modal
            openFormBtn.addEventListener("click", function() {
                console.log("Modal dibuka");
                modal.style.display = "block"; // Menampilkan modal
            });

            // Fungsi untuk menutup modal ketika tombol close diklik
            closeModalBtn.addEventListener("click", function() {
                modal.style.display = "none"; // Menyembunyikan modal
            });

            // Tutup modal jika pengguna mengklik di luar konten modal
            window.addEventListener("click", function(event) {
                if (event.target === modal) {
                    modal.style.display = "none";
                }
            });

            // Fungsi untuk menangani event tombol edit
            document.querySelectorAll('.edit').forEach(button => {
                button.addEventListener('click', function() {
                    const id = this.getAttribute('data-id');

                    // Ambil data menggunakan fetch atau sesuai dengan cara yang Anda inginkan
                    fetch(`/laporan/tempurung/${id}/edit`)
                        .then(response => response.json())
                        .then(data => {
                            // Isi nilai form dengan data yang diambil
                            document.getElementById("id").value = data.id;
                            document.getElementById("tanggal").value = data.tanggal;
                            document.getElementById("total_keranjang").value = data
                                .total_keranjang;
                            document.getElementById("tipe_keranjang").value = data
                                .tipe_keranjang;

                            // Isi nilai untuk hasil kerja netto
                            const netto = document.querySelectorAll(
                                "[name='netto[]']");
                                netto.forEach((input, index) => {
                                input.value = data.netto[index] || 0;
                            });

                            // Hitung total netto
                            calculateTotal();

                            // Tampilkan modal untuk edit
                            modal.style.display = 'flex';
                        })
                        .catch(error => {
                            console.error("Error fetching data:", error);
                        });
                });
            });

            // Fungsi untuk menghitung total netto
            function calculateTotal() {
                const inputs = document.querySelectorAll("[name='netto[]']");
                let total = 0;
                inputs.forEach(input => {
                    total += parseFloat(input.value) || 0;
                });
                document.getElementById("timbangan_netto").value = total;
            }
        });

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


        displayData();
    </script>
