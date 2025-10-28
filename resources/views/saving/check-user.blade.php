@extends('layout.web')
@section('title', 'Saving Check User')
@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('content')

    @component('components.breadcrumb')
        @slot('title')
            Saving Management
        @endslot
        @slot('subtitle')
            Saving Check User
        @endslot
    @endcomponent
    <div class="row">
        <!-- Table -->
        <div class="col-xxl-12">
            <div class="card card-height-100">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Saving Check User</h4>
                    <div class="flex-shrink-0">
                        <a href="{{ route('saving.index') }}" type="button"
                            class="btn btn-success btn-icon waves-effect waves-light material-shadow-none"><i
                                class="ri-arrow-left-line"></i></a>
                    </div>
                </div><!-- end card header -->
                <div class="card-body">
                    <form action="{{ route('saving.create') }}" method="GET">
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="user_id" class="form-label">User<span class="text-danger">*</span></label>
                                    @php
                                        $users = App\Models\User::whereNotNull('email_verified_at')->get();
                                    @endphp
                                    <select class="form-select js-example-basic-single" name="user_id" aria-label=".form-select-sm example">
                                        <option selected="">Choose User</option>
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}">{{$user->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('user_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div><!--end col-->
                            <div class="col-lg-12">
                                <div class="text-end">
                                    <button type="submit" class="btn btn-danger">Select</button>
                                </div>
                            </div><!--end col-->
                        </div><!--end row-->
                    </form>
                </div><!-- end card body -->
            </div><!-- end card -->
        </div><!-- end col -->
        <!-- Table -->
    </div><!-- end row -->
@endsection
@section('script')
    <script src="{{ URL::asset('assets/js/app.js') }}"></script>
    <!--select2 cdn-->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script src="{{ URL::asset('assets/js/pages/select2.init.js') }}"></script>
@endsection
