<?php
require_once './dao/comm_prdDAO.php';

$facture = new ProCommandeDAO();
$factureDATA = $facture->get_factureDATA(3);
$total = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facture de Commande</title>
    <!-- Ajoutez le lien vers le fichier CSS de Tailwind -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>
<body class="bg-gray-100">
<?php 
    require 'header.php';
?>
<div class="pt-28 pb-16">
    <div class="max-w-screen-lg mx-auto p-8 bg-white shadow-md ">

        <!-- En-tête de la facture -->
        <div class="flex justify-between items-center border-b-2 pb-4 mb-6">
            <h1 class="text-3xl font-semibold">Facture de Commande</h1>
            <div class="text-gray-600">
            </div>
        </div>

        <!-- Détails de la commande -->
        <div class="mb-8">
            <h2 class="text-xl font-semibold mb-2">Détails de la Commande</h2>
            <table class="w-full">
                <thead>
                    <tr>
                        <th class="text-left">Produit</th>
                        <th class="text-left">Quantité</th>
                        <th class="text-right">Prix unitaire</th>
                        <th class="text-right">Total</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Ajoutez ici les lignes du tableau avec les détails des produits -->
                    <?php
                    foreach($factureDATA as $row){
                        $total+= $row->getTotal();
                            echo '
                            <tr>
                                <td>'.$row->getName().'</td>
                                <td>'.$row->getQuantity().'</td>
                                <td class="text-right">'.$row->getPrix_final().'</td>
                                <td class="text-right">'.$row->getTotal().'</td>
                            </tr>';
                    }
                ?>
                </tbody>
                <tfoot>
                    <!-- Ligne pour le total -->
                    <tr>
                        <td colspan="3" class="text-right font-semibold">Total</td>
                        <td class="text-right font-semibold"><?php echo $total; ?></td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <!-- Informations du client -->
        <div class="mb-8">
            <h2 class="text-xl font-semibold mb-2">Remplissez vos coordonnées s'il vous plais : </h2>
            <form action="facture.php" method="post">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="nom" class="block text-sm font-medium text-gray-600">Nom Complet</label>
                        <input required type="text" id="nom" name="nom" class="form-input mt-1 block w-full" required>
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-600">E-mail</label>
                        <input required type="email" id="email" name="email" class="form-input mt-1 block w-full" required>
                    </div>
                    <div>
                        <label for="telephone" class="block text-sm font-medium text-gray-600">Numéro de Téléphone</label>
                        <input required type="tel" id="telephone" name="telephone" class="form-input mt-1 block w-full" required>
                    </div>
                </div>
                <!-- Bouton de validation -->
                <div class="flex justify-end">
                    <button name="valider" type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Valider la Commande</button>
                </div>
            </form>
        </div>


    </div>
</div>
    <?php 
        include('footer.php');
    ?>
</body>
</html>
