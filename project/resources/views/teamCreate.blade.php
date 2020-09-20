

<form action="{{route('store')}}" method="POST">
    @method('POST')
    @csrf

    <label for="name">Nome</label>
    <input type="text" id="name" name="name" value="{{ old('name') }}">

    <button type="submit">Invia</button>
</form>