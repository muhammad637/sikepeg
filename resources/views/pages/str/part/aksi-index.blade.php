 <div class="d-flex justify-content-center">
     <div class= 'btn-group mb-sm-0 mr-1'>
         <button type='button' class='btn btn-info dropdown-toggle border-0 text-white' data-toggle='dropdown'
             aria-haspopup='true' aria-expanded='false'>
             <i class='fas fa-info-circle'></i>
         </button>

         <div class='dropdown-menu'>
             <a class='dropdown-item' href="{{ route('admin.str.riwayat', [$model->id]) }}" target='_blank'>Riwayat STR</a>
             <a class='dropdown-item' href="{{ route('admin.str.show', [$model->str[0]->id]) }}">Detail STR</a>
         </div>
     </div>
      <a href="{{ $model->str[0]->link_str }}/view" class="btn btn-success mr-1" target="_blank">
                                            <i class="fas fa-link"></i>
                                        </a>
     <a href="{{ route('admin.str.edit',['str' => $model->str[0]]) }}" class='btn text-white btn-warning mr-1'><i
             class='fas fa-pen'></i></a>
 </div>
