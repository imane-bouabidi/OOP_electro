<?php
  require_once './dao/commandeDAO.php';
  require_once './commande.php';
$commades = new CommandeDAO();
$commandesDATA = $commades->get_commande();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<body class="bg-white">
    
    <!-- Header Navbar -->
    <?php 
    require 'header.php';
    ?>
    <div class=" relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full mt-44 text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                id
                </th>
                <th scope="col" class="px-6 py-3">
                date creation
                </th>
                <th scope="col" class="px-6 py-3">
                date envoi
                </th>
                <th scope="col" class="px-6 py-3">
                date livraison  
                </th>
                <th scope="col" class="px-6 py-3">
                prix total
                </th>
                <th scope="col" class="px-6 py-3">
                id client
                </th>
                <th scope="col" class="px-6 py-3">
                etat
                </th>
              
                
                <th scope="col" class="px-6 py-3">
                annuler
                </th>
                
                
            </tr>
        </thead>
        <tbody>
          <!-- 
        <td class="px-6 py-4">
               
        </td>
        --->
       <?php
       foreach($commandesDATA as $row){
        ?>
        <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
          <?=$row->getIdcom();?>
        </th>
        <td class="px-6 py-4">
             <?=$row->getDate_creation();?>
        </td>
        <td class="px-6 py-4">
        <?=$row->getDate_envoi();?>
        </td>
        <td class="px-6 py-4">
            <?=$row->getDate_livraison();?> 
        </td>
        <td class="px-6 py-4">
        <?=$row->getPrix_total();?> 
        </td>
        <td class="px-6 py-4">
        <?=$row->getIdclient();?> 
        </td>
        <td class="px-6 py-4">
       
       <form method="GET">
               <select name="selectOption">
               <option value="en attente">en attente</option>
              <option value="en cours">en cours</option>
              <option value="livré">livre</option>
                </select>
              <button  value = '<?=$row->getIdcom();?>' class="bg-blue-500 text-white px-4 py-2 rounded-md "  name = "send" type="submit">Submit</button>
             </form>
        </td>
       
       <td class="px-6 py-4">
        <form method = 'GET'>
          <button class="bg-blue-500 text-white px-4 py-2 rounded-md "  name ="annuler" value = '<?=$row->getIdcom();?>'>annuler</button>
        </form>
       </td>
      
    </tr>
    <?php
    }
    if(isset($_GET['annuler'])){
      $commades->Delete_commande();
    }
    if (isset($_GET['send'])) {
        // $id = $_GET['send'];
        // Get the selected value from the form
        // if (isset($_GET["selectOption"])) {
        //     $selectedValue = $_GET["selectOption"];
        //    mysqli_query($conn,"UPDATE commande set etat = '$selectedValue' where idcom like $id ");
        // } 
      }
    ?>
       
       
        </tbody>
    </table>
</div>
         
</body>
</html>