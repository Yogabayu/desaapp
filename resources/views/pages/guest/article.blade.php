@extends('layouts.guest.main')
@section('title')
    Artikel Page
@endsection
@section('css')
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
@endsection

@section('content')
<div class="container my-5">
    <div class="page-title-area bg-1 page-radius">
        <div class="container">
            <div class="page-title-content">
                <h2 data-aos="fade-up">Judul Artikel</h2>
            </div>
        </div>
    </div>

    <div class="article-content mt-5">
        <div class="row">
            <div class="col-lg-8">
                <article>
                    <img src="{{ asset('frontend/assets/images/blog-details/blog-details.jpg') }}" class="img-fluid mb-4" alt="Featured Image" data-aos="fade-up">
                    
                    <p data-aos="fade-up" data-aos-delay="100">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in eros elementum tristique.
                    </p>
                    <p data-aos="fade-up" data-aos-delay="200">
                        Duis cursus, mi quis viverra ornare, eros dolor interdum nulla, ut commodo diam libero vitae erat. Aenean faucibus nibh et justo cursus id rutrum lorem imperdiet.
                    </p>
                    <blockquote class="blockquote" data-aos="fade-up" data-aos-delay="300">
                        <p class="mb-0">"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante."</p>
                    </blockquote>
                    <p data-aos="fade-up" data-aos-delay="400">
                        Fusce at nisi eget dolor rhoncus facilisis. Mauris ante ligula, facilisis sed ornare eu, lobortis in odio. Praesent convallis urna a lacus interdum ut hendrerit risus congue. Nunc sagittis dictum nisi, sed ullamcorper ipsum dignissim ac...
                    </p>
                </article>
                
                <div class="author-info mt-5 p-4 bg-light rounded" data-aos="fade-up">
                    <div class="d-flex align-items-center">
                        <img src="{{ asset('frontend/assets/images/blog-details/comment-1.jpg') }}" class="rounded-circle me-3" alt="Author Image" width="80" height="80">
                        <div>
                            <h5>Author Name</h5>
                            <p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
                        </div>
                    </div>
                </div>
                
                <div class="comments-section mt-5" data-aos="fade-up">
                    <h3 class="mb-4">Comments</h3>
                    <div class="comment mb-3">
                        <div class="d-flex align-items-center">
                            <img src="{{ asset('frontend/assets/images/blog-details/comment-1.jpg') }}" class="rounded-circle me-3" alt="User Image" width="50" height="50">
                            <div>
                                <h6>User Name</h6>
                                <p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                            </div>
                        </div>
                    </div>
                    <div class="comment mb-3">
                        <div class="d-flex align-items-center">
                            <img src="{{ asset('frontend/assets/images/blog-details/comment-1.jpg') }}" class="rounded-circle me-3" alt="User Image" width="50" height="50">
                            <div>
                                <h6>User Name</h6>
                                <p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                            </div>
                        </div>
                    </div>
                    <div class="comment-form mt-5">
                        <h4 class="mb-3">Leave a Comment</h4>
                        <form action="#" method="POST">
                            <div class="mb-3">
                                <label for="comment" class="form-label">Comment</label>
                                <textarea class="form-control" id="comment" rows="4"></textarea>
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
                        <li class="mb-3">
                            <a href="#" class="d-flex align-items-center hover-effect">
                                <img src="{{ asset('frontend/assets/images/blog/blog-1.jpg') }}" class="me-3 rounded-circle" alt="Thumbnail" width="60" height="60">
                                <div>
                                    <h5 class="mb-0">Recent Article 1</h5>
                                    <p class="text-muted mb-0">Short description or excerpt of the article.</p>
                                </div>
                            </a>
                        </li>
                        <li class="mb-3">
                            <a href="#" class="d-flex align-items-center hover-effect">
                                <img src="{{ asset('frontend/assets/images/blog/blog-2.jpg') }}" class="me-3 rounded-circle" alt="Thumbnail" width="60" height="60">
                                <div>
                                    <h5 class="mb-0">Recent Article 2</h5>
                                    <p class="text-muted mb-0">Short description or excerpt of the article.</p>
                                </div>
                            </a>
                        </li>
                        <li class="mb-3">
                            <a href="#" class="d-flex align-items-center hover-effect">
                                <img src="{{ asset('frontend/assets/images/blog/blog-3.jpg') }}" class="me-3 rounded-circle" alt="Thumbnail" width="60" height="60">
                                <div>
                                    <h5 class="mb-0">Recent Article 3</h5>
                                    <p class="text-muted mb-0">Short description or excerpt of the article.</p>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="sidebar" data-aos="fade-up" data-aos-delay="100">
                    <h4 class="mb-4">Most Read</h4>
                    <ul class="list-unstyled">
                        <li class="mb-3">
                            <a href="#" class="d-flex align-items-center hover-effect">
                                <img src="{{ asset('frontend/assets/images/blog/blog-1.jpg') }}" class="me-3 rounded-circle" alt="Thumbnail" width="60" height="60">
                                <div>
                                    <h5 class="mb-0">Recent Article 1</h5>
                                    <p class="text-muted mb-0">Short description or excerpt of the article.</p>
                                </div>
                            </a>
                        </li>
                        <li class="mb-3">
                            <a href="#" class="d-flex align-items-center hover-effect">
                                <img src="{{ asset('frontend/assets/images/blog/blog-2.jpg') }}" class="me-3 rounded-circle" alt="Thumbnail" width="60" height="60">
                                <div>
                                    <h5 class="mb-0">Recent Article 2</h5>
                                    <p class="text-muted mb-0">Short description or excerpt of the article.</p>
                                </div>
                            </a>
                        </li>
                        <li class="mb-3">
                            <a href="#" class="d-flex align-items-center hover-effect">
                                <img src="{{ asset('frontend/assets/images/blog/blog-3.jpg') }}" class="me-3 rounded-circle" alt="Thumbnail" width="60" height="60">
                                <div>
                                    <h5 class="mb-0">Recent Article 3</h5>
                                    <p class="text-muted mb-0">Short description or excerpt of the article.</p>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
