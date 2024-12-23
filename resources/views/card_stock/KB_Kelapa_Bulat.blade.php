@extends('layouts.app')

@section('content')
    <style>

        .mainbar {
            flex: 1%;
            background-color: #D9D9D9 !important;
            padding-top: 20px;
            margin-left: 235px;
            overflow-y: auto;
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
        }


        .filters .input-icon {
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

        .search-input::placeholder {
            color: #636362;
            opacity: 1;

        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.6);
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            width: 400px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            position: relative;
            animation: fadeIn 0.3s ease-in-out;
        }

        .modal-content h2 {
            font-size: 16px;
            margin: 0 auto;
        }

        /* Animasi Modal */
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
            margin-bottom: 15px;
            margin-top: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;


        }

        .form-control {
            width: 100%;
            padding: 8px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: inset 0px 1px 2px rgba(0, 0, 0, 0.1);
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
            background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" fill="%23666" viewBox="0 0 24 24"><path d="M7 10l5 5 5-5z"/></svg>');
            background-repeat: no-repeat;
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

        /* Tombol Submit */
        .submit-btn {
            background-color: #104367;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
        }

        .submit-btn:hover {
            background-color: #104367;
        }
    </style>

    <div class="mainbar">
        <div class="container">
            <div class="header">
                <h2>Card Stock KB Kelapa Bulat</h2>
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

            <!-- Table Section -->
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th style="width: 15px;">No</th>
                            <th style="width: 50px;">Tanggal</th>
                            <th style="width: 100px;">Keterangan</th>
                            <th style="width: 40px;">Begin</th>
                            <th style="width: 40px;">In</th>
                            <th style="width: 40px;">Out</th>
                            <th style="width: 40px;">Remain</th>
                            <th style="width: 40px;">Detail</th>
                            <th style="width: 70px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            @foreach ($stokkbs as $stokkbs)
                             <tr>
                                 <td>{{ $loop->iteration }}</td>
                                 <td>{{ $stokkbs->tanggal }}</td>
                                 <td>{{ $stokkbs->remark }}</td>
                                 <td>{{ $stokkbs->begin }}</td>
                                 <td>{{ $stokkbs->in }}</td>
                                 <td>{{ $stokkbs->out }}</td>
                                 <td>{{ $stokkbs->remain }}</td>
                                 </td>
                                 <td><button class="detail">Pemakaian Kelapa Bulat</td>
                                 <td>
                                     <button class="edit" data-id="{{ $stokkbs->id }}">Edit</button>
                                     <form action="{{ route('card_stock.KB_Kelapa_Bulat.destroy', $stokkbs->id) }}"
                                         method="POST" style="display: inline;">
                                         @csrf
                                         @method('DELETE')
                                         <button type="submit" class="delete"
                                             data-id="{{ $stokkbs->id }}">Delete</button>
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


            <!-- Modal -->
            <div id="modal" class="modal">
                <div class="modal-content">
                    <span class="close-btn" onclick="closeModal()">&times;</span>
                    <h2>Form Input Stok Kelapa Bulat</h2>

                    <form id="stokForm" action="{{ route('card_stock.KB_Kelapa_Bulat.store') }}" method="POST" enctype="multipart/form-data">

                        @csrf
                        <input type="hidden" name="id" id="id">
                        <!-- Tanggal -->
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

                        <!-- Tipe Aktivitas -->
                        <div class="form-group">
                            <label for="activity_type">Tipe Aktivitas</label>
                            <select class="form-control @error('activity_type') is-invalid @enderror"
                            id="activity_type" name="activity_type" value="{{ old('activity_type') }}">
                                <option value="" disabled selected>Pilih Jenis Aktivitas</option>
                                <option value="pembelian">Pembelian</option> <!-- stok tambah-->
                                <option value="pemakaian_produksi">Pemakaian Produksi</option> <!--stok kurang-->
                            
                            </select>
                            @error('activity_type')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                        </div>

                        <!-- Jumlah Stok -->
                        <div class="form-group">
                            <label for="stok">Jumlah Barang</label>
                            <input type="number" class="form-control @error('stok') is-invalid @enderror"
                            id="stok" name="stok" value="{{ old('stok') }}">
                            @error('stok')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                         <div class="form-group">
                            <label for="activity_type">Trip</label>
                            <select class="form-control"
                            id="activity_type" name="activity_type" value="">
                                <option value="" disabled selected>Pilih Trip</option>
                                <option value="1">1</option> 
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>

                            </select>


                        <!-- remark -->
                        <div class="form-group">
                            <label for="remark">Remark</label>
                            <textarea class="form-control @error('remark') is-invalid @enderror"
                            id="remark" name="remark" value="{{ old('remark') }}">
                            @error('remark')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror</textarea>
                        </div>

                        <!-- Tombol Submit -->
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
