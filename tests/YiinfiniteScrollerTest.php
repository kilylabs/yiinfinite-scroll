<?php
require_once __DIR__.'/../YiinfiniteScroller.php';

class YiinfiniteScrollerTest extends PHPUnit_Framework_TestCase
{

    public function testCurrentPageExistsIfLessThanPageCount()
    {
        $mock = $this->getMock('YiinfiniteScroller', ['getPageCount', 'getCurrentPage']);
        $mock->expects($this->any())
             ->method('getPageCount')
             ->willReturn(1);
        $mock->expects($this->any())
            ->method('getCurrentPage')
            ->willReturn(0);

        $this->assertFalse($mock->currentPageDoesntExists());
    }

    public function testCurrentPageDoesntExistsIfEqualsPageCount()
    {
        $mock = $this->getMock('YiinfiniteScroller', ['getPageCount', 'getCurrentPage']);
        $mock->expects($this->any())
             ->method('getPageCount')
             ->willReturn(3);
        $mock->expects($this->any())
             ->method('getCurrentPage')
             ->willReturn(3);

        $this->assertTrue($mock->currentPageDoesntExists());
    }

    public function testCurrentPageDoesntExistsIfMoreThanPageCount()
    {
        $mock = $this->getMock('YiinfiniteScroller', ['getPageCount', 'getCurrentPage']);
        $mock->expects($this->any())
             ->method('getPageCount')
             ->willReturn(2);
        $mock->expects($this->any())
             ->method('getCurrentPage')
             ->willReturn(3);

        $this->assertTrue($mock->currentPageDoesntExists());
    }

    /**
     * @expectedException CHttpException
     */
    public function testItThrowsPageNotFoundIfCurrentPageDoesntExists()
    {
        $mock = $this->getMock('YiinfiniteScroller', ['getPageCount', 'getCurrentPage']);
        $mock->expects($this->any())
             ->method('getPageCount')
             ->willReturn(0);
        $mock->expects($this->any())
             ->method('getCurrentPage')
             ->willReturn(1);

        $mock->run();
    }

}

/**
 * Mock empty class to replace the Yii's CBasePager
 */
class CBasePager {}

/**
 * Mock empty class to replace the Yii's CHttpException
 */
class CHttpException extends \Exception {}