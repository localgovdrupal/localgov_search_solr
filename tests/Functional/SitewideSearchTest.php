<?php

namespace Drupal\Tests\localgov_search_solr\Functional;

use Drupal\search_api\Entity\Index;
use Drupal\search_api\Entity\Server;
use Drupal\search_api_solr\Utility\SolrCommitTrait;
use Drupal\Tests\localgov_search\Functional\SitewideSearchBase;

/**
 * Test search to check sitewide search integration.
 *
 * @group localgov_search
 */
class SitewideSearchTest extends SitewideSearchBase {

  use SolrCommitTrait;

  /**
   * Modules to enable.
   *
   * @var array
   */
  protected static $modules = [
    'localgov_search',
    'localgov_search_solr',
  ];

  /**
   * {@inheritdoc}
   */
  public function setUp(): void {
    parent::setUp();

    $server = Server::load('localgov_sitewide_solr');
    if (!$server->isAvailable()) {
      $this->markTestSkipped('No solr server available for test to run');
    }
  }

  /**
   * {@inheritdoc}
   */
  protected function tearDown(): void {
    $index = Index::load('localgov_sitewide_search');
    $index->clear();
    $this->ensureCommit($index);

    parent::tearDown();
  }

}
