@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif
<form action="{{route('project.update', ['project' => $project->id])}}" method="post">
    {!! csrf_field() !!}
    <input name="_method" type="hidden" value="PATCH">
    <input type="text" name="module" value="Project" hidden>
    <input type="text" name="uuid" value="{{$project->uuid}}" hidden>
    <label for="title">
        <input type="text" id="title" name="title" placeholder="Project Title" value="{{ $project->title }}">
        <br>
        <span style="color: indianred">@error('title') {{ $message }} @enderror</span>
    </label>
    <br>
    <label for="title">
        <input type="text" id="deal" name="deal" placeholder="Deal Amount" value="{{ $project->deal_amount }}">
        <br>
        <span style="color: indianred">@error('deal') {{ $message }} @enderror</span>
    </label>
    <br>
    <button type="submit">Create</button>
</form>

<div>
    <ul>
        @foreach(\App\EventLogs::where('action', 'UPDATE')->where('attributes->uuid', $project->uuid)->orderBy('id')->get() as $changes)
            <li>User changed the {{$changes->field}} to {{ $changes->attributes[$changes->field] }} </li>
        @endforeach
    </ul>
</div>
