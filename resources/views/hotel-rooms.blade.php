@extends('layouts.app')
@section('css')
    <style>
    </style>
@endsection
@section('content')
    <div class="row mt-5">
        <div class="card py-0">
            <div class="m-0 py-3 text-center h3 card-header">
                List of Rooms: {{ "{$branch_rooms->hotel->hotel_name} - {$branch_rooms->branch_name}" }}
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
                            <th scope="col">Price</th>
                            <th scope="col">Floor</th>
                            <th scope="col">Room Type</th>
                            <th scope="col">Controller</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($branch_rooms->rooms as $data)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $data->price }}</td>
                                <td>{{ "Floor: {$data->floor}" }}</td>
                                <td>{{ $data->roomType->type}}</td>
                                <td>
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-primary btn-sm booking-room-btn"
                                            data-floor="{{ $data->floor }}"
                                            data-type="{{ $data->roomType->type }}"
                                            data-price="{{ $data->price }}"
                                            data-id="{{ $data->id }}"
                                            data-toggle="modal"
                                            data-target="#modelId">
                                        Book Room
                                    </button>

                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div> <!-- row -->

    <!-- Modal -->
    <form action="{{ route('add_to_cart') }}" method="post">
        @csrf
        <div class="modal fade" id="modelId" tabindex="-1" role="dialog"
             aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ "{$branch_rooms->hotel->hotel_name} - {$branch_rooms->branch_name}" }}</h5>
                        <button type="button" class="close" data-dismiss="modal"
                                aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <h4 id="model-info"></h4>
                            <input type="hidden" name="room_price" id="room-price" required>
                            <input type="hidden" name="room_id" id="room-id" required>
                            <div class="form-group">
                                <label for="room-no">No. of Room Do You Want To Booking</label>
                                <input type="number" step="1" min="1" value="1" required
                                       class="form-control" name="room_no" id="room-no" aria-describedby="helpId">
                                <small id="helpId" class="form-text text-muted">Total : <span id="model-total"></span>
                                </small>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-sm">Booking</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
@push('js')
<script>
    $('.booking-room-btn').click(function () {
        let floor = $(this).data('floor');
        let type = $(this).data('type');
        let price = $(this).data('price');
        let room_id = $(this).data('id');

        $('#model-info').html(`Floor: ${floor} - Type: ${type} - Price: ${price}`);
        $('#room-price').val(price);
        $('#room-id').val(room_id);
        $('#model-total').html(`${price}`);
        $('#room-no').val(1)
    });

    $('#room-no').change(function () {
        let room_price = $('#room-price').val();
        let room_no = $('#room-no').val();

        $('#model-total').html(`${room_price * room_no}`);
    });

</script>
@endpush
