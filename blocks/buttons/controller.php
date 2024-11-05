<?php /** @noinspection SqlNoDataSourceInspection */

/** @noinspection SqlDialectInspection */

namespace Concrete\Package\SimpleButtons\Block\Buttons;

use Bitter\SimpleButtons\Buttons\Button;
use Bitter\SimpleButtons\Buttons\Enumerations\ButtonSize;
use Bitter\SimpleButtons\Buttons\Enumerations\ButtonStyle;
use Bitter\SimpleButtons\Buttons\Enumerations\IconPosition;
use Bitter\SimpleButtons\Buttons\Enumerations\LinkType;
use Bitter\SimpleButtons\Buttons\Enumerations\Relationship;
use Bitter\SimpleButtons\Buttons\Enumerations\Target;
use Concrete\Core\Block\BlockController;
use Concrete\Core\Database\Connection\Connection;
use Concrete\Core\Entity\File\Version;
use Concrete\Core\Error\ErrorList\ErrorList;
use Concrete\Core\File\File;
use Concrete\Core\Page\Page;
use Concrete\Core\Support\Facade\Url;
use Concrete\Core\Entity\File\File as FileEntity;

class Controller extends BlockController
{
    protected $btTable = 'btButtons';
    protected $btInterfaceWidth = 400;
    protected $btInterfaceHeight = 500;
    protected $btCacheBlockOutputLifetime = 300;

    public function getBlockTypeDescription(): string
    {
        return t("Add buttons to your site.");
    }

    public function getBlockTypeName(): string
    {
        return t("Buttons");
    }

    protected function setDefaults()
    {
        $linkTypes = [
            LinkType::LINK_TYPE_INTERNAL_PAGE => t("Internal Page"),
            LinkType::LINK_TYPE_EXTERNAL_URL => t("External URL"),
            LinkType::LINK_TYPE_INTERNAL_FILE => t("File")
        ];

        $buttonStyles = [
            ButtonStyle::BUTTON_STYLE_PRIMARY => t("Primary"),
            ButtonStyle::BUTTON_STYLE_SECONDARY => t("Secondary")
        ];

        $relationships = [
            Relationship::RELATIONSHIP_ALTERNATE => t("Alternate"),
            Relationship::RELATIONSHIP_AUTHOR => t("Author"),
            Relationship::RELATIONSHIP_BOOKMARK => t("Bookmark"),
            Relationship::RELATIONSHIP_EXTERNAL => t("External"),
            Relationship::RELATIONSHIP_HELP => t("Help"),
            Relationship::RELATIONSHIP_LICENSE => t("License"),
            Relationship::RELATIONSHIP_NEXT => t("Next"),
            Relationship::RELATIONSHIP_NOFOLLOW => t("No Follow"),
            Relationship::RELATIONSHIP_NOREFERRER => t("No Referrer"),
            Relationship::RELATIONSHIP_NOOPENER => t("No Opener"),
            Relationship::RELATIONSHIP_PREV => t("Prev"),
            Relationship::RELATIONSHIP_SEARCH => t("Search"),
            Relationship::RELATIONSHIP_TAG => t("Tag")
        ];

        $targets = [
            Target::TARGET_SELF => t("Self"),
            Target::TARGET_PARENT => t("Parent"),
            Target::TARGET_BLANK => t("Blank"),
            Target::TARGET_TOP => t("Top")
        ];

        $buttonSizes = [
            ButtonSize::BUTTON_SIZE_SMALL => t("Small"),
            ButtonSize::BUTTON_SIZE_REGULAR => t("Regular"),
            ButtonSize::BUTTON_SIZE_LARGE => t("Large")
        ];

        $iconPositions = [
            IconPosition::ICON_POSITION_LEFT => t("Left"),
            IconPosition::ICON_POSITION_RIGHT => t("Right")
        ];

        $entries = [];
        /** @var Connection $db */
        /** @noinspection PhpUnhandledExceptionInspection */
        $db = $this->app->make(Connection::class);
        /** @noinspection PhpUnhandledExceptionInspection */
        foreach ($db->fetchAllAssociative("SELECT * FROM btButtonsEntry WHERE bID = ?", [$this->bID]) as $row) {
            $row["rel"] = explode(" ", $row["rel"]);
            $entries[] = $row;
        }

        $this->set("targets", $targets);
        $this->set("relationships", $relationships);
        $this->set("iconPositions", $iconPositions);
        $this->set("buttonStyles", $buttonStyles);
        $this->set("buttonSizes", $buttonSizes);
        $this->set("linkTypes", $linkTypes);
        $this->set("entries", $entries);
    }

