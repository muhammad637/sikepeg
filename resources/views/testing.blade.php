<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <style>
        .clock {
            text-align: center;
        }

        #time {
            font-size: 2em;
            font-family: 'Arial', sans-serif;
            color: #333;
        }
    </style>
</head>
{{-- //set timezone --}}
@php
    date_default_timezone_set('Asia/Jakarta');
@endphp


<body>

    <div class="container">


        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
            Launch static backdrop modal
        </button>

        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        ...
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Understood</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="clock" >
            <div id="time">{{date('H:i:s')}}</div>
        </div>
        {{-- 
        <body onload="setInterval('displayServerTime()', 1000);">
            Waktu Server :
            <strong><span id="clock"></span></strong> WIB
        </body> --}}
        <h1>hello</h1>
        <ul onload="">Departemen
            <li><button onclick="queue_dept('a')">testing
                    </button></li>
            <a href="" id="testing"></a>
        </ul>
        <div id="modal"></div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript">
        //buat object date berdasarkan waktu di server
        var serverTime = new Date({{ date('Y, m, d, H, i, s, 0') }});
        //buat object date berdasarkan waktu di client
        var clientTime = new Date();
        //hitung selisih
        var Diff = serverTime.getTime() - clientTime.getTime();
        //fungsi displayTime yang dipanggil di bodyOnLoad dieksekusi tiap 1000ms = 1detik
        function displayServerTime() {
            //buat object date berdasarkan waktu di client
            var clientTime = new Date();
            //buat object date dengan menghitung selisih waktu client dan server
            var time = new Date(clientTime.getTime() + Diff);
            //ambil nilai jam
            var sh = time.getHours().toString();
            //ambil nilai menit
            var sm = time.getMinutes().toString();
            //ambil nilai detik
            var ss = time.getSeconds().toString();
            // document.getElementById('testing').innerHTML = 'haha'
            //tampilkan jam:menit:detik dengan menambahkan angka 0 jika angkanya cuma satu digit (0-9)
            document.getElementById("clock").innerHTML = (sh.length == 1 ? "0" + sh : sh) + ":" + (sm.length == 1 ? "0" +
                sm : sm) + ":" + (ss.length == 1 ? "0" + ss : ss);
        }
        $(function() {
            $('#main').css({
                'min-height': $(window).height() - 134 + 'px'
            });
        });
        $(window).resize(function() {
            $('#main').css({
                'min-height': $(window).height() - 134 + 'px'
            });
        });

        function queue_dept(value) {
            // Membuat objek Date untuk waktu di client saat fungsi dipanggil
            var clientTime = new Date();
            // Membuat objek Date untuk waktu mulai antrian (12:10:00)
            const waktuMulai = new Date();
            waktuMulai.setHours(10, 50, 0);
            // Memeriksa apakah waktu di client sudah lewat waktu mulai
            if (clientTime > waktuMulai) {
                // Menghapus kelas "loaded" dari elemen 'body'
                // $('body').removeClass('loaded');
                // Membuat formulir HTML untuk mengirimkan data ke server
                var myForm2 =
                    '<form id="hidfrm2" action="/testing/apa" method="get">{{ csrf_field() }}<input type="hidden" name="department" value="' +
                    value + '"></form>';
                // Menambahkan formulir ke elemen 'body'
                $('body').append(myForm2);

                // Mengambil referensi ke formulir yang baru dibuat
                myForm2 = $('#hidfrm2');

                // Mengirimkan formulir ke server
                myForm2.submit();
            } else {
                var modal = `
                <div class='position-absolute top-50 w-75' >
                <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                            <h5 class="card-title">Error</h5>
                            <a href="/testing" class="btn-close"></a>
                        </div>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                </div>
                </div>
                </div>`
                // Menampilkan pesan peringatan jika waktu antrian belum tersedia
                $('#modal').html(modal)
                console.log(modal)
            }
        }
    </script>
    <script>
        function updateClock() {
            const timeElement = document.getElementById("time");
            const now = new Date();
            const hours = String(now.getHours()).padStart(2, "0");
            const minutes = String(now.getMinutes()).padStart(2, "0");
            const seconds = String(now.getSeconds()).padStart(2, "0");
            const timeString = `${hours}:${minutes}:${seconds}`;
            timeElement.textContent = timeString;
        }

        // // Pembaruan jam setiap detik
        setInterval(updateClock, 1000);

        // // Panggil updateClock untuk mengatur jam saat halaman dimuat
        // updateClock();
    </script>
    @include('sweetalert::alert')

</body>

</html>
