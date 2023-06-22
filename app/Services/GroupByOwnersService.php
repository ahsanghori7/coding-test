<?php

namespace App\Services;

class GroupByOwnersService
{
    public function groupByOwners(array $files): array
    {
        $result = [];

        foreach ($files as $file => $owner) {
            if (!isset($result[$owner])) {
                $result[$owner] = [];
            }
            $result[$owner][] = $file;
        }

        return $result;
    }
}