@extends('layout.web')
@section('title', 'User List')
@section('content')

    @component('components.breadcrumb')
        @slot('title')
            Saving Management
        @endslot
        @slot('subtitle')
            Saving History {{ $saving->user->name }}
        @endslot
    @endcomponent
    <div class="row">
        <!-- Table -->
        <div class="col-xxl-12">
            <div class="card card-height-100">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Saving History {{ $saving->user->name }}</h4>
                    <div class="flex-shrink-0">
                        <a href="{{ route('saving.index') }}" type="button"
                            class="btn btn-success btn-icon waves-effect waves-light material-shadow-none"><i
                                class="ri-arrow-left-line"></i></a>
                    </div>
                </div><!-- end card header -->

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-nowrap align-middle mb-0">
                            <thead>
                                <tr>
                                    <th scope="col" style="width: 5%;">S.No.</th>
                                    <th scope="col" style="width: 20%;">Amount</th>
                                    <th scope="col" style="width: 10%;">Date</th>
                                    <th scope="col" style="width: 20%;">Type</th>
                                </tr>
                            </thead>

                            <tbody>
                                @php
                                    $histories = $saving->history;
                                    $sno = 1;
                                    $totalAmount = 0;
                                @endphp

                                @forelse ($histories as $history)
                                    <tr>
                                        <td> {{ $sno++ }}</td>
                                        <td>{{ $history->amount }}</td>
                                        <td>{{ \App\Helpers\ConvertToBS::convert($history->date); }}</td>
                                        @php
                                            if ($history->category == 0) {
                                                $color = 'danger';
                                                $type = 'Withdraw';
                                                $totalAmount -= $history->amount;
                                            } elseif ($history->category == 1) {
                                                $color = 'success';
                                                $type = 'Deposit';
                                                $totalAmount += $history->amount;
                                            } elseif ($history->category == 2) {
                                                $color = 'primary';
                                                $type = 'Paid Withdrawal';
                                                $totalAmount += $history->amount;
                                            }
                                        @endphp
                                        <td>
                                            <span class="badge bg-{{ $color }}">{{ $type }}</span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="12" class="text-center">No Result Found</td>
                                    </tr>
                                @endforelse
                                <tr style="border-top: 2px solid grey;">
                                    <td><b>Total</b></td>
                                    <td>{{ $totalAmount }}</td>
                                    @php
                                        $today = now()->subDay(1)->toBS();
                                        $bsDate = \App\Helpers\ConvertToBS::convert($today->date);
                                    @endphp
                                    <td>{{ $bsDate }}</td>
                                    <td><b>Total</b></td>
                                </tr>
                            </tbody><!-- end tbody -->
                        </table><!-- end table -->
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
