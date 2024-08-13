<div>
    <div class="row">
        <div class="col-sm-12 col-xl-12">
            <form wire:submit.prevent="save">
                <!-- Status Tipe -->
                <div class="row mb-3">
                    <label for="" class="col-sm-4 col-form-label">Status Tipe</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" value="{{ $status_tipe }}" readonly>
                    </div>
                </div>

                <!-- Sisa Cuti Tahunan Saat Ini -->
                <div class="row mb-3">
                    <label for="" class="col-sm-4 col-form-label font-weight-bold">Sisa Cuti Tahunan Saat
                        Ini</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" value="{{ $sisa_cuti_tahunan_saat_ini }}" readonly>
                    </div>
                </div>

                <!-- No Hp -->
                <div class="row mb-3">
                    <label for="no_hp" class="col-sm-4 col-form-label">No Hp</label>
                    <div class="col-sm-8">
                        <input name="no_hp" class="form-control" wire:model="no_hp" required>
                    </div>
                </div>

                <!-- Alamat -->
                <div class="row mb-3">
                    <label for="alamat" class="col-sm-4 col-form-label">Alamat</label>
                    <div class="col-sm-8">
                        <input name="alamat" class="form-control" wire:model="alamat" required>
                    </div>
                </div>

                <!-- Jenis Cuti -->
                <div class="row mb-3">
                    <label for="jenis_cuti" class="col-sm-4 col-form-label">Jenis Cuti</label>
                    <div class="col-sm-8">
                        <select name="jenis_cuti" id="jenis_cuti" class="form-control" wire:model="jenis_cuti">
                            <option value="">Pilih</option>
                            @if ($status_tipe == 'pns')
                                <option value="cuti tahunan" {{ $jenis_cuti == 'cuti tahunan' ? 'selected' : '' }}>Cuti
                                    Tahunan</option>
                                <option value="cuti besar" {{ $jenis_cuti == 'cuti besar' ? 'selected' : '' }}>Cuti
                                    Besar</option>
                                <option value="cuti sakit" {{ $jenis_cuti == 'cuti sakit' ? 'selected' : '' }}>Cuti
                                    Sakit</option>
                                <option value="cuti melahirkan"
                                    {{ $jenis_cuti == 'cuti melahirkan' ? 'selected' : '' }}>Cuti Melahirkan</option>
                                <option value="cuti alasan penting"
                                    {{ $jenis_cuti == 'cuti alasan penting' ? 'selected' : '' }}>Cuti Karena Alasan
                                    Penting</option>
                                <option value="cuti di luar tanggungan negara"
                                    {{ $jenis_cuti == 'cuti di luar tanggungan negara' ? 'selected' : '' }}>Cuti di Luar
                                    Tanggungan Negara</option>
                            @elseif ($status_tipe == 'pppk')
                                <option value="cuti tahunan" {{ $jenis_cuti == 'cuti tahunan' ? 'selected' : '' }}>Cuti
                                    Tahunan</option>
                                <option value="cuti besar" {{ $jenis_cuti == 'cuti besar' ? 'selected' : '' }}>Cuti
                                    Besar</option>
                                <option value="cuti sakit" {{ $jenis_cuti == 'cuti sakit' ? 'selected' : '' }}>Cuti
                                    Sakit</option>
                            @else
                                <option value="cuti tahunan" {{ $jenis_cuti == 'cuti tahunan' ? 'selected' : '' }}>Cuti
                                    Tahunan</option>
                                <option value="cuti sakit" {{ $jenis_cuti == 'cuti sakit' ? 'selected' : '' }}>Cuti
                                    Sakit</option>
                                <option value="cuti alasan penting"
                                    {{ $jenis_cuti == 'cuti alasan penting' ? 'selected' : '' }}>Cuti Alasan Penting
                                </option>
                                <option value="cuti melahirkan"
                                    {{ $jenis_cuti == 'cuti melahirkan' ? 'selected' : '' }}>Cuti Melahirkan</option>
                            @endif
                        </select>
                    </div>
                </div>

                <!-- Alasan Cuti -->
                <div class="row mb-3">
                    <label for="alasanCuti" class="col-sm-4 col-form-label">Alasan Cuti</label>
                    <div class="col-sm-8">
                        <textarea name="alasan_cuti" wire:model="alasan_cuti" class="form-control" id="alasanCuti" cols="30"
                            rows="3"></textarea>
                    </div>
                </div>

                <!-- Periode Cuti -->
                <div class="row mb-3 align-items-center">
                    <label for="" class="col-sm-4 col-form-label">Periode Cuti</label>
                    <div class="col-sm-4">
                        <span class="text-danger">*mulai cuti</span>
                        <input type="date" class="form-control" name="mulai_cuti" wire:model="mulai_cuti"
                            id="mulaiCuti" required>
                    </div>
                    <div class="col-sm-4">
                        <span class="text-danger">*selesai cuti</span>
                        <input type="date" class="form-control" name="selesai_cuti" wire:model="selesai_cuti"
                            id="selesaiCuti" required>
                    </div>
                    <span
                        class="text-danger text-center {{ $selesai_cuti < $mulai_cuti ? 'd-block' : 'd-none' }}">*Periode
                        cuti tidak valid</span>
                </div>

                <!-- Jumlah Hari -->
                <div class="row mb-3">
                    <label for="jumlah_hari" class="col-sm-4 col-form-label">Jumlah Hari</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="jumlah_hari" name="jumlah_hari"
                            wire:model="jumlah_hari" readonly>
                    </div>
                </div>

                <!-- Modal Button -->
                <div class="row mb-3">
                    <label for="status_cuti" class="col-sm-4 col-form-label">Isi Form Lanjutan Pengajuan Cuti</label>
                    <div class="col-sm-8">
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#formlanjutan">
                            Buka Formulir
                        </button>

                    </div>

                </div>

                <!-- Status Cuti -->
                <div class="row mb-3">
                    <label for="status_cuti" class="col-sm-4 col-form-label">Status Cuti</label>
                    <div class="col-sm-8">
                        @if ($cuti->status_cuti != 'pending')
                            <input type="text" class="form-control" id="jumlah_hari" name="status_cuti"
                                value="{{ $cuti->status_cuti }}" readonly>
                        @else
                            <select name="status_cuti" id="status_cuti" class="form-control"
                                wire:model="status_cuti"
                                {{ $status_tipe == 'thl' && empty($cuti['validasi']) ? 'disabled' : '' }} required>
                                <option value="pending" {{ $status_cuti == 'pending' ? 'selected' : '' }}>Pending
                                </option>
                                <option value="disetujui" {{ $status_cuti == 'disetujui' ? 'selected' : '' }}>
                                    Disetujui
                                </option>
                                <option value="ditolak" {{ $status_cuti == 'ditolak' ? 'selected' : '' }}>Ditolak
                                </option>
                            </select>
                        @endif
                    </div>
                    <span
                        class="text-danger text-center {{ $status_tipe == 'thl' && empty($cuti['validasi']) ? 'd-block' : 'd-none' }}">*Tolong
                        isi form lanjutan nya terlebih dahulu sebelum memvalidasi cuti</span>
                </div>

                <div class="row mb-3">
                    <label for="status_cuti" class="col-sm-4 col-form-label">Dokumen Cuti</label>
                    <div class="col-sm-8">
                        @if ($cuti->link_cuti != null)
                            <a target="popup"
                                onclick="window.open(`{{ route('admin.previewDokumen', ['folder' => 'cuti', 'namaFile' => $cuti->link_cuti]) }}`,'name','width=600,height=400')"
                                class="btn btn-primary mr-1" style="cursor: pointer">
                                <i class="fas fa-file-alt text-white"></i> Lihat
                            </a>
                            <a target="_blank" style="cursor: pointer"
                                href="{{ route('admin.downloadDokumen', ['folder' => 'cuti', 'namaFile' => $cuti->link_cuti]) }}"  class="btn btn-primary mr-1">
                                <i class="fas fa-file-alt text-white"></i> Download
                            </a>
                        @else
                            <input type="text" class="form-control" id="jumlah_hari" name="jumlah_hari"
                                value="dokumen tidak ada" readonly>
                        @endif
                    </div>
                    <span
                        class="text-danger text-center {{ $status_tipe == 'thl' && empty($cuti['validasi']) ? 'd-block' : 'd-none' }}">*Tolong
                        isi form lanjutan nya terlebih dahulu sebelum memvalidasi cuti</span>
                </div>
                <!-- Button Actions -->
                <div class="text-right">
                    @if ($mulai_cuti < now()->format('Y-m-d'))
                        <a href="{{ route('admin.cuti.histori-cuti.index') }}"
                            class="btn bg-warning text-white">Tutup</a>
                    @else
                        <a href="{{ route('admin.cuti.data-cuti-aktif.index') }}"
                            class="btn bg-warning text-white">Tutup</a>
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

