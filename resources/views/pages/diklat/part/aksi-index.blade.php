
 <div class="d-flex justify-content-center">
     <div class= 'btn-group mb-sm-0 mr-1'>
         <button type='button' class='btn btn-info dropdown-toggle border-0 text-white' data-toggle='dropdown'
             aria-haspopup='true' aria-expanded='false'>
             <i class='fas fa-info-circle'></i>
         </button>

         <div class='dropdown-menu'>
             <a class='dropdown-item' href="{{ route('admin.diklat.riwayat', [$model->pegawai->id]) }}" target='_blank'>Riwayat Diklat</a>
             <a class='dropdown-item' href="{{ route('admin.diklat.show', [$model->id]) }}">Detail Diklat</a>
         </div>
     </div>
     <a href="{{ route('admin.diklat.edit',['diklat' => $model]) }}" class='btn text-white btn-warning mr-1'><i
             class='fas fa-pen'></i></a>
 </div>
