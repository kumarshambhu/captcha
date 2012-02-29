<?php
/**
 * Axis
 *
 * This file is part of Axis.
 *
 * Axis is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Axis is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Axis.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @category    Axis
 * @package     Example_Captcha
 * @subpackage  Example_Captcha_Model
 * @copyright   Copyright 2008-2012 Axis
 * @license     GNU Public License V3.0
 */

/**
 *
 * @category    Axis
 * @package     Example_Captcha
 * @subpackage  Example_Captcha_Model
 * @author      Axis Core Team <core@axiscommerce.com>
 */
class Example_Captcha_Model_Observer
{
    public function addCaptcha(Axis_Form $form)
    {
        $captcha = new Zend_Form_Element_Captcha('captcha', array(
            'required' => true,
            // 'label'    => 'Fill the captcha please',
            'class'    => 'input-text required',
            'captcha'  => array(
//                'captcha' => 'Figlet',
                'captcha' => 'Image',
                'wordLen' => 6,
                'timeout' => 300,
                'width'   => 200,
                'height'  => 60,
                'imgUrl'  => Axis::getSite()->base . '/media/captcha/',
                'imgDir'  => Axis::config('system/path') . '/media/captcha/',
                'font'    => Axis::config('system/path') . '/media/fonts/arial.ttf'
            )
        ));

        $captcha->removeDecorator('HtmlTag')
            ->removeDecorator('Label')
            ->addDecorator('Description', array('tag' => 'small', 'class' => 'description'))
//            ->addDecorator('Label', array(
//                'tag' => 'div',
//                'placement' => 'prepend'
//            ))
            ->addDecorator('HtmlTag', array(
                'tag'   => 'li',
                'id'    => "captcha-row",
                'class' => 'element-row'
            ));

        $form->addElement($captcha);
        $form->addDisplayGroup(
            array($captcha),
            'captchagroup',
            array('legend' => 'Fill the captcha please')
        );
    }
}
