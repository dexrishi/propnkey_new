@extends('layouts.admin')

@section('title', 'Import Preview - Properties')

@section('content')
<!-- Header -->
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Import Preview</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="{{ route('properties.import') }}" class="btn btn-outline-secondary me-2">
            <i class="bi bi-arrow-left me-2"></i>Back to Upload
        </a>
        <a href="{{ route('properties.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-list me-2"></i>Properties List
        </a>
    </div>
</div>

<div class="row mb-3">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-md-3">
                        <div class="border rounded p-3">
                            <h3 class="mb-0">{{ $totalRows }}</h3>
                            <small class="text-muted">Total Rows</small>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="border rounded p-3">
                            <h3 class="mb-0 text-success">{{ $totalRows - $errorsCount }}</h3>
                            <small class="text-muted">Valid Rows</small>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="border rounded p-3">
                            <h3 class="mb-0 text-danger">{{ $errorsCount }}</h3>
                            <small class="text-muted">Rows with Errors</small>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="border rounded p-3">
                            @if($errorsCount == 0)
                                <form action="{{ route('properties.import.process') }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-success">
                                        <i class="bi bi-check-circle me-2"></i>Import All
                                    </button>
                                </form>
                            @else
                                <button type="button" class="btn btn-success" disabled>
                                    <i class="bi bi-x-circle me-2"></i>Fix Errors First
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@if($errorsCount > 0)
<div class="alert alert-warning">
    <strong>Warning:</strong> {{ $errorsCount }} row(s) have errors and will be skipped during import. Please review and fix them.
</div>
@endif

<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Preview Data</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive" style="max-height: 600px; overflow-y: auto;">
            <table class="table table-striped table-hover">
                <thead class="table-light sticky-top">
                    <tr>
                        <th>Row</th>
                        <th>Name</th>
                        <th>Location</th>
                        <th>Property Type</th>
                        <th>Price</th>
                        <th>Area</th>
                        <th>Status</th>
                        <th>Errors</th>
                        <th>Warnings</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($previewData as $item)
                    <tr class="{{ !empty($item['errors']) ? 'table-danger' : (!empty($item['warnings']) ? 'table-warning' : '') }}">
                        <td><strong>{{ $item['row'] }}</strong></td>
                        <td>{{ $item['data']['name'] ?? '-' }}</td>
                        <td>{{ $item['data']['location_name'] ?? '-' }}</td>
                        <td>{{ $item['data']['property_type_name'] ?? '-' }}</td>
                        <td>{{ $item['data']['price'] ?? '-' }}</td>
                        <td>{{ $item['data']['area_sq_ft'] ?? '-' }}</td>
                        <td>{{ $item['data']['status'] ?? '-' }}</td>
                        <td>
                            @if(!empty($item['errors']))
                                <ul class="mb-0 text-danger small">
                                    @foreach($item['errors'] as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            @else
                                <span class="text-success">✓</span>
                            @endif
                        </td>
                        <td>
                            @if(!empty($item['warnings']))
                                <ul class="mb-0 text-warning small">
                                    @foreach($item['warnings'] as $warning)
                                        <li>{{ $warning }}</li>
                                    @endforeach
                                </ul>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@if($errorsCount == 0)
<div class="mt-3">
    <form action="{{ route('properties.import.process') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-primary btn-lg">
            <i class="bi bi-check-circle me-2"></i>Confirm and Import {{ $totalRows }} Properties
        </button>
    </form>
</div>
@endif
@endsection

