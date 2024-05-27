<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $brand = $_POST['brand'];
    $model = $_POST['model'];
    $price = $_POST['price'];
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $imgName = $_FILES['image']['name'];
        $imgTmpName = $_FILES['image']['tmp_name'];
        $imgSize = $_FILES['image']['size'];
        $imgError = $_FILES['image']['error'];
        $imgType = $_FILES['image']['type'];

        $imgExt = explode('.', $imgName);
        $imgActualExt = strtolower(end($imgExt));

        $allowed = array('jpg', 'jpeg', 'png', 'gif');

        if (in_array($imgActualExt, $allowed)) {
            if ($imgError === 0) {
                if ($imgSize < 1000000) {
                    $imgNewName = uniqid('', true).".".$imgActualExt;
                    $imgDestination = 'assets/'.$imgNewName;
                    move_uploaded_file($imgTmpName, $imgDestination);
                } else {
                    echo "Your file is too big!";
                    exit();
                }
            } else {
                echo "There was an error uploading your file!";
                exit();
            }
        } else {
            echo "You cannot upload files of this type!";
            exit();
        }
    } else {
        echo "No file uploaded!";
        exit();
    }
    $xml = simplexml_load_file('cars.xml');
    $id = 1;
    foreach ($xml->car as $existingCar) {
        $id = max($id, (int)$existingCar['id'] + 1);
    }
    $car = $xml->addChild('car');
    $car->addAttribute('id', $id);
    $car->addChild('brand', $brand);
    $car->addChild('model', $model);
    $car->addChild('price', $price);
    $car->addChild('image', $imgDestination);
    $dom = new DOMDocument('1.0');
    $dom->preserveWhiteSpace = false;
    $dom->formatOutput = true;
    $dom->loadXML($xml->asXML());
    $formattedXml = $dom->saveXML();
    file_put_contents('cars.xml', $formattedXml);
    header("Location: index.php");
    exit();
}
?>
