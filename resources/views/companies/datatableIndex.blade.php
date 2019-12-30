@extends('companies.index_layout')

@section('company_index')
<table class="table table-bordered" id="user-table">
    <thead class="thead-dark">
        <tr>
            <th scope="col" class="text-center" style="width: 10%">#</th>
            <th scope="col" class="w-25 text-center">Name</th>
            <th scope="col" class="w-25 text-center">Logo</th>
            <th scope="col" class="w-25 text-center">
                Website
            </th>
            <th scope="col" class="w-25 text-center">Email</th>
            <th scope="col" class="w-25 text-center">Action</th>
        </tr>
    </thead>
    <tfoot class="thead-dark">
        <tr>
            <th scope="col" class="text-center" style="width: 10%">#</th>
            <th scope="col" class="w-25 text-center">Name</th>
            <th scope="col" class="w-25 text-center">Logo</th>
            <th scope="col" class="w-25 text-center">
                Website
            </th>
            <th scope="col" class="w-25 text-center">Email</th>
            <th scope="col" class="w-25 text-center">Action</th>
        </tr>
    </tfoot>
</table>

    {{-- POPUP GO HERE --}}
    @include('layouts.popup')
@endsection

@section('js')
<link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js" defer></script>
<script src="{{asset('js/common.js')}}"></script>
<script>
    $(function() {
        $('#user-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route('companies.dataTable') !!}',
            columnDefs: [
                {"targets": [-1],"orderable": false},
                {"className": "text-center align-middle", "targets": "_all"},
            ],
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'name', name: 'name' },
                { data: 'logo', name: 'logo' },
                { data: 'website', name: 'website' },
                { data: 'email', name: 'email' },
                { data: 'action', name: 'action' },
            ],
        });

    });
    </script>
@endsection
