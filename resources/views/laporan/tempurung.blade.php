@extends('layouts.app')

@section('content')
<style>
.mainbar {
    flex: 1%;
    background-color: #D9D9D9 !important;
    padding-top: 20px; /* Jarak dari topbar */
    margin-left: 235px;
    overflow-y: auto;
    height: calc(100vh - 70px);
    width: calc(100% - 235px);
    font-family: 'Inter', sans-serif; !important;
}

.container {
    padding: 20px;
    background-color:#F7F7F7;
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
    padding: 8px 12px; /* Padding yang sama */
    height: 36px; /* Tinggi yang sama */
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
    padding: 8px 35px 8px 12px; /* Tambahkan padding untuk ikon */
    border: 1px solid #cc;
    border-radius: 5px;
    font-size: 12px;
    
}

.caridata{
    color: #636362 !important;
}

.filters .input-icon i {
    position: absolute;
    padding-right: 10px;
    top: 50%;
    color:#636362;
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
    border-collapse: collapse; /* Agar garis antar sel menyatu */
    border-radius: 10px;
    box-shadow: 0px 0px 10px rgba(230, 238, 241, 0.1);
    
}

table th, table td {
    padding: 10px;
    text-align: center;
    border: 1px solid #636362; /* Garis antar sel */
    color: #636362;
    font-size: 12px;
}

table th {
    border-bottom: 1px solid #636362; /* Garis tebal untuk header */
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
    background-color:#104367;
    color: white;
    opacity: 85%;
}

.input-icon {
    position: relative;
    width: 100%;
    max-width: 100px; /* Sesuaikan dengan kebutuhan */
    color: #636362;
}

.search-input::placeholder {
    color: #636362; /* Ganti dengan warna yang diinginkan */
    opacity: 1; /* Mengatur opasitas jika perlu */
}

.input-icon i {
    position: absolute;
    right: 5px !important;/* Pindahkan ikon ke sisi kanan */
    top: 50%;
    transform: translateY(-50%);
    color: #636362; /* Warna ikon */
}

.input-icon input {
    width: 100%;
    padding: 10px 40px 10px 10px; /* Tambahkan padding kanan untuk ruang ikon */
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 14px;
    outline: none;
    
}

./* Gaya untuk input saat fokus */
.input-icon input:focus {
    border-color: #104367; /* Ubah warna border saat fokus */
}

.horizontalline1 {
        /* Warna teks, tidak berpengaruh pada <hr> */
        border: none; /* Hapus border default */
        border-bottom: 0.5px solid #ccc;
         width: 100%; /* Lebar penuh */
         margin: 5px 0 15px 0; /* Margin atas, kanan, bawah, kiri */
        opacity: 0.5; /* Nilai opasitas (1 = tidak transparan) */
        padding-top: 20px;
}

    .btn.export {
        display: flex;
        align-items: center; /* Mengatur ikon dan teks dalam satu baris */
        color: white; /* Mengatur warna teks menjadi putih */
        border: none; /* Menghapus border default */
         /* Menambahkan padding */
        cursor: pointer; /* Menambahkan kursor pointer */
    }

     .btn.export img {
      /* Jarak antara ikon dan teks */  
        filter: brightness(0) invert(1);
      
   
    }
    .search-input::placeholder {
    color: #636362; /* Ganti dengan warna yang diinginkan */
    opacity: 1; /* Mengatur opasitas jika perlu */
}

.modal {
            display: block;
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
            padding: 25px; /* Tambahan padding agar lebih rapi */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 800px; /* Batas maksimal lebar modal */
            width: 100%;
            overflow-y: auto;
        }
        .modal-content {
                position: relative;
                background-color: #D9D9D9;
                margin: auto;
                padding: 20px;
                width: 60%;
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
            margin-bottom: 20px;
           
        }

        .modal-header h2 {
            font-size: 14px;
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
        .input h3{    
            font-size: 14px;
            font-weight: bold;
            margin: 0 auto; 

        }
        .form-container {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
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
        margin-top: 40px;
}

.timbangan-container h3 {
        font-size: 14px;
        color: #636362;
        margin: 10px 0 15px;

}

.timbangan-inputs {
    display: grid;
    justify-items: center;
    align-items: center;
    grid-template-columns: repeat(7, 1fr);
    margin: 0 auto; /* Pastikan elemen berada di tengah */
    width: auto; /* Sesuaikan lebar grid dengan isinya */
  
   
}

.timbangan-inputs div {
    display: flex;
    flex-direction: row;
    align-items: center;
  
}

.timbangan-inputs label {
    font-size: 12px;
    color: #636362;
    margin: 0;
    width: 20px; /* Lebar tetap untuk label */
    text-align: right; 
    margin-right: 10px;
}

.timbangan-inputs input {
    text-align: center;
    margin-bottom: 10px;
    font-size: 14px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-shadow: 0px 1px 1px rgba(0, 0, 0, 0.2);
    width: 60%;
    height: 30%;
}

.total-container {
    text-align: right;
    margin-top: 20px;
    font-size: 14px;
    color: #636362;
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
    display: block; /* Membuat tombol tetap dalam satu baris */
    margin-left: auto; /* Agar berada di sebelah kanan */
    margin-right: auto;
}

.submit-btn:hover {
    background-color: #aaa;
}
.input-field {
  
    margin-bottom: 10px;
    font-size: 14px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-shadow: 0px 1px 1px rgba(0, 0, 0, 0.2);
    width: 60%;
    height: 45%;
}

.input-select {
    font-size: 14px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-shadow: 0px 1px 1px rgba(0, 0, 0, 0.2);
    width: 60%;
    height: 45%;
}

.form-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 10px; /* Jarak antar elemen */
}


