<h1>post List</h1>
<div>
    <h2>タスクの修正</h2>
    <form method="POST" action="{{ route('posts.update', ['post' => $post->id]) }}">
        @method('PUT')
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
                @foreach (App\Enums\Priority::cases() as $priority)
                    <option value="{{ $priority->value }}" @selected(old('priority', $post->priority) == $priority->value)>
                        {{ $priority->label() }}</option>
                @endforeach
            </select>
        </div>
        <div>
            タグ：
            @foreach ($tags as $tag)
                <input type="checkbox" name="tags[]" value="{{ $tag->id }}" @checked(old('tags', $post->tags->contains('id', $tag->id)) == $tag->id)>
                {{ $tag->name }}
            @endforeach

        </div>
</div>
<input type="submit" name="edit" value="修正">
</form>
<a href="/">戻る</a>
</div>
