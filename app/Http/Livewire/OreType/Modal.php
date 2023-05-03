<?php

namespace App\Http\Livewire\OreType;

use App\Models\OreType;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Modal extends Component
{
    use LivewireAlert;

    public $open;
    public $oreTypeId;
    public $oreType;

    protected $listeners = ['abrirModal'];

    protected function rules(){
        return [
            'oreType' => 'required|unique:ore_types,ore_type,'.$this->oreTypeId,
        ];
    }

    public function messages(){
        return [
            'oreType.required' => "El tipo de mineral es requerido",
            'oreType.unique' => "El tipo de mineral ya existe",
        ];
    }

    public function mount(){
        $this->open =false;
        $this->oreTypeId = 0;
        $this->oreType = "";
    }

    public function abrirModal($id){
        $this->resetValidation();
        $this->reset('oreType');
        $this->oreTypeId = $id;
        if($id > 0){
            $oreType = OreType::find($id);
            $this->oreType = $oreType->ore_type;
        }
        $this->open = true;
    }

    public function registrar(){
        $this->validate();
        if($this->oreTypeId > 0){
            $oreType = OreType::find($this->oreTypeId);

        }else{
            $oreType = new OreType();
        }
        $oreType->ore_type = strtoupper($this->oreType);
        $oreType->save();
        $this->alert('success', 'Mineral guardado!', [
            'position' => 'top-right',
            'timer' => 2000,
            'toast' => true,
           ]);
        $this->emitTo('ore-type.base', 'render');
        $this->open = false;
    }
    public function render()
    {
        return view('livewire.ore-type.modal');
    }
}
