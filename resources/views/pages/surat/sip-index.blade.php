@if ($model->sip[0]->link_sip != null)
    <a target="popup"
        onclick="window.open(`{{ route('admin.previewDokumen', ['path' => $model->sip[0]->link_sip]) }}`,'name','width=600,height=400')"
        class="btn btn-primary mr-1" style="cursor: pointer">
        <i class="fas fa-file-alt text-white"></i>
    </a>
@else
    <a href="#" class="btn btn-secondary mr-1"> <i class="fas fa-file-alt text-white"></i> </a>
@endif
