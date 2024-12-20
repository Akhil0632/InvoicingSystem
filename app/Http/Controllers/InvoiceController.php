<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\InvoicesService;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoices = Invoice::with('invoicesServices')->get();
        return view('invoices.index', compact('invoices'));
    }

    public function create()
    {
        $customers = ['John Doe', 'Jane Smith', 'Mike Tyson', 'Emma Watson', 'Chris Evans'];
        $services = [
            ['name' => 'Football', 'hourly_rate' => 150],
            ['name' => 'Badminton', 'hourly_rate' => 100],
            ['name' => 'Cricket', 'hourly_rate' => 175],
            ['name' => 'Tennis', 'hourly_rate' => 125],
            ['name' => 'Swimming Pool', 'hourly_rate' => 200],

        ];

        return view('invoices.create', compact('customers', 'services'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_name'    => 'required',
            'customer_address' => 'required',
            'notes'            => 'nullable|string',
            'services'         => 'required|array|min:1',
            'services.*.name'  => 'required|string',
            'services.*.hours' => 'required|integer|min:1',
            'services.*.rate'  => 'required|numeric|min:0',
            'discount_amount'  => 'nullable|numeric|min:0',
        ]);

        $invoiceCode = 'INV-' . strtoupper(uniqid());
        $invoiceDate = now();

        $servicesData = [];
        $totalAmount = 0;

        foreach ($request->services as $service) {
            $serviceTotal = $service['hours'] * $service['rate'];
            $totalAmount += $serviceTotal;

            $servicesData[] = [
                'service_name' => $service['name'], 
                'hours'        => $service['hours'], 
                'hourly_rate'  => $service['rate'], 
                'amount'       => $serviceTotal,
            ];
        }

        $vatAmount = $totalAmount * 0.05;
        $discountAmount = $request->discount_amount ?? 0;
        $grandTotal = $totalAmount + $vatAmount - $discountAmount;

        $invoice = Invoice::create([
            'invoice_code'     => $invoiceCode,
            'invoice_date'     => $invoiceDate,
            'customer_name'    => $request->customer_name,
            'customer_address' => $request->customer_address,
            'notes'            => $request->notes,
            'total_amount'     => $totalAmount,
            'vat_amount'       => $vatAmount,
            'discount_amount'  => $discountAmount,
            'grand_total'      => $grandTotal,
        ]);

        foreach ($servicesData as $serviceData) {
            $invoice->InvoicesServices()->create($serviceData);
        }

        return redirect()->route('invoices.index')->with('success', 'Invoice generated successfully.');
    }   


    public function show($id)
    {
        $invoice = Invoice::with('InvoicesServices')->findOrFail($id);
    
        return view('invoices.show', compact('invoice'));
    }

    public function download($id)
    {
        $invoice = Invoice::with('InvoicesServices')->findOrFail($id);

        $pdf = Pdf::loadView('invoices.pdf', compact('invoice'));

        return $pdf->download('invoice-' . $invoice->invoice_code . '.pdf');
    }


}
