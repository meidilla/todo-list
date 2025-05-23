<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Task; // Pastikan ini benar (Task atau Item)
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function insert(Request $request) // Tambahkan Request $request
    {
        // Validasi input (sangat penting!)
        $request->validate([
            'item' => 'required|string|max:255', // Nama input di form adalah 'item'
            'priority' => 'required|string|in:Normal,High,Urgent', // Wajib diisi, dan hanya boleh nilai ini
            'category' => 'nullable|string|max:255', // Boleh kosong (nullable)
        ]);

        $task = new Task();
        $task->name = $request->input('item'); // Ambil dari input 'item'
        $task->priority = $request->input('priority'); // Ambil dari input 'priority'
        $task->category = $request->input('category'); // Ambil dari input 'category'
        $task->save();

        return redirect('/dashboard'); // Atau, lebih baik: return redirect()->route('dashboard'); jika kamu punya named route
    }

    public function delete($id)
    {
        $to_delete = Task::where('id', $id)->firstOrFail();
        $to_delete->delete();

        return redirect('/dashboard'); // Atau, lebih baik: return redirect()->route('dashboard');
    }
}