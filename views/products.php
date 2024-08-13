<?php
/** @var array $products */
/** @var int $priceFrom */
/** @var int $priceTo */
/** @var int $mark */
/** @var int $categoryId */
/** @var string $name */
/** @var array $user */

?>

<div class="container">
    <?php
    if ($_REQUEST['error'] == "1") {
        echo " <div class='alert alert-danger' role='alert'>Ви не маєте доступу до даної дії</div>";
    }
    ?>
    <div class="row pt-5 ">
        <div class="col col-lg-3 text-start">
            <h3>Фільтри</h3>
            <ul class="nav flex-column">
                <li class="nav-item ">
                    <form action="/products" method="get">

                        <div class="row mt-4">
                            <h5>Ціна</h5>
                            <div class="col">
                                <label for="priceFrom" id="priceFrom">від</label>

                            </div>
                            <div class="col">
                                <label for="priceTo" id="priceTo">до</label>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <input type="text" id="priceFrom" name="priceFrom" style="width: 70%"
                                       value="<?= $priceFrom ?>">
                            </div>
                            <div class="col">
                                <input type="text" id="priceTo" name="priceTo" style="width: 70%"
                                       value="<?= $priceTo ?>">
                            </div>
                        </div>

                        <div class="mt-4">
                            <label for="mark" id="mark"><h5>Мінімальна оцінка</h5></label>
                            <select id="mark" name="mark">
                                <option value="1" <?= $mark == 1 ? "selected" : "" ?>>1 star</option>
                                <option value="2" <?= $mark == 2 ? "selected" : "" ?>>2 stars</option>
                                <option value="3" <?= $mark == 3 ? "selected" : "" ?>>3 stars</option>
                                <option value="4" <?= $mark == 4 ? "selected" : "" ?>>4 stars</option>
                                <option value="5" <?= $mark == 5 ? "selected" : "" ?>>5 stars</option>
                            </select>
                            <input type="hidden" value="<?= $categoryId ?>" name="category"/>
                            <input type="hidden" value="<?= $name ?>" name="name"/>
                        </div>
                        <div class="mt-4">
                            <input type="submit" class="btn btn-act" value="Відфільтрувати  "/>
                        </div>
                        <div class="mt-3">
                            <a href="/products?category=<?= $categoryId ?> " class="btn btn-add"> Скинути
                                фільтри</a>
                        </div>
                    </form>
                </li>
            </ul>
        </div>


        <div class="col col-9 d-flex flex-wrap justify-content-between">


            <?php
            foreach ($products

            as $product) {
            if ($product->photo == null) {
                $photo = "/themes/images/noImage.jpg";
            } else {
                $photo = "data:image/jpg;charset=utf8;base64," . base64_encode($product->photo);
            }
            ?>
            <?php if ($product->quantity != 0): ?>
            <div class='card card-products border-0'>
                <div class="imgProducts">
                    <div class='imgMar'> <?php echo " <a href='/product?id=$product->id'>
                        <img src='$photo' class='card-img-top img' alt='Image of the product'></div>
                    </a>" ?>
                    </div>
                    <div class='card-body'>

                        <p class='card-text fw-bold card-text-products'><?= $product->name ?></p>

                        <?php for ($i = 1; $i <= 5; $i++) {
                            if ($i <= $product->avgMark) : ?>
                                <span class='fa fa-star checked'></span>
                            <?php else: ?>
                                <span class='fa fa-star'></span>
                            <?php endif; ?>
                        <?php } ?>
                        <br><br><small class=''><?= $product->price ?> грн</small>
                        <?php if ($user->type == 1): ?>
                            <div class='text-end'>
                                <a href='/products/delete?id=<?= $product->id ?>' class='btn btn-add'
                                   style='margin-top: -8%;'>Видалити</a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endif; ?>
                <?php } ?>

            </div>
        </div>
    </div>
