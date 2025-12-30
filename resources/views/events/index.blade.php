<!doctype html>
<html lang="ja">
<head><meta charset="utf-8"><title>予定一覧</title></head>
<body style="max-width:720px;margin:40px auto;font-family:sans-serif;">
  <h1>
  {{ ($scope ?? 'today') === 'today' ? '今日の予定' : 'すべての予定' }}
  （{{ now()->format('Y/m/d') }}）
</h1>
<form method="POST" action="{{ route('logout') }}" style="display:inline;">
  @csrf
  <button type="submit" style="padding:6px 10px;">ログアウト</button>
</form>
<p style="margin:0 0 12px 0;opacity:.7;">
  ログイン中：{{ auth()->user()->name }}
</p>
  <p><a href="{{ route('events.create') }}">＋ 予定を追加</a></p>

  {{-- 表示切り替え --}}
<div style="margin:8px 0;">
  @if(($scope ?? 'today') === 'today')
    <strong>今日の予定</strong> |
    <a href="{{ route('events.index', ['scope' => 'all', 'keyword' => $keyword ?? null]) }}">
      すべて表示
    </a>
  @else
    <a href="{{ route('events.index', ['scope' => 'today', 'keyword' => $keyword ?? null]) }}">
      今日の予定
    </a> |
    <strong>すべて表示</strong>
  @endif
</div>


  {{-- 検索フォーム（GET） --}}
  <form method="GET" action="{{ route('events.index') }}"
        style="display:flex;gap:8px;align-items:center;margin:12px 0;">
    <input
      type="text"
      name="keyword"
      value="{{ $keyword ?? '' }}"
      placeholder="タイトル / メモで検索"
      style="flex:1;padding:8px;"
    >
    <button type="submit" style="padding:8px 12px;">検索</button>

    @if(!empty($keyword))
      <a href="{{ route('events.index') }}"
         style="padding:8px 12px;display:inline-block;">クリア</a>
    @endif
  </form>

  @if(!empty($keyword))
    <p style="margin:0 0 12px 0;opacity:.7;">「{{ $keyword }}」で検索中</p>
  @endif

  <table border="1" cellpadding="8" cellspacing="0" width="100%">
    <tr>
      <th>日時</th><th>タイトル</th><th>操作</th>
    </tr>
    @forelse($events as $event)
      <tr>
        <td>{{ \Carbon\Carbon::parse($event->start_at)->format('Y-m-d H:i') }}</td>
        <td>{{ $event->title }}</td>
        <td>
          <a href="{{ route('events.edit', $event) }}">編集</a>
          <form action="{{ route('events.destroy', $event) }}" method="POST" style="display:inline;">
            @csrf @method('DELETE')
            <button type="submit" onclick="return confirm('削除しますか？')">削除</button>
          </form>
        </td>
      </tr>
    @empty
      <tr><td colspan="3">予定はありません</td></tr>
    @endforelse
  </table>
</body>
</html>
