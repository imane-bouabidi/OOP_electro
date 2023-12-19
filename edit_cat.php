<?php
  require './dao/categoriesDAO.php';
  $categories = new CategoriesDAO();
  $id = "";
  $name= "";
  $description= "";
  $image= "";
  $cat_ById = $categories->get_category_ById($_GET['edit']);
  foreach($cat_ById as $cat){
    $id = $cat->getId();
    $name= $cat->getName();
    $description= $cat->getDescription();
  }
  if (isset($_POST['update'])) {
    if (isset($_FILES['imageToUpload']) && isset($_POST['catName'])) {
      move_uploaded_file($_FILES['imageToUpload']['tmp_name'], "assets/image_category/" . $_FILES['imageToUpload']['name']);
      $nameimage = $_FILES['imageToUpload']['name'];
      $categories->update_Category($id,$_POST['catName'],$_POST['catDescription'],$nameimage);
      header('Location:Pagecategories.php');
      exit();
    }
  }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com/"></script>
    <title>Document</title>
</head>
<body>
  <?php 

  include('header.php');
  
  ?>
    
      </div>
      <section class="py-10 bg-gray-100">
        <div class="mx-auto grid max-w-6x gap-6 p-6 w-96">
      <article class="rounded-xl mt-10  bg-white p-3 shadow-lg hover:shadow-xl hover:transform hover:scale-105 duration-300 ">
        <form method="POST" enctype="multipart/form-data">
          <div class="relative flex items-end overflow-hidden rounded-xl">
          
            <input required type="file" name="imageToUpload">
          </div>
  
          <div class="mt-10 p-2">
            <div class="flex">
            
            <input required class="text-slate-700" id="catName" name="catName" placeholder="name de category" value="<?php echo $name; ?>"></input>

            <input required class="text-slate-700" name="catDescription" placeholder="description here" value="<?php echo  $description; ?>"></input>
            
            </div>
            
            <div class="mt-3 flex items-end justify-between">
                
  
              <div class="flex items-center space-x-1.5 rounded-lg bg-blue-500 px-4 py-1.5 text-white duration-100 hover:bg-blue-600">
                <button type="submit" name="submit" value="Submit" class="flex">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-4 w-4">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                </svg>
  
                <a class="text-sm"><button name="update">submit</button></a>
                </button>
              </div>
            </div>
          </div>
        </form>
      </article>
      </div>
      </section>
    
</body>
</html>
