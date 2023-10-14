<div>
    <div class="mt-4 mb-4">
        <div class="row gap-5">
            <div class="col-md-5 col-sm-5 col-lg-5 col-xl-4">
                <label for="" class="form-label">
                    <p class="mb-0 mt-md-2 mt-0">Jenis Mutasi</p>
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
                    </select>
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
                    <select name="ruangan_tujuan_id"  class="form-control ruangan-tujuan-select"
                        wire:model='ruangan_tujuan_id' wire:ignore required>
                        <option value="">Pilih</option>
                        @foreach ($ruangans as $item)
                            <option value="{{ $item->id }}">
                                {{ $item->nama_ruangan }}</option>
                        @endforeach
                    </select>
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
    @else
        <div class="mb-4">
            <div class="row gap-5">
                <div class="col-md-5 col-sm-5 col-lg-5 col-xl-4">
                    <label for="" class="form-label">
                        <p class="mb-0 mt-md-2 mt-0">Ruangan Awal</p>
                    </label>
                </div>

                <div class="col-md-12 col-sm-12 col-lg-12 col-xl-8">
                    <select name="ruangan_awal_id" id="ruangan_awal_id" class="form-control ruangan-awal-select"
                        wire:model='ruangan_awal_id' readonly>
                        <option value="">Pilih</option>
                    </select>
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
                    <input type="text" class="form-control @error('ruangan_tujuan') is-invalid @enderror"
                        id="ruangan_tujuan" aria-describedby="ruangan_tujuan" name="ruangan_tujuan" autocomplete="false"
                        placeholder="Masukkan Pendidikan Terakhir" wire:model='ruangan_tujuan' readonly>
                </div>
            </div>
        </div>
        <div class="mb-4">
            <div class="row gap-5">
                <div class="col-md-5 col-sm-5 col-lg-5 col-xl-4">
                    <label for="" class="form-label">
                        <p class="mb-0 mt-md-2 mt-0">Instansi Awal</p>
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
                        <p class="mb-0 mt-md-2 mt-0">Instansi Tujuan</p>
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
