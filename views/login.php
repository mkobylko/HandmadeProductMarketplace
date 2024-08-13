<style>
    html,
    body {
        height: 100%;
    }

    .login {
        display: flex;
        align-items: center;
        padding-top: 40px;
        padding-bottom: 40px;
    }

    .form-signin {
        max-width: 330px;
        padding: 15px;
    }


</style>

<div class="login">
    <main class="form-signin w-100 m-auto">
        <?php
        if ($_REQUEST['error'] == "1") {
            echo " <div class='alert alert-danger' role='alert'>Некоректний логін або пароль</div>";
        } else if ($_REQUEST['error'] == "2") {
            echo " <div class='alert alert-danger' role='alert'>Ви вже залогінені</div>";
        } else if ($_REQUEST['error'] == "3") {
            echo " <div class='alert alert-danger' role='alert'>Акаунт заблоковано</div>";
        }
        ?>

        <form action="/login/login" method="post" class="mt-4">
            <h1 class="h3 mb-3 fw-normal">Авторизація</h1>


            <div class="mb-3">
                <label for="login" class="form-label">Логін</label>
                <input type="text" class="form-control" id="login" name="login">

            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Пароль</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>


            <button class="w-100 btn btn-lg btn-act" type="submit">Увійти</button>
        </form>
    </main>
</div>