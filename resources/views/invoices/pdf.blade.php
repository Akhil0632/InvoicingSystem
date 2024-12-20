<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 30px;
        }

        h1 {
            text-align: center;
            font-size: 28px;
            margin-bottom: 30px;
        }

        h3 {
            text-align: center;
            margin-top: 30px;
            font-size: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 8px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        td {
            text-align: right;
        }

        .table th, .table td {
            font-size: 16px;
        }

        .details-table td {
            text-align: left;
        }

        .invoice-summary {
            margin-top: 30px;
            font-size: 16px;
        }

        .invoice-summary td {
            padding: 10px 0;
        }

        .invoice-summary th {
            text-align: right;
        }

        .total {
            font-weight: bold;
            font-size: 18px;
        }

        .bold {
            font-weight: bold;
        }

        .text-right {
            text-align: right;
        }

        .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 14px;
        }
    </style>
</head>
<body>
<div class="container my-5">
    <div class="invoice-header mb-4 p-4" style="background-color: #f8f9fa; border-radius: 8px;">
        <h1 class="text-center">Invoice Details</h1>

        <table class="details-table table table-bordered table-striped">
            <tr>
                <td><strong>Invoice Code: </strong> {{ $invoice->invoice_code }}</td>
                <td><strong>Invoice Date: </strong> {{ $invoice->invoice_date }}</td>
            </tr>
            <tr>
                <td><strong>Customer Name: </strong> {{ $invoice->customer_name }}</td>
                <td><strong>Customer Address: </strong> {{ $invoice->customer_address }}</td>
            </tr>
            <tr>
                <td colspan="2"><strong>Notes: </strong> {{ $invoice->notes }}</td>
            </tr>
        </table>
    </div>

    <h3 class="text-center my-4">Services</h3>
    <table class="table table-hover table-bordered table-striped">
        <thead>
            <tr>
                <th>Service</th>
                <th>Hours</th>
                <th>Hourly Rate</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($invoice->InvoicesServices as $service)
                <tr>
                    <td>{{ $service->service_name }}</td>
                    <td>{{ $service->hours }}</td>
                    <td>{{ number_format($service->hourly_rate, 2) }}</td>
                    <td>{{ number_format($service->hours * $service->hourly_rate, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="total-section mt-4">
        <h3 class="text-center">Invoice Summary</h3>
        <table class="invoice-summary table table-bordered table-striped">
            <tr>
                <th>Total No of Services:</th>
                <td>{{ $invoice->invoicesServices->count() }}</td>
            </tr>
            <tr>
                <th>Total Hours:</th>
                <td>{{ $invoice->invoicesServices->sum('hours') }}</td>
            </tr>
            <tr>
                <th>Total Amount:</th>
                <td>{{ number_format($invoice->total_amount, 2) }}</td>
            </tr>
            <tr>
                <th>Discount:</th>
                <td>{{ number_format($invoice->discount_amount, 2) }}</td>
            </tr>
            <tr>
                <th>VAT Amount:</th>
                <td>{{ number_format($invoice->vat_amount, 2) }}</td>
            </tr>
            <tr class="total">
                <th>Grand Total:</th>
                <td>{{ number_format($invoice->grand_total, 2) }}</td>
            </tr>
        </table>
    </div>
</div>

    <div class="footer">
        <p>Thank you for doing business with us!</p>
        <p>Invoice generated on {{ now()->format('d M, Y H:i:s') }}</p>
    </div>

</body>
</html>
