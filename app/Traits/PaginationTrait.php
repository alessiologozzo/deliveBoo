<?php
namespace App\Traits;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;

use Illuminate\Pagination\LengthAwarePaginator;
trait PaginationTrait {
    public function paginate($items, $path = "/",  $perPage = 10)
    {
        $page = null;
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $total = count($items);
        $currentpage = $page;
        $offset = ($currentpage * $perPage) - $perPage ;
        $itemstoshow = array_slice($items, $offset, $perPage);
        $result = new LengthAwarePaginator($itemstoshow , $total, $perPage);
        $result->setPath($path);

        return $result;
    }
}