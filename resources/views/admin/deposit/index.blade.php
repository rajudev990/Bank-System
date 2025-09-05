@extends('admin.layouts.app')

@section('title')
Deposit List
@endsection


@section('content')



<section class="content pt-4">
    <div class="container-fluid">
        <div class="row">


            <div class="col-md-12">

                <div class="card card-cyan">
                    <div class="card-header">
                        <h3 class="card-title">Deposit List</h3>
                        @can('create deposit')

                        <a href="{{ route('admin.deposit.create') }}" class="btn btn-success float-right"><i class="fa fa-plus"></i> Add </a>

                        @endcan

                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>User</th>
                                    <th>Deposit Date</th>
                                    <th>Amount</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $item)
                                @can('view deposit')
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->user?->name }}</td>
                                    <td>{{ $item->deposit_date }}</td>
                                    <td>{{ $item->amount }}</td>

                                    <td class="text-center">
                                        @if($item->status==1)
                                        <span class="badge btn-info">Active</span>
                                        @else
                                        <span class="badge btn-danger">Deactive</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @can('edit deposit')
                                        <a href="{{ route('admin.deposit.edit', $item->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                                        @endcan
                                        @can('delete deposit')
                                        <form id="delete-form-{{ $item->id }}" action="{{ route('admin.deposit.destroy', $item->id) }}" method="POST" style="display: none;">
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