<!-- Blog Admin Dashboard and Page Management (Extending Your Layout) -->
@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row">
         

        <div class="col-md-12">
            <!-- Dashboard Content -->
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Website Admin Dashboard</h4>
                </div>
                <div class="card-body">
                    <p>Welcome, WebAdmin<strong>{{-- auth()->user()->name --}}</strong>!</p>
                    <div class="row text-center">
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5>Total Posts</h5>
                                    <p class="display-4">{{ $postsCount?? 0 }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5>Categories</h5>
                                    <p class="display-4">{{ $categoriesCount?? 0 }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5>Pages</h5>
                                    <p class="display-4">{{-- $pagesCount --}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

             

        </div>
    </div>
</div>
@endsection
