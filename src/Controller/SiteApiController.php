<?php
namespace Drupal\siteapi\Controller;
use Drupal\node\NodeInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Drupal\Core\Access\AccessResult;

/**
 * Defines the SiteInfo controller.
 */
class SiteApiController {
 
  /**
   * Checks access for this controller.
   */
  public function access($siteapikey, NodeInterface $node) {
    if ($siteapikey == \Drupal::config('system.site')->get('siteapikey')) {
        
      if ($node->getType() == 'page') {
        return AccessResult::allowed();
      }
    }

    return AccessResult::forbidden();
  }
  
  /**
   * Returns content for this controller.
   */
  public function pageJson($siteapikey, NodeInterface $node) {
    return new JsonResponse($node->toArray());
  }
}