@extends('layout.menu_layout')
@section('main_content')

    <style>
        h1 {
            font-size: 50px;
            color: #fff;
            text-transform: uppercase;
            font-weight: 300;
            text-align: center;
            margin-bottom: 15px;
        }

        table {
            width: 100%;
            table-layout: fixed;
            /* height: 80%; */
        }

        .tbl-header {
            background-color: #5c5edc;
            ;
        }

        .tbl-content {
            height: 500px;
            overflow-x: auto;
            margin-top: 0px;
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        th {
            padding: 10px 15px;
            text-align: left;
            font-weight: 500;
            font-size: 18px;
            color: #fff;
        }

        td {
            padding: 15px;
            text-align: left;
            vertical-align: middle;
            font-weight: 300;
            font-size: 18px;
            color: #fff;
            border-bottom: solid 1px rgba(255, 255, 255, 0.1);
        }


        /* demo styles */

        @import url(https://fonts.googleapis.com/css?family=Roboto:400,500,300,700);

        body {
            background-color: #2a2b30;
            font-family: 'Roboto', sans-serif;
        }

        section {
            margin: 50px;
        }


        /* follow me template */
        .made-with-love {
            margin-top: 40px;
            padding: 10px;
            clear: left;
            text-align: center;
            font-size: 10px;
            font-family: arial;
            color: #fff;
        }

        .made-with-love i {
            font-style: normal;
            color: #F50057;
            font-size: 14px;
            position: relative;
            top: 2px;
        }

        .made-with-love a {
            color: #fff;
            text-decoration: none;
        }

        .made-with-love a:hover {
            text-decoration: underline;
        }


        /* for custom scrollbar for webkit browser*/

        ::-webkit-scrollbar {
            width: 6px;
        }

        ::-webkit-scrollbar-track {
            -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
        }

        ::-webkit-scrollbar-thumb {
            -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
        }

        button.a {
            width: 150px;
            height: 50px;
            background-color: #5c5edc;
            float: right;
            padding-top: 0;
            padding-right: 15px;
            display: block;
            float: none;
        }

    </style>

    @if (!(Auth::user()->type === "D"))
        <script>
            window.location = "/main/successlogin";

        </script>
    @endif

    <section>
        <!--for demo wrap-->
        <h1>Felhaszn??l??k</h1>
        <form  action="{{ route('search') }}" method="GET">
                    <input style="margin-left: 5px; margin-right: 5px; margin-bottom: 10px; width: 400px; height: 26px;" type="text" name="search" required/>
                    <button style="background-color: #5c5edc; width: 100px; height: 25px;" type="submit"><a
                    href="/new_user">
                    <span class="style2" style="color: #FFFFFF">Keres??s</a></span></button>
        </form>
        <div class="tbl-header">
            <table cellpadding="0" cellspacing="0" border="0">
                <thead>
                    <tr>
                        <th>N??v</th>
                        <th>E-mail</th>
                        <th>Telep??l??s</th>
                        <th>C??m</th>
                        <th>T??pus</th>
                    </tr>
                </thead>
            </table>
        </div>
        <div class="tbl-content">
            <table cellpadding="1" cellspacing="1" border="0">
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->city }}</td>
                            <td>{{ $user->address }}</td>
                            <td>{{ $user->type }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div>
            <button style="margin-top: 50px; margin-left: 250px; background-color: #5c5edc; width: 150px; height: 50px;"> <a
                    href="/new_user">
                    <span class="style2" style="color: #FFFFFF">??j felhaszn??l??</a></span></button>
        </div>
    </section>

    <?php
    if(session()->has('newuser')){
        echo "<script>alert('".session('newuser')."');</script>";
        session()->forget('newuser');
    }
    ?>

@endsection
