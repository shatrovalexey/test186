<?php
namespace test186\HuntingBookingModule\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use test186\HuntingBookingModule\Models\HuntingBooking;

/**
* Проводник
*/
class Guide extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'experience_years',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'experience_years' => 'integer'
    ];

    /**
     * Отношение с бронированиями
     */
    public function bookings()
    {
        return $this->hasMany(HuntingBooking::class);
    }

    /**
     * Проверка доступности гида на дату
     */
    public function isAvailableOnDate($date)
    {
        return !$this->bookings()->where('date', $date)->exists();
    }

    /**
     * Scope для активных гидов
     */
    public function getActive($query, bool $is_active = true)
    {
        return $query->where('is_active', $is_active);
    }

    /**
     * Scope для гидов с опытом
     */
    public function getExperienced($query, int $minYears = 3)
    {
        return $query->where('experience_years', '>=', $minYears);
    }
}