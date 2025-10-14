<?php

namespace App\Models\Traits;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

trait ReportBy
{
    public function scopeSearchById(Builder $query, $value)
    {
        $query->where('id', $value);
    }
    public function scopeYear(Builder $query, $value)
    {
        $query->whereYear('created_at', $value);
    }

    public function scopeMonth(Builder $query, $value)
    {
        $query->whereMonth('created_at', $value);
    }
    public function scopeToday(Builder $query, $value)
    {

        $query->whereDate('created_at', Carbon::now()->format('Y-m-d'));
    }
    public function scopeCurrentMonth(Builder $query, $value)
    {
        $query->whereMonth('created_at', Carbon::now()->month);
    }
    public function scopeStatus(Builder $query, $value)
    {
        if ($value === "1") {
            $value = 1;
        }

        $query->where('status', $value);
    }
    public function scopeWeek(Builder $query, $value)
    {
        $query->whereBetween('created_at', [
            Carbon::now()->startOfWeek(),
            Carbon::now()->endOfWeek()
        ]);
    }

    public function scopeBetweenDates(Builder $query, $value)
    {

        $dates = str::of($value)->explode(',');
        $query->whereBetween(DB::raw('Date(created_at)'), [$dates[0], $dates[1]]);
    }

    public function scopeFridayToThursday(Builder $query)
    {
        $friday = new Carbon('last friday');
        $thursday = new Carbon('thursday');
        $query->whereBetween(DB::raw('Date(created_at)'), [$friday, $thursday]);
    }

    public function scopeTotal(Builder $query)
    {
        $query->select(DB::raw('sum(total) as total'));
    }

    public function scopeByWarehouses(Builder $query, $value)
    {
        $warehouses = str::of($value)->explode(',');
        if (count($warehouses)) {
            $query->whereIn('inventory_id', $warehouses);
        }
    }
    public function scopeSearchByIdAndCompletedStatus(Builder $query, $id)
    {
        $query->where('id', $id)
            ->where('status', 'completed');
    }
    public function scopeIsCredit(Builder $query, $value)
    {
        $query->where('is_credit', $value);
    }
    public function scopeGetNotesByStatus(Builder $query, $value)
    {
        $query->where('status', $value);
    }
}
