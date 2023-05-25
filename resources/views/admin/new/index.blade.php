@extends('admin.layouts.admin')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>News List</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="">Home</a></li>
                        <li class="breadcrumb-item"><a href="">News</a></li>

                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">All New</h3>
                            <a class="btn btn-sm btn-primary" href="{{ route('news.create') }}"
                                style="float: right;">Create</a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            @if ($news->count() > 0)
                                <div class="table-responsive-sm">
                                    <table class="table  align-items-center table-flush">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>ID</th>
                                                <th>Category Id</th>
                                                <th>Title</th>
                                                <th>Image</th>
                                                <th>Day Create</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($news as $new)
                                                <tr>

                                                    <td>
                                                        {{ $new->id }}

                                                    </td>
                                                    <td>
                                                        {{ $new->categories_name }}

                                                    </td>
                                                    <td>
                                                        {{ $new->title }}

                                                    </td>
                                                    <td>
                                                        <img src=" {{ Storage::url($new->image) }}" style="width: 50px;" />

                                                    </td>
                                                    <td>
                                                        {{ $new->created_at }}

                                                    </td>

                                                    <td>
                                                        <a class="btn btn-sm btn-primary"
                                                            href="{{ route('news.edit', $new->id) }}">Edit</a>
                                                        <form action="{{ route('news.destroy', $new->id) }}" method="Post"
                                                            style="display: inline-block; margin-left: 10px">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="btn btn-sm btn-danger">Delete</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
                                {{ $news->links("pagination::bootstrap-5") }}
                            @else
                                <div class="table-responsive-sm">
                                    <table class="table  align-items-center table-flush">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>ID</th>
                                                <th>Category Id</th>
                                                <th>Title</th>
                                                <th>Image</th>
                                                <th>Day Create</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>

                                    </table>
                                </div>
                                <data-empty></data-empty>
                            @endif


                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
    </section>
@endsection
