<?php

namespace App\Constants;

use PhpParser\Node\Expr\List_;

class Status 
{
    public const DRAFT = 'draft';
    public const PUBLISHED = 'published';

    public const LIST = [
        self::DRAFT,
        self::PUBLISHED
    ];
}