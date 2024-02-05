<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>OLX get price service</title>

    <!-- Підключення файлів Bootstrap через CDN -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">OLX get price service</h4>
            <form method="POST" action="services/subscribe.php">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" placeholder="Enter your email" id="email" name="email">
                </div>
                <div class="form-group">
                    <label for="olx_url">URL OLX Product</label>
                    <input type="url" class="form-control" placeholder="Enter URL per OLX product" id="olx_url" name="olx_url">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Subscribe</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Підключення файлів Bootstrap через CDN -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>
</html>
