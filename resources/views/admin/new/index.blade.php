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
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="row">
                        <div class="col-8"></div>
                        <div class="col-4">
                            <div class="row" style="">
                                &nbsp;
                                &nbsp;
                                &nbsp;
                                <div class="col-9">
                                    <form action="{{ route('news.index') }}" method="GET">
                                        <input name="search_input" class="form-control " placeholder="Search"
                                            autocomplete="off" id="search_input" value="{{ request('search_input') }}"
                                            type="control">
                                    </form>
                                </div>
                                &nbsp;
                                <div class="col-2">
                                    <a class="btn btn-sm btn-primary" href="{{ route('news.create') }}"
                                        style="float: right; height: 38px; padding-top: 5px; ">Create</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="card">
                        <div class="card-body">
                            @if ($news->count() > 0)
                                <div class="table-responsive-sm table-bordered">
                                    <table class="table  align-items-center table-flush">
                                        <thead class="thead-light">
                                            <tr>
                                                <th class="text-center">ID</th>
                                                <th class="text-center">Category Id</th>
                                                <th class="text-center">Title</th>
                                                <th class="text-center">Image</th>
                                                <th class="text-center">Day Create</th>
                                                <th class="text-center th-120">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($news as $new)
                                                <tr>
                                                    <td class="text-center">
                                                        {{ $new->id }}
                                                    </td>
                                                    <td class="text-center">
                                                        {{ $new->categories_name }}
                                                    </td>
                                                    <td class="text-center">
                                                        {{ $new->title }}
                                                    </td>
                                                    <td class="text-center">
                                                        <img src=" {{ Storage::url($new->image) }}"
                                                            style="width: 60px; height: 60px; object-fit: cover" />
                                                    </td>
                                                    <td class="text-center">
                                                        {{ $new->created_at }}
                                                    </td>
                                                    <td class="text-center">
                                                        <a class="btn btn-sm btn-primary" style="  display: inline-block "
                                                            href="{{ route('news.edit', $new->id) }}">Edit</a>
                                                        <form action="{{ route('news.destroy', $new->id) }}" method="Post"
                                                            style=" margin-left: 10px; display: inline-block ">
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
                                {{ $news->links('pagination::bootstrap-5') }}
                            @else
                                <div class="table-responsive-sm">
                                    <table class="table  align-items-center table-flush">
                                        <thead class="thead-light">
                                            <tr>
                                                <th class="text-center">ID</th>
                                                <th class="text-center">Category Id</th>
                                                <th class="text-center">Title</th>
                                                <th class="text-center">Image</th>
                                                <th class="text-center">Day Create</th>
                                                <th class="text-center th-120">Action</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                                <data-empty></data-empty>
                            @endif
                        </div>              
                    </div>
                    {{ $news->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </section>
@endsection
