<?php

namespace Drupal\cache_api_example\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides an example block.
 *
 * @Block(
 *   id = "cache_api_example_example",
 *   admin_label = @Translation("Example number"),
 *   category = @Translation("cache_api_example")
 * )
 */
class ExampleBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $number = rand(10,1000);
    $data = NULL;
    // if ($cache = \Drupal::cache()->get($cid)) {
    if ($cache = \Drupal::cache()->get('values:node:3')) {
      $data = $cache->data;
      dump($data);
      exit;
    }
    $build['content'] = [
      '#markup' => $this->t("It works and $number!"),
      '#cache' => [
        'tags' => [
          // 'node:3',
          'node:34',
          // 'node_list',//rendom number chage every time of editing any node
          // 'user_list',//By edit user details and save and view on site rendom number change
          // 'user:13',
        ],//While editing and save node 34, random number change. But refreshing or url change it will remain same
        'contexts' => [
          // 'url',
          // 'route',
          // 'user.permission',
        ],
        // 'max-age' => 10,//every 10 second If you are refreshing page you can see the change in random number
      ],
    ];
    return $build;
  }

}
