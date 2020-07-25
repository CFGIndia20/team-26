<div class="row mt-5">
    <div class="col-md-8 offset-md-2">
        <table class="table table-hover">
            <thead>
            <tr>
                <th>Category id</th>
                <th>Category title</th>
                <th>edit</th>
                <th>delete</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
            <?php
            include_once("../includes/functions.php");
            $categories = getAllCategories();
            $count = count($categories);
            $i = 0;
            while ($i < $count) {
                echo "<tr>";
                echo "<td>{$categories[$i]['cat_id']}</td>";
                echo "<td>{$categories[$i]['cat_title']}</td>";
                echo "<td><a href='{$_SERVER['PHP_SELF']}?id={$categories[$i]['cat_id']}'>Edit</a></td>";
                echo "<td><a href='includes/delete_data.php?cat_id={$categories[$i]['cat_id']}'>Delete</a></td>";

                echo "</tr>";
                $i++;
            }

            ?>
            </tbody>
        </table>
    </div>
</div>