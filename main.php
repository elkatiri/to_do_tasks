<?php
session_start();
include_once "db.php";
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $task=$_POST["task"];
        $date=date("Y-m-d");
        #create the statement
        $stm=$conn->prepare("INSERT INTO `todo`(`ladate`, `liste`) VALUES (:datee,:task)");
        $stm->bindParam(':datee',$date);
        $stm->bindParam(":task",$task);
        $stm->execute();
        $_SESSION["add_data"]="the data has added successflly !";
        
    }
    $sql="select * from todo";
    $stm=$conn->query($sql);
    $stm->execute();
    $result=$stm->fetchAll();

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap todo App</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
   <div class="container ">
     <h1 class="text-danger my-5">ToDo App:</h1>
     <form class="d-flex" role="search"method="post">
        <input class="form-control me-2" type="text" placeholder="entrer your task "name="task" aria-label="input">
        <input class="btn btn-outline-success" type="submit"></input>
      </form>

   </div>
   <div class="container my-5">
    <h1 class=" text-success my-3">All tasks:</h1>
    <?php 
    if(isset($_SESSION["add_data"])):;
    ?>
    <div class="alert alert-success" role="alert"><?php echo $_SESSION["add_data"];?></div>
    <?php unset($_SESSION["add_data"]);
    endif;?>
    <?php 
    if(isset($_SESSION["modify"])):;
    ?>
    <div class="alert alert-warning" role="alert"><?php echo $_SESSION["modify"];?></div>
    <?php unset($_SESSION["modify"]);
    endif;?>
    <?php 
    if(isset($_SESSION["delete"])):;
    ?>
    <div class="alert alert-danger" role="alert"><?php echo $_SESSION["delete"];?></div>
    <?php unset($_SESSION["delete"]);
    endif;?>
    <div class="row">
        <div class="col">
            <table class="table table-bordered text-center ">
                <thead >
                    <tr>
                    <th scope="col">ID</th>
                    <th scope="col">DATE</th>
                    <th scope="col">TASK</th>
                    <th scope="col">ACTION</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result): ?>
                    <?php foreach ($result as $res): ?>
                        <tr>
                            <th scope="row"><?php echo htmlspecialchars($res["id"]); ?></th>
                            <td><?php echo htmlspecialchars($res["ladate"]); ?></td>
                            <td><?php echo htmlspecialchars($res["liste"]); ?></td>
                            <td class="p-1">
                                <a href="delete.php?idd=<?php echo $res['id'];?>"   class="btn btn-danger"><i class="bi bi-trash"></i> Delete
                            </a>
                                <a href="modify.php?idd=<?php echo $res['id'];?>" target="_blank" rel="noopener noreferrer" class="btn btn-warning"><i class="bi bi-pencil"></i> Modify
                            </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
                </table>
        </div>
    </div>
   </div>





















    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>