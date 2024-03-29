<div>

    <div class=" mb-4">
        <div class="row gap-5">
            <div class="col-md-5 col-sm-5 col-lg-5 col-xl-4">
                <label for="" class="form-label">
                    <p class="mb-0 mt-md-2 mt-0">Jenis Mutasi</p>
                </label>
            </div>
            <div class="col-md-12 col-sm-12 col-lg-12 col-xl-8">
                <select name="jenis_mutasi" id="" wire:model='jenis_mutasi'
                    class="form-control @error('jenis_mutasi') is-invalid @enderror">
                    <option value="">Pilih</option>
                    <option value="internal" {{ $jenis_mutasi == 'internal' ? 'selected' : '' }}>Internal</option>
                    <option value="eksternal" {{ $jenis_mutasi == 'eksternal' ? 'selected' : '' }}>Eksternal</option>
                </select>
            </div>
        </div>
    </div>
    @if ($jenis_mutasi == 'internal')
        <div class="mb-4">
            <div class="row gap-5">
                <div class="col-md-5 col-sm-5 col-lg-5 col-xl-4">
                    <label for="" class="form-label">
                        <p class="mb-0 mt-md-2 mt-0">Ruangan Awal</p>
                    </label>
                </div>
                <div class="col-md-12 col-sm-12 col-lg-12 col-xl-8">
                    <select name="ruangan_awal_id" id="ruangan_awal_id" class="form-control ruangan-awal-select"
                        wire:model='ruangan_awal_id' wire:ignore required>
                        <option value="">Pilih</option>
                        @foreach ($ruangans as $item)
                            <option value="{{ $item->id }}" {{ $ruangan_awal_id == $item->id ? 'selected' : '' }}>
                                {{ $item->nama_ruangan }}</option>
                        @endforeach
                        <option value="lainnya">Lainnya</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="mb-4 {{ $ruangan_awal_id == 'lainnya' ? '' : 'd-none' }}">
            <div class="row gap-5">
                <div class="col-md-5 col-sm-5 col-lg-5 col-xl-4">
                    <label for="" class="form-label">
                        <p class="mb-0 mt-md-2 mt-0">Tambah Ruangan Awal</p>
                    </label>
                </div>
                <div class="col-md-12 col-sm-12 col-lg-12 col-xl-8">
                    <input type="text" name="tambah_ruangan_awal" wire:model='tambah_ruangan_awal'
                        class="form-control" placeholder="Masukkan Nama Ruangan"
                        {{ $ruangan_awal_id == 'lainnya' ? 'required' : '' }}>
                </div>
            </div>
        </div>
        <div class="mb-4">
            <div class="row gap-5">
                <div class="col-md-5 col-sm-5 col-lg-5 col-xl-4">
                    <label for="" class="form-label">
                        <p class="mb-0 mt-md-2 mt-0">Ruangan Tujuan</p>
                    </label>
                </div>
                <div class="col-md-12 col-sm-12 col-lg-12 col-xl-8">
                    <select name="ruangan_tujuan_id" class="form-control ruangan-tujuan-select"
                        wire:model='ruangan_tujuan_id' wire:ignore required>
                        <option value="">Pilih</option>
                        @foreach ($ruangans as $item)
                            <option value="{{ $item->id }}">
                                {{ $item->nama_ruangan }}</option>
                        @endforeach
                        <option value="lainnya">Lainnya</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="mb-4 {{ $ruangan_tujuan_id == 'lainnya' ? '' : 'd-none' }}">
            <div class="row gap-5">
                <div class="col-md-5 col-sm-5 col-lg-5 col-xl-4">
                    <label for="" class="form-label">
                        <p class="mb-0 mt-md-2 mt-0">Tambah Ruangan Tujuan</p>
                    </label>
                </div>
                <div class="col-md-12 col-sm-12 col-lg-12 col-xl-8">
                    <input type="text" name="tambah_ruangan_tujuan" wire:model='tambah_ruangan_tujuan'
                        class="form-control" placeholder="Masukkan Nama Ruangan"
                        {{ $ruangan_tujuan_id == 'lainnya' ? 'required' : '' }}>
                </div>
            </div>
        </div>
        <script>
            // console.log(Livewire)
            // let livewire = new Livewire()
            // console.log(pangkat.hook('message.processe'))
            $(document).ready(function() {
                $('.ruangan-awal-select').select2()
                $('.ruangan-tujuan-select').select2()
                Livewire.hook('message.processed', (message, component) => {
                    $('.ruangan-awal-select').select2()
                    $('.ruangan-tujuan-select').select2()
                })
                $('.ruangan-awal-select').on('change', function() {
                    var data = $('.ruangan-awal-select').select2('val')
                    @this.set('ruangan_awal_id', data)
                    console.log(data)
                })
                $('.ruangan-tujuan-select').on('change', function() {
                    var data = $('.ruangan-tujuan-select').select2('val')
                    @this.set('ruangan_tujuan_id', data)
                    console.log(data)
                })
            })
        </script>
    @elseif($jenis_mutasi == 'eksternal')
        <div class="mb-4">
            <div class="row gap-5">
                <div class="col-md-5 col-sm-5 col-lg-5 col-xl-4">
                    <label for="" class="form-label">
                        <p class="mb-0 mt-md-2 mt-0">Instansi Awal</p>
                    </label>
                </div>
                <div class="col-md-12 col-sm-12 col-lg-12 col-xl-8">
                    <input type="text" class="form-control @error('instansi_awal') is-invalid @enderror "
                        id="instansi_awal" aria-describedby="instansi_awal" name="instansi_awal" autocomplete="false"
                        placeholder="Masukkan Instansi Awal Bekerja" wire:model='instansi_awal' required>
                </div>
            </div>
        </div>
        <div class="mb-4">
            <div class="row gap-5">
                <div class="col-md-5 col-sm-5 col-lg-5 col-xl-4">
                    <label for="" class="form-label">
                        <p class="mb-0 mt-md-2 mt-0">Instansi Tujuan</p>
                    </label>
                </div>
                <div class="col-md-12 col-sm-12 col-lg-12 col-xl-8">
                    <input type="text" class="form-control @error('instansi_tujuan') is-invalid @enderror "
                        id="instansi_tujuan" aria-describedby="instansi_tujuan" name="instansi_tujuan"
                        autocomplete="false" placeholder="Masukkan Instansi Tujuan Bekerja Yang Akan Datang"
                        wire:model='instansi_tujuan' required>
                </div>
            </div>
        </div>

    @endif
    <div class="mb-4">
        <div class="row gap-5">
            <div class="col-md-5 col-sm-5 col-lg-5 col-xl-4">
                <label for="" class="form-label">
                    <p class="mb-0 mt-md-2 mt-0">Tanggal Berlaku</p>
                </label>
            </div>
            <div class="col-md-12 col-sm-12 col-lg-12 col-xl-8">
                <input type="date" class="form-control @error('tanggal_berlaku') is-invalid @enderror "
                    id="tanggal_berlaku" aria-describedby="tanggal_berlaku" name="tanggal_berlaku"
                    autocomplete="false" placeholder="Masukkan Tanggal Berlaku" wire:model='tanggal_berlaku'
                    required>
            </div>
        </div>
    </div>
    <div class="mb-4">
        <div class="row gap-5">
            <div class="col-md-5 col-sm-5 col-lg-5 col-xl-4">
                <label for="" class="form-label">
                    <p class="mb-0 mt-md-2 mt-0">No SK</p>
                </label>
            </div>
            <div class="col-md-12 col-sm-12 col-lg-12 col-xl-8">
                <input type="text" class="form-control @error('no_sk') is-invalid @enderror " id="no_sk"
                    aria-describedby="no_sk" name="no_sk" autocomplete="false" placeholder="Masukkan Tanggal SK"
                    wire:model='no_sk' required>
            </div>
        </div>
    </div>
    <div class="mb-4">
        <div class="row gap-5">
            <div class="col-md-5 col-sm-5 col-lg-5 col-xl-4">
                <label for="" class="form-label">
                    <p class="mb-0 mt-md-2 mt-0">Tanggal SK</p>
                </label>
            </div>
            <div class="col-md-12 col-sm-12 col-lg-12 col-xl-8">
                <input type="date" class="form-control @error('tanggal_sk') is-invalid @enderror " id="tanggal_sk"
                    aria-describedby="tanggal_sk" name="tanggal_sk" autocomplete="false"
                    placeholder="Masukkan Tanggal SK" wire:model='tanggal_sk' required>
            </div>
        </div>
    </div>
    <div class="mb-4">
        <div class="row gap-5">
            <div class="col-md-5 col-sm-5 col-lg-5 col-xl-4">
                <label for="" class="form-label">
                    <p class="mb-0 mt-md-2 mt-0">Upload Link SK</p>
                </label>
            </div>
            <div class="col-md-12 col-sm-12 col-lg-12 col-xl-8">
                <input type="text" class="form-control @error('link_sk') is-invalid @enderror " id="link_sk"
                    aria-describedby="link_sk" name="link_sk" autocomplete="false"
                    placeholder="Masukkan Link Upload SK" wire:model='link_sk' required>
            </div>
        </div>
    </div>
