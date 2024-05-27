<?php  
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];
    $xml = new DOMDocument();
    $xml->load('cars.xml');
    $xpath = new DOMXPath($xml);
    $xpathQuery = "/cars/car[@id='$id']";
    $carNode = $xpath->query($xpathQuery)->item(0);
    if ($carNode !== null) {
        $carNode->parentNode->removeChild($carNode);
        $xml->save('cars.xml');
        header("Location: index.php");
        exit();
    } else {
        header("Location: index.php");
        exit();
    }
} else {
    header("Location: index.php");
    exit();
}
?>
