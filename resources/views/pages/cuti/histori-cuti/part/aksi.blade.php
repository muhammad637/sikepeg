<div class="d-flex justify-content-center">
    {{-- <div class="btn-group  mr-1">
        <button type="button" class="btn btn-info dropdown-toggle " data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false">
            <i class="fas fa-info-circle"></i>
        </button>
        <div class="dropdown-menu">
            <a class="dropdown-item text-info font-weight-bold"
                href="{{ route('admin.cuti.show', ['cuti' => $model->id]) }}" target="_blank"><i
                    class="far fa-envelope-open"></i> Detail Cuti</a>
            <a class="dropdown-item text-info font-weight-bold"
                href="{{ route('admin.cuti.riwayat-cuti-pegawai', ['id' => $model->pegawai->id]) }}" target="_blank"> <i
                    class="fas fa-folder-open"></i> Riwayat Cuti Pegawai</a>
        </div>
    </div> --}}
    <a href="{{route('admin.cuti.show', ['cuti' => $model->id]) }}" class="btn btn-info mr-1"> <i
                    class="far fa-envelope-open"></i></a>
    <a target="popup" onclick="window.open(`{{ $model->link_cuti }}`,'name','width=600,height=400')"
        class="btn btn-primary mr-1" style="cursor: pointer">
        <i class="fas fa-file-alt text-white"></i>
    </a>
    <a href="{{ route('admin.cuti.histori-cuti.editRiwayat', ['cuti' => $model->id]) }}" class="btn btn-warning"><i
            class="fas fa-pen "></i></a>
    
        </div>
</div>
