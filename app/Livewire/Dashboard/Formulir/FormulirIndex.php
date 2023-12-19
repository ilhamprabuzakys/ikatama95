<?php

namespace App\Livewire\Dashboard\Formulir;

use App\Models\Survey;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Livewire\WithPagination;

#[Title('Daftar Hasil Formulir')]
#[Layout('layouts.app')]
class FormulirIndex extends Component
{
    use WithPagination, WithFileUploads;

    #[Url(as: 'q')]
    public $search = '';

    /*     #[Url(as: 'filter_role')]
    public $filter_role = ''; */

    #[Url(as: 'filter_date')]
    public $filter_date = '';

    public $paginate = 10;
    public $file;

    public $allTarget = null;
    public $downloadTarget = [];
    public $downloadUrls = [];

    public $export_role = '';
    public $export_format = '';

    public $survey_id;

    public $export_with_date = false;

    protected $queryString = [
        'q' => ['except' => ''],
        'filter_date' => ['except' => ''],
    ];

    /* public function updated($property)
    {
        // $property: The name of the current property that was updated
 
        if ($property === 'filter_date') {
            dd($this->filter_date);
        }
    } */

    #[On('refresh')]
    public function render()
    {
        $query = Survey::latest('timestamp')
            ->when($this->search, function ($query) {
                return $query->globalSearch($this->search);
            })
            ->when($this->filter_date, function ($query) {
                $dates = explode(' - ', $this->filter_date);
                if (count($dates) == 2) {
                    $startDate = Carbon::createFromFormat('m/d/Y', $dates[0])->startOfDay();
                    $endDate = Carbon::createFromFormat('m/d/Y', $dates[1])->endOfDay();
                    return $query->whereBetween('timestamp', [$startDate, $endDate]);
                }
            });

        if (\getRole() == 'alumni') {
            $query = $query->where('user_id', auth()->id());
        }

        $surveys = $query->paginate($this->paginate);

        return view('livewire.dashboard.formulir.formulir-index', [
            'title' => 'Daftar Hasil Formulir',
            'surveys' => $surveys
        ]);
    }

    public function bulkDownload()
    {
        // dd($this->downloadTarget);
        if ($this->downloadTarget != []) {
            $this->dispatch('swal:bulksurvey', [
                'title' => 'Survey',
                'text' => count($this->downloadTarget) . ' pengisian survey yang terpilih, akan segera diunduh per-PDF dari hasil surveynya, apakah kamu yakin.'
            ]);
        }
    }

    #[On('downloadSurveyConfirm')]
    public function downloadSurveyConfirm()
    {
        $urls = [];

        foreach ($this->downloadTarget as $each_survey) {
            $urls[] = route('download.pdf', $each_survey);
        }

        // dd($urls);
        $this->dispatch('openNewTabs', ['urls' => $urls]);

        $this->downloadTarget = [];
        $this->allTarget = null;
        $this->dispatch('alert', [
            'title' => 'Berhasil',
            'message' => 'Data berhasil diunduh',
            'type' => 'success',
        ]);
    }


    public function setAllTarget()
    {
        if (\getRole() == 'admin') {
            $surveys = Survey::all(['id']);
        } elseif (\getRole() == 'alumni') {
            $surveys = Survey::where('user_id', auth()->id())->get(['id']);
        }

        if (count($this->downloadTarget) == $surveys->count()) {
            $this->downloadTarget = []; // Deselect all jika semua sudah dipilih
        } else {
            $this->downloadTarget = $surveys->pluck('id')->toArray(); // Select all jika belum semua dipilih
        }
        // dd($this->downloadTarget);
    }

    public function exportExcel()
    {
        if ($this->export_with_date == true) {
            $encodedDate = base64_encode($this->filter_date);
            $url = route('formulir.export') . '?export_date=' . $encodedDate;
            $this->dispatch('startDownload', ['url' => $url]);            
        } else {
            $this->dispatch('startDownload', ['url' => route('formulir.export')]);            
        }
        $this->dispatch('closeModal');
        $this->export_with_date = false;
        
    }
    public function deleteConfirmation($id)
    {
        $this->survey_id = $id;
        $this->dispatch('swal:confirmation', [
            'title' => 'Hasil pengisian'
        ]);
    }

    #[On('deleteConfirmed')]
    public function destroy()
    {
        $survey = Survey::find($this->survey_id);
        // Kemudian hapus survey
        $survey->delete();
        $this->dispatch('alert', [
            'type' => 'success',
            'title' => 'Berhasil dihapus',
            'message' => 'Data berhasil dihapus'
        ]);
        $this->dispatch('refresh');
    }
}
