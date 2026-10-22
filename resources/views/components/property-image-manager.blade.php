@php
    $altTypeOptions = \App\Models\AltType::optionsForSelect();
@endphp
<div class="property-image-manager" data-property-id="{{ $property->id }}">
    <!-- Image Upload Form -->
    <div class="card mb-4">
        <div class="card-header">
            <h6 class="card-title mb-0">Upload Images</h6>
        </div>
        <div class="card-body">
            <form id="imageUploadForm" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-3">
                        <label for="imageType" class="form-label">Image Type <span class="text-danger">*</span></label>
                        <select class="form-select" id="imageType" name="type" required>
                            <option value="">Select Type</option>
                            <option value="logo">Logo</option>
                            <option value="project">Project</option>
                            <option value="floor_plan">Floor Plan</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="altType" class="form-label">Alt Type</label>
                        <select class="form-select" id="altType" name="alt_type">
                            <option value="">Select Alt Type</option>
                            @foreach($altTypeOptions as $slug => $label)
                                <option value="{{ $slug }}">{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="imageCaption" class="form-label">Caption</label>
                        <input type="text" class="form-control" id="imageCaption" name="caption" placeholder="Optional (applied to all)">
                    </div>
                    <div class="col-md-3">
                        <label for="imageFile" class="form-label">Images <span class="text-danger">*</span></label>
                        <input type="file" class="form-control" id="imageFile" name="images[]"
                               accept="image/*" multiple required>
                        <div class="form-text">Select multiple images at once</div>
                    </div>
                </div>
                <div id="multiImagePreview" class="mt-3 d-none">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <small class="text-muted" id="multiImageCount">0 files selected</small>
                        <button type="button" class="btn btn-sm btn-outline-secondary" id="clearImageFiles">Clear</button>
                    </div>
                    <div id="multiImagePreviewList" class="d-flex flex-wrap gap-2"></div>
                </div>
                <div class="mt-3">
                    <button type="submit" class="btn btn-primary" id="uploadBtn">
                        <i class="bi bi-upload me-2"></i>Upload Images
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Images Display -->
    <div class="row">
        <!-- Logo Images -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title mb-0">Logo Images</h6>
                </div>
                <div class="card-body">
                    <div id="logoImages" class="image-gallery" data-type="logo">
                        @if(isset($property) && $property->logos->count() > 0)
                            @foreach($property->logos->sortBy('sort_order') as $image)
                                <div class="image-item" data-id="{{ $image->id }}" style="position: relative;" draggable="true">
                                    <div class="drag-handle" style="position: absolute; top: 5px; right: 5px; background: rgba(0,0,0,0.7); color: white; padding: 2px; border-radius: 3px; cursor: move; z-index: 10;">
                                        <i class="bi bi-grip-vertical"></i>
                                    </div>
                                    <div class="image-wrapper">
                                        <img src="{{ $image->thumbnail_url }}" alt="{{ $image->alt_text }}" class="img-fluid" onerror="this.src='{{ $image->image_url }}'">
                                        <div class="image-overlay">
                                            <div class="image-actions">
                                                <button class="btn btn-sm btn-info" onclick="editImage({{ $image->id }})" title="Edit">
                                                    <i class="bi bi-pencil"></i>
                                                </button>
                                                <button class="btn btn-sm btn-warning" onclick="regenerateThumbnail({{ $image->id }}, this)" title="Regenerate Thumbnail">
                                                    <i class="bi bi-arrow-repeat"></i>
                                                </button>
                                                <button class="btn btn-sm btn-danger" onclick="deleteImage({{ $image->id }})" title="Delete">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="image-info">
                                        <small class="text-muted">{{ $image->caption ?: 'No caption' }}</small>
                                        <div class="image-badges">
                                            @if($image->is_banner)
                                                <span class="badge bg-success">Banner</span>
                                            @endif
                                            @if($image->is_thumbnail)
                                                <span class="badge bg-primary">Thumbnail</span>
                                            @endif
                                            @if($image->is_thumbnail_2)
                                                <span class="badge bg-warning">Thumbnail 2</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="text-center text-muted py-3">
                                <i class="bi bi-image display-6"></i>
                                <p class="mt-2">No logo images</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Project Images -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title mb-0">Project Images</h6>
                </div>
                <div class="card-body">
                    <div id="projectImages" class="image-gallery" data-type="project">
                        @if(isset($property) && $property->projectImages->count() > 0)
                            @foreach($property->projectImages->sortBy('sort_order') as $image)
                                <div class="image-item" data-id="{{ $image->id }}" style="position: relative;" draggable="true">
                                    <div class="drag-handle" style="position: absolute; top: 5px; right: 5px; background: rgba(0,0,0,0.7); color: white; padding: 2px; border-radius: 3px; cursor: move; z-index: 10;">
                                        <i class="bi bi-grip-vertical"></i>
                                    </div>
                                    <div class="image-wrapper">
                                        <img src="{{ $image->thumbnail_url }}" alt="{{ $image->alt_text }}" class="img-fluid" onerror="this.src='{{ $image->image_url }}'">
                                        <div class="image-overlay">
                                            <div class="image-actions">
                                                <button class="btn btn-sm btn-info" onclick="editImage({{ $image->id }})" title="Edit">
                                                    <i class="bi bi-pencil"></i>
                                                </button>
                                                <button class="btn btn-sm btn-warning" onclick="regenerateThumbnail({{ $image->id }}, this)" title="Regenerate Thumbnail">
                                                    <i class="bi bi-arrow-repeat"></i>
                                                </button>
                                                <button class="btn btn-sm btn-danger" onclick="deleteImage({{ $image->id }})" title="Delete">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="image-info">
                                        <small class="text-muted">{{ $image->caption ?: 'No caption' }}</small>
                                        <div class="image-badges">
                                            @if($image->is_banner)
                                                <span class="badge bg-success">Banner</span>
                                            @endif
                                            @if($image->is_thumbnail)
                                                <span class="badge bg-primary">Thumbnail</span>
                                            @endif
                                            @if($image->is_thumbnail_2)
                                                <span class="badge bg-warning">Thumbnail 2</span>
                                            @endif
                                        </div>
                                        <div class="image-controls mt-2">
                                            <div class="btn-group btn-group-sm" role="group">
                                                <button class="btn btn-outline-success" onclick="setAsBanner({{ $image->id }})" title="Set as Banner">
                                                    <i class="bi bi-image"></i>
                                                </button>
                                                <button class="btn btn-outline-primary" onclick="setAsThumbnail({{ $image->id }})" title="Set as Thumbnail">
                                                    <i class="bi bi-image-fill"></i>
                                                </button>
                                                <button class="btn btn-outline-warning" onclick="setAsThumbnail2({{ $image->id }})" title="Set as Thumbnail 2">
                                                    <i class="bi bi-images"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="text-center text-muted py-3">
                                <i class="bi bi-image display-6"></i>
                                <p class="mt-2">No project images</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Floor Plan Images -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title mb-0">Floor Plan Images</h6>
                </div>
                <div class="card-body">
                    <div id="floorPlanImages" class="image-gallery" data-type="floor_plan">
                        @if(isset($property) && $property->floorPlanImages->count() > 0)
                            @foreach($property->floorPlanImages->sortBy('sort_order') as $image)
                                <div class="image-item" data-id="{{ $image->id }}" style="position: relative;" draggable="true">
                                    <div class="drag-handle" style="position: absolute; top: 5px; right: 5px; background: rgba(0,0,0,0.7); color: white; padding: 2px; border-radius: 3px; cursor: move; z-index: 10;">
                                        <i class="bi bi-grip-vertical"></i>
                                    </div>
                                    <div class="image-wrapper">
                                        <img src="{{ $image->thumbnail_url }}" alt="{{ $image->alt_text }}" class="img-fluid" onerror="this.src='{{ $image->image_url }}'">
                                        <div class="image-overlay">
                                            <div class="image-actions">
                                                <button class="btn btn-sm btn-info" onclick="editImage({{ $image->id }})" title="Edit">
                                                    <i class="bi bi-pencil"></i>
                                                </button>
                                                <button class="btn btn-sm btn-warning" onclick="regenerateThumbnail({{ $image->id }}, this)" title="Regenerate Thumbnail">
                                                    <i class="bi bi-arrow-repeat"></i>
                                                </button>
                                                <button class="btn btn-sm btn-danger" onclick="deleteImage({{ $image->id }})" title="Delete">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="image-info">
                                        <small class="text-muted">{{ $image->caption ?: 'No caption' }}</small>
                                        <div class="image-badges">
                                            @if($image->is_banner)
                                                <span class="badge bg-success">Banner</span>
                                            @endif
                                            @if($image->is_thumbnail)
                                                <span class="badge bg-primary">Thumbnail</span>
                                            @endif
                                            @if($image->is_thumbnail_2)
                                                <span class="badge bg-warning">Thumbnail 2</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="text-center text-muted py-3">
                                <i class="bi bi-image display-6"></i>
                                <p class="mt-2">No floor plan images</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Image Edit Modal -->
<div class="modal fade" id="imageEditModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Image</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="imageEditForm">
                    @csrf
                    <input type="hidden" id="editImageId" name="image_id">
                    <div class="mb-3">
                        <label for="editCaption" class="form-label">Caption</label>
                        <input type="text" class="form-control" id="editCaption" name="caption">
                    </div>
                    <div class="mb-3">
                        <label for="editAltType" class="form-label">Alt Type</label>
                        <select class="form-select" id="editAltType" name="alt_type">
                            <option value="">Select Alt Type</option>
                            @foreach($altTypeOptions as $slug => $label)
                                <option value="{{ $slug }}">{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="editIsBanner" name="is_banner">
                            <label class="form-check-label" for="editIsBanner">
                                Set as Banner
                            </label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="editIsThumbnail" name="is_thumbnail">
                            <label class="form-check-label" for="editIsThumbnail">
                                Set as Thumbnail
                            </label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="editIsThumbnail2" name="is_thumbnail_2">
                            <label class="form-check-label" for="editIsThumbnail2">
                                Set as Thumbnail 2
                            </label>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" form="imageEditForm" class="btn btn-primary">Update Image</button>
            </div>
        </div>
    </div>
</div>

<style>
.property-image-manager .image-gallery {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
    gap: 15px;
    min-height: 200px;
}

.image-item {
    position: relative;
    border: 1px solid #dee2e6;
    border-radius: 8px;
    overflow: hidden;
    background: #fff;
}

.image-wrapper {
    position: relative;
    aspect-ratio: 4/3;
    overflow: hidden;
}

.image-wrapper img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.image-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.7);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.image-item:hover .image-overlay {
    opacity: 1;
}

.image-actions {
    display: flex;
    gap: 5px;
}

.image-info {
    padding: 10px;
}

.image-badges {
    margin-top: 5px;
}

.image-badges .badge {
    font-size: 0.7em;
    margin-right: 3px;
}

.image-controls {
    margin-top: 8px;
}

.image-controls .btn-group .btn {
    font-size: 0.8em;
    padding: 0.25rem 0.5rem;
}
</style>

<script>
let currentEditingImageId = null;

document.addEventListener('DOMContentLoaded', function() {
    // Image upload form
    document.getElementById('imageUploadForm').addEventListener('submit', function(e) {
        e.preventDefault();
        uploadImage();
    });
    
    // Image edit form
    document.getElementById('imageEditForm').addEventListener('submit', function(e) {
        e.preventDefault();
        updateImage();
    });

    const imageFileInput = document.getElementById('imageFile');
    const clearImageFilesBtn = document.getElementById('clearImageFiles');
    if (imageFileInput) {
        imageFileInput.addEventListener('change', renderMultiImagePreview);
    }
    if (clearImageFilesBtn) {
        clearImageFilesBtn.addEventListener('click', function () {
            imageFileInput.value = '';
            renderMultiImagePreview();
        });
    }
    
    // Initialize drag and drop sorting for each gallery
    initializeSorting();
});

function renderMultiImagePreview() {
    const input = document.getElementById('imageFile');
    const wrap = document.getElementById('multiImagePreview');
    const list = document.getElementById('multiImagePreviewList');
    const countEl = document.getElementById('multiImageCount');
    if (!input || !wrap || !list || !countEl) {
        return;
    }

    list.innerHTML = '';
    const files = Array.from(input.files || []);
    if (!files.length) {
        wrap.classList.add('d-none');
        countEl.textContent = '0 files selected';
        return;
    }

    wrap.classList.remove('d-none');
    countEl.textContent = files.length + (files.length === 1 ? ' file selected' : ' files selected');

    files.slice(0, 24).forEach(function (file) {
        const item = document.createElement('div');
        item.className = 'border rounded overflow-hidden bg-light';
        item.style.width = '72px';
        item.style.height = '72px';
        item.title = file.name;

        if (file.type.startsWith('image/')) {
            const img = document.createElement('img');
            img.alt = file.name;
            img.style.width = '100%';
            img.style.height = '100%';
            img.style.objectFit = 'cover';
            img.src = URL.createObjectURL(file);
            item.appendChild(img);
        } else {
            item.className += ' d-flex align-items-center justify-content-center small text-muted p-1';
            item.textContent = file.name;
        }
        list.appendChild(item);
    });

    if (files.length > 24) {
        const more = document.createElement('div');
        more.className = 'border rounded d-flex align-items-center justify-content-center small text-muted bg-white';
        more.style.width = '72px';
        more.style.height = '72px';
        more.textContent = '+' + (files.length - 24);
        list.appendChild(more);
    }
}

function initializeSorting() {
    const galleries = document.querySelectorAll('.image-gallery');
    galleries.forEach(gallery => {
        if (gallery.children.length > 1) {
            // Add drag handle to each image item
            gallery.querySelectorAll('.image-item').forEach(item => {
                if (!item.querySelector('.drag-handle')) {
                    const dragHandle = document.createElement('div');
                    dragHandle.className = 'drag-handle';
                    dragHandle.innerHTML = '<i class="bi bi-grip-vertical"></i>';
                    dragHandle.style.cssText = 'position: absolute; top: 5px; right: 5px; background: rgba(0,0,0,0.7); color: white; padding: 2px; border-radius: 3px; cursor: move; z-index: 10;';
                    item.style.position = 'relative';
                    item.appendChild(dragHandle);
                }
            });
            
            // Make gallery sortable
            makeSortable(gallery);
        }
    });
}

function makeSortable(container) {
    let draggedElement = null;
    
    // Add draggable attribute to image items
    container.querySelectorAll('.image-item').forEach(item => {
        item.draggable = true;
    });
    
    container.addEventListener('dragstart', function(e) {
        if (e.target.classList.contains('drag-handle') || e.target.closest('.drag-handle') || e.target.closest('.image-item')) {
            draggedElement = e.target.closest('.image-item');
            e.dataTransfer.effectAllowed = 'move';
            e.dataTransfer.setData('text/html', draggedElement.outerHTML);
            draggedElement.style.opacity = '0.5';
            draggedElement.classList.add('dragging');
        }
    });
    
    container.addEventListener('dragend', function(e) {
        if (draggedElement) {
            draggedElement.style.opacity = '1';
            draggedElement.classList.remove('dragging');
            draggedElement = null;
        }
    });
    
    container.addEventListener('dragover', function(e) {
        e.preventDefault();
        e.dataTransfer.dropEffect = 'move';
    });
    
    container.addEventListener('drop', function(e) {
        e.preventDefault();
        if (draggedElement) {
            const afterElement = getDragAfterElement(container, e.clientY);
            if (afterElement == null) {
                container.appendChild(draggedElement);
            } else {
                container.insertBefore(draggedElement, afterElement);
            }
            
            // Update sort order
            updateSortOrder(container);
        }
    });
}

function getDragAfterElement(container, y) {
    const draggableElements = [...container.querySelectorAll('.image-item:not(.dragging)')];
    
    return draggableElements.reduce((closest, child) => {
        const box = child.getBoundingClientRect();
        const offset = y - box.top - box.height / 2;
        
        if (offset < 0 && offset > closest.offset) {
            return { offset: offset, element: child };
        } else {
            return closest;
        }
    }, { offset: Number.NEGATIVE_INFINITY }).element;
}

function updateSortOrder(container) {
    const images = container.querySelectorAll('.image-item');
    const imageData = [];
    
    images.forEach((item, index) => {
        const imageId = item.dataset.id;
        if (imageId) {
            imageData.push({
                id: imageId,
                sort_order: index + 1
            });
        }
    });
    
    if (imageData.length > 0) {
        const propertyId = document.querySelector('.property-image-manager').dataset.propertyId;
        
        fetch(`/properties/${propertyId}/images/sort`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ images: imageData })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showAlert('Sort order updated successfully!', 'success');
            }
        })
        .catch(error => {
            console.error('Error updating sort order:', error);
            showAlert('Error updating sort order', 'danger');
        });
    }
}

