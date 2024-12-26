@extends('layouts.app')

@section('content')
    <style>
        .mainbar {
            flex: 1%;
            background-color: #D9D9D9 !important;
            padding-top: 20px;
            margin-left: 235px;
            overflow-y: auto;
            height: auto;
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
            height: auto;
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
            padding: 8px;
            text-align: center;
            border: 1px solid #636362;
            color: #636362;
            font-size: 11px;
        }

        table th {
            border-bottom: 1px solid #636362;
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
            margin: 5px 0 15px 0;/ opacity: 0.5;
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

        .supplier {
            text-align: start;
        }

        .modal-header h5 {
            justify-content: center;
            align-items: center;

        }

        .hori-line {
            color: #565655;
            width: auto;
            opacity: 0.2;
            margin-top: 25px;
            margin-bottom: 10px;
            box-shadow: 0px 0.5px 1px rgba(0, 0, 0, 1);
        }
    </style>

    <div class="mainbar">
        <div class="container">
            <div class="header">
                <h2>Laporan Pemakaian Kelapa Bulat</h2>
            </div>

            <div class="filters">
                <select class="pilihtanggal">
                    <option>Pilih Periode</option>
                    <option>Januari</option>
                    <option>Februari</option>

                </select>
                <div class="input-icon">
                    <input type="text" placeholder="Cari Data" class="search-input">
                    <i class="fas fa-search"></i> 
                </div>
                <div class="actions">
                    <button class="btn export">
                        <img width="10" height="10" src="https://img.icons8.com/forma-thin/24/export.png"
                            alt="export" /> Export
                    </button>

                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#pemakaianModal">
                        Tambah data
                    </button>

                </div>
            </div>
          
            <table>
                <thead>
                    <tr>
                        <th rowspan="2">NO KRJ</th>
                        <th rowspan="2">KB Tanggal & Supplier</th>
                        <th colspan="2">1</th>
                        <th colspan="2">2</th>
                        <th colspan="2">3</th>
                        <th colspan="2">4</th>
                        <th colspan="2">5</th>
                        <th colspan="2">6</th>
                    </tr>
                    <tr>
                        <th>Jam</th>
                        <th>Qty</th>
                        <th>Jam</th>
                        <th>Qty</th>
                        <th>Jam</th>
                        <th>Qty</th>
                        <th>Jam</th>
                        <th>Qty</th>
                        <th>Jam</th>
                        <th>Qty</th>
                        <th>Jam</th>
                        <th>Qty</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($stokkelapabulats as $stok)
                        <tr>
                            <td>{{ $stok->keranjang }}</td>
                            <td>{{ $stok->kbtanggalsupplier }}</td>

                            <td>{{ $stok->shift == 1 ? $stok->jam : '' }}</td>
                            <td>{{ $stok->shift == 1 ? $stok->qty : '' }}</td>

                            <td>{{ $stok->shift == 2 ? $stok->jam : '' }}</td>
                            <td>{{ $stok->shift == 2 ? $stok->qty : '' }}</td>

                            <td>{{ $stok->shift == 3 ? $stok->jam : '' }}</td>
                            <td>{{ $stok->shift == 3 ? $stok->qty : '' }}</td>

                            <td>{{ $stok->shift == 4 ? $stok->jam : '' }}</td>
                            <td>{{ $stok->shift == 4 ? $stok->qty : '' }}</td>

                            <td>{{ $stok->shift == 5 ? $stok->jam : '' }}</td>
                            <td>{{ $stok->shift == 5 ? $stok->qty : '' }}</td>

                            <td>{{ $stok->shift == 6 ? $stok->jam : '' }}</td>
                            <td>{{ $stok->shift == 6 ? $stok->qty : '' }}</td>

                        </tr>
                    @endforeach
                </tbody>

                <tfoot>
                    <tr>
                        <td colspan="2" style="text-align: center; font-weight: bold; border-right: 1px solid black;">
                            Awal / Sisa Tanggal</td>
                        <td colspan="3" style="text-align: center; border-right: 1px solid black;">
                            {{ number_format($awalSisaTanggal, 0, ',', '.') }}</td> 
                        <td colspan="5" style="text-align: center; font-weight: bold; border-right: 1px solid black;">
                            Pengisian Hari Ini</td>
                        <td colspan="4" style="text-align: center; border-right: 1px solid black;">
                            {{ number_format($totalQtyToday, 0, ',', '.') }}</td> 
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align: center; font-weight: bold; border-right: 1px solid black;">
                            Pemakaian Hari Ini</td>
                        <td colspan="3" style="text-align: center; border-right: 1px solid black;">
                            {{ number_format($totalQtyToday, 0, ',', '.') }}</td> 
                        <td colspan="5" style="text-align: center; font-weight: bold; border-right: 1px solid black;">
                            Sisa Hari Ini</td>
                        <td colspan="4" style="text-align: center; border-right: 1px solid black;">
                            {{ number_format($sisaHariIni, 0, ',', '.') }}</td> 
                    </tr>

                </tfoot>
            </table>

            <!-- Pagination Section -->
            <hr class="horizontalline1">
            <div class="pagination-container">

                <div class="showing-entries">

                </div>

            </div>

            <!-- Modal -->
            <div class="modal fade" id="pemakaianModal" tabindex="-1" aria-labelledby="pemakaianModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="pemakaianModalLabel">Laporan Pemakaian Kelapa</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="mainForm" action="{{ route('card_stock.kelapa_bulat.store') }}" method="POST"
                                enctype="multipart/form-data">

                                @csrf
                                <input type="hidden" name="id" id="id">
                                <input type="hidden" name="remark" id="remark" value="{{ request()->query('remark') }}">
                                <input type="hidden" name="trip" id="trip" value="{{ request()->query('trip') }}">
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <label for="tanggal" class="form-label">Tanggal</label>
                                        <input type="date" class="form-control @error('tanggal') is-invalid @enderror"
                                            id="tanggal" name="tanggal" value="{{ old('tanggal') }}" required>
                                        @error('tanggal')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="col-md-4">
                                        <label for="shift" class="form-label">Shift</label>
                                        <select class="form-control @error('shift') is-invalid @enderror" id="shift"
                                            name="shift" value="{{ old('shift') }}" required>
                                            <option value="">Pilih Shift</option>
                                            <option value="1">Shift 1</option>
                                            <option value="2">Shift 2</option>
                                            <option value="3">Shift 3</option>
                                        </select>
                                        @error('shift')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="col-md-4">
                                        <label for="stop" class="form-label">Stop Sheller</label>
                                        <input type="text" class="form-control @error('stop') is-invalid @enderror"
                                            id="stop" name="stop" value="{{ old('stop') }}" required>
                                        @error('stop')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Dropdown untuk No Keranjang -->
                                <h5>Detail Pengisian Keranjang</h5>
                                <div id="keranjangContainer">
                                    <div class="mb-3">
                                        <label for="keranjang" class="form-label">No Keranjang</label>
                                        <select class="form-control @error('keranjang') is-invalid @enderror"
                                            id="keranjang" name="keranjang" value="{{ old('keranjang') }}" required>
                                            <option value="">Pilih No Keranjang</option>
                                            <option value="K001">K1</option>
                                            <option value="K002">K2</option>
                                            <option value="K003">K3</option>
                                            <option value="K004">K4</option>
                                            <option value="K005">K5</option>
                                        </select>
                                        @error('keranjang')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="kbtanggalsupplier" class="form-label">KB Tanggal & Supplier</label>
                                        <input type="text" class="form-control @error('kbtanggalsupplier') is-invalid @enderror"
                                        id="kbtanggalsupplier" name="kbtanggalsupplier" value="{{ request()->query('remark') }}, Trip {{ request()->query('trip') }}" required>
                                 @error('kbtanggalsupplier')
                                 <div class="alert alert-danger mt-2">
                                     {{ $message }}
                                 </div>
                                 @enderror
                                    </div>

                                    <!-- Bagian pengisian dinamis -->
                                    <div id="dynamicRows">
                                        <div class="pengisian">
                                            <h6>Pengisian </h6>
                                            <div class="row g-3 align-items-center mb-2">
                                                <div class="col-md-6">
                                                    <label class="form-label">Jam</label>
                                                    <input type="time"
                                                        class="form-control @error('jam') is-invalid @enderror"
                                                        id="jam" name="jam" value="{{ old('jam') }}"
                                                        required>
                                                    @error('jam')
                                                        <div class="alert alert-danger mt-2">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">Qty</label>
                                                    <input type="number"
                                                        class="form-control @error('qty') is-invalid @enderror"
                                                        id="qty" name="qty" value="{{ old('qty') }}"
                                                        required>
                                                    @error('qty')
                                                        <div class="alert alert-danger mt-2">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="hori-line">
                                </div>

                                <div class="mb-3 d-flex justify-content-end gap-2">
                                    <button type="button" id="addKeranjang" class="btn btn-primary">+ Tambah
                                        Keranjang</button>
                                    <button type="button" id="removeKeranjang" class="btn btn-danger">- Hapus
                                        Keranjang</button>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const keranjangContainer = document.getElementById('keranjangContainer');
            const addKeranjangButton = document.getElementById('addKeranjang');
            const removeKeranjangButton = document.getElementById('removeKeranjang');

            addKeranjangButton.addEventListener('click', () => {
                const keranjangCount = keranjangContainer.children.length;

                const newKeranjang = document.createElement('div');
                newKeranjang.classList.add('keranjang', 'mb-4');
                newKeranjang.innerHTML = `
            <h5>Detail Pengisian Keranjang</h5>
            <div class="mb-3">
                <label for="noKeranjang" class="form-label">No Keranjang</label>
                <select id="noKeranjang" class="form-select">
                    <option value="">Pilih No Keranjang</option>
                    <option value="K001">K1</option>
                    <option value="K002">K2</option>
                    <option value="K003">K3</option>
                    <option value="K004">K4</option>
                    <option value="K005">K5</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="kbTanggalSupplier" class="form-label">KB Tanggal & Supplier</label>
                <input type="text" id="kbTanggalSupplier" class="form-control">
            </div>
            <div id="dynamicRows">
                <div class="pengisian">
                    <h6>Pengisian</h6>
                    <div class="row g-3 align-items-center mb-2">
                        <div class="col-md-6">
                            <label class="form-label">Jam</label>
                            <input type="time" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Qty</label>
                            <input type="number" class="form-control">
                        </div>
                    </div>
                </div>
                <hr class="hori-line">
            </div>
        `;

                keranjangContainer.appendChild(newKeranjang);
            });

            removeKeranjangButton.addEventListener('click', () => {
                if (keranjangContainer.children.length > 0) {
                    keranjangContainer.removeChild(keranjangContainer.lastElementChild);
                } else {
                    alert("Tidak ada keranjang yang bisa dihapus!");
                }
            });
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
