@extends('admin.layouts.app')

@section('title')
Account List
@endsection


@section('content')



<section class="content pt-4">
    <div class="container-fluid">
        <div class="row">


            <div class="col-md-12">

                <div class="card card-cyan">
                    <div class="card-header">
                        <h3 class="card-title">Account List</h3>
                        @can('create account')

                        <a href="{{ route('admin.accounts.create') }}" class="btn btn-success float-right"><i class="fa fa-plus"></i> Add </a>

                        @endcan

                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Account Number</th>
                                    <th>Balance</th>
                                    <th>Image</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $item)
                                @can('view account')
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->phone }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->account_no }}</td>
                                    <td>{{ $item->balance }}</td>
                                    <td>
                                        @if($item->image)
                                        <img src="{{Storage::url($item->image)}}" alt="empty image" width="70px" height="60px" class="mt-2">
                                        @else
                                        <span class="text-danger">Empty Image</span>
                                        @endif
                                    </td>

                                    <td class="text-center">
                                        @if($item->status==1)
                                        <span class="badge btn-info">Active</span>
                                        @else
                                        <span class="badge btn-danger">Deactive</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @can('edit account')
                                        <a href="{{ route('admin.accounts.edit', $item->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                                        @endcan
                                        @can('delete account')
                                        <form id="delete-form-{{ $item->id }}" action="{{ route('admin.accounts.destroy', $item->id) }}" method="POST" style="display: none;">
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