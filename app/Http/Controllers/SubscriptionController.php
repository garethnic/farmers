<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Minishlink\WebPush\WebPush;
use App\Models\Contracts\Repositories\SubscriptionRepository;

class SubscriptionController extends Controller
{
    /**
     * @var SubscriptionRepository
     */
    protected $model;

    public function __construct(SubscriptionRepository $model)
    {
        $this->model = $model;
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
        $body = json_decode($request->get('body'));

        $this->model->create([
            'endpoint' => $body->endpoint,
            'p256dh' => $body->keys->p256dh,
            'auth' => $body->keys->auth,
        ]);

        return response()->json(true, 200, [
            'Content-Type' => 'application/json'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $body = json_decode($request->get('body'));

        $model = $this->model->findBy('auth', $body->keys->auth);

        $model->delete();

        return response()->json(true, 200, [
            'Content-Type' => 'application/json'
        ]);
    }

    public function sendNotifications(Request $request)
    {
        $subs = $this->model->all();
        $push = new WebPush();

        $auth = [
            'VAPID' => [
                'subject' => $request->getHost(),
                'publicKey' => env('PUSH_MESSAGE_PUBLIC_KEY'),
                'privateKey' => env('PUSH_MESSAGE_PRIVATE_KEY'),
            ]
        ];

        foreach ($subs as $sub) {
            $push->sendNotification(
                $sub['endpoint'],
                null,
                $sub['p256dh'],//env('PUSH_MESSAGE_PUBLIC_KEY'),
                $sub['auth'],
                true,
                ['TTL' => 5000, 'urgency' => 'high'],
                $auth
            );
        }

        return response()->json('Notifications sent.');
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
}
