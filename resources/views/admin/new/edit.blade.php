@extends('admin.layouts.admin')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>News Edit</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="">Home</a></li>
                        <li class="breadcrumb-item"><a href="">News</a></li>
                        <li class="breadcrumb-item"><a href="">Edit</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <news-edit
            :data="{{ json_encode([
                'urlUpdate' => route('news.update', $new->id),
                'urlBack' => route('news.index'),
                'categories' => $categories,
                'new' => $new,
            ]) }}">
        </news-edit>
    </section>
@endsection
