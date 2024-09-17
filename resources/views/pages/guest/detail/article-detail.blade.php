@extends('layouts.guest.main')
@section('title')
    {{ $article->title }}
@endsection
@push('css')
    <style>
        .hover-effect {
            transition: background-color 0.3s, transform 0.3s;
        }

        .hover-effect:hover {
            background-color: #f8f9fa;
            transform: scale(1.02);
        }

        .hover-effect img {
            border-radius: 50%;
        }

        .sidebar h5 {
            font-size: 16px;
            font-weight: 600;
        }

        .sidebar p {
            font-size: 14px;
        }
    </style>

    <link rel="stylesheet" href="{{ asset('admin/library/summernote/dist/summernote-bs4.min.css') }}">
@endpush

@section('content')
    <div class="container my-5">
        <div class="page-title-area bg-1 page-radius">
            <div class="container">
                <div class="page-title-content">
                    <h2 data-aos="fade-up">{{ $article->title }}</h2>
                </div>
            </div>
        </div>

        <div class="article-content mt-5">
            <div class="row">
                <div class="col-lg-8">
                    <article>
                        @if ($article->thumbnail)
                            <img src="{{ Storage::url('article/' . $article->thumbnail) }}" class="img-fluid mb-4"
                                data-aos="fade-up" alt="{{ $article->title }}">
                        @else
                            <img src="{{ asset('frontend/assets/images/blog-details/blog-details.jpg') }}"
                                class="img-fluid mb-4" alt="Featured Image" data-aos="fade-up">
                        @endif

                        <p data-aos="fade-up" data-aos-delay="100">
                            {!! $article->content !!}
                        </p>
                    </article>

                    <div class="author-info mt-5 p-4 bg-light rounded" data-aos="fade-up">
                        <div class="d-flex align-items-center">
                            <img src="{{ asset('frontend/assets/images/blog-details/comment-1.jpg') }}"
                                class="rounded-circle me-3" alt="Author Image" width="80" height="80">
                            <div>
                                <h5>{{ $article->user->name }}</h5>
                                <p class="mb-0">{{ $article->user->email }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="comments-section mt-5" data-aos="fade-up">
                        <h3 class="mb-4">Comments</h3>

                        @forelse ($reviews as $review)
                            <div class="comment mb-3">
                                <div class="d-flex align-items-center">
                                    <img src="{{ asset('frontend/assets/images/blog-details/comment-1.jpg') }}"
                                        class="rounded-circle me-3" alt="User Image" width="50" height="50">
                                    <div>
                                        <h6>{{ $review->name }}</h6>
                                        <p class="mb-0">{!! $review->comment !!}</p>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="text-center text-muted">Tidak ada komentar saat ini.</p>
                        @endforelse

                        <div class="comment-form mt-5">
                            <h4 class="mb-3">Leave a Comment</h4>
                            <form action="{{ route('article.addComment') }}" method="POST">
                                @csrf
                                <input type="hidden" name="article_id" value="{{ $article->id }}">
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="name">Nama :</label>
                                        <input type="text" class="form-control" id="name" name="name" required>
                                    </div>
                                    <div class="col">
                                        <label for="email">Email :</label>
                                        <input type="email" class="form-control" id="email" name="email" required>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="comment" class="form-label">Comment</label>
                                    <textarea class="form-control" id="comment" name="comment" rows="4"></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>

                {{-- Sidebar --}}
                <div class="col-lg-4 mt-3">
                    <div class="sidebar" data-aos="fade-up" data-aos-delay="100">
                        <h4 class="mb-4">Recent Articles</h4>
                        <ul class="list-unstyled">
                            @forelse ($suggestedArticles as $article)
                                <li class="mb-3">
                                    <a href="{{ route('article.detail', $article->slug) }}" class="d-flex align-items-center hover-effect">
                                        <img src="{{ Storage::url('article/' . $article->thumbnail) }}"
                                            class="me-3 rounded-circle" alt="Thumbnail" width="60" height="60">
                                        <div>
                                            <h5 class="mb-0">{{ $article->title }}</h5>
                                            <p class="text-muted mb-0">{{ $article->publish_date->format('d M Y') }}</p>
                                        </div>
                                    </a>
                                </li>
                            @empty
                                <p class="text-center text-muted">Tidak ada artikel yang tersedia.</p>
                            @endforelse
                        </ul>
                    </div>

                    <div class="sidebar" data-aos="fade-up" data-aos-delay="100">
                        <h4 class="mb-4">Most Read</h4>
                        <ul class="list-unstyled">
                            @forelse ($mostViewedArticles as $article)
                                <li class="mb-3">
                                    <a href="{{ route('article.detail', $article->slug) }}" class="d-flex align-items-center hover-effect">
                                        <img src="{{ Storage::url('article/' . $article->thumbnail) }}"
                                            class="me-3 rounded-circle" alt="Thumbnail" width="60" height="60">
                                        <div>
                                            <h5 class="mb-0">{{ $article->title }}</h5>
                                            <p class="text-muted mb-0">{{ $article->publish_date->format('d M Y') }}</p>
                                        </div>
                                    </a>
                                </li>
                            @empty
                                <p class="text-center text-muted">Tidak ada artikel yang tersedia.</p>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <!-- Now load Summernote -->
    <script src="{{ asset('admin/library/summernote/dist/summernote-bs4.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#comment').summernote({
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
    </script>
@endpush
