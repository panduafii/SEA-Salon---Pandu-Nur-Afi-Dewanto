document.addEventListener('DOMContentLoaded', function() {
    fetch('../fetch_reviews.php')
        .then(response => response.json())
        .then(data => {
            const reviewList = document.getElementById('review-list');
            reviewList.innerHTML = '';
            data.forEach(review => {
                const reviewHTML = `
                    <div class="review-item">
                        <h4>${review.customer_name}</h4>
                        <p>Rating: ${review.rating} Stars</p>
                        <p>${review.comment}</p>
                    </div>
                `;
                reviewList.innerHTML += reviewHTML;
            });
        });
});

document.getElementById('review-form').addEventListener('submit', function(event) {
    event.preventDefault();
    const name = document.getElementById('customer-name').value;
    const rating = document.getElementById('star-rating').value;
    const comment = document.getElementById('comment').value;

    fetch('../submit_review.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: `customer_name=${encodeURIComponent(name)}&rating=${encodeURIComponent(rating)}&comment=${encodeURIComponent(comment)}`
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok ' + response.statusText);
        }
        return response.text();
    })
    .then(data => {
        console.log(data);
        if (data.includes("New review submitted successfully")) {
            const reviewHTML = `
                <div class="review-item">
                    <h4>${name}</h4>
                    <p>Rating: ${rating} Stars</p>
                    <p>${comment}</p>
                </div>
            `;
            document.getElementById('review-list').innerHTML += reviewHTML;

            // Clear the form after submission
            document.getElementById('customer-name').value = '';
            document.getElementById('star-rating').value = '1';
            document.getElementById('comment').value = '';
        } else {
            alert("Error submitting review: " + data);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('There was a problem with your submission: ' + error.message);
    });
});
