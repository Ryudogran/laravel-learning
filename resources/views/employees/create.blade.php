@extends('layouts.app')

@section('content')

    <div class="card-header">{{ $employee!=null ? 'EDIT EMPLOYEE':'CREATE EMPLOYEE'}}</div>
        <div class="card-body">
        <input type="hidden" value="{{ ($status!=null)? last($status):"" }}" class="showPopup">

        @if(empty($employee->id))
            <form action="{{ route('employees.store') }}" method="post" enctype="multipart/form-data">
        @else
            <form action="{{ route('employees.update',$employee->id) }}" method="post" enctype="multipart/form-data">
                @method('PATCH')
        @endif

            @csrf
            <div class="form-group">
                    @if($employee!=null)
                        <input type="hidden" value="{{$employee->id}}" name="id">
                    @else
                        <input type="hidden" value="" name="id">
                    @endif
            </div>

            <div class="form-group">
                <label for="first_name">First Name:</label>
                    @if($employee!=null)
                        <input class="form-control" type="text" name="first_name" value="{{ old('first_name')? old('first_name'): $employee->first_name}}" >
                    @else
                        <input class="form-control" type="text" value="{{ old('first_name') }}" name="first_name">
                    @endif
            </div>
            <div class="form-group">
                <label for="last_name">Last Name:</label>
                    @if($employee!=null)
                        <input class="form-control" type="text" value="{{ old('last_name')? old('last_name'): $employee->last_name}}" name="last_name">
                    @else
                        <input class="form-control" type="text" value="{{old('last_name')}}" name="last_name">
                    @endif
            </div>

            <div class="form-group">
                    <label for="email">Email:</label>
                        @if($employee!=null)
                            <input class="form-control" type="email" value="{{ old('email')? old('email'): $employee->email}}" name="email">
                        @else
                            <input class="form-control" type="email" value="{{old('email')}}" name="email">
                        @endif
                </div>

            <div class="form-group">
                <label for="company">Company:</label>
                <select class="custom-select" name="company_id" id="company">
                        <option value="{{$companies->id}}">{{$companies->name}}</option>
                </select>

            </div>
            <div class="form-group">
                <label for="phone">Phone:</label>
                @if($employee!=null)
                    <input class="form-control" type="text" value="{{ old('phone')? old('phone'): $employee->phone}}" name="phone">
                @else
                    <input class="form-control" type="text" value="{{old('phone')}}" name="phone">
                @endif

            </div>

            <button class="btn btn-primary" type="submit"> {{ ($employee!=null)?'Update':'Create' }}</button>
            <button class="btn btn-primary btnViewEmployees" type="button" data-route="{{ $backLink }}">Back to employee List</button>
        </form>
        </div>

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        @if($status!=null)
            @include('layouts.popup')
        @endif


@endsection

@section('js')
    {{-- <script src="{{asset('js/companies.js')}}"> --}}
<script src="{{asset('js/common.js')}}">
</script>
@endsection
