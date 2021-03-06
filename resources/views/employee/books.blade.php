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

    </style>

    @if (!(Auth::user()->type === 'D'))
        <script>
            window.location = "/main/successlogin";

        </script>
    @endif

    <section>
        <!--for demo wrap-->
        <h1>K??nyvek</h1>
        <div style="display: flex;">
        <form  action="{{ route('search1') }}" method="GET">
                    <input autocomplete="off" style="margin-left: 5px; margin-right: 5px; margin-bottom: 10px; width: 400px; height: 26px;" type="text" name="search1" required/>
                    <button style="background-color: #5c5edc; width: 100px; height: 25px;" type="submit"><a
                    href="/books">
                    <span style="color: #FFFFFF">Keres??s</a></span></button>
        </form>


        
                    <input placeholder="K??lcs??nz?? e-mail c??me ..." id="masteremail" autocomplete="off" name="email" style="margin-left:auto; margin-right: 0; width: 400px; height: 26px;" type="text" required/>

        </div>
        <div><p style="text-align: right; margin-left:auto; margin-bottom:5px; margin-right:0px; color:red; margin-top:0px;"><?php echo session('userNotexistError'); session()->forget('userNotexistError');?></p></div>

        <div class="tbl-header">
            <table id="example" cellpadding="0" cellspacing="0" border="0">
                <thead>
                    <tr>
                        <th>C??m</th>
                        <th>Szerz??(k)</th>
                        <th>ISBN</th>
                        <th>Kiad??s ??ve</th>
                        <th>Kiad??s</th>
                        <th>El??rhet?? (db)</th>
                        <th>??sszes (db)</th>
                        <th>M??velet</th>
                    </tr>
                </thead>
            </table>
        </div>
        <div class="tbl-content">
            <table cellpadding="1" cellspacing="1" border="0">
                <tbody>
                    @foreach ($books as $item)
                    <form  action="rent/{{ $item->id }}/" class="itemforms" id="{{ $item->isbn }}" method="GET" style="margin-left:auto; margin-right: 0;">
                        {{ csrf_field() }}
                        <tr id="{{ $item->id }}">
                            <td>
                            {{ $item->title }}
                            
                            </td>
                            <td>{{ $item->writer }}
                            
                            </td>
                            <td>{{ $item->isbn }}
                            
                            </td>
                            <td>{{ $item->year }}
                            
                            </td>
                            <td>{{ $item->edition }}
                            
                            </td>
                            <td>{{ $item->number }}
                            
                            </td>
                            <td>{{ $item->max_number }}
                            
                            </td>
                            <td>
                                <a onclick="return confirm('Biztosan t??r??lni akarja?');" href="deleteBook/{{ $item->id }}">T??rl??s</a><br />
                                <input type="hidden" class="emails_hidden">
                                
                                <a onclick="emails('{{ $item->isbn }}');getElementById('{{ $item->isbn }}').submit();">Kiad??s</a><br />
                            
                                <strong><a href="plusone/{{ $item->id }}" style="margin-right: 35px">+</a><a href="minusone/{{ $item->id }}">-</a><br /></strong>
                            </td>
                        </tr>
                        </form>
                    @endforeach
                    <script>
                    function emails($isbn){
                        url = $('#'+$isbn).attr('action');
                        $('#'+$isbn).attr('action', url+$('#masteremail').val());
                    }
                    
                    </script>
                </tbody>
            </table>
        </div>
        
        <div>
            <button style="margin-top: 50px; margin-left: 100px; background-color: #5c5edc; width: 150px; height: 50px;"> <a
                    href="/new_book">
                    <span class="style2" style="color: #FFFFFF">??j k??nyv</span></a></button>
        </div>
    </section>
    <?php
    if(session()->has('deletebook')){
        echo "<script>alert('".session('deletebook')."');</script>";
        session()->forget('deletebook');
    }
    ?>
    <?php
    if(session()->has('newbook')){
        echo "<script>alert('".session('newbook')."');</script>";
        session()->forget('newbook');
    }
    ?>
    <?php
    if(session()->has('rent')){
        echo "<script>alert('".session('rent')."');</script>";
        session()->forget('rent');
    }
    ?>

    <?php
    if(session()->has('minusbook')){
        echo "<script>alert('".session('minusbook')."');</script>";
        session()->forget('minusbook');
    }
    ?>
    <?php
    if(session()->has('plusbook')){
        echo "<script>alert('".session('plusbook')."');</script>";
        session()->forget('plusbook');
    }
    ?>


@endsection
