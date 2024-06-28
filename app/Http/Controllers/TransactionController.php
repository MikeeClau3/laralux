<?php
namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Member;
use App\Models\Product;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with('member', 'products')->get();
        return view('transactions.index', compact('transactions'));
    }

    public function create()
    {
        $members = Member::all();
        $products = Product::all();
        return view('transactions.create', compact('members', 'products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'member_id' => 'required|exists:members,id',
            'products' => 'required|array',
            'products.*' => 'exists:products,id',
            'quantities' => 'required|array',
            'quantities.*' => 'integer|min:1',
            'points_used' => 'integer|min:0',
        ]);

        $member = Member::find($request->member_id);
        $products = Product::whereIn('id', $request->products)->get();

        $totalAmount = 0;
        $pointsEarned = 0;
        $productsData = [];
        
        foreach ($products as $index => $product) {
            $quantity = $request->quantities[$index];
            $totalAmount += $product->price * $quantity;
            $productsData[$product->id] = [
                'quantity' => $quantity,
                'price' => $product->price,
            ];
            // Hitung poin berdasarkan tipe produk
            if (in_array($product->type, ['deluxe', 'superior', 'suite'])) {
                $pointsEarned += 5 * $quantity;
            } else {
                $pointsEarned += floor($product->price * $quantity / 300000);
            }
        }

        // Hitung pajak
        $tax = $totalAmount * 0.11;

        // Potong poin dari transaksi jika ada
        if ($request->points_used > 0) {
            $pointsToDeduct = min($member->points, $request->points_used);
            $totalAmount -= $pointsToDeduct * 100000;
            $member->points -= $pointsToDeduct;
        }

        // Simpan transaksi
        $transaction = Transaction::create([
            'member_id' => $member->id,
            'total_amount' => $totalAmount + $tax,
            'points_used' => $request->points_used,
            'tax' => $tax,
        ]);

        $transaction->products()->attach($productsData);

        // Tambahkan poin ke member
        $member->points += $pointsEarned;
        $member->save();

        return redirect()->route('transactions.index')->with('success', 'Transaction created successfully.');
    }

    public function show(Transaction $transaction)
    {
        $transaction->load('member', 'products');
        return view('transactions.show', compact('transaction'));
    }

    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
        return redirect()->route('transactions.index')->with('success', 'Transaction deleted successfully.');
    }
}
