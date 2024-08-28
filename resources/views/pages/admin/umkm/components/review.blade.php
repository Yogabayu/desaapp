<!-- resources/views/partials/reviews.blade.php -->
@foreach ($reviews as $review)
    <div class="mb-3">
        <div class="card bg-light">
            <div class="card-body">
                <p class="mb-1">{{ $review->review }}</p>
                <small class="text-muted">- {{ $review->name }}</small>

                <form action="{{ route('umkmreview.destroy', $review->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm float-right"
                        onclick="return confirm('Are you sure you want to delete this review?')">
                        <i class="fas fa-trash"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
@endforeach