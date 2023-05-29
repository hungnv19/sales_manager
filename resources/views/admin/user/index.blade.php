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
                                    <form action="{{ route('user.index') }}" method="GET">
                                        <input name="search_input" class="form-control " placeholder="Search"
                                            autocomplete="off" id="search_input" value="{{ request('search_input') }}"
                                            type="control">
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
                                <div class="table table-responsive-sm table-bordered">
                                    <table class="table align-items-center table-flush">
                                        <thead class="thead-light">
                                            <tr>
                                                <th class="text-center">ID</th>
                                                <th class="text-center">Name</th>
                                                <th class="text-center">Email</th>
                                                <th class="th-120 text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($users as $user)
                                                @if ($user->role === 0)
                                                    <tr>
                                                        <td class="text-center">
                                                            {{ $user->id }}
                                                        </td>
                                                        <td class="text-center">
                                                            {{ $user->name }}
                                                        </td>
                                                        <td class="text-center">
                                                            {{ $user->email }}
                                                        </td>
                                                        <td class="text-center">
                                                            <a class="btn btn-sm btn-primary"
                                                                href="{{ route('user.edit', $user->id) }}">Edit</a>
                                                            <form action="{{ route('user.destroy', $user->id) }}"
                                                                method="Post" style="display: inline-block">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    style=" margin-left: 10px; display: inline-block "
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
                                <div class="table table-responsive-sm table-bordered">
                                    <table class="table align-items-center table-flush">
                                        <thead class="thead-light">
                                            <tr>
                                                <th class="text-center">ID</th>
                                                <th class="text-center">Name</th>
                                                <th class="text-center">Email</th>
                                                <th class="th-120 text-center">Action</th>
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
