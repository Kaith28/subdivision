<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Str;

class GuardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $name = $request->input('name');

        $users = User::query();

        if ($name !== null) {
            $users->where('name', 'LIKE', '%' . $name . '%');
        }

        $users->where('role', 'guard');
        $users->where('is_deleted', false);
        $users->where('company_id', $user->company->id);

        $users = $users->get();

        return view('guard.guard', [
            'users' => $users,
            'name'  => $name
        ]);
    }
    public function create(Request $request)
    {
        $user = $request->user();

        // Validation - check if subscription is active
        if (!$user->company->isActive()) {
            return redirect()->route('guard')->with('error', 'Subscription already expired');
        }
        return view('guard.create');
    }

    public function store(Request $request)
    {
        $user = $request->user();

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'contact_no' => ['required', 'string', 'max:255'],
            'photo' => ['required', 'string']
        ]);
        $imageData = $request->input('photo');
        $decodedImage = base64_decode(preg_replace('/^data:image\/(png|jpeg|jpg);base64,/', '', $imageData));
        $imageName = $request->name . Str::random(20) . '.png';
        file_put_contents(public_path('images/' . $imageName), $decodedImage);
        $imagePath = '/images/' . $imageName;
        User::create([
            'company_id' => $user->company->id,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'contact_no' => $request->contact_no,
            'photo' => $imagePath,
            'role' => 'guard',
        ]);


        return redirect()->route('guard');
    }

    public function show(Request $request)
    {
        $user = $request->user();

        if (!$user->company->isActive()) {
            return redirect()->route('guard')->with('error', 'Subscription already expired');
        }

        $existingUser = User::findOrFail($request->id);

        if ($user->company->id !== $existingUser->company->id) {
            abort(404);
        }

        return view('guard.show')->with('user', $existingUser);
    }

    public function edit(Request $request)
    {
        $user = $request->user();

        // Validation - check if subscription is active
        if (!$user->company->isActive()) {
            return redirect()->route('guard')->with('error', 'Subscription already expired');
        }

        $existingUser = User::findOrFail($request->id);

        if ($user->company->id !== $existingUser->company->id) {
            abort(404);
        }

        return view('guard.edit')
            ->with('user', $existingUser);
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'max:255'],
            'contact_no' => ['required', 'string', 'max:255'],
            /* 'photo' => ['required', 'string'], */
        ]);

        $user = $request->user();

        $existingUser = User::findOrFail($request->id);

        if ($user->company->id !== $existingUser->company->id) {
            abort(404);
        }

        $existingUser->name = $request->name;
        $existingUser->email = $request->email;
        $existingUser->contact_no = $request->contact_no;
        $existingUser->save();

        return redirect()->route('guard')->with('success', 'Updated user successfully');
    }
    public function destroy(Request $request)
    {
        $user = $request->user();

        // Validation - check if subscription is active
        if (!$user->company->isActive()) {
            return redirect()->route('guard')->with('error', 'Subscription already expired');
        }

        $existingUser = User::findOrFail($request->id);

        if ($user->company->id !== $existingUser->company->id) {
            abort(404);
        }

        $existingUser->is_deleted = true;

        $existingUser->save();

        return redirect()->route('guard', $user->id)->with('success', 'Guard disable successfully');
    }

    public function showAddGuestForm()
    {
        return view('guard.add_guest_form');
    }

    public function storeGuest(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
        ]);

        // Process and store guest information (you can save it to the database, etc.)
        // For now, let's just print the data
        dd($validatedData);
    }

    public function changePhoto(Request $request)
    {

        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);

            $imagePath = '/images/' . $imageName;

            $user = User::findOrFail($request->id);
            $user->photo = $imagePath;
            $user->save();

            return redirect()->back()->with('success', 'Updated photo successfully');
        }
    }
}
