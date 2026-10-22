@extends('layouts.admin')

@section('title', 'Property Status Details')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Property Status Details</h3>
                    <div class="card-tools">
                        <a href="{{ route('property-statuses.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Back to List
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <table class="table table-borderless">
                                <tr>
                                    <th width="200">ID:</th>
                                    <td>{{ $propertyStatus->id }}</td>
                                </tr>
                                <tr>
                                    <th>Name:</th>
                                    <td>{{ $propertyStatus->name }}</td>
                                </tr>
                                <tr>
                                    <th>Slug:</th>
                                    <td><code>{{ $propertyStatus->slug }}</code></td>
                                </tr>
                                <tr>
                                    <th>Description:</th>
                                    <td>{{ $propertyStatus->description ?: 'No description provided' }}</td>
                                </tr>
                                <tr>
                                    <th>Sort Order:</th>
                                    <td>
                                        <span class="badge bg-secondary">{{ $propertyStatus->sort_order }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Status:</th>
                                    <td>
                                        @if($propertyStatus->is_active)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-danger">Inactive</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Properties Count:</th>
                                    <td>
                                        <span class="badge bg-info">{{ $propertyStatus->properties_count ?? 0 }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Created:</th>
                                    <td>{{ $propertyStatus->created_at->format('M d, Y H:i') }}</td>
                                </tr>
                                <tr>
                                    <th>Updated:</th>
                                    <td>{{ $propertyStatus->updated_at->format('M d, Y H:i') }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Actions</h5>
                                </div>
                                <div class="card-body">
                                    <div class="d-grid gap-2">
                                        <a href="{{ route('property-statuses.edit', $propertyStatus) }}" 
                                           class="btn btn-primary">
                                            <i class="bi bi-pencil"></i> Edit Status
                                        </a>
                                        <form action="{{ route('property-statuses.destroy', $propertyStatus) }}" 
                                              method="POST" 
                                              onsubmit="return confirm('Are you sure you want to delete this property status?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger w-100">
                                                <i class="bi bi-trash"></i> Delete Status
                                            </button>
                                        </form>
                                    </div>
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
