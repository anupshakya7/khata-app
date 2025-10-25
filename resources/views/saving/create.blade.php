@extends('layout.web')
@section('title', 'Saving Create')
@section('content')

    @component('components.breadcrumb')
        @slot('title')
            Saving Management
        @endslot
        @slot('subtitle')
            Saving Create
        @endslot
    @endcomponent
    <div class="row">
        <!-- Table -->
        <div class="col-xxl-12">
            <div class="card card-height-100">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Saving Create</h4>
                    <div class="flex-shrink-0">
                        <a href="{{ route('saving.index') }}" type="button"
                            class="btn btn-success btn-icon waves-effect waves-light material-shadow-none"><i
                                class="ri-arrow-left-line"></i></a>
                    </div>
                </div><!-- end card header -->
                <div class="card-body">
                    <form action="{{ route('saving.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Full Name<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('name') is-invalid  @enderror" name="name" value="{{ old('name') }}" placeholder="Enter your fullname"
                                        id="name">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div><!--end col-->
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email Address<span class="text-danger">*</span></label>
                                    <input type="email" class="form-control @error('email') is-invalid  @enderror" name="email" value="{{ old('email') }}" placeholder="Enter Email Address"
                                        id="email">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div><!--end col-->
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password<span class="text-danger">*</span></label>
                                    <input type="password" class="form-control @error('password') is-invalid  @enderror" name="password" placeholder="Enter Password"
                                        id="password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div><!--end col-->
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="password_confirmation" class="form-label">Confirm Password<span class="text-danger">*</span></label>
                                    <input type="password" class="form-control @error('password_confirmation') is-invalid  @enderror" name="password_confirmation" placeholder="Enter Confirm Password"
                                        id="password_confirmation">
                                    @error('password_confirmation')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div><!--end col-->
                            <div class="col-lg-12">
                                <div class="text-end">
                                    <button type="submit" class="btn btn-danger">Submit</button>
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
@endsection
