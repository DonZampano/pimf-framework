<?php
/**
 * View
 *
 * PHP Version 5
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.
 * It is also available through the world-wide-web at this URL:
 * http://krsteski.de/new-bsd-license/
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to gjero@krsteski.de so we can send you a copy immediately.
 *
 * @copyright Copyright (c)  Gjero Krsteski (http://krsteski.de)
 * @license http://krsteski.de/new-bsd-license New BSD License
 */

namespace Pimf\View;
use Pimf\View, Pimf\Util\Json as UtilJson, Pimf\Util\Header;

/**
 * A view for smooth JSON communication.
 *
 * @link http://twig.sensiolabs.org/documentation
 * @package View
 * @author Gjero Krsteski <gjero@krsteski.de>
 */
class Json extends View
{
  /**
   * @param array $data
   */
  public function __construct(array $data = array())
  {
    parent::__construct('', $data);
  }

  /**
   * @return string|void
   */
  public function render()
  {
    Header::contentTypeJson();

    die(UtilJson::encode($this->data->getArrayCopy()));
  }
}