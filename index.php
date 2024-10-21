<?php
require 'config/db_conn.php';  // Include the database connection file

// Fetch all todos from SQL Server
$query = "SELECT * FROM todos ORDER BY id DESC";
$todos = sqlsrv_query($conn, $query);

if ($todos === false) {
    die(print_r(sqlsrv_errors(), true));  // Handle connection errors
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To Do List 1</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <div class="main-section">
        <div class="add-section">
            <form action="proses/add.php" method="POST" autocomplete="off">
                <?php if (isset($_GET['mess']) && $_GET['mess'] == 'error') { ?>
                    <input type="text" name="title" style="border-color: #ff6666;" placeholder="This field is required !" />
                    <button type="submit"> Add &nbsp; <span></span>&#43;</button>
                <?php } else { ?>
                    <input type="text" name="title" placeholder="What is your plan ? " />
                    <button type="submit"> Add &nbsp; <span></span>&#43;</button>
                <?php } ?>
            </form>
        </div>

        <!-- Display the to-do list -->
        <div class="show-todo-section">
            <?php if (sqlsrv_num_rows($todos) === 0) { ?>
                <div class="todo-item">
                    <div class="empty">
                        <img src="img/icon1.png" width="100%" />
                        <img src="img/Ellipsis.gif" width="80px%" />
                    </div>
                </div>
            <?php } ?>
            <?php while ($todo = sqlsrv_fetch_array($todos, SQLSRV_FETCH_ASSOC)) { ?>
                <div class="todo-item">
                    <span id="<?php echo $todo['id']; ?>" class="remove-to-do">x</span>
                    <?php if ($todo['checked']) { ?> 
                        <input type="checkbox" class="check-box" data-todo-id="<?php echo $todo['id']; ?>" checked />
                        <h2 class="checked"><?php echo htmlspecialchars($todo['title']); ?></h2>
                    <?php } else { ?>
                        <input type="checkbox" data-todo-id="<?php echo $todo['id']; ?>" class="check-box" />
                        <h2><?php echo htmlspecialchars($todo['title']); ?></h2>
                    <?php } ?>
                    <br>
                    <small>created: <?php echo $todo['date_time']->format('Y-m-d H:i:s'); ?></small>
                </div>
            <?php } ?>
        </div>
    </div>

    <script src="js/jquery-3.2.1.min.js"></script>    

    <script>
        $(document).ready(function(){
            // Remove to-do
            $('.remove-to-do').click(function(){
                const id = $(this).attr('id');
                
                $.post("proses/remove.php",
                    {
                        id:id
                    },
                    (data) => {
                        if(data){
                            $(this).parent().hide(600);
                        }
                    }
                );
            });

            // Toggle check
            $(".check-box").click(function(e){
                const id = $(this).attr('data-todo-id');
                
                $.post('proses/check.php',
                        {
                            id:id
                        },
                        (data) => {
                            if(data != 'error'){
                                const h2 = $(this).next();
                                if (data == '1'){
                                    h2.removeClass('checked');
                                } else {
                                    h2.addClass('checked');
                                }
                            }
                        }
                );
            });
        });
    </script>   
</body>


</html>
