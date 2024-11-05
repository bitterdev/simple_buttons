<?php

namespace Bitter\SimpleButtons\Buttons\Enumerations;

abstract class LinkType
{
    const LINK_TYPE_INTERNAL_PAGE = 'page';
    const LINK_TYPE_INTERNAL_FILE = 'file';
    const LINK_TYPE_EXTERNAL_URL = 'url';
}