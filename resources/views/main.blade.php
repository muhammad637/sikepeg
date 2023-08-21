<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>DASHMIN - Bootstrap Admin Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('sikep-tampilan/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('sikep-tampilan/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css') }}"
        rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('sikep-tampilan/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('sikep-tampilan/css/style.css') }}" rel="stylesheet">

    <!-- data table style -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <!-- data table style  END-->
</head>

<body>
    <div class="container-xxl position-relative bg-white d-flex p-0">
        <!-- Spinner Start -->
        {{-- <div id="spinner"
            class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div> --}}
        <!-- Spinner End -->

        <!-- Sidebar Start -->
        <div class="sidebar pe-5 pb-3 bg-white">
            <nav class="navbar bg-white navbar-ligh">
                <a href="index.html" class="navbar-brand mx-4 mb-3">
                    <h3 style="color: #2c7d71fa;"><img src="../sikep-tampilan/img/rsud-logo.png" alt=""> SiKep
                        RSBL</h3>
                </a>
                <div class="navbar-nav w-100">
                    <a href="index.html" breadcrumb class="nav-item nav-link active"><i
                            class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i
                                class="fa fa-address-book me-2"></i>Personal File</a>
                        <div class="dropdown-menu border border-white">
                            <a href="personalfile-table.html" class="nav-item nav-link"><i
                                    class="bi bi-file-person-fill"></i> personalFile Tabel</a>
                            <span class="text-secondary fw fw-bolder">Form Personal File</span>
                            <a href="personalFile-struktural.html" class="nav-item nav-link"><i
                                    class="bi bi-file-earmark-bar-graph-fill"></i> Struktural</a>
                            <a href="personalFile-NAKES.html" class="nav-item nav-link"><i
                                    class="bi bi-shield-fill-plus"></i> Nakes</a>
                            <a href="personalFile-Umum.html" class="nav-item nav-link"><i
                                    class="bi bi-briefcase-fill"></i> PNS
                                Umum</a>
                            <a href="personalFILE-non-PNS.html" class="nav-item nav-link"><i
                                    class="fa fa-th me-2"></i>Non PNS</a>
                        </div>
                    </div>
                    <a href="#" class="nav-item nav-link"><i class="bi bi-star-fill"></i> Kenaikan Pangkat</a>
                    <a href="./mutasi.html" class="nav-item nav-link"><i class="bi bi-file-earmark-post"></i> Mutasi</a>
                    <a href="cuti-pegawai.html" class="nav-item nav-link"><i class="bi bi-eyeglasses"></i> Cuti</a>
                    <a href="diklat-pegawai.html" class="nav-item nav-link"><i class="bi bi-bookmark-star-fill"></i>
                        Diklat
                        Pegawai</a>
                    <a href="str-sip.html" class="nav-item nav-link"><i class="bi bi-mailbox2"></i> STR / SIP yang
                        mati</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i
                                class="fa fa-laptop me-2"></i>Elements</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="button.html" class="dropdown-item">Buttons</a>
                            <a href="typography.html" class="dropdown-item">Typography</a>
                            <a href="element.html" class="dropdown-item">Other Elements</a>
                        </div>
                    </div>
                    <a href="widget.html" class="nav-item nav-link"><i class="fa fa-th me-2"></i>Widgets</a>
                    <a href="form.html" class="nav-item nav-link"><i class="fa fa-keyboard me-2"></i>Forms</a>
                    <a href="table.html" class="nav-item nav-link"><i class="fa fa-table me-2"></i>Tables</a>
                    <a href="chart.html" class="nav-item nav-link"><i class="fa fa-chart-bar me-2"></i>Charts</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i
                                class="far fa-file-alt me-2"></i>Pages</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="signin.html" class="dropdown-item">Sign In</a>
                            <a href="signup.html" class="dropdown-item">Sign Up</a>
                            <a href="404.html" class="dropdown-item">404 Error</a>
                            <a href="blank.html" class="dropdown-item">Blank Page</a>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
        <!-- Sidebar End -->
        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <nav class="navbar navbar-expand bg-white navbar-light sticky-top  py-0 border-bottom shadow-sm">
                <a href="index.html" class="navbar-brand d-flex d-lg-none me-4">
                    <h2 class="text-primary mb-0"><i class="fa fa-hashtag"></i></h2>
                </a>
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars" style="color: #009581fa;"></i>
                </a>
                <form class="d-none d-md-flex ms-4">
                    <input class="form-control border-0" type="search" placeholder="Search">
                </form>
                <div class="navbar-nav align-items-center ms-auto">
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="fa fa-bell me-lg-2"></i>
                            <span class="d-none d-lg-inline-flex">Notificatin</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                            <a href="#" class="dropdown-item">
                                <h6 class="fw-normal mb-0">Profile updated</h6>
                                <small>15 minutes ago</small>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <h6 class="fw-normal mb-0">New user added</h6>
                                <small>15 minutes ago</small>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <h6 class="fw-normal mb-0">Password changed</h6>
                                <small>15 minutes ago</small>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item text-center">See all notifications</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <img class="rounded-circle me-lg-2" src="img/user.jpg" alt=""
                                style="width: 40px; height: 40px;">
                            <span class="d-none d-lg-inline-flex">John Doe</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                            <a href="profile.html" class="dropdown-item">My Profile</a>
                            <a href="#" class="dropdown-item">Settings</a>
                            <a href="signin.html" class="dropdown-item">Log Out</a>
                        </div>
                    </div>
                </div>
            </nav>
            <!-- Navbar End -->
            <!-- BREADCRUMB -->
            <nav class=" bg-white mt-4 mx-4 px-4 rounded" style="--bs-breadcrumb-divider: '|'; "
                aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page"><a href="#">Dashboard</a></li>
                </ol>
            </nav>
            <!-- BREADCRUMB END -->
            <!-- Dashboard Konten Start -->
            <!-- hero section -->
            <div class="container-fluid pt-4 px-4">
                <div class="col-sm-12 col-xl-12">
                    <div class="bg-white rounded h-100 p-4">
                        <h6 class="mb-4">Quotes</h6>
                        <div class="owl-carousel testimonial-carousel">
                            <div class="testimonial-item text-center">
                                <img class="img-fluid rounded-circle mx-auto mb-4" src="img/testimonial-1.jpg"
                                    style="width: 100px; height: 100px;">
                                <h5 class="mb-1">Janne Woe</h5>
                                <p>Pensiun Kepala Direktur</p>
                                <p class="mb-0">Uang dikejar bukan untuk tujuan, tapi uang di kejar untuk sebuah
                                    awalan.
                                </p>
                            </div>
                            <div class="testimonial-item text-center">
                                <img class="img-fluid rounded-circle mx-auto mb-4" src="img/testimonial-2.jpg"
                                    style="width: 100px; height: 100px;">
                                <h5 class="mb-1">John Doe</h5>
                                <p>Pensiun Kepala Adminidstrasi</p>
                                <p class="mb-0">Bukan Uang, yang berharga. tapi apa yang dapat dibeli dengan uanglah
                                    yang lebih Berharga. </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- hero section end -->
            <!-- tabel -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-white text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">STR</h6>
                    </div>
                    <div class="table-responsive">
                        <table id="myTable"
                            class="table table-striped table-hover text-start align-middle table-bordered mb-0">
                            <thead>
                                <tr class="text-dark">
                                    <th scope="col"></th>
                                    <th scope="col">NIP</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Jenis Kelamin</th>
                                    <th scope="col">Ruangan</th>
                                    <th scope="col">No STR</th>
                                    <th scope="col">Masa Berlaku</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td></td>
                                    <td>198610232017010027</td>
                                    <td>John Doe</td>
                                    <td>Laki-laki</td>
                                    <td>Kepegawaian</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>198610232017010027</td>
                                    <td>Janne woe</td>
                                    <td>Perempuan</td>
                                    <td>Kepegawaian</td>
                                    <td></td>
                                    <td></td>
                                </tr>

                                <tr>
                                    <td></td>
                                    <td>198610232017010027</td>
                                    <td>Wu Kong</td>
                                    <td>Laki-laki</td>
                                    <td>Kepegawaian</td>
                                    <td></td>
                                    <td></td>
                                </tr>

                                <tr>
                                    <td></td>
                                    <td>198610232017010027</td>
                                    <td>Tong sang chong</td>
                                    <td>Laki-laki</td>
                                    <td>Kepegawaian</td>
                                    <td></td>
                                    <td></td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- tabel End -->

            <!-- Cari Pegawai -->
            <div class="container-fluid px-4 pt-4 rounded-2">
                <div class="row">
                    <div class="col-sm-12 col-xl-8 mx-auto">
                        <div id="plc" class="mb-2 bg-white px-4 p-4 rounded text-center">
                            <h4 for="exampleInputEmail1" class="form-label"> Cari Pegawai - RSUD Blambangan</h4>
                            <span>Isi form dibawah ini, untuk mencari pegawai RSUD Blambangan lebih mudah</span>
                            <input type="email" class="form-control my-2" id="exampleInputEmail1"
                                placeholder="Nama Pegawai" aria-describedby="emailHelp">
                            <input type="email" class="form-control my-2" id="exampleInputEmail1"
                                placeholder="NIP" aria-describedby="emailHelp">
                            <input type="email" class="form-control my-2" id="exampleInputEmail1"
                                placeholder="Ruangan" aria-describedby="emailHelp">
                            <input type="email" class="form-control my-2" id="exampleInputEmail1"
                                placeholder="Status Tenaga" aria-describedby="emailHelp">
                            <button type="button" class="btn text-white py-0 px-1"
                                style="background-color: #009581fa;"><i class="fa fa-search pe-1"
                                    aria-hidden="true"></i>Cari </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Cari Pegawai End -->

            <!-- Footer Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="rounded-top p-4 text-white text-center"
                    style="background-color: #009581fa; font-size: small;">
                    <div class="row mb-2">
                        <div class="col-2">
                            Hubungi Kami
                        </div>
                        <div class="col-2">
                            085231977779
                        </div>
                        <div class="col-2">
                            <a href="" class="text-light fw-bold text-decoration-none">
                                <i class="bi bi-instagram"></i>
                                Ig RSUD Blambangan
                            </a>
                        </div>
                        <div class="col-2">
                            <a href="" class="text-light fw-bold text-decoration-none">
                                <i class="bi bi-facebook"></i>
                                Fb RSUD Blambangan
                            </a>
                        </div>
                        <div class="col-2">
                            contact center
                        </div>
                        <div class="col-2">
                            contact center
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3">
                            Tentang
                        </div>
                        <div class="col-3">
                            FAQS
                        </div>
                        <div class="col-3">
                            Syarat & Ketentuan
                        </div>
                        <div class="col-3">
                            Kebijakan Privasi
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col">
                            &copy; <a href="#" class="text-light fw-bolder">RSUD Blambangan</a>, Copyright 2023.
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer End -->
        </div>
        <!-- Content End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- Java script -->
    <script>
        $(document).ready(function() {
            $('#my-Table').DataTable();
        });
    </script>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('./sikep-tampilan/lib/chart/chart.min.js') }}"></script>
    <script src="{{ asset('./sikep-tampilan/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('./sikep-tampilan/lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('./sikep-tampilan/lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('./sikep-tampilan/lib/tempusdominus/js/moment.min.js') }}"></script>
    <script src="{{ asset('./sikep-tampilan/lib/tempusdominus/js/moment-timezone.min.js') }}"></script>
    <script src="{{ asset('./sikep-tampilan/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js') }}"></script>

    <!-- Template Javascript -->
    <script src="{{asset('./sikep-tampilan/js/main.js')}}"></script>

    <!-- Data tables -->
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

    <script>
        new DataTable('#myTable');
    </script>
    <!-- Data tables END -->
</body>

</html>
