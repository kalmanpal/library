@extends('layout.menu_layout')
@section('main_content')

    <html>

    <head>
        <title>Új könyv felvétel</title>
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
            select,
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
                color: #45464e;
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
            <form action="new_book" method="POST">
                @csrf
                <h1>Adja meg a könyv adatait!</h1>
                <fieldset>
                    <legend>
                        <h3>Könyv információk</h3>
                    </legend>
                    <div class="account-details">
                        <div><label>Cím*</label> <input autocomplete="off" type="text" name="title" required></div>
                        <div><label>Szerző(k)*</label> <input autocomplete="off" type="text" name="writer" required></div>
                        <div><label>Kiadó*</label> <input autocomplete="off" type="text" name="publisher" required></div>
                        <div><label>Kiadás éve*</label> <input autocomplete="off" type="text" name="year" required></div>
                        <div><label>Kiadás*</label> <input autocomplete="off" type="text" name="edition" required></div>
                        <div><label>ISBN*</label> <input autocomplete="off" type="text" name="isbn" required></div>
                        <div><p style="margin-left:100px; color:red;"><?php echo session('isbnExistError'); session()->forget('isbnExistError');?></p></div>
                    </div>
                </fieldset>
                <fieldset>
                    <legend>
                        <h3>Nyilvántartás</h3>
                    </legend>
                    <div class="personal-details">
                        <div>
                            <div><label>Összes könyv (db)*</label><input autocomplete="off" type="text" name="max_number" required></div>
                        </div>

                    </div>
                </fieldset>
                <button type="submit" href="/">Könyv felvétel</button>
            </form>
        </div>
    </body>

    </html>

@endsection
