<?php

namespace Drupal\customer_module\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\purge\Plugin\Purge\Purger\Exception\CapacityException;
use Drupal\purge\Plugin\Purge\Purger\Exception\DiagnosticsException;
use Drupal\purge\Plugin\Purge\Purger\Exception\LockException;

/**
 * Provides an example block.
 *
 * @Block(
 *   id = "purge_block_cache",
 *   admin_label = @Translation("Purge cache api"),
 *   category = @Translation("purge_block_cache")
 * )
 */



class purgeBlockCache extends BlockBase {

	/**
	 * {@inheritdoc}
	 */
	public function build() {
		return [
			'#markup' => "This is example block"
		];
  //   $purgeInvalidationFactory = \Drupal::service('purge.invalidation.factory');
  //   $purgeProcessors = \Drupal::service('purge.processors');
  //   $purgePurgers = \Drupal::service('purge.purgers');

  //   $processor = $purgeProcessors->get('myprocessor');
  //   $invalidations = [
	// 		$purgeInvalidationFactory->get('tag', 'node:1'),
	// 		$purgeInvalidationFactory->get('tag', 'node:2'),
	// 		$purgeInvalidationFactory->get('path', 'contact'),
	// 		$purgeInvalidationFactory->get('wildcardpath', 'news/*'),
	// 	];

	// 	// try {
	// 	// 	$purgePurgers->invalidate($processor, $invalidations);
	// 	// }
	// 	// catch (DiagnosticsException $e) {
	// 	// 	// Diagnostic exceptions happen when the system cannot purge.
	// 	// 	echo "error";
	// 	// }
	// 	// catch (CapacityException $e) {
	// 	// 	// Capacity exceptions happen when too much was purged during this request.
	// 	// 	echo "error";
	// 	// }
	// 	// catch (LockException $e) {
	// 	// 	// Lock exceptions happen when another code path is currently processing.
	// 	// 	echo "error";
	// 	// }

	// 	foreach ($invalidations as $invalidation) {
	// 		var_dump($invalidation->getStateString());
	// 	}

	}

	
}
?>