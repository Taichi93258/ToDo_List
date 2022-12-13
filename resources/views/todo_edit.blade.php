<h1>post List</h1>
<div>
    <h2>タスクの修正</h2>
    <form method="POST" action="/edit">
        @csrf
        @if ($errors->any())
            <ul>
                @foreach ($errors->all() as $error)
                    <li style="color:red">{{ $error }}</li>
                @endforeach
            </ul>
        @endif
        <input type="hidden" name="id" value="{{ $post->id }}">
        <p>
            タスクの名前：<input type="text" name="task_name" value="{{ $post->task_name }}">
        </p>
        <p>
            タスクの説明：<input type="text" name="task_description" value="{{ $post->task_description }}">
        </p>
        <p>
            担当者の名前：<input type="text" name="assign_person_name" value="{{ $post->user->name }}">
        </p>
        <p>
            見積時間(h) :<input type="number" name="estimate_hour" value="{{ $post->estimate_hour }}">
        </p>
        <div class="form-group">
            <label for="priority-field">優先順位</label>
            <select name="priority" id="priority-field">
                @foreach ($priorities as $priority)
                    <option value="{{ $priority->value }}" @selected(old('priority', $post->priority) == $priority->value)>
                        {{ $priority->label() }}</option>
                @endforeach
            </select>
        </div>
        <input type="submit" name="edit" value="修正">
    </form>
    <a href="/todo_list">戻る</a>
</div>
