@extends('homelayout.layout')

@section('title')
    Order List
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card mt-5">
                    <div class="card-header">
                        <h3>Order List</h3>
                    </div>
                    <div class="card-body">
                        @if ($orderlist->isEmpty())
                            <div class="alert alert-danger" role="alert">
                                <h4 class="alert-heading text-center">No Order List</h4>
                                <p class="text-center">There is no data order</p>
                            </div>
                        @else
                            <table class="table" id="tableOrder">
                                <thead>
                                    <tr>
                                        <th scope="col">Booking Date</th>
                                        <th scope="col">Owner</th>
                                        <th scope="col">Vehicle Type</th>
                                        <th scope="col">Vehicle Name</th>
                                        <th scope="col">Transmission</th>
                                        <th scope="col">Request</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orderlist as $order)
                                        <tr>
                                            <td>{{ \Carbon\Carbon::parse($order->date)->format('M d, Y') }}</td>
                                            <td>{{ $order->user->fullname }}</td>
                                            <td>{{ $order->vehicle_type }}</td>
                                            <td>{{ $order->name }}</td>
                                            <td>{{ $order->transmission }}</td>
                                            <td>
                                                @if ($order->notes == null)
                                                    <p>No Request</p>
                                                @else
                                                    <p>{{ $order->notes }}</p>
                                                @endif
                                            </td>
                                            <td>{{ $order->ammount }}</td>
                                            <td>
                                                @if ($order->status == 'stand_by')
                                                    <span class="badge bg-warning text-dark">Stand By</span>
                                                @elseif ($order->status == 'on_process')
                                                    <span class="badge bg-info text-white">On Process</span>
                                                @elseif ($order->status == 'done')
                                                    <span class="badge bg-success text-white">Done</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="" class="btn btn-primary text-white" data-bs-toggle="modal"
                                                    data-bs-target="#modalEditBooking" data-id="{{ $order->id }}"
                                                    data-status="{{ $order->status }}"><i class="fas fa-edit"></i></a>
                                                <form action="{{ route('booking.destroy', $order->id) }}" method="post"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-danger"
                                                        onclick="return confirm('Are you sure?')"><i
                                                            class="fas fa-trash"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
