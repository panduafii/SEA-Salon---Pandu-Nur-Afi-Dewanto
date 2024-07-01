<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SEA Salon</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Branded+Hand&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&family=Exo:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container py-5">
        <!-- Header Section -->
        <header class="text-center mb-5">
            <h1>SEA Salon</h1>
            <p class="lead">Beauty and Elegance Redefined</p>

        </header>

        <!-- Services Section -->
        <section id="services">
            <h2 class="mb-3">Services</h2>
            <div class="row">
                <div class="col-md-4" href="login_register.php" onclick="login_register.php">
                    <div class="card mb-4" href="login_register.php">
                        <img src="Image/Haircut2.jpg" class="card-img-top" alt="Haircuts and Styling">
                        <div class="card-body" href="login_register.php">
                            <h5 class="card-title">Haircuts and Styling</h5>
                            <p class="card-text">Get your best look with our expert hairstyling services.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-4" href="login_register.php">
                        <img src="Image/Manicure.jpg" class="card-img-top" alt="Manicure and Pedicure">
                        <div class="card-body" href="login_register.php">
                            <h5 class="card-title">Manicure and Pedicure</h5>
                            <p class="card-text">Experience relaxing and luxurious nail services.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-4" href="login_register.php">
                        <img src="Image/Facial.webp" class="card-img-top" alt="Facial Treatments">
                        <div class="card-body" href="login_register.php">
                            <h5 class="card-title">Facial Treatments</h5>
                            <p class="card-text">Rejuvenate your skin with our specialized facial treatments.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="description">
            <br>
                <h4>Introducing SEA Salon</h4>
                <br>SEA Salon, a rising star in the salon industry, is renowned for its outstanding services and excellent reviews. With a rapidly growing clientele and a stellar reputation, SEA Salon is your premier destination for all your beauty needs.</br></br> 
                   Discover the magic of SEA Salon, where exceptional service meets unparalleled expertise. Our team of talented stylists is dedicated to making you look and feel your best. Whether you're seeking a fresh haircut, a rejuvenating facial, or a luxurious manicure, we offer a wide range of services tailored to meet your unique desires.</br></br>
                   Join our ever-growing community of satisfied customers who have experienced the transformative power of SEA Salon. Our commitment to quality and excellence has earned us rave reviews and a loyal following. At SEA Salon, we believe in creating an extraordinary experience for each and every client.
                   Step into SEA Salon and let us elevate your beauty routine to new heights. Your journey to looking and feeling fabulous begins here. Don't miss out on the exceptional service and stunning results that await you at SEA Salon.
                   Join us today and experience the difference that sets SEA Salon apart.</br></br></p>
                <div class="register" style="background-color: #ffffff;">
                <h6>Reservation Here</h6>
                <a href="login_register.php" class="btn" style="width:130px; color: #ffff !important; background-color: #cddc39 !important;" btn:hoer >Click</a>
                </div>
            </br>
        </section>

        <!-- Review Section -->
        <section id="reviews" class="container">
            <h2>Customer Reviews</h2>
            <div class="row">
                <div class="col-md-6 custom-width-35">
                    <form id="review-form" action="Function/submit_review.php" method="post">
                        <div class="form-group">
                            <label for="customer-name">Name:</label>
                            <input type="text" name="customer_name" id="customer-name" placeholder="Enter your name" required>
                        </div>
                        <div class="form-group">
                            <label for="star-rating">How would you rate our service? (1 to 5):</label>
                            <select name="rating" id="star-rating">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="comment">Your Comment:</label>
                            <textarea name="comment" id="comment" placeholder="Leave a comment"></textarea>
                        </div>
                        <button type="submit">Submit Review</button>
                    </form>
                </div>
                <div class="col-md-6 custom-width-65" id="review-list">
                    <!-- Hasil ulasan akan ditambahkan di sini -->
                </div>
            </div>
        </section>

        <!-- Contact Section -->
        <section id="contact" class="mt-5">
            <h2>Contact Us</h2>
            <p><strong>Thomas</strong>: <a href="tel:+08123456789">08123456789</a></p>
            <p><strong>Sekar</strong>: <a href="tel:+08164829372">08164829372</a></p>
        </section>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            fetch('Function/fetch_review.php')
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

            fetch('Function/submit_review.php', {
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

                    // membersihkan form
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
    </script>
</body>
</html>
