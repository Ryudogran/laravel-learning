@extends('layouts.app')

@section('content')
<div class="card-header">Employee</div>
<div class="card-body">
    <p>
        <button class="btn btn-success btnCreateEmployee" data-route="{{ route('employees.create') }}">
            Create new employee
        </button>
        <button class="btn btn-success btnCreateEmployee" data-route="{{ route('companies.index') }}">
                Back to List Company
        </button>
        <a href="{{ route('download',$company->id)}}" class="btn btn-info">Export All Employees to Excel file</a>

    </p>
    <div class="card">
        <div class="card-header">Employees List</div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col" class="w-25 text-center">Full Name</th>
                            <th scope="col" class="w-25 text-center">Company</th>
                            <th scope="col" class="w-25 text-center">Phone</th>
                            <th scope="col" class="w-25 text-center">Email</th>
                            <th scope="col" class="w-25 text-center"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($employees as $employee)
                        <tr>
                            <td class="text-center">{{ $employee->full_name}}</td>
                            <td class="text-center">{{ $employee->company->name}}</td>
                            <td class="text-center">{{ $employee->phone}}</td>
                            <td class="text-center">{{ $employee->email}}</td>
                            <td class="text-center">
                                <button class="btn btn-primary mb-1 btnEditEmployee"
                                    data-route="{{ route('employees.edit',$employee->id)}}">
                                    Edit
                                </button>
                                <form action="{{ route('employees.destroy',$employee->id)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                <button type="submit" class="btn btn-danger mb-1 btnDeleteEmployee">
                                    Delete
                                </button>
                            </td>
                        </form>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
    @if (!is_null($employees))
    <div class="text-center">
        {{ $employees->onEachSide(3)->links() }}
    </div>
    @endif

@endsection

@section('js')
<script src="{{asset('js/common.js')}}">

</script>
@endsection
