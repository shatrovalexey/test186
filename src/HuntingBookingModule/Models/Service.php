<?php
namespace test186\HuntingBookingModule\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use test186\HuntingBookingModule\Helpers\{Money, Minutes};
use test186\HuntingBookingModule\Models\{HuntingBooking, Guide,};

/**
* Услуга
*/
class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'duration',
        'price',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'duration' => 'integer',
        'price' => 'decimal:2',
    ];

    /**
     * Отношение с бронированиями
     */
    public function bookings()
    {
        return $this->hasMany(HuntingBooking::class);
    }

    /**
     * Активные бронирования услуги
     */
    public function activeBookings()
    {
        return $this->bookings()->where('status', 'confirmed');
    }

    /**
     * Scope для активных услуг
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope для услуг по длительности
     */
    public function scopeDurationBetween(Builder $query, int $minDuration, int $maxDuration): Builder
    {
        return $query->whereBetween('duration', [$minDuration, $maxDuration]);
    }

    /**
     * Scope для услуг по цене
     */
    public function scopePriceBetween(Builder $query, float $minPrice, float $maxPrice): Builder
    {
        return $query->whereBetween('price', [$minPrice, $maxPrice]);
    }

    /**
     * Scope для поиска по названию
     */
    public function scopeSearch(Builder $query, string $search): Builder
    {
        return $query->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
    }

    /**
     * Получить отформатированную длительность
     */
    public function getFormattedDurationAttribute(): string
    {
        return Minutes::getFormatted($this->duration);
    }

    /**
     * Получить отформатированную цену
     */
    public function getFormattedPriceAttribute(): string
    {
        return Money::getFormatted($this->price);
    }

    /**
     * Активность
     */
    public function isAvailable(): bool
    {
        return $this->is_active;
    }

    protected static function newFactory()
    {
        return new ServiceFactory();
    }
}