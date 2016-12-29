<?php

use frontend\helpers\SideMenuHelper;

/**
 * @var $menuItems array
 * @var $menuClasses string
 */
?>

<div class="side-menu <?= isset($menuClasses) ? $menuClasses : ''?>">
    <ul class="side-menu__items-list">
        <?php foreach ($menuItems as $item): ?>
            <?php
            //$t = SideMenuHelper::isItemActive($item);
            ?>
        <li class="side-menu__item">
            <a class="no-dec" <?= SideMenuHelper::getItemUrl($item) ? 'href=' . SideMenuHelper::getItemUrl($item) : '' ?>>
                <div class="side-menu__item-wrap icon-link <?=SideMenuHelper::isActiveItem($item) ? 'active' : '' ?>">
                    <?php if (isset($item['icon'])): ?>
                    <i class="material-icons"><?=$item['icon']?></i>
                    <?php endif; ?>
                    <p class="side-menu__item-text"><?=$item['label']?></p>
                </div>
            </a>

            <?php if (isset($item['items'])): ?>
                <ul class="side-menu__subitems-list <?=SideMenuHelper::hasActiveChild($item) ? 'open': ''?>">
                    <?php foreach ($item['items'] as $subItem): ?>
                        <li class="side-menu__item side-menu__subitem">
                            <a class="no-dec" <?= SideMenuHelper::getItemUrl($subItem) ? 'href=' . SideMenuHelper::getItemUrl($subItem) : '' ?>>
                                <div class="side-menu__item-wrap <?=SideMenuHelper::isActiveItem($subItem) ? 'active' : '' ?>">
                                    <p class="side-menu__item-text"><?=$subItem['label']?></p>
                                </div>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </li>
        <?php endforeach; ?>
    </ul>
</div>
