<h1>MyPage</h1>
<div>
    <a href="/create-page">タスクを追加</a>
    <table border="1">
        <tr>
            <th>タスクの名前</th>
            <th>タスクの説明</th>
            <th>担当者の名前</th>
            <th>見積時間(h)</th>
            <th>投稿時間</th>
            <th colspan="2">操作</th>
        </tr>

        @isset($posts)
            @foreach ($posts as $post)
                <tr>
                    <td>{{ $post->task_name }}</td>
                    <td>{{ $post->task_description }}</td>
                    <td>{{ $post->user->name }}</td>
                    <td>{{ $post->estimate_hour }}</td>
                    <td><a href="/edit-page/{{ $post->id }}">編集</a></td>
                    <td><a href="/delete-page/{{ $post->id }}">削除</a></td>
                </tr>
            @endforeach
        @endisset
    </table>

    @isset($estimate_hour_sum)
        <p>
            見積時間の合計(h):{{ $estimate_hour_sum }}
        </p>
    @endisset
</div>