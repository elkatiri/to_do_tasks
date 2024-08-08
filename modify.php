<?php
session_start();
include_once "db.php";

$idd = $_GET["idd"];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if  (isset($_POST["date"]) && isset($_POST["task"])) {
        $sql = "UPDATE `todo` SET `ladate` = :new_date, `liste` = :new_task WHERE `id` = :idd";
        $stm = $conn->prepare($sql);
        $stm->bindParam(":new_date",$_POST["date"]);
        $stm->bindParam(":new_task",$_POST["task"]);
        $stm->bindParam(":idd",$idd);
        if ($stm->execute()){
            $_SESSION["modify"]="the data modify successflly !";
            header('Location:main.php');
            exit;
        } else {
            echo "Error: Could not execute the query.";
        }
    } else {
        echo "Error: Required form fields are missing.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modify Task</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            background-color: #f8f9fa;
            padding-top: 20px;
        }
        .container {
            max-width: 600px;
            margin: 10% auto;
        }
        .form-control {
            margin-bottom: 10px;
        }
        .icon_size {
            font-size: 2rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="d-flex align-items-center mb-4">
            <i class="bi bi-pencil icon_size me-2 text-warning"></i>
            <h1 class="mb-0 text-primary">Modify Task</h1>
        </div>
        <form class="w-100" method="post">
            
            <div class="mb-3">
                <input class="form-control" type="date" name="date" placeholder="Enter new date"  aria-label="Date" required>
            </div>
            <div class="mb-3">
                <input class="form-control" type="text" name="task" placeholder="Enter new task"  aria-label="Task" required>
            </div>
            <input type="submit" class="btn btn-success"></input>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
