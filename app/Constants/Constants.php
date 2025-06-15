<?php

namespace App\Constants;

class Constants
{
    public const NOT_DELETED = 0;
    public const DELETED = 10;
    public const RAW_IMG = 5120;
    public const MAX_IMG = 2560;
    public const MIN_IMG = 400;
    public const NOT_PUBLISHED = 0;
    public const TEST_PUBLISHED = 1;
    public const PUBLISHED = 2;
    public const PUBLISHED_STATES = [self::TEST_PUBLISHED, self::PUBLISHED];
    public const NUMBER_FOOTER_ARTICLES = 3;
}
