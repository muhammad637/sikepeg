<div class="position-relative">
    <form class="d-sm-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search position-absolute"
        style="z-index:1;min-width:100%;" action="{{ route('admin.pegawai.searchPegawai') }}" method="get">
        @csrf
        <div class="input-group shadow-sm " style="border: 1px solid rgb(139, 139, 139);">
            <div class="input-group-append">
                <button class="btn" type="button" style="background-color: #2d7430; color: white;">
                    <i class="fas fa-search fa-sm"></i>
                </button>
            </div>
            <input wire:model='search' type="text" class="form-control bg-white border-0 small"
                placeholder="Keyword : [Nama Pegawai] [NIP] [Ruangan] [Status Tenaga]" name="search" required>
        </div>
        <div class="{{ $showResult ? 'd-block' : 'd-none' }} w-100" >
            <ul class="list-group" style="max-height: 50vh; overflow:auto;">
                @foreach ($results as $item)
                    <li class="list-group-item">
                        <a href="{{ route('admin.pegawai.show', ['pegawai' => $item->id]) }}" class="text-decoration-none text-dark">
                            <ul class="list-unstyled">
                                <li>
                                  <span class="text-uppercase font-weight-bold">{{ $item->status_tenaga ?? '-' }}</span>
                                </li>
                                <li>
                                    NIP : <em>{{ $item->nip_nippk }}</em>
                                </li>
                                <li>
                                    <b>{{ $item->nama_lengkap ?? $item->nama_depan }}</b>
                                </li>
                                <li>
                                    Ruangan : <b>{{ $item->ruangan->nama_ruangan ?? '-' }}</b>
                                </li>
                            </ul>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
        
    </form>
</div>
