<div>
    <div class="row mb-3">
        <label for="jenis_cuti" class="col-sm-4 col-form-label">Jenis Cuti</label>
        <div class="col-sm-8">
            <select name="jenis_cuti" id="jenis_cuti" class="form-control" wire:model='jenis_cuti'>
                <option value="">Pilih </option>
                @if ($status_tipe == 'pns')
                    <option value="cuti tahunan" {{ $jenis_cuti == 'cuti tahunan' ? 'selected' : '' }}>Cuti
                        tahunan</option>
                    <option value="cuti besar" {{ $jenis_cuti == 'cuti besar' ? 'selected' : '' }}>Cuti
                        Besar</option>
                    <option value="cuti sakit" {{ $jenis_cuti == 'cuti sakit' ? 'selected' : '' }}>Cuti
                        Sakit</option>
                    <option value="cuti melahirkan" {{ $jenis_cuti == 'cuti melahirkan' ? 'selected' : '' }}>Cuti
                        Melahirkan</option>
                    <option value="cuti alasan penting" {{ $jenis_cuti == 'cuti alasan penting' ? 'selected' : '' }}>
                        Cuti Karerana Alasan
                        Penting</option>
                    <option value="cuti di luar tanggungan negara"
                        {{ $jenis_cuti == 'cuti di luar tanggungan negara' ? 'selected' : '' }}>Cuti di Luar
                        Tanggungan Negara</option>
                @elseif ($status_tipe == 'pppk')
                    <option value="cuti tahunan" {{ $jenis_cuti == 'cuti tahunan' ? 'selected' : '' }}>Cuti
                        tahunan</option>
                    <option value="cuti besar" {{ $jenis_cuti == 'cuti besar' ? 'selected' : '' }}>Cuti
                        Besar</option>
                    <option value="cuti sakit" {{ $jenis_cuti == 'cuti sakit' ? 'selected' : '' }}>Cuti
                        Sakit</option>
                @else
                    <option value="cuti tahunan" {{ $jenis_cuti == 'cuti tahunan' ? 'selected' : '' }}>Cuti
                        tahunan</option>
                    <option value="cuti sakit" {{ $jenis_cuti == 'cuti sakit' ? 'selected' : '' }}>Cuti
                        Sakit</option>
                    <option value="cuti alasan penting" {{ $jenis_cuti == 'cuti alasan penting' ? 'selected' : '' }}>
                        Cuti Alasan Penting
                    </option>
                    <option value="cuti melahirkan" {{ $jenis_cuti == 'cuti melahirkan' ? 'selected' : '' }}>
                        Cuti Melahirkan</option>
                @endif
            </select>
        </div>
        @error('jenis_cuti')
            {{ $message }}
        @enderror
    </div>

    <div class="row mb-3">
        <label for="alasanCuti" class="col-sm-4 col-form-label">Alasan Cuti</label>
        <div class="col-sm-8">
            <textarea name="alasan_cuti" class="form-control" id="alasanCuti" cols="30" rows="3"
                wire:model='alasan_cuti'></textarea>
        </div>
        @error('alasan_cuti')
            {{ $message }}
        @enderror
    </div>

    <div class="row mb-3">
        <label for="" class="col-sm-4 col-form-label">Periode Cuti</label>
        <div class="col-sm-4">
            <input type="date" class="form-control" name="mulai_cuti" wire:model='mulai_cuti' required>
        </div>
        <div class="col-sm-4">
            <input type="date" class="form-control" name="selesai_cuti" wire:model='selesai_cuti' required>
        </div>
    </div>

    <div class="row mb-3">
        <label for="jumlah_hari" class="col-sm-4 col-form-label">Jumlah Hari</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="jumlah_hari" name="jumlah_hari" wire:model="jumlah_hari"
                required>
        </div>
    </div>

    <div class="row mb-3">
        <label for="link_cuti" class="col-sm-4 col-form-label">Upload Dokumen Cuti</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="link_cuti" name="link_cuti" wire:model="link_cuti" required>
        </div>
    </div>
    <div class="text-right">
        <a href="{{ route('admin.cuti.data-cuti-aktif.index') }}" class="btn bg-warning text-white">Tutup</a>
        <button class="btn btn-info" type="submit">Simpan</button>
    </div>

</div>




@push('script')
    <script>
        $(document).ready(function() {
            $('#select2').select2();
            $('#select2').on('change', function(e) {
                // console.log(e)
                var data = $('#select2').select2("val")
                @this.set("pegawai", data)
            });
        });
    </script>
@endpush
