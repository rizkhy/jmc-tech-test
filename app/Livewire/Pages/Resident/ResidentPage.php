<?php

namespace App\Livewire\Pages\Resident;

use App\Models\City;
use Livewire\Component;
use App\Models\Province;
use App\Models\Resdient;
use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\WithPagination;
use App\Exports\ResidentExcel;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ResidentPage extends Component
{
    use WithPagination;

    public $search;
    public $id;
    public $name;
    public $id_number;
    public $gender;
    public $address;
    public $date_of_birth;
    public $province_id;
    public $province_code;
    public $province_filter;
    public $city_id;
    public $city_filter;
    public $updateMode = false;

    public function updated($propertyName, $value)
    {
        if ($propertyName == 'province_id') {
            $this->province_code = Province::find($value)->code ?? null;
        }
        if ($propertyName == 'province_filter') {
            $this->province_code = Province::find($value)->code ?? null;
        }
    }

    public function edit($id)
    {
        $resident = Resdient::find($id);
        $this->id = $resident->id;
        $this->name = $resident->name;
        $this->id_number = $resident->id_number;
        $this->address = $resident->address;
        $this->date_of_birth = $resident->date_of_birth;
        $this->gender = $resident->gender;
        $this->province_id = $resident->province_id;
        $this->city_id = $resident->city_id;

        $this->updateMode = true;
    }

    public function saved()
    {
        DB::beginTransaction();

        if ($this->updateMode) {

            $this->validate([
                'name'          => 'required',
                'id_number'     => 'required|numeric|max_digits:8',
                'address'       => 'required',
                'gender'        => 'required',
                'date_of_birth' => 'required',
                'province_id'   => 'required',
                'city_id'       => 'required',
            ]);

            $resident = Resdient::find($this->id);
            $resident->update([
                'name'          => $this->name,
                'id_number'     => $this->id_number,
                'address'       => $this->address,
                'gender'        => $this->gender,
                'date_of_birth' => $this->date_of_birth,
                'province_id'   => $this->province_id,
                'city_id'       => $this->city_id,
            ]);
            $this->updateMode = false;


            $this->redirectRoute('pages.resident');
        } else {

            $this->validate([
                'name'          => 'required',
                'id_number'     => 'required|numeric|max_digits:8',
                'address'       => 'required',
                'gender'        => 'required',
                'date_of_birth' => 'required',
                'province_id'   => 'required',
                'city_id'       => 'required',
            ]);

            Resdient::create([
                'name'          => $this->name,
                'id_number'     => $this->id_number,
                'address'       => $this->address,
                'gender'        => $this->gender,
                'date_of_birth' => $this->date_of_birth,
                'province_id'   => $this->province_id,
                'city_id'       => $this->city_id,
            ]);

            $this->redirectRoute('pages.resident');
        }

        DB::commit();
    }

    public function delete($id)
    {
        Resdient::find($id)->delete();
    }

    public function exportExcel()
    {
        $excelResident = Resdient::when(!empty($this->province_filter), function ($query) {
            $query->where('province_id', $this->province_filter);
        })
            ->when(!empty($this->city_filter), function ($query) {
                $query->where('city_id', $this->city_filter);
            })
            ->when(!empty($this->search), function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('id_number', 'like', '%' . $this->search . '%');
            })
            ->latest()
            ->get();

        return Excel::download(new ResidentExcel($excelResident), 'Data Penduduk.xlsx');
    }

    public function printPdf()
    {
        $printResident = Resdient::selectRaw('provinces.name as province_name, count(*) as population_count')
            ->join('cities', 'resdients.city_id', '=', 'cities.id')
            ->join('provinces', 'cities.province_code', '=', 'provinces.code')
            ->groupBy('provinces.name')
            ->get();

        $pdf = Pdf::loadView('exports.resident_pdf', ['data' => $printResident]);
        return $pdf->download('Data Penduduk.pdf');
    }

    public function render()
    {
        $provinces = Province::all();

        $cities = City::where('province_code', $this->province_code)->get();

        $resdients = Resdient::when(!empty($this->province_filter), function ($query) {
            $query->where('province_id', $this->province_filter);
        })
            ->when(!empty($this->city_filter), function ($query) {
                $query->where('city_id', $this->city_filter);
            })
            ->when(!empty($this->search), function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('id_number', 'like', '%' . $this->search . '%');
            })
            ->latest()
            ->paginate(10);

        return view('livewire.pages.resident.resident-page', compact('resdients', 'provinces', 'cities'))
            ->extends('layouts.app')
            ->section('content');
    }
}
