<?php

namespace Bitter\SimpleButtons\Buttons;

use Bitter\SimpleButtons\Buttons\Enumerations\ButtonSize;
use Bitter\SimpleButtons\Buttons\Enumerations\ButtonStyle;
use Bitter\SimpleButtons\Buttons\Enumerations\IconPosition;
use Bitter\SimpleButtons\Buttons\Enumerations\Relationship;
use Bitter\SimpleButtons\Buttons\Enumerations\Target;
use Concrete\Core\Foundation\ConcreteObject;
use Concrete\Core\Html\Service\FontAwesomeIcon;
use Concrete\Core\Site\Service;
use Concrete\Core\Support\Facade\Application;
use HtmlObject\Element;

class Button extends ConcreteObject
{
    protected ?string $label = null;
    protected ?string $title = null;
    protected ?string $icon = null;
    protected array $relationships = [];
    protected ?string $target = null;
    protected ?string $href = null;
    protected ?string $buttonStyle = null;
    protected ?string $size = null;
    protected ?string $iconPosition = null;
    protected bool $openLinkInNewWindow = false;
    protected bool $isDisabled = false;
    protected bool $outline = false;
    protected bool $applyOptions = true;

    /**
     * @return string|null
     */
    public function getLabel(): ?string
    {
        return $this->label;
    }

