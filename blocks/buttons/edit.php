<?php

defined("C5_EXECUTE") or die("Access Denied.");

use Concrete\Core\Form\Service\Form;
use Concrete\Core\Support\Facade\Application;
use Concrete\Core\Utility\Service\Identifier;
use Concrete\Core\View\View;

/** @var array $entries */
/** @var array $targets */
/** @var array $iconPositions */
/** @var array $relationships */
/** @var array $buttonStyles */
/** @var array $buttonSizes */
/** @var array $linkTypes */

$app = Application::getFacadeApplication();
/** @let Form $form */
/** @noinspection PhpUnhandledExceptionInspection */
$form = $app->make(Form::class);
/** @var Identifier $idHelper */
/** @noinspection PhpUnhandledExceptionInspection */
$idHelper = $app->make(Identifier::class);

$idSuffix = $idHelper->getString();


/** @noinspection PhpUnhandledExceptionInspection */
View::element("dashboard/help_blocktypes", [], "simple_buttons");
?>

<div class="d-grid gap-1">
    <a href="javascript:void(0);" class="btn btn-primary launch-tooltip" id="ccm-add-item-<?php echo $idSuffix; ?>"
       title="<?php echo h(t("If you want to have a button group you can do so by adding multiple buttons.")); ?>">
        <i class="fas fa-plus"></i> <?php echo t("Add Button"); ?>
    </a>
</div>

<div id="entries-container-<?php echo $idSuffix; ?>"></div>

<script id="ccm-no-buttons-<?php echo $idSuffix; ?>" type="text/template">
    <div class="empty-message">
        <div class="alert alert-info">
            <?php echo t("Currently there are not buttons defined."); ?>
        </div>
    </div>
</script>

