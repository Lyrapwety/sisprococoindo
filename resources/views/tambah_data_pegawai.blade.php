@extends('layouts.app')

@section('content')
    <style>
        /* Mainbar */
        .mainbar {
            flex: 1;
            flex-grow: 1;
            background-color: #D9D9D9 !important;
            padding-top: 20px;
            /* Jarak dari topbar */
            margin-left: 255px;
            height: 100%;
            width: calc(100%-235px);
            font-family: 'Inter', sans-serif;
            !important;
        }

        .container {
            padding: 20px;
            background-color: #F7F7F7;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            border-radius: 15px;
            width: calc(100% - 80px);
            margin: 20px auto;
            font-family: 'Inter', sans-serif;
            flex-grow: 1;
            /* Agar container meregang sesuai konten */
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;

        }

        .header h2 {
            font-size: 16px;
            margin: 0 auto;
            color: #636362;
            margin-bottom: 20px;
            display: flex;
            justify-content: center;
            text-align: center;

        }

        .profile-pic img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
        }

        //* Container Utama */
        .form-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            max-width: 900px;
            margin: 0 auto;
        }

        .form-main {
            display: flex;
            gap: 20px;
        }

        .form-inputs {
            flex: 2;

        }

        .profile-picture {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
        }

        /* Gambar foto profil */
        #profile-image {
            width: 150px;
            height: 200px;
            object-fit: cover;
            border-radius: 10px;
            border: 2px solid #ccc;
        }

        /* Mengatur layout dua kolom menggunakan grid */
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 20px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            margin-left: 10px;
        }

        .form-group label {
            font-size: 12px;
            margin-bottom: 8px;
            color: #636362;
            font-weight: 500;
        }

        .form-group input {
            width: :75%;
            padding: 8px;
            font-size: 12px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
            color: #636362;
            font-weight: 400;
            box-shadow: 0px 1px 2px rgba(0, 0, 0, 0.2);
        }

        .custom-dropdown {
            width: 100%;
            padding: 10px;
            font-size: 14px;
            font-family: 'Inter', sans-serif;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
            color: #636362;
            appearance: none;
            /* Hilangkan tanda panah bawaan browser */
            background-image: url('data:image/svg+xml;charset=UTF-8,%3Csvg xmlns%3D%22http://www.w3.org/2000/svg%22 width%3D%228%22 height%3D%228%22 viewBox%3D%220 0 8 8%22%3E%3Cpath d%3D%22M0 2l4 4 4-4H0z%22 fill%3D%22%23636362%22/%3E%3C/svg%3E');
            /* Ikon panah bawah */
            background-repeat: no-repeat;
            background-position: right 10px center;
            background-size: 10px;
            cursor: pointer;
        }

        /* Fokus pada elemen dropdown */
        .custom-dropdown:focus {
            outline: none;
            border-color: #636362;
        }

        /* Form Group Styling */
        .form-group {
            margin-bottom: 15px;
        }


        .profile-picture {
            display: flex;
            flex-direction: column;
            /* Mengatur elemen di dalamnya berurutan secara vertikal */
            align-items: center;
            /* Pusatkan elemen di tengah secara horizontal */
            gap: 10px;
            /* Jarak antara gambar dan tombol */
        }

        #profile-image {
            width: 150px;
            /* Atur ukuran gambar */
            height: 200px;
            /* Sesuaikan ukuran gambar */
            object-fit: cover;
            /* Pastikan gambar tidak terdistorsi */
            border-radius: 10px;
            border: 2px solid #ccc;
        }

        .btn-update-foto {
            padding: 8px;
            width: 100px;
            background-color: #0e4375;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 12px;
            text-align: center;
        }

        .btn-update-foto:hover {
            background-color: #063361;
        }

        .btn-preview {
            padding: 8px;
            width: 20%;
            background-color: #0e4375;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 12px;
            text-align: center;

        }

        .btn-update {
            width: 20%;
            padding: 10px 20px;
            background-color: #0e4375;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 12px;
            margin-left: 10px;
            text-align: center;
        }

        .btn-update:hover {
            background-color: #063361;
        }

        .btn-preview:hover {
            background-color: #063361;
        }

        .button-container {
            display: flex;
            justify-content: center;
            /* Posisi tombol di ujung kanan */
            gap: 10px;
            /* Jarak antara tombol */
            margin-top: 20px;
            /* Jarak dari elemen sebelumnya */
        }


        .modal-content {
            border-radius: 8px;
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            padding:
        }

        .modal-header {
            background-color: #f7f7f7;
            color: #fff;
            border-bottom: 2px blur #565655;
            padding: 1rem 2rem;
            text-align: center;
        }

        .modal-title {
            font-size: 16px;
            color: #636362;
            margin: 0 auto;
            transform: translateX(100px);
        }

        .btn-close {
            color: #fff;
            background: none;
            border: none;
            opacity: 1;
        }

        .modal-body {
            padding: 1.5rem;
            background-color: #f9f9f9;
        }

        .table {
            width: 100%;
            margin: 0;
            background-color: #f9f9f9;
            border-collapse: collapse;
            border-radius: 10px;
            margin-left: 5px;

        }

        .table th,
        .table td {
            padding: 0.75rem;
            vertical-align: middle;
            text-align: left;
            vertical-align: middle;
            border: 1px solid #ddd;
            width: auto;
            /* Lebar mengikuti konten */
            word-break: break-word;
        }

        .table th {
            background-color: #fff;
            color: #636362;
            font-size: 12px;
            font-weight: 200 !important;

        }

        .table td {
            color: #636362;
            background-color: #fff;
            font-size: 12px;
        }

        .table-bordered th,
        .table-bordered td {
            border: 1px solid #ccc;

        }

        img#preview-foto {
            border: 1px solid #ddd;
            background-color: #fff;
            padding: 2px;
            max-height: 200px;
            margin-top: 1rem;
            box-shadow: 0px 1px 2px rgba(0, 0, 0, 0.2);
            transform: translateX(10px);
        }

        .modal-footer {
            background-color: #f9f9f9;


        }

        .btn-secondary {
            background-color: #0e4375;
            border-color: #6c757d;
            font-size: 14px;
            color: #fff;
            margin-bottom: 0;
            margin-top: 0;
            margin: 0 auto;
            transition: background-color 0.3s ease, border-color 0.3s ease;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
            border-color: #545b62;
        }

        .fixed-width {
            width: 60px;
            /* Anda bisa menyesuaikan lebar sesuai kebutuhan */
            max-width: 60px;
            /* Membatasi lebar maksimum */
            min-width: 50px;
            /* Membatasi lebar minimum */
            white-space: nowrap;
            /* Mencegah teks untuk wrap ke baris baru */
            overflow: hidden;
            /* Menyembunyikan teks yang melebihi lebar kolom */
            text-overflow: ellipsis;
            /* Mengganti teks yang terpotong dengan elipsis (...) */
        }
    </style>

    <div class="mainbar">
        <div class="container">
            <div class="header">
                <h2>Form Tambah Data Pegawai</h2>
            </div>

            <div class="form-container">
                <form action="{{ route('data_pegawai.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" id="id">
                    <div class="form-main">
                        <!-- Bagian kiri (Form Input) -->
                        <div class="form-inputs">
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="tgl_join">Tgl Join</label>
                                    <input type="date" class="form-control @error('tgl_join') is-invalid @enderror"
                                        id="tgl_join" name="tgl_join" value="{{ old('tgl_join') }}">
                                    @error('tgl_join')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="tgl-out">Tgl Out</label>
                                    <input type="date" class="form-control @error('tgl_out') is-invalid @enderror"
                                    id="tgl_out" name="tgl_out" value="{{ old('tgl_out') }}">
                                @error('tgl_out')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                                </div>
                            </div>


                            <div class="form-row">
                                <div class="form-group">
                                    <label for="nama">Nama Lengkap</label>
                                    <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                        id="nama" name="nama" value="{{ old('nama') }}">
                                    @error('nama')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="id">ID Pegawai</label>
                                    <input type="text" class="form-control @error('id_pegawai') is-invalid @enderror"
                                        id="id_pegawai" name="id_pegawai" value="{{ old('id_pegawai') }}">
                                    @error('id_pegawai')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label for="posisi">Posisi</label>
                                    <select id="posisi" class="form-control @error('posisi') is-invalid @enderror"
                                        id="posisi" name="posisi" value="{{ old('posisi') }}">
                                        <option value="" disabled selected>Pilih Posisi</option>
                                        <option value="Operator">Operator</option>
                                        <option value="Helper">Helper</option>
                                        <option value="Sheller">Sheller</option>
                                        <option value="Parer">Parer</option>
                                        <option value="HR">HR</option>
                                        <option value="Accounting">Accounting</option>
                                        <option value="Accounting Manager">Accounting Manager</option>
                                        <option value="Production Manager">Production Manager</option>
                                        <option value="Purchasing Staff">Purchasing Staff</option>
                                        <option value="Admin Gudang">Admin Gudang</option>
                                        <option value="Admin Production">Admin Production</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="department">Departemen</label>
                                    <select id="departemen" class="form-control @error('departemen') is-invalid @enderror"
                                    id="departemen" name="departemen" value="{{ old('departemen') }}">
                                        <option value="" disabled selected>Pilih Departemen</option>
                                        <option value="Kupas Kelapa">Kupas Kelapa</option>
                                        <option value="Produksi">Produksi</option>
                                        <option value="Office">Office</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label for="status-kepegawaian">Status Kepegawaian</label>
                                    <select id="kepagawaian" class="form-control @error('kepagawaian') is-invalid @enderror"
                                    id="kepagawaian" name="kepagawaian" value="{{ old('kepagawaian') }}">
                                        <option value="" disabled selected>Pilih Status</option>
                                        <option value="PKWT">PKWT</option>
                                        <option value="KKWT">KKWT</option>
                                        <option value="Proyek">Proyek</option>
                                        <option value="Permanent">Permanent</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <input type="text" class="form-control @error('status') is-invalid @enderror"
                                    id="status" name="status" value="Aktif" readonly>
                                </div>
                            </div>

                            <div class="button-container">
                                <button type="button" class="btn-preview" id="btn-preview" data-bs-toggle="modal"
                                    data-bs-target="#previewModal">Preview</button>
                                <button type="submit" class="btn-update">Tambah</button>
                            </div>
                        </div>

                        <!-- Bagian kanan (Foto Profil) -->
                        <div class="profile-picture">
                            <img src="{{ asset('img/hi logo.png') }}" alt="Foto Profil" id="profile-image">
                            <input type="file" id="profile-input" accept="image/*" style="display: none;">
                            <button type="button" class="btn-update-foto" id="change-profile-btn">Ganti Profil</button>

                        </div>
                    </div>
                </form>
            </div>
        </div>


        <div class="modal fade" id="previewModal" tabindex="-1" aria-labelledby="previewModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="previewModalLabel">Preview Data Pegawai</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-8">
                                <!-- Tampilkan Data Pegawai -->
                                <table class="table table-bordered">
                                    <tr>
                                        <th class="fixed-width">Tanggal Join</th>
                                        <td id="preview-tgl-join">-</td>
                                    </tr>
                                    <tr>
                                        <th class="fixed-width">Tanggal Out</th>
                                        <td id="preview-tgl-out">-</td>
                                    </tr>
                                    <tr>
                                        <th class="fixed-width">Nama Lengkap</th>
                                        <td id="preview-nama">-</td>
                                    </tr>
                                    <tr>
                                        <th class="fixed-width">ID Pegawai</th>
                                        <td id="preview-id">-</td>
                                    </tr>
                                    <tr>
                                        <th class="fixed-width">Posisi</th>
                                        <td id="preview-posisi">-</td>
                                    </tr>
                                    <tr>
                                        <th class="fixed-width">Departemen</th>
                                        <td id="preview-departemen">-</td>
                                    </tr>
                                    <tr>
                                        <th class="fixed-width">Status Kepegawaian</th>
                                        <td id="preview-status-kepegawaian">-</td>
                                    </tr>
                                    <tr>
                                        <th class="fixed-width">Status</th>
                                        <td id="preview-status">-</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-4 text-center">
                                <!-- Preview Foto Profil -->
                                <img id="preview-foto" src="{{ asset('img/hi logo.png') }}" alt="Preview Foto"
                                    class="img-fluid rounded" style="max-height: 200px;">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    </div>


