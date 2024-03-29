<h1>ToDo List</h1>
<div>
    <h2>タスクを追加</h2>
    <form method="POST" action="{{ route('posts.store') }}">
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
            担当者の名前：<input type="text" name="assign_person_name" value="<?= auth()->user()->name ?>" readonly>
        </p>
        <p>
            見積時間(h):<input type="number" name="estimate_hour">
        </p>
        <div class="form-group">
            <label for="priority-field">優先順位</label>
            <select name="priority" id="priority-field">
                @foreach (App\Enums\Priority::cases() as $priority)
                    <option value="{{ $priority->value }}">{{ $priority->label() }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            公開設定：
            @foreach (App\Enums\Release::cases() as $release)
                <input type='radio' name="release" value="{{ $release->value }}" @checked(old('release', App\Enums\Release::PUBLIC->value) == $release->value)>
                {{ $release->label() }}
            @endforeach
        </div>
        <div>
            タグ：
            @foreach ($tags as $tag)
                <input type="checkbox" name="tags[]" value="{{ $tag->id }}">
                {{ $tag->name }}
            @endforeach
        </div>
        <input type="submit" name="create" value="追加">
    </form>
    <a href="/">戻る</a>
</div>
