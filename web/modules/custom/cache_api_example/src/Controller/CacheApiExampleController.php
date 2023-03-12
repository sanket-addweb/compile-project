<?php

namespace Drupal\cache_api_example\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Returns responses for cache_api_example routes.
 */
class CacheApiExampleController extends ControllerBase {

  /**
   * Builds the response.
   */
  public function build() {

    // if ($cache = \Drupal::cache()->get('values:node:3')) {
    //   $data = $cache->data;
    //   dump($data);
    //   exit;
    // }
    // $default_config = \Drupal::config('hello_world.settings');//Change file to cache_api_example.hello_word.yml
    // $default_config = \Drupal::config('cache_api_example.hello_word.yml');
    $build['content'] = [
      '#type' => 'item',
      '#markup' => $this->t('It works!'),
      // '#markup' => $this->t('It works!'). $default_config->get('hello.name'),//works
      //Because in hello_world.settings.yml 
      //hello:
      //name: 'Mohit'
    ];

    return $build;
  }

  //  /**
  //  * {@inheritdoc}
  //  */
  // public function defaultConfiguration() {
  //   $default_config = \Drupal::config('hello_world.settings');
  //   return [
  //     'hello_block_name' => $default_config->get('hello.name'),
  //     //Because in hello_world.settings.yml 
  //     //hello:
  //     //name: 'Mohit'
  //   ];
  // }

}
