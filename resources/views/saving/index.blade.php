@extends('layout.web')
@section('title', 'User List')
@section('content')

    @component('components.breadcrumb')
        @slot('title')
            Saving Management
        @endslot
        @slot('subtitle')
            Saving List
        @endslot
    @endcomponent
    <div class="row">
        <!-- Table -->
        <div class="col-xxl-12">
            <div class="card card-height-100">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Saving List</h4>
                    <div class="flex-shrink-0">
                        <a href="{{ route('saving.create') }}" type="button"
                            class="btn btn-success btn-icon waves-effect waves-light material-shadow-none"><i
                                class="ri-add-circle-line"></i></a>
                    </div>
                </div><!-- end card header -->

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-nowrap align-middle mb-0">
                            <thead>
                                <tr>
                                    <th scope="col" style="width: 5%;">S.No.</th>
                                    <th scope="col" style="width: 30%;">Full Name</th>
                                    <th scope="col" style="width: 20%;">Withdraw Amount</th>
                                    <th scope="col" style="width: 10%;">Remaining Amount</th>
                                    <th scope="col" style="width: 10%;">Total Amount</th>
                                    <th scope="col" style="width: 20%;">Changed At</th>
                                    <th scope="col" style="width: 30%;">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($savings as $saving)
                                    <tr>
                                        <td>{{ $saving->serial_no }}</td>
                                        <td>{{ $saving->name }}</td>
                                        <td>{{ $saving->email }}</td>
                                        @php
                                            $status = $saving->email_verified_at ? 'Verified' : 'Unverified';
                                            $color = $saving->email_verified_at ? 'success' : 'danger';
                                            $icon = $saving->email_verified_at ? 'ri-checkbox-circle-line':'ri-alert-line';
                                        @endphp
                                        <td><span
                                                class="badge border border-{{ $color }} text-{{ $color }}"><i class="{{ $icon }}"></i>{{ $status }}</span>
                                        </td>
                                        <td><span class="badge bg-success"><i class="ri-shield-user-line"></i> Admin</span></td>
                                        <td>{{ \Carbon\Carbon::parse($saving->created_at)->format('d M, Y') }}</td>
                                        <td>
                                            <a href="{{ route('user.edit', $saving) }}" type="button"
                                                class="btn btn-outline-info btn-icon waves-effect waves-light material-shadow-none"><i
                                                    class="ri-edit-line"></i></a>
                                            <button
                                                class="btn btn-outline-danger btn-icon waves-effect waves-light material-shadow-none remove-item-btn"
                                                data-item-id="{{ $saving->id }}"
                                                data-item-name="{{ $saving->name }}"
                                                data-bs-toggle="modal" data-bs-target="#zoomInModal"><i
                                                    class="ri-delete-bin-line"></i></button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="12" class="text-center">No Result Found</td>
                                    </tr>
                                @endforelse
                            </tbody><!-- end tbody -->
                        </table><!-- end table -->
                        {{ $savings->links('pagination::bootstrap-5') }}
                    </div><!-- end table responsive -->
                </div><!-- end card body -->
            </div><!-- end card -->
        </div><!-- end col -->
        <!-- Table -->
    </div><!-- end row -->
    @include('partials.deleteModal')
@endsection
@section('script')
    <script src="{{ URL::asset('assets/js/app.js') }}"></script>
    <script>
        document.querySelectorAll('.remove-item-btn').forEach(button => {
            button.addEventListener('click', function() {
                var itemId = this.getAttribute('data-item-id');
                var itemName = this.getAttribute('data-item-name');

                //Set the organization Id in the hidden input field
                document.getElementById('delete_item_id').value = itemId;

                //Set the organization name
                document.getElementById('delete_item').textContent = itemName;

                //Set Item Description
                document.getElementById('delete_item_description').innerHTML =
                    'Deleting this item will permanently remove it from the system.';

                var deleteForm = document.getElementById('deleteForm');

                var baseUrl = window.location.origin + window.location.pathname;

                deleteForm.action = baseUrl + '/' + itemId;

            })
        })
    </script>
@endsection