function uploadImage() {
    const form = document.getElementById('imageUploadForm');
    const fileInput = document.getElementById('imageFile');
    const files = Array.from(fileInput?.files || []);
    const propertyId = document.querySelector('.property-image-manager').dataset.propertyId;
    const type = document.getElementById('imageType')?.value;
    const uploadBtn = document.getElementById('uploadBtn');

    if (!type) {
        showAlert('Please select Image Type', 'danger');
        return;
    }
    if (!files.length) {
        showAlert('Please select at least one image', 'danger');
        return;
    }

    const formData = new FormData();
    formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
    formData.append('type', type);
    formData.append('alt_type', document.getElementById('altType')?.value || '');
    formData.append('caption', document.getElementById('imageCaption')?.value || '');
    files.forEach(function (file) {
        formData.append('images[]', file);
    });

    uploadBtn.disabled = true;
    uploadBtn.innerHTML = '<i class="bi bi-hourglass-split me-2"></i>Uploading ' + files.length + '...';
    
    fetch(`/properties/${propertyId}/images/upload`, {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => {
        if (!response.ok) {
            return response.json().catch(function () { return {}; }).then(function (payload) {
                throw new Error(payload.message || ('HTTP error! status: ' + response.status));
            });
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            const uploaded = data.images || (data.image ? [data.image] : []);
            uploaded.forEach(function (image) {
                addImageToGallery(image);
            });
            form.reset();
            renderMultiImagePreview();
            const count = uploaded.length || files.length;
            const failed = data.failed || 0;
            let msg = count + (count === 1 ? ' image uploaded successfully!' : ' images uploaded successfully!');
            if (failed > 0) {
                msg += ' (' + failed + ' failed)';
            }
            showAlert(msg, failed > 0 ? 'warning' : 'success');
            initializeSorting();
        } else {
            showAlert('Error uploading images: ' + (data.message || 'Unknown error'), 'danger');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showAlert('Error uploading images: ' + error.message, 'danger');
    })
    .finally(() => {
        uploadBtn.disabled = false;
        uploadBtn.innerHTML = '<i class="bi bi-upload me-2"></i>Upload Images';
    });
}

function addImageToGallery(image) {
    // Map image types to gallery IDs
    const galleryIdMap = {
        'logo': 'logoImages',
        'project': 'projectImages',
        'floor_plan': 'floorPlanImages'
    };
    
    const galleryId = galleryIdMap[image.type];
    if (!galleryId) {
        console.error('Unknown image type:', image.type);
        return;
    }
    
    const gallery = document.getElementById(galleryId);
    if (!gallery) {
        console.error('Gallery not found:', galleryId);
        return;
    }
    
    // Remove the "no images" message if it exists
    const noImagesMsg = gallery.querySelector('.text-center.text-muted');
    if (noImagesMsg) {
        noImagesMsg.remove();
    }
    
    // Create image HTML with proper URL
    const imageHtml = createImageHtml(image);
    const imageContainer = document.createElement('div');
    imageContainer.innerHTML = imageHtml;
    
    // Append the new image to the gallery
    gallery.appendChild(imageContainer.firstElementChild);
    
    // Re-initialize sorting for this gallery
    initializeSorting();
}

function createImageHtml(image) {
    const badges = [];
    if (image.is_banner) badges.push('<span class="badge bg-success">Banner</span>');
    if (image.is_thumbnail) badges.push('<span class="badge bg-primary">Thumbnail</span>');
    if (image.is_thumbnail_2) badges.push('<span class="badge bg-warning">Thumbnail 2</span>');
    
    // Construct proper image URL
    const imageUrl = image.image_url || `/storage/${image.image_path}`;
    const thumbnailUrl = image.thumbnail_url || imageUrl;
    
    return `
        <div class="image-item" data-id="${image.id}" style="position: relative;" draggable="true">
            <div class="drag-handle" style="position: absolute; top: 5px; right: 5px; background: rgba(0,0,0,0.7); color: white; padding: 2px; border-radius: 3px; cursor: move; z-index: 10;">
                <i class="bi bi-grip-vertical"></i>
            </div>
            <div class="image-wrapper">
                <img src="${thumbnailUrl}" alt="${image.alt_text || image.caption || 'Image'}" class="img-fluid" onerror="this.src='${imageUrl}'">
                <div class="image-overlay">
                    <div class="image-actions">
                        <button class="btn btn-sm btn-info" onclick="editImage(${image.id})" title="Edit">
                            <i class="bi bi-pencil"></i>
                        </button>
                        <button class="btn btn-sm btn-warning" onclick="regenerateThumbnail(${image.id}, this)" title="Regenerate Thumbnail">
                            <i class="bi bi-arrow-repeat"></i>
                        </button>
                        <button class="btn btn-sm btn-danger" onclick="deleteImage(${image.id})" title="Delete">
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="image-info">
                <small class="text-muted">${image.caption || 'No caption'}</small>
                <div class="image-badges">
                    ${badges.join('')}
                </div>
                ${image.type === 'project' ? `
                <div class="image-controls mt-2">
                    <div class="btn-group btn-group-sm" role="group">
                        <button class="btn btn-outline-success" onclick="setAsBanner(${image.id})" title="Set as Banner">
                            <i class="bi bi-image"></i>
                        </button>
                        <button class="btn btn-outline-primary" onclick="setAsThumbnail(${image.id})" title="Set as Thumbnail">
                            <i class="bi bi-image-fill"></i>
                        </button>
                        <button class="btn btn-outline-warning" onclick="setAsThumbnail2(${image.id})" title="Set as Thumbnail 2">
                            <i class="bi bi-images"></i>
                        </button>
                    </div>
                </div>
                ` : ''}
            </div>
        </div>
    `;
}

function editImage(imageId) {
    currentEditingImageId = imageId;
    
    // Fetch image data and populate modal
    fetch(`/properties/images/${imageId}`)
    .then(response => {
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        return response.json();
    })
    .then(data => {
        document.getElementById('editImageId').value = imageId;
        document.getElementById('editCaption').value = data.caption || '';
        const editAltType = document.getElementById('editAltType');
        const altVal = data.alt_type || '';
        if (altVal && ![...editAltType.options].some(function (o) { return o.value === altVal; })) {
            const opt = document.createElement('option');
            opt.value = altVal;
            opt.textContent = altVal.replace(/_/g, ' ');
            editAltType.appendChild(opt);
        }
        editAltType.value = altVal;
        document.getElementById('editIsBanner').checked = data.is_banner || false;
        document.getElementById('editIsThumbnail').checked = data.is_thumbnail || false;
        document.getElementById('editIsThumbnail2').checked = data.is_thumbnail_2 || false;
        
        new bootstrap.Modal(document.getElementById('imageEditModal')).show();
    })
    .catch(error => {
        console.error('Error:', error);
        showAlert('Error loading image data', 'danger');
    });
}

function updateImage() {
    const formData = new FormData(document.getElementById('imageEditForm'));
    
    // Add CSRF token and method override
    formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
    formData.append('_method', 'PUT');
    
    // Convert checkbox values to proper format
    formData.set('is_banner', document.getElementById('editIsBanner').checked ? '1' : '0');
    formData.set('is_thumbnail', document.getElementById('editIsThumbnail').checked ? '1' : '0');
    formData.set('is_thumbnail_2', document.getElementById('editIsThumbnail2').checked ? '1' : '0');
    
    fetch(`/properties/images/${currentEditingImageId}`, {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => {
        if (!response.ok) {
            return response.text().then(text => {
                console.error('Response text:', text);
                throw new Error(`HTTP error! status: ${response.status}`);
            });
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            // Close modal
            const modal = bootstrap.Modal.getInstance(document.getElementById('imageEditModal'));
            modal.hide();
            
            // Refresh the page to show updated data
            location.reload();
        } else {
            showAlert('Error updating image: ' + (data.message || 'Unknown error'), 'danger');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showAlert('Error updating image: ' + error.message, 'danger');
    });
}

function deleteImage(imageId) {
    if (!confirm('Are you sure you want to delete this image?')) {
        return;
    }
    
    fetch(`/properties/images/${imageId}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => {
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            document.querySelector(`[data-id="${imageId}"]`).remove();
            showAlert('Image deleted successfully!', 'success');
        } else {
            showAlert('Error deleting image: ' + (data.message || 'Unknown error'), 'danger');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showAlert('Error deleting image', 'danger');
    });
}

function regenerateThumbnail(imageId, buttonElement = null) {
    if (buttonElement) {
        buttonElement.disabled = true;
        buttonElement.innerHTML = '<i class="bi bi-hourglass-split"></i>';
    }

    fetch(`/properties/images/${imageId}/regenerate-thumbnail`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showAlert(data.message || 'Thumbnail regenerated successfully!', 'success');
            location.reload();
        } else {
            showAlert('Error regenerating thumbnail: ' + (data.message || 'Unknown error'), 'danger');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showAlert('Error regenerating thumbnail', 'danger');
    })
    .finally(() => {
        if (buttonElement) {
            buttonElement.disabled = false;
            buttonElement.innerHTML = '<i class="bi bi-arrow-repeat"></i>';
        }
    });
}

function setAsBanner(imageId) {
    updateImageProperty(imageId, { is_banner: true });
}

function setAsThumbnail(imageId) {
    updateImageProperty(imageId, { is_thumbnail: true });
}

function setAsThumbnail2(imageId) {
    updateImageProperty(imageId, { is_thumbnail_2: true });
}

function updateImageProperty(imageId, properties) {
    console.log('Updating image property:', imageId, properties);
    
    const formData = new FormData();
    Object.keys(properties).forEach(key => {
        formData.append(key, properties[key] ? '1' : '0');
    });
    
    // Add CSRF token
    formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
    formData.append('_method', 'PUT');
    
    fetch(`/properties/images/${imageId}`, {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => {
        console.log('Response status:', response.status);
        if (!response.ok) {
            return response.text().then(text => {
                console.error('Response text:', text);
                throw new Error(`HTTP error! status: ${response.status}`);
            });
        }
        return response.json();
    })
    .then(data => {
        console.log('Response data:', data);
        if (data.success) {
            // Refresh the entire gallery to update all badges
            location.reload();
        } else {
            showAlert('Error updating image: ' + (data.message || 'Unknown error'), 'danger');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showAlert('Error updating image: ' + error.message, 'danger');
    });
}

function updateImageInGallery(image) {
    const imageElement = document.querySelector(`[data-id="${image.id}"]`);
    if (imageElement) {
        // Update badges
        const badgesContainer = imageElement.querySelector('.image-badges');
        const badges = [];
        if (image.is_banner) badges.push('<span class="badge bg-success">Banner</span>');
        if (image.is_thumbnail) badges.push('<span class="badge bg-primary">Thumbnail</span>');
        if (image.is_thumbnail_2) badges.push('<span class="badge bg-warning">Thumbnail 2</span>');
        badgesContainer.innerHTML = badges.join('');
        
        // Update caption
        const captionElement = imageElement.querySelector('.image-info small');
        captionElement.textContent = image.caption || 'No caption';
    }
}

function showAlert(message, type) {
    const alertDiv = document.createElement('div');
    alertDiv.className = `alert alert-${type} alert-dismissible fade show`;
    alertDiv.innerHTML = `
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    `;
    
    document.querySelector('.property-image-manager').insertBefore(alertDiv, document.querySelector('.property-image-manager').firstChild);
    
    setTimeout(() => {
        alertDiv.remove();
    }, 5000);
}
</script>
