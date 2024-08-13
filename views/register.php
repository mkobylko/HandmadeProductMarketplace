
<div class=" container-sm mt-5">
    <div class="row">
        <div class="col-lg-3 col-md-12 col-12"></div>
        <div class='card mb-4 shadow bg-white rounded col-lg-6 col-md-12 col-12'>


            <form method="post" action="/register/register" class="mx-4" onSubmit="return validate(this)">
                <?php
                if ($_REQUEST['error'] == "1") {
                    echo " <div class='alert alert-danger' role='alert'>Некоректно введено логін. Має бути принаймні 3 символи</div>";
                } else if ($_REQUEST['error'] == "2") {
                    echo " <div class='alert alert-danger' role='alert'>Некоректно введено пароль. Повинно бути принаймні 6 символів</div>";
                } else if ($_REQUEST['error'] == "3") {
                    echo " <div class='alert alert-danger' role='alert'>Паролі не збігаються</div>";
                } else if ($_REQUEST['error'] == "4") {
                    echo " <div class='alert alert-danger' role='alert'>Некоректно введена пошта</div>";
                } else if ($_REQUEST['error'] == "5") {
                    echo " <div class='alert alert-danger' role='alert'>Некоректно введено ім'я має бути прийні три символи</div>";
                } else if ($_REQUEST['error'] == "7") {
                    echo " <div class='alert alert-danger' role='alert'>Дана пошта вже існує</div>";
                } else if ($_REQUEST['error'] == "6") {
                    echo " <div class='alert alert-danger' role='alert'>Даний логін вже існує</div>";
                } else if ($_REQUEST['error'] == "8") {
                    echo " <div class='alert alert-danger' role='alert'>Вийдіть з акаунти аби здійснити дану дію</div>";
                }
                ?>
                <div class="mb-3 mt-4">
                    <label for="user_name" class="form-label">Логін</label>
                    <input type="text" class="form-control" id="user_name" name="user_name">
                </div>

                <div class="mb-3 mt-4">
                    <label for="name" class="form-label">Ім'я</label>
                    <input type="text" class="form-control" id="name" name="name">
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email"">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Пароль</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>
                <div class="mb-4">
                    <label for="repeated_password" class="form-label">Повторіть пароль</label>
                    <input type="password" class="form-control" id="repeated_password" name="repeated_password">
                </div>
                <span class="alert alert-danger" role="alert" id="error" hidden></span>

                <div class="text-center">
                    <button class="w-20 btn btn-lg btn-add mx-4 my-4" type="submit">Зареєструватися</button>
                </div>

        </div>
    </div>

