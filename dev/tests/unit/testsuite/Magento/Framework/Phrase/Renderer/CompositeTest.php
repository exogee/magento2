<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\Framework\Phrase\Renderer;

class CompositeTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Composite
     */
    protected $object;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    protected $rendererOne;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    protected $rendererTwo;

    protected function setUp()
    {
        $this->rendererOne = $this->getMock('Magento\Framework\Phrase\RendererInterface');
        $this->rendererTwo = $this->getMock('Magento\Framework\Phrase\RendererInterface');
        $this->object = new \Magento\Framework\Phrase\Renderer\Composite([$this->rendererOne, $this->rendererTwo]);
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Instance of the phrase renderer is expected, got stdClass instead
     */
    public function testConstructorException()
    {
        new \Magento\Framework\Phrase\Renderer\Composite([new \stdClass()]);
    }

    public function testRender()
    {
        $text = 'some text';
        $arguments = ['arg1', 'arg2'];
        $resultAfterFirst = 'rendered text first';
        $resultAfterSecond = 'rendered text second';

        $this->rendererOne->expects(
            $this->once()
        )->method(
                'render'
            )->with(
                [$text],
                $arguments
            )->will(
                $this->returnValue($resultAfterFirst)
            );

        $this->rendererTwo->expects(
            $this->once()
        )->method(
                'render'
            )->with(
                [
                    $text,
                    $resultAfterFirst,
                ],
                $arguments
            )->will(
                $this->returnValue($resultAfterSecond)
            );

        $this->assertEquals($resultAfterSecond, $this->object->render([$text], $arguments));
    }
}
