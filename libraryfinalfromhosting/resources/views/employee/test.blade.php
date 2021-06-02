<table border=1>
    @foreach ($data as $item)
        <tr>
            <td>{{$item->title}}</td>
            <td>{{$item->writer}}</td>
            <td>{{$item->isbn}}</td>
            <td>{{$item->year}}</td>
            <td>{{$item->edition}}</td>
            <td>{{$item->number}}</td>
            <td>{{$item->max_number}}</td>
        </tr>
    @endforeach
</table>
{{-- <table border=1>
    @foreach ($stock as $item)
        <tr>
            <td>{{$item->isbn}}</td>
            <td>{{$item->max_number}}</td>
            <td>{{$item->number}}</td>
        </tr>
    @endforeach
</table> --}}
