<div class="d-flex justify-content-center">
    <a href="{{ route('admin.jabatan.demosi.show', ['promosiDemosi' => $model->id]) }}" class="btn btn-info mr-1"><i
            class="fas fa-info-circle "></i></a>
    <a target="popup" onclick="window.open(`{{ $model->link_sk }}`,'name','width=600,height=400')"
        class="btn btn-primary mr-1" style="cursor: pointer">
        <i class="fas fa-file-alt text-white"></i>
    </a>
    <a href="{{ route('admin.jabatan.demosi.edit', ['promosiDemosi' => $model->id]) }}" class="btn btn-warning mr-1"><i
            class="fas fa-pen "></i></a>
    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete-Demosi-{{ $model->id }}">
        <i class='fas fa-trash'></i>
    </button>

    <!-- Modal -->
    <div class="modal fade" id="delete-Demosi-{{ $model->id }}" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="{{ route('admin.jabatan.demosi.destroy', ['promosiDemosi' => $model->id]) }}" method="post">
                @csrf
                @method('delete')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Hapus Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Apakah Anda Yakin menghapus data Ini ?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>
