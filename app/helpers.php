<?php

if (! function_exists('format_price')) {
    /**
     * Format a numeric amount for storefront display in Pakistani Rupees.
     *
     * This is display formatting only — it does not convert or alter the
     * underlying stored value, which remains a plain decimal in the database.
     */
    function format_price(float|string|null $amount): string
    {
        return 'Rs. '.number_format((float) $amount, 2);
    }
}