<script id="ccm-btn-entry-template-<?php echo $idSuffix; ?>" type="text/template">
    <div class="btn-entry">
        <div class="buttons">
            <div class="float-end">
                <div class="input-group">
                    <a href="javascript:void(0);" class="btn btn-secondary btn-sm toggle-entry-btn">
                        <i></i> <?php echo t("Toggle"); ?>
                    </a>

                    <a href="javascript:void(0);" class="btn btn-danger btn-sm">
                        <i class="fas fa-trash-alt"></i> <?php echo t("Remove Item"); ?>
                    </a>

                    <a href="javascript:void(0);" class="btn btn-secondary btn-sm move-entry-btn">
                        <i class="fas fa-arrows-alt"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="inner">
            <div class="form-group">
                <label for="label-<%=id%>">
                    <?php echo t("Label"); ?>
                </label>

                <input type="text" value="<%=label%>" id="label-<%=id%>" name="entries[<%=id%>][label]"
                       class="form-control"/>
            </div>

            <div class="form-group">
                <label for="title-<%=id%>">
                    <?php echo t("Title"); ?>
                </label>

                <input type="text" value="<%=title%>" id="title-<%=id%>" name="entries[<%=id%>][title]"
                       class="form-control"/>
            </div>

            <div class="form-group ccm-block-select-icon">
                <?php echo $form->label('icon', t('Icon')) ?>
                <div data-concrete-icon-selector-input="icon-<%=id%>">
                    <!--suppress CheckEmptyScriptTag, HtmlUnknownTag -->
                    <icon-selector
                            name="entries[<%=id%>][icon]"
                            selected="<%=icon%>"
                            title="<?php echo t('Choose Icon') ?>"
                            empty-option-label="<?php echo h(tc('Icon', '** None Selected')) ?>"/>
                </div>
            </div>

            <div class="form-group">
                <label for="iconPosition-<%=id%>">
                    <?php echo t("Icon Position"); ?>
                </label>

                <select id="iconPosition-<%=id%>" name="entries[<%=id%>][iconPosition]" class="form-control">
                    <?php foreach ($iconPositions as $key => $value) { ?>
                        <option value="<?php echo h($key); ?>"
                        <%=iconPosition==='<?php echo h($key); ?>' ? ' selected="selected"' : '' %>>
                        <?php echo $value; ?>
                        </option>
                    <?php } ?>
                </select>
            </div>

            <div class="form-group">
                <label for="rel-<%=id%>">
                    <?php echo t("Relationship"); ?>
                </label>

                <div>
                    <?php foreach ($relationships as $key => $value) { ?>
                        <div class="form-check">
                            <input type="checkbox" name="entries[<%=id%>][rel][<?php echo $key ?>]"
                                   id="rel-<%=id%>-<?php echo $key ?>" class="form-check-input"
                                   value="<?php echo h($key) ?>"
                            <%=rel.indexOf("<?php echo $key ?>") != -1 ? ' checked="checked"' : '' %> />

                            <label for="rel-<%=id%>-<?php echo $key ?>" class="form-check-label">
                                <?php echo $value; ?>
                            </label>
                        </div>
                    <?php } ?>
                </div>
            </div>

            <div class="form-group">
                <label for="buttonStyle-<%=id%>">
                    <?php echo t("Button Style"); ?>
                </label>

                <select id="buttonStyle-<%=id%>" name="entries[<%=id%>][buttonStyle]" class="form-control">
                    <?php foreach ($buttonStyles as $key => $value) { ?>
                        <option value="<?php echo h($key); ?>"
                        <%=buttonStyle==='<?php echo h($key); ?>' ? ' selected="selected"' : '' %>>
                        <?php echo $value; ?>
                        </option>
                    <?php } ?>
                </select>
            </div>

            <div class="form-group">
                <label for="size-<%=id%>">
                    <?php echo t("Button Size"); ?>
                </label>

                <select id="size-<%=id%>" name="entries[<%=id%>][size]" class="form-control">
                    <?php foreach ($buttonSizes as $key => $value) { ?>
                        <option value="<?php echo h($key); ?>"
                        <%=size==='<?php echo h($key); ?>' ? ' selected="selected"' : '' %>>
                        <?php echo $value; ?>
                        </option>
                    <?php } ?>
                </select>
            </div>

            <div class="form-group">
                <div class="form-check">
                    <input type="checkbox" name="entries[<%=id%>][disabled]" id="disabled-<%=id%>"
                           class="form-check-input"
                           value="1" <%=disabled ? ' checked="checked"' : '' %> />

                    <label for="disabled-<%=id%>" class="form-check-label">
                        <?php echo t("Disabled"); ?>
                    </label>
                </div>

                <div class="form-check">
                    <input type="checkbox" name="entries[<%=id%>][outline]" id="outline-<%=id%>"
                           class="form-check-input"
                           value="1" <%=outline ? ' checked="checked"' : '' %> />

                    <label for="outline-<%=id%>" class="form-check-label">
                        <?php echo t("Outline"); ?>
                    </label>
                </div>

                <div class="form-check">
                    <input type="checkbox" name="entries[<%=id%>][openLinkInNewWindow]" id="openLinkInNewWindow-<%=id%>"
                           class="form-check-input open-in-new-window-checkbox"
                           value="1" <%=openLinkInNewWindow ? ' checked="checked"' : '' %> />

                    <label for="openLinkInNewWindow-<%=id%>" class="form-check-label">
                        <?php echo t("Open Link in New Window"); ?>
                    </label>
                </div>
            </div>

            <div class="form-group target-selector">
                <label for="target-<%=id%>">
                    <?php echo t("Target"); ?>
                </label>

                <select id="target-<%=id%>" name="entries[<%=id%>][target]" class="form-control">
                    <?php foreach ($targets as $key => $value) { ?>
                        <option value="<?php echo h($key); ?>"
                        <%=target==='<?php echo h($key); ?>' ? ' selected="selected"' : '' %>>
                        <?php echo $value; ?>
                        </option>
                    <?php } ?>
                </select>
            </div>

            <div class="form-group">
                <label for="linkType-<%=id%>">
                    <?php echo t("Link Type"); ?>
                </label>

                <select id="linkType-<%=id%>" name="entries[<%=id%>][linkType]" class="form-control link-type-selector">
                    <?php foreach ($linkTypes as $key => $value) { ?>
                        <option value="<?php echo h($key); ?>"
                        <%=linkType==='<?php echo h($key); ?>' ? ' selected="selected"' : '' %>>
                        <?php echo $value; ?>
                        </option>
                    <?php } ?>
                </select>
            </div>

            <div class="form-group link-type page">
                <label for="cID-<%=id%>">
                    <?php echo t("Page"); ?>
                </label>

                <div data-concrete-page-input="cID-<%=id%>">
                    <!--suppress HtmlUnknownTag -->
                    <concrete-page-input
                            choose-text="<?= h(t('Choose Page')) ?>"
                            input-name="entries[<%=id%>][cID]"
                            page-id="<%=cID%>"
                    ></concrete-page-input>
                </div>
            </div>

            <div class="form-group link-type file">
                <label for="fID-<%=id%>">
                    <?php echo t("File"); ?>
                </label>

                <div data-concrete-file-input="fID-<%=id%>">
                    <!--suppress HtmlUnknownTag -->
                    <concrete-file-input
                            choose-text="<?= h(t('Choose Page')) ?>"
                            input-name="entries[<%=id%>][fID]"
                            file-id="<%=fID%>"
                    ></concrete-file-input>
                </div>
            </div>

            <div class="form-group link-type url">
                <label for="externalLink-<%=id%>">
                    <?php echo t("URL"); ?>
                </label>

                <input type="text" value="<%=externalLink%>" id="externalLink-<%=id%>"
                       name="entries[<%=id%>][externalLink]"
                       class="form-control"/>
            </div>
        </div>
    </div>
</script>

