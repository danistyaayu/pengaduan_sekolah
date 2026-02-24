<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::check() && Auth::user()->role !== 'admin') {
            return redirect('/login/admin');
        }

        $query = User::where('role', 'siswa')->latest();

        // Filter
        if ($request->filled('class')) {
            $query->where('class', $request->class);
        }

        if ($request->filled('major')) {
            $query->where('major', $request->major);
        }

        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('nis', 'like', '%' . $request->search . '%');
            });
        }

        $students = $query->paginate(15);

        $classes = ['X', 'XI', 'XII'];
        $majors = ['RPL', 'TKJ', 'MM', 'AKL', 'OTKP', 'BDP'];

        return view('admin.students.index', compact('students', 'classes', 'majors'));
    }

    public function create()
    {
        if (Auth::check() && Auth::user()->role !== 'admin') {
            return redirect('/login/admin');
        }

        $classes = ['X', 'XI', 'XII'];
        $majors = ['RPL', 'TKJ', 'MM', 'AKL', 'OTKP', 'BDP'];

        return view('admin.students.create', compact('classes', 'majors'));
    }

    public function store(Request $request)
    {
        if (Auth::check() && Auth::user()->role !== 'admin') {
            return redirect('/login/admin');
        }

        $request->validate([
            'nis' => 'required|string|unique:users,nis',
            'name' => 'required|string|max:255',
            'class' => 'required|string',
            'major' => 'required|string',
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        $password = $request->password ?? 'sekolah' . date('Y');

        $student = User::create([
            'nis' => $request->nis,
            'name' => $request->name,
            'class' => $request->class,
            'major' => $request->major,
            'role' => 'siswa',
            'password' => Hash::make($password),
            'must_change_password' => true,
            'is_active' => true,
        ]);

        return redirect()->route('admin.students.index')->with('success', 'Siswa berhasil ditambahkan!');
    }

    public function edit($id)
    {
        if (Auth::check() && Auth::user()->role !== 'admin') {
            return redirect('/login/admin');
        }

        $student = User::where('role', 'siswa')->findOrFail($id);
        $classes = ['X', 'XI', 'XII'];
        $majors = ['RPL', 'TKJ', 'MM', 'AKL', 'OTKP', 'BDP'];

        return view('admin.students.edit', compact('student', 'classes', 'majors'));
    }

    public function update(Request $request, $id)
    {
        if (Auth::check() && Auth::user()->role !== 'admin') {
            return redirect('/login/admin');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'class' => 'required|string',
            'major' => 'required|string',
        ]);

        $student = User::where('role', 'siswa')->findOrFail($id);

        $student->update([
            'name' => $request->name,
            'class' => $request->class,
            'major' => $request->major,
        ]);

        return redirect()->route('admin.students.index')->with('success', 'Data siswa berhasil diupdate!');
    }

    public function destroy($id)
    {
        if (Auth::check() && Auth::user()->role !== 'admin') {
            return redirect('/login/admin');
        }

        $student = User::where('role', 'siswa')->findOrFail($id);
        $student->delete();

        return redirect()->route('admin.students.index')->with('success', 'Siswa berhasil dihapus!');
    }

    public function resetPassword($id)
    {
        if (Auth::check() && Auth::user()->role !== 'admin') {
            return redirect('/login/admin');
        }

        $student = User::where('role', 'siswa')->findOrFail($id);
        $newPassword = 'sekolah' . date('Y');

        $student->update([
            'password' => Hash::make($newPassword),
            'must_change_password' => true,
        ]);

        return back()->with('success', "Password berhasil direset! Password baru: {$newPassword}");
    }

    public function toggleActive($id)
    {
        if (Auth::check() && Auth::user()->role !== 'admin') {
            return redirect('/login/admin');
        }

        $student = User::where('role', 'siswa')->findOrFail($id);
        $student->update(['is_active' => !$student->is_active]);

        $status = $student->is_active ? 'diaktifkan' : 'dinonaktifkan';
        return back()->with('success', "Akun siswa berhasil {$status}!");
    }
}