<?php

namespace Drupal\siteapi\Controller;

use Drupal\node\NodeInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Drupal\Core\Access\AccessResult;

/**
 * Defines the SiteApi controller.
 */
class SiteApiController
{

  /**
   * Checks access for this controller.
   */
  public function access($siteapikey, NodeInterface $node)
  {
    // Node is exist or not is handled by the routing file
    // Allow only if the site api key matches
    if ($siteapikey == \Drupal::config('system.site')->get('siteapikey')) {

      //Allow only if bundle type is page
      if ($node->getType() == 'page') {
        return AccessResult::allowed();
      }
    }

    // Return 403 Access Denied page.
    return AccessResult::forbidden();
  }

  /**
   * Returns content for this controller.
   */
  public function pageJson($siteapikey, NodeInterface $node)
  {
    // Json Response of node object
    return new JsonResponse($node->toArray());
  }
}
