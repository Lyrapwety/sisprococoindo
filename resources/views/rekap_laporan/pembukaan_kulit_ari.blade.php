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

        .select {
            flex-direction: row;
        }

        .filters select.pilihtanggal {
            padding: 8px 12px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 12px;
            color: #636362;
            width: 135px;

        }

        .filters select.pilihkategori {
            padding: 8px 12px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 12px;
            color: #636362;
            width: 135px;
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
    </style>

    <div class="mainbar">
        <div class="container">
            <div class="header">
                <h2>Rekap Laporan Hasil Kerja Pegawai ( Kulit Ari )</h2>
            </div>

            <div class="filters">
                <div class="select">
                    <select class="pilihtanggal">
                        <option>Pilih Periode</option>
                        <option>12 Agustus 2024</option>
                        <option>13 Agustus 2024</option>
                    </select>

                    <select class="pilihkategori">
                        <option>Pilih Kategori</option>
                        <option>
                            < 300 </option>
                        <option> > 300 < 350 </option>
                        <option> > 350 </option>
                    </select>
                </div>
                <div class="input-icon">
                    <input type="text" class="caridata" placeholder="Cari Data">
                    <i class="fas fa-search"></i> 
                </div>
                <div class="actions">
                    <button class="btn export">
                        <img width="10" height="10" src="https://img.icons8.com/forma-thin/24/export.png"
                            alt="export" /> Export
                    </button>

                </div>
            </div>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Nama Pegawai</th>
                            <th>S/P</th>
                            <th>Hasil Kerja</th>
                            <th>< 300</th>
                            <th>> 300 < 350</th>
                            <th>> 350</th>
                            <th>Total Pendapatan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rekapkulitaris as $index => $rekap)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ \Carbon\Carbon::parse($rekap['tanggal'])->translatedFormat('d F Y') }}</td>
                                <td>{{ $rekap['nama_pegawai'] }}</td>
                                <td>{{ $rekap['sheller_parer'] }}</td>
                                <td>{{ $rekap['timbangan_hasil'] }}</td>
                                <td>{{ $rekap['lessThan300'] }}</td>
                                <td>{{ $rekap['between300And350'] }}</td>
                                <td>{{ $rekap['greaterThan350'] }}</td>
                                <td>Rp.{{ $rekap['totalPendapatan'] }}</td>
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
