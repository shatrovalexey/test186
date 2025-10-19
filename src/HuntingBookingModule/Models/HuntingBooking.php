<?php
namespace test186\HuntingBookingModule\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use test186\HuntingBookingModule\Models\{Guide, Service};
use Carbon\Carbon;

class HuntingBooking extends Model
{
    use HasFactory;

    public const int PARTICIPANTS_COUNT_MIN = 1;
    public const int PARTICIPANTS_COUNT_MAX = 10;
    protected $fillable = [
        'service_id',
        'guide_id',
        'date',
        'participants_count'
    ];

    protected $casts = [
        'date' => 'date',
        'participants_count' => 'integer'
    ];

    // Валидация при сохранении
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            if (
                ($model->participants_count < static::PARTICIPANTS_COUNT_MIN)
                    || ($model->participants_count > static::PARTICIPANTS_COUNT_MAX)
            ) throw new \Exception('Количество участников должно быть ' .
                implode('-', [static::PARTICIPANTS_COUNT_MIN, static::PARTICIPANTS_COUNT_MAX,])
            );

            {
                $datetimeCurrent = Carbon::parse($model->date);
                $datetimeLast = $datetimeCurrent->copy()->addMinutes(30);

                if (static::whereBetween('date', [$datetimeCurrent, $datetimeLast,])->exists())
                    throw new \Exception('Занято');
            }
        });
    }

    /**
     * Отношение с гидом
     */
    public function guide()
    {
        return $this->belongsTo(Guide::class);
    }

    /**
     * Отношение с гидом
     */
    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    /**
     * Проверка валидности количества участников
     */
    public function hasValidParticipantsCount()
    {
        return ($this->participants_count > 0)
            && ($this->participants_count <= static::PARTICIPANTS_COUNT_MAX);
    }

    /**
     * Scope для бронирований на дату
     */
    public function scopeOnDate($query, $date)
    {
        return $query->where('date', $date);
    }

    /**
     * Scope для бронирований гида
     */
    public function scopeForGuide($query, $guideId)
    {
        return $query->where('guide_id', $guideId);
    }
}