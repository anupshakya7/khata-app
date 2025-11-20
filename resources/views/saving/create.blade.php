@extends('layout.web')
@section('title', 'Saving Create')
@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
@endsection
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
                            <div class="col-12">
                                <div class="mb-3">
                                    @php
                                        $user = App\Models\User::find(request('user_id'));
                                    @endphp
                                    <label for="user_id" class="form-label">User<span class="text-danger">*</span></label>
                                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                                    <input type="text" class="form-control @error('user_id') is-invalid  @enderror" value="{{ $user->name }}" id="user_id" readonly>
                                    @error('user_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div><!--end col-->
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="category" class="form-label">Category<span
                                            class="text-danger">*</span></label>
                                    <select class="form-select @error('category') is-invalid  @enderror" name="category" aria-label=".form-select-sm example">
                                        <option value="">Choose Category</option>
                                        <option value="0" {{ old('category') == "0" ? 'selected':'' }}>Withdraw</option>
                                        <option value="1" {{ old('category') == "1" ? 'selected':'' }}>Deposit</option>
                                        <option value="2" {{ old('category') == "2" ? 'selected':'' }}>Paid Withdrawal</option>
                                    </select>
                                    @error('category')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div><!--end col-->
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="amount" class="form-label">Amount<span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('amount') is-invalid  @enderror"
                                        name="amount" value="{{ old('amount') }}" placeholder="Enter Amount" id="amount">
                                    @error('amount')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div><!--end col-->
                              <div class="col-6">
                                <div class="mb-3">
                                    <label for="date" class="form-label">Date<span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('date') is-invalid  @enderror"
                                        name="date" value="{{ old('date') }}" placeholder="Select Date" id="nepali-datepicker">
                                    @error('date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div><!--end col-->
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="note" class="form-label">Notes</label>
                                   <textarea class="form-control" id="note" name="note" placeholder="Notes" rows="3"></textarea>
                                    @error('note')
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
    <!--select2 cdn-->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script src="{{ URL::asset('assets/js/pages/select2.init.js') }}"></script>
    @include('partials.nepali-date')
@endsection
