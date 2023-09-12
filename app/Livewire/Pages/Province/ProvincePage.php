<?php

namespace App\Livewire\Pages\Province;

use Livewire\Component;
use App\Models\Province;
use Livewire\WithPagination;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class ProvincePage extends Component
{
    use WithPagination;

    public $id;
    public $search;
    public $name;
    public $code;
    public $updateMode = false;

    public function edit($id)
    {
        $province = Province::find($id);
        $this->id = $province->id;
        $this->name = $province->name;
        $this->code = $province->code;

        $this->updateMode = true;
    }

    public function saved()
    {
        DB::beginTransaction();

        if ($this->updateMode) {

            $this->validate([
                'name' => 'required',
                'code' => 'required',
            ]);

            $province = Province::find($this->id);
            $province->update([
                'name' => $this->name,
                'code' => $this->code,
            ]);
            $this->updateMode = false;

            $this->redirectRoute('pages.province');
        } else {

            $this->validate([
                'name' => 'required',
                'code' => 'required',
            ]);

            Province::create([
                'name' => $this->name,
                'code' => $this->code,
            ]);

            $this->redirectRoute('pages.province');
        }

        DB::commit();
    }

    public function delete($id)
    {
        Province::find($id)->delete();
    }

    public function render()
    {
        $provinces = Province::where('name', 'like', '%' . $this->search . '%')
            ->latest()
            ->paginate(10);

        return view('livewire.pages.province.province-page', compact('provinces'))
            ->extends('layouts.app')
            ->section('content');
    }
}
