@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="text-center mb-4">Create Invoice</h1>

    <form action="{{ route('invoices.store') }}" method="POST">
        @csrf
        <div class="container border p-4 rounded bg-light">
            <h4 class="mb-3 text-center">Customer Details</h4>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="invoice_code">Invoice Code</label>
                        <input type="text" id="invoice_code" name="invoice_code" class="form-control" value="{{ uniqid('INV-') }}" readonly>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="invoice_date">Invoice Date</label>
                        <input type="date" id="invoice_date" name="invoice_date" class="form-control" value="{{ now()->toDateString() }}" required>
                    </div>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="customer_name">Customer Name</label>
                        <select id="customer_name" name="customer_name" class="form-control" required>
                            <option value="">Select Customer</option>
                            @foreach($customers as $customer)
                                <option value="{{ $customer }}">{{ $customer }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="customer_address">Customer Address</label>
                        <textarea id="customer_address" name="customer_address" class="form-control" rows="3" placeholder="Enter customer address" required></textarea>
                    </div>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="notes">Notes</label>
                        <textarea id="notes" name="notes" class="form-control" rows="3" placeholder="Additional notes"></textarea>
                    </div>
                </div>
            </div>
        </div>

        <div class="container border p-4 rounded bg-light mt-4">
    <h4 class="mb-3 text-center">Service Details</h4>
    <div id="service-details-container">
        <div class="service-row mb-3" data-index="0">
            <div class="row align-items-end">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Service Name</label>
                        <select name="services[0][name]" class="form-control service-name" required>
                            <option value="">Select Service</option>
                            @foreach($services as $service)
                                <option value="{{ $service['name'] }}" data-rate="{{ $service['hourly_rate'] }}">
                                    {{ $service['name'] }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label>Hourly Rate</label>
                        <input type="number" name="services[0][rate]" class="form-control hourly-rate" readonly>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label>Hours</label>
                        <input type="number" name="services[0][hours]" class="form-control service-hours" min="1" required>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label>Service Total</label>
                        <input type="number" name="services[0][total]" class="form-control service-total" readonly>
                    </div>
                </div>
                <div class="col-md-2 text-right">
                    <button type="button" class="btn btn-danger remove-service-btn">Remove</button>
                </div>
            </div>
        </div>
    </div>
    <button type="button" id="add-service-btn" class="btn btn-primary mb-3">Add Service</button>
</div>


        <div class="container border p-4 rounded bg-light mt-4">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="total_amount">Total Amount</label>
                        <input type="number" id="total_amount" name="total_amount" class="form-control" readonly>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="discount_amount">Discount Amount</label>
                        <input type="number" id="discount_amount" name="discount_amount" class="form-control">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-check">
                        <input type="checkbox" id="enable_vat" name="enable_vat" class="form-check-input">
                        <label for="enable_vat" class="form-check-label">Enable VAT (5%)</label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="vat_amount">VAT Amount</label>
                        <input type="number" id="vat_amount" name="vat_amount" class="form-control" readonly>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="grand_total">Grand Total</label>
                        <input type="number" id="grand_total" name="grand_total" class="form-control" readonly>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center mt-4">
            <button type="submit" class="btn btn-success">Submit Invoice</button>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', () => {
    const container = document.getElementById('service-details-container');
    const addServiceBtn = document.getElementById('add-service-btn');
    const totalAmountInput = document.getElementById('total_amount');
    const vatAmountInput = document.getElementById('vat_amount');
    const discountAmountInput = document.getElementById('discount_amount');
    const enableVatCheckbox = document.getElementById('enable_vat');
    const grandTotalInput = document.getElementById('grand_total');

    // Add new service row
    addServiceBtn.addEventListener('click', () => {
        const rows = document.querySelectorAll('.service-row');
        const newIndex = rows.length;

        // Clone the first row
        const newRow = rows[0].cloneNode(true);
        newRow.setAttribute('data-index', newIndex);

        // Update name attributes with the new index
        Array.from(newRow.querySelectorAll('select, input')).forEach((input) => {
            const name = input.getAttribute('name');
            if (name) {
                const updatedName = name.replace(/\[\d+\]/, `[${newIndex}]`);
                input.setAttribute('name', updatedName);
                input.value = ''; // Clear existing values
            }
        });

        container.appendChild(newRow);
        attachRowListeners(newRow);
        calculateTotals();
    });

    // Attach listeners to a single row
    function attachRowListeners(row) {
        const serviceNameSelect = row.querySelector('.service-name');
        const hourlyRateInput = row.querySelector('.hourly-rate');
        const serviceHoursInput = row.querySelector('.service-hours');
        const serviceTotalInput = row.querySelector('.service-total');

        serviceNameSelect.addEventListener('change', () => {
            const selectedOption = serviceNameSelect.options[serviceNameSelect.selectedIndex];
            const hourlyRate = parseFloat(selectedOption.getAttribute('data-rate')) || 0;
            hourlyRateInput.value = hourlyRate.toFixed(2);

            updateServiceTotal(row);
        });

        serviceHoursInput.addEventListener('input', () => {
            updateServiceTotal(row);
        });

        row.querySelector('.remove-service-btn').addEventListener('click', () => {
            if (container.querySelectorAll('.service-row').length > 1) {
                row.remove();
                calculateTotals();
            } else {
                alert('At least one service row is required.');
            }
        });
    }

    // Update service total for a single row
    function updateServiceTotal(row) {
        const hourlyRateInput = row.querySelector('.hourly-rate');
        const serviceHoursInput = row.querySelector('.service-hours');
        const serviceTotalInput = row.querySelector('.service-total');

        const hourlyRate = parseFloat(hourlyRateInput.value) || 0;
        const hours = parseFloat(serviceHoursInput.value) || 0;
        serviceTotalInput.value = (hourlyRate * hours).toFixed(2);

        calculateTotals();
    }

    // Calculate totals for all rows
    function calculateTotals() {
        let totalAmount = 0;

        // Iterate over all service rows and calculate their totals
        document.querySelectorAll('.service-row').forEach((row) => {
            const serviceTotalInput = row.querySelector('.service-total');
            totalAmount += parseFloat(serviceTotalInput.value) || 0;
        });

        totalAmountInput.value = totalAmount.toFixed(2);

        const vatAmount = enableVatCheckbox.checked ? totalAmount * 0.05 : 0;
        vatAmountInput.value = vatAmount.toFixed(2);

        const discountAmount = parseFloat(discountAmountInput.value) || 0;
        const grandTotal = totalAmount + vatAmount - discountAmount;
        grandTotalInput.value = grandTotal.toFixed(2);
    }

    // Attach listeners to all existing rows on page load
    document.querySelectorAll('.service-row').forEach((row) => {
        attachRowListeners(row);
    });

    // VAT and Discount Listeners
    enableVatCheckbox.addEventListener('change', calculateTotals);
    discountAmountInput.addEventListener('input', calculateTotals);
});


        </script>
    </form>
</div>
@endsection