<style>
    #entries-container-<?php echo $idSuffix; ?> {
        margin-top: 15px;
    }

    .btn-entry {
        padding: 10px;
        margin-bottom: 10px;
        background-color: #f5f5f5;
        border: 1px solid #e3e3e3;
        border-radius: 4px;
        -moz-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.05);
        -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.05);
        box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.05);
        min-height: 53px;
    }

    .btn-entry .inner {
        margin-top: 70px;
    }

    .btn-entry.closed .inner {
        display: none;
    }
    
    .btn-entry .move-entry-btn {
        cursor: move;
    }

    .btn-entry .toggle-entry-btn i {

        -webkit-font-smoothing: antialiased;
        display: inline-block;
        font-style: normal;
        font-variant: normal;
        text-rendering: auto;
        line-height: 1;
        font-family: 'Font Awesome 5 Free';
        font-weight: 900;
    }

    .btn-entry .toggle-entry-btn i::before {
        content: "\f077";
    }
    .btn-entry.closed .toggle-entry-btn i::before {
        content: "\f078";
    }
</style>

<!--suppress JSUnresolvedFunction, JSUnusedAssignment, JSCheckFunctionSignatures, JSUnresolvedVariable -->
<script type="text/javascript">
    (function ($) {
        let nextInsertId = 0;
        let entries = <?php echo json_encode($entries);?>;

        let updateEmptyMessage = function () {
            if ($("#entries-container-<?php echo $idSuffix; ?>").find(".btn-entry").length === 0) {
                let $item = $(_.template($("#ccm-no-buttons-<?php echo $idSuffix; ?>").html())());
                $("#entries-container-<?php echo $idSuffix; ?>").append($item);
            }
        }

        let makeSortable = function () {
            $("#entries-container-<?php echo $idSuffix; ?>").sortable({
                placeholder: "ui-state-highlight",
                axis: "y",
                handle: "i.fa-arrows-alt",
                cursor: "move"
            });
        }

        let addEntry = function (data) {
            let defaults = {
                id: nextInsertId
            };

            let combinedData = {...defaults, ...data};

            let $item = $(_.template($("#ccm-btn-entry-template-<?php echo $idSuffix; ?>").html())(combinedData));

            nextInsertId++;

            $("#entries-container-<?php echo $idSuffix; ?>").find(".empty-message").remove();
            $("#entries-container-<?php echo $idSuffix; ?>").find(".btn-entry").addClass("closed");
            $("#entries-container-<?php echo $idSuffix; ?>").append($item);

            $item.find(".btn-danger").click(function () {
                let $btnEntry = $(this).closest(".btn-entry");

                ConcreteAlert.confirm(
                    <?php echo json_encode(t('Do you really want to delete this button?')); ?>,
                    function () {
                        $btnEntry.remove();
                        updateEmptyMessage();
                        $.fn.dialog.closeTop();
                    },
                    'btn-danger',
                    <?php echo json_encode(t('Delete')); ?>
                );
            });

            $item.find(".open-in-new-window-checkbox").change(function () {
                let $btnEntry = $(this).closest(".btn-entry");
                let $targetSelector = $btnEntry.find(".target-selector");
                let openInNewWindow = $(this).is(":checked");

                if (openInNewWindow) {
                    $targetSelector.removeClass("d-none");
                } else {
                    $targetSelector.addClass("d-none");
                }
            }).trigger("change");

            $item.find(".link-type-selector").change(function () {
                let $btnEntry = $(this).closest(".btn-entry");
                let selectedLinkType = $(this).find("option:selected").val();

                $btnEntry.find(".link-type").each(function () {
                    let $linkType = $(this);

                    if ($linkType.hasClass(selectedLinkType)) {
                        $linkType.removeClass("d-none");
                    } else {
                        $linkType.addClass("d-none");
                    }
                })
            }).trigger("change");

            $item.find(".toggle-entry-btn").click(function () {
                let $btnEntry = $(this).closest(".btn-entry");

                $("#entries-container-<?php echo $idSuffix; ?>").find(".btn-entry").each(function() {
                    let $curBtnEntry = $(this);

                    if (!$curBtnEntry.is($btnEntry)) {
                        $curBtnEntry.addClass("closed");
                    }
                });

                $btnEntry.toggleClass("closed");
            });

            Concrete.Vue.activateContext('cms', function (Vue, config) {
                new Vue({
                    el: 'div[data-concrete-page-input="cID-' + combinedData.id + '"]',
                    components: config.components
                })
            })

            Concrete.Vue.activateContext('cms', function (Vue, config) {
                new Vue({
                    el: 'div[data-concrete-file-input="fID-' + combinedData.id + '"]',
                    components: config.components
                })
            })

            Concrete.Vue.activateContext('cms', function (Vue, config) {
                new Vue({
                    el: 'div[data-concrete-icon-selector-input="icon-' + combinedData.id + '"]',
                    components: config.components
                })
            })

            makeSortable();
        };

        updateEmptyMessage();

        for (let entry of entries) {
            addEntry(entry);
        }

        $("#ccm-add-item-<?php echo $idSuffix; ?>").click(function (e) {
            e.preventDefault();
            e.stopPropagation();

            addEntry({
                label: "",
                title: "",
                icon: "",
                rel: [],
                buttonStyle: "primary",
                size: "regular",
                iconPosition: "left",
                openLinkInNewWindow: false,
                disabled: false,
                outline: false,
                target: "_blank",
                linkType: "url",
                externalLink: "#",
                cID: null,
                fID: null
            });

            return false;
        });
    })(jQuery);
</script>

