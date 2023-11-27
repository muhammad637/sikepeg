<div class="d-flex justify-content-center">
     <div class= 'btn-group mb-sm-0 mr-1'>
         <button type='button' class='btn btn-info dropdown-toggle border-0 text-white' data-toggle='dropdown'
             aria-haspopup='true' aria-expanded='false'>
             <i class='fas fa-info-circle'></i>
         </button>

         <div class='dropdown-menu'>
             <a class='dropdown-item' href="{{ route('admin.kenaikan-pangkat.riwayat', [$model->id]) }}" target='_blank'>Riwayat
                 Kenaikan Pangkat</a>
             <a class='dropdown-item' href="{{ route('admin.kenaikan-pangkat.show', [$model->kenaikanpangkat[0]->id]) }}">Detail kenaikanpangkat</a>
         </div>
     </div>
     <a href="{{ route('admin.kenaikan-pangkat.edit',['kenaikan_pangkat' => $model->kenaikanpangkat[0]->id]) }}" class='btn text-white btn-warning mr-1'><i
             class='fas fa-pen'></i></a>
 </div>
