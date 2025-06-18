@extends('layouts.admin.app')
@section('title', 'Product')
@push('style')
    <link rel="stylesheet" href="{{ asset('admin/library/summernote/dist/summernote-bs4.min.css') }}">
    <style>
        .product-container {
            background: #f8f9fa;
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .category-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 15px 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
        }

        .category-title {
            font-size: 1.25rem;
            font-weight: 600;
            margin: 0;
        }

        .product-count {
            background: rgba(255, 255, 255, 0.2);
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
        }

        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .product-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            border: none;
            position: relative;
        }

        .product-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
        }

        .product-image {
            height: 200px;
            width: 100%;
            object-fit: cover;
            background: #f1f3f4;
        }

        .product-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(to bottom, transparent 0%, rgba(0, 0, 0, 0.7) 100%);
            opacity: 0;
            transition: opacity 0.3s ease;
            display: flex;
            align-items: flex-end;
            padding: 20px;
        }

        .product-card:hover .product-overlay {
            opacity: 1;
        }

        .product-actions {
            display: flex;
            gap: 10px;
        }

        .btn-action {
            padding: 8px 12px;
            border-radius: 8px;
            border: none;
            font-size: 0.85rem;
            font-weight: 500;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .btn-edit {
            background: #4CAF50;
            color: white;
        }

        .btn-delete {
            background: #f44336;
            color: white;
        }

        .product-info {
            padding: 20px;
        }

        .product-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 8px;
            line-height: 1.4;
        }

        .product-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 15px;
        }

        .status-badge {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
        }

        .status-active {
            background: #e8f5e8;
            color: #2e7d32;
        }

        .status-inactive {
            background: #ffebee;
            color: #c62828;
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #6c757d;
        }

        .empty-state i {
            font-size: 4rem;
            margin-bottom: 20px;
            opacity: 0.3;
        }

        .add-product-btn {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            padding: 12px 30px;
            border-radius: 25px;
            color: white;
            font-weight: 600;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
            transition: all 0.3s ease;
        }

        .add-product-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
            color: white;
        }

        .modal-content {
            border-radius: 15px;
            border: none;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
        }

        .modal-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 15px 15px 0 0;
            border-bottom: none;
        }

        .search-filter-bar {
            background: white;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .view-toggle {
            display: flex;
            gap: 10px;
        }

        .view-btn {
            padding: 8px 16px;
            border: 2px solid #e9ecef;
            background: white;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .view-btn.active {
            background: #667eea;
            color: white;
            border-color: #667eea;
        }

        .stats-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .stat-number {
            font-size: 2rem;
            font-weight: bold;
            color: #667eea;
        }

        .stat-label {
            color: #6c757d;
            font-size: 0.9rem;
        }
    </style>
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Product Management</h1>
                <div class="section-header-breadcrumb">
                    <x-breadcrumb />
                </div>
            </div>

            <div class="section-body">
                <div class="stats-row">
                    <div class="stat-card">
                        <div class="stat-number">{{ $categories->sum(function ($cat) {return $cat->products->count();}) }}
                        </div>
                        <div class="stat-label">Total Products</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number">{{ $categories->count() }}</div>
                        <div class="stat-label">Categories</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number">
                            {{ $categories->sum(function ($cat) {return $cat->products->where('status', 1)->count();}) }}
                        </div>
                        <div class="stat-label">Active Products</div>
                    </div>
                </div>

                <div class="search-filter-bar">
                    <div class="row align-items-center">
                        <div class="col-md-4">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search products..."
                                    id="searchInput">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="button">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <select class="form-control" id="categoryFilter">
                                <option value="">All Categories</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 text-right">
                            <button type="button" class="btn add-product-btn" data-toggle="modal"
                                data-target="#insertModal">
                                <i class="fas fa-plus mr-2"></i>Add Product
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Products by Category -->
                <div class="product-container">
                    @forelse($categories as $category)
                        <div class="category-section" data-category="{{ $category->id }}">
                            <div class="category-header">
                                <h3 class="category-title">{{ $category->name }}</h3>
                                <span class="product-count">{{ $category->products->count() }} products</span>
                            </div>

                            @if ($category->products->count() > 0)
                                <div class="product-grid">
                                    @foreach ($category->products as $product)
                                        <div class="product-card" data-title="{{ strtolower($product->title) }}">
                                            <div class="position-relative">
                                                <img src="{{ asset('storage/product/' . $product->thumbnail) }}"
                                                    class="product-image" alt="{{ $product->title }}"
                                                    onerror="this.src='{{ asset('admin/img/news/img01.jpg') }}'">
                                                <div class="product-overlay">
                                                    <div class="product-actions">
                                                        {{-- <button class="btn-action btn-edit" title="Edit Product">
                                                            <i class="fas fa-edit"></i>
                                                        </button> --}}
                                                        <button class="btn-action btn-edit" title="Edit Product"
                                                            data-id="{{ $product->id }}"
                                                            data-title="{{ $product->title }}"
                                                            data-status="{{ $product->status }}"
                                                            data-category="{{ $product->category_id }}"
                                                            data-content="{{ htmlentities($product->content) }}"
                                                            data-thumbnail="{{ $product->thumbnail }}"
                                                            onclick="editProduct(this)">
                                                            <i class="fas fa-edit"></i>
                                                        </button>

                                                        <button class="btn-action btn-delete" title="Delete Product"
                                                            onclick="deleteProduct('{{ $product->id }}')">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-info">
                                                <h5 class="product-title">{{ $product->title }}</h5>
                                                <div class="product-meta">
                                                    <span
                                                        class="status-badge {{ $product->status ? 'status-active' : 'status-inactive' }}">
                                                        {{ $product->status ? 'Active' : 'Inactive' }}
                                                    </span>
                                                    <small
                                                        class="text-muted">{{ $product->created_at->format('M d, Y') }}</small>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="empty-state">
                                    <i class="fas fa-box-open"></i>
                                    <h5>No products in this category</h5>
                                    <p>Start by adding your first product to this category.</p>
                                </div>
                            @endif
                        </div>
                    @empty
                        <div class="empty-state">
                            <i class="fas fa-tags"></i>
                            <h5>No categories found</h5>
                            <p>Create your first category to start organizing products.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </section>
    </div>

    <!-- Insert Product Modal -->
    <div class="modal fade" id="insertModal" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="insertModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="insertModalLabel">
                        <i class="fas fa-plus mr-2"></i>Add New Product
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('product.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="title" class="font-weight-bold">Product Name</label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror"
                                        id="title" name="title" value="{{ old('title') }}" required>
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="status" class="font-weight-bold">Status</label>
                                    <select class="form-control @error('status') is-invalid @enderror" id="status"
                                        name="status" required>
                                        <option value="">Choose status</option>
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="category_id" class="font-weight-bold">Category</label>
                            <div class="input-group">
                                <select class="form-control @error('category_id') is-invalid @enderror" id="category_id"
                                    name="category_id" required>
                                    <option value="">Choose Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                <div class="input-group-append">
                                    <button class="btn btn-outline-primary" type="button" data-toggle="modal"
                                        data-target="#addType" title="Add Category">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                                @error('category_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="content" class="font-weight-bold">Description</label>
                            <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" rows="4">{{ old('content') }}</textarea>
                            @error('content')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="thumbnail" class="font-weight-bold">Product Image</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input @error('thumbnail') is-invalid @enderror"
                                    id="thumbnail" name="thumbnail" accept="image/*" required>
                                <label class="custom-file-label" for="thumbnail">Choose image file</label>
                                @error('thumbnail')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <small class="form-text text-muted">Supported formats: JPG, PNG, GIF. Max size: 2MB</small>
                        </div>

                        <div class="modal-footer border-0 px-0">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                <i class="fas fa-times mr-1"></i>Cancel
                            </button>
                            <button type="submit" class="btn add-product-btn">
                                <i class="fas fa-save mr-1"></i>Save Product
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Product Modal -->
    <div class="modal fade" id="editModal" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">
                        <i class="fas fa-edit mr-2"></i>Edit Product
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editProductForm" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" id="edit_product_id" name="product_id">

                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="edit_title" class="font-weight-bold">Product Name</label>
                                    <input type="text" class="form-control" id="edit_title" name="title" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="edit_status" class="font-weight-bold">Status</label>
                                    <select class="form-control" id="edit_status" name="status" required>
                                        <option value="">Choose status</option>
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="edit_category_id" class="font-weight-bold">Category</label>
                            <select class="form-control" id="edit_category_id" name="category_id" required>
                                <option value="">Choose Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="edit_content" class="font-weight-bold">Description</label>
                            <textarea class="form-control" id="edit_content" name="content" rows="4"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="edit_thumbnail" class="font-weight-bold">Product Image</label>
                            <div class="mb-2" id="current-image-container">
                                <label class="text-muted small">Current Image:</label><br>
                                <img id="current-image" class="current-image" src=""
                                    alt="Current product image">
                            </div>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="edit_thumbnail" name="thumbnail"
                                    accept="image/*">
                                <label class="custom-file-label" for="edit_thumbnail">Choose new image file
                                    (optional)</label>
                            </div>
                            <small class="form-text text-muted">Leave empty to keep current image. Supported formats: JPG,
                                PNG, GIF. Max size: 2MB</small>
                        </div>

                        <div class="modal-footer border-0 px-0">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                <i class="fas fa-times mr-1"></i>Cancel
                            </button>
                            <button type="submit" class="btn add-product-btn">
                                <i class="fas fa-save mr-1"></i>Update Product
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Category Modal -->
    <div class="modal fade" id="addType" tabindex="-1" role="dialog" aria-labelledby="addTypeLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addTypeLabel">
                        <i class="fas fa-tags mr-2"></i>Add New Category
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="addTypeForm">
                        @csrf
                        <div class="form-group">
                            <label for="typeName" class="font-weight-bold">Category Name</label>
                            <input type="text" class="form-control" id="typeName" name="name"
                                placeholder="Enter category name" required>
                        </div>
                        <div class="text-right">
                            <button type="button" class="btn btn-secondary mr-2" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-plus mr-1"></i>Add Category
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('admin/library/summernote/dist/summernote-bs4.min.js') }}"></script>
    <script>
        function editProduct(button) {
            const product = {
                id: $(button).data('id'),
                title: $(button).data('title'),
                status: $(button).data('status'),
                category_id: $(button).data('category'),
                content: $(button).data('content'),
                thumbnail: $(button).data('thumbnail')
            };

            $('#editProductForm')[0].reset();
            $('#edit_content').summernote('code', '');

            $('#edit_product_id').val(product.id);
            $('#edit_title').val(product.title);
            $('#edit_status').val(product.status);
            $('#edit_category_id').val(product.category_id);
            $('#edit_content').summernote('code', $('<div/>').html(product.content).text() || '');

            if (product.thumbnail) {
                $('#current-image').attr('src', `{{ asset('storage/product/') }}/${product.thumbnail}`);
                $('#current-image-container').show();
            } else {
                $('#current-image-container').hide();
            }
            $('#editModal').modal('show');
        }

        function deleteProduct(uuid) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya hapus'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `{{ route('product.destroy', '') }}/${uuid}`,
                        type: 'DELETE',
                        data: {
                            "_token": "{{ csrf_token() }}",
                        },
                        success: function(response) {
                            if (response.success) {
                                toastr.success(response.message);
                                location.reload();
                            } else {
                                toastr.error(response.message);
                            }
                        },
                        error: function(xhr) {
                            console.log(xhr);
                            toastr.error('An error occurred while deleting the gallery.');
                        }
                    });
                }
            });
        }
        $(document).ready(function() {
            $('#content, #edit_content').summernote({
                height: 200,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline', 'clear']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture']],
                    ['view', ['codeview']],
                ],
            });

            // Search functionality
            $('#searchInput').on('keyup', function() {
                const searchTerm = $(this).val().toLowerCase();
                $('.product-card').each(function() {
                    const title = $(this).data('title');
                    if (title.includes(searchTerm)) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            });

            // Category filter
            $('#categoryFilter').on('change', function() {
                const selectedCategory = $(this).val();
                if (selectedCategory === '') {
                    $('.category-section').show();
                } else {
                    $('.category-section').hide();
                    $(`.category-section[data-category="${selectedCategory}"]`).show();
                }
            });
            $('#editProductForm').on('submit', function(e) {
                e.preventDefault();

                const productId = $('#edit_product_id').val();
                const submitBtn = $(this).find('button[type="submit"]');
                const originalText = submitBtn.html();
                submitBtn.html('<i class="fas fa-spinner fa-spin mr-1"></i>Updating...').prop('disabled',
                true);
                
                const formData = new FormData(this);

                $.ajax({
                    url: `{{ route('product.update', '') }}/${productId}`,
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.success) {
                            $('#editModal').modal('hide');
                            toastr.success(response.message);
                            location.reload();
                        } else {
                            toastr.error(response.message || 'Failed to update product');
                        }
                    },
                    error: function(xhr) {
                        console.log(xhr);
                        let errorMessage = 'An error occurred while updating the product';

                        if (xhr.responseJSON && xhr.responseJSON.errors) {
                            const errors = xhr.responseJSON.errors;
                            errorMessage = Object.values(errors).flat().join(', ');
                        }

                        toastr.error(errorMessage);
                    },
                    complete: function() {
                        submitBtn.html(originalText).prop('disabled', false);
                    }
                });
            });
            // File input label update
            $('.custom-file-input').on('change', function() {
                const fileName = $(this)[0].files[0]?.name || 'Choose file';
                $(this).next('.custom-file-label').text(fileName);
            });

            // Add category form
            $('#addTypeForm').on('submit', function(e) {
                e.preventDefault();
                const submitBtn = $(this).find('button[type="submit"]');
                const originalText = submitBtn.html();

                submitBtn.html('<i class="fas fa-spinner fa-spin mr-1"></i>Adding...').prop('disabled',
                    true);

                $.ajax({
                    url: "{{ route('product.addCategory') }}",
                    method: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        if (response.success) {
                            $('#category_id').append(new Option(response.type.name, response
                                .type.id));
                            $('#typeName').val('');
                            $('#addType').modal('hide');
                            toastr.success('Category added successfully!');
                        } else {
                            toastr.error('Failed to add category');
                        }
                    },
                    error: function() {
                        toastr.error('An error occurred while adding category');
                    },
                    complete: function() {
                        submitBtn.html(originalText).prop('disabled', false);
                    }
                });
            });

            // Tooltip initialization
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
@endpush
