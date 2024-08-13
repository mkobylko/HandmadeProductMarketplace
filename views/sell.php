<?php
/** @var array $categories */

?>

<div class="container container-sm mt-5">
    <div class="row">
        <h2 class='py-3'>Додавання товару</h2>
        <div class="col-lg-1 col-md-12 col-12"></div>
        <div class='card mb-4 shadow bg-white rounded col-lg-10 col-md-12 col-12'>
            <form action="/sell/add" method="post" enctype="multipart/form-data" class="mx-4 my-4">
                <?php if ($_REQUEST['error'] == "1") {
                    echo " <div class='alert alert-danger' role='alert'>Некоректно введено назву товару, має бути принаймні 3 символи</div>";
                } else if ($_REQUEST['error'] == "2") {
                    echo " <div class='alert alert-danger' role='alert'>Некоректно введено розмір</div>";
                } else if ($_REQUEST['error'] == "3") {
                    echo " <div class='alert alert-danger' role='alert'>Некоректно введено ціну</div>";
                } else if ($_REQUEST['error'] == "4") {
                    echo " <div class='alert alert-danger' role='alert'>Некоректно введено кількість</div>";
                } else if ($_REQUEST['error'] == "5") {
                    echo " <div class='alert alert-danger' role='alert'>Некоректно введно поле опису товару</div>";
                }
                ?>
                <div class="mb-3">
                    <label for="product_name" class="form-label">Назва товару</label>
                    <input type="text" class="form-control" id="product_name" name="product_name">
                </div>
                <div class="mb-3">
                    <label for="dimension" class="form-label">Розмір товару </label>
                    <br><small class="text-muted">На зразок: [width x height x depth]</small>
                    <input type="text" class="form-control" id="dimension" name="dimension">
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Ціна товару</label>
                    <input type="text" class="form-control" id="price" name="price">
                </div>
                <div class="mb-3">
                    <label for="quantity" class="form-label">Кількість товару</label>
                    <input type="text" class="form-control" id="quantity" name="quantity">
                </div>
                <div class="mb-4">
                    <label for="description" class="form-label">Опис товару</label>
                    <textarea name="description" rows="4"></textarea>
                </div>
                <div class="mb-3">
                    <label for="photo" class="form-label">Фото товару</label>
                    <input type="file" class="form-control" id="photo" name="photo">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Вибір категорії</label>
                    <select name="category">
                        <?php
                        foreach ($categories as $category) :?>
                            <option value='<?=$category->id?>'><?=$category->name?></option>
                        <?php endforeach;?>
                    </select>
                </div>
                <div class="text-center">
                    <button class="w-20 btn btn-lg btn-add " type="submit">Додати товар</button>
                </div>

            </form>
        </div>
    </div>
</div>