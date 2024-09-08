<?php

namespace App\Http\Controllers;
use App\Models\Carro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CarroController extends Controller
{

    public function dashboard()
    {
        // Recupera todos os carros do banco de dados
        $carros = Carro::all();

        // Passa os carros para a view de dashboard
        return view('dashboard', ['carros' => $carros]);
    }



    public function create(Request $req)
    {
        $carro = new Carro();
        $carro->modelo = $req->input('Modelo');
        $carro->marca = $req->input('Marca');
        $carro->ano = $req->input('Ano');
        $carro->cambio = $req->input('Cambio');
        $carro->ar_condicionado = $req->input('ArCondicionado'); // Compatível com o campo do form
        $carro->cor = $req->input('Cor');
        $carro->combustivel = $req->input('Combustivel');
        $carro->placa = $req->input('Placa');

        // Verificação e armazenamento da foto
        if ($req->hasFile('FotoCarro')) {
            if ($carro->Foto) {
                Storage::disk('public')->delete($carro->Foto);
            }
            $path = $req->file('FotoCarro')->store('veiculos', 'public');
            $carro->Foto = $path;
        }

        $carro->save();

        // Redireciona para a dashboard ou rota desejada
        return redirect()->route('dashboard')->with('success', 'Veículo cadastrado com sucesso!');
    }



    public function excluir(Request $req, $id){
        $carro = Carro::find($id);
        $carro->delete();
        return redirect()->route('dashboard')->with('success', 'Veículo cadastrado com sucesso!');
    }

    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
