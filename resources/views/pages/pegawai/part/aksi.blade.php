<div class="d-flex justify-content-center">
    <div class= 'btn-group mt-sm-0 mr-1'>
        <button type='button' class='btn btn-info dropdown-toggle border-0 text-white' data-toggle='dropdown'
            aria-haspopup='true' aria-expanded='false'>
            <i class='fas fa-info-circle'></i>
        </button>
        
        <div class='dropdown-menu'>
            <a class='dropdown-item' href={{route('admin.cuti.histori-cuti.index', [$model->id])}}   target='_blank'>History Cuti</a>
            @if ($model->mutasi->count() > 0)
            <a class='dropdown-item' href="{{route('admin.mutasi.history', [$model->id])}}"  target='_blank'>History Mutasi</a>
            @else
            <a class='dropdown-item' href="#">History Mutasi</a>
            @endif
            @if($model->mutasi->count() > 0)
            <a class='dropdown-item' href="{{route('admin.diklat.riwayat', [$model->id])}}" target='_blank'>History Diklat</a>
            @else
            <a class='dropdown-item' href="#" >History Diklat</a>
            @endif
            @if($model->diklat->count() > 0)
            <a class='dropdown-item' href="{{route('admin.kenaikan-pangkat.riwayat', [$model->id])}}" target='_blank'>History Kenaikan Pangkat</a>
            @else
            <a class='dropdown-item' href="#">History Kenaikan Pangkat</a>
            @endif
            <a class='dropdown-item' href="{{route('admin.pegawai.show', [$model->id])}}" target='_blank'>Personal File</a>
        </div>
    </div>
    <a href="{{ route('admin.pegawai.edit', ['pegawai' => $model->id]) }}"
        class='btn btn-warning text-white  mr-1'><i class='fas fa-pen'></i></a>
</div>
