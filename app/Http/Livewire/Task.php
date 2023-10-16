<?php

namespace App\Http\Livewire;

use App\Models\Task as TaskModel;
use Livewire\Component;

class Task extends Component
{
    public $tasks;

    //para crear un nuevo registro hay que crear la variable del tipo del modelo, se enlaza con cada uno de los componentes del formulario
    public TaskModel $task;

    //se tiene que agregar las reglas de validación para que el formulario se muestre
    protected $rules = [
        'task.text' => 'required|max:40'
    ];

    //se carga antes del render... solo se ejecuta una vez, al cargar la página
    public function mount()
    {
        $this->tasks = TaskModel::orderBy('id', 'DESC')->get();

        //creamos el objeto vacio donde se guardará el nuevo registro
        $this->task = new TaskModel();
    }

    //cuando se actualiza el texto dentro del objeto task, se aplica validación en línea para la longitud
    public function updatedTaskText()
    {
        $this->validate(['task.text' => 'max:40']);
    }


    //metodo para editar, se manda llamar desde el evento wire:click="edit" del boton
    public function edit(TaskModel $task)
    {
        //asignamos la tarea buscada con model binding al componente task
        $this->task = $task;
    }

    public function delete($id)
    {

    }

    //método para guardar el nuevo registro, se manda llamar desde el evento wire:submit del formulario
    public function save()
    {
        $this->validate();

        //guardamos los datos en el modelo, tanto para creación como para edición se usa el mismo metodo save
        $this->task->save();

        //renderizamos y reiniciamos los componentes
        $this->mount();

        //mandamos un evento al componente padre
        $this->emitUp('taskSaved', 'Tarea Guardada Correctamente...');
    }


    public function render()
    {
        return view('livewire.task');
    }
}
