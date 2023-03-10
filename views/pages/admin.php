<?php
if(!isset($_SESSION['user'])){
    header("Location: index.php?page=home");
    die();
}
else{
    $user = $_SESSION['user'];
    if($user->role_name == "User") {
        header("Location: index.php?page=home");
        die();
    }
}
?>
<div class="container-fluid">
    <div class="row d-flex justify-content-center">
        <div class="col-12 purple">
            <h1 class="my-3 fs-6 text-center">Admin - <?=$user->first_name?> <?=$user->last_name?></h1>
        </div>
        <div class="col-8 d-flex justify-content-around mt-3">
            <a href="#admin-user">User management</a>
            <a href="#admin-message">Message management</a>
            <a href="#admin-poll">Survey results</a>
            <a href="#admin-products">Products</a>
        </div>
    </div>
</div>

<!--USERS-->
<div class="container">
    <div class="col-12 d-flex flex-column align-items-center">
        <?php
         $users = queryFunction("SELECT * FROM user", true);
        ?>
        <h2 class="text-center fs-3 mt-5">Users (<?=count($users)?>)</h2>
        <table class="col-12 text-center mt-3">
            <thead>
                <tr>
                    <th scope="col"></th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Manage</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $i = 1;
            foreach ($users as $u):
                ?>
                <tr class="<?=$u->active == 1 ? "table-success" : "table-danger"?>">
                    <th scope="row"><?=$i++?></th>
                    <td><?=$u->first_name?> <?=$u->last_name?></td>
                    <td><?=$u->email?></td>
                    <?php
                    if ($u->role == 2):
                        ?>
                        <td class="text-dark">Admin</td>
                    <?php
                    else:
                        ?>
                        <td><a href="models/adminPanel/status.php?table=user&id=<?=$u->id?>&status=<?=$u->active == 1 ? "1" : "0"?>" class="btn btn-<?=$u->active == 1 ? "danger" : "success"?>"><?=$u->active == 1 ? "Deactivate" : "Activate"?></a></td>
                    <?php
                    endif;
                    ?>
                </tr>
            <?php
            endforeach;
            ?>
            </tbody>
    </table>
    </div>
</div>

<!--Products-->
<div class="container">
    <div class="col-12 d-flex flex-column align-items-center">
        <?php
        $products = queryFunction("SELECT p.name,p.price, p.picture_src, p.active, c.name as category FROM product p INNER JOIN category c ON p.id_category = c.id ", true);
        ?>

        <h2 class="text-center fs-3 mt-5">Products (<?=count($products)?>)</h2>
        <table class="col-12 text-center">
            <thead>
            <tr>
                <th scope="col"></th>
                <th scope="col">Picture</th>
                <th scope="col">Name</th>
                <th scope="col">Price</th>
                <th scope="col">Category</th>
                <th scope="col">Manage</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $i = 1;
            foreach ($products as $p):
                ?>
                <tr class="<?=$u->active == 1 ? "table-success" : "table-danger"?>">
                    <th scope="row"><?=$i++?></th>
                    <td><img src="assets/img/<?=$p->picture_src?>" alt="<?=$p->name?>" class="col-2"/></td>
                    <td><?=$p->name?></td>
                    <td><?=$p->price?></td>
                    <td><?=$p->category?></td>
                    <td><a href="models/adminPanel/status.php?table=product&id=<?=$p->id?>&status=<?=$p->active == 1 ? "1" : "0"?>" class="btn btn-<?=$p->active == 1 ? "danger" : "success"?>"><?=$p->active == 1 ? "Deactivate" : "Activate"?></a></td>
                </tr>
            <?php
            endforeach;
            ?>
            </tbody>
        </table>
    </div>
</div>