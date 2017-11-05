<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Jobs\SendNotifications;
use Minishlink\WebPush\WebPush;
use Illuminate\Support\Facades\Log;
use App\Models\Contracts\Repositories\HistoryRepository;
use App\Models\Contracts\Repositories\CurrentYearRepository;
use App\Models\Contracts\Repositories\SubscriptionRepository;

class CurrentYearController extends Controller
{
    /**
     * @var CurrentYearRepository
     */
    protected $model;

    /**
     * @var SubscriptionRepository
     */
    protected $subscription;

    /**
     * @var HistoryRepository
     */
    protected $history;

    /**
     * CurrentYearController constructor.
     *
     * @param CurrentYearRepository $model
     * @param SubscriptionRepository $subscription
     * @param HistoryRepository $history
     */
    public function __construct(CurrentYearRepository $model, SubscriptionRepository $subscription, HistoryRepository $history)
    {
        $this->model = $model;
        $this->history = $history;
        $this->subscription = $subscription;
    }

    /**
     * Create a new year entry
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function newYear()
    {
        $year = date('Y');

        try {
            $this->model->create(['year' => $year]);

            $prevYear = (int) $year - 1;
            $model = $this->model->findBy('year', $prevYear);

            $this->history->create([
                'year' => $prevYear,
                'assaults' => $model->assaults,
                'murders' => $model->murders,
            ]);
        } catch (\Exception $e) {
            session()->flash('error', 'Year already exists');

            return response()->redirectToAction('HomeController@index');
        }

        session()->flash('success', 'New year created and data saved.');

        return response()->redirectToAction('HomeController@index');
    }

    /**
     * Add new assault
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function newAssault(Request $request)
    {
        $year = date('Y');

        $model = $this->model->findBy('year', $year);

        ++$model->assaults;

        $model->save();

        session()->flash('success', 'Added new assault');

        try {
            $this->sendNotification($request);
        } catch (\Exception $e) {
            Log::error('Could not send push notifications ' . $e->getMessage());
        }

        return response()->redirectToAction('HomeController@index');
    }

    /**
     * Add new murder
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function newMurder(Request $request)
    {
        $year = date('Y');

        $model = $this->model->findBy('year', $year);

        ++$model->murders;

        $model->save();

        session()->flash('success', 'Added new murder');

        try {
            $this->sendNotification($request);
        } catch (\Exception $e) {
            Log::error('Could not send push notifications ' . $e->getMessage());
        }

        return response()->redirectToAction('HomeController@index');
    }

    /**
     * Get data for the current year
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getData(Request $request)
    {
        $year = date('Y');

        $model = $this->model->findBy('year', $year);

        return response()->json([
            'assaults' => $model->assaults,
            'murders' => $model->murders
        ]);
    }

    /**
     * Send push notifications
     *
     * @param $request
     * @throws \ErrorException
     */
    private function sendNotification($request)
    {
        $subs = $this->subscription->all();

        $data = [
            0 => [
                'VAPID' => [
                    'subject' => $request->getHost(),
                    'publicKey' => env('PUSH_MESSAGE_PUBLIC_KEY'),
                    'privateKey' => env('PUSH_MESSAGE_PRIVATE_KEY'),
                ]
            ]
        ];

        foreach ($subs as $sub) {
            $data[] = $sub;

            SendNotifications::dispatch($data)->delay(Carbon::now()->addMinutes(1));
        }

        return true;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
