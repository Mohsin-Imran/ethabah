<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Under Review Screen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #1b4332;
            color: white;
            font-family: Arial, sans-serif;
        }
        .review-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            text-align: center;
            padding: 20px;
        }
        .review-image img {
            max-width: 100%;
            height: auto;
        }
        .review-heading {
            font-size: 4rem;
            font-weight: bold;
            color: #ccf148;
            margin: 20px 0 10px;
        }
        .review-text {
            font-size: 1.2rem;
            margin-bottom: 10px;
        }
        .review-subtext {
            font-size: 0.9rem;
            color: white;
        }
    </style>
</head>
<body>
    <div class="review-container">
        <div class="review-image">
            <img src="{{ asset('review.png') }}" class="img-fluid" alt="Document Under Review">
        </div>
        <h1 class="review-heading" >Under Review</h1>
        <p class="review-text">Our team reviews and approves the documents to activate the account.</p>
        <p class="review-subtext">It usually takes 24-48 hours to review the document.</p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
