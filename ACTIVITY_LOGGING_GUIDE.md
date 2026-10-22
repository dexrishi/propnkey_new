# Activity Logging Guide

This guide explains how to add activity logging to your controllers to track all CRUD operations.

## Overview

The activity logging system automatically records:
- **Create** operations - when new records are created
- **Update** operations - with comparison of old vs new values
- **Delete** operations - with the deleted record data
- **User information** - who performed the action
- **IP address and user agent** - for audit trail

## Quick Start

### Step 1: Add the Trait to Your Controller

```php
use App\Traits\LogsActivity;

class YourController extends AdminBaseController
{
    use LogsActivity;
    
    // ... your methods
}
```

### Step 2: Add Logging to Store Method (Create)

```php
public function store(Request $request)
{
    // Validation...
    
    $model = YourModel::create($request->validated());
    
    // Log the activity
    $this->logCreate($model);
    
    return redirect()->route('your-model.index')
        ->with('success', 'Record created successfully.');
}
```

### Step 3: Add Logging to Update Method

```php
public function update(Request $request, YourModel $model)
{
    // Validation...
    
    // Get old attributes BEFORE update
    $oldAttributes = $this->getOldAttributes($model);
    
    // Update the model
    $model->update($request->validated());
    
    // Log the activity
    $this->logUpdate($model, $oldAttributes);
    
    return redirect()->route('your-model.index')
        ->with('success', 'Record updated successfully.');
}
```

### Step 4: Add Logging to Destroy Method (Delete)

```php
public function destroy(YourModel $model)
{
    // Log BEFORE deletion (so we have the data)
    $this->logDelete($model);
    
    $model->delete();
    
    return redirect()->route('your-model.index')
        ->with('success', 'Record deleted successfully.');
}
```

## Example: Complete Controller

```php
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminBaseController;
use App\Traits\LogsActivity;
use App\Models\Property;
use Illuminate\Http\Request;

class PropertyController extends AdminBaseController
{
    use LogsActivity;

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            // ... other fields
        ]);

        $property = Property::create($validated);
        
        // Log creation
        $this->logCreate($property);

        return redirect()->route('properties.index')
            ->with('success', 'Property created successfully.');
    }

    public function update(Request $request, Property $property)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            // ... other fields
        ]);

        // Get old attributes BEFORE update
        $oldAttributes = $this->getOldAttributes($property);
        
        $property->update($validated);
        
        // Log update with comparison
        $this->logUpdate($property, $oldAttributes);

        return redirect()->route('properties.index')
            ->with('success', 'Property updated successfully.');
    }

    public function destroy(Property $property)
    {
        // Log deletion BEFORE deleting
        $this->logDelete($property);
        
        $property->delete();

        return redirect()->route('properties.index')
            ->with('success', 'Property deleted successfully.');
    }
}
```

## Viewing Activity Logs

Only **super admins** can view activity logs:

1. Navigate to **Activity Logs** in the admin sidebar
2. Filter by:
   - Action (create, update, delete)
   - Model Type
   - User
   - Search term
3. Click **View** on any log to see detailed information including:
   - Full comparison of changes (for updates)
   - Old and new values side by side
   - User who performed the action
   - IP address and timestamp

## Important Notes

1. **Always get old attributes BEFORE updating** - This ensures accurate change tracking
2. **Log deletions BEFORE deleting** - Once deleted, the model data is gone
3. **The trait automatically handles**:
   - User ID (from authenticated user)
   - IP address
   - User agent
   - Model name extraction
   - Change comparison

## Manual Logging (Advanced)

If you need more control, you can use the service directly:

```php
use App\Services\ActivityLogService;

// Log create
ActivityLogService::logCreate($model, $attributes);

// Log update
ActivityLogService::logUpdate($model, $oldValues, $newValues);

// Log delete
ActivityLogService::logDelete($model, $attributes);
```

## Access Control

- **Viewing logs**: Only super admins can access `/activity-logs`
- **Routes**: Protected by `SuperAdminOnly` middleware
- **Sidebar**: Activity Logs menu item only visible to super admins

