<h1>MyPage</h1>
<div>
    <a href="/posts/create">タスクを追加</a>
    <table border="1">
        <tr>
            <th>タスクの名前</th>
            <th>タスクの説明</th>
            <th>担当者の名前</th>
            <th>見積時間(h)</th>
            <th>投稿時間</th>
            <th>優先度</th>
            <th colspan="2">操作</th>
        </tr>

        @isset($posts)
            @foreach ($posts as $post)
                <tr>
                    <td>{{ $post->task_name }}</td>
                    <td>{{ $post->task_description }}</td>
                    <td>{{ $post->user->name }}</td>
                    <td>{{ $post->estimate_hour }}</td>
                    <td>{{ $post->created_at }}</td>
                    <td>{{ App\Enums\Priority::from($post->priority)->label() }}</td>
                    <td><a href="{{ route('posts.edit', ['post' => $post->id]) }}">編集</a></td>
                    <td><a href="{{ route('posts.delete', ['post' => $post->id]) }}">削除</a></td>
                </tr>
            @endforeach
        @endisset
    </table>

    @isset($estimate_hour_sum)
        <p>
            見積時間の合計(h):{{ $estimate_hour_sum }}
        </p>
    @endisset
    <form method="POST" action="{{ route('users.release', ['user' => $post->user->id]) }}">
        @csrf
        <div class="form-group">
            <label for="release-field">公開設定</label>
            <select name="release" id="release-field">
                @foreach (App\Enums\Release::cases() as $release)
                    <option value="{{ $release->value }}" @selected(old('priority', $post->user->release) == $release->value)>
                        {{ $release->label() }}</option>
                @endforeach
            </select>
        </div>
        <input type="submit" name="change" value="変更を反映">
    </form>
</div>
