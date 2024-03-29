<head>
    @if (Route::has('login'))
        <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
            @auth
                <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}"
                        class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                @endif
            @endauth
        </div>
    @endif
</head>


<h1>Posts List</h1>
<div>
    @auth
        <a href="/posts/create">タスクを追加</a>
    @endauth
    <form action="{{ route('posts.index') }}" method="GET">
        @foreach ($tags as $tag)
            <input type="checkbox" name="tags[]" value="{{ $tag->id }}" multiple @checked(in_array($tag->id, $select_tags))>
            {{ $tag->name }}
        @endforeach
        <button type="submit">検索する</button>
    </form>
    <table border="1">
        <tr>
            <th>タスクの名前</th>
            <th>タスクの説明</th>
            <th>担当者の名前</th>
            <th>見積時間(h)</th>
            <th>投稿時間</th>
            <th>優先度</th>
            <th>タグ</th>
            <th colspan="2">操作</th>
        </tr>

        @isset($posts)
            @foreach ($posts as $post)
                @if ($post->release == App\Enums\Release::PRIVATE->value)
                    @continue
                @endif
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
                    @can('update', $post)
                        <td><a href="{{ route('posts.edit', ['post' => $post->id]) }}">編集</a></td>
                    @endcan
                    @can('delete', $post)
                        <td><a href="{{ route('posts.delete', ['post' => $post->id]) }}">削除</a></td>
                    @endcan

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
