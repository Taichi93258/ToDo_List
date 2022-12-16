<h1>post List</h1>
<div>
    <h2>タスクを削除</h2>
    <form method="POST" action="{{ route('todolists.destroy', ['todolist' => $post->id]) }}">
        @method('DELETE')
        @csrf
        <p>
            タスクの名前：{{ $post->task_name }}
        </p>
        <p>
            タスクの説明：{{ $post->task_description }}
        </p>
        <p>
            担当者の名前：{{ $post->user->name }}
        </p>
        <p>
            見積時間(h) :{{ $post->estimate_hour }}
        <p>
        <p>
            優先度 :{{ App\Enums\Priority::from($post->priority)->label() }}
        </p>
        <input type="submit" name="delete" value="削除">
    </form>
    <a href="/">戻る</a>
</div>
