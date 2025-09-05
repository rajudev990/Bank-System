@extends('admin.layouts.app')

@section('title')
Send Money List
@endsection


@section('content')



<section class="content pt-4">
    <div class="container-fluid">
        <div class="row">


            <div class="col-md-12">

                <div class="card card-cyan">
                    <div class="card-header">
                        <h3 class="card-title">Send Money List</h3>
                        @can('create sendmoney')

                        <a href="{{ route('admin.send-money.create') }}" class="btn btn-success float-right"><i class="fa fa-plus"></i> Add </a>

                        @endcan

                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>User</th>
                                    <th>Account Name</th>
                                    <th>Reference No</th>
                                    <th>Transaction No</th>
                                    <th>Payment Date</th>
                                    <th>Amount</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $item)
                                @can('view sendmoney')
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->user?->name }}</td>
                                    <td>
                                        @if($item->account_name == 1)
                                        Bank
                                        @elseif($item->account_name == 2)
                                        Bkash
                                        @elseif($item->account_name == 3)
                                        Nagad
                                        @elseif($item->account_name == 4)
                                        PayPal
                                        @elseif($item->account_name == 5)
                                        Rocket
                                        @elseif($item->account_name == 6)
                                        Upay
                                        @elseif($item->account_name == 7)
                                        SureCash
                                        @else
                                        Unknown
                                        @endif
                                    </td>

                                    <td>{{ $item->reference_no }}</td>
                                    <td>{{ $item->transaction_no }}</td>
                                    <td>{{ $item->payment_date }}</td>
                                    <td>{{ $item->amount }}</td>

                                    <td class="text-center">
                                        @if($item->status==1)
                                        <span class="badge btn-info">Active</span>
                                        @else
                                        <span class="badge btn-danger">Deactive</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @can('edit sendmoney')
                                        <a href="{{ route('admin.send-money.edit', $item->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                                        @endcan
                                        @can('delete sendmoney')
                                        <form id="delete-form-{{ $item->id }}" action="{{ route('admin.send-money.destroy', $item->id) }}" method="POST" style="display: none;">
                                            @csrf @method('DELETE')
                                        </form>
                                        <a href="#" class="btn btn-sm btn-danger delete-btn" data-id="{{ $item->id }}"><i class="fa fa-trash"></i></a>
                                        @endcan
                                    </td>
                                </tr>
                                @endcan
                                @endforeach



                            </tbody>

                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>

            </div>



        </div>

    </div>
</section>

@endsection