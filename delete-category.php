<?php
session_start();
include_once 'db.php';

if(isset($_POST['delete']))
{

    $category = $con->real_escape_string(trim($_POST['cat-name']));

    $query0 = $con->query("SELECT `id` FROM `olx`.`categories` WHERE `name`='$category'");
    $query0 = $query0->fetch_assoc();
    $query0 = $query0['id'];
    $query00 = $con->query("UPDATE `olx`.`ads` SET `category_id`='id' WHERE `category_id`='$query0'" );
    $query = $con->query("DELETE FROM `olx`.`categories` WHERE name = '$category'");

    if(!$query){
        echo "<span class='alert-danger'> <h2>Some error occurred, try again later.</h2></span>";
        echo "<br><br><a href='delete-category.php'> <button type=\"submit\" class=\"btn btn-danger\" name = \"back\">Go Back</button></a>";
    }
    else{
        echo "<span class='alert-success'> <h2>Deleted Successfully</h2></span>";
        echo "<br><br><a href='delete-category.php'> <button type=\"submit\" class=\"btn btn-danger\" name = \"back\">Go Back</button></a>";
    }

    $con->close();
}


else{
    ?>
    <html>
    <body>
    <div class="container" >

        <div class="col-lg-12">
            <div class="panel panel-danger" style="background-color: whitesmoke; ">
                <div class="panel-heading" align="center">
                    <h3>Delete Any Category</h3>
                </div>
                <div class="panel-body">
                    <div class="row">

                        <form action="delete-category.php" method = "post">

                            <div class="col-lg-4">
                                <div align="right">

                                    <p> Select Category to delete * </p><br/><br/>

                                </div>

                            </div>
                            <div class="col-lg-5">


                                <?php
                                /*include "copy.php";*/
                                $query = $con->query("select * from categories");
                                $count = $query->num_rows;
                                $result = $query->fetch_array();
                                echo "<from><select required  name = \"cat-name\" class=\"form-control\" >";
                                echo "<option value=''>Select Category to Delete</option>";
                                for($i = 1;$i<= $count; $i++){
                                    $temp = $con->query("select name from categories where id = '$i'")->fetch_assoc()['name'];
                                    if(empty($temp)){
                                        $count++;

                                    }
                                    else{
//
                                        echo "<option>".$temp."</option>";
                                    }
                                }
                                echo "</select></form>";
                                ?>

                                <div align="right">
                                    <br/>
                                    <button type="submit" class="btn btn-danger" name = "delete">Delete</button>
                                </div>

                            </div>
                            <div class="col-lg-3">

                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    </body>
    </html>
<?php } ?>