@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var changeProfileBtn = document.getElementById('change-profile-btn');
            var profileInput = document.getElementById('profile-input');
            var profileImage = document.getElementById('profile-image');

            // Ketika tombol "Ganti Profil" diklik
            changeProfileBtn.addEventListener('click', function() {
                profileInput.click(); // Memicu input file
            });

            // Ketika file dipilih
            profileInput.addEventListener('change', function() {
                var file = profileInput.files[0];
                if (file) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        profileImage.src = e.target.result; // Tampilkan gambar baru
                    };
                    reader.readAsDataURL(file);
                }
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            const btnPreview = document.getElementById('btn-preview');

            btnPreview.addEventListener('click', function() {
                // Ambil data dari form
                const tglJoin = document.getElementById('tgl-join').value || '-';
                const tglOut = document.getElementById('tgl-out').value || '-';
                const nama = document.getElementById('name').value || '-';
                const id = document.getElementById('id').value || '-';
                const posisi = document.querySelector('#position').value || '-';
                const departemen = document.querySelector('#department').value || '-';
                const statusKepegawaian = document.querySelector('#status-kepegawaian').value || '-';
                const status = document.getElementById('status').value || '-';
                const fotoSrc = document.getElementById('profile-image').src;

                // Isi data ke modal
                document.getElementById('preview-tgl-join').textContent = tglJoin;
                document.getElementById('preview-tgl-out').textContent = tglOut;
                document.getElementById('preview-nama').textContent = nama;
                document.getElementById('preview-id').textContent = id;
                document.getElementById('preview-posisi').textContent = posisi;
                document.getElementById('preview-departemen').textContent = departemen;
                document.getElementById('preview-status-kepegawaian').textContent = statusKepegawaian;
                document.getElementById('preview-status').textContent = status;
                document.getElementById('preview-foto').src = fotoSrc;
            });
        });
    </script>
