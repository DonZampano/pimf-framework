<?php
class xUser
{
  public $name = 'public-conan';
  public $fruits = array('public-banana');
  protected $email = 'protected-fff@cool.de';
  private $bday = 'private-12-12-3333';
  public function getName() { return $this->name; }
}

class xEnum
{
  const January = 1;
  const February = 2;
}

class PropertyValueTest extends PHPUnit_Framework_TestCase
{
  public static function ensureBooleanProvider()
  {
    return array(
      array('', false),
      array(' ', false),
      array(1, true),
      array('1', true),
      array(0, false),
      array('0', false),
      array(array(), false),
      array(array(1), false),
      array(new \stdClass(), false),
      array('true', true),
      array('false', false),
      array('yes', true),
      array('no', false),
    );
  }

  /**
   * @param $value
   * @param $expected
   * @dataProvider ensureBooleanProvider
   */
  public function testEnsureBoolean($value, $expected)
  {
    $this->assertSame($expected, \Pimf\Util\Value::ensureBoolean($value));
  }

  public static function ensureArrayProvider()
  {
    return array(
      array('', array()),
      array(' ', array()),
      array(1, array(1)),
      array(1234, array(1234)),
      array(1234.1234, array(1234.1234)),
      array('1', array('1')),
      array(true, array(true)),
      array(false, array(false)),
      array('[1,2,3]', array('1','2','3')),
      array(new \stdClass(), array()),
      array(new \xUser(), array('name' => 'public-conan', 'fruits' => array('public-banana'))),
    );
  }

  /**
   * @param $value
   * @param $expected
   * @dataProvider ensureArrayProvider
   */
  public function testEnsureArray($value, $expected)
  {
    $this->assertSame($expected, \Pimf\Util\Value::ensureArray($value));
  }

  public function testEnsureEnum()
  {
    $this->assertSame(1, \Pimf\Util\Value::ensureEnum('January', 'xEnum'));
  }

  public function testEnsureEnumNameByValue()
  {
    $this->assertSame('January', \Pimf\Util\Value::ensureEnum(1, 'xEnum', false));
  }

  /**
   * @expectedException InvalidArgumentException
   */
  public function testEnsureEnumThrowingException()
  {
    \Pimf\Util\Value::ensureEnum('March', 'xEnum');
  }
}
