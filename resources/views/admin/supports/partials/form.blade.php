@csrf()
<input type="text" placeholder="Assunto" name="subject" value="{{$support->subject ?? old('subject')}}">
<textarea name="body" id="" cols="30" rows="5" placeholder="Descrição">{{$support->body ?? old('subject')}}</textarea>
<button type="submit">Enviar</button>