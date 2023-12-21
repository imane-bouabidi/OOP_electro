<?php
  require './dao/usersDAO.php';
  $users = new usersDAO();
  $usersDATA = $users->get_Users();
  $pdo = Database::getInstance()->getConnection();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="assets/css/style_admin.css">
  <script src="https://cdn.tailwindcss.com/"></script>
 
  <!-- <script src="tailwind.config.js"></script> -->
</head>

<body>
<?php

if (isset($_GET["rendre_Admin"])) {
  $id =$_GET["rendre_Admin"];
  $to_admin = $users->User_to_admin($id);
}
if (isset($_GET["verifier"])) {
  $id =$_GET["verifier"];
  $validation = $users->User_validation($id);
}
if (isset($_GET["supprimer_compte"])) {
  $id =$_GET["supprimer_compte"];
  $suppression = $users->Delete_user($id);
}

include('header.php');
?>
  
  <div class="bg-gray-50 min-h-screen" id="content">

    <div>
      <div class="p-4">
        <div class="bg-white p-4 rounded-md">
          <div>
            <h2 class="mb-4 text-xl font-bold text-gray-700">Admin & User</h2>
            <table class="table-auto w-full ">
              <thead class="justify-between bg-gradient-to-tr from-indigo-600 to-purple-600 rounded-md py-2 px-4 text-white font-bold text-md w-full" >
                <tr class="rounded-md" > 
                  <th class="px-4 py-2">Name</th>
                  <th class="px-4 py-2">Email</th>
                  <th class="px-4 py-2">Role</th>
                  <th class="px-4 py-2">Phone</th>
                  <th class="px-4 py-2">Edit</th>
                </tr>
              </thead>
              <tbody><a href=""></a>
                <!-- <form method="post"> -->
                <?php
                foreach ($usersDATA as $user) {
                    echo '
                      <tr>
                        <td class="border px-4 py-2">'.$user->getUsername().'</td>
                        <td class="border px-4 py-2">'.$user->getEmail().'</td>
                        <td class="border px-4 py-2">'.$user->getType().'</td>
                        <td class="border px-4 py-2">'.$user->getPhone().'</td>
                        <td class="border px-4 py-2 flex justify-evenly">
                          <div class="flex items-center space-x-1.5 rounded-lg bg-blue-500 px-4 py-1.5 text-white duration-100 hover:bg-blue-600">
                            <a href="admin.php?rendre_admin='.$user->getId().'"><button class="text-sm" name="rendre_Admin" value="">Rendre admin</button>
                          </div>
                          <div class="flex items-center space-x-1.5 rounded-lg bg-blue-500 px-4 py-1.5 text-white duration-100 hover:bg-blue-600">
                            <a href="admin.php?verifier='.$user->getId().'"><button class="text-sm" name="verifier" value="">Verifier</button>
                          </div>
                          <div class="flex items-center space-x-1.5 rounded-lg bg-blue-500 px-4 py-1.5 text-white duration-100 hover:bg-blue-600">
                            <a href="admin.php?supprimer_compte='.$user->getId().'"><button class="text-sm" name="Supp" value="">Supprimer</button>
                          </div>
                        </td>
                        </tr>
                    ';
                }
                ?>
                <!-- </form> -->
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php 
    include('footer.php');
  ?>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  
  <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
  <script src="roleselect.js"></script>

</body>

</html>
