<div class="position-relative">
    <form class="d-sm-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search position-absolute" style="z-index:99;min-width:100%;"
        action="{{ route('admin.pegawai.searchPegawai') }}" method="get">
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
            {{-- <div class="">
                <ul class="list-group">
                    <li class="list-group-item">Cras justo odio</li>
                    <li class="list-group-item">Dapibus ac facilisis in</li>
                    <li class="list-group-item">Morbi leo risus</li>
                    <li class="list-group-item">Porta ac consectetur ac</li>
                    <li class="list-group-item">Vestibulum at eros</li>
                </ul>
            </div> --}}
    </form>
</div>
