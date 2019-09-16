<?php

namespace Drupal\sfc_demo\Plugin\SingleFileComponent;

use Drupal\sfc\ComponentBase;

/**
 * A stacked layout.
 *
 * @SingleFileComponent(
 *   id = "sfc_demo_stacked",
 *   group = "SFC Demo",
 *   layout = {
 *     "label" = "Stacked",
 *     "category" = "SFC Demo",
 *     "regions" = {
 *       "top" = {"label" = "Top"},
 *       "left" = {"label" = "Left"},
 *       "right" = {"label" = "Right"},
 *     },
 *     "icon_map" = {{"top"},{"left", "right"}},
 *   }
 * )
 */
class Stacked extends ComponentBase {

  const TEMPLATE = <<<TWIG
<div {{ attributes.addClass('sfc-demo-stacked') }}>
  <div {{ region_attributes.top.addClass('top') }}>
    {{ content.top }}
  </div>
  <div class="bottom">
    <div {{ region_attributes.left.addClass('left') }}>
      {{ content.left }}
    </div>
    <div {{ region_attributes.right.addClass('right') }}>
      {{ content.right }}
    </div>
  </div>
</div>
TWIG;

  const CSS = <<<CSS
.sfc-demo-stacked .top {
  width: 100%;
  margin-bottom: 15px;
}
.sfc-demo-stacked .bottom {
  display: flex;
  justify-content: space-between;
  align-items: center;
}
CSS;

}
