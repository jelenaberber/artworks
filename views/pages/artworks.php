<main>
    <div class="container-fluid mt-5">
        <h1 class="text-center">Artworks</h1>
        <span class="dot mb-5"></span>
        <div class="row d-flex justify-content-start">
            <div class="col-2 d-flex flex-column mx-4">
                <select class="form-select mb-5" id="price">
                    <option value="0">Cena</option>
                </select>
                <select class="form-select mb-5" id="categories">
                    <option value="0">kategorije</option>
                </select>
                <div class="col-12" id="available">
                </div>
                <div class="col-12 mt-3" id="shipping">
                </div>
            </div>
            <div class="arts d-flex flex-wrap col-9 justify-content-around">
                <?php
                global $conn;
                $product = $conn->query("SELECT * FROM product")->fetchAll();
                foreach ($product as $p) :
                ?>
                    <div class="col-3 mx-1 my-3">
                        <div class="card h-100 w-100">
                            <img src="assets/img/<?= $p->picture_src ?>" class="card-img-top" alt="<?= $p->name ?>">
                            <div class="card-body d-flex flex-column align-items-center">
                                <h5 class="card-title"><?= $p->name ?></h5>
                                <p>Price: <?= $p->price ?>.00$</p>
                                <button type="button" class="btn btn-primary button">Purchase Now</button>
                            </div>
                        </div>
                    </div>

                <?php endforeach;?>
            </div>

        </div>
    </div>
</main>