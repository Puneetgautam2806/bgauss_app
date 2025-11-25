<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\LinkTbl;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function login(Request $request)
    {
        // dd($request->all());
        // Validate the request data
        $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        // Check if remember me is checked
        $remember = $request->has('remember');
        
        // Attempt to authenticate with remember option
        if (Auth::attempt($request->only('email', 'password'), $remember)) {
            return redirect()->route('dashboard');
        }

        return redirect()->back()->withErrors(['email' => 'Invalid credentials']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function dashboard(){
        // Fetch menu structure
        $parentMenus = LinkTbl::where('parent_id', null)
            ->where('display', true)
            ->orderBy('order')
            ->get();
        
        foreach ($parentMenus as $parentMenu) {
            $childMenus = LinkTbl::where('parent_id', $parentMenu->id)
                ->where('display', true)
                ->orderBy('order')
                ->get();
            
            $parentMenu->children = $childMenus;  
        }
        
        return view('dashboard', compact('parentMenus'));
    }

    public function create(){
        // Return the view for creating a new user
        return view('users.create');
    }

    public function store(Request $request)
    {
         
        // dd($request->all());
        // Validate the request data
        $validated = $request->validate([
            'location' => 'required|string|max:255',    
            'repair_type' => 'required|string',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'confirm_password' => 'required|same:password',
            'user_type' => 'required|string|in:s_admin,admin,user',
            'mobile' => 'required|string|max:15',
            'status' => 'required|in:0,1',
            'remark' => 'nullable|string|max:500',
        ]);

        // Create the user with only validated data
        User::create([
            'location' => $validated['location'],
            'repair_type' => $validated['repair_type'],
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'mobile' => $validated['mobile'],
            'user_type' => $validated['user_type'],
            'status' => $validated['status'],
            // Add remark if provided
            'remark' => $request->input('remark'),
        ]);

        return redirect()->route('users.index')->with('success', 'User created successfully!');
    }

    public function index()
    {
        // Fetch menu structure for the layout
        $parentMenus = LinkTbl::where('parent_id', null)
            ->where('display', true)
            ->orderBy('order')
            ->get();
        
        foreach ($parentMenus as $parentMenu) {
            $childMenus = LinkTbl::where('parent_id', $parentMenu->id)
                ->where('display', true)
                ->orderBy('order')
                ->get();
            
            $parentMenu->children = $childMenus;  
        }
        
        // Get all users
        $users = User::all();
        
        return view('users.list', compact('users', 'parentMenus'));
    }
    
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.create', compact('user'));
    }
    
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        
        // Delete profile picture if exists
        if ($user->profile_picture && file_exists(public_path($user->profile_picture))) {
            unlink(public_path($user->profile_picture));
        }
        
        $user->delete();
        
        return redirect()->route('users.index')->with('success', 'User deleted successfully!');
    }
    
    public function update(Request $request, $user_id)
{
    $user = User::findOrFail($user_id);

    $rules = [
        'location' => 'required|string|max:255',
        'repair_type' => 'required|string',
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $user_id,
        'mobile' => 'required|string|max:15',
        'user_type' => 'required|string|in:s_admin,admin,user',
        'status' => 'required|in:0,1',
        'remark' => 'nullable|string|max:500',
    ];

    if ($request->filled('password')) {
        $rules['password'] = 'min:6';
        
    }

    $validated = $request->validate($rules);

    $data = [
        'location' => $validated['location'],
        'repair_type' => $validated['repair_type'],
        'name' => $validated['name'],
        'email' => $validated['email'],
        'mobile' => $validated['mobile'],
        'user_type' => $validated['user_type'],
        'status' => $validated['status'], // fixed
        'remark' => $validated['remark'] ?? null,
    ];

    if ($request->filled('password')) {
        $data['password'] = bcrypt($request->password);
    }

    $user->update($data);

    return redirect()->route('users.index')->with('success', 'User updated successfully!');
}

}
