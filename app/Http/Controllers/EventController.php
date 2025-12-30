<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Carbon\Carbon;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');
        $scope   = $request->input('scope', 'today'); // today | all

        $query = $request->user()->events();

        // 表示切り替え
        if ($scope === 'today') {
            $query->whereDate('start_at', Carbon::today());
        }

        // 検索（タイトル / メモ）
        if (!empty($keyword)) {
            $query->where(function ($q) use ($keyword) {
                $q->where('title', 'like', "%{$keyword}%")
                  ->orWhere('notes', 'like', "%{$keyword}%");
            });
        }

        $events = $query->orderBy('start_at')->get();

        return view('events.index', compact('events', 'keyword', 'scope'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('events.create');
    }

    /**
     * Store a newly created resource in storage.
     */
public function store(Request $request)
{
    $validated = $request->validate([
        'title'    => ['required', 'string', 'max:255'],
        'start_at' => ['required', 'date'],
        'end_at'   => ['nullable', 'date', 'after_or_equal:start_at'],
        'notes'    => ['nullable', 'string'],
    ]);

    $request->user()->events()->create($validated);

    return redirect()->route('events.index');
}

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        // 今回は未使用
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        return view('events.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'title'    => ['required', 'string', 'max:255'],
            'start_at' => ['required', 'date'],
            'end_at'   => ['nullable', 'date', 'after_or_equal:start_at'],
            'notes'    => ['nullable', 'string'],
        ]);

        $event->update($validated);

        return redirect()->route('events.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()->route('events.index');
    }
}
