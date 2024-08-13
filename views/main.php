<?php
/** @var array $products */
?>

<div class="text-center">
    <header class="position-relative text-center text-black">
        <img src="/themes/images/main2.jpg" class="w-100" alt="Banner"/>
        <div class="position-absolute mb-4 top-50 start-50 translate-middle ">
            <h1 class="">Handicraft and handmade</h1>
            <a href="/products/" class="btn mt-2 btn-act">Перегляд товарів</a>
        </div>
    </header>
</div>
<div class="container position-relative text-center">
    <h2 class="py-5 txt">Найкращі товари</h2>
    <div class="col col-12 d-flex flex-wrap justify-content-between mb-4">

        <?php
        foreach ($products as $product) : ?>

        <?php if ($product->photo === null) {
            $photo = "/themes/images/noImage.jpg";
        } else {
            $photo = "data:image/jpg;charset=utf8;base64," . base64_encode($product->photo);
        }
        ?>

        <?php if ($product->quantity != 0): ?>

        <div class='card card-main border-0'>
            <div class="imgMain">
                <div class='imgMar'> <?php echo " <a href='/product?id=$product->id'>
                        <img src='$photo' class='card-img-top img' alt='Image of the product'></div>
                    </a>" ?>
                </div>
                <div class='card-body'>
                    <p class='card-text fw-bold'><?= $product->name ?></p>

                    <?php for ($i = 1; $i <= 5; $i++) : ?>
                        <?php if ($i <= $product->avgMark) : ?>
                            <span class='fa fa-star checked'></span>
                        <?php else: ?>
                            <span class='fa fa-star'></span>
                        <?php endif; ?>
                    <?php endfor; ?>
                    <br><br><small class='text-secondary'><?= $product->price ?> грн</small>

                </div>
            </div>
            <?php endif; ?>
            <?php endforeach; ?>


        </div>
    </div>
</div>

