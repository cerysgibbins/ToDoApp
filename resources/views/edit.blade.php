<h1>TODos</h1>

<form method="post" action="/{{ $todo['id'] }}" enctype="multipart/form-data">
    @csrf
    <input name="_method" type="hidden" value="PUT">
    <textarea name="note">{{ $todo['note'] }}</textarea>
    <input type="date" name="due_date" value="{{ date('Y-m-d', strtotime($todo['due_date'])) }}">
    <button>Save</button>
</form>

@foreach ($errors->all() as $error)
    <div>{{ $error }}</div>
@endforeach