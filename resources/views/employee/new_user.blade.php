@extends('layout.menu_layout')
@section('main_content')

    <!DOCTYPE html>
    <html>

    <head>
        <title>Tag felvétel</title>
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
                color: #000000;
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
                width: 100%;
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

    @if (!(Auth::user()->type === "D"))
        <script>
            window.location = "/main/successlogin";

        </script>
    @endif


    <body>
        <div class="main-block">
            <form action="register" method="POST" id="form" form="myForm">
                @csrf
                <h1>Adja meg az új felhasználó adatait!</h1>
                <fieldset>
                    <legend>
                        <h3>Fiók információk</h3>
                    </legend>
                    <div class="account-details">
                        <div><label>Email*</label><input type="text" name="email" required></div>
                    </div>
                </fieldset>
                <legend>
                    <h3>Személyes információk</h3>
                </legend>
                <div class="personal-details">
                    <div>
                        <div><label>Teljes név*</label><input type="text" name="name" required></div>
                        <div><label>Település*</label><input type="text" name="city" required></div>
                        <div><label>Cím*</label><input type="text" name="address" required></div>
                        <div><label>Jelszó*</label><input type="password" name="password" id="passwordrandom" required readonly></div>
                        <div>
                            <label>Hallgatói státusz*</label>
                            <select name="type">
                                <option value="">Válasszon...</option>
                                <option value="EH" type="text" name="type">ELTE hallgató</option>
                                <option value="EO" type="text" name="type">ELTE oktató</option>
                                <option value="ME" type="text" name="type">Másik egyetem hallgatója, vagy oktatója</option>
                                <option value="E" type="text" name="type">Egyéb</option>
                                <option value="D" type="text" name="type">Dolgozó</option>
                            </select>
                        </div>
                    </div>
                </div>
                <button type="submit" href="/">Adatok Mentése</button>
            </form>
        </div>
        <script>   
                // dec2hex :: Integer -> String
                // i.e. 0-255 -> '00'-'ff'
                function dec2hex (dec) {
                return dec.toString(16).padStart(2, "0")
                }
                // generateId :: Integer -> String
                function generateId (len) {
                var arr = new Uint8Array((len || 40) / 2)
                window.crypto.getRandomValues(arr)
                return Array.from(arr, dec2hex).join('')

                }   
                document.getElementById("passwordrandom").value = generateId(8);
        </script>
    </body>

    </html>

@endsection
