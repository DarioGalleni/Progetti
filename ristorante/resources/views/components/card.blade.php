<div class="testimonial-card">
    <div class="stars">
        @for ($i = 1; $i <= 5; $i++)
            @if ($i <= floor($stars))
                <i class="fas fa-star"></i>
            @elseif ($i - 0.5 == floor($stars))
                <i class="fas fa-star-half-alt"></i>
            @else
                <i class="far fa-star"></i>
            @endif
        @endfor
    </div>
    <p class="testimonial-text">
        "{{ $text }}"
    </p>
    <div class="d-flex align-items-center">
        <img src="{{ $authorImg }}" alt="{{ $authorName }}" class="rounded-circle me-3" width="50">
        <div>
            <h5 class="testimonial-author mb-0">{{ $authorName }}</h5>
            <small class="testimonial-source">{{ $source }}</small>
        </div>
    </div>
</div>