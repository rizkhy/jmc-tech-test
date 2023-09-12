<?php

namespace App\Livewire\Pages\City;

use App\Models\City;
use Livewire\Component;
use App\Models\Province;
use Livewire\WithPagination;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class CityPage extends Component
{
    use WithPagination;

    public $id;
    public $search;
    public $name;
    public $code;
    public $province_code;
    public $province_code_filter;
    public $updateMode = false;

    public function edit($id)
    {
        $city = City::find($id);
        $this->id = $city->id;
        $this->name = $city->name;
        $this->code = $city->code;
        $this->province_code = $city->province_code;

        $this->updateMode = true;
    }

    public function saved()
    {
        DB::beginTransaction();

        if ($this->updateMode) {

            $this->validate([
                'name'          => 'required',
                'code'          => 'required|numeric|max_digits:4',
                'province_code' => 'required',
            ]);

            $city = City::find($this->id);
            $city->update([
                'name'          => $this->name,
                'code'          => $this->code,
                'province_code' => $this->province_code,
            ]);
            $this->updateMode = false;

            $this->redirectRoute('pages.city');
        } else {

            $this->validate([
                'name'          => 'required',
                'code'          => 'required|numeric|max_digits:4',
                'province_code' => 'required',
            ]);

            City::create([
                'name'          => $this->name,
                'code'          => $this->code,
                'province_code' => $this->province_code,
            ]);

            $this->redirectRoute('pages.city');
        }

        DB::commit();
    }

    public function delete($id)
    {
        City::find($id)->delete();
    }

    public function render()
    {
        $provinces = Province::all();

        $cities = City::when(!empty($this->province_code_filter), function ($query) {
            return $query->orWhere('province_code', $this->province_code_filter);
        })
            ->when(!empty($this->search), function ($query) {
                return $query->orWhere('name', 'like', '%' . $this->search . '%');
            })
            ->latest()
            ->paginate(10);

        return view('livewire.pages.city.city-page', compact('cities', 'provinces'))
            ->extends('layouts.app')
            ->section('content');
    }
}
