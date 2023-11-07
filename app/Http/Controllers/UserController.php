<?php

namespace App\Http\Controllers;

use App\Models\r;
use App\Models\User;
use App\Models\Ticket;
use App\Models\Domaine;
use App\Models\TypeCompte;
use App\Models\Organisation;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Filesystem\Filesystem;

class UserController extends Controller
{

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'phone' => ['required', 'numeric'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            // $flasher->addSuccess('Connecté');
            $request->session()->regenerate();
            // if(Auth::user()->getUser()->active){
            //     return redirect()->intended('/');
            // }

            if (Auth::user()->role == "administrateur") {
                return to_route('dashboard');
            } elseif (Auth::user()->role == "partenaire") {
                return to_route('articleAdmin.index');
            }

            return redirect()->intended('/');
        }

        //    $flasher->addError('Les informations de connexions ne sont pas valides');

        return redirect()->back()->withErrors([
            'password' => 'Les details de connexions ne sont pas valides',
        ]);
    }

    function register(Request $request)
    {

        dd($request->all());
        $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'telephone' => 'required|unique:users,phone,id',
            'email' => 'required|email|unique:users,email,id',
            'type' => 'required',
            'password' => 'required'
        ]);

        if ($request->type == 'morale' || $request->type == 'partenaire') {
            $request->validate([
                'nom_pro' => 'required',
                'phone_pro' => 'required',
                'email_pro' => 'required',
                'val_doc_1' => 'required|file|mimes:pdf,doc,docx,jpg,jpeg',
                'val_doc_2' => 'required|file|mimes:pdf,doc,docx,jpg,jpeg',
                'logo' => 'required|file|mimes:jpeg,jpg,png,svg'
            ]);
        }

        if ($request->type == 'partenaire') {
            $role = "partenaire";
            $status = 1;
        } else {
            $role = "utilisateur";
            $status = 2;
        }

        $user = User::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'phone' => $request->telephone,
            'role' => $role,
            'status' => $status,
            'email' => $request->email,
            'type_compte' => $request->type,
            'password' => Hash::make($request->password),
        ]);

        $destination_path = 'uploads/docs/';
        $img_destination_path = 'uploads/images/';

        /** @var $publicDisk  Filesystem */
        $publicDisk = Storage::disk('public');

        if ($request->hasFile('val_doc_1')) {
            $fileExt = $request->file('val_doc_1')->getClientOriginalExtension();
            $fileName = uniqid('u_' . $user->id . 'rccm_') . '.' . $fileExt;

            if ($publicDisk->putFileAs($destination_path, $request->file('val_doc_1'), $fileName)) {
                $doc_name = $destination_path . $fileName;
            }
        }

        if ($request->hasFile('val_doc_2')) {
            $fileExt = $request->file('val_doc_2')->getClientOriginalExtension();
            $fileName = uniqid('u_' . $user->id . 'doc_') . '.' . $fileExt;

            if ($publicDisk->putFileAs($destination_path, $request->file('val_doc_2'), $fileName)) {
                $doc_2name = $destination_path . $fileName;
            }
        }

        if ($request->hasFile('logo')) {
            $fileExt = $request->file('logo')->getClientOriginalExtension();
            $fileName = uniqid('u_' . $user->id . '_logo') . '.' . $fileExt;

            if ($publicDisk->putFileAs($img_destination_path, $request->file('logo'), $fileName)) {
                $logo = $img_destination_path . $fileName;
            }
        }


        if ($request->type == 'morale' || $request->type == 'partenaire') {
            Organisation::create([
                'nom' => $request->nom_pro,
                'phone' => $request->phone_pro,
                'email' => $request->email_pro,
                // 'domaine' => $request->domaine,
                'description' => $request->description,
                'lib_doc_1' => 'RCCM',
                'val_doc_1' => $doc_name,
                'lib_doc_2' => 'DOC2',
                'val_doc_2' => $doc_2name,
                'logo' => $logo,
                'user_id' => $user->id,
                'domaine_id' => $request->domaine
            ]);
        }
        //   $flasher->addSuccess('Votre compte à été créé');


        return redirect()->route('home.index');
    }

    function disconnect(Request $request)
    {
        //    Helpers::SaveLog('Deconexion à GED',Auth::user()->id);
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        //    $flasher->addSuccess('Vous avez été déconnecté');
        return redirect('/');
    }

    public function registerForm(Request $request)
    {

        $t = $request->t;
        $type = TypeCompte::where('short_name', $t)->first();
        $domaines = null;
        if ($t == 'partenaire') {
            $domaines = Domaine::where('estPartenaire', 1)->get();
        } else if ($t == 'morale') {
            $domaines = Domaine::where('estPartenaire', 0)->get();
        }

        return view('register', compact('t', 'domaines', 'type'));
    }

    public function loginForm(Request $request)
    {

        return view('login');
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (Gate::denies('viewAny', User::class)) {
            return abort(404);
        }

        $users = $this->filter($request);

        return view(
            'admin.user.index',
            [
                'users' => $users,
                'query' => ['search' => $request['search'], 'filter' => $request['filter']],
            ]
        );
    }

    private function filter(Request $request)
    {
        $filter = $request['filter'];
        $search = $request['search'];

        $query = User::where('active', true)
            ->when($search, function ($query) use ($search) {
                $query->where(function ($query) use ($search) {
                    $query->where('nom', 'LIKE', "%$search%")
                        ->orWhere('prenom', 'LIKE', "%$search%")
                        ->orWhere('phone', 'LIKE', "%$search%")
                        ->orWhere('email', 'LIKE', "%$search%");
                });
            })
            ->orderBy('created_at', 'desc')

            ->where('status', 2);

        switch ($filter) {
            case 'followers_moral':
                $query->where('type_compte', 'morale')->where('role', 'utilisateur');
                break;
            case 'followers_physical':
                $query->where('type_compte', 'physique')->where('role', 'utilisateur');
                break;
            case 'partenaires':
                $query->where('role', 'partenaire');
                break;
            default:
                $query->where('role', 'administrateur');
                break;
        }

        return $query->paginate(25);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Gate::denies('view', User::class)) {
            return abort(404);
        }
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (Gate::denies('create', User::class)) {
            return back()->with("error", Gate::inspect('create', User::class)->message());
        }
        $data = $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'phone' => 'required|unique:users,phone,id',
            'email' => 'required|email|unique:users,email,id',
            'password' => 'required|string'
        ]);

        User::create(array_merge($data, [
            'type_compte' => 'physique',
            // 'password' => Hash::make('#monDroit2023'),
            'password' => Hash::make($data['password']),
            'role' => 'administrateur',
            'status' => 2
        ]));

        return to_route('user.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        if (Gate::denies('view', $user)) {
            return abort(404);
        }

        if ($user->role == "administrateur") {
            return view('admin.user.show', compact('user'));
        } elseif ($user->isPartenaire()) {
            return  to_route('partenaireAdmin.show', $user);
        } else {
            // $organisation = $user->organisation;
            if ($user->type_compte === "morale") {
                $organisation = Organisation::inRandomOrder()->first();
                $domaines = Domaine::all();
                $tickets = Ticket::where('user_id', $user->id)->get();
                return view('includes.profile', compact('user', 'tickets', 'organisation', 'domaines'));
            } else {
                $user = auth()->user();
                $tickets = Ticket::where('user_id', $user->id)->get();
                return view('includes.profile', compact('user', 'tickets'));
            }
        }
    }

    public function update_password(Request $request)
    {
        $request->validate([
            'old_password' => ['nullable', 'string', 'current_password'],
            'new_password' => ['nullable', 'string', Rule::requiredIf(function () use ($request) {
                return !empty($request->input('old_password'));
            }), 'min:6'],
        ]);

        /** @var $user User */
        $user = Auth::user();

        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->back()->with('success', 'Mot de passe mis à jour avec succès.');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        if (Gate::denies('update', $user)) {
            return abort(404);
        }

        return view('admin.user.edit', [
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        if (Gate::denies('update', $user)) {
            return back()->with("error", Gate::inspect('update', $user)->message());
        }

        $data = $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'phone' => ['required', Rule::unique(User::class)->ignore($user->id)],
            'email' => ['required', 'email', Rule::unique(User::class)->ignore($user->id)],
        ]);

        $user->update($data);

        return to_route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        if (Gate::denies('delete', $user)) {
            return back()->with("error", Gate::inspect('delete', $user)->message());
        }

        $user->active = false;
        $user->save();
        return to_route('user.index');
    }
}
