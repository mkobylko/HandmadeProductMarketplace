<?php
/** @var array $categories */
/** @var array  $user*/
/** @var int $shoppingBagCount */
?>


<header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 border-bottom">

    <a class="navbar navbar-expand-lg navbar-brand handmade" ><h2>Handmade</h2></a>

    <!--<a href="/" class="d-flex align-items-center col-md-1 mb-2 mb-md-0 text-dark text-decoration-none">
        <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap">
            <use xlink:href="#bootstrap"/>
        </svg>
    </a>-->


    <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0 ">

        <li><a href="/" class="nav-link link-secondary">Головна</a></li>
        <li>
            <div class="dropdown">
                <a class="nav-link px-2 link-dark dropdown-toggle" type="button" id="dropdownMenuButton"
                   data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Товари
                </a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <div id='addCategory'>
                        <?php
                        foreach ($categories as $category) {
                            echo "<a class='dropdown-item' href='/products?category=$category->id'>$category->name</a>";
                        } ?>
                    </div>

                    <?php if ($user->type == 1) { ?>


                        <a class='dropdown-item'>
                            <button type="button" class="btn btn-act " data-bs-toggle="modal" data-bs-target="#modal">
                                + категорію
                            </button>
                        </a>
                    <?php } ?>

                </div>
            </div>
        </li>

        <li><a href="/reviews/" class="nav-link px-2 link-dark">Відгуки</a></li>
        <?php if ($user != null): ?>
            <li><a href="/sell/" class="nav-link px-2 link-dark">Продаж</a></li>
        <?php endif; ?>
    </ul>

    <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" role="search" action="/products" >
        <input type="search" class="form-control" placeholder="Пошук..." aria-label="Search" name="name">
    </form>

    <ul class="nav col-12 col-md-auto mb-2 ml-2 justify-content-center mb-md-0 ">
        <?php if ($user != null && $user->isAdmin()): ?>
            <li><a href="/users/" class="nav-link px-2 link-dark">Користувачі</a></li>
        <?php endif; ?>
        <?php if ($user != null && $user->isAdmin()): ?>
            <li><a href="/statistics/" class="nav-link px-2 link-dark">Статистика</a></li>
        <?php endif; ?>

    </ul>

    <div class="col-md-1 text-end">
        <?php
        echo '<a href="/shoppingBag/" id="shoppingBag" class="navbar-text">';
        if ($shoppingBagCount != 0) {
            echo ' Кошик (' . $shoppingBagCount . ')';
        }
        echo '</a>';
        ?>
    </div>


    <?php if ($user === null): ?>
        <div class="col-md-3 text-end">
            <a href="/login/" class="btn btn-act  me-2">Login</a>
            <a href="/register/" class="btn btn-add">Sign-up</a>

        </div>
    <?php endif; ?>

    <?php if ($user != null) { ?>

        <div class="col-md-1 text-end">

            <div class="username">
                <a class="nav-link link-dark dropdown-toggle" type="button"
                   data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?php echo $user->login ?>
                </a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="/myPurchases/">Мої покупки</a>
                    <a class="dropdown-item" href="/announcementSale/">Мої оголошення</a>
                    <a class="dropdown-item" href="/mySales/">Мої продажі</a><!--якщо хтось купив-->
                    <a class="dropdown-item" href="/account/">Профіль</a>
                    <?php if ($user != null && $user->isAdmin()): ?>
                        <a class="dropdown-item btn-add" href="/backupArchive/">Backup/Archive</a>
                    <?php endif; ?>
                </div>
            </div>

        </div>
        <div class="col-md-1 text-end">

            <a href="/logout/" class="btn btn-act me-2">Log out</a>
        </div>
    <?php } ?>

</header>

<div class="modal fade" id="modal" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Додати категорію</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center mt-3">
                <label for="category">Категорія: </label>
                <input type="text" id="category">
            </div>
            <div class="px-4 py-3 text-center">
                <a href="javascript:addCategory()" class="btn btn-lg btn-add">Додати</a>
            </div>
        </div>
    </div>
</div>




