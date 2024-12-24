@extends('layouts.app')

@section('content')
    <style>
        .mainbar {
            display: flex;
            flex-direction: column;
            background-color: #D9D9D9;
            padding: 15px;
            font-family: 'Inter', sans-serif;
            width: calc(100% - 235px);
            height: calc(100vh - 75px);
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
            flex: 35%;
        }

        .right-container {
            flex: 45%;
        }


        .pemakaian2,
        .pemakaian {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }


        .pemakaian2 h2,
        .pemakaian h2 {
            font-size: 14px;
            color: #636362;
            text-align: center;
            margin-bottom: 20px;

        }

        .inline-group {
            display: flex;
            flex-direction: row;

        }

        .calendar-container {
            width: 100%;
            max-width: 600px;
            border-radius: 10px;
            font-size: 14px;
            background-color: white;

        }

        .calendar-header {
            text-align: center;
            font-size: 14px;
            margin-bottom: 10px;

        }

        .calendar-grid {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 7px;
        }

        .calendar-cell {
            width: 100%;
            padding: 5px;
            text-align: center;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 12px;
            background-color: #fff;
            position: relative;
            margin-top: 5px;
        }

        .calendar-cell.today {
            background-color: #ffeb99;

        }

        .calendar-cell.production-day {
            background-color: #dbe8f4;

        }

        .calendar-day-header {
            text-align: center;
            padding: 10px 0;
        }

        .note {
            text-align: center;
            margin-top: 20px;
            font-size: 12px;
            color: #555;
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
            flex: 0.1;
            margin: 0 2px;
            background-color: #3f51b5;
            border-radius: 4px 4px 0 0;
            display: flex;
            justify-content: center;
            align-items: flex-end;
            color: white;
            font-size: 8px;
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
            max-width: 220px;
            height: auto;
            margin: 0 auto;
        }

        .pemakaian h2 {
            font-size: 14px;
            color: #636362;
            margin-bottom: 10px;
            text-align: center;

        }

        .pemakaian2 {
            margin: 0;

        }

        #chartLabels div {
            display: flex;
            align-items: center;
            justify-content: space-between;
            /* Menjaga label dan angka di sisi berlawanan */
            margin-bottom: 7px;
            margin-left: 15px;
            padding: 5px 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }

        #chartLabels div div {
            margin-top: 5px;
            flex-shrink: 0;
            width: 20px;
            height: 20px;
            margin-right: 10px;
            /* Jarak antara kotak warna dan teks */
            border-radius: 3px;
            border: 1px solid #ccc;
        }

        #chartLabels span.label-text {
            flex: 1;
            text-align: left;
            font-size: 12px;
        }

        #chartLabels span.label-value {
            text-align: right;
            margin-left: 10px;
            font-size: 12px;
        }

        .pemakaian select {
            position: absolute;
            align-self: flex-start;
            top: 55px;
            left: 20px;
            z-index: 10;
            padding: 5px;
            width: 20%;
            font-size: 12px;
            color: #636362;
            padding: 8px 12px;
            height: 36px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 12px;
            box-shadow: 0px 1px 2px rgba(0, 0, 0, 0.2);
        }
    </style>

    <div class="mainbar">
        <div class="containera">
            <div class="header">
                <h2>Selamat Datang</h2>
            </div>
            <div class="content-container">

                <div class="left-container">
                    <div class="pemakaian2">
                        <div class="calendar-container">
                            <div class="calendar-header" id="calendar-month">August 2024</div>
                            <div class="calendar-grid" id="calendar">
                            </div>
                            <div class="note">* Biru: Jadwal Produksi | Kuning: Hari Ini</div>
                        </div>

                    </div>
                </div>

                <div class="right-container">
                    <div class="right-container">
                        <div class="pemakaian">
                            <div style="text-align: center;">
                                <h2>Laporan Pemakaian Kelapa Bulat</h2>
                                <select style="margin-bottom: 20px; width:25%;">
                                    <option>Pilih Tanggal</option>

                                </select>

                                <div style="display: flex; justify-content: center; align-items: center; margin-top: 20px;">
                                    <!-- Chart Container -->
                                    <div style="max-width: 200px; margin-right: 20px;">
                                        <canvas id="myChart"
                                            style="max-width: 200px; margin: 0 auto; margin-top:70px; margin-bottom:10px;"></canvas>
                                    </div>

                                    <div id="chartLabels" style="font-size: 12px; max-width: 250px;"></div>
                                </div>
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
            document.addEventListener("DOMContentLoaded", function() {
                const pieData = {
                    labels: ["Daging Kelapa Putih", "Air Kelapa", "Kulit Ari Basah", "Tempurung Kelapa", "Missing"],
                    datasets: [{
                        data: [
                            {{ $dagingKelapaPutihPercentage }},
                            {{ $airKelapaPercentage }},
                            {{ $kulitAriBasahPercentage }},
                            {{ $tempurungKelapaPercentage }},
                            {{ $missingPercentage }}
                        ], // Data persentase dari controller
                        backgroundColor: ["#c6e2ff", "#779ecb", "#bcbcbc", "#b3cde3", "#d3d3d3"], // Warna
                        borderWidth: 0, // Hilangkan border antar data
                    }],
                };

                const centerTextPlugin = {
                    id: "centerText",
                    beforeDraw(chart) {
                        const { width, height } = chart;
                        const ctx = chart.ctx;
                        ctx.restore();

                        const total = chart.data.datasets[0].data.reduce((a, b) => a + b, 0); // Total nilai
                        const fontSize = (height / 100).toFixed(2); // Ukuran font
                        ctx.font = `${fontSize}em sans-serif`;
                        ctx.fillStyle = "#636362"; // Warna teks tengah
                        ctx.textBaseline = "middle";

                        const textX = Math.round((width - ctx.measureText(total).width) / 2);
                        const textY = height / 2;
                        ctx.fillText(total.toFixed(0), textX, textY); // Total dalam bentuk integer
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
                    { color: "#c6e2ff", text: "Daging Kelapa Putih", value: "{{ $dagingKelapaPutihPercentage }}%" },
                    { color: "#779ecb", text: "Air Kelapa", value: "{{ $airKelapaPercentage }}%" },
                    { color: "#bcbcbc", text: "Kulit Ari Basah", value: "{{ $kulitAriBasahPercentage }}%" },
                    { color: "#b3cde3", text: "Tempurung Kelapa", value: "{{ $tempurungKelapaPercentage }}%" },
                    { color: "#d3d3d3", text: "Missing", value: "{{ $missingPercentage }}%" },
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

            let productionDays = JSON.parse(localStorage.getItem("productionDays")) || ["2024-08-10", "2024-08-15",
                "2024-08-20", "2024-08-25"
            ];

            // Fungsi untuk menyimpan jadwal produksi ke localStorage
            function saveProductionDays() {
                localStorage.setItem("productionDays", JSON.stringify(productionDays));
            }

            // Fungsi untuk generate kalender
            function generateCalendar() {
                const calendar = document.getElementById("calendar");
                const today = new Date();
                const currentYear = today.getFullYear();
                const currentMonth = today.getMonth(); // 0-based index
                const firstDayOfMonth = new Date(currentYear, currentMonth, 1).getDay(); // Hari pertama bulan
                const daysInMonth = new Date(currentYear, currentMonth + 1, 0).getDate(); // Jumlah hari dalam bulan
                const calendarMonth = document.getElementById("calendar-month");

                // Set header bulan
                const monthNames = [
                    "January", "February", "March", "April", "May", "June", "July",
                    "August", "September", "October", "November", "December"
                ];
                calendarMonth.textContent = `${monthNames[currentMonth]} ${currentYear}`;

                // Kosongkan kalender
                calendar.innerHTML = "";

                // Tambahkan header hari
                const dayHeaders = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];
                dayHeaders.forEach(day => {
                    const headerCell = document.createElement("div");
                    headerCell.textContent = day;
                    headerCell.classList.add("calendar-day-header");
                    calendar.appendChild(headerCell);
                });

                // Fungsi untuk menambah/menghapus jadwal produksi
                function toggleProductionDay(date, cell) {
                    if (productionDays.includes(date)) {
                        // Jika sudah ada, hapus dari array
                        productionDays = productionDays.filter(d => d !== date);
                        cell.classList.remove("production-day");
                    } else {
                        // Jika belum ada, tambahkan ke array
                        productionDays.push(date);
                        cell.classList.add("production-day");
                    }
                    saveProductionDays(); // Simpan ke localStorage
                    console.log("Jadwal Produksi Saat Ini:", productionDays);
                }

                // Isi awal kosong jika hari pertama bukan Minggu
                for (let i = 0; i < firstDayOfMonth; i++) {
                    const emptyCell = document.createElement("div");
                    calendar.appendChild(emptyCell);
                }

                // Isi hari dalam bulan
                for (let day = 1; day <= daysInMonth; day++) {
                    const cell = document.createElement("div");
                    cell.textContent = day;
                    cell.classList.add("calendar-cell");

                    // Format tanggal untuk perbandingan
                    const formattedDate =
                        `${currentYear}-${String(currentMonth + 1).padStart(2, "0")}-${String(day).padStart(2, "0")}`;

                    // Tandai hari ini
                    if (formattedDate === today.toISOString().split("T")[0]) {
                        cell.classList.add("today");
                    }

                    // Tandai jadwal produksi
                    if (productionDays.includes(formattedDate)) {
                        cell.classList.add("production-day");
                    }

                    // Tambahkan event listener untuk klik
                    cell.addEventListener("click", () => toggleProductionDay(formattedDate, cell));

                    calendar.appendChild(cell);
                }
            }

            window.onload = generateCalendar;
        </script>
    @endsection
