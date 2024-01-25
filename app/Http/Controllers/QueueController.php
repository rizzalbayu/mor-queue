<?php

namespace App\Http\Controllers;

use App\Http\Resources\QueueCollection;
use App\Http\Resources\QueueResource;
use App\Models\Queues;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QueueController extends Controller
{
    public function search(Request $request): QueueCollection{
        $page = $request->query('page', 1);
        $size = $request->query('size', 10);
        
        $queues = Queues::query()->where(function(Builder $builder) use ($request){
            $code = $request->query('code');
            if ($code){
                $builder->where('code', 'like', '%'.$code.'%');
            }

            $isConfirmed = $request->query('isConfirmed');
            if ($isConfirmed === 'true'){
                $builder->whereNotNull('confirmed_at');
            } else if ($isConfirmed === 'false' ) {
                $builder->whereNull('confirmed_at');
            }

            $isServed = $request->query('isServed');
            if ($isServed === 'true'){
                $builder->whereNotNull('served_at');
            } else if ($isServed === 'false' ) {
                $builder->whereNull('served_at');
            }
        });

        $queues = $queues->paginate(perPage:$size, page:$page);

        return new QueueCollection($queues);
    }

    public function todayConfirm(Request $request): QueueCollection{
        $page = $request->query('page', 1);
        $size = $request->query('size', 10);
        
        $queues = Queues::query()->where(function(Builder $builder) use ($request){
            $code = $request->query('code');
            if ($code){
                $builder->where('code', 'like', '%'.$code.'%');
            }
        });

        $queues = $queues->whereNotNull('confirmed_at')->whereNull('served_at')->where('reservation_date', today())->orderBy('confirmed_at','asc')->paginate(perPage:$size, page:$page);

        return new QueueCollection($queues);
    }

    public function confirm(int $id) : QueueResource {
        $queue = Queues::where('id', $id)->first();
        if (!$queue) {
            throw new HttpResponseException(response([
                "error" => [
                    "message" => [
                        "queue not found"
                    ]
                ]
            ],404));
        }

        if ($queue->confimed_at === null) {
            throw new HttpResponseException(response([
                "error" => [
                    "message" => [
                        "queue already confirm"
                    ]
                ]
            ],404));
        }
        $queue->status = 'confirm';
        $queue->confirmed_at = now();
        $queue->save();

        return new QueueResource($queue);
    }

    public function serve(int $id) : QueueResource {
        $queue = Queues::where('id', $id)->first();
        if (!$queue) {
            throw new HttpResponseException(response([
                "error" => [
                    "message" => [
                        "queue not found"
                    ]
                ]
            ],404));
        }

        if ($queue->confirmed_at === null) {
            throw new HttpResponseException(response([
                "error" => [
                    "message" => [
                        "queue not confirm"
                    ]
                ]
            ],404));
        }

        if ($queue->served_at) {
            throw new HttpResponseException(response([
                "error" => [
                    "message" => [
                        "queue already serve"
                    ]
                ]
            ],404));
        }

        $queue->status = 'serve';
        $queue->served_at = now();
        $queue->save();

        return new QueueResource($queue);
    }

    public function complete(int $id) : QueueResource {
        $queue = Queues::where('id', $id)->first();
        if (!$queue) {
            throw new HttpResponseException(response([
                "error" => [
                    "message" => [
                        "queue not found"
                    ]
                ]
            ],404));
        }

        if ($queue->served_at === null) {
            throw new HttpResponseException(response([
                "error" => [
                    "message" => [
                        "queue not serve"
                    ]
                ]
            ],404));
        }

        if ($queue->status === 'complete') {
            throw new HttpResponseException(response([
                "error" => [
                    "message" => [
                        "queue already complete"
                    ]
                ]
            ],404));
        }

        $queue->status = 'complete';
        $queue->served_at = now();
        $queue->save();

        return new QueueResource($queue);
    }
}
