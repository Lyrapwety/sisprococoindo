@extends('layouts.app')

@section('content')
    <style>
        .mainbar {
            flex: 1%;
            background-color: #D9D9D9 !important;
            padding-top: 20px;
            margin-left: 235px;
            height: calc(100vh - 70px);
            width: calc(100% - 235px);
            font-family: 'Inter', sans-serif;
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


        .filters select.pilihtanggal,
        .filters .input-icon input[type="text"] {
            padding: 8px 12px;
            height: 36px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 12px;
            color: #636362;
            box-shadow: 0px 1px 2px rgba(0, 0, 0, 0.2);
        } .filters .input-icon {
            position: relative;
            width: 250px;
       }

        .filters input[type="text"] {
            width: 100%;
            height: 36px;
            padding: 8px 35px 8px 12px;
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
            font-size: 11px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(230, 238, 241, 0.1);

        }

        table th,
        table td {
            padding: 10px;
            text-align: center;
            border: 1px solid #636362;
            color: #636362;
            font-size: 12px;
        }

        table th {
            border-bottom: 1px solid #636362;
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
            color: #636362;
        }

        .search-input::placeholder {
            color: #636362;
             opacity: 1;
        }

        .input-icon i {
            position: absolute;
            right: 5px !important;
           top: 50%;
            transform: translateY(-50%);
            color: #636362;
          }

        .input-icon input {
            width: 100%;
            padding: 10px 40px 10px 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
            outline: none;

        }



        .input-icon input:focus {
            border-color: #104367;
       
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
        }

        #nama-sheller {
            width: 80%;
            transform: translateX(-6px);
        }

        #tanggal-picker {
            width: 50%;
            height: 40px;
        }

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
            margin-left: auto;
            margin-right: auto;
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
            gap: 15px;
            flex-grow: 1;
            margin-bottom: 20px;
        }

        .add-member-btn img {
            margin-right: 5px;
        }

        .title {
            font-size: 14px;
            text-align: center;
            font-weight: bold;
            margin: 10px 0;
        }

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

        .action-buttons {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: auto;
            flex-direction: column;
        }

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
            border-bottom: 0.5px solid #ccc;
            width: 100%;
            margin: 5px 0 15px 0;
            opacity: 0.5;
            padding-top: 20px;
        }

        .btn.export {
            display: flex;
            align-items: center;
            color: white;
            border: none;
            cursor: pointer;
        }

        .btn.export img {
            filter: brightness(0) invert(1);
        }

        .modal2 {
            display: none;
            justify-content: center;
            align-items: center;
            height: 100%;
            width: 100%;
            background-color: rgba(0, 0, 0, 0.4);
            position: fixed;
            z-index: 9999;
            top: 0;
            left: 0;
            overflow: auto;
        }

        .modal-back2 {

            background-color: #D9D9D9;
            margin: auto;
            padding: 20px;
            border: 1px solid #888;
            width: 60%;
            border-radius: 10px;
            max-width: 90%;
            display: flex;
            height: auto;
            flex-direction: column;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }

        .modal-content2 {
            margin: auto;
            padding: 20px;
            background-color: #F7F7F7;
            border-radius: 10px;
            flex: 1;
            margin-left: 5px;
            margin-right: 5px;
            margin-bottom: 3px;
            margin-top: 3px;
        }

        .header2 {
            text-align: center;
            padding: 10px 0;
        }

        .header2 h2 {
            font-size: 14px;
            color: #636362;
            margin: 0;
        }

        .row2 {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .form-group2 {
            flex: 0.5;
            display: flex;
            flex-direction: column;
        }

        .nama-parer2 {
            margin-bottom: 5px;
            font-weight: 300;
            margin-left: 35px;
            margin-top: 20px;
            font-size: 12px;
            color: #636362;
            transform: translateX(-5px);
        }

        .input-nama2 {
            transform: translateX(-5px);
            width: 60%;
            height: 25%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-left: 35px;
            margin-top: 10px;
            background-color: #F7F7F7;
            box-shadow: 1px 4px 2px rgba(217, 217, 217, 0.5);
        }

        .potongan-keranjang2 {
            flex: 0.3;
            text-align: center;
            margin-top: 20px;
            color: #636362;
        }

        .tabel-hasil2,
        .tabel-potongan2 {
            border-collapse: collapse;
            font-weight: 200;
            border-radius: 8px;
            font-size: 12px;
        }

        .tabel-hasil2 th,
        .tabel-hasil2 td,
        .tabel-potongan2 th,
        .tabel-potongan2 td {
            border: 1px solid #ccc;
            box-shadow: 0px 2px 1px rgba(217, 217, 217, 0.5);
            padding: 8px;
            text-align: center;
            font-weight: 200;
            border-radius: 8px 8px 0 0;
        }

        .potongan-keranjang2 label {
            display: block;
            font-weight: 300;
            margin-bottom: 5px;
            transform: translateX(-30px);
            font-size: 12px;
        }

        .tabel-potongan2 {
            margin-top: 15px;
            margin-right: 0;
            transform: translateX(-32px);
            border-radius: 8px;
            font-size: 12px;
        }

        .tabel-hasil2 {
            border-radius: 8px 8px 0 0;
            margin-bottom: 20px;
        }

        .centered-table2 {
            margin: 0 auto;
            width: 90%;
        }

        .close-btn2 {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 15%;
            font-size: 12px;
            display: block;
            margin: 20px auto 0 auto;
            text-align: center;
            margin-top: 25px;
        }

        .close-btn2:hover {
            background-color: #3f8d43;
        }
    </style>

    <div class="mainbar">
        <div class= "container">
            <div class="header">
                <h2>Laporan Harian Hasil Kerja Sheller - Parer (DKP)</h2>
            </div>

            <div class="filters">
                <select class="pilihtanggal">
                    <option>Pilih Tanggal</option>
                    <option>12 Agustus 2024</option>
                    <option>13 Agustus 2024</option>
                </select>
                <div class="input-icon">
                    <input type="text" id="searchInput" placeholder="Cari Data" class="search-input">
                    <i class="fas fa-search"></i>
                </div>
                <div class="actions">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <button class="btn export">
                        <img width="10" height="10" src="https://img.icons8.com/forma-thin/24/export.png"
                            alt="export" /> Export</button>


                    <button id="openFormBtn" class="btn add">+ Tambah Data</button>
                </div>
            </div>

            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Nama Sheller</th>
                            <th>Nama Parer</th>
                            <th>Hasil Kerja Parer</th>
                            <th>Hasil Kerja Sheller</th>
                            <th>Detail</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="laporanTableBody">
                        @foreach ($laporandkps as $laporandkp)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ \Carbon\Carbon::parse($laporandkp->tanggal)->translatedFormat('d F Y') }}</td>
                                <td>{{ $laporandkp->nama_sheller }}</td>
                                <td>{{ $laporandkp->nama_parer }}</td>
                                <td>{{ $laporandkp->timbangan_hasil_kerja_parer }}</td>
                                <td>{{ $laporandkp->hasil_kerja_sheller }} {{ $laporandkp->sheller_count }}</td>
                                <td><button class="detail-btn" id="openModal2" data-id="{{ $laporandkp->id }}">Hasil
                                        Timbangan</button></td>
                                <td>
                                    <button class="edit" data-id="{{ $laporandkp->id }}">Edit</button>
                                    <form action="{{ route('laporan.dkp.destroy', $laporandkp->id) }}" method="POST"
                                        style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="delete"
                                            data-id="{{ $laporandkp->id }}">Delete</button>
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
                            <h2>FORM INPUT HASIL KERJA SHELLER - PARER ( DKP )</h2>
                            <span class="close">&times;</span>
                        </div>
                        <form action="{{ route('laporan.dkp.store') }}" method="POST" enctype="multipart/form-data" id="laporanForm">
                            @csrf
                            <input type="hidden" name="_method" id="formMethod" value="POST">
                            <input type="hidden" name="id" id="id">
                            <div class="form-container">
                                <div class="form-row">
                                    <div class="form-group">
                                        <label for="nama-sheller-1">Nama Sheller</label>
                                        <input type="text"
                                            class="form-control @error('nama_sheller') is-invalid @enderror"
                                            id="nama_sheller" name="nama_sheller" value="{{ old('nama_sheller') }}"
                                            required>
                                        @error('nama_sheller')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group-total">
                                        <label id="total-label">Total: 0 kg</label>
                                    </div>

                                    <div class="form-group">
                                        <label for="tanggal-picker">Pilih Tanggal</label>
                                        <input type="date" class="form-control @error('tanggal') is-invalid @enderror"
                                            id="tanggal" name="tanggal" value="{{ old('tanggal') }}" required>
                                        @error('tanggal')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>


                                <div id="anggota-parer-container">
                                    <div class="anggota-block template">
                                        <div class="form-row">
                                            <div class="form-group">
                                                <label for="anggota-parer-1">Anggota Parer 1</label>
                                                <input type="text"
                                                    class="form-control @error('nama_parer') is-invalid @enderror"
                                                    id="nama_parer" name="nama_parer" value="{{ old('nama_parer') }}"
                                                    required>
                                                @error('nama_parer')
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="total-keranjang-1">Total Keranjang</label>
                                                <input type="number"
                                                    class="form-control @error('total_keranjang') is-invalid @enderror"
                                                    id="total_keranjang" name="total_keranjang"
                                                    value="{{ old('total_keranjang') }}" min="0">
                                                @error('total_keranjang')
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="tipe-keranjang-1">Tipe Keranjang</label>
                                                <select id="tipe_keranjang"
                                                    class="form-control @error('tipe_keranjang') is-invalid @enderror"
                                                    name="tipe_keranjang" value="{{ old('tipe_keranjang') }}">
                                                    <option value="Keranjang Besar">Keranjang Besar</option>
                                                    <option value="Keranjang Kecil">Keranjang Kecil</option>
                                                </select>
                                                @error('tipe_keranjang')
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <span class="label-timbangan">Hasil Timbangan DKP</span>
                                        <div class="basket-container">
                                            <div class="row">
                                                @for ($i = 0; $i < 12; $i++)
                                                    <div class="col-1 text-center">
                                                        <label for="hasil_kerja_parer_{{ $i }}"
                                                            style="display: block;">{{ $i + 1 }}</label>
                                                        <input class="basket-input" type="number"
                                                            name="hasil_kerja_parer[]"
                                                            id="hasil_kerja_parer_{{ $i }}"
                                                            value="{{ old('hasil_kerja_parer.' . $i, 0) }}"
                                                            oninput="calculateTotal()">
                                                    </div>
                                                @endfor
                                            </div>
                                            <div class="total-container">
                                                <label for="timbangan_hasil_kerja_parer">Total:</label>
                                                <input type="number" id="timbangan_hasil_kerja_parer"
                                                    name="timbangan_hasil_kerja_parer"
                                                    value="{{ old('timbangan_hasil_kerja_parer', 0) }}" readonly>
                                            </div>
                                            @error('hasil_kerja_parer')
                                                <div class="alert alert-danger mt-2">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                 <div class="action-buttons">
                                    <button type="submit" class="submit-btn">Kirim</button>
                                 </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Modal kedua -->
            <div class="modal2" id="modal2">
                <div class="modal-back2">
                    <div class="modal-content2">
                        <div class="header2">
                            <h2>Detail Hasil Timbangan Daging Kelapa Putih</h2>
                        </div>

                        <div class="row2">
                            <div class="form-group2">
                                <label for="namaParer1" class="nama-parer2">Nama Parer</label>
                                <input type="text" id="namaParer1" class="input-nama2">
                            </div>
                            <div class="potongan-keranjang2">
                                <label>Potongan Keranjang</label>
                                <table class="tabel-potongan2">
                                    <thead>
                                        <tr>
                                            <th>Jumlah</th>
                                            <th>Berat</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>2</td>
                                            <td>3</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Tabel Hasil (Bagian Pertama) -->
                        <table class="tabel-hasil2 centered-table2">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>1</th>
                                    <th>2</th>
                                    <th>3</th>
                                    <th>4</th>
                                    <th>5</th>
                                    <th>6</th>
                                    <th>7</th>
                                    <th>8</th>
                                    <th>9</th>
                                    <th>10</th>
                                    <th>11</th>
                                    <th>12</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>10 Desember 2022</td>
                                    <td>2</td>
                                    <td>3</td>
                                    <td>4</td>
                                    <td>5</td>
                                    <td>6</td>
                                    <td>7</td>
                                    <td>8</td>
                                    <td>9</td>
                                    <td>10</td>
                                    <td>11</td>
                                    <td>12</td>
                                    <td>13</td>
                                    <td>14</td>
                                </tr>

                            </tbody>
                        </table>


                        </tbody>
                        </table>

                        <button class="close-btn2" id="closeModal2">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    @endsection

    @section('scripts')
        <script>
          
            function calculateTotal() {
                const container = document.getElementById('anggota-parer-container');
                const allBlocks = container.querySelectorAll('.anggota-block');
                let grandTotal = 0;

                allBlocks.forEach(block => {
                    const inputs = block.querySelectorAll('.basket-input');
                    let blockTotal = 0;
                    let filledColumns = 0;


                    inputs.forEach(input => {
                        if (input.value) {
                            filledColumns += 1;
                            blockTotal += parseFloat(input.value) || 0;
                        }
                    });


                    const totalKeranjangField = block.querySelector('[name="total_keranjang"]');
                    if (totalKeranjangField) {
                        totalKeranjangField.value = filledColumns;
                    }

                    const blockTotalField = block.querySelector('#timbangan_hasil_kerja_parer');
                    blockTotalField.value = blockTotal;

                    grandTotal += blockTotal;
                });


                const totalLabel = document.getElementById('total-label');
                totalLabel.textContent = `Total: ${grandTotal} kg`;
            }


            document.addEventListener("DOMContentLoaded", function() {

                const openFormBtn = document.getElementById('openFormBtn');
                const modal = document.getElementById('modal');
                const closeModalBtn = document.querySelector('.close');
                const form = document.querySelector('form');

                openFormBtn.addEventListener('click', function() {
                    modal.style.display = 'flex';
                });


                closeModalBtn.addEventListener('click', function() {
                    modal.style.display = 'none';
                });

                window.addEventListener('click', function(event) {
                    if (event.target === modal) {
                        modal.style.display = 'none';
                    }
                });


                document.querySelectorAll('.edit').forEach(button => {
                    button.addEventListener('click', function() {
                        const id = this.getAttribute('data-id');

                        fetch(`/laporan/dkp/${id}/edit`)
                            .then(response => response.json())
                            .then(data => {
                                document.getElementById("id").value = data.id;
                                document.getElementById("nama_sheller").value = data.nama_sheller;
                                document.getElementById("tanggal").value = data.tanggal;
                                document.getElementById("nama_parer").value = data.nama_parer;
                                document.getElementById("total_keranjang").value = data.total_keranjang;
                                document.getElementById("tipe_keranjang").value = data.tipe_keranjang;

                                const hasilKerjaParerInputs = document.querySelectorAll("[name='hasil_kerja_parer[]']");
                                hasilKerjaParerInputs.forEach((input, index) => {
                                    input.value = data.hasil_kerja_parer[index] || 0;
                                });

                                calculateTotal();

                                const form = document.getElementById('laporanForm');
                                form.action = `/laporan/dkp/${id}`;
                                document.getElementById("formMethod").value = "PUT"; 

                                modal.style.display = 'flex';
                            })
                            .catch(error => {
                                console.error("Error fetching data:", error);
                            });
                    });
                });

                function calculateTotal() {
                    const inputs = document.querySelectorAll("[name='hasil_kerja_parer[]']");
                    let total = 0;
                    let filledCount = 0;

                    inputs.forEach(input => {

                        if (input.value !== "" && !isNaN(input.value) && parseFloat(input.value) > 0) {
                            filledCount++;
                        }
                    });

                    document.getElementById("total_keranjang").value = filledCount;

                    inputs.forEach(input => {
                        total += parseFloat(input.value) || 0;
                    });

                    document.getElementById("timbangan_hasil_kerja_parer").value = total;
                }
            });

            document.addEventListener('input', function(event) {
                if (event.target.classList.contains('basket-input')) {
                    calculateTotal();
                }
            });


            document.addEventListener("DOMContentLoaded", function() {
                const searchInput = document.getElementById('searchInput');
                const tableBody = document.getElementById('laporanTableBody');

                searchInput.addEventListener('input', function() {
                    const searchTerm = searchInput.value;

                    fetch('{{ route('laporan.dkp.index') }}?search=' + searchTerm)
                        .then(response => response.json())
                        .then(data => {
                            tableBody.innerHTML = '';
                            data.data.forEach((item, index) => {
                                const row = document.createElement('tr');

                                row.innerHTML = `
                                    <td>${index + 1}</td>
                                    <td>${item.tanggal}</td>
                                    <td>${item.nama_sheller}</td>
                                    <td>${item.nama_parer}</td>
                                    <td>${item.timbangan_hasil_kerja_parer}</td>
                                    <td>${item.hasil_kerja_sheller} ${item.sheller_count}</td>
                                    <td><button class="detail-btn" id="openModal2" data-id="${item.id}">Hasil Timbangan</button></td>
                                    <td>
                                        <button class="edit" data-id="${item.id}">Edit</button>
                                        <form action="/laporan/dkp/${item.id}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="delete" data-id="${item.id}">Delete</button>
                                        </form>
                                    </td>
                                `;

                                tableBody.appendChild(row);
                            });
                        })
                        .catch(error => console.error('Error fetching data:', error));
                });
            });

            function openModal2(event) {
                const modal2 = document.getElementById('modal2');
                const dataId = event.target.getAttribute('data-id');

                if (dataId) {
                    fetch(`/laporan/dkp/${dataId}/edit`)
                        .then(response => response.json())
                        .then(data => {
                            document.getElementById('namaParer1').value = data.nama_parer;

                            const tableBody = document.querySelector('.tabel-potongan2 tbody');
                            tableBody.innerHTML = `
                                <tr>
                                    <td>${data.total_keranjang}</td>
                                    <td>${data.berat_keranjang}</td>
                                    <td>${data.total_potongan_keranjang}</td>
                                </tr>
                            `;

                            const hasilTableBody = document.querySelector('.tabel-hasil2 tbody');
                            hasilTableBody.innerHTML = `
                                <tr>
                                    <td>${data.tanggal}</td>
                                    ${(data.hasil_kerja_parer || []).map(hk => `<td>${hk}</td>`).join('')}
                                    <td>${data.timbangan_hasil_kerja_parer}</td></td>
                                </tr>
                            `;

                            modal2.style.display = 'block';
                        })
                        .catch(error => {
                            console.error('Terjadi kesalahan:', error);
                            alert('Gagal memuat data. Silakan coba lagi.');
                        });
                }
            }

            function closeModal2() {
                const modal2 = document.getElementById('modal2');
                modal2.style.display = 'none';
            }

            document.querySelectorAll('.detail-btn').forEach(button => {
                button.addEventListener('click', openModal2);
            });

            const closeModalButton = document.getElementById('closeModal2');
            if (closeModalButton) {
                closeModalButton.addEventListener('click', closeModal2);
            }
            let anggotaCount = 2;

          


            document.querySelector('.submit-btn').addEventListener('click', () => {
                const formData = new FormData();

                formData.append('tanggal', document.getElementById('tanggal').value);
                formData.append('nama_sheller', document.getElementById('nama_sheller').value);

                const anggotaParerBlocks = document.querySelectorAll('.anggota-block');
                anggotaParerBlocks.forEach((block, index) => {
                    formData.append(`nama_parer[${index}]`, block.querySelector('[name="nama_parer[]"]').value);
                    formData.append(`total_keranjang[${index}]`, block.querySelector(
                        '[name="total_keranjang[]"]').value);
                    formData.append(`tipe_keranjang[${index}]`, block.querySelector('[name="tipe_keranjang[]"]')
                        .value);

                    const hasilKerjaInputs = block.querySelectorAll('[name="hasil_kerja_parer[]"]');
                    hasilKerjaInputs.forEach((input, basketIndex) => {
                        formData.append(`hasil_kerja_parer[${index}][${basketIndex}]`, input.value);
                    });
                });

                fetch('/laporandkp/store', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        },
                        body: formData,
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert('Data berhasil ditambahkan!');
                            location.reload();
                        } else {
                            alert('Terjadi kesalahan, coba lagi.');
                        }
                    })
                    .catch(error => console.error('Error:', error));
            });
        </script>
    @endsection
