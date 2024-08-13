


/* category */

function addCategory() {
    let category = $("#category").val();

    $.get("/category/add", {'category': category})
        .done(function (data) {
            $('#modal').modal('hide');
            let category = JSON.parse(data);
            $('#addCategory').append("<a class='dropdown-item' href='/products?category=" + category.id + "'>" + category.name + "</a>");
        })
        .fail(function (jqXHR) {
            alert("Неможливо додати категорію! " + jqXHR.responseText);
        });
}

/* registration */

function validate(form) {
    let error = document.getElementById("error")
    let password = form.password.value;
    let repeated_password = form.repeated_password.value;

    if (repeated_password === '') {
        document.getElementById("error").hidden = false;
        error.textContent = "Введіть пароль"
        error.style.color = "red"
    } else if (password !== repeated_password) {
        document.getElementById("error").hidden = false;
        error.textContent = "Паролі не співпадають"
        error.style.color = "red"
        return false;
    } else {
        error.textContent = ""

    }

}


/* upd account */
function updateUser() {
    let login = $("#login").val();
    let fullName = $("#fullName").val();
    let email = $("#email").val();


    $.get("/account/update",
        {
            'login': login,
            'fullName': fullName,
            'email': email
        })

        .done(function (data) {
            $('#updateUser').modal('hide');

            let user = JSON.parse(data);
            $("#hideAfterRefresh").hide();

            $('#updUser').append("" +
                "<div class='row'>" +
                "<div class='col-md-5 mt-3 text-center px-4 py-4'>" +
                "<p class='mb-4'><small>login</small></p>" +
                "<strong class='mt-4'> " + user.login + "</strong></div>" +
                "<div class='col-md-7'><div class='card-body p-3'>" +
                " <div class='row pt-3 px-4 py-4 text-center'><div class='col-6 mb-4'>" +
                "<p>Ім'я</p><p>" + user.fullName + "</p></div><div class='col-6 mb-3'>" +
                "<p>Email</p> <p>" + user.email + "</p> </div> <div>" +
                "<button type='submit' class='mt-2 btn btn-add btn-ac' data-bs-toggle='modal' " +
                "data-bs-target='#updateUser'>Редагувати профіль" +
                "</button></div></div> </div> </div> </div>");
        })
        .fail(function (jqXHR) {
            alert("Неможливо оновити дані! " + jqXHR.responseText);
        });
}







