<h1>RESPOSTAS FEMININO</h1>
@foreach($categories as $category)

@if($category->sex=='FEMININO')
<b>{{$category->description}}</b>
<br>
@foreach ($category->answers as $anwer)
   {{$anwer->response}} 
   <br>
   <br>
@endforeach
@endif
<br>
@endforeach