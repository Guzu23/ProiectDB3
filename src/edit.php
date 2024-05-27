<?php
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];
    $xml = simplexml_load_file('cars.xml');
    $car = null;
    foreach ($xml->car as $c) {
        if ($c['id'] == $id) {
            $car = $c;
            break;
        }
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $brand = $_POST['brand'];
        $model = $_POST['model'];
        $price = $_POST['price'];
        foreach ($xml->car as $c) {
            if ($c['id'] == $id) {
                $c->brand = $brand;
                $c->model = $model;
                $c->price = $price;
                break;
            }
        }
        $xml->asXML('cars.xml');
        header("Location: index.php");
        exit();
    }
} else {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Car</title>
    <link href="css/styles.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1 class="mt-4">Edit Car</h1>
        <form method="post" action="">
            <input type="hidden" name="id" value="<?php echo $car['id']; ?>">
            <div class="mb-3">
                <label for="brand" class="form-label">Brand:</label>
                <input type="text" class="form-control" id="brand" name="brand" value="<?php echo $car->brand; ?>" required>
            </div>
            <div class="mb-3">
                <label for="model" class="form-label">Model:</label>
                <input type="text" class="form-control" id="model" name="model" value="<?php echo $car->model; ?>" required>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Price:</label>
                <input type="number" class="form-control" id="price" name="price" value="<?php echo $car->price; ?>" required>
            </div>
            
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