    /**
     * @param string|null $label
     * @return Button
     */
    public function setLabel(?string $label): Button
    {
        $this->label = $label;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string|null $title
     * @return Button
     */
    public function setTitle(?string $title): Button
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return array
     */
    public function getRelationships(): array
    {
        return $this->relationships;
    }

    /**
     * @param array $relationships
     * @return Button
     */
    public function setRelationships(array $relationships): Button
    {
        $allowedValues = [
            Relationship::RELATIONSHIP_ALTERNATE,
            Relationship::RELATIONSHIP_AUTHOR,
            Relationship::RELATIONSHIP_BOOKMARK,
            Relationship::RELATIONSHIP_EXTERNAL,
            Relationship::RELATIONSHIP_HELP,
            Relationship::RELATIONSHIP_LICENSE,
            Relationship::RELATIONSHIP_NEXT,
            Relationship::RELATIONSHIP_NOFOLLOW,
            Relationship::RELATIONSHIP_NOREFERRER,
            Relationship::RELATIONSHIP_NOOPENER,
            Relationship::RELATIONSHIP_PREV,
            Relationship::RELATIONSHIP_SEARCH,
            Relationship::RELATIONSHIP_TAG
        ];

        $this->relationships = [];

        foreach ($relationships as $relationship) {
            if (in_array($relationship, $allowedValues)) {
                $this->relationships[] = $relationship;
            }
        }

        return $this;
    }

    /**
     * @return string|null
     */
    public function getTarget(): ?string
    {
        return $this->target;
    }

    /**
     * @param string|null $target
     * @return Button
     */
    public function setTarget(?string $target): Button
    {
        $allowedValues = [
            Target::TARGET_BLANK,
            Target::TARGET_PARENT,
            Target::TARGET_SELF,
            Target::TARGET_TOP
        ];

        if (in_array($target, $allowedValues) || $target === null) {
            $this->target = $target;
        }

        return $this;
    }

    /**
     * @return string|null
     */
    public function getButtonStyle(): ?string
    {
        return $this->buttonStyle;
    }

    /**
     * @param string|null $buttonStyle
     * @return Button
     */
    public function setButtonStyle(?string $buttonStyle): Button
    {
        $allowedValues = [
            ButtonStyle::BUTTON_STYLE_PRIMARY,
            ButtonStyle::BUTTON_STYLE_SECONDARY
        ];

        if (in_array($buttonStyle, $allowedValues) || $buttonStyle === null) {
            $this->buttonStyle = $buttonStyle;
        }

        return $this;
    }

    /**
     * @return bool
     */
    public function isOpenLinkInNewWindow(): bool
    {
        return $this->openLinkInNewWindow;
    }

    /**
     * @param bool $openLinkInNewWindow
     * @return Button
     */
    public function setOpenLinkInNewWindow(bool $openLinkInNewWindow): Button
    {
        $this->openLinkInNewWindow = $openLinkInNewWindow;
        return $this;
    }

    /**
     * @return bool
     */
    public function isDisabled(): bool
    {
        return $this->isDisabled;
    }

    /**
     * @param bool $isDisabled
     * @return Button
     */
    public function setIsDisabled(bool $isDisabled): Button
    {
        $this->isDisabled = $isDisabled;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getHref(): ?string
    {
        return $this->href;
    }

    /**
     * @param string|null $href
     * @return Button
     */
    public function setHref(?string $href): Button
    {
        $this->href = $href;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getIcon(): ?string
    {
        return $this->icon;
    }

    /**
     * @param string|null $icon
     * @return Button
     */
    public function setIcon(?string $icon): Button
    {
        $this->icon = $icon;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getSize(): ?string
    {
        return $this->size;
    }

    /**
     * @param string|null $size
     * @return Button
     */
    public function setSize(?string $size): Button
    {
        $allowedValues = [
            ButtonSize::BUTTON_SIZE_SMALL,
            ButtonSize::BUTTON_SIZE_REGULAR,
            ButtonSize::BUTTON_SIZE_LARGE
        ];

        if (in_array($size, $allowedValues) || $size === null) {
            $this->size = $size;
        }

        return $this;
    }

    /**
     * @return bool
     */
    public function isOutline(): bool
    {
        return $this->outline;
    }

    /**
     * @param bool $outline
     * @return Button
     */
    public function setOutline(bool $outline): Button
    {
        $this->outline = $outline;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getIconPosition(): ?string
    {
        return $this->iconPosition;
    }

    /**
     * @param string|null $iconPosition
     * @return Button
     */
    public function setIconPosition(?string $iconPosition): Button
    {
        $allowedValues = [
            IconPosition::ICON_POSITION_LEFT,
            IconPosition::ICON_POSITION_RIGHT
        ];

        if (in_array($iconPosition, $allowedValues) || $iconPosition === null) {
            $this->iconPosition = $iconPosition;
        }

        return $this;
    }

    /**
     * @return bool
     */
    public function isApplyOptions(): bool
    {
        return $this->applyOptions;
    }

    /**
     * @param bool $applyOptions
     * @return Button
     */
    public function setApplyOptions(bool $applyOptions): Button
    {
        $this->applyOptions = $applyOptions;
        return $this;
    }

    public function getTag(): Element
    {
        $element = new Element("a");

        if (!empty($this->getHref())) {
            $element->setAttribute("href", $this->getHref());
        }

        if (!empty($this->getRelationships())) {
            $element->setAttribute("rel", implode(" ", $this->getRelationships()));
        }

        if ($this->isOpenLinkInNewWindow() && !empty($this->getTarget())) {
            $element->setAttribute("target", $this->getTarget());
        }

        if (!empty($this->getTitle())) {
            $element->setAttribute("title", $this->getTitle());
        }

        if (!empty($this->getSize())) {
            switch ($this->getSize()) {
                case ButtonSize::BUTTON_SIZE_SMALL:
                    $element->addClass("btn-sm");
                    break;

                case ButtonSize::BUTTON_SIZE_LARGE:
                    $element->addClass("btn-lg");
                    break;
            }
        }

        if ($this->isDisabled()) {
            $element->addClass("disabled");
            $element->setAttribute("disabled", "disabled");
        }

        $element->addClass("btn");

        if ($this->getButtonStyle() === ButtonStyle::BUTTON_STYLE_PRIMARY) {
            if ($this->isOutline()) {
                $element->addClass("btn-outline-primary");
            } else {
                $element->addClass("btn-primary");
            }
        } else if ($this->getButtonStyle() === ButtonStyle::BUTTON_STYLE_SECONDARY) {
            if ($this->isOutline()) {
                $element->addClass("btn-outline-secondary");
            } else {
                $element->addClass("btn-secondary");
            }
        }

        $element->addClass("btn-processed-text");

        $labelHtml = "";

        for ($i = 0; $i <= mb_strlen($this->getLabel()); $i++) {
            $b = mb_substr($this->getLabel(), $i, 1);

            if ($b === " ") {
                $b = "&nbsp;";
            }

            $labelHtml .= "<span>$b</span>";
        }

        $labelHtml = "<div class='label'>$labelHtml</div>";
        
        if (!empty($this->getIcon())) {
            $iconHtml = FontAwesomeIcon::getFromClassNames(h($this->getIcon()))->getTag()->render();

            $element->addClass("btn-has-icon");

            if (!empty($this->getLabel())) {
                if ($this->getIconPosition() === IconPosition::ICON_POSITION_RIGHT) {
                    $element->setValue($labelHtml . " " . $iconHtml);
                    $element->addClass("btn-icon-right");
                } else {
                    $element->setValue($iconHtml . " " . $labelHtml);
                    $element->addClass("btn-icon-left");
                }
            } else {
                $element->setValue($iconHtml);
            }
        } else {
            if (!empty($this->getLabel())) {
                $element->setValue($labelHtml);
            }
        }
        
        // Apply options
        if ($this->isApplyOptions()) {
            $app = Application::getFacadeApplication();
            /** @var Service $siteService */
            /** @noinspection PhpUnhandledExceptionInspection */
            $siteService = $app->make(Service::class);
            $site = $siteService->getSite();
            $config = $site->getConfigRepository();

            $element->addClass($config->get("simple_buttons.styles.additional_classes"));
        }

        return $element;
    }

    public function __toString(): string
    {
        return $this->getTag()->render();
    }
}