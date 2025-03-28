<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Models\Pessoa;
use Log;


class PessoaController extends Controller
{

   public function index()
   {
      $pessoas = Pessoa::all();
      return view('pessoas.index', compact('pessoas'));
   }

   public function show($id)
   {
          $pessoa = Pessoa::findOrFail($id);
          return view('pessoas.show',compact('pessoa'));
   }
   public function store(Request $request)
   {
      $validated = $request->validate([
         'nome' => 'required|string|max:255',
         'idade' => 'required|integer|min:1',
      ]);

      Pessoa::create($validated);

      return redirect()->route('pessoas.index')->with('success', 'Pessoa cadastrada com sucesso!');
   }

   public function update($id, Request $request)
   {
      $validated = $request->validate([
         'nome' => 'required|string|max:255',
         'idade' => 'required|integer|min:1',
      ]);

      $pessoa = Pessoa::findOrFail($id);

      $pessoa->update($validated);
      
      return redirect()->route('pessoas.index')->with('success', 'Pessoa atualizada com sucesso');
   }

   public function delete($id)
   {
          $pessoa = Pessoa::findOrFail($id);
          $pessoa->delete();
          return redirect()->route('pessoas.index')->with('success','A pessoa foi deletada com sucesso');
   }

}
