<?php
    /**
     * Created by PhpStorm.
     * User: SST5
     * Date: 7/2/2019
     * Time: 12:55 PM
     */

    namespace App\Traits;


    use Illuminate\Support\Arr;

    trait ApiResourceTrait
    {
        /**
         * Get the pagination links for the response.
         *
         * @param  array  $paginated
         * @return array
         */
        protected function paginationLinks($paginated)
        {
            return [
                'first' => $paginated['first_page_url'] ?? null,
                'last' => $paginated['last_page_url'] ?? null,
                'prev' => $paginated['prev_page_url'] ?? null,
                'next' => $paginated['next_page_url'] ?? null,
            ];
        }

        protected function meta($paginated)
        {
            return Arr::except($paginated, [
                'data',
                'first_page_url',
                'last_page_url',
                'prev_page_url',
                'next_page_url',
            ]);
        }
    }
