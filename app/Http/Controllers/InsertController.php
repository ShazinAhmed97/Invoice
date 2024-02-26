<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EntryModel;
use App\Models\InvoiceModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\InvoiceMailable;

class InsertController extends Controller
{
    public function __construct()
    {

        date_default_timezone_set("Asia/Calcutta");   //India time (GMT+5:30)

        $currentDateTime = date('Y-m-d H:i:s');
        $currentDate = date('Y-m-d');
        $currentTime = date('H:i:s');

        $this->currentDate = $currentDate;
        $this->currentTime = $currentTime;
        $this->currentDateTime = $currentDateTime;

    }

    public function entry()
    {
        $get=EntryModel::where('isAvail', 0)->get();
        return view('home', compact('get'));

    }

    public function insert(Request $request)
    {
    $createdAt= $this->currentDateTime;

        $validatedData = $request->validate([
            'name' => 'required|regex:/^[A-Za-z]+$/|min:2|max:50',
            'email' => 'required|email',
            'quantity' => 'required|numeric',
            'amount' => 'required|numeric',
            'file' => 'required|file|mimes:jpg,png,pdf|max:3072',
            'date' => 'required',
            'tax_percentage' => 'required',

        ], [
            'name.required' => 'name field is required.',
            'name.regex' => 'Name must contain only letters.',
            'name.min' => 'Name must be at least 2 characters long.',
            'name.max' => 'Name may not exceed 50 characters.',
            'email.required' => 'email field is required.',
            'email.email' => 'Invalid email format.',
            'quantity.required' => 'quantity field is required.',
            'quantity.numeric' => 'Quantity must be a numeric value.',
            'amount.required' => 'amount field is required.',
            'amount.numeric' => 'Amount must be a numeric value.',
            'file.required' => 'File field is required.',
            'file.file' => 'Invalid file.',
            'file.mimes' => 'Invalid file format. Allowed formats: JPG, JPEG, PNG, PDF.',
            'file.max' => 'File size must not exceed 3 MB.',
            'date.required' => 'date field is required.',
            'tax_percentage.required' => 'tax_percentage is required.',
        ]);

//        print_r('sssssssssss');
//       die();

        if ($validatedData == true)
        {
            $file = request()->file('file');
            $extension = $file->getClientOriginalExtension();
            $fileName = 'invoice_image' . time() . '.' . $extension;
            $file->move(public_path('image'), $fileName,'public');
            $input['file'] = $fileName;

//            print_r("done");
//            die();

            $name =request('name');
            $email =request('email');
            $quantity =request('quantity');
            $amount =request('amount');
            $tax_percentage =request('tax_percentage');
            $time=request('date');
            //$total=request('total');
            $tax=request('tax');
            $netTotal=request('netTotal');


            $entry = new EntryModel();
            $entry->cust_name = $name;
            $entry->cust_email = $email;
            $entry->quantity = $quantity;
            $entry->amount = $amount;
            $entry->tax_percentage = $tax_percentage;
            $entry->tax_amount = $tax;
            $entry->net_amount=$netTotal;
            $entry->image = $fileName;
            $entry->date = $time;
            $entry->created_at = $createdAt;

            $entry->save();
            return redirect()->back()->with('success','Entry Added');
        }
    }

    public function editEntry($bId)
    {
        $singleEntry = EntryModel::find($bId);
        return view('editEntry',compact('singleEntry'));
    }

