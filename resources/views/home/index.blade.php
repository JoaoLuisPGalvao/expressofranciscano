@extends('layouts.main')

@section('title', 'Home')

@section('content')

<div class="row-fluid">	    
    <x-card size="col-12 col-xxl-10">
        <x-slot name="header">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="mb-0 fw-bold">Home</h4>
            </div>
        </x-slot>

        <x-slot name="body">
            
        <h5 class="text-center">Aqui será a Home</h5>
                    
        </x-slot>
    </x-card>     
</div>

@endsection