<?php

namespace Bitter\SimpleButtons\Buttons;

use HtmlObject\Element;

class Builder
{
    /**
     * @param array|Button[]|$buttons $buttons
     * @return string
     */
    public function render(array|Button $buttons): string
    {
        $html = "";

        if (!is_array($buttons)) {
            $buttons = [$buttons];
        }

        if (count($buttons) > 1) {
            $div = (new Element("div"))->addClass("input-group");

            foreach ($buttons as $button) {
                if ($button instanceof Button) {
                    $div->appendChild($button->getTag());
                }
            }

            $html = $div->render();
        } else {
            $button = array_pop($buttons);

            if ($button instanceof Button) {
                $html = $button->getTag()->render();
            }
        }

        return $html;
    }
}