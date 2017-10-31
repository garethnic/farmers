<?php

namespace App\Http\Controllers;

use App\Models\Contracts\Repositories\CurrentYearRepository;
use App\Models\Contracts\Repositories\HistoryRepository;
use App\Models\Contracts\Repositories\SubscriptionRepository;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

class HomeController extends Controller
{
    /**
     * @var CurrentYearRepository
     */
    protected $currentYear;

    protected $history;

    protected $subscriptions;

    /**
     * Create a new controller instance.
     *
     * @param CurrentYearRepository $currentYear
     * @param HistoryRepository $history
     * @return void
     */
    public function __construct(CurrentYearRepository $currentYear, HistoryRepository $history, SubscriptionRepository $sub)
    {
        $this->middleware('auth');

        $this->history = $history;
        $this->subscriptions = $sub;
        $this->currentYear = $currentYear;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $getCurrentYear = date('Y');

        $currentYear = $this->currentYear->findBy('year', $getCurrentYear);

        $subscriptions = count($this->subscriptions->all());

        $history = $this->history->all([], ['year' => 'asc']);
        $history = new Paginator($history, 25);

        return view('home')->with([
            'history' => $history,
            'currentYear' => $currentYear,
            'subscriptions' => $subscriptions,
        ]);
    }
}
