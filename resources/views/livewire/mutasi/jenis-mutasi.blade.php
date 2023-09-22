<div>
    {{-- The best athlete wants his opponent at his best. --}}
   

    <div class="mt-5 mb-4">
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
                    <input type="text" class="form-control @error('ruangan_awal') is-invalid @enderror "
                        id="ruangan_awal" aria-describedby="ruangan_awal" name="ruangan_awal" autocomplete="false"
                        placeholder="" wire:model='ruangan_awal' >
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
                        id="ruangan_tujuan" aria-describedby="ruangan_tujuan" name="ruangan_tujuan"
                        autocomplete="false" placeholder="Masukkan Pendidikan Terakhir"
                        wire:model='ruangan_tujuan' required>
                </div>
            </div>
        </div>
        <div class="mb-4">
            <div class="row gap-5">
                <div class="col-md-5 col-sm-5 col-lg-5 col-xl-4">
                    <label for="" class="form-label">
                        <p class="mb-0 mt-md-2 mt-0">Tanggal Berlaku</p>
                    </label>
                </div>
                <div class="col-md-12 col-sm-12 col-lg-12 col-xl-8">
                    <input type="date" class="form-control @error('tanggal_berlaku') is-invalid @enderror "
                        id="tanggal_berlaku" aria-describedby="tanggal_berlaku" name="tanggal_berlaku" autocomplete="false"
                        placeholder="Masukkan Tanggal Berlaku" wire:model='tanggal_berlaku' required>
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
                        aria-describedby="no_sk" name="no_sk" autocomplete="false"
                        placeholder="Masukkan No Sk" wire:model='no_sk' required>
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
                    <input type="date" class="form-control @error('tanggal_sk') is-invalid @enderror "
                        id="tanggal_sk" aria-describedby="tanggal_sk" name="tanggal_sk" autocomplete="false"
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
                    <input type="text" class="form-control @error('link_sk') is-invalid @enderror "
                        id="link_sk" aria-describedby="link_sk" name="link_sk"
                        autocomplete="false" placeholder="Masukkan Link Upload SK"
                        wire:model='link_sk' required>
                </div>
            </div>
        </div>

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
                        id="instansi_tujuan" aria-describedby="instansi_tujuan" name="instansi_tujuan" autocomplete="false"
                        placeholder="Masukkan Instansi Tujuan Bekerja Yang Akan Datang" wire:model='instansi_tujuan' required>
                </div>
            </div>
        </div>
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
                        autocomplete="false" placeholder="Masukkan Tanggal Berlaku"
                        wire:model='tanggal_berlaku' required>
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
                    <input type="text" class="form-control @error('no_sk') is-invalid @enderror "
                        id="no_sk" aria-describedby="no_sk" name="no_sk"
                        autocomplete="false" placeholder="Masukkan Tanggal SK"
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
                    <input type="date" class="form-control @error('tanggal_sk') is-invalid @enderror "
                        id="tanggal_sk" aria-describedby="tanggal_sk" name="tanggal_sk"
                        autocomplete="false" placeholder="Masukkan Tanggal SK"
                        wire:model='tanggal_sk' required>
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
                    <input type="text" class="form-control @error('link_sk') is-invalid @enderror "
                        id="link_sk" aria-describedby="link_sk" name="link_sk"
                        autocomplete="false" placeholder="Masukkan Link Upload SK"
                        wire:model='link_sk' required>
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