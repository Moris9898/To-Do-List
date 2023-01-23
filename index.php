<?php 
require "db_connect.php"
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To Do List</title>
    <link rel="stylesheet"  href="css/main.css" >

    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <h1 style="text-align:center;"> hello</h1>
    <div style="text-align:center;">

        <div class="main-section">
            <div class="add-action">
                <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" class="form-list">
                    <input type="text" name="title" placeholder ="This filied is Required" class="tasks-input">
                    <button type="submit" class="tasks-submit"> Add <i class="fa-regular fa-square-plus fa-1x ml"></i></button>
                </form>
                <?php 
                if($_SERVER['REQUEST_METHOD'] == "POST") {
                    $title = $_POST['title'];
                    $stmtt = $conn->prepare("INSERT INTO todo(title, data_time, checked) VALUES(:Atitle, now(), 0)");
                    $stmtt->execute(array(
                        ':Atitle' => $title
                    ));
                    header("Location: index.php");
                }
                ?>
            </div>
            <?php 
            $stmt = $conn->query("SELECT * From todo ORDER BY id DESC");
            $tasks = $stmt->fetchAll();
            ?>
            <div class="show-section">
                <?php if($stmt->rowCount() === 0) { ?>
                    <img src="img/f.png" alt="">
                    <img src="img/Ellipsis.gif" alt="">
                <?php } else {
                    foreach($tasks as $task ) {
                        if($task['checked'] == 1) {
                            echo '<div class="item">';
                            echo '<div class="d-flex">';
                                echo '<input checked class="check-box" data-todo="' . $task['id'] . '" type="checkbox">';
                                echo '<h2 class="checked">' . $task["title"] . '</h2>';
                                echo '<span id=' . $task["id"] . ' class="remove-todo"><a href="remove.php?do=' . $task['id'] . '" id=' . $task["id"] . '>x</a></span>';
                            echo '</div>';
                            echo '<p>' . $task['data_time'] . '</p>';
                        echo '</div>';
                        }  else {
                            echo '<div class="item">';
                                echo '<div class="d-flex">';
                                    echo '<input class="check-box" data-todo="' . $task['id'] . '"  type="checkbox">';
                                    echo '<h2 >' . $task["title"] . '</h2>';
                                    echo '<span id=' . $task["id"] . ' class="remove-todo"><a  href="remove.php?do=' . $task['id'] . '">x</a></span>';
                                echo '</div>';
                                echo '<p>' . $task['data_time'] . '</p>';
                            echo '</div>';
                        }
                    }
                } ?>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(".check-box").click(function() {
            const id = $(this).attr('data-todo');
            $.post("checked.php",
            {
                id: id
            },
            (data) => {
                if(data != "error") {
                    const h2 = $(this).next();
                    if(data == '1') {
                        h2.removeClass("checked")
                    } else {
                        h2.addClass("checked")
                    }
                }
            }
            ) 
        })
    </script>
    </html>
</body>