<?php

namespace App\Http\Livewire\IsAdmin;

use App\Models\Booking;
use App\Models\Selfdrive;
use App\Models\Totalsale;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;
use PDF;

class ReportsController extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $searchTerm;
    public $statusFilter;
    public $startDate;
    public $endDate;
    public $searchmonth;
    public $serializedBookings;
    public $bookkings = [];
    public $year;
    public $month;
    public $imagePath;
    public $base64Image;
    protected $listeners = ['captureScreenshot' => 'captureScreenshot', 'downloadPDF' => 'downloadPDF'];
    // protected $listeners = ['downloadPDF'];

    public function mount()
    {
        // Set the initial value of $year to the current year
        $this->year = Carbon::now()->year;

        // Fetch chart data when the component is loaded
        $this->fetchChartData();
    }

    public function render()
    {

        $this->fetchChartData();
        $dat = Booking::select(
            'id',
            'user_id',
            'admincars_id',
            'pickuptime',
            'pickupdate',
            'dropofftime',
            'dropoffdate',
            'destination',
            'daytrip',
            'status',
            'reject_reason',
            'cancelled_reason',
            'confirmed_OR',
            'total_payment',
            'lastrate',
            DB::raw('NULL as license'),
            DB::raw("'bookingModel' as model_type"),
        )->where(function ($query) {
            $query->where('pickupdate', 'like', "%$this->searchTerm%")
                ->orWhere('dropoffdate', 'like', "%$this->searchTerm%")
                ->orWhere('status', 'like', "%$this->searchTerm%")
                ->orWhereHas('user', function ($query) {
                    $query->where('name', 'like', "%$this->searchTerm%");
                })
                ->orWhereHas('admincar', function ($query) {
                    $query->where('carname', 'like', "%$this->searchTerm%");
                });
        })->when($this->statusFilter, function ($query) {
            return $query->where('status', $this->statusFilter);
        })->when($this->startDate && $this->endDate, function ($query) {
            return $query->whereBetween('pickupdate', [$this->startDate, $this->endDate])
                ->orWhereBetween('dropoffdate', [$this->startDate, $this->endDate]);
        })->when($this->searchmonth, function ($query) {
            $query->where(DB::raw('DATE_FORMAT(pickupdate, "%Y-%m")'), $this->searchmonth)
                ->orWhere(DB::raw('DATE_FORMAT(dropoffdate, "%Y-%m")'), $this->searchmonth);
        });

        $self = Selfdrive::select(
            'id',
            'user_id',
            'admincars_id',
            'pickuptime',
            'pickupdate',
            'dropofftime',
            'dropoffdate',
            'destination',
            'daytrip',
            'status',
            'reject_reason',
            'cancelled_reason',
            'confirmed_OR',
            'total_payment',
            'lastrate',
            'license',
            DB::raw("'selfDriveModel' as model_type"),
        )->where(function ($query) {
            $query->where('pickupdate', 'like', "%$this->searchTerm%")
                ->orWhere('dropoffdate', 'like', "%$this->searchTerm%")
                ->orWhere('status', 'like', "%$this->searchTerm%")
                ->orWhereHas('user', function ($query) {
                    $query->where('name', 'like', "%$this->searchTerm%");
                })
                ->orWhereHas('admincar', function ($query) {
                    $query->where('carname', 'like', "%$this->searchTerm%");
                });
        })->when($this->statusFilter, function ($query) {
            return $query->where('status', $this->statusFilter);
        })->when($this->startDate && $this->endDate, function ($query) {
            return $query->whereBetween('pickupdate', [$this->startDate, $this->endDate])
                ->orWhereBetween('dropoffdate', [$this->startDate, $this->endDate]);
        })->when($this->searchmonth, function ($query) {
            $query->where(DB::raw('DATE_FORMAT(pickupdate, "%Y-%m")'), $this->searchmonth)
                ->orWhere(DB::raw('DATE_FORMAT(dropoffdate, "%Y-%m")'), $this->searchmonth);
        });

        $paginatedBookings = $dat->with('user', 'admincar')->union($self->with('user', 'admincar'))->paginate(10);

        // Store the paginated data in $this->bookkings
        $this->bookkings = $paginatedBookings->items();

        // $this->bookings = $bookings;
        return view('livewire.is-admin.reports-controller', [
            'bookings' => $paginatedBookings,  // Pass the paginated data to the view
        ])->layout('layouts.base');
    }

    public function updateData()
    {
        $this->resetPage();
        $this->emit('updatedTable');
    }

    public function captureScreenshot($base64Image)
    {
        $userId = auth()->user()->id;

        // Delete the existing file if it exists
        $existingPath = 'img/screenshot' . $userId . '.png';
        if (Storage::exists($existingPath)) {
            Storage::delete($existingPath);
        }

        // Save the new screenshot
        $image = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $base64Image));

        $this->imagePath = 'img/screenshot' . $userId . '.png';
        Storage::put($this->imagePath, $image);

        // Set the public property with the base64Image value
        $this->base64Image = $base64Image;

        // Emit Livewire event to trigger the PDF download
        $this->emit('downloadPDF');
    }



    public function downloadPDF()
    {

        // dd($this->imagePath);
        // $filteredBookings = $this->filterBookings();

        // $pdf = PDF::loadView('booking-reports-pdf', ['bookings' => $filteredBookings]);

        // $pdfOutput = $pdf->output();
        // $filename = 'report.pdf';

        // return response()->download($filename, null, [], 'inline')->setContent($pdfOutput);

        $filteredBookings = $this->filterBookings();

        $pdf = PDF::loadView('booking-reports-pdf', [
            'bookings' => $filteredBookings,
            'imagePath' => $this->imagePath,
        ]);

        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
        }, 'report.pdf');
    }



    public function printBookingReport()
    {
        // Decode the serialized bookings data
        $bookings = json_decode($this->serializedBookings);

        // Perform any additional logic you need with the $bookings data

        // Redirect to the desired route
        return redirect()->route('printBookingReport');
    }


    protected function filterBookings()
    {
        $dat = Booking::select(
            'id',
            'user_id',
            'admincars_id',
            'pickuptime',
            'pickupdate',
            'dropofftime',
            'dropoffdate',
            'destination',
            'daytrip',
            'status',
            'reject_reason',
            'cancelled_reason',
            'confirmed_OR',
            'total_payment',
            'lastrate',
            DB::raw('NULL as license'),
            DB::raw("'bookingModel' as model_type"),
        )->where(function ($query) {
            $query->where('pickupdate', 'like', "%$this->searchTerm%")
                ->orWhere('dropoffdate', 'like', "%$this->searchTerm%")
                ->orWhere('status', 'like', "%$this->searchTerm%")
                ->orWhereHas('user', function ($query) {
                    $query->where('name', 'like', "%$this->searchTerm%");
                })
                ->orWhereHas('admincar', function ($query) {
                    $query->where('carname', 'like', "%$this->searchTerm%");
                });
        })->when($this->statusFilter, function ($query) {
            return $query->where('status', $this->statusFilter);
        })->when($this->startDate && $this->endDate, function ($query) {
            return $query->whereBetween('pickupdate', [$this->startDate, $this->endDate])
                ->orWhereBetween('dropoffdate', [$this->startDate, $this->endDate]);
        })->when($this->searchmonth, function ($query) {
            $query->where(DB::raw('DATE_FORMAT(pickupdate, "%Y-%m")'), $this->searchmonth)
                ->orWhere(DB::raw('DATE_FORMAT(dropoffdate, "%Y-%m")'), $this->searchmonth);
        });

        $self = Selfdrive::select(
            'id',
            'user_id',
            'admincars_id',
            'pickuptime',
            'pickupdate',
            'dropofftime',
            'dropoffdate',
            'destination',
            'daytrip',
            'status',
            'reject_reason',
            'cancelled_reason',
            'confirmed_OR',
            'total_payment',
            'lastrate',
            'license',
            DB::raw("'selfDriveModel' as model_type"),
        )->where(function ($query) {
            $query->where('pickupdate', 'like', "%$this->searchTerm%")
                ->orWhere('dropoffdate', 'like', "%$this->searchTerm%")
                ->orWhere('status', 'like', "%$this->searchTerm%")
                ->orWhereHas('user', function ($query) {
                    $query->where('name', 'like', "%$this->searchTerm%");
                })
                ->orWhereHas('admincar', function ($query) {
                    $query->where('carname', 'like', "%$this->searchTerm%");
                });
        })->when($this->statusFilter, function ($query) {
            return $query->where('status', $this->statusFilter);
        })->when($this->startDate && $this->endDate, function ($query) {
            return $query->whereBetween('pickupdate', [$this->startDate, $this->endDate])
                ->orWhereBetween('dropoffdate', [$this->startDate, $this->endDate]);
        })->when($this->searchmonth, function ($query) {
            $query->where(DB::raw('DATE_FORMAT(pickupdate, "%Y-%m")'), $this->searchmonth)
                ->orWhere(DB::raw('DATE_FORMAT(dropoffdate, "%Y-%m")'), $this->searchmonth);
        });

        $bookings = $dat->with('user', 'admincar')->union($self->with('user', 'admincar'))->get(10);

        return $bookings;
    }


    public function updatedSearchTerm()
    {
        $this->resetPage();
    }

    public function updatedSearchmonth()
    {
        $this->resetPage();
    }

    // Add this function to your Livewire component
    public function fetchChartData()
    {
        // If searchmonth is set, use it for filtering by month
        if ($this->searchmonth) {
            $year = substr($this->searchmonth, 0, 4);

            // Fetch data for all months in the specified year
            $salesData = Totalsale::where('year', $year)
                ->where('month', '=', Carbon::parse($this->searchmonth)->format('F'))
                ->select('month', DB::raw('SUM(total) as total'))
                ->groupBy('month')
                ->get();

            $highlightedMonth = $this->convertToTextMonth((int)substr($this->searchmonth, 5, 2));

            // Add a flag to the salesData indicating whether the month matches the highlighted month
            $salesData->transform(function ($entry) use ($highlightedMonth) {
                $entry['highlighted'] = ($entry['month'] === $highlightedMonth);
                return $entry;
            });

            // Use $this->bookkings here instead of $this->bookings
            $this->bookkings = $salesData->toArray();
        } else {
            // If searchmonth is not set, use the date range for filtering
            $monthsInRange = [
                Carbon::parse($this->startDate)->format('F'),
                Carbon::parse($this->endDate)->format('F')
            ];

            $salesData = Totalsale::whereIn('month', $monthsInRange)
                ->select('month', DB::raw('SUM(total) as total'))
                ->groupBy('month')
                ->get();

            // Use $this->bookkings here instead of $this->bookings
            $this->bookkings = $salesData->toArray();
        }

        // Emit updateChart only when salesData is not empty
        if (!empty($this->bookkings)) {
            $this->emit('updateChart', ['salesData' => $this->bookkings]);
        } else {
            // If salesData is empty, emit an updateChart with an empty array
            $this->emit('updateChart', ['salesData' => []]);
        }
    }

    public function convertToTextMonth($numericMonth)
    {
        $months = [
            'January', 'February', 'March', 'April', 'May', 'June',
            'July', 'August', 'September', 'October', 'November', 'December'
        ];
        return $months[$numericMonth - 1] ?? null;
    }
}
