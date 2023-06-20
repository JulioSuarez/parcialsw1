prueba
@foreach ($value as $d)
<p>{{$d["id"]}}</p>
<p>{{$d["name"]}}</p>
<p>{{$d["id_diagrama"]}}</p>
@dd($d)
@endforeach
