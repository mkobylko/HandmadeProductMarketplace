<?php
/** @var array $product */
/** @var array $categories */
?>

<div class=" container container-sm mt-5">
    <div class="row">
        <h2 class='py-3'>Редагування товару</h2>
        <div class="col-lg-1 col-md-12 col-12"></div>
        <div class='card mb-4 shadow bg-white rounded col-lg-10 col-md-12 col-12'>

            <form action="/sell/update" method="post" enctype="multipart/form-data" class="mx-4 my-4">
                <?php
                if ($_REQUEST['error'] == "1") {
                    echo " <div class='alert alert-danger' role='alert'>Некоректно введено назву товару, має бути принаймні 3 символи</div>";
                } else if ($_REQUEST['error'] == "2") {
                    echo " <div class='alert alert-danger' role='alert'>Некоректно введено розмір</div>";
                } else if ($_REQUEST['error'] == "3") {
                    echo " <div class='alert alert-danger' role='alert'>Некоректно введено ціну</div>";
                } else if ($_REQUEST['error'] == "4") {
                    echo " <div class='alert alert-danger' role='alert'>Некоректно введено кількість</div>";
                } else if ($_REQUEST['error'] == "5") {
                    echo " <div class='alert alert-danger' role='alert'>Некоректно введно поле опису товару</div>";
                } else if ($_REQUEST['error'] == "6") {
                    echo " <div class='alert alert-danger' role='alert'>Ви не можете редагувати товар, Вас заблоковано</div>";
                } if ($_REQUEST['error'] == "7") {
                    echo " <div class='alert alert-danger' role='alert'>Ви не маєте права редагувати даний товар</div>";
                }
                ?>
                <div class="mb-3">
                    <input type="hidden" name="idProduct" value="<?=$product->id?>">
                    <label for="product_name" class="form-label">Назва товару</label>
                    <input value="<?= $product->name ?>" type="text" class="form-control" id="product_name"
                           name="product_name">
                </div>
                <div class="mb-3">
                    <label for="dimension" class="form-label">Розмір товару</label>
                    <input value="<?= $product->dimension ?>" type="text" class="form-control"
                           id="dimension" name="dimension">
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Ціна товару</label>
                    <input value="<?= $product->price ?>" type="text" class="form-control" id="price"
                           name="price">
                </div>
                <div class="mb-3">
                    <label for="quantity" class="form-label">Кількість товару</label>
                    <input value="<?= $product->quantity ?>" type="text" class="form-control" id="quantity"
                           name="quantity">
                </div>
                <div class="mb-4">
                    <label for="description" class="form-label area-description">Опис товару</label>
                    <textarea name="description" rows="4" cols="38"><?= $product->description ?></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Фото товару</label>
                    <?php $photo = "data:image/jpg;charset=utf8;base64," . base64_encode($product->photo);
                    if ($product->photo != null) : ?>
                        <div class="row">
                            <div class='col-xs-4 col-lg-4 mb-1 photoUpdate'>
                                <img src='<?= $photo ?>' class='img-fluid' alt='Image of the product'>
                            </div>
                            <div class='col-xs-6 col-lg-6'>
                                <label for="photo" class="form-label">Нове фото товару</label>
                                <input type="file" class="form-control" id="photo" name="photo">
                            </div>
                        </div>
                    <?php else :?>
                </div>
                <div class="mb-5">
                    <label for="photo" class="form-label">Нове фото товару</label>
                    <input type="file" class="form-control" id="photo" name="photo">
                </div>
                <?php endif;?>
                <div class="mb-3">
                    <label for="" class="form-label">Вибір категорії</label>


                    <select name="category">
                        <?php
                        foreach ($categories as $category): ?>

                            <?php if ($product->idCategory == $category->id): ?>
                                <option value='<?= $category->id ?>' <?= "selected"; ?>><?= $category->name ?></option>";
                                <?php ; else: ?>
                                <option value='<?= $category->id ?>'><?= $category->name ?></option>";
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="text-center">
                    <button class="w-20 btn btn-lg btn-add " type="submit">Редагувати</button>
                </div>

            </form>
        </div>
    </div>
</div>