    public function update(Request $request, $bId)
    {

        $createdAt= $this->currentDateTime;
        $validatedData = $request->validate([
            'name' => 'required|regex:/^[A-Za-z]+$/|min:2|max:50',
            'email' => 'required|email',
            'quantity' => 'required|numeric',
            'amount' => 'required|numeric',
            'file' => 'file|mimes:jpg,png,pdf|max:3072',
            'date' => 'required',
            'tax_percentage' => 'required',

        ], [
            'name.required' => 'name field is required.',
            'name.regex' => 'Name must contain only letters.',
            'name.min' => 'Name must be at least 2 characters long.',
            'name.max' => 'Name may not exceed 50 characters.',
            'email.required' => 'email field is required.',
            'email.email' => 'Invalid email format.',
            'quantity.required' => 'quantity field is required.',
            'quantity.numeric' => 'Quantity must be a numeric value.',
            'amount.required' => 'amount field is required.',
            'amount.numeric' => 'Amount must be a numeric value.',
            'file.file' => 'Invalid file.',
            'file.mimes' => 'Invalid file format. Allowed formats: JPG, PNG, PDF.',
            'file.max' => 'File size must not exceed 3 MB.',
            'date.required' => 'date field is required.',
            'tax_percentage.required' => 'tax_percentage is required.',
        ]);

//        print_r('sssssssssss');
//       die();

        $name =request('name');
        $email =request('email');
        $quantity =request('quantity');
        $amount =request('amount');
        $tax_percentage =request('tax_percentage');
        $time=request('date');
        $tax=request('tax');
        $netTotal=request('netTotal');

        if ($validatedData == true)
        {
            if(request()->hasFile('file')) {
                $file = request()->file('file');
                $extension = $file->getClientOriginalExtension();
                $fileName = 'invoice_image' . time() . '.' . $extension;
                $file->move(public_path('image'), $fileName, 'public');
                $input['file'] = $fileName;




                $entry = EntryModel::find($bId);
                $entry->update([
                    'cust_name'=>$name,
                    'cust_email' => $email,
                    'quantity' => $quantity,
                    'amount' => $amount,
                    'tax_percentage'=> $tax_percentage,
                    'tax_amount'=> $tax,
                    'net_amount' => $netTotal,
                    'image'=> $fileName,
                    'date'=> $time,
                    'updated_at'=>$createdAt
                ]);
                return redirect('/entry')->with('success','Entry Updated');
            }
            else
            {


                $entry = EntryModel::find($bId);
                $entry->update([
                    'cust_name'=>$name,
                    'cust_email' => $email,
                    'quantity' => $quantity,
                    'amount' => $amount,
                    'tax_percentage'=> $tax_percentage,
                    'tax_amount'=> $tax,
                    'net_amount' => $netTotal,
                    //'image'=> $fileName,
                    'date'=> $time,
                    'updated_at'=>$createdAt
                ]);
                return redirect('/entry')->with('success','Entry Updated');
            }


        }
    }

    public function disableEntry($bId)
    {
        $get=EntryModel::find($bId);
        $get->update(['isAvail'=>1]);

        return redirect()->back()->with('success','Entry deleted');
    }

    public function invoiceGenerate($bId)
    {
        $createdAt= $this->currentDateTime;
        $date = date('d-m-Y'); // Example date value

        // Explode the date
        $dateExplode = str_replace('-', '', $date);
        $dateExplode .= $bId;

        $entry =new InvoiceModel();
        $entry->bId = $bId;
        $entry->invoice_no = $dateExplode;
        $entry->created_at = $createdAt;

        $entry->save();
        return redirect()->back()->with('success','Invoice Added');
    }

    public function invoiceList()
    {
        $get = DB::table('entry')
            ->join('invoice', 'entry.bId', '=', 'invoice.bId')
            ->select('entry.cust_name','entry.cust_email','entry.quantity','entry.amount',
                'entry.tax_percentage','entry.tax_amount','entry.net_amount','entry.bId',
                'invoice.invoice_no')
            ->get();

        return view('invoiceList', compact('get'));
    }

    public function singleInvoice($bId)
    {
        $get = DB::table('entry')
            ->join('invoice', 'entry.bId', '=', 'invoice.bId')
            ->select('entry.cust_name','entry.cust_email','entry.quantity','entry.amount',
                'entry.tax_percentage','entry.tax_amount','entry.net_amount','entry.bId','entry.date','entry.image',
                'invoice.invoice_no')
            ->where('entry.bId', $bId)
            ->first();
        return view('singleInvoice', compact('get'));
    }

    public function sendMail($bId)
    {

        try
        {
            $get = DB::table('entry')
                ->join('invoice', 'entry.bId', '=', 'invoice.bId')
                ->select('entry.cust_name','entry.cust_email','entry.quantity','entry.amount',
                    'entry.tax_percentage','entry.tax_amount','entry.net_amount','entry.bId','entry.date','entry.image',
                    'invoice.invoice_no')
                ->where('entry.bId', $bId)
                ->first();
            Mail::to("$get->cust_email")->send(new InvoiceMailable($get));
            return redirect('/singleInvoice/'.$get->bId)->with('success','Invoice has send to '.$get->cust_email);
        }
        catch (\Exception $e)
        {
            return redirect('/singleInvoice/'.$get->bId)->with('error',$e);
        }

    }

}
