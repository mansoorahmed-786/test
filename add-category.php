<?php

session_start();
include_once 'db.php';
if(!isset($_SESSION['usr_id']))
{
    header("Location: login.php");
}




if(isset($_POST['add']))
{

    $category = $con->real_escape_string(trim($_POST['cat-name']));

    $query = $con->query("insert into `olx`.`categories` (name) VALUES ('$category')");



    if(!$query){
        echo "<span class='alert-danger'> <h2>Some error occurred, try again later.</h2></span>";
        echo "<br><br><a href='add-category.php'> <button type=\"submit\" class=\"btn btn-info\" name = \"back\">Go Back</button></a>";



    }
    else{
        echo "<span class='alert-success'> <h2>Added Successfully</h2></span>";
        echo "<br><br><h4><p>Wish to add more categories</p></h4><br><a href='add-category.php'> <button type=\"submit\" class=\"btn btn-info\" name = \"back\">Add More</button></a>";
    }

    $con->close();
}


else{
    ?>
    <html>
    <body>
    <div class="container">
        <div class="panel panel-success" style="background-color: whitesmoke">
            <div class="panel-heading" align="center">
                <h3>Add New Category</h3>
            </div>
            <div class="panel-body">
                <div class="row">

                    <form action="add-category.php" method = "post">
                        <div class="col-lg-4">
                            <div align="right">

                                <p> Enter Category name * </p><br/><br/>

                            </div>

                        </div>
                        <div class="col-lg-5">


                            <input type="text" name  = "cat-name" class="form-control" required>New Category<br/><br/>

                            <div align="right">
                                <br/>
                                <button type="submit" class="btn btn-success" name = "add">Add Category</button>
                            </div>

                        </div>
                        <div class="col-lg-3">

                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    </body>
    </html>
<?php } ?>