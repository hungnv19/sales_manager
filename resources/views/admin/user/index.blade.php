@extends('admin.layouts.admin')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>User List</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="">Home</a></li>
                        <li class="breadcrumb-item"><a href="">User</a></li>
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
                    <div class="row">
                        <div class="col-8"></div>
                        <div class="col-4">
                            <div class="row" style="">
                                &nbsp;
                                &nbsp;
                                &nbsp;
                                <div class="col-9">
                                    <form action="{{ route('user.index') }}" method="GET">
                                        <input name="search_input" class="form-control " placeholder="Search"
                                            autocomplete="off" id="search_input" value="" type="control">
                                    </form>
                                </div>
                                &nbsp;
                                <div class="col-2">
                                    <a class="btn btn-sm btn-primary" href="{{ route('user.create') }}"
                                        style="float: right; height: 38px; padding-top: 5px; ">Create</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="card">

                        <div class="card-body">
                            @if ($users->count() > 0)
                                <div class="table-responsive-sm">
                                    <table class="table align-items-center table-flush">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($users as $user)
                                                @if ($user->role === 0)
                                                    <tr>

                                                        <td>
                                                            {{ $user->id }}

                                                        </td>
                                                        <td>
                                                            {{ $user->name }}

                                                        </td>
                                                        <td>
                                                            {{ $user->email }}

                                                        </td>
                                                        <td>
                                                            <a class="btn btn-sm btn-primary"
                                                                href="{{ route('user.edit', $user->id) }}">Edit</a>
                                                            <form action="{{ route('user.destroy', $user->id) }}"
                                                                method="Post"
                                                                style="display: inline-block; margin-left: 10px">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    class="btn btn-sm btn-danger">Delete</button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="table-responsive-sm">
                                    <table class="table align-items-center table-flush">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                                <data-empty></data-empty>
                            @endif



                        </div>
                    </div>
                    {{ $users->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </section>
@endsection
