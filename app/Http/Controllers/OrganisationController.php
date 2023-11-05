<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Domaine;
use App\Models\Organisation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class OrganisationController extends Controller
{
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
    public function show(Organisation $organisation)
    {
        $domaine = Domaine::find($organisation->domaine_id);
        $user = User::find($organisation->user_id);
        $produits = $user->produits()->where('status', 2)->get();
        $prestations = $user->prestations;

        return view('partenaire-detail',compact('organisation','domaine','produits','prestations'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Organisation $organisation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Organisation $organisation)
    {
        if (Gate::denies('update', $organisation)) {
            return back()->with("error", Gate::inspect('update', $organisation)->message());
        }

        $request->validate([
            'nom_pro' => 'required',
            'phone_pro' => 'required',
            'email_pro' => 'required',
            'val_doc_1' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg',
            'val_doc_2' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg',
            'logo' => 'nullable|file|mimes:jpeg,jpg,png,svg',
            'domaine' => ['required', 'exists:domaines,id']
        ]);

        $destination_path = 'uploads/docs/';
        $img_destination_path = 'uploads/images/';

        // Mettez les noms de fichiers actuels dans des variables
        $doc_name = $organisation->val_doc_1;
        $doc_2name = $organisation->val_doc_2;
        $logo = $organisation->logo;

        if ($request->hasFile('val_doc_1')) {
            // Supprimez l'ancien fichier s'il existe
            $this->deleteFile($doc_name);

            // Téléchargez le nouveau fichier
            $doc_name = $this->storeFile($request->file('val_doc_1'), $destination_path, $organisation);
        }

        if ($request->hasFile('val_doc_2')) {
            // Supprimez l'ancien fichier s'il existe
            $this->deleteFile($doc_2name);

            // Téléchargez le nouveau fichier
            $doc_2name = $this->storeFile($request->file('val_doc_2'), $destination_path, $organisation);
        }

        if ($request->hasFile('logo')) {
            // Supprimez l'ancien fichier s'il existe
            $this->deleteFile($logo);

            // Téléchargez le nouveau fichier
            $logo = $this->storeFile($request->file('logo'), $img_destination_path, $organisation);
        }

        // Mettez à jour l'organisation
        $organisation->update([
            'nom' => $request->nom_pro,
            'phone' => $request->phone_pro,
            'email' => $request->email_pro,
            'description' => $request->description,
            'lib_doc_1' => 'RCCM',
            'val_doc_1' => $doc_name,
            'lib_doc_2' => 'DOC2',
            'val_doc_2' => $doc_2name,
            'logo' => $logo,
            'user_id' => $organisation->user_id,
            'domaine_id' => $request->domaine
        ]);

        return back()->with('success', 'Modification réussie');
    }

    private function deleteFile($file)
    {
        if ($file && Storage::disk('public')->exists($file)) {
            Storage::disk('public')->delete($file);
        }
    }

    private function storeFile($file, $destination, $organisation)
    {
        if ($file) {
            $fileExt = $file->getClientOriginalExtension();
            $fileName = uniqid('u_' . $organisation->user_id . '_') . $fileExt;

            Storage::disk('public')->putFileAs($destination, $file, $fileName);

            return $destination . $fileName;
        }

        return null;
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Organisation $organisation)
    {
        //
    }
}
