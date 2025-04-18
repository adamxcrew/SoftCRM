<?php

namespace App\Queries;

use App\Models\Company;
use App\Models\Setting;

/**
 * Class CompaniesQueries
 *
 * Query class for handling operations related to the CompaniesModel.
 */
class CompanyQueries
{
    /**
     * Get all companies.
     *
     * @return \Illuminate\Support\Collection|\Illuminate\Database\Eloquent\Collection
     */
    public static function getAll(): \Illuminate\Support\Collection|\Illuminate\Database\Eloquent\Collection
    {
        return Company::all()->sortBy('created_at');
    }

    /**
     * Get paginated list of companies.
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public static function getPaginate(): \Illuminate\Pagination\LengthAwarePaginator
    {
        return Company::orderByDesc('id')
            ->paginate(Setting::where('key', 'pagination_size')
                ->get()->last()->value);
    }

    /**
     * Get the count of all deactivated companies.
     *
     * @return int
     */
    public static function getDeactivated(): int
    {
        return Company::where('is_active', '=', 0)->count();
    }

    /**
     * Get companies sorted by creation date.
     *
     * @return \Illuminate\Support\Collection
     */
    public static function getCompaniesSortedByCreatedAt(): \Illuminate\Support\Collection
    {
        return Company::all()->sortBy('created_at', 0, true)->slice(0, 5);
    }

    /**
     * Get the count of all companies.
     *
     * @return int
     */
    public static function countAll(): int
    {
        return Company::all()->count();
    }

    /**
     * Get the count of all companies created in the latest month.
     *
     * @return int
     */
    public static function getCompaniesInLatestMonth(): int
    {
        return Company::where('created_at', '>=', now()->subMonth())->count();
    }
}
