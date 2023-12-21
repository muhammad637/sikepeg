<div>
    <div class="mt-4 mb-4">
        <div class="row gap-5">
            <div class="col-md-5 col-sm-5 col-lg-5 col-xl-4">
                <label for="" class="form-label">
                    <p class="mb-0 mt-md-2 mt-0">Jenis Mutasi<span class="text-danger">*</span></p>
                </label>
            </div>
            <div class="col-md-12 col-sm-12 col-lg-12 col-xl-8">
                <select name="jenis_mutasi" id="" wire:model='jenis_mutasi'
                    class="form-control @error('jenis_mutasi') is-invalid @enderror" required>
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
                        <p class="mb-0 mt-md-2 mt-0">Ruangan Lama<span class="text-danger">*</span></p>
                    </label>
                </div>
                <div class="col-md-12 col-sm-12 col-lg-12 col-xl-8">
                    @foreach ($ruangans as $item)
                    <input type="text" class="form-control @error('ruangan_awal_id') is-invalid @enderror "
                        id="ruangan_awal_id" aria-describedby="ruangan_awal_id" name="ruangan_awal_id" autocomplete="false"
                        wire:model='ruangan_awal_id' value="{{$item->id}}" {{$ruangan_awal_id == $item->id}} required>    
                    @endforeach
                    
                    {{-- <select name="ruangan_awal_id" id="ruangan_awal_id" class="form-control ruangan-awal-select"
                        wire:model='ruangan_awal_id' wire:ignore required>
                        <option value="">Pilih</option>
                        @foreach ($ruangans as $item)
                            <option value="{{ $item->id }}" {{ $ruangan_awal_id == $item->id ? 'selected' : '' }}>
                                {{ $item->nama_ruangan }}</option>
                        @endforeach
                        <option value="lainnya">Lainnya</option>
                    </select> --}}
                </div>
            </div>
        </div>
        <div class="mb-4 {{$ruangan_awal_id == 'lainnya' ? '' : 'd-none'}}">
            <div class="row gap-5">
                <div class="col-md-5 col-sm-5 col-lg-5 col-xl-4">
                    <label for="" class="form-label">
                        <p class="mb-0 mt-md-2 mt-0">Tambah Ruangan Lama<span class="text-danger">*</span></p>
                    </label>
                </div>
                <div class="col-md-12 col-sm-12 col-lg-12 col-xl-8">
                    <input type="text" name="tambah_ruangan_awal" wire:model='tambah_ruangan_awal' class="form-control" placeholder="Masukkan Nama Ruangan" {{ $ruangan_awal_id == 'lainnya' ? 'required' : ''}}>
                </div>
            </div>
        </div>
        <div class="mb-4">
            <div class="row gap-5">
                <div class="col-md-5 col-sm-5 col-lg-5 col-xl-4">
                    <label for="" class="form-label">
                        <p class="mb-0 mt-md-2 mt-0">Ruangan Baru<span class="text-danger">*</span></p>
                    </label>
                </div>
                <div class="col-md-12 col-sm-12 col-lg-12 col-xl-8">
                    <select name="ruangan_tujuan_id"  class="form-control ruangan-tujuan-select"
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
        <div class="mb-4 {{$ruangan_tujuan_id == 'lainnya' ? '' : 'd-none'}}">
            <div class="row gap-5">
                <div class="col-md-5 col-sm-5 col-lg-5 col-xl-4">
                    <label for="" class="form-label">
                        <p class="mb-0 mt-md-2 mt-0">Tambah Ruangan Baru<span class="text-danger">*</span></p>
                    </label>
                </div>
                <div class="col-md-12 col-sm-12 col-lg-12 col-xl-8">
                    <input type="text" name="tambah_ruangan_tujuan" wire:model='tambah_ruangan_tujuan' class="form-control" placeholder="Masukkan Nama Ruangan" {{ $ruangan_tujuan_id == 'lainnya' ? 'required' : ''}}>
                </div>
            </div>
        </div>
        <script>
            let livewire = new Livewire()
            // console.log(pangkat.hook('message.processe'))
            $(document).ready(function() {
                $('.ruangan-awal-select').select2()
                $('.ruangan-tujuan-select').select2()
                livewire.hook('message.processed', (message, component) => {
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
                        <p class="mb-0 mt-md-2 mt-0">Instansi Lama<span class="text-danger">*</span></p>
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
                        <p class="mb-0 mt-md-2 mt-0">Instansi Baru<span class="text-danger">*</span></p>
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
    @else
        <div class="mb-4">
            <div class="row gap-5">
                <div class="col-md-5 col-sm-5 col-lg-5 col-xl-4">
                    <label for="" class="form-label">
                        <p class="mb-0 mt-md-2 mt-0">Ruangan Lama<span class="text-danger">*</span></p>
                    </label>
                </div>

                <div class="col-md-12 col-sm-12 col-lg-12 col-xl-8">
                    <input type="text" value="" class="form-control" placeholder="Masukkan Ruangan Awal" readonly>
                </div>
            </div>
        </div>
        <div class="mb-4">
            <div class="row gap-5">
                <div class="col-md-5 col-sm-5 col-lg-5 col-xl-4">
                    <label for="" class="form-label">
                        <p class="mb-0 mt-md-2 mt-0">Ruangan Baru<span class="text-danger">*</span></p>
                    </label>
                </div>
                <div class="col-md-12 col-sm-12 col-lg-12 col-xl-8">
                    <input type="text" class="form-control @error('ruangan_tujuan') is-invalid @enderror"
                        id="ruangan_tujuan" aria-describedby="ruangan_tujuan" name="ruangan_tujuan" autocomplete="false"
                        placeholder="Masukkan Ruang Tujuan" wire:model='ruangan_tujuan' readonly>
                </div>
            </div>
        </div>
        <div class="mb-4">
            <div class="row gap-5">
                <div class="col-md-5 col-sm-5 col-lg-5 col-xl-4">
                    <label for="" class="form-label">
                        <p class="mb-0 mt-md-2 mt-0">Instansi Lama<span class="text-danger">*</span></p>
                    </label>
                </div>
                <div class="col-md-12 col-sm-12 col-lg-12 col-xl-8">
                    <input type="text" class="form-control @error('instansi_awal') is-invalid @enderror "
                        id="instansi_awal" aria-describedby="instansi_awal" name="instansi_awal"
                        autocomplete="false" placeholder="Masukkan Instansi Awal Bekerja" wire:model='instansi_awal'
                        readonly>
                </div>
            </div>
        </div>
        <div class="mb-4">
            <div class="row gap-5">
                <div class="col-md-5 col-sm-5 col-lg-5 col-xl-4">
                    <label for="" class="form-label">
                        <p class="mb-0 mt-md-2 mt-0">Instansi Baru<span class="text-danger">*</span></p>
                    </label>
                </div>
                <div class="col-md-12 col-sm-12 col-lg-12 col-xl-8">
                    <input type="text" class="form-control @error('instansi_tujuan') is-invalid @enderror "
                        id="instansi_tujuan" aria-describedby="instansi_tujuan" name="instansi_tujuan"
                        autocomplete="false" placeholder="Masukkan Instansi Tujuan Bekerja Yang Akan Datang"
                        wire:model='instansi_tujuan' readonly>
                </div>
            </div>
        </div>
    @endif

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
            // $('.nip').val('tes')
        });
    </script>
@endpush
