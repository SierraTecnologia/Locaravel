<?php

namespace Locaravel\Repositories\Travels;

use Carbon\Carbon;
use Locaravel\Models\Travels\Apart;
use App\Repositories\CmsRepository;
use App\Repositories\TranslationRepository;

class ApartRepository extends CmsRepository
{
    public $model;

    public $translationRepo;

    public $table;

    public function __construct(Apart $model, TranslationRepository $translationRepo)
    {
        $this->model = $model;
        $this->translationRepo = $translationRepo;
        $this->table = config('cms.db-prefix').'aparts';
    }

    /**
     * Returns all published Aparts.
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function findApartsByDate($date)
    {
        return $this->model->where('is_published', 1)
            ->where('published_at', '<=', Carbon::now(config('app.timezone'))->format('Y-m-d H:i:s'))
            ->orderBy('created_at', 'desc')->where('start_date', '<=', $date)
            ->where('end_date', '>=', $date)->get();
    }

    /**
     * Stores Apart into database.
     *
     * @param array $payload
     *
     * @return Apart
     */
    public function store($payload)
    {
        $payload['title'] = htmlentities($payload['title']);
        $payload['is_published'] = (isset($payload['is_published'])) ? (bool) $payload['is_published'] : 0;
        $payload['published_at'] = (isset($payload['published_at']) && !empty($payload['published_at'])) ? Carbon::parse($payload['published_at'])->format('Y-m-d H:i:s') : Carbon::now(config('app.timezone'))->format('Y-m-d H:i:s');

        return $this->model->create($payload);
    }

    /**
     * Updates Apart into database.
     *
     * @param Apart $room
     * @param array $input
     *
     * @return Apart
     */
    public function update($room, $payload)
    {
        $payload['title'] = htmlentities($payload['title']);
        if (!empty($payload['lang']) && $payload['lang'] !== config('cms.default-language', 'en')) {
            return $this->translationRepo->createOrUpdate($room->id, 'App\Models\Calendar\Apart', $payload['lang'], $payload);
        } else {
            $payload['is_published'] = (isset($payload['is_published'])) ? (bool) $payload['is_published'] : 0;
            $payload['published_at'] = (isset($payload['published_at']) && !empty($payload['published_at'])) ? Carbon::parse($payload['published_at'])->format('Y-m-d H:i:s') : Carbon::now(config('app.timezone'))->format('Y-m-d H:i:s');

            unset($payload['lang']);

            return $room->update($payload);
        }
    }
}
