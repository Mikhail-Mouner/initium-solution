@extends('layouts.app')
@section('css')
    <style>
    </style>
@endsection
@section('content')
    <div class="row mt-5">
        <div class="card py-0">
            <div class="m-0 py-3 text-center h3 card-header">
                Cart
            </div>
            <div class="card-body">

                @if(session()->has('mssg'))
                    <div class="alert alert-{{ session()->get('mssg')['status'] }} alert-dismissible" role="alert"
                         id="alert-message">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                        </button>
                        <strong class="text-capitalize">{{ session()->get('mssg')['data'] }} !</strong>
                    </div>
                @endif

                <div class="tabel-response">
                    <table class="table">
                        <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Price * No of rooms</th>
                            <th scope="col">Details Of Room</th>
                            <th scope="col">Hotel/ branch</th>
                            <th scope="col">Controller</th>
                        </tr>
                        </thead>
                        <tbody>

                        @forelse($cart as $data)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ "{$data['room']['price']} * {$data['no']} = ".($data['room']['price'] * $data['no']) }}</td>
                                <td>{!! "Type: {$data['room']['room_type']['type']} <br> Floor: {$data['room']['floor']}" !!}</td>
                                <td>{!! "Hotel: {$data['room']['branch']['hotel']['hotel_name']} <br> Branch: {$data['room']['branch']['branch_name']} <br> Location: {$data['room']['branch']['location']['location_name']}" !!}</td>
                                <td>
                                    <button
                                            data-id="{{ $loop->index }}"
                                            type="button"
                                            class="btn btn-danger btn-sm btn-remove">
                                        Remove
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">Add Item To Cart</td>
                            </tr>
                        @endforelse
                        <tr>
                            <td colspan="5">
                                <a class="btn btn-primary btn-block" href="{{ route('booking') }}" role="button">Checkout</a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div> <!-- row -->

@endsection
@push('js')
<script>
    $('.btn-remove').click(function () {
        $.post(
            '{{ route('remove_item_cart') }}',
            {'index': $(this).data('id'), '_token': '{{ csrf_token() }}' },
            (result) => {
                alert(result.data);
            }
        )
        $(this).parents('tr').remove();
    })
</script>
@endpush
