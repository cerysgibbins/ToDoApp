<style>

</style>

<h1>TODos</h1>
<ul>
    @foreach($todos as $todo)
        <li>
            {{ $todo['note'] }} 

            @if ($todo['due_date'])
                {{ date('d/m/Y', strtotime($todo['due_date'])) }}
            @endif

            <form method="post" action="/{{ $todo['id'] }}" enctype="multipart/form-data">
                @csrf
                <input name="_method" type="hidden" value="DELETE">
                <button>Delete</button>
            </form>

            <a href="/{{ $todo['id'] }}">Edit</a>

            <form method="post" action="/{{ $todo['id'] }}/complete" enctype="multipart/form-data">
                @csrf
                <input name="_method" type="hidden" value="PUT">
                <button>Complete</button>
            </form>
        </li>
    @endforeach
</ul>

<form method="post" enctype="multipart/form-data">
    @csrf
    <textarea name="note">{{ old('note') }}</textarea>
    <input type="date" name="due_date" value="{{ old('due_date') }}">
    <button>Add New</button>
</form>

@foreach ($errors->all() as $error)
    <div>{{ $error }}</div>
@endforeach

<ul>
    @foreach($completed as $todo)
        <li>
            {{ $todo['note'] }} 

            @if ($todo['due_date'])
                {{ date('d/m/Y', strtotime($todo['due_date'])) }}
            @endif

            <form method="post" action="/{{ $todo['id'] }}" enctype="multipart/form-data">
                @csrf
                <input name="_method" type="hidden" value="DELETE">
                <button>Delete</button>
            </form>

            <form method="post" action="/{{ $todo['id'] }}/uncomplete" enctype="multipart/form-data">
                @csrf
                <input name="_method" type="hidden" value="PUT">
                <button>Uncomplete</button>
            </form>
        </li>
    @endforeach
</ul>
