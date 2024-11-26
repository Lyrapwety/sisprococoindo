@extends('layouts.app')

@section('content')

<style>

.mainbar {
    display: flex;
    flex-direction: column;
    background-color: #D9D9D9;
    padding: 20px 10px;
    font-family: 'Inter', sans-serif;
    width: calc(100% - 235px);
    margin-left: 235px;
}

.containera {
    margin: auto;
    background-color: #F7F7F7;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    border-radius: 15px;
    width: 95%;
    padding: 20px;
}

.header {
    margin-bottom: 20px;
    padding: 10px;
    padding-bottom: 0;
   
}

.header h2 {
    font-size: 14px;
  
}

.content-container {
    display: flex;
    gap: 20px;
}

.left-container,
.right-container {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.left-container {
    flex: 60%;
}

.right-container {
    flex: 35%;
}

.data-pegawai,
.calendar,
.pemakaian2,
.pemakaian {
    background-color: white;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

.data-pegawai {
    margin-top: 10px;
    margin-left: 0 !important;
    margin: 10px auto; /* Pusatkan komponen */
    width: 45%; /* Lebar proporsional */
    height: 85%;
    background-color: white; /* Latar belakang */
    padding: 20px; /* Ruang dalam */
    border-radius: 8px; /* Sudut membulat */
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1); /* Bayangan */
    font-size: 12px; /* Ukuran teks */
}

.data-pegawai h2,
.calendar h2,
.pemakaian2 h2,
.pemakaian h2 {
    font-size: 14px;
    color: #636362;
    text-align: center;
    margin-bottom: 20px;
     
}

.data-pegawai p {
    display: flex;
    justify-content: space-between;
    font-size: 12px;
    margin: 5px 0;
    line-height: 25px;
}

.calendar {
    display: flex;
    flex-direction: column;
    align-items: center;
    margin-top: 10px;
    height: 85%;
}

.calendar .day {
    display: inline-block;
    width: 20px;
    height: 20px;
    font-size: 10px;
    line-height: 20px;
    text-align: center;
    margin: 2px;
    border-radius: 50%;
    background-color: #f0f0f0;
    color: #333;
}

.calendar .day.today {
    background-color: #4c7caf;
    color: white;
    font-weight: bold;
}

.inline-group{
    display: flex;
    flex-direction: row;
   
  
}
.bar-chart {
    display: flex;
    align-items: flex-end;
    height: 150px;
    border-left: 2px solid #ddd;
    border-bottom: 2px solid #ddd;
    padding: 10px 5px 0 5px;
}

.bar-chart .bar {
    flex: 0.1; /* Lebar bar lebih kecil */
    margin: 0 2px; /* Jarak antar bar lebih kecil */
    background-color: #3f51b5;
    border-radius: 4px 4px 0 0;
    display: flex;
    justify-content: center;
    align-items: flex-end;
    color: white;
    font-size: 8px; /* Ukuran teks di dalam bar */
}


.bar-chart .bar:nth-child(even) {
    background-color: #7986cb;
}

.x-axis {
    display: flex;
    justify-content: space-between;
    margin-top: 10px;
    font-size: 10px;
    color: #666;
}

.pemakaian {
    display: flex;
    position: relative; 
    padding-top: 20px;
    flex-direction: column;
    align-items: center;
    height: 100%;
}

.pemakaian canvas {
    max-width: 220px; /* Ukuran pie chart */
    height: auto;
    margin: 0 auto;
}

.pemakaian h2{
    font-size: 14px;
    color: #636362;
    margin-bottom: 10px;
    text-align: center;
    
}
.pemakaian2 {
    margin:0;
    
}
<style>
    #chartLabels div {
 
}
#chartLabels div {
    display: flex;
    align-items: center;
    justify-content: space-between; /* Memisahkan label dan angka */
    margin-bottom: 8px;
    padding: 5px 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1); /* Opsional: tambahkan bayangan */
    background-color: #fff; /* Latar belakang putih */
}

#chartLabels div div {
    width: 20px;
    height: 20px;
    margin-right: 10px; /* Jarak antara kotak warna dan teks */
    border: 1px solid #ccc;
    border-radius: 3px;
}

