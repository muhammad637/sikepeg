<div>
    <input type="hidden" wire:model='ruangan_id' name="ruanganawal_id">
    <div>
        <div class="row mb-3">
            <label for="status_tipe" class="col-sm-4 col-form-label">Ruangan Lama</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="" wire:model='ruangan' readonly
                    placeholder="Pilih Pegawai terlebih dahulu">
            </div>
        </div>
    </div>
    <div class="row mb-2">
        <div class="col-sm-4 mb-2  fw-italic text-end">
            <span class="mb-0 text-dark ">Ruangan Baru<span class="text-danger">*</span></span>
        </div>
        <div class="col-sm-8 text-secondary">
            <select class="form-control" id="ruangan" name="ruanganbaru_id" required wire:model='ruanganbaru_id' wire:ignore>
                <option value="">Pilih Ruangan</option>
                @foreach ($ruangans as $item)
                    <option value="{{ $item->id }}" {{ old($item->id) == $item->id ? 'selected' : '' }}>
                        {{ $item->nama_ruangan}}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="row mb-3">
        <label for="status_tipe" class="col-sm-4 col-form-label">Jabatan Lama</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" name="jabatan_sebelumnya" wire:model='jabatanLama' readonly
                placeholder="Pilih Pegawai terlebih dahulu">
        </div>
    </div>
</div>

@push('script')
    <script>
        $(document).ready(function() {
            $('#pegawai').select2();
            $('#ruangan').select2();
             Livewire.hook('message.processed',(message, component) => {
                $('#ruangan').select2()
            })
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

