<?php
$title = "My ToDo";
include $_SERVER['DOCUMENT_ROOT'] . '/MyToDo/body/header.php';
require $_SERVER['DOCUMENT_ROOT'] . '/MyToDo/theme/themeFunc.php';
require $_SERVER['DOCUMENT_ROOT'] . '/MyToDo/fontsFix.php';
require $_SERVER['DOCUMENT_ROOT'] . '/MyToDo/timeOrient.php';
?>
<?php
if (isset($_COOKIE["email"]) == 1):
    ?>
    <link rel="stylesheet" href="/MyToDo/style/todo.css">
    <div class="container d-flex justify-content-center">
        <form action="/MyToDo/action/add.php" method="POST">
            <div class="form-group">
                <h1 class="heading"><em>Your ToDo, <?=$_COOKIE["name"]?>)</em></h1>
            </div>
            <div class="form-group">
                <div class="input-group mb-3">
                    <input <?php echo "style=\"border-color: #35363b; ".colors()."\""; ?> autocomplete="off" maxlength="50" type="text" class="form-control" name="task" placeholder="Добавить новую задачу." aria-describedby="button-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Добавить</button>
                    </div>
                </div>
            </div>
            <br />
            <form>
                <ul class="list-group">
                    <?php
                    function printTask($result)
                    {
                        while (($row = $result->fetch_assoc()) != false)
                        {
                              if ($row["activity"] == 0) {
                                echo "<li style=\"height: 50px; ".colors()." margin-bottom: 12px; border: 1px solid #35363b; border-left:none; border-right: none; border-radius: 3%;\" class=\"list-group-item d-flex justify-content-between align-items-center\" aria-describedby=\"button-addon2\">
                                <a style=\"border-radius: 4px 0px 0px 4px; height: 100%; padding: 0 19px; display: inline-flex; align-items: center;\" type=\"button\" href=\"edit.php?id=" . $row["id"] ."\" class=\"btn btn-outline-success\">✓</a>
                            <div style=\"".fontsFix($row["task"], 1)." opacity: 100%; line-height: 17px;\" class=\"font-weight-bold\"><em>". $row["task"] ."</em></div>
                                    <a style=\" padding: 0 20px; border-radius: 0px 4px 4px 0px; height: 100%; display: inline-flex; align-items: center;\" class=\"btn btn-outline-danger\" href=\"delete.php?id=" . $row["id"] ."\" id=\"button-addon2\">Х</a>
                        </li>";
                              }
                              if ($row["activity"] == 1) {
                                echo "<li style=\"height: 50px; ".colors()." margin-bottom: 12px; border: 1px solid #35363b; border-left:none; border-right: none; border-radius: 3%;\" class=\"list-group-item d-flex justify-content-between align-items-center\" aria-describedby=\"button-addon2\">
                                <a style=\"border-radius: 4px 0px 0px 4px; height: 100%; padding: 0 19px; display: inline-flex; align-items: center;\" type=\"button\" href=\"edit.php?id=" . $row["id"] ."\" class=\" btn btn-success\">✓</a>
                            <div style=\"".fontsFix($row["task"], 0)." opacity: 60%; line-height: 17px;\"><em><s>". $row["task"] ."</s></em></div>
                                    <a style=\" padding: 0 20px; border-radius: 0px 4px 4px 0px; height: 100%; display: inline-flex; align-items: center;\" class=\"btn btn-outline-danger\" href=\"delete.php?id=" . $row["id"] ."\" id=\"button-addon2\">Х</a>
                        </li>";
                              }
                        }
                    }

                    $email = preg_replace('/@|\./','', $_COOKIE["email"]);

                    require $_SERVER['DOCUMENT_ROOT'] . '/MyToDo/db/dbconfig.php';

                    $result = $mysql->query("SELECT * FROM `$email` ORDER BY `$email`.`id` DESC");
                    $mysql->close();
                    printTask($result);
                    ?>
                </ul>
            </form>
        </form>
    </div>
<?php
endif;
?>
<?php
if (isset($_COOKIE["email"]) != 1) {
  setcookie("theme", "", time() - 3600 * 4, "/");
  header("Location: /MyToDo/index.php");
}
include $_SERVER['DOCUMENT_ROOT'] . '/MyToDo/body/footer.php';
?>
