@extends('layouts.admin')

@section('header', 'Dashboard')

@section('content')
<div class="row">
    <div class="col-lg-4 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ $totalUsers }}</h3>
                <p>Total User</p>
            </div>
            <div class="icon">
                <i class="fas fa-users"></i>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ $totalRecipes }}</h3>
                <p>Total Resep Dibuat</p>
            </div>
            <div class="icon">
                <i class="fas fa-utensils"></i>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-6">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{ $totalBookmarked }}</h3>
                <p>Resep Di-bookmark</p>
            </div>
            <div class="icon">
                <i class="fas fa-star"></i>
            </div>
        </div>
    </div>
</div>
@endsection