</div>
@push('script')
    <script>
        $(document).ready(function() {
            // alert('oke')
            $('#pegawai').select2();
            $('#pegawai').on('change', function(e) {
                // console.log(e)
                var data = $('#pegawai').select2("val")
                @this.set("select_pegawai", data)
            });
            document.addEventListener('livewire:load', function() {
                $(document).ready(function() {
                    if ($('.ruangan_awal_select')) {
                        $('.ruangan_awal_select').select2()
                        Livewire.hook('message.processed', (message, component) => {
                            $('.ruangan_awal_select').select2()
                        })
                        $('.ruangan_awal_select').on('change', function() {
                            console.log('testing')
                            var data = $('.ruangan_awal_select').select2('val')
                            console.log(data)
                            @this.set('ruangan_awal_id', data)
                        })
                    }
                    if ($('.ruangan_tujuan_select')) {
                        $('.ruangan_tujuan_select').select2()
                        Livewire.hook('message.processed', (message, component) => {
                            $('.ruangan_tujuan_select').select2()
                        })
                        $('.ruangan_tujuan_select').on('change', function() {
                            var data = $('.ruangan_tujuan_select').select2('val')
                            alert('oke');
                            console.log(data)
                            @this.set('ruangan_tujuan_id', data)
                        })
                    }
                })
            })
        });
    </script>
@endpush
