@extends('main')
@section('content')
    <h1 class="" style="color:black;font-weight:bold;margin:2rem 0 5rem;">Master Data</h1>
    <!-- Page Heading -->
    <!-- DataTales Example -->
    <div class="card shadow-sm mb-4">
        <div class="card-header ">
            <div class="d-md-flex justify-content-between d-sm-block">
                <h2 class="m-0 font-weight-bold text-dark">Pangkat</h2>
                <a href="{{ route('pangkat.create') }}" class="btn btn-primary mt-0 mt-sm-2 text-capitalize">create <i
                        class="fas fa-plus-square ml-1"></i></a>

            </div>
        </div>
        <div class="card-body">

            {{-- @if (session()->has('success'))
                {{ session()->get('success') }}
            @endif --}}
            <div class="table-responsive">
                <table class="table table-striped table-bordered text-center text-capitalize" id="dataTable" width="100%"
                    cellspacing="0">
                    <thead>
                        <tr class="text-dark">
                            <th scope="col">No</th>
                            <th scope="col">Nama Pangkat</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pangkat as $index => $item)
                            <tr>
                                <td>{{ $loop->iteration }} </td>
                                <td>{{ $item->nama_pangkat }} </td>
                                <td class="">
                                    <a href="{{ route('pangkat.edit', ['pangkat' => $item->id]) }}"
                                        class="badge p-2 text-white bg-warning"><i class="fas fa-pen "></i></a>
                                    <form action="{{ route('pangkat.destroy', ['pangkat' => $item->id]) }}"
                                        class="d-inline" method="post">
                                        @method('delete')
                                        @csrf
                                        <button class="border-0 badge p-2 text-white bg-danger"><i
                                                class="fas fa-trash "></i></button>
                                    </form>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
