<div>
    
    <div class="mb-4">
        <div class="row gap-5">
            <div class="col-md-5 col-sm-5 col-lg-5 col-xl-4">
                <label for="" class="form-label">
                    <p class="mb-0 mt-md-2 mt-0">Pilih Ruangan <span class="text-danger">*</span></p>
                </label>
            </div>
            <div class="col-md-12 col-sm-12 col-lg-12 col-xl-8 font-weight-normal">
              
                <select name="ruangan_id" id="ruangan_id"
                    class="form-control ruangan_select font-weight-normal @error('ruangan_id') is-invalid @enderror"
                    required wire:model='ruangan_id' wire:ignore>
                    <option value="">Pilih</option>
                    @foreach ($ruangans as $item)
                    <option value="{{ $item->id }}" {{ $ruangan_id == $item->id ? 'selected' : ''}}>{{ $item->nama_ruangan }}</option>
                    @endforeach
                    <option value="ruangan_lainnya">Lainnya</option>
                </select>
                @error('ruangan_id')
                {{ $message }}
                @enderror
            </div>
        </div>
    </div>
    <div class="mb-4 {{ $ruangan_id == 'ruangan_lainnya' ? 'd-block' : 'd-none' }}">
        <div class="row gap-5">
            <div class="col-md-5 col-sm-5 col-lg-5 col-xl-4">
                <label for="" class="form-label">
                    <p class="mb-0 mt-md-2 mt-0">Input Ruangan Baru</p>
                </label>
            </div>
            <div class="col-md-12 col-sm-12 col-lg-12 col-xl-8">
                <input type="text" class="form-control" id="ruangan" aria-describedby="ruangan" name="nama_ruangan"
                    autocomplete="false" placeholder="Masukkan Ruangan" wire:model='nama_ruangan' {{ $ruangan_id=='ruangan_lainnya'
                    ? 'required' : '' }}>
            </div>
        </div>
    </div>
</div>
@push('script')
<script>
    document.addEventListener('livewire:load', function(){
            $('.ruangan_select').select2()
            Livewire.hook('message.processed',(message, component) => {
                $('.ruangan_select').select2()
            })
             $('.ruangan_select').on('change', function() {
                var data = $('.ruangan_select').select2('val')
                @this.set('ruangan_id', data)
            })
        })
        // $(document).ready(function() {
        //     $('.ruangan_select').select2()
        //       Livewire.hook('message.processed',(message, component) => {
        //         $('.ruangan_select').select2()
        //     })
        //     $('.ruangan_select').on('change', function() {
        //         var data = $('.ruangan_select').select2('val')
        //         @this.set('ruangan_id', data)
        //     })
        // })
</script>
@endpush