{{-- <!-- Modal Structure -->
<div class="modal fade  bd-example-modal-lg" tabindex="-1" role="dialog" id="formlanjutan">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Modal body text goes here.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary">Save changes</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div> --}}

<!-- Modal Structure -->
<div class="modal fade  bd-example-modal-lg" tabindex="-1" role="dialog" id="formlanjutan">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Formulir Lanjutan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.cuti.data-cuti.formLanjutan', ['cuti' => $cuti]) }}" method="POST">
                    @csrf
                    @method('GET')

                    <div class="form-group row">
                        <label for="n2" class="col-sm-4 col-form-label">N2</label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control" id="n2" name="n2"
                                value="{{ $cuti['formLanjutan']['n2'] ?? 0 }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="n1" class="col-sm-4 col-form-label">N1</label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control" id="n1" name="n1"
                                value="{{ $cuti['formLanjutan']['n1'] ?? 0 }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="n" class="col-sm-4 col-form-label">N</label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control" id="n" name="n"
                                value="{{ $cuti['formLanjutan']['n'] ?? 0 }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="cutiBesar" class="col-sm-4 col-form-label">Cuti Besar</label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control" id="cutiBesar" name="cutiBesar"
                                value="{{ $cuti['formLanjutan']['cutiBesar'] ?? 0 }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="cutiSakit" class="col-sm-4 col-form-label">Cuti Sakit</label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control" id="cutiSakit" name="cutiSakit"
                                value="{{ $cuti['formLanjutan']['cutiSakit'] ?? 0 }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="cutiMelahirkan" class="col-sm-4 col-form-label">Cuti Melahirkan</label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control" id="cutiMelahirkan" name="cutiMelahirkan"
                                value="{{ $cuti['formLanjutan']['cutiMelahirkan'] ?? 0 }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="cutiKareanaAlasanPenting" class="col-sm-4 col-form-label">Cuti Karena Alasan
                            Penting</label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control" id="cutiKareanaAlasanPenting"
                                name="cutiKareanaAlasanPenting"
                                value="{{ $cuti['formLanjutan']['cutiKareanaAlasanPenting'] ?? 0 }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="cutiDiLuarTanggunganNegara" class="col-sm-4 col-form-label">Cuti di Luar
                            Tanggungan Negara</label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control" id="cutiDiLuarTanggunganNegara"
                                name="cutiDiLuarTanggunganNegara"
                                value="{{ $cuti['formLanjutan']['cutiDiLuarTanggunganNegara'] ?? 0 }}">
                        </div>
                    </div>

                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



@push('script')
    <script>
        document.addEventListener('livewire:load', function() {
            $('#select2').select2();
            $('#select2').on('change', function(e) {
                var data = $('#select2').select2("val");
                @this.set("pegawai", data);
            });
        });
    </script>
@endpush
