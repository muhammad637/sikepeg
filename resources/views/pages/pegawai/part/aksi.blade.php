<div class="d-flex justify-content-center">
    <div class= 'btn-group mt-sm-0 mr-1'>
        <button type='button' class='btn btn-info dropdown-toggle border-0 text-white' data-toggle='dropdown'
            aria-haspopup='true' aria-expanded='false'>
            <i class='fas fa-info-circle'></i>
        </button>
        <div class='dropdown-menu'>
            <a class='dropdown-item' href={{ route('admin.cuti.histori-cuti.index', [$model->id]) }}
                target='_blank'>History Cuti</a>
            @if ($model->mutasi->count() > 0)
                <a class='dropdown-item' href="{{ route('admin.mutasi.history', [$model->id]) }}"
                    target='_blank'>History Mutasi</a>
            @else
                <a class='dropdown-item' href="#diklat-{{$model->id}}" data-toggle="modal">History Mutasi</a>
            @endif
            @if ($model->diklat->count() > 0)
                <a class='dropdown-item' href="{{ route('admin.diklat.riwayat', [$model->id]) }}"
                    target='_blank'>History Diklat</a>
            @else
                <a class='dropdown-item' href="#diklat-{{$model->id}}" data-toggle="modal">History Diklat</a>
            @endif
            @if ($model->kenaikanpangkat->count() > 0)
                <a class='dropdown-item' href="{{ route('admin.kenaikan-pangkat.riwayat', [$model->id]) }}"
                    target='_blank'>History Kenaikan Pangkat</a>
            @else
                <a class='dropdown-item' href="#kenaikanPangkat-{{$model->id}}" data-toggle="modal">History Kenaikan Pangkat</a>
            @endif
            <a class='dropdown-item' href="{{ route('admin.pegawai.show', [$model->id]) }}" target='_blank'>Personal
                File</a>
        </div>
    </div>
    <a href="{{ route('admin.pegawai.edit', ['pegawai' => $model->id]) }}" class='btn btn-warning text-white  mr-1'><i
            class='fas fa-pen'></i></a>
</div>
    <!-- Button trigger modal -->
    {{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
        Launch demo modal
    </button> --}}

    <!-- mutasi -->
    <div class="modal fade" id="mutasi-{{$model->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Peringatan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Data Pegawai {{$model->nama_lengkap}} tidak memiliki riwayat Mutasi
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                </div>
            </div>
        </div>
    </div>
    {{-- diklat --}}
    <div class="modal fade" id="diklat-{{$model->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Peringatan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Data Pegawai {{$model->nama_lengkap}} tidak memiliki riwayat Diklat
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                </div>
            </div>
        </div>
    </div>
    {{-- kenaikan pangkat --}}
    <div class="modal fade" id="kenaikanPangkat-{{$model->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Peringatan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Data Pegawai {{$model->nama_lengkap}} tidak memiliki riwayat kenaikan pangkat
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                </div>
            </div>
        </div>
    </div>
