<!doctype html>
<html lang="ja">
<head><meta charset="utf-8"><title>予定追加</title></head>
<body style="max-width:720px;margin:40px auto;font-family:sans-serif;">
  <h1>予定追加</h1>

  @if($errors->any())
    <ul style="color:red;">
      @foreach($errors->all() as $e) <li>{{ $e }}</li> @endforeach
    </ul>
  @endif

  <form method="POST" action="{{ route('events.store') }}">
    @csrf

    <div style="margin:10px 0;">
      <label>タイトル（必須）</label><br>
      <input name="title" value="{{ old('title') }}" style="width:100%;padding:8px;">
    </div>

    <div style="margin:10px 0;">
      <label>開始日時（必須）</label><br>
      <input type="datetime-local" name="start_at" value="{{ old('start_at') }}" style="padding:8px;">
    </div>

    <div style="margin:10px 0;">
      <label>終了日時（任意）</label><br>
      <input type="datetime-local" name="end_at" value="{{ old('end_at') }}" style="padding:8px;">
    </div>

    <div style="margin:10px 0;">
      <label>メモ（任意）</label><br>
      <textarea name="notes" rows="4" style="width:100%;padding:8px;">{{ old('notes') }}</textarea>
    </div>

    <button type="submit" style="padding:8px 12px;">保存</button>
    <a href="{{ route('events.index') }}">戻る</a>
  </form>
</body>
</html>
