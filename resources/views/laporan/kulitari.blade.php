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
.search-input{
    transform: translateY(-5px);
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
    
.modal-header{
    margin-bottom: 15px;
    display: flex;
    justify-content: center;
    align-items: center;
    position: relative; /* Untuk membuat tombol close tetap di pojok kanan */
}

.modal-header h2 {
    color: #636362;
    text-align: center;
    flex-grow: 1;
    
}
.judul{
    font-size: 14px;
    justify-content: center;
    margin-bottom: 20px;
    margin-top: 5px;
}

.form-item {
    display: flex;
    flex-direction: column; /* Susunan vertikal */
    align-items: flex-start; /* Label dan input sejajar ke kiri */
    width: 100%;
}

.form-group {
    display: flex;
    flex-wrap: wrap;
    justify-content: flex-start; /* Elemen sejajar ke kiri */
    align-items: flex-start;
    gap: 20px;
    margin-bottom: 20px;
    margin-left: 10px;
}
.inline-group {
    display: flex;
    flex-direction: column;
    gap: 15px;
    justify-content: flex-end;
    align-items: center;
    margin-left: auto; 
    margin-top:5px;
 
   
}
.inline-group label {
    font-size: 14px;
    color: #636362;
    margin-right: 5px;
}

.inline-group select {
    box-shadow: 0px 1px 1px rgba(0, 0, 0, 0.2);
}

.inline-group input[type="text"],
.inline-group select {
    width: 100%; /* Input dan select mengisi penuh */
    flex: none;
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 13px;
    color: #636362;
    margin-top:5px;
}
/* To make the inline group take up full width */
.full-width {
    width: 100%;
}

label {
    font-size: 14px;
    margin-bottom: 5px;
    color: #636362;
    display: block;
}

.inline-group input[type="date"]{
    width: 90%;
}

input[type="text"],
input[type="number"],
input[type="date"] {
    width: 100%;
    padding: 8px;
    margin-top: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 14px;
   
}

input[type="text"],
input[type="number"]::placeholder,
input[type="date"]::placeholder {
    color: #636362;
    opacity: 1; 
}

input[type="text"],
input[type="number"],
input[type="date"] {
    box-shadow: 0px 1px 1px rgba(0, 0, 0, 0.2);
    color: #636362; /* Warna teks pada input */
}

.timbangan-container {
    text-align: center;
    margin-top: 20px;
}

.timbangan-container h3 {
    font-size: 14px;
    color: #636362;
    margin: 10px 0 15px;

}

.timbangan-inputs {
    display: grid;
    justify-items: center;
    grid-template-columns: repeat(12, 0.5fr);
   
}

.timbangan-inputs div {
    display: flex;
    flex-direction: column;
    align-items: center;
}

.timbangan-inputs label {
    font-size: 12px;
    color: #636362;
    margin-top:10px;
}

.timbangan-inputs input {
    padding: 8px;
    text-align: center;
    font-size: 14px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-shadow: 0px 1px 1px rgba(0, 0, 0, 0.2);
    width: 90%;
    height: 80%;
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
.close {
    position: absolute;
    top:5px;
    right: 2px;
    font-size: 15px;
    font-weight: bold;
    color: #636362;
    cursor: pointer;
    transform: translateX(12px);
    transform: translateY(-10px);
   
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
            width: 70%;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 100%;
            display: flex;
            height: auto;
           
            flex-direction: column;
        }

        .modal-content2 {
          
            padding: 10px;
            background-color: #F7F7F7;
            border-radius: 10px;
            margin: 15px;
            padding-left: 25px;
        }

        .header2 {
            text-align: center;
            padding: 10px 0;
            margin-bottom: 15px;
            margin-top: 10px;
            font-weight: 200;
        }

        .header2 h2 {
            font-size: 14px;
            color: #636362;
        }

        .row2 {
            display: flex;
            align-items: center; /* Center align items vertically */
            justify-content: space-between; /* Space between items */
            margin-bottom: 20px;
            margin-left: 20px;
        }

        .form-group2 {
            flex: 1; /* Make it take available space */
            display: flex;
            flex-direction: column;
            margin-right: 10px; /* Add space between inputs */
            
        }
        .form-item {
            display: flex;
             align-items: center;
            gap: 10px;
}

.form-item .label {
    width: 120px; /* Adjust this width as necessary to align labels */
    font-weight: bold;
}

        
        .nama-parer2 {
            margin-bottom: 5px;
            font-weight: 200;
            color: #636362;
            font-size: 0.9em;
            
        }

        .input-nama2 {
            width: 95% !important;
            height: 60%;
            padding: 8px;
            border: 1px solid #ccc;
            margin-top: 10px;
            border-radius: 5px;
            background-color: #F7F7F7;
            box-shadow: 1px 4px 2px rgba(217, 217, 217, 0.5);
        }

        .input-group {
            flex:1; /* Make it take available space */
            background-color: #F7F7F7;
        }

        .input-group label {
            display: block;
            font-weight: 200 !important;
            font-size: 0.9em;
            color: #636362;
        }

        .input-group input {
            width: 95% !important;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            padding: 8px;
            border: 1px solid #ccc;
            margin-top: 10px;
            border-radius: 4px;
            background-color: #F7F7F7;
        }
       
        .potongan-keranjang2 label{
            font-size: 0.9em;
            color: #636362;
            margin-top: 10px;
            font-weight: 200;
            
        }
        .potongan-keranjang2 {
            color: #636362;
            flex: 1; /* Make it take available space */
            text-align: center;
            transform: translateY(0px);
           /* Add space between inputs */
        }

        .tabel-potongan2 {
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            border-collapse: collapse;
            font-weight: 200;
            border-radius: 8px;
            font-size: 0.75em;
            width: 75%;
            transform: translateX(30px);
            margin-top: 15px; /* Space above the table */
        }

        .tabel-potongan2 th, .tabel-potongan2 td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: center;
            font-weight: 200;
            border-radius: 8px 8px 0 0;
            width: 33.33%; 
        }

        .weight-tables {
            display: flex;
            margin-left:20px ;
            gap: 24px;
            justify-content: flex-start; /* Space between tables */
            margin-top: 20px; /* Space above tables */
        }

        .weight-table {
            width: 31%;
            border-collapse: collapse;
            border-radius: 10px;
            color: #636362;
            font-size: 0.75em;
            border: 1px solid #ccc;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }

        .weight-table, .weight-table th, .weight-table td {
            border: 1px solid #ccc;
            text-align: center;
            border-radius: 10px;
        }

        .weight-table th {
            background-color: #f9f9f9;
            padding: 10px;
            font-weight: normal;
            color: #777;
        }

        .weight-table td {
            padding: 8px;
            height: 40px;
        }

        .total {
            text-align: right;
            font-weight: 200;
            margin-top: 20px;
            color: #555;
            justify-content: center;
            text-align: center;
            align-items: center;
            transform:translateX(70px);   
            font-size: 0.75em;}


        .close-btn2 {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 15%;
            font-size: 0.75em;
            display: block;
            float: right;
            transform: translateX(-60px);
            margin-bottom: 15px;
        }

        .close-btn2:hover {
            background-color: #3f8d43;
        }
  .modal, .modal2 {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    z-index: 1000; /* Pastikan cukup tinggi */
}
</style>

<div class="mainbar">
    <div class="container">
        <div class="header">
            <h2>Laporan Harian Hasil Kerja Sheller - Parer ( Kulit Ari Basah )</h2>
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
                <button class="btn export">
                   <img width="10" height="10" src="https://img.icons8.com/forma-thin/24/export.png" alt="export"/> Export
                </button>
                <button id="openFormBtn1" class="btn add">+ Tambah Data</button>
            </div>
        </div>

        <!-- Table Section -->
       
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Nama Pegawai</th>
                        <th> S/P</th>
                        <th>Bruto</th>
                        <th>Potongan KRJ</th>
                        <th>Hasil Kerja</th>
                        <th>Detail</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>12 Agustus 2024</td>
                        <td>Marcella</td>
                        <td> S </td>
                        <td>50</td>
                        <td>150</td>
                        <td>30 0</td>
                        <td><button id="openFormBtn2">Hasil Timbangan</button></td>
                        <td>
                            <button class="edit">Edit</button>
                            <button class="delete">Delete</button>
                        </td>
                    </tr>
                    <!-- Tambah data lainnya -->
                </tbody>
            </table>
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


    <!-- Modal -->
    <div id="modal" class="modal">
        <div class="modal-content">
            <div id="modal-back" class="modal-back">
            <div class="modal-header">
                <h2 class="judul">FORM INPUT HASIL KERJA SHELLER - PARER ( KULIT ARI BASAH )</h2>
                <span class="close">&times;</span>
            </div>
    
            <div class="form-group">
                <div>
                    <label for="nama-sheller">Nama Sheller / Parer</label>
                    <input type="text" id="nama-sheller" value="Marcella Corazon">
                </div>
               
                <div>
                    <label for="tanggal-picker">Tanggal</label>
                    <input type="date" id="tanggal-picker">
                </div>
    
                <div class="inline-group">
                    <div class="form-item">
                        <label for="total-keranjang">Total Keranjang</label>
                        <input class="totalkrj" type="text" id="total-keranjang">
                    </div>
            
                    <div class="form-item">
                        <label for="tipe-keranjang">Tipe Keranjang</label>
                                    <select id="tipe-keranjang" class="custom-select">
                                        <option value="A">Keranjang Besar</option>
                                        <option value="B">Keranjang Kecil</option>
                                    </select>
                    </div>
                </div>
            </div>
                
            <div class="timbangan-container">
                <h3>Hasil Timbangan Kulit Ari Basah</h3>
                <div class="timbangan-inputs">
                    <!-- Each input wrapped with a label above -->
                    <div>
                        <label for="timbangan-1">1</label>
                        <input type="number" id="timbangan-1">
                    </div>
                    <div>
                        <label for="timbangan-2">2</label>
                        <input type="number" id="timbangan-2">
                    </div>
                    <div>
                        <label for="timbangan-3">3</label>
                        <input type="number" id="timbangan-3">
                    </div>
                    <div>
                        <label for="timbangan-4">4</label>
                        <input type="number" id="timbangan-4">
                    </div>
                    <div>
                        <label for="timbangan-5">5</label>
                        <input type="number" id="timbangan-5">
                    </div>
                    <div>
                        <label for="timbangan-6">6</label>
                        <input type="number" id="timbangan-6">
                    </div>
                    <div>
                        <label for="timbangan-7">7</label>
                        <input type="number" id="timbangan-7">
                    </div>
                    <div>
                        <label for="timbangan-8">8</label>
                        <input type="number" id="timbangan-8">
                    </div>
                    <div>
                        <label for="timbangan-9">9</label>
                        <input type="number" id="timbangan-9">
                    </div>
                    <div>
                        <label for="timbangan-10">10</label>
                        <input type="number" id="timbangan-10">
                    </div>
                    <div>
                        <label for="timbangan-11">11</label>
                        <input type="number" id="timbangan-11">
                    </div>
                    <div>
                        <label for="timbangan-12">12</label>
                        <input type="number" id="timbangan-12">
                    </div>
                </div>
            </div>
    
            <div class="total-container">
                <span>Total: 250 kg</span>
            </div>
    
            <button class="submit-btn">Kirim</button>
        </div>
    </div>
    

    
    <div class="modal2" id="modal2">
        <div class="modal-back2">
            <div class="modal-content2">
                <div class="header2">
                    <h2>DETAIL HASIL TIMBANGAN KULIT ARI</h2>
                </div>

                <div class="row2">
                    <div class="form-group2">
                        <label for="name" class="nama-parer2">Nama Sheller / Parer</label>
                        <input type="text" id="name" class="input-nama2">
                    </div>
                    <div class="input-group">
                        <label for="date">Tanggal</label>
                        <input type="text" id="date" class="tanggal">
                    </div>
                    <div class="potongan-keranjang2">
                        <label>Potongan Keranjang</label>
                        <table class="tabel-potongan2">
                            <tr>
                                <th>Banyak</th>
                                <th>Berat</th>
                                <th>Total</th>
                            </tr>
                            <tr>
                                <td>20</td>
                                <td>20</td>
                                <td>20</td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="weight-tables">
                    <table class="weight-table">
                        <tr>
                            <th>NO</th>
                            <th>BERAT ( KG )</th>
                        </tr>
                        <tr><td>1</td><td></td></tr>
                        <tr><td>2</td><td></td></tr>
                        <tr><td>3</td><td></td></tr>
                        <tr><td>4</td><td></td></tr>
                        <tr><td>5</td><td></td></tr>
                        <tr><td>6</td><td></td></tr>
                    </table>
                    <table class="weight-table">
                        <tr>
                            <th>NO</th>
                            <th>BERAT ( KG )</th>
                        </tr>
                        <tr><td>7</td><td></td></tr>
                        <tr><td>8</td><td></td></tr>
                        <tr><td>9</td><td></td></tr>
                        <tr><td>10</td><td></td></tr>
                        <tr><td>11</td><td></td></tr>
                        <tr><td>12</td><td></td></tr>
                    </table>
                </div>

                <div class="total">
                    Total : 250 KG
                </div>
                <button class="close-btn2" id="closeModal2">TUTUP</button>
            </div>
        </div>
    </div>

    
        </div>
    </div>
</div>
</div>

@endsection

@section('scripts')
<script>
// Modal 1
const openFormBtn1 = document.getElementById("openFormBtn1");
const modal1 = document.getElementById("modal");
const closeModal1 = modal1.querySelector(".close");

openFormBtn1.addEventListener("click", function () {
    modal1.style.display = "block";
});

closeModal1.addEventListener("click", function () {
    modal1.style.display = "none";
});

window.addEventListener("click", function (event) {
    if (event.target === modal1) {
        modal1.style.display = "none";
    }
});

// Modal 2
const openFormBtn2 = document.getElementById("openFormBtn2");
const modal2 = document.getElementById("modal2");
const closeModal2 = document.getElementById("closeModal2");

openFormBtn2.addEventListener("click", function () {
    modal2.style.display = "block";
});

closeModal2.addEventListener("click", function () {
    modal2.style.display = "none";
});

window.addEventListener("click", function (event) {
    if (event.target === modal2) {
        modal2.style.display = "none";
    }
});

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


document.getElementById('tanggal-picker').addEventListener('change', function() {
var selectedDate = new Date(this.value);
var year = selectedDate.getFullYear();
var month = selectedDate.getMonth() + 1; // Januari adalah 0
var day = selectedDate.getDate();

console.log('Tanggal dipilih: ' + year + '-' + month + '-' + day);
});


</script>
@endsection