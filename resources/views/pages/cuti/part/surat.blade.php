@if ($model->link_cuti != null)  
<a target="popup"
    onclick="window.open(`{{ route('admin.previewDokumen', ['folder' => 'cuti', 'namaFile' => $model->link_cuti]) }}`,'name','width=600,height=400')"
    class="btn btn-primary mr-1" style="cursor: pointer">
    <i class="fas fa-file-alt text-white"></i> Lihat
</a>
@endif
