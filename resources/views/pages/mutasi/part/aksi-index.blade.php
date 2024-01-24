<div class="d-flex justify-content-center">
    <a class='btn btn-info mr-1' href="{{ route('admin.mutasi.show', ['mutasi' => $model->id]) }}"><i class='fas fa-info-circle'></i></a>
    <a href="{{ route('admin.mutasi.edit', ['mutasi' => $model->id]) }}" class='btn text-white btn-warning mr-1'><i
            class='fas fa-pen'></i></a>
    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete-Mutasi-{{ $model->id }}">
        <i class='fas fa-trash'></i>
    </button>

    <!-- Modal -->
    <div class="modal fade" id="delete-Mutasi-{{ $model->id }}" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="{{ route('admin.mutasi.destroy', ['mutasi' => $model->id]) }}" method="post">
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
