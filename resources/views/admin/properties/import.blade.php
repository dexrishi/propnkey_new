@extends('layouts.admin')

@section('title', 'Import Properties')

@section('content')
<!-- Header -->
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Import Properties from Excel</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="{{ route('properties.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-2"></i>Back to Properties
        </a>
    </div>
</div>

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Upload Excel File</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('properties.import.preview') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="file" class="form-label">Excel File (.xlsx, .xls)</label>
                        <input type="file" class="form-control @error('file') is-invalid @enderror" 
                               id="file" name="file" accept=".xlsx,.xls" required>
                        @error('file')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">Maximum file size: 10MB</div>
                    </div>

                    <div class="alert alert-info">
                        <h6 class="alert-heading">Expected Excel Format:</h6>
                        <p class="mb-0">Your Excel file should have the following columns (A to W):</p>
                        <ul class="mb-0 mt-2">
                            <li><strong>name</strong> - Property name (required)</li>
                            <li><strong>address</strong> - Property address</li>
                            <li><strong>location</strong> - Location name (will be matched to existing locations)</li>
                            <li><strong>locality</strong> - Locality name</li>
                            <li><strong>property_type</strong> - Property type name (will be matched)</li>
                            <li><strong>property_type_2</strong> - Property category or condition name</li>
                            <li><strong>price</strong> - Price (numeric)</li>
                            <li><strong>price_type</strong> - Price type</li>
                            <li><strong>area</strong> - Area in sq ft (numeric)</li>
                            <li><strong>bhk</strong> - BHK value (will be matched to bedroom options)</li>
                            <li><strong>bathroom</strong> - Number of bathrooms</li>
                            <li><strong>status</strong> - Status (active/sold)</li>
                            <li><strong>property_status</strong> - Property status name (will be matched)</li>
                            <li><strong>possession</strong> - Possession date</li>
                            <li><strong>feature_airport</strong> - Airport feature</li>
                            <li><strong>feature_entertainment</strong> - Entertainment feature</li>
                            <li><strong>feature_nh</strong> - National Highway feature</li>
                            <li><strong>feature_hospital</strong> - Hospital feature</li>
                            <li><strong>feature_education</strong> - Education feature</li>
                            <li><strong>rera</strong> - RERA registration number</li>
                            <li><strong>rise</strong> - Rise information</li>
                            <li><strong>rating</strong> - Rating (0-5)</li>
                            <li><strong>review_count</strong> - Review count</li>
                        </ul>
                    </div>

                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-upload me-2"></i>Upload and Preview
                    </button>
                </form>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Import Instructions</h5>
            </div>
            <div class="card-body">
                <ol>
                    <li>Prepare your Excel file with the required columns</li>
                    <li>Upload the file using the form</li>
                    <li>Review the preview and fix any errors</li>
                    <li>Confirm the import to create properties</li>
                </ol>
                
                <div class="alert alert-warning mt-3">
                    <strong>Note:</strong> The import will:
                    <ul class="mb-0">
                        <li>Match location, property type, status, and BHK to existing records</li>
                        <li>Generate slugs automatically</li>
                        <li>Skip rows with errors</li>
                        <li>Show warnings for unmatched relationships</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

