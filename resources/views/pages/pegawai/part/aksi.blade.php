  
                    {{-- $show = "<div class= 'btn-group mt-sm-0 mr-1'>
                        <button type='button' class='badge bg-info dropdown-toggle border-0 text-white' data-toggle='dropdown'
                            aria-haspopup='true' aria-expanded='false'>
                            <i class='fas fa-info-circle'></i>
                        </button>
                        <div class='dropdown-menu'>
                            <a class='dropdown-item' href='" . route('admin.cuti.histori-cuti.index')  . "' target='_blank'>History Cuti</a>
                            <a class='dropdown-item' href='" . route('admin.mutasi.history', [$item->id])  . "' target='_blank'>History Mutasi</a>
                            <a class='dropdown-item' href='#filterStatusTenaga' data-toggle='modal'>History Diklat</a>
                        </div>
                    </div>";
                        // $show = "<a href='" . route('admin.pegawai.show', ['pegawai' => $item->id]) . "'
                        //                     class='badge p-2 text-white bg-info mr-1'><i class='fas fa-info-circle'></i></a>";
                        $edit = "<a href='" . route('admin.pegawai.edit', ['pegawai' => $item->id]) . "'
                                            class='badge p-2 text-white bg-warning mr-1'><i class='fas fa-pen'></i></a>";
                        return "<div class='d-flex'>$show   $edit</div>"; --}}

<div class="d-flex">
    <div class= 'btn-group mt-sm-0 mr-1'>
        <button type='button' class='badge bg-info dropdown-toggle border-0 text-white' data-toggle='dropdown'
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
            
            <a class='dropdown-item' href="{{route('admin.diklat.riwayat', [$model->id])}}" target='_blank'>History Diklat</a>
            
            <a class='dropdown-item' href="{{route('admin.kenaikan-pangkat.riwayat', [$model->id])}}" target='_blank'>History Kenaikan Pangkat</a>
            <a class='dropdown-item' href="{{route('admin.pegawai.show', [$model->id])}}" target='_blank'>Personal File</a>
        </div>
    </div>
    <a href="{{ route('admin.pegawai.edit', ['pegawai' => $model->id]) }}"
        class='badge p-2 text-white bg-warning mr-1'><i class='fas fa-pen'></i></a>
</div>
