<?php

namespace frontend\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class Menu extends Model
{
    public static function getMainMenu($menuItems)
    {
        $html = '';

        if (isset($menuItems) && count($menuItems))
        {
            $html .= '
            <ul id="navigation" class="menu">';
            foreach ($menuItems as $menuItem)
            {
                $html .= '
                <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children">
                    <a href="'.$menuItem['url'].'" data-title="'.$menuItem['label'].'">'.$menuItem['label'].'</a>';
                    if (isset($menuItem['submenu']) && count($menuItem['submenu']))
                    {
                        $html .= '
                        <ul class="sub-menu">';
                        foreach ($menuItem['submenu'] as $smItem)
                        {
                            $html .= '
                            <li class="menu-item menu-item-type-post_type menu-item-object-page">
                                <a href="'.$smItem['url'].'" data-title="'.$smItem['label'].'">'.$smItem['label'].'</a>
                            </li>';
                        }
                        $html .= '
                        </ul>';
                    }
                $html .= '
                </il>';
            }
            $html .= '
            </ul>';
        } 
        return $html;
    }
}
