<head>
    @if (Route::has('login'))
        <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
            @auth
                <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Dashboard</a>
            @endauth
        </div>
    @endif
</head>
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
            <th>タグ</th>
            <th>公開設定</th>
            <th colspan="2">操作</th>
        </tr>

        <form method="POST" action="{{ route('posts.release') }}" id="release">
            @csrf
            @isset($posts)
                @foreach ($posts as $post)
                    <tr>
                        <td>{{ $post->task_name }}</td>
                        <td>{{ $post->task_description }}</td>
                        <td>{{ $post->user->name }}</td>
                        <td>{{ $post->estimate_hour }}</td>
                        <td>{{ $post->created_at }}</td>
                        <td>{{ App\Enums\Priority::from($post->priority)->label() }}</td>
                        <td>
                            @foreach ($post->tags as $tag)
                                {{ $tag->name }}
                            @endforeach
                        </td>
                        <td>
                            <div class="form-group">
                                @php
                                    $loop_index = $loop->index;
                                @endphp
                                <input type="hidden" name="release[{{ $loop->index }}][post_id]"
                                    value="{{ $post->id }}">
                                @foreach (App\Enums\Release::cases() as $release)
                                    <input type='radio' name="release[{{ $loop_index }}][release]"
                                        value="{{ $release->value }}" @checked(old('release', $post->release) == $release->value)>
                                    {{ $release->label() }}
                                @endforeach
                            </div>
                        </td>
                        <td><a href="{{ route('posts.edit', ['post' => $post->id]) }}">編集</a></td>
                        <td><a href="{{ route('posts.delete', ['post' => $post->id]) }}">削除</a></td>
                    </tr>
                @endforeach
            @endisset
        </form>
    </table>
    <input type="submit" form="release" value="公開設定を変更">

    @isset($estimate_hour_sum)
        <p>
            見積時間の合計(h):{{ $estimate_hour_sum }}
        </p>
    @endisset
</div>
