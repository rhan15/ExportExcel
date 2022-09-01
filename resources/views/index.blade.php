@extends('app-layout')
@section('content')
    <div class="text-center pt-5">
        <h1>DATA TABLE</h1>
    </div>
    <div class="row">
        <div class="d-flex justify-content-center p-5">
            <table id="table-dummy" class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Email</th>
                        {{-- <th>Kota</th> --}}
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
    <div class="text-center ">
        <h1>IMPORT & EXPORT EXCELL</h1>
    </div>
    <div class="row">
        <div class="d-flex justify-content-center p-5">
            <div class="col-md-10">

                @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-block">
                            <strong>{{ $message }}</strong>
                    </div>
                @endif

                @if ($message = Session::get('error'))
                    <div class="alert alert-danger alert-block">
                            <strong>{{ $message }}</strong>
                    </div>
                @endif

                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <form method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="d-flex justify-content-center pb-4">
                                        <div class="h4">Import User</div>
                                    </div>
                                    <label>Pilh File</label>
                                    <div class="custom-file">
                                        <input required type="file" class="form-control" name="file" id="customFile">
                                    </div>
                                    <label style="font-size: 10px">Tipe file : csv,xls,xlsx</label>
                                    <div class="d-flex justify-content-center pb-5">
                                        <button id="tarif-import" type="submit" class="btn btn-primary" formaction="{{ route('import.user') }}">Import Tarif</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="d-flex justify-content-center pb-4">
                                    <div class="h4">Export User</div>
                                </div>
                                <div class="d-flex justify-content-center pb-5">
                                    <a class="btn btn-primary" href="{{ route('export.user') }}">Export Tarif</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            var datatable;
            $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
            });

            $(function() {
                datatable = $('#table-dummy').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{url()->current()}}",
                    columns: [
                        {data: 'DT_RowIndex'},
                        {data: 'name'},
                        {data: 'email'},
                        {data: 'action'},
                    ],
                });
            });
        });
    </script>
@endpush
