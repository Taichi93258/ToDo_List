<h1>ToDo List</h1>
<div>
    <h2>タスクを追加</h2>
    <form method="POST" action="/create">
        @csrf
        @if ($errors->any())
            <ul>
                @foreach ($errors->all() as $error)
                    <li style="color:red">{{ $error }}</li>
                @endforeach
            </ul>
        @endif
        <p>
            タスクの名前：<input type="text" name="task_name">
        </p>
        <p>
            タスクの説明：<input type="text" name="task_description">
        </p>
        <p>
            担当者の名前：<input type="text" name="assign_person_name">
        </p>
        <p>
            見積時間(h):<input type="number" name="estimate_hour">
        </p>
        <div class="form-group">
            <label for="priority-field">優先順位</label>
            <select name="priority" id="priority-field">
                @foreach ($priorities as $priority)
                    <option value="{{ $priority->value }}">{{ $priority->label() }}</option>
                @endforeach
            </select>
        </div>
        <input type="submit" name="create" value="追加">
    </form>
    <a href="/">戻る</a>
</div>
