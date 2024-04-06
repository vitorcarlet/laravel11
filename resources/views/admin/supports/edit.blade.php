<h1>Editar Dúvida {{$support->id}}</h1>

<form action="{{route('supports.update', $support->id)}}" method="post">
    <!-- <input type="text" value="{{csrf_token()}}" name="token"> -->
    @csrf() 
    @method('put')
    <input type="text" placeholder="Assunto" name="subject" value="{{$support->subject}}"> 
    <textarea name="body" id="" cols="30" rows="5" placeholder="Descrição">{{$support->body}}</textarea>
    <button type="submit">Enviar</button>
</form>