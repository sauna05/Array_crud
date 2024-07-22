<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PersonaController extends Controller
{
    public function index()
    {
        $personas = session('personas', [
            '1' => [
                'id' => '1',
                'nombre' => 'Juan',
                'edad' => 30,
                'email' => 'juan@gmail.com'
            ],
            '2' => [
                'id' => '2',
                'nombre' => 'María',
                'edad' => 25,
                'email' => 'maria@gmail.com'
            ]
        ]);

        return view('personas.index', ['personas' => $personas]);
    }

    public function create()
    {
        return view('personas.create');
    }

    public function store(Request $request)
    {
        // Obtener el array de personas de la sesión, inicializando solo si está vacío
        $personas = session('personas');
    
        if (is_null($personas)) {
            $personas = [
                '1' => [
                    'id' => '1',
                    'nombre' => 'Juan',
                    'edad' => 30,
                    'email' => 'juan@gmail.com'
                ],
                '2' => [
                    'id' => '2',
                    'nombre' => 'María',
                    'edad' => 25,
                    'email' => 'maria@gmail.com'
                ]
            ];
        }
    
        // Crear una nueva persona
        $nuevaPersona = [
            'id' => (string)(count($personas) + 1), // Generar un nuevo ID
            'nombre' => $request->input('nombre'),
            'edad' => $request->input('edad'),
            'email' => $request->input('email')
        ];
    
        // Agregar la nueva persona al array
        $personas[$nuevaPersona['id']] = $nuevaPersona;
    
        // Almacenar el array actualizado en la sesión
        session(['personas' => $personas]);
    
        return redirect()->route('personas.index');
    }

    public function edit($id)
    {
        // Recuperar el array de personas de la sesión
        $personas = session('personas', []);
        
        // Verificar si la persona existe
        if (!array_key_exists($id, $personas)) {
            return redirect()->route('personas.index')->with('error', 'Persona no encontrada.');
        }

        // Obtener la persona a editar
        $persona = $personas[$id];

        return view('personas.edit', ['persona' => $persona]);
    }

    public function update(Request $request, $id)
    {
        // Obtener el array de personas de la sesión
        $personas = session('personas', []);
        
        // Verificar si la persona existe
        if (!array_key_exists($id, $personas)) {
            return redirect()->route('personas.index')->with('error', 'Persona no encontrada.');
        }

        // Actualizar la persona
        $personas[$id]['nombre'] = $request->input('nombre');
        $personas[$id]['edad'] = $request->input('edad');
        $personas[$id]['email'] = $request->input('email');

        // Almacenar el array actualizado en la sesión
        session(['personas' => $personas]);

        return redirect()->route('personas.index')->with('success', 'Persona actualizada con éxito.');
    }

    public function destroy($id)
    {
        // Obtener el array de personas de la sesión
        $personas = session('personas', []);
        
        // Verificar si la persona existe
        if (!array_key_exists($id, $personas)) {
            return redirect()->route('personas.index')->with('error', 'Persona no encontrada.');
        }

        // Eliminar la persona
        unset($personas[$id]);
        session(['personas' => $personas]);
        //redirigir 
        return redirect()->route('personas.index')->with('success', 'Persona eliminada con éxito.');
    }
}