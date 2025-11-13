<?php
/**
 * WHMCS Server Module - Hetzner VPS Hooks
 *
 * @package     WHMCS
 * @version     1.2.1
 * @copyright   Copyright (c) ArkHost 2025
 * @author      ArkHost <support@arkhost.com>
 * @link        https://arkhost.com
 */

use WHMCS\Database\Capsule;

/**
 * Hide default WHMCS product details and cog icons for ArkHostHetznerVPS products
 * Injects CSS early to prevent flash of content
 */
add_hook('ClientAreaHeadOutput', 1, function($vars) {
    // Only run on product details page
    if (!isset($_GET['action']) || $_GET['action'] !== 'productdetails') {
        return '';
    }

    // Get the service ID from the request
    $serviceId = isset($_GET['id']) ? (int) $_GET['id'] : 0;
    if (!$serviceId) {
        return '';
    }

    // Check if this service uses the ArkHostHetznerVPS module
    try {
        $service = Capsule::table('tblhosting')
            ->where('id', $serviceId)
            ->first();

        if (!$service || $service->servertype !== 'ArkHostHetznerVPS') {
            return '';
        }
    } catch (Exception $e) {
        return '';
    }

    // Inject CSS early in the HEAD to prevent flash
    // This works for both active and suspended services
    return <<<HTML
<style>
    /* Hide WHMCS default product details (Domain, Username, Server Name, IP, Visit Website) for ArkHostHetznerVPS */
    #domain > .row:nth-child(2),
    #domain > .row:nth-child(3),
    #domain > .row:nth-child(4) {
        display: none !important;
    }
    #domain > br {
        display: none !important;
    }
    #domain > p {
        display: none !important;
    }

    /* Hide cog icons from custom action buttons IMMEDIATELY */
    .list-group-item[href*="modop=custom"] i.fa-cog,
    .list-group-item[href*="modop=custom"] i.fas.fa-cog,
    .list-group-item[href*="modop=custom"] .fa-cog,
    .list-group-item[href*="modop=custom"] i.fa-wrench,
    a[href*="modop=custom"] i.fa-cog,
    a[href*="modop=custom"] i.fas.fa-cog,
    a[href*="modop=custom"] .fa-cog {
        display: none !important;
    }
</style>
HTML;
});

