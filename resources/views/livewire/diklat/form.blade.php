<div>
    <input type="hidden" wire:model='ruangan_id' name="ruangan_id">
    <div>
        <div class="row mb-3">
            <label for="status_tipe" class="col-sm-4 col-form-label">Ruangan</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="ruangan" wire:model='ruangan' readonly
                    placeholder="Pilih Pegawai terlebih dahulu">
            </div>
        </div>
    </div>
</div>

@push('script')
    <script>
        $(document).ready(function() {
            $('#pegawai').select2();
            $('#pegawai').on('change', function(e) {
                var data = $('#pegawai').select2("val")
                @this.set("pegawai", data)
            });
            var data = $('#pegawai').select2("val")
            if (data) {
                @this.set('pegawai', data)
            }
        });
    </script>
@endpush

