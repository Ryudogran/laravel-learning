@extends('companies.index_layout')

@section('company_index')
<table class="table" id="user-table">
    <thead class="thead-dark">
        <tr>
            <th scope="col" class="w-25 text-center">Name</th>
            <th scope="col" class="w-25 text-center">Logo</th>
            <th scope="col" class="w-25 text-center">
                Website
            </th>
            <th scope="col" class="w-25 text-center">Email</th>
            <th scope="col" class="w-25 text-center">Action</th>
        </tr>
    </thead>
    <tbody>
        @if($companies!==null)
        {{ $companies->links() }}
        @foreach ($companies as $company)
            <tr id='{{'row'.$company->id}}'>
                <input type="hidden" name="id" value="{{$company->id}}" />
                <td class="text-center align-middle">
                    {{$company->name}}
                </td>
                <td class="text-center align-middle">
                    <img src="{{ ($company->logo)!==null ? Storage::url($company->logo) : Storage::url('/company_logo.jpg')}}" class="responsive" alt="HINH O DAY" />
                </td>
                <td class="text-center align-middle">{{$company->website}}</td>
                <td class="text-center align-middle">{{$company->email}}</td>
                <td class="text-center align-middle">
                    <button class="btn btn-primary mb-1 btnEditCompany"
                        data-route="{{ route('companies.edit',$company->id)}}">
                        Edit
                    </button>
                    {{-- <form action="{{ route('companies.destroy',$company->id)}}" method="post">
                        @csrf
                        @method('DELETE') --}}
                        {{-- <button type="submit" class="btn btn-danger mb-1 btnDeleteCompany"> --}}
                        <button type="button" class="btn btn-danger mb-1 btnDeleteCompany" data-message="Do you want to delete {{$company->name}}?">
                            Delete
                        </button>
                    {{-- </form> --}}

                    <button class="btn btn-info btnViewEmployees" data-route="{{ route('employees.index',$company->id) }}">
                        Employees
                    </button>
                </td>
            </tr>
            @endforeach
        @endif
    </tbody>
    <tfoot class="thead-dark">
        <tr>
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
    @if($companies!==null)
        {{ $companies->links() }}
        {{-- POPUP GO HERE --}}
        @include('layouts.popup')
    @endif
@endsection

@section('js')
    <script src="{{asset('js/common.js')}}"></script>
@endsection
