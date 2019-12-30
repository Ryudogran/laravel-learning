@extends('layouts.app')

@section('content')

        <div class="card-header">{{ ($company!=null) ? 'EDIT COMPANY':'CREATE COMPANY'}}</div>
        <div class="card-body">
        <input type="hidden" value="{{ ($status!=null)? last($status):"" }}" class="showPopup">

        @if(empty($company->id))
            <form action="{{ route('companies.store') }}" method="post" enctype="multipart/form-data">
        @else
            <form action="{{ route('companies.update',$company->id) }}" method="post" enctype="multipart/form-data">
                @method('PATCH')
        @endif

            @csrf
            <div class="form-group">
                    @if($company!=null)
                        <input type="hidden" value="{{$company->id}}" name="id">
                    @else
                        <input type="hidden" value="" name="id">
                    @endif
            </div>

            <div class="form-group">
                <label for="name">NAME:</label>
                    @if($company!=null)
                        <input class="form-control" type="text" name="name" value="{{ old('name')? old('name'): $company->name}}" >
                    @else
                        <input class="form-control" type="text" value="{{ old('name') }}" name="name">
                    @endif
            </div>
            <div class="form-group">
                <label for="email">EMAIL:</label>
                    @if($company!=null)
                        <input class="form-control" type="email" value="{{ old('email')? old('email'): $company->email}}" name="email">
                    @else
                        <input class="form-control" type="email" value="{{old('email')}}" name="email">
                    @endif
            </div>
            <div class="form-group">
                @if($company!=null)
                    <img src="{{ Storage::url($company->logo)}}" class="responsive" alt="HINH O DAY">
                @else
                    <img src="{{ Storage::url('company_logo.jpg')}}" class="responsive" alt="HINH O DAY">
                @endif
                <label class="btn btn-primary labelClick" for="logo">CHOOSE LOGO</label>
                <input type="file" class="btn_upload_image" id="logo" name="logo">
            </div>
            <div class="form-group">
                <label for="website">WEBSITE:</label>
                @if($company!=null)
                    <input class="form-control" type="text" value="{{ old('website')? old('website'): $company->website}}" name="website">
                @else
                    <input class="form-control" type="text" value="{{old('website')}}" name="website">
                @endif

            </div>

            <button class="btn btn-primary" type="submit"> {{ ($company!=null)?'Update':'Create' }}</button>
            <button class="btn btn-primary btn-listCompany" type="button" data-route="{{ route('companies.index')}}">Back to Company List</button>
        </form>
        @if($status!=null)
            <input type="hidden" value="{{$sessionMessage}}" class="popupMessage">
            @include('layouts.notification_popup')
        @endif
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




@endsection

@section('js')
    <script src="{{asset('js/common.js')}}"></script>
@endsection
