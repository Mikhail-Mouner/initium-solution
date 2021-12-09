@extends('layouts.app')

@section('css')
    <style>
    </style>
@endsection
@section('content')
    <div class="row">
        <div class="col-sm-12 bg-white">
            <h4 class="info-text">
                List of Hotel Your have already booking them
            </h4>
        </div>
        @foreach($booking as $data)
        @foreach($data->booking_rooms as $item)
            <div class="col-sm-4 mb-2">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">
                            <i class="fa fa-building"></i> {{ $item->room->branch->hotel->hotel_name }}
                        </h4>
                        <p class="card-text">
                            {{ "Branch: {$item->room->branch->branch_name}" }} {{ "Branch: {$item->room->branch->location->location_name}" }}
                            <br />
                            {{ "Floor: {$item->room->floor}" }} {{ "Price: {$item->room->price}" }}
                            <br />
                            {{ "Total: ".($item->room->price * $item->room_no) }} {{ "No of Rooms: {$item->room_no}" }}
                        </p>
                    </div>
                </div>
            </div>
        @endforeach
        @endforeach
    </div>
@endsection
@push('js')
@endpush
