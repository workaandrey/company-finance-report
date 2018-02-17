<?php

namespace App\Http\Controllers;

use App\Company;
use App\FinanceReport;
use App\Http\Requests\CompanyFinanceHistoryRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class CompanyController extends Controller
{
    /**
     * @return View
     */
    public function index ():View {
        return view('index');
    }

    /**
     * @param CompanyFinanceHistoryRequest $request
     * @param FinanceReport $financeReport
     * @return View
     */
    public function financesHistory(CompanyFinanceHistoryRequest $request, FinanceReport $financeReport): View
    {
        $dateStart = $request->get('dateStart');
        $dateEnd = $request->get('dateEnd');
        $company = Company::where('symbol', $request->get('companySymbol'))->first();

        $report = $financeReport->report(
            $request->companySymbol,
            Carbon::parse($dateStart),
            Carbon::parse($dateEnd)
        );

        $subject = 'Finance report for '.$company->name.' From '.$dateStart.' to ' . $dateEnd;
        $email = $request->email;
        Mail::send('emails.financeReport', compact('dateStart', 'dateEnd', 'company', 'report'), function ($m) use ($email, $subject) {
            $m->from(config('mail.from.address'), config('mail.from.name'));
            $m->to($email, '')->subject($subject);
        });

        return view('companyFinances', compact('dateStart', 'dateEnd', 'company', 'report'));
    }
}
