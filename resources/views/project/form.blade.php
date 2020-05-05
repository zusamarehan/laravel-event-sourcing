<form action="{{route('project.store')}}" method="post">
    <input type="text" name="_token" value="{{csrf_token()}}" hidden>
    <input type="text" name="module" value="Project" hidden>
    <label for="title">
        <input type="text" id="title" name="title" placeholder="Project Title">
        <br>
        <span style="color: indianred">@error('title') {{ $message }} @enderror</span>
    </label>
    <br>
    <label for="title">
        <input type="text" id="deal" name="deal" placeholder="Deal Amount">
        <br>
        <span style="color: indianred">@error('deal') {{ $message }} @enderror</span>
    </label>
    <br>
    <button type="submit">Create</button>
</form>


<div>
    {{ \App\EventLog::all() }}
</div>
