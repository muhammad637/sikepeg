@extends('main', ['title' => 'Cuti Pegawai Master Data'])
@section('content')
    <h1 class="" style="color:black;font-weight:bold;margin:2rem 0 5rem;">Master Data</h1>
    <!-- Page Heading -->
    <!-- DataTales Example -->
    <div class="card shadow-sm mb-4">
        <div class="card-header ">
            <div class="d-md-flex justify-content-between d-sm-block">
                <h4 class="m-0 font-weight-bold text-dark">Data Akun Admin</h4>
                <button type="submit" class="btn btn-primary" data-target="#tambah" data-toggle="modal"><i
                        class="fas fa-plus"></i> Tambah</button>
                {{-- <form action="{{ route('admin.master-data.cuti-pegawai.update') }}" method="post">
                    @csrf
                    @method('put')
                    <button type="submit" class="btn btn-primary">U</button>
                </form> --}}
                {{-- <a href="{{ route('admin.master-data.cuti-pegawa') }}"
                    class="btn btn-primary mt-0 mt-sm-2 text-capitalize">update <i class="fas fa-plus-square ml-1"></i></a> --}}

            </div>
        </div>
        <div class="card-body">

            {{-- @if (session()->has('success'))
                {{ session()->get('success') }}
            @endif --}}
            <div class="table-responsive">
                <table class="table table-striped table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr class="text-dark">
                            <th scope="col">No</th>
                            <th scope="col">Nama</th>
                            <th scope="col">UserName</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($admin as $item)
                            @if ($item->id !== auth()->user()->id)
                                <tr class="text-dark">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->username }}</td>
                                    <td>
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-warning" data-toggle="modal"
                                            data-target="#edit-{{ $item->id }}">
                                            <i class="fas fa-pen"></i>
                                        </button>
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-danger" data-toggle="modal"
                                            data-target="#reset-{{ $item->id }}">
                                            <i class="fas fa-key"></i>
                                        </button>

                                    </td>
                                </tr>
                            @endif

                            <!-- Modal Edit -->
                            <div class="modal fade" id="edit-{{ $item->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Update Data Admin</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form
                                            action="{{ route('admin.master-data.admin-management.update', ['admin' => $item->id]) }}"
                                            method="post">
                                            @csrf
                                            @method('put')
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="">Username</label>
                                                    <input type="text" class="form-control" name="username" required
                                                        value="{{ $item->username }}">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="">Nama</label>
                                                    <input type="text" class="form-control" name="name" required
                                                        value="{{ $item->name }}">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save changes</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal Reset Password -->
                            <div class="modal fade" id="reset-{{ $item->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Reset Password</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form
                                            action="{{ route('admin.master-data.admin-management.reset', ['admin' => $item->id]) }}">
                                            @csrf
                                            @method('put')
                                            <div class="modal-body">
                                                <input type="password" class="form-control" placeholder="minimal 8 karakter"
                                                    id="password-{{ $item->id }}" required>
                                                <input type="checkbox" id="eye-{{ $item->id }}"> <label
                                                    for="eye-{{ $item->id }}">show
                                                    password</label>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-primary">Save changes</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <script>
                                // document.getElementById('eye-{{ $item->id }}').addEventListener('change', function() {
                                //     var passwordInput = document.getElementById('password-{{ $item->id }}');
                                //     passwordInput.type = this.checked ? 'text' : 'password';
                                // });
                                $('#eye-{{ $item->id }}').on('change', function() {
                                    var passwordInput = $('#password-{{ $item->id }}');
                                    passwordInput.attr('type', this.checked ? 'text' : 'password');
                                })
                            </script>
                        @endforeach
                    </tbody>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Modal Edit -->
    <div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Admin</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.master-data.admin-management.store') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="">Username</label>
                            <input type="text" class="form-control" name="username" required>
                        </div>
                        <div class="mb-3">
                            <label for="">Nama</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="">Password</label>
                            <input type="password" class="form-control" name="password" required id="password">
                        </div>
                        <input type="checkbox" id="eye"> <label for="eye">show password</label>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script src="{{ asset('tampilan-sikepeg/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('tampilan-sikepeg/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable()
            $('#eye').on('change', function() {
                var passwordInput = $('#password');
                passwordInput.attr('type', this.checked ? 'text' : 'password');
            })
        })
    </script>
@endpush
