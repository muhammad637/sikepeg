<div>
    @if ($status_tipe == 'pns')
        <div class="row mb-3">
            <label for="pangkat" class="col-sm-4 col-form-label">Pangkat</label>
            <div class="col-sm-8">
                <select name="pangkat" class="form-control" id="pangkat" name="pangkat" wire:model="pangkat">
                    <option value="">Pilih</option>
                    @foreach ($resultPangkat as $item)
                        <option value="{{ $item->id }}" {{ old('pangkat') == $item->id ? 'selected' : '' }}>
                            {{ $item->nama_pangkat }}</option>
                    @endforeach
                    <option value="lainnya">Lainnya ....</option>
                </select>
            </div>
        </div>
        {{-- {{$pangkat}} --}}
        @if ($pangkat == 'lainnya')
            <div class="row mb-3">
                <label for="nama_pangkat" class="col-sm-4 col-form-label">Jenis Pangkat Lainnya</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="nama_pangkat">
                </div>
            </div>
        @endif
        <div class="row mb-3">
            <label for="golongan" class="col-sm-4 col-form-label">Golongan</label>
            <div class="col-sm-8">
                <select name="golongan" class="form-control" id="" name="golongan" wire:model='golongan'>
                    <option value="">Pilih</option>
                    @foreach ($resultGolongan as $item)
                        <option value="{{ $item->id }}" {{ old('golongan') == $item->id ? 'selected' : '' }}>
                            {{ $item->nama_golongan }}</option>
                    @endforeach
                    <option value="lainnya">Lainnya ....</option>
                </select>
            </div>
        </div>
        @if ($golongan == 'lainnya')
            <div class="row mb-3">
                <label for="nama_golongan" class="col-sm-4 col-form-label">Jenis Golongan Lainnya</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="nama_golongan">
                </div>
            </div>
        @endif
    @elseif($status_tipe == 'pppk')
        <div class="row mb-3">
            <label for="golongan" class="col-sm-4 col-form-label">Golongan</label>
            <div class="col-sm-8">
                <select name="golongan" class="form-control" id="" name="golongan">
                    <option value="">Pilih</option>
                    <option value="I/C" {{ 'golongan' == 'I/C' ? 'selected' : '' }}>I/C</option>
                </select>
            </div>
        </div>
    @endif

</div>

@push('script')
    <script>
        $(document).ready(function() {
            $('#pegawai').select2();
            $('#pangkat').select2();
            $('#golongan').select2();
            $('#pegawai').on('change', function(e) {
                // console.log(e)
                var data = $('#pegawai').select2("val")
                @this.set("pegawai", data)
            });
        });
    </script>
@endpush
