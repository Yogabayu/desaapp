@extends('layouts.admin.app')
@section('title', 'Artikel Desa')
@push('style')
    <link rel="stylesheet" href="{{ asset('admin/library/summernote/dist/summernote-bs4.min.css') }}">
    <style>
        .comment-item {
            border-bottom: 1px solid #e0e0e0;
            padding-bottom: 8px;
        }

        .comment-item:last-child {
            border-bottom: none;
        }

        .comments-container {
            max-height: 400px;
            overflow-y: auto;
            border: 1px solid #e0e0e0;
            border-radius: 4px;
            padding: 10px;
        }
    </style>
@endpush
@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Artikel Desa</h1>
                <div class="section-header-breadcrumb">
                    <x-breadcrumb />
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Artikel Desa</h2>
                <p class="section-lead">Manajemen Artikel seputar desa.</p>

                <hr>

                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-8">
                                <h3>{{ $article->title }}</h3>
                            </div>
                            <div class="col-md-4 text-right">
                                @if ($article->thumbnail)
                                    <img src="{{ asset('storage/article/' . $article->thumbnail) }}" alt="Thumbnail"
                                        class="img-fluid">
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <p class="card-text">{!! $article->content !!}</p>

                        <hr>

                        <div class="row">
                            <div class="col-md-4">
                                <strong>Author:</strong> {{ $article->user->name }}
                            </div>
                            <div class="col-md-4">
                                <strong>Desa:</strong> {{ $article->village->name }}
                            </div>
                            <div class="col-md-4">
                                <strong>Dibuat Pada:</strong> {{ $article->created_at->format('d-m-Y') }}
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-md-12">
                                <h3 class="mb-3">Comments</h3>

                                @if ($comments->count() > 0)
                                    <div class="comments-container">
                                        @foreach ($comments as $comment)
                                            <div class="comment-item">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <span class="comment-author">{{ $comment->name }}</span>
                                                    <span class="comment-date">{{ $comment->created_at->diffForHumans() }}</span>
                                                </div>
                                                <div class="comment-content">{!! $comment->comment !!}</div>
                                                <div class="mt-2">
                                                    <button onclick="toggleShowComment('{{ $comment->id }}')"
                                                        class="{{ $comment->status ? 'btn btn-success btn-sm' : 'btn btn-secondary btn-sm' }}"
                                                        data-toggle="tooltip"
                                                        title="{{ $comment->status ? 'Status: Ditampilkan' : 'Status: Disembunyikan' }}">
                                                        <i
                                                            class="{{ $comment->status ? 'fas fa-eye' : 'fas fa-eye-slash' }}"></i>
                                                    </button>
                                                    <button onclick="deleteComment('{{ $comment->id }}')"
                                                        class="btn btn-danger btn-sm"
                                                        data-toggle="tooltip"
                                                        title="Hapus Comment">
                                                        <i
                                                            class="fa fa-trash"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="mt-4">
                                        {{ $comments->links() }}
                                    </div>
                                @else
                                    <p class="text-muted"><i class="fas fa-comment-slash mr-2"></i>No comments yet.</p>
                                @endif
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-12">
                                <h4>Add Comment</h4>
                                <form action="{{ route('comments.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="article_id" value="{{ $article->id }}">
                                    <div class="form-group">
                                        <textarea name="contentComment" id="contentComment" class="form-control" rows="3"
                                            placeholder="Write your comment..."></textarea>
                                    </div>
                                    <div class="form-group">
                                        <select class="form-control @error('status') is-invalid @enderror" id="status"
                                            name="status">
                                            <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>Draft
                                            </option>
                                            <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>Published
                                            </option>
                                        </select>
                                        @error('status')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-sm">Post Comment</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('admin/library/summernote/dist/summernote-bs4.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#contentComment').summernote({
                height: 200,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline', 'clear']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['codeview']],
                    ['fontsize', ['fontsize']],
                ],
                fontSizes: ['8', '10', '12', '14', '16', '18', '20', '22', '24', '26', '28', '30', '32',
                    '36'
                ],
            });
        });

        function deleteComment(id) {            
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
                        url: `{{ route('comments.destroy', '') }}/${id}`,
                        type: 'DELETE',
                        data: {
                            "_token": "{{ csrf_token() }}",
                        },
                        success: function(response) {
                            if (response.success) {
                                toastr.success(response.message);
                                window.location.reload(); 
                            } else {
                                toastr.error(response.message);
                            }
                        },
                        error: function(xhr) {
                            toastr.error('An error occurred while deleting the gallery.');
                        }
                    });
                }
            });
        }

        function toggleShowComment(commentId) {
            // Send an AJAX request to update the is_show status
            $.ajax({
                url: "{{ route('comments.toggle-show') }}",
                method: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    comment_id: commentId,
                },
                success: function(response) {
                    if (response.status) {
                        location.reload();
                    } else {
                        alert('Error updating gallery status.');
                    }
                },
                error: function(error) {
                    console.error(error);
                    alert('An error occurred. Please try again later.');
                }
            });
        }
    </script>
@endpush
