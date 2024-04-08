<h1>Editar Dúvida {{$support->id}}</h1>

<x-alert/>

<form action="{{route('supports.update', $support->id)}}" method="post">
    <!-- <input type="text" value="{{csrf_token()}}" name="token"> -->
    @method('put')
    @include('admin.supports.partials.form',[
        'support' => $support
    ])
</form>