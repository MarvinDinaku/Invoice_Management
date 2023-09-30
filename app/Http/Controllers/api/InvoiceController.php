<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\InvoiceLineItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class InvoiceController extends Controller
{
    public function createInvoice(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'line_items' => 'required|array|min:1',
            'line_items.*.product_id' => 'required|exists:products,id',
            'line_items.*.quantity' => 'required|integer|min:1',
            'discount' => 'nullable|numeric|min:0',
        ]);

        // Create the invoice
        $invoice = Invoice::create([
            'date' => $request->input('date'),
            'discount' => $request->input('discount', 0),
        ]);

        $totalAmount = 0;

        foreach ($request->input('line_items') as $lineItemData) {
            $product = Product::find($lineItemData['product_id']);

            if (!$product) {
                return response()->json(['error' => 'Product not found'], 404);
            }

            $lineItem = InvoiceLineItem::create([
                'invoice_id' => $invoice->id,
                'product_id' => $lineItemData['product_id'],
                'quantity' => $lineItemData['quantity'],
                'total_price' => $product->price * $lineItemData['quantity'],
            ]);

            $totalAmount += $lineItem->total_price;
        }

        if ($invoice->discount > 0) {
            // Apply discount if provided
            $totalAmount -= ($invoice->discount_type === 'percentage') ?
                ($invoice->discount / 100) * $totalAmount :
                $invoice->discount;
        }

        // Update the total_amount of the invoice
        $invoice->update(['total_amount' => max(0, $totalAmount)]);

        return response()->json(['invoice' => $invoice], 201);
    }

    public function updateInvoice(Request $request, $id)
    {
        $request->validate([
            'date' => 'required|date',
            'line_items' => 'required|array|min:1',
            'line_items.*.product_id' => 'required|exists:products,id',
            'line_items.*.quantity' => 'required|integer|min:1',
            'discount' => 'nullable|numeric|min:0',
        ]);

        $invoice = Invoice::find($id);

        if (!$invoice) {
            return response()->json(['error' => 'Invoice not found'], 404);
        }

        $invoice->update([
            'date' => $request->input('date'),
            'discount' => $request->input('discount', 0),
        ]);

        $totalAmount = 0;

        $invoice->lineItems()->delete();

        foreach ($request->input('line_items') as $lineItemData) {
            $product = Product::find($lineItemData['product_id']);

            if (!$product) {
                return response()->json(['error' => 'Product not found'], 404);
            }

            $lineItem = InvoiceLineItem::create([
                'invoice_id' => $invoice->id,
                'product_id' => $lineItemData['product_id'],
                'quantity' => $lineItemData['quantity'],
                'total_price' => $product->price * $lineItemData['quantity'],
            ]);

            $totalAmount += $lineItem->total_price;
        }

        if ($invoice->discount > 0) {
            $totalAmount -= ($invoice->discount_type === 'percentage') ?
                ($invoice->discount / 100) * $totalAmount :
                $invoice->discount;
        }

        $invoice->update(['total_amount' => max(0, $totalAmount)]);

        return response()->json(['invoice' => $invoice], 200);
    }

    public function getInvoice($id)
    {
        $invoice = Invoice::with(['lineItems.product'])->find($id);

        if (!$invoice) {
            return response()->json(['error' => 'Invoice not found'], 404);
        }

        return response()->json(['invoice' => $invoice], 200);
    }

    public function deleteInvoice($id)
    {
        $invoice = Invoice::find($id);

        if (!$invoice) {
            return response()->json(['error' => 'Invoice not found'], 404);
        }

        $invoice->lineItems()->delete();
        $invoice->delete();

        return response()->json(['message' => 'Invoice deleted'], 204);
    }

    public function listInvoices()
    {
        $invoices = Invoice::with(['lineItems.product'])->get();

        return response()->json(['invoices' => $invoices], 200);
    }
}
