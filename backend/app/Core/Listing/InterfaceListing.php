<?php

namespace App\Core\Listing;

interface InterfaceListing
{
    public function availableColumns();
    public function buildQuery();
}
