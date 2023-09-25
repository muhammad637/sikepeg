<div>


    {{-- If your happiness depends on money, you will never be happy with yourself. --}}
    {{-- <input type="hidden" name="asn_id" wire:model='selectId'> --}}
<div class="row mb-2">
    <h1>{{$pegawaiEdit ?? $select}}</h1>
</div>
    <div class="row mb-2">
        <div class="col-sm-4 mb-2  fw-italic text-end">
            <span class="mb-0 text-dark ">NIK</span>
        </div>
        <div class="col-sm-8 text-secondary">
            <input type="text" wire:model="selectedNIK" class="form-control" placeholder="NIK" readonly>
        </div>
    </div>
    <div class="row mb-2">
        <div class="col-sm-4 mb-2  fw-italic text-end">
            <span class="mb-0 text-dark ">NIP</span>
        </div>
        <div class="col-sm-8 text-secondary">
            <input type="text" wire:model="selectedNIP" class="form-control" placeholder="NIP" readonly>
        </div>
    </div>
    <div class="row mb-3">
        <label for="Ruangan" class="col-sm-4 col-form-label">Ruangan</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="inputPassword3" wire:model='selectedRuangan' readonly
                placeholder="ruangan">
        </div>
    </div>
    <div class="row mb-3">
        <label for="ttl" class="col-sm-4 col-form-label">Tempat Tanggal
            Lahir</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="inputPassword3" wire:model="selectedTempatTanggalLahir"
                readonly placeholder="tempat tanggal lahir">
        </div>
    </div>
    @if ($dokumen == 'str')
        <div class="row mb-3">
            <label for="jenisKelamin" class="col-sm-4 col-form-label">Jenis Kelamin</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="inputPassword3" readonly
                    wire:model='selectedjenisKelamin' placeholder="jenis kelamin">
            </div>
        </div>
        <div class="row mb-3">
            <label for="noIjasah" class="col-sm-4 col-form-label">No Ijazah / Sertifikat Profesi </label>
            <div class="col-sm-8">
                <input type="number" class="form-control" id="inputPassword3" wire:model='selectedNoIjazah' readonly
                    placeholder="no ijazah">
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-sm-4 mb-2  fw-italic text-end">
                <span class="mb-0 text-dark ">Tanggal Lulus</span>
            </div>
            <div class="col-sm-8 text-secondary">
                <div class="input-group date" id="datepicker">
                    <input type="text" class="form-control" wire:model='selectedTanggalLulus' readonly
                        placeholder="tanggal lulus">
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <label for="perguruanTinggi" class="col-sm-4 col-form-label">Perguruan Tinggi</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="inputPassword3" wire:model='selectedSekolah' readonly
                    placeholder="perguruan tinggi">
            </div>
        </div>
        @elseif($dokumen == 'sip')
        <div class="row mb-3">
            <label for="alamat" class="col-sm-4 col-form-label">Alamat</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="inputPassword3" wire:model='alamat' readonly
                    placeholder="alamat">
            </div>
        </div>
    @endif

    {{-- <div class="row mb-3">
        <label for="kompetensi" class="col-sm-4 col-form-label">Kompetensi</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="inputPassword3">
        </div>
    </div>
    <div class="row mb-3">
        <label for="noRegister" class="col-sm-4 col-form-label">No Registrasi</label>
        <div class="col-sm-8">
            <input type="number" class="form-control" id="inputPassword3">
        </div>
    </div> --}}
</div>
@push('script')
    <script>
        $(document).ready(function() {
            // alert('oke')
            $('#select2').select2();
            $('#select2').on('change', function(e) {
                // console.log(e)
                var data = $('#select2').select2("val")
                @this.set("select", data)
            });
            // $('.nip').val('tes')
        });
    </script>
@endpush
