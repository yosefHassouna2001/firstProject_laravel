
@extends('cms.parent')

@section('title', 'Index Admin')
@section('main-title', 'Index Admin')
@section('sub-title', 'Index Admin')

@section('styles')

@endsection

@section('content')

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('admins.create') }}" type="submit" class="btn btn-info">Add New Admin</a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered mb-3">
                            <thead>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>Mobile</th>
                                <th>Gender</th>
                                <th>Status</th>
                                <th>City Name</th>

                                <th>Setting</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($admins as $admin)
                                    <tr>
                                        <td>{{ $admin->id }}</td>
                                        <td>{{ $admin->user->first_name ?? "" }}</td>
                                        <td>{{ $admin->user->last_name ?? "" }}</td>
                                        <td>{{ $admin->email }}</td>
                                        <td>{{ $admin->user->mobile ?? "" }}</td>
                                        <td>{{ $admin->user->gender ?? "" }}</td>
                                        <td>{{ $admin->user->status ?? "" }}</td>
                                        <td><span class="badge bg-info"> {{ $admin->user->city->city_name ?? "" }}</span></td>
                                        
                                        <td >
                                            <div class="btn group w-100 ">
                                                <a href="{{ route('admins.edit' , $admin->id) }}" type="button" class="btn btn-info mb-md-3   ">
                                                <i class="fas fa-edit"></i>
                                                </a>
                                                <a type="button" onclick="performDestroy({{ $admin->id }} , this)" class="btn btn-danger mb-md-3">
                                                <i class="fas fa-trash-alt"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>   
                                @endforeach
                            
                            </tbody>
                        </table>
                        {{ $admins->links() }}
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

@endsection

@section('scripts')

<script>
    function performDestroy(id , referance){
        confirmDestroy('/cms/admin/admins/' + id , referance)
    }
</script>

@endsection