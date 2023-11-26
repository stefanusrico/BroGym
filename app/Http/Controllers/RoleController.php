<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();

        return view('auth.roles.index', ['roles' => $roles]);
    }

    public function create()
    {
        return view('auth.roles.creates');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:role|max:255',
        ]);

        Role::create([
            'name' => $request->input('name'),
        ]);

        return redirect()->route('auth.roles.index')->with('success', 'Role created successfully.');
    }

    public function edit(Role $role)
    {
        return view('roles.edit', compact('user', 'roles'));
    }

    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:roles,name,' . $role->id,
        ]);

        $role->update([
            'name' => $request->input('name'),
        ]);

        return redirect()->route('auth.roles.index')->with('success', 'Role updated successfully.');
    }

    public function destroy(Role $role)
    {
        $role->delete();

        return redirect()->route('roles.index')->with('success', 'Role deleted successfully.');
    }
}