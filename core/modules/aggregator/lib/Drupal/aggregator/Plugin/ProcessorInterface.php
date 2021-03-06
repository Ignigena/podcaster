<?php

/**
 * @file
 * Contains \Drupal\aggregator\Plugin\ProcessorInterface.
 */

namespace Drupal\aggregator\Plugin;

use Drupal\aggregator\Entity\Feed;

/**
 * Defines an interface for aggregator processor implementations.
 *
 * A processor acts on parsed feed data. Active processors are called at the
 * third and last of the aggregation stages: first, data is downloaded by the
 * active fetcher; second, it is converted to a common format by the active
 * parser; and finally, it is passed to all active processors that manipulate or
 * store the data.
 */
interface ProcessorInterface {

  /**
   * Processes feed data.
   *
   * @param \Drupal\aggregator\Entity\Feed $feed
   *   A feed object representing the resource to be processed.
   *   $feed->items contains an array of feed items downloaded and parsed at the
   *   parsing stage. See \Drupal\aggregator\Plugin\FetcherInterface::parse()
   *   for the basic format of a single item in the $feed->items array.
   *   For the exact format refer to the particular parser in use.
   *
   */
  public function process(Feed $feed);

  /**
   * Refreshes feed information.
   *
   * Called after the processing of the feed is completed by all selected
   * processors.
   *
   * @param \Drupal\aggregator\Entity\Feed $feed
   *   Object describing feed.
   *
   * @see aggregator_refresh()
   */
  public function postProcess(Feed $feed);

  /**
   * Removes stored feed data.
   *
   * Called by aggregator if either a feed is deleted or a user clicks on
   * "remove items".
   *
   * @param \Drupal\aggregator\Entity\Feed $feed
   *   The $feed object whose items are being removed.
   *
   */
  public function remove(Feed $feed);

}
