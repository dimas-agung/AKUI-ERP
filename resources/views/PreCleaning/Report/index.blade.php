@extends('layouts.master1')
@section('menu')
    Pre Celaning
@endsection
@section('title')
    Pre Celaning Report
@endsection
@section('content')
    <div class="col-md-12">
        <div class="card border border-primary border-3">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <h4 class="card-title">Pre Celaning Report</h4>
                </div>
            </div>
            <div class="card-body col-12">
                <div class="row">
                    <div class="col-6 col-lg-3 col-md-6">
                        <button class="button-card" onclick="window.location='{{ route('PreCleaningReport.input') }}'">
                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-center">
                                        <div class="stats-icon blue mb-2">
                                            <i class="bi-box-arrow-in-right"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                        <h6 class="text-muted font-semibold">Input</h6>
                                        <h6 class="font-extrabold mb-0">Pre Celaning</h6>
                                    </div>
                                </div>
                            </div>
                        </button>
                    </div>
                    <div class="col-6 col-lg-3 col-md-6">
                        <button class="button-card" onclick="window.location='{{ route('PreCleaningReport.stock') }}'">
                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                        <div class="stats-icon green mb-2">
                                            <i class="bi-box-seam-fill"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                        <h6 class="text-muted font-semibold">Stock</h6>
                                        <h6 class="font-extrabold mb-0">Pre Celaning</h6>
                                    </div>
                                </div>
                            </div>
                        </button>
                    </div>
                    <div class="col-6 col-lg-3 col-md-6">
                        <button class="button-card" onclick="window.location='{{ route('PreCleaningReport.output') }}'">
                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                        <div class="stats-icon red mb-2">
                                            <i class="bi-box-arrow-left"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                        <h6 class="text-muted font-semibold">Output</h6>
                                        <h6 class="font-extrabold mb-0">Pre Celaning</h6>
                                    </div>
                                </div>
                            </div>
                        </button>
                    </div>
                    <div class="col-6 col-lg-3 col-md-6">
                        <button class="button-card" onclick="window.location='{{ route('PreCleaningReport.transit') }}'">
                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                        <div class="stats-icon purple mb-2">
                                            <i class="bi-server"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                        <h6 class="text-muted font-semibold">Transit</h6>
                                        <h6 class="font-extrabold mb-0">Pre Celaning</h6>
                                    </div>
                                </div>
                            </div>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
