<div>
    <div class="row">
        <div class="col-sm-12 col-xl-12">
            <form wire:submit.prevent="save">
                <div class="row mb-3">
                    <label for="" class="col-sm-4 col-form-label">Status Tipe</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" value="{{ $status_tipe }}" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="" class="col-sm-4 col-form-label font-weight-bold">Sisa Cuti Tahunan Saat Ini</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" value="{{ $sisa_cuti_tahunan_saat_ini }}" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="no_hp" class="col-sm-4 col-form-label">No Hp</label>
                    <div class="col-sm-8">
                        <input name="no_hp" class="form-control" wire:model='no_hp' required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="alamat" class="col-sm-4 col-form-label">Alamat</label>
                    <div class="col-sm-8">
                        <input name="alamat" class="form-control" wire:model='alamat' required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="jenis_cuti" class="col-sm-4 col-form-label">Jenis Cuti</label>
                    <div class="col-sm-8">
                        <select name="jenis_cuti" id="jenis_cuti" class="form-control" wire:model='jenis_cuti'>
                            <option value="">Pilih </option>
                            @if ($status_tipe == 'pns')
                                <option value="cuti tahunan" {{ $jenis_cuti == 'cuti tahunan' ? 'selected' : '' }}>Cuti Tahunan</option>
                                <option value="cuti besar" {{ $jenis_cuti == 'cuti besar' ? 'selected' : '' }}>Cuti Besar</option>
                                <option value="cuti sakit" {{ $jenis_cuti == 'cuti sakit' ? 'selected' : '' }}>Cuti Sakit</option>
                                <option value="cuti melahirkan" {{ $jenis_cuti == 'cuti melahirkan' ? 'selected' : '' }}>Cuti Melahirkan</option>
                                <option value="cuti alasan penting" {{ $jenis_cuti == 'cuti alasan penting' ? 'selected' : '' }}>Cuti Karena Alasan Penting</option>
                                <option value="cuti di luar tanggungan negara" {{ $jenis_cuti == 'cuti di luar tanggungan negara' ? 'selected' : '' }}>Cuti di Luar Tanggungan Negara</option>
                            @elseif ($status_tipe == 'pppk')
                                <option value="cuti tahunan" {{ $jenis_cuti == 'cuti tahunan' ? 'selected' : '' }}>Cuti Tahunan</option>
                                <option value="cuti besar" {{ $jenis_cuti == 'cuti besar' ? 'selected' : '' }}>Cuti Besar</option>
                                <option value="cuti sakit" {{ $jenis_cuti == 'cuti sakit' ? 'selected' : '' }}>Cuti Sakit</option>
                            @else
                                <option value="cuti tahunan" {{ $jenis_cuti == 'cuti tahunan' ? 'selected' : '' }}>Cuti Tahunan</option>
                                <option value="cuti sakit" {{ $jenis_cuti == 'cuti sakit' ? 'selected' : '' }}>Cuti Sakit</option>
                                <option value="cuti alasan penting" {{ $jenis_cuti == 'cuti alasan penting' ? 'selected' : '' }}>Cuti Alasan Penting</option>
                                <option value="cuti melahirkan" {{ $jenis_cuti == 'cuti melahirkan' ? 'selected' : '' }}>Cuti Melahirkan</option>
                            @endif
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="status_cuti" class="col-sm-4 col-form-label">Status Cuti</label>
                    <div class="col-sm-8">
                        <select name="status_cuti" id="status_cuti" class="form-control" wire:model='status_cuti' required>
                            <option value="">Pilih</option>
                            <option value="pending" {{ $status_cuti == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="diterima" {{ $status_cuti == 'diterima' ? 'selected' : '' }}>disetujui</option>
                            <option value="ditolak" {{ $status_cuti == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="alasanCuti" class="col-sm-4 col-form-label">Alasan Cuti</label>
                    <div class="col-sm-8">
                        <textarea name="alasan_cuti" wire:model='alasan_cuti' class="form-control" id="alasanCuti" cols="30" rows="3"></textarea>
                    </div>
                </div>
                <div class="row mb-3 align-items-center">
                    <label for="" class="col-sm-4 col-form-label">Periode Cuti</label>
                    <div class="col-sm-4">
                        <span class="text-danger">*mulai cuti</span>
                        <input type="date" class="form-control" name="mulai_cuti" wire:model='mulai_cuti' id="mulaiCuti" required>
                    </div>
                    <div class="col-sm-4">
                        <span class="text-danger">*selesai cuti</span>
                        <input type="date" class="form-control" name="selesai_cuti" wire:model='selesai_cuti' id="selesaiCuti" required>
                    </div>
                    <span class="text-danger text-center {{ $selesai_cuti < $mulai_cuti ? 'd-block' : 'd-none' }}">*Periode cuti tidak valid</span>
                </div>
                <div class="row mb-3">
                    <label for="jumlah_hari" class="col-sm-4 col-form-label">Jumlah Hari</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="jumlah_hari" name="jumlah_hari" wire:model="jumlah_hari" readonly>
                    </div>
                </div>
                {{-- <div class="row mb-3">
                    <label for="link_cuti" class="col-sm-4 col-form-label">Upload Dokumen Cuti</label>
                    <div class="col-sm-8">
                        <input type="file" class="form-control" id="link_cuti" name="link_cuti" wire:model="link_cuti" required>
                    </div>
                </div> --}}
                {{-- @if ($link_cuti)
                    <div class="mt-2">
                        @if(is_string($link_cuti))
                            <a href="{{ Storage::url($link_cuti) }}" target="_blank">Lihat Dokumen</a>
                        @else
                            <a href="{{ $link_cuti->temporaryUrl() }}" target="_blank">Lihat Dokumen</a>
                        @endif
                    </div>
                @endif
     --}}
                <div class="text-right">
                    @if ($mulai_cuti < now()->format('Y-m-d'))
                        <a href="{{ route('admin.cuti.histori-cuti.index') }}" class="btn bg-warning text-white">Tutup</a>
                    @else
                        <a href="{{ route('admin.cuti.data-cuti-aktif.index') }}" class="btn bg-warning text-white">Tutup</a>
                    @endif
                    @if ($mulai_cuti <= $selesai_cuti)
                        <button class="btn btn-info" type="submit">Simpan</button>
                    @else
                        <button class="btn btn-info" type="button" disabled>Simpan</button>
                    @endif
                </div>
            </form>
        </div>
    </div>
</div>

@push('script')
    <script>
        document.addEventListener('livewire:load', function () {
            $('#select2').select2();
            $('#select2').on('change', function(e) {
                var data = $('#select2').select2("val");
                @this.set("pegawai", data);
            });
        });
    </script>
@endpush
