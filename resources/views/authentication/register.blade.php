<!DOCTYPE html>
<html>

<head>
    <title>Account registration form</title>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600' rel='stylesheet'
        type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <style>
        html,
        body {
            min-height: 100%;
        }

        body,
        div,
        form,
        p {
            padding: 0;
            margin: 0;
            outline: none;
            font-family: Roboto, Arial, sans-serif;
            font-size: 14px;
            color: #fff;
        }

        input {
            padding: 0;
            margin: 0;
            outline: none;
            font-family: Roboto, Arial, sans-serif;
            font-size: 14px;
            color: #fff;
        }

        h1 {
            margin: 0;
            font-weight: 400;
        }

        h3 {
            margin: 12px 0;
            color: #5c5edc;
        }

        .main-block {
            display: flex;
            justify-content: center;
            align-items: center;
            background: #2a2b30;
        }

        form {
            width: 70%;
            padding: 20px;
        }

        fieldset {
            border: none;
            border-top: 1px solid #5c5edc;
        }

        .account-details,
        .personal-details {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .account-details>div,
        .personal-details>div>div {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .account-details>div,
        .personal-details>div,
        input,
        label {
            width: 100%;
        }

        label {
            padding: 0 5px;
            text-align: right;
            vertical-align: middle;
        }

        input {
            padding: 5px;
            vertical-align: middle;
        }

        .checkbox {
            margin-bottom: 10px;
        }

        select,
        .children,
        .gender,
        .bdate-block {
            width: calc(100% + 26px);
            padding: 5px 0;
        }

        select {
            background: transparent;
            color: #5c5edc;
        }

        .gender input {
            width: auto;
        }

        .gender label {
            padding: 0 5px 0 0;
        }

        .bdate-block {
            display: flex;
            justify-content: space-between;
        }

        .birthdate select.day {
            width: 35px;
        }

        .birthdate select.mounth {
            width: calc(100% - 94px);
        }

        .birthdate input {
            width: 38px;
            vertical-align: unset;
        }

        .checkbox input,
        .children input {
            width: auto;
            margin: -2px 10px 0 0;
        }

        .checkbox a {
            color: #8888F3;
        }

        .checkbox a:hover {
            color: #8888F3;
        }

        button {
            width: 100%;
            padding: 10px 0;
            margin: 10px auto;
            border-radius: 5px;
            border: none;
            background: #5c5edc;
            font-size: 14px;
            font-weight: 600;
            color: #fff;
        }

        button:hover {
            background: #8888F3;
        }

        @media (min-width: 568px) {

            .account-details>div,
            .personal-details>div {
                width: 50%;
            }

            label {
                width: 40%;
            }

            input {
                width: 60%;
            }

            select,
            .children,
            .gender,
            .bdate-block {
                width: calc(60% + 16px);
            }
        }

    </style>
</head>

<body style="background-color: #2a2b30">

    @if (isset(Auth::user()->email))
    <script>
        window.location = "/main/successlogin";

    </script>
    @endif

    <div class="main-block">
        <form action="" method="POST">
            @csrf
            <h1>Hozzon létre egy felhaszálói fiókot!</h1>
            <fieldset>
                <legend>
                    <h3>Fiók információk</h3>
                </legend>
                <div class="account-details">
                    <div><label>Email*</label> <input type="text" name="t_email" required></div>
                    <div></div>
                    <div><label>Jelszó*</label> <input type="password" name="t_password" required></div>
                    <div><label>Jelszó újra*</label> <input type="password" name="t_passwordvar" required></div>
                </div>
            </fieldset>
            <fieldset>
                <legend>
                    <h3>Személyes információk</h3>
                </legend>
                <div class="personal-details">
                    <div>
                        <div><label>Teljes név*</label><input type="text" name="t_name" required></div>
                        <div><label>Település*</label><input type="text" name="t_city" required></div>
                        <div><label>Cím*</label><input type="text" name="t_address" required></div>
                        <div>
                            <label>Hallgatói státusz*</label>
                            <select name="t_type">
                                <option value="" name="t_type">Válasszon...</option>
                                <option value="EH" type="text" name="t_type">ELTE hallgató</option>
                                <option value="EO" type="text" name="t_type">ELTE oktató</option>
                                <option value="ME" type="text" name="t_type">Másik egyetem hallgatója, vagy oktatója</option>
                                <option value="E" type="text" name="t_type">Egyéb</option>
                            </select>
                        </div>
                    </div>

                </div>
            </fieldset>
            <fieldset>
                <legend>
                    <h3>Felhasználási feltételek</h3>
                </legend>
                <div class="terms-mailing">
                    <div class="checkbox">
                        <input type="checkbox" name="checkbox"><span>I accept the <a
                                href="https://www.w3docs.com/privacy-policy">Privacy Policy for
                                W3Docs.</a></span>
                    </div>
                    <div class="checkbox">
                        <input type="checkbox" name="checkbox"><span>I want to recelve personallzed
                            offers by your site</span>
                    </div>
            </fieldset>
            <button type="submit" href="/">Regisztráció</button>
            <label>
                <a href="/"><p style="color: #ffffff"> Már van fiókom, bejelentkezek <p></a>
            </label>
        </form>
    </div>
</body>

</html>
