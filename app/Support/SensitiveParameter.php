<?php

if (!class_exists('SensitiveParameter')) {
    #[Attribute(Attribute::TARGET_PARAMETER)]
    class SensitiveParameter
    {
        public function __construct()
        {
            // Dummy class for PHP < 8.2
        }
    }
}