#chartLabels span.label-text {
    flex: 1; /* Label memenuhi ruang di sebelah kiri */
    text-align: left; /* Teks label rata kiri */
}

#chartLabels span.label-value {
    text-align: right; /* Angka rata kanan */
    margin-left: 10px; /* Jarak kecil antara label dan angka */
}

.pemakaian select {
    position: absolute;
    align-self: flex-end; 
    top: 55px; /* Jarak dari atas */
    right: 20px;
    z-index: 10; /* Pastikan di atas elemen lainnya */
    padding: 5px;
    width: 35%;
    font-size: 12px;
    color: #636362;
    padding: 8px 12px; /* Padding yang sama */
    height: 36px; /* Tinggi yang sama */
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 12px;
    box-shadow: 0px 1px 2px rgba(0, 0, 0, 0.2);
}
</style>

</style>

<div class="mainbar">
    <div class="containera">
        <!-- Header -->
        <div class="header">
            <h2>Selamat Datang, Cella</h2>
        </div>
        <!-- Main Content -->
        <div class="content-container">
            <!-- Kontainer Kiri -->
            <div class="left-container">
                <!-- Data Pegawai -->
                <div class="inline-group">
                <div class="data-pegawai">
                    <h2>Data Pegawai</h2>
                    <p>Produksi <span>: 30</span> <span>AKTIF</span></p>
                    <p>Kupas <span>: 25</span> <span>AKTIF</span></p>
                    <p>Gudang <span>: 14</span> <span>AKTIF</span></p>
                    <p>Limbah <span>: 25</span> <span>AKTIF</span></p>
                </div>

                <!-- Kalender -->
                <div class="calendar">
                    <h2 id="month-year">Januari</h2>
                    <div id="calendar-days"></div>
                </div>
                </div>

                <!-- Laporan Produksi -->
                <div class="pemakaian2">
                    <h2>Laporan Produksi Daging Kelapa Putih</h2>
                    <div class="dropdown-container">
                        <select class="dropdown">
                            <option>Pilih Tanggal</option>
                            <option>Januari</option>
                            <option>Februari</option>
                        </select>
                    </div>

                    <div class="bar-chart">
                        <div class="bar" style="height: 40%;"><span>10</span></div>
                        <div class="bar" style="height: 80%;"><span>20</span></div>
                        <div class="bar" style="height: 60%;"><span>15</span></div>
                        <div class="bar" style="height: 100%;"><span>25</span></div>
                        <div class="bar" style="height: 70%;"><span>18</span></div>
                        <div class="bar" style="height: 50%;"><span>12</span></div>
                        <div class="bar" style="height: 40%;"><span>10</span></div>
                        <div class="bar" style="height: 80%;"><span>20</span></div>
                        <div class="bar" style="height: 60%;"><span>15</span></div>
                        <div class="bar" style="height: 100%;"><span>25</span></div>
                        <div class="bar" style="height: 70%;"><span>18</span></div>
                        <div class="bar" style="height: 50%;"><span>12</span></div>
                    </div>

                    <div class="x-axis">
                        <span>Jan</span>
                        <span>Feb</span>
                        <span>Mar</span>
                        <span>Apr</span>
                        <span>Mei</span>
                        <span>Jun</span>
                        <span>Jul</span>
                        <span>Agu</span>
                        <span>Sep</span>
                        <span>Okt</span>
                        <span>Nov</span>
                        <span>Des</span>
                    </div>
                </div>
            </div>

            <!-- Kontainer Kanan -->
            <div class="right-container">
                <div class="pemakaian">
                <div style="text-align: center;">
                    <h2>Laporan Pemakaian Kelapa Bulat</h2>
                
                        <select style="margin-bottom: 20px;">
                            <option>Pilih Tanggal</option>
                            <!-- Tambahkan opsi tanggal jika diperlukan -->
                        </select>
                  
                    <canvas id="myChart" style="max-width: 200px; margin: 0 auto; margin-top:70px; margin-bottom:10px;"></canvas>
                    <div id="chartLabels" style="margin-top: 20px; max-width: 200px; font-size:12px;"></div>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>
@endsection


