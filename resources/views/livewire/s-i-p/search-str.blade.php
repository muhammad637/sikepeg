<div>
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}
    <div class="row mb-3">
        <label for="noSTR" class="col-sm-4 col-form-label">No. STR</label>
        <div class="col-sm-8">
            <input type="number" class="form-control" name="no_str"
                @if ($no_str == null) value=""
            @else
            value="{{ $no_str }}" @endif
                required  placeholder="STR Pegawai Kosong / expired">

        </div>
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
</div>
