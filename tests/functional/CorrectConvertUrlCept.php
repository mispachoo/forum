<?php
/**
 * Test for https://github.com/phalcon/forum/issues/85 issue
 *
 * @var \Codeception\Scenario $scenario
 */

$I = new Step\Functional\UserSteps($scenario);

$I->wantTo('use underscored character in content and see correct url');

$userId = $I->amRegularUser();

$catId = $I->haveCategory([
    'name' => 'Installation',
    'slug' => 'installation',
    'description' => 'Installation related posts'
]);

$postId = $I->havePost([
    'title' => 'Is there a precompiled binary for 64 bit Centos out there',
    'content' => '[this reddit topic](http://www.reddit.com/r/PHP/comments/2s7bbr/phalconphp_vs_php_disappointing_results/)',
    'users_id' => 1,
    'slug' => 'is-there-a-precompiled-binary-for-64-bit-centos-out-there',
    'categories_id' => $catId
]);


$I->amOnPage('/discussions');
$I->seeInTitle('Discussions - Phalcon Framework');
$I->seeLink('Is there a precompiled binary for 64 bit Centos out there');
$I->click('Is there a precompiled binary for 64 bit Centos out there');
$I->seeInCurrentUrl(sprintf('/discussion/%s/is-there-a-precompiled-binary-for-64-bit-centos-out-there', $postId));
$I->seeLink('this reddit topic', 'http://www.reddit.com/r/PHP/comments/2s7bbr/phalconphp%5vs%5php%5disappointing%5results/');
