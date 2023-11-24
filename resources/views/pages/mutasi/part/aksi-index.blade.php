
 <div class="d-flex justify-content-center">
     <div class= 'btn-group mb-sm-0 mr-1'>
         <button type='button' class='btn btn-info dropdown-toggle border-0 text-white' data-toggle='dropdown'
             aria-haspopup='true' aria-expanded='false'>
             <i class='fas fa-info-circle'></i>
         </button>

         <div class='dropdown-menu'>
             <a class='dropdown-item' href="{{ route('admin.mutasi.history', [$model->id]) }}" target='_blank'>History
                 Mutasi</a>
             <a class='dropdown-item' href="{{ route('admin.mutasi.show', [$model->mutasi[0]->id]) }}">Detail Mutasi</a>
         </div>
     </div>
     <a href="{{ route('admin.mutasi.edit',['mutasi' => $model->mutasi[0]]) }}" class='btn text-white btn-warning mr-1'><i
             class='fas fa-pen'></i></a>
 </div>
