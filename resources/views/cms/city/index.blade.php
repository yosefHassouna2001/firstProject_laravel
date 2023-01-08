
@extends('cms.parent')

@section('title', 'Index City')
@section('main-title', 'Index City')
@section('sub-title', 'Index City')

@section('styles')

@endsection

@section('content')

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('cities.create') }}" type="submit" class="btn btn-info">Add New City</a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered mb-3">
                            <thead>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>City Name</th>
                                <th>City street</th>
                                <th>Country Name</th>
                                <th>Setting</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($cities as $city)
                                    <tr>
                                        <td>{{ $city->id }}</td>
                                        <td>{{ $city->city_name }}</td>
                                        <td>{{ $city->street }}</td>
                                        <td><span class="badge bg-info"> {{ $city->country->name }}</span></td>
                                        <td style="width: 200px">
                                            <div class="btn group w-100">
                                                <a href="{{ route('cities.edit' , $city->id) }}" type="button" class="btn btn-info">
                                                <i class="fas fa-edit"></i>
                                                </a>
                                                <a type="button" onclick="performDestroy({{ $city->id }} , this)" class="btn btn-danger">
                                                <i class="fas fa-trash-alt"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>   
                                @endforeach
                            
                            </tbody>
                        </table>
                        {{ $cities->links() }}
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
        confirmDestroy('/cms/admin/cities/' + id , referance)
    }
</script>

@endsection