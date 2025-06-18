@extends('layouts.guest.main')
@section('title')
    UMKM
@endsection

@push('css')
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

@section('content')
    <div class="container my-5">
        <div class="page-title-area bg-1 page-radius">
            <div class="container">
                <div class="page-title-content">
                    <h2 data-aos="fade-up">UMKM Desa</h2>
                </div>
            </div>
        </div>

        <div class="umkm-list mt-5">
            <div class="product-container">
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
                                                        data-id="{{ $product->id }}" data-title="{{ $product->title }}"
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
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
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
        });
    </script>
@endpush
