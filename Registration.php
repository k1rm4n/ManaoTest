<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style-registration.css">
    <title>Registration</title>

</head>
<body>
    <noscript> 
        <style>
            #form .button__input{
                pointer-events: none;
            }
        </style>
    </noscript>
    <form action="Registration.php" method="POST" id="form">
        <div class="wrapper">
            <div class="container">
                <h2>Регистрация</h2>
                <div class="form__item">
                    <input class="form__input" type="text" name="login" placeholder="Логин">
                </div>
                <div class="form__item">
                    <input class="form__input" type="password" name="pass" placeholder="Пароль">
                </div>
                <div class="form__item">
                    <input class="form__input" type="password" name="confirm_pass" placeholder="Повторите пароль">
                </div>
                <div class="form__item">
                    <input class="form__input" type="text" require name="e-mail" placeholder="Электронная почта">
                </div>
                <div class="form__item">
                    <input class="form__input" type="text" name="name" placeholder="Имя">
                </div>

                <div class="item">
                    <input class="button__input" type="submit" name="button" value="Войти">
                </div>
                <ul class="error__block">

                </ul>
            </div>
        </div>
    </form>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script>
        const inputs = document.querySelectorAll('.form__input')
        var divError = document.querySelector('.error__block')
        $(divError).hide()

        function errorInput(name) {
            inputs.forEach(input => {
                if (input.getAttribute('name') == name) {
                    $(input).css('border', '1px solid #EB5757')
                }
            })
        }

        function clearInputs() {
            inputs.forEach(input => { $(input).css('border', '1px solid #000') })
        }

        $("#form").on('submit', function (event) {
            event.preventDefault();
            clearInputs()

            $.ajax({
                url: 'php/RegService.php',
                method: 'post',
                dataType: 'html',
                data: $(this).serialize(),
                success: function(data){

                    data = JSON.parse(data);

                    divError.innerHTML = '';
                    if ($(data.errors).length > 0) {
                        $(divError).show(200)
                        $(divError).css('background-color', '#EB5757')
                        $(divError).css('color', '#fff')

                        data.errors.forEach(item => {
                            divError.innerHTML += `<li>${item.text}</li>`;
                            errorInput(item.name)
                        })
                        return
                    }

                    if(data.message){
                        $(divError).css('background-color', '#DFFAC4')
                        $(divError).css('color', '#000')
                        $(divError).text(data.message)
                        $(divError).show(200)
                        location.href = "Authorization.php";
                    }
                }
            }); 
        });

    </script>
</body>
</html>