.input-field, .input-select {
 
    font-size: 14px;
    border: 1px solid #ccc;
    border-radius: 5px;
    padding: 5px;
    width: 100%;
    box-sizing: border-box; /* Pastikan padding tidak memengaruhi lebar */
}

</style>

<div class="mainbar">
    <div class="container">
        <div class="header">
            <h2>Laporan Harian Hasil Tempurung Basah</h2>
        </div>

        <!-- Filter Section -->
        <div class="filters">
            <select class="pilihtanggal">
                <option>Pilih Tanggal</option>
                <option>12 Agustus 2024</option>
                <option>13 Agustus 2024</option>
            </select>
            <div class="input-icon">
                <input type="text"  placeholder="Cari Data" class="search-input">
                <i class="fas fa-search"></i> <!-- Ikon pencarian (search icon) -->
            </div>
            <div class="actions"> 
                <button class="btn export">
                   <img width="10" height="10" src="https://img.icons8.com/forma-thin/24/export.png" alt="export"/> Export
                </button>
                
                <button id="openFormBtn" class="btn add">+ Tambah Data</button>
            </div>
        </div>

        <!-- Table Section -->
       
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
                    <tr>
                        <td>1</td>
                        <td>12 Agustus 2024</td>
                        <td>123</td>
                        <td>Kecil</td>
                        <td>50</td>
                        <td>300</td>
                        <td><button>Hasil Timbangan</button></td>
                        <td>
                            <button class="edit">Edit</button>
                            <button class="delete">Delete</button>
                        </td>
                    </tr>
                    <!-- Tambah data lainnya -->
                </tbody>
            </table>
        </div>
        

        <div class="modal">
            <div class="modal-content">
                <div id="modal-back" class="modal-back">
            <div class="modal-header">
                <h2>FORM INPUT HASIL TEMPURUNG BASAH</h2>
                <button class="close">&times;</button>
            </div>
    
            <div class="form-container">
                <div class="form-row">
                <div class="column">
                    <label for="tanggal">Tanggal</label>
                    <input type="text" id="tanggal"  class="input-field">
                </div>
                <div class="column">
                    <label for="tipe-keranjang">Tipe Keranjang</label>
                    <select id="tipe-keranjang" class="input-select">
                        <option value="A">Keranjang Besar</option>
                        <option value="B">Keranjang Kecil</option>
                    </select>
                </div>
                <div class="column">
                    <label for="total-keranjang">Total Keranjang</label>
                    <input type="text" id="total-keranjang" class="input-field">
                </div>
            </div>
            </div>
    
       
    <div class="timbangan-container">
            <h3>Hasil Timbangan Tempurung Basah</h3>
            <div class="timbangan-inputs">
                <!-- Input grid -->
                <div><label>1</label><input type="number"></div>
                <div><label>2</label><input type="number"></div>
                <div><label>3</label><input type="number"></div>
                <div><label>4</label><input type="number"></div>
                <div><label>5</label><input type="number"></div>
                <div><label>6</label><input type="number"></div>
                <div><label>7</label><input type="number"></div>

                <div><label>8</label><input type="number"></div>
                <div><label>9</label><input type="number"></div>
                <div><label>10</label><input type="number"></div>
                <div><label>11</label><input type="number"></div>
                <div><label>12</label><input type="number"></div>
                <div><label>13</label><input type="number"></div>
                <div><label>14</label><input type="number"></div>

                <div><label>15</label><input type="number"></div>
                <div><label>16</label><input type="number"></div>
                <div><label>17</label><input type="number"></div>
                <div><label>18</label><input type="number"></div>
                <div><label>19</label><input type="number"></div>
                <div><label>20</label><input type="number"></div>
                <div><label>21</label><input type="number"></div>

                <div><label>22</label><input type="number"></div>
                <div><label>23</label><input type="number"></div>
                <div><label>24</label><input type="number"></div>
                <div><label>25</label><input type="number"></div>
                <div><label>26</label><input type="number"></div>
                <div><label>27</label><input type="number"></div>
                <div><label>28</label><input type="number"></div>
            </div>
        </div>
    
            <div class="total-container">
                Total: 250 KG
            </div>
        
            <button class="submit-btn">Kirim</button>
        </div>
            </div>
        </div>

        <!-- Pagination Section -->
        <hr class="horizontalline1">
        <div class="pagination-container">
          
            <div class="showing-entries">
                Showing <span id="start"></span> to <span id="end"></span> from <span id="total"></span> entries
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
        document.querySelector('.close').addEventListener('click', function () {
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
const data = [
    { no: 1, tanggal: "12 Agustus 2024", nama: "Marcella", sp: "S", bruto: 50, potongan: 0, hasil: 150, detail: "Hasil Timbangan" },
    { no: 2, tanggal: "12 Agustus 2024", nama: "Zhuxin", sp: "P", bruto: 75, potongan: 0, hasil: null, detail: "Hasil Timbangan" },
    { no: 3, tanggal: "12 Agustus 2024", nama: "Monica", sp: "S", bruto: 25, potongan: 0, hasil: null, detail: "Hasil Timbangan" },
    { no: 4, tanggal: "12 Agustus 2024", nama: "Aurora", sp: "S", bruto: 240, potongan: 0, hasil: 240, detail: "Hasil Timbangan" },
    { no: 5, tanggal: "12 Agustus 2024", nama: "Layla", sp: "P", bruto: 125, potongan: 0, hasil: 250, detail: "Hasil Timbangan" },
    { no: 6, tanggal: "12 Agustus 2024", nama: "Sonya", sp: "S", bruto: 125, potongan: 0, hasil: null, detail: "Hasil Timbangan" },
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