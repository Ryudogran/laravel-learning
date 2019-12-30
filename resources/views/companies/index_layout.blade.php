@extends('layouts.app') @section('content')

<div class="card-header">Companies</div>
<div class="card-body">
    <p>
        <button class="btn btn-success btnCreateCompany" data-route="{{ route('companies.create') }}">
            Create new company
        </button>
    </p>
    <div class="card">
        <div class="card-header">Company List</div>
        <div class="card-body">
            <div class="table-responsive">
                @yield('company_index')
            </div>
        </div>
    </div>
</div>
@endsection


