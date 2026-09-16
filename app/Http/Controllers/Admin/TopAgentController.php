<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TopAgent;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Http\Request;

class TopAgentController extends Controller
{
    public function index()
    {
        $data = [];

        if (session()->has('admin_id')) {
            $adminId       = session('admin_id');
            $data['admin'] = Admin::find($adminId);
        } else {
            return redirect('/admin/login');
        }

        $topAgents = TopAgent::with('user')->orderBy('order')->get();
        $agents = User::where('is_agent', true)->get();

        return view('admin.top-agents.index', compact('topAgents', 'agents'))->with('admin', $data['admin']);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,_id',
            'custom_text' => 'nullable|string',
            'order' => 'required|integer'
        ]);

        TopAgent::create($validated);

        return redirect()->route('admin.top-agents.index')->with('success', 'مشاور با موفقیت اضافه شد.');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'custom_text' => 'nullable|string',
            'order' => 'required|integer'
        ]);

        $topAgent = TopAgent::findOrFail($id);
        $topAgent->update($validated);

        return redirect()->route('admin.top-agents.index')->with('success', 'مشاور با موفقیت بروزرسانی شد.');
    }

    public function destroy($id)
    {
        $topAgent = TopAgent::findOrFail($id);
        $topAgent->delete();

        return redirect()->route('admin.top-agents.index')->with('success', 'مشاور با موفقیت حذف شد.');
    }

    public function updateOrder(Request $request)
    {
        $order = $request->input('order');

        foreach ($order as $id => $position) {
            TopAgent::where('_id', $id)->update(['order' => $position]);
        }

        return response()->json(['success' => true]);
    }
}