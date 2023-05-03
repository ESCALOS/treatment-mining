<?php

namespace App\Http\Livewire\OreType;

use App\Models\OreType;
use Livewire\Component;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Base extends Component
{
    use WithPagination;
    use LivewireAlert;

    public $oreTypeId;
    public $search;
    public $boton_activo;

    protected $listeners = ['render','confirmDelete'];

    public function mount(){
        $this->search = "";
        $this->oreTypeId = 0;
        $this->boton_activo = false;
    }

    public function seleccionar($id) {
        $this->oreTypeId = $id;
    }

    public function eliminar(){
        if(OreType::has('orders')->where('id',$this->oreTypeId)->exists()){
            $this->alert('warning', '¡No se puede eliminar el mineral!', [
                'position' => 'top-right',
                'timer' => 2000,
                'toast' => true,
            ]);
        }else{
            $this->alert('question','¿Estas seguro de eliminar?',[
                'showConfirmButton' => true,
                'confirmButtonText' => 'Sí',
                'position' => 'center',
                'toast' => false,
                'showCancelButton' => true,
                'cancelButtonText' => 'No',
                'timer' => 10000,
                'onConfirmed' => 'confirmDelete',
            ]);
        }
    }
    public function confirmDelete() {
        OreType::find($this->oreTypeId)->delete();
        $this->oreTypeId = 0;
        $this->alert('success', 'Tipo de Mineral Eliminado!', [
            'position' => 'top-right',
            'timer' => 2000,
            'toast' => true,
        ]);
        $this->render();
    }

    public function getOreType(){
        $oreType = OreType::when($this->search != "", function($q){
            return $q->where('ore_type','like','%'.$this->search.'%');
        })->paginate(6);
        return $oreType;
    }

    public function render()
    {
        $this->boton_activo = $this->oreTypeId > 0;
        $oreTypes = $this->getoreType();
        return view('livewire.ore-type.base',compact('oreTypes'));
    }
}
