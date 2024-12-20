@extends('layouts.app')

@section('content')
<h1>Invoices</h1>
<a href="{{ route('invoices.create') }}" class="btn btn-primary mb-3">Create Invoice</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Invoice Code</th>
            <th>Invoice Date</th>
            <th>Customer Name</th>
            <th>No of Services</th>
            <th>Total Amount</th>
            <th>Discount</th>
            <th>Vat Amount</th>
            <th>Grand Total</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($invoices as $invoice)
        <tr>
            <td>{{ $invoice->id }}</td>
            <td>{{ $invoice->invoice_code }}</td>
            <td>{{ $invoice->invoice_date->format('Y-m-d') }}</td>
            <td>{{ $invoice->customer_name }}</td>
            <td>{{ $invoice->invoicesServices->count() }}</td>
            <td>{{ number_format($invoice->total_amount, 2) }}</td>
            <td>{{ number_format($invoice->discount_amount, 2) }}</td>
            <td>{{ number_format($invoice->vat_amount, 2) }}</td>
            <td>{{ number_format($invoice->grand_total, 2) }}</td>
            <td>
                <a href="{{ route('invoices.show', $invoice->id) }}" class="btn btn-info btn-sm">View</a>
                <a href="{{ route('invoices.download', $invoice->id) }}" class="btn btn-success btn-sm">Download PDF</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
