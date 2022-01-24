@php
$setting = \App\Http\Controllers\HomeController::getsetting();
@endphp

@extends('layouts.home')

@section('title', $setting->title)


@section('description')
    {{ $setting->description }}
@endsection

@section('keywords',$setting->keywords)


@section('content')

@include('home._slider')
<!-- Featured News Slider Start -->
<div class="container-fluid pt-3 mb-2">
    <div class="container">
        <div class="section-title">
            <h4 class="m-0 text-uppercase font-weight-bold">Öne Çıkan Bloglar</h4>
        </div>
        <div class="owl-carousel news-carousel carousel-item-4 position-relative">
            @foreach ($daily as $rs)
            <div class="position-relative overflow-hidden" style="height: 300px;">
                <img class="img-fluid h-100" src="{{ Storage::url($rs->image) }}" style="object-fit: cover;">
                <div class="overlay">
                    <div class="mb-2">
                    <a class="badge badge-primary text-uppercase font-weight-semi-bold p-2 mr-2"
                                href="">{{ $rs->category->title }}</a>
                    </div>
                    <a class="h6 m-0 text-white text-uppercase font-weight-semi-bold" href="{{ route('gotoblog',['id'=>$rs->id]) }}">{{ $rs->title }}</a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
<!-- Featured News Slider End -->

<!-- News With Sidebar Start -->
<div class="container-fluid">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-12">
                        <div class="section-title">
                            <h4 class="m-0 text-uppercase font-weight-bold">En Son Çıkan Bloglar</h4>
                        </div>
                    </div>
                    @foreach ($last as $rs )
                    <div class="col-lg-12">
                        <div class="row news-lg mx-0 mb-3">
                            <div class="col-md-6 h-100 px-0">
                                <img class="col-lg-12 img-fluid h-100" src="{{ Storage::url($rs->image) }}" style="object-fit: cover;">
                            </div>
                            
                            <div class="col-md-6 d-flex flex-column border bg-white h-100 px-0">
                                <div class="mt-auto p-4">
                                    <div class="mb-2">
                                        <a class="badge badge-primary text-uppercase font-weight-semi-bold p-2 mr-2"
                                                    href="">{{ $rs->category->title }}</a>
                                    </div>
                                    <a class="h3 d-block mb-3 text-secondary text-uppercase font-weight-bold" href="">{{ $rs->title }}</a>
                                    <p class="m-0">Devamı..</p>
                                </div>
                                <div class="d-flex justify-content-between bg-white border-top mt-auto p-4">
                                    <div class="d-flex align-items-center">
                                        <h6 class="text-info">Yazar : {{ $rs->author_name }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach                   
                </div>
            </div>
        </div>
    </div>
</div>
<!-- News With Sidebar End -->
@endsection