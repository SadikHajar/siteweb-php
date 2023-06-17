<?php
$imageFolder = "images/";
echo "<link rel='stylesheet' href='styleproduit.css'>";
// Fonction pour récupérer les données des produits depuis un fichier txt
function getProducts()
{
    global $imageFolder;
    $products = array();
    $file = fopen("produit.txt", "r");
    while (($data = fgetcsv($file)) !== false) {
        $product = array(
            "nom" => $data[0],
            "prix" => $data[1],
            "image" => $imageFolder . $data[2]
        );
        $products[] = $product;
    }
    fclose($file);
    return $products;
}

// Fonction pour ajouter un nouveau produit
function addProduct($nom, $prix, $image)
{
    global $imageFolder;
    $products = getProducts();
    $imageName = uniqid() . "_" . $image["name"];
    move_uploaded_file($image["tmp_name"], $imageFolder . $imageName);
    $product = array(
        "nom" => $nom,
        "prix" => $prix,
        "image" => $imageFolder . $imageName
    );
    $products[] = $product;
    saveProducts($products);
}

// en utilise la fonction deleteProduct pour supprimer un produit existant
function deleteProduct($nom)
{
    $products = getProducts();
    foreach ($products as $key => $product) {
        if ($product["nom"] == $nom) {
            //unlink($product["image"]);
            unset($products[$key]);
            //saveProducts($products);
            break;
        }
    }
    saveProducts($products);
}

// en utilise la Fonction saveProducts pour sauvegarder les données des produits dans un fichier txt
function saveProducts($products)
{
    global $imageFolder;
    $file = fopen("produit.txt", "w");
    foreach ($products as $product) {
        $imageName = str_replace($imageFolder, "", $product["image"]);
        fputcsv($file, array($product["nom"], $product["prix"], $imageName));
    }
    fclose($file);
}

// Vérifier si un formulaire a été soumis pour ajouter un nouveau produit
if (isset($_POST["ajouter_produit"])) {
    $nom = $_POST["nom"];

    $prix = $_POST["prix"];
    $image = $_FILES["image"];
    addProduct($nom, $prix, $image);

}

// Vérifier si un formulaire a été soumis pour supprimer un produit existant
if (isset($_POST["supprimer_produit"])) {
    $nom = $_POST["nom"];
    deleteProduct($nom);
}


// Afficher la liste des produits
$products = getProducts();
echo "<section class='trending-product' id='trending'>";
// ajouter un produit
echo "<form method='post' enctype='multipart/form-data'>";

echo "<label for='nom'>Nom:</label>";
echo "<input type='text' id='nom' name='nom' required>";
echo "<br><br>";
echo "<label for='prix'>Prix:</label>";
echo "<input type='number' id='prix' name='prix' min='0' step='0.01' required>";
echo "<br><br>";
echo "<label for='image'>Image:</label>";
echo "<input type='file' id='image' name='image'  required>";
echo "<br><br>";
echo "<input type='submit' name='ajouter_produit' value='Ajouter'>";
echo "<br><br>";
echo "</form>";

// supprimer un produit
echo "<form method='post'>";
//echo "<label for='nom_supprimer'>Nom du produit à supprimer:</label>";
echo "<select name='nom'>";
foreach ($products as $product) {
    echo "<option value='" . $product['nom'] . "'>" . $product['nom'] . "</option>";
}
echo "</select>";
echo "<input type='submit' name='supprimer_produit' value='Supprimer'>";
echo "</form>";
echo "<div class='center-text'>";
echo "<h2>Liste des <span>produits</span></h2>";
echo "</div>";
echo "<div class='products'>";


foreach ($products as $product) {
    echo "<div class='row'>
    <img src='" . $product["image"] . "'>
    <div class='price'>
    <h4>" . $product["nom"] . "</h4>
    <p>Prix: " . $product["prix"] . " €</p>
    </div>
    </div>";
}
echo "</div>
</div>
</section>";


?>