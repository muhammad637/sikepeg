@extends('main')

@section('content')
    <h1 class="" style="color:black;font-weight:bold;">SIP</h1>
    <div class="card p-4 mx-5 mb-5">
        <h2 class="m-0 font-weight-bold text-dark">Detail SIP</h2>
        <hr>
        <div class="row g-4">
            <div class="col-sm-12 col-xl-6 ">
                <div class="h-100 p-4">
                    <form>
                        <div class="row mb-3">
                            <label for="inputEmail3" class="col-sm-4 col-form-label">No SIP</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" id="inputEmail3">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputEmail3" class="col-sm-4 col-form-label">Nama</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" id="inputEmail3">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputEmail3" class="col-sm-4 col-form-label">Tempat / Tanggal
                                Lahir</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" id="inputEmail3">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputEmail3" class="col-sm-4 col-form-label">Alamat</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" id="inputEmail3">
                            </div>
                        </div>                        
                    </form>
                </div>
            </div>
            <!-- BIODATA END -->
            <!-- PANGKAT DAN GOLONGAN -->
            <div class="col-sm-12 col-xl-6">
                <div class="h-100 p-4">
                    <form>
                        <div class="row mb-3">
                            <label for="inputEmail3" class="col-sm-4 col-form-label">No STR</label>
                            <div class="col-sm-8">
                                <input type="email" class="form-control" id="inputEmail3">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputEmail3" class="col-sm-4 col-form-label">No Rekomndasi SIP</label>
                            <div class="col-sm-8">
                                <input type="email" class="form-control" id="inputEmail3">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputEmail3" class="col-sm-4 col-form-label">Tanggal
                                Terbit</label>
                            <div class="col-sm-8">
                                <input type="email" class="form-control" id="inputEmail3">
                            </div>
                        </div>                        
                        <div class="row mb-3">
                            <label for="inputEmail3" class="col-sm-4 col-form-label">Masa
                                Berlaku</label>
                            <div class="col-sm-8">
                                <input type="email" class="form-control" id="inputEmail3">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- PANGKAT DAN GOLONGAN END -->
        </div>  
        <div class="text-right">
            <a type="submit" class="btn btn-warning" href="str-history.html"><i class="fas fa-history"></i>
                Lihat History STR</a>
        </div>
    </div>
@endsection