@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const pieData = {
            labels: ["Daging Kelapa Putih", "Air Kelapa", "Kulit Ari Basah", "Tempurung Kelapa", "Missing"],
            datasets: [
                {
                    data: [35, 20, 15, 20, 10], // Data nilai
                    backgroundColor: ["#c6e2ff", "#779ecb", "#bcbcbc", "#b3cde3", "#d3d3d3"], // Warna
                    borderWidth: 0, // Hilangkan border antar data
                },
            ],
        };

        // Plugin untuk menampilkan total di tengah
        const centerTextPlugin = {
            id: "centerText",
            beforeDraw(chart) {
                const { width } = chart;
                const { height } = chart;
                const ctx = chart.ctx;
                ctx.restore();

                const total = chart.data.datasets[0].data.reduce((a, b) => a + b, 0); // Total nilai
                const fontSize = (height / 100).toFixed(2); // Ukuran font
                ctx.font = `${fontSize}em sans-serif`;
                ctx.fillStyle = "#636362"; // Warna teks tengah
                ctx.textBaseline = "middle";

                const textX = Math.round((width - ctx.measureText(total).width) / 2);
                const textY = height / 2;
                ctx.fillText(total, textX, textY);
                ctx.save();
            },
        };

        // Konfigurasi chart
        const pieConfig = {
            type: "doughnut",
            data: pieData,
            options: {
                responsive: true,
                cutout: "40%", // Ukuran lubang tengah
                plugins: {
                    legend: {
                        display: false, // Hilangkan legend default
                    },
                },
            },
            plugins: [centerTextPlugin],
        };

        // Render Chart
        const ctx = document.getElementById("myChart").getContext("2d");
        new Chart(ctx, pieConfig);

        // Tambahkan label di bawah chart
        const labels = [
            { color: "#c6e2ff", text: "Daging Kelapa Putih", value: 35 },
            { color: "#779ecb", text: "Air Kelapa", value: 20 },
            { color: "#bcbcbc", text: "Kulit Ari Basah", value: 15 },
            { color: "#b3cde3", text: "Tempurung Kelapa", value: 20 },
            { color: "#d3d3d3", text: "Missing", value: 10 },
        ];

        const labelContainer = document.getElementById("chartLabels");
        labels.forEach((label) => {
    const div = document.createElement("div");

    const colorBox = document.createElement("div");
    colorBox.style.backgroundColor = label.color;

    const labelText = document.createElement("span");
    labelText.className = "label-text";
    labelText.textContent = label.text;

    const labelValue = document.createElement("span");
    labelValue.className = "label-value";
    labelValue.textContent = label.value;

    div.appendChild(colorBox);
    div.appendChild(labelText);
    div.appendChild(labelValue);
    labelContainer.appendChild(div);
});
    });


function buatKalender() {
    const hariIni = new Date();
    const tanggalHariIni = hariIni.getDate();
    const namaBulan = hariIni.toLocaleDateString("id-ID", { month: "long", year: "numeric" });

    // Set bulan dan tahun di header kalender
    document.getElementById("month-year").textContent = namaBulan;

    // Tanggal-tanggal dalam bulan
    const kalenderRows = [
        [1, 2, 3, 4, 5, 6, 7],
        [8, 9, 10, 11, 12, 13, 14],
        [15, 16, 17, 18, 19, 20, 21  ],
        [22, 23, 24, 25, 26, 27, 28],
        [29, 30, 31]
    
    ];

    const kalenderContainer = document.getElementById("calendar-days");
    kalenderContainer.innerHTML = ""; // Bersihkan isi sebelumnya

    // Loop setiap baris tanggal
    kalenderRows.forEach(row => {
        const baris = document.createElement("p");
        row.forEach(tanggal => {
            const hari = document.createElement("span");
            hari.classList.add("day");
            hari.textContent = tanggal;

            // Tandai hari ini
            if (tanggal === tanggalHariIni) {
                hari.classList.add("today");
            }

            baris.appendChild(hari);
        });
        kalenderContainer.appendChild(baris);
    });
}

// Jalankan fungsi saat halaman dimuat
document.addEventListener("DOMContentLoaded", buatKalender);
</script>
@endsection  