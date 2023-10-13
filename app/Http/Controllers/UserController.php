<?php

namespace App\Http\Controllers;

use App\Models\r;
use App\Models\User;
use App\Models\Domaine;
use App\Models\TypeCompte;
use App\Models\Organisation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

                if(Auth::user()->role == "administrateur" ) {
                    return to_route('dashboard');
                }elseif (Auth::user()->role == "partenaire") {
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
       $request->validate([
           'nom' => 'required',
           'prenom' => 'required',
           'telephone' => 'required|unique:users,phone,id',
           'email' => 'required|email|unique:users,email,id',
           'type' => 'required',
           'password' => 'required'
        ]);

        if($request->type == 'morale' || $request->type == 'partenaire'){
            $request->validate([
                'nom_pro' => 'required',
                'phone_pro' => 'required',
                'email_pro' => 'required',
                'val_doc_1' => 'required|file|mimes:pdf,doc,docx,jpg,jpeg',
                'val_doc_2' => 'required|file|mimes:pdf,doc,docx,jpg,jpeg',
                'logo' => 'required|file|mimes:jpeg,jpg,png,svg'
             ]);
        }

       $user = User::create([
        'nom' =>$request->nom,
        'prenom' =>$request->prenom,
        'phone' => $request->telephone,
        'email' => $request->email,
        'type_compte' => $request->type,
        'password' => Hash::make($request->password),
      ]);

      $destination_path = 'uploads/docs/';
      $img_destination_path = 'uploads/images/';

      if ($request->hasFile('val_doc_1')) {
          $fileExt = $request->file('val_doc_1')->getClientOriginalExtension();
          $fileName = uniqid('u_'.$user->id.'rccm_'). '.' . $fileExt;

          if ($request->file('val_doc_1')->move($destination_path, $fileName)) {
              $doc_name = $destination_path . $fileName;
          }
      }
      if ($request->hasFile('val_doc_2')) {
          $fileExt = $request->file('val_doc_2')->getClientOriginalExtension();
          $fileName = uniqid('u_'.$user->id.'doc_'). '.' . $fileExt;

          if ($request->file('val_doc_2')->move($destination_path, $fileName)) {
              $doc_2name = $destination_path . $fileName;
          }
      }
      if ($request->hasFile('logo')) {
          $fileExt = $request->file('logo')->getClientOriginalExtension();
          $fileName = uniqid('u_'.$user->id.'_logo'). '.' . $fileExt;

          if ($request->file('logo')->move($img_destination_path, $fileName)) {
              $logo = $img_destination_path . $fileName;
          }
      }

      if($request->type == 'morale' || $request->type == 'partenaire'){
        Organisation::create([
            'nom' =>$request->nom_pro,
            'phone' => $request->phone_pro,
            'email' => $request->email_pro,
            // 'domaine' => $request->domaine,
            'short_description' => $request->description,
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
        $type = TypeCompte::where('short_name',$t)->first();
        $domaines = null;
        if($t=='partenaire'){
            $domaines = Domaine::where('estPartenaire',1)->get();
        } else if($t=='morale'){
            $domaines = Domaine::where('estPartenaire',0)->get();
        }
        return view('register',compact('t','domaines','type'));

   }

   public function loginForm(Request $request)
   {

        return view('login');
   }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('includes.profile', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
