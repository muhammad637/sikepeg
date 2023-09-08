@extends('main')

@section('content')
    <h1 class="" style="color:626262;font-weight:bold;margin:2rem 0 2rem;">Dashboard / Reminder SIP</h1>
    <!-- Page Heading -->
    <!-- data table -->
    <div class="card shadow-sm mb-1">        
        <div class="card-body">
            <div class="table-responsive">
                <table id="dataTable" class="table table-bordered table-hover text-center text capitalize w-100">
                    <thead style="background-color: #2d7430; color: white;">
                        <tr>
                            <th>no</th>
                            <th>nama</th>
                            <th>Masa Berakhir STR</th>
                            <th>aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>roni subakti</td>
                            <td>29 juli</td>
                            <td>
                                <a href="" class="btn btn transparent">
                                    <i class="fab fa-whatsapp fa-2x text-success"></i>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>roni subakti</td>
                            <td>29 juli</td>
                            <td>
                                <a href="" class="btn btn transparent">
                                    <i class="fab fa-whatsapp fa-2x text-success"></i>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>roni subakti</td>
                            <td>29 juli</td>
                            <td>
                                <a href="" class="btn btn transparent">
                                    <i class="fab fa-whatsapp fa-2x text-success"></i>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>roni subakti</td>
                            <td>29 juli</td>
                            <td>
                                <a href="" class="btn btn transparent">
                                    <i class="fab fa-whatsapp fa-2x text-success"></i>
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="text-right mt-4">
                    <a href="" class="btn btn-warning px-5">kembali</a>
                </div>
            </div>
        </div>
    </div>
    <!-- end data table -->
@endsection
