
@extends('cms.parent')

@section('title', 'Index Authors')
@section('main-title', 'Index Authors')
@section('sub-title', 'Index Authors')

@section('styles')

@endsection

@section('content')

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('authors.create') }}" type="submit" class="btn btn-info">Add New Authors</a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered mb-3">
                            <thead>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>Author First Name</th>
                                <th>Author Last Name</th>
                                <th>Author Email</th>
                                <th>Author Mobile</th>
                                <th>Author Gender</th>
                                <th>Author Status</th>

                                <th>Setting</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($authors as $author)
                                    <tr>
                                        <td>{{ $author->id }}</td>
                                        <td>{{ $author->first_name }}</td>
                                        <td>{{ $author->last_name }}</td>
                                        <td>{{ $author->email}}</td>
                                        <td>{{ $author->mobile }}</td>
                                        <td>{{ $author->gender }}</td>
                                        <td>{{ $author->status }}</td>

                                        <td style="width: 200px">
                                            <div class="btn group w-100">
                                                <a href="{{ route('authors.edit' , $author->id) }}" type="button" class="btn btn-info">
                                                <i class="fas fa-edit"></i>
                                                </a>
                                                <a type="button" onclick="performDestroy({{ $author->id }} , this)" class="btn btn-danger">
                                                <i class="fas fa-trash-alt"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>   
                                @endforeach
                            
                            </tbody>
                        </table>
                        {{ $authors->links() }}
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
        confirmDestroy('/cms/admin/authors/' + id , referance)
    }
</script>

@endsection