    public function add()
    {
        $this->setDefaults();
    }

    public function edit()
    {
        $this->setDefaults();
    }

    public function view()
    {
        $buttons = [];

        /** @var Connection $db */
        /** @noinspection PhpUnhandledExceptionInspection */
        $db = $this->app->make(Connection::class);
        /** @noinspection PhpUnhandledExceptionInspection */
        foreach ($db->fetchAllAssociative("SELECT * FROM btButtonsEntry WHERE bID = ?", [$this->bID]) as $row) {
            $href = $row["externalLink"];

            if ($row["linkType"] === LinkType::LINK_TYPE_INTERNAL_PAGE) {
                $href = Url::to(Page::getByID($row["cID"]));
            } else if ($row["linkType"] === LinkType::LINK_TYPE_INTERNAL_FILE) {
                $f = File::getByID($row["fID"]);

                if ($f instanceof FileEntity) {
                    $fv = $f->getApprovedVersion();

                    if ($fv instanceof Version) {
                        $href = $fv->getURL();
                    }
                }

            }

            $buttons[] = (new Button())
                ->setTitle($row["title"])
                ->setLabel($row["label"])
                ->setButtonStyle($row["buttonStyle"])
                ->setIcon($row["icon"])
                ->setIconPosition($row["iconPosition"])
                ->setSize($row["size"])
                ->setRelationships(explode(" ", $row["rel"]))
                ->setIsDisabled(intval($row["disabled"]) === 1)
                ->setOutline(intval($row["outline"]) === 1)
                ->setOpenLinkInNewWindow(intval($row["openLinkInNewWindow"]) === 1)
                ->setHref($href)
                ->setTarget($row["target"]);
        }

        $this->set("buttons", $buttons);
    }

    public function duplicate($newBID)
    {
        parent::duplicate($newBID);

        /** @var Connection $db */
        /** @noinspection PhpUnhandledExceptionInspection */
        $db = $this->app->make(Connection::class);

        $copyFields = 'label, title, icon, iconPosition, size, outline, rel, buttonStyle, openLinkInNewWindow, disabled, target, linkType, externalLink, cID, fID';

        /** @noinspection PhpUnhandledExceptionInspection */
        /** @noinspection PhpDeprecationInspection */
        $db->executeUpdate("INSERT INTO btButtonsEntry (bID, $copyFields) SELECT ?, $copyFields FROM btButtonsEntry WHERE bID = ?", [
                $newBID,
                $this->bID
            ]
        );
    }

    public function delete()
    {
        /** @var Connection $db */
        /** @noinspection PhpUnhandledExceptionInspection */
        $db = $this->app->make(Connection::class);
        /** @noinspection PhpUnhandledExceptionInspection */
        $db->executeQuery("DELETE FROM btButtonsEntry WHERE bID = ?", [$this->bID]);

        parent::delete();
    }

    public function save($args)
    {
        parent::save($args);

        /** @var Connection $db */
        /** @noinspection PhpUnhandledExceptionInspection */
        $db = $this->app->make(Connection::class);
        /** @noinspection PhpUnhandledExceptionInspection */
        $db->executeQuery("DELETE FROM btButtonsEntry WHERE bID = ?", [$this->bID]);

        if (isset($args["entries"]) && is_array($args["entries"])) {
            foreach ($args["entries"] as $item) {
                /** @noinspection PhpUnhandledExceptionInspection */
                $db->executeQuery("INSERT INTO btButtonsEntry (bID, label, title, icon, iconPosition, size, outline, rel, buttonStyle, openLinkInNewWindow, disabled, target, linkType, externalLink, cID, fID) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)", [
                    $this->bID,
                    isset($item["label"]) && !empty($item["label"]) ? (string)$item["label"] : "",
                    isset($item["title"]) && !empty($item["title"]) ? (string)$item["title"] : "",
                    isset($item["icon"]) && !empty($item["icon"]) ? (string)$item["icon"] : "",
                    isset($item["iconPosition"]) && !empty($item["iconPosition"]) ? (string)$item["iconPosition"] : "",
                    isset($item["size"]) && !empty($item["size"]) ? (string)$item["size"] : "",
                    isset($item["outline"]) ? 1 : 0,
                    isset($item["rel"]) && !empty($item["rel"]) ? implode(" ", $item["rel"]) : "",
                    isset($item["buttonStyle"]) && !empty($item["buttonStyle"]) ? (string)$item["buttonStyle"] : "",
                    isset($item["openLinkInNewWindow"]) ? 1 : 0,
                    isset($item["disabled"]) ? 1 : 0,
                    isset($item["target"]) && !empty($item["target"]) ? (string)$item["target"] : "",
                    isset($item["linkType"]) && !empty($item["linkType"]) ? (string)$item["linkType"] : "",
                    isset($item["externalLink"]) && !empty($item["externalLink"]) ? (string)$item["externalLink"] : "",
                    isset($item["cID"]) && !empty($item["cID"]) ? (int)$item["cID"] : null,
                    isset($item["fID"]) && !empty($item["fID"]) ? (int)$item["fID"] : null
                ]);
            }
        }
    }

    public function validate($args): ErrorList
    {
        $e = new ErrorList;

        $allowedRelationships = [
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

        $allowedTargets = [
            Target::TARGET_BLANK,
            Target::TARGET_PARENT,
            Target::TARGET_SELF,
            Target::TARGET_TOP
        ];

        $allowedButtonStyles = [
            ButtonStyle::BUTTON_STYLE_PRIMARY,
            ButtonStyle::BUTTON_STYLE_SECONDARY
        ];

        if (!isset($args["entries"])) {
            $e->addError(t("You need to add at least one button."));
        }

        foreach ($args["entries"] as $entry) {
            if (empty($entry["label"])) {
                $e->addError(t("You need to enter a label."));
            }

            if (isset($entry["rel"]) && is_array($entry["rel"])) {
                foreach ($entry["rel"] as $rel) {
                    if (!in_array($rel, $allowedRelationships)) {
                        $e->addError(t("You need to select a valid relationship."));
                    }
                }
            }

            if (empty($entry["buttonStyle"]) || !in_array($entry["buttonStyle"], $allowedButtonStyles)) {
                $e->addError(t("You need to select a valid button style."));
            }

            if (isset($entry["openLinkInNewWindow"])) {
                if (empty($entry["target"]) || !in_array($entry["target"], $allowedTargets)) {
                    $e->addError(t("You need to select a valid button target."));
                }
            }

            if (isset($entry["linkType"])) {
                switch ($entry["linkType"]) {
                    case LinkType::LINK_TYPE_INTERNAL_FILE:
                        if (empty($entry["fID"]) || !is_numeric($entry["fID"])) {
                            $e->addError(t("You need to select a valid file."));
                        }

                        break;

                    case LinkType::LINK_TYPE_EXTERNAL_URL:
                        if (empty($entry["externalLink"])) {
                            $e->addError(t("You need to enter a valid url."));
                        }

                        break;

                    case LinkType::LINK_TYPE_INTERNAL_PAGE:
                        if (empty($entry["cID"]) || !is_numeric($entry["cID"])) {
                            $e->addError(t("You need to select a valid page."));
                        }

                        break;

                    default:
                        $e->addError(t("You need to select a valid link type."));
                }
            } else {
                $e->addError(t("You need to select a valid link type."));
            }
        }

        return $e;
    }

}