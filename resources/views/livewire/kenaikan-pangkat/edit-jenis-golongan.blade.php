<div>
    @if ($status_tipe == 'pns')
    <div class="row mb-3">
        <label for="pangkat" class="col-sm-4 col-form-label">Pangkat</label>
        <div class="col-sm-8">
            <select name="pangkat_id" class="form-control" id="pangkat" wire:ignore wire:model="pangkat_id">
                <option value="">Pilih</option>
                @foreach ($resultPangkat as $item)
                <option value="{{ $item->id }}" {{ $pangkat_id==$item->id ? 'selected' : '' }}>
                    {{ $item->nama_pangkat }}</option>
                @endforeach
                <option value="lainnya">Lainnya ....</option>
            </select>
        </div>
    </div>
    {{-- {{$pangkat}} --}}
    <div class="row mb-3 {{$pangkat_id == 'lainnya' ? '' : 'd-none'}}">
        <label for="nama_pangkat" class="col-sm-4 col-form-label">Jenis Pangkat Lainnya</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" name="nama_pangkat" wire:model='nama_pangkat'
                {{$pangkat_id=='lainnya' ? 'required' : '' }}>
        </div>
    </div>
    <div class="row mb-3">
        <label for="golongan" class="col-sm-4 col-form-label">Golongan</label>
        <div class="col-sm-8">
            <select name="golongan_id" class="form-control" id="golongan" wire:model='golongan_id'>
                <option value="">Pilih</option>
                @foreach ($resultGolongan as $item)
                <option value="{{ $item->id }}" {{ old('golongan_id' , $kenaikan_pangkat->golongan_id) == $item->id ? 'selected' : '' }}>
                    {{ $item->nama_golongan }}</option>
                @endforeach
                <option value="lainnya">Lainnya ....</option>
            </select>
        </div>
    </div>
    <div class="row mb-3 {{$golongan_id == 'lainnya' ? '' : 'd-none'}}">
        <label for="nama_golongan" class="col-sm-4 col-form-label">Jenis Golongan Lainnya</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" name="nama_golongan" wire:model='nama_golongan'
                {{$golongan_id=='lainnya' ? 'required' : '' }}>
        </div>
    </div>
    <script>
        $(document).ready(function() {
                livewire = new Livewire()
                    $('#pangkat').select2();
                    $('#golongan').select2();
                    livewire.hook('message.processed', (message, component) => {
                        $('#pangkat').select2()
                        $('#golongan').select2()
                    })
                    $('#pangkat').on('change', function(){
                        var data = $('#pangkat').select2('val')
                        @this.set('pangkat_id',data)
                    })
                    $('#golongan').on('change', function(){
                        var data = $('#golongan').select2('val')
                        @this.set('golongan_id',data)
                    })
                });
    </script>
    @elseif($status_tipe == 'pppk')
    <div class="row mb-3">
        <label for="golongan" class="col-sm-4 col-form-label">Golongan</label>
        <div class="col-sm-8">
            <select name="golongan_id" class="form-control" id="golongan" wire:model='golongan_id'>
                <option value="">Pilih</option>
                @foreach ($resultGolongan as $item)
                <option value="{{ $item->id }}" {{ $golongan_id == $item->id ? 'selected' : '' }}>
                    {{ $item->nama_golongan }}</option>
                @endforeach
                <option value="lainnya">Lainnya ....</option>
            </select>
        </div>
    </div>
    <div class="row mb-3 {{$golongan_id == 'lainnya' ? '' : 'd-none'}}">
        <label for="nama_golongan" class="col-sm-4 col-form-label">Jenis Golongan Lainnya</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" name="nama_golongan">
        </div>
    </div>

    <script>
        $(document).ready(function() {
                            livewire = new Livewire()  
                                                
                                $('#golongan').select2();
                                livewire.hook('message.processed', (message, component) => {
                                    $('#golongan').select2()
                                })
                                $('#golongan').on('change', function(){
                                    var data = $('#golongan').select2('val')
                                    @this.set('golongan_id',data)
                                })
                                var data = $('#golongan').select2('val')
                                console.log(data)
                            });
                           
    </script>
    @endif
</div>

@push('script')
<script>
    $(document).ready(function() {
        data =  $('#data-pegawai').val();
        // console.log($('#data-pegawai').val())
        @this.set('pegawai', data)    
            // $('#pegawai').select2();
            // $('#pegawai').on('change', function(e) {
            //     // console.log(e)
            //     var data = $('#pegawai').select2("val")
            //     @this.set("pegawai", data)
            // });
            // var data = $('#pegawai').select2("val")
            // if (data){
            // @this.set('pegawai',data)
            // }
        });
</script>
@endpush