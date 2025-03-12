let currentIndex = 0;

function showReview(index) {
    const testimonials = document.querySelector(".testimonial-container");
    const totalReviews = document.querySelectorAll(".testimonial").length;

    if (index >= totalReviews) {
        currentIndex = 0;
    } else if (index < 0) {
        currentIndex = totalReviews - 1;
    } else {
        currentIndex = index;
    }

    testimonials.style.transform = `translateX(${-currentIndex * 100}%)`;
}

function nextReview() {
    showReview(currentIndex + 1);
}

function prevReview() {
    showReview(currentIndex - 1);
}

// Optional: Auto-slide every 5 seconds
// setInterval(nextReview, 5000);
