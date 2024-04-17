<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title> Home - Arete Planet Forum</title>
    <meta name="title" content="Arete Planet Forum - ProForum">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/favicon.ico') }}">
    <meta itemprop="name" content="Arete Planet Forum">
    <meta itemprop="description" content="">

     <!-- Bootstrap CSS -->
    <link href="{{ asset("proforum/assets/common/css/bootstrap.min.css") }}" rel="stylesheet">

    <link href="{{ asset("proforum/assets/common/css/all.min.css") }}" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset("proforum/assets/common/css/line-awesome.min.css") }}">

    <link rel="stylesheet" href="{{ asset("proforum/assets/presets/default/css/custom.css") }}">

    <!-- Fontawesome -->
    <link rel="stylesheet" href="{{ asset("proforum/assets/presets/default/css/fontawesome-all.min.css") }}">

    <!-- Animate css -->
    <link rel="stylesheet" href="{{ asset("proforum/assets/presets/default/css/animate.min.css") }}">
    <!-- Odometer -->
    <link rel="stylesheet" href="{{ asset("proforum/assets/presets/default/css/odometer.css") }}">

    <link rel="stylesheet" href="{{ asset("proforum/assets/presets/default/css/emoji.css") }}">
    <!-- Main css -->

    <link rel="stylesheet" href="{{ asset("proforum/assets/presets/default/css/glightbox.min.css") }}">

    <link rel="stylesheet" href="{{ asset("proforum/assets/admin/css/select2.min.css") }}">
    <link rel="stylesheet" href="{{ asset("proforum/assets/presets/default/css/main.css") }}">



    <link rel="stylesheet"
        href="https://preview.wstacks.com/proforum/assets/presets/default/css/color.php?color=1877f2&amp;secondColor=060662">
    <style data-cke="true">
        .ck.ck-editor__editable span[data-ck-unsafe-element] {
            display: none
        }

        .ck .ck-placeholder,
        .ck.ck-placeholder {
            position: relative
        }

        .ck .ck-placeholder:before,
        .ck.ck-placeholder:before {
            content: attr(data-placeholder);
            left: 0;
            pointer-events: none;
            position: absolute;
            right: 0
        }

        .ck.ck-read-only .ck-placeholder:before {
            display: none
        }

        .ck.ck-reset_all .ck-placeholder {
            position: relative
        }

        .ck .ck-placeholder:before,
        .ck.ck-placeholder:before {
            color: var(--ck-color-engine-placeholder-text);
            cursor: text
        }

        .ck-hidden {
            display: none !important
        }

        .ck-reset_all :not(.ck-reset_all-excluded *),
        .ck.ck-reset,
        .ck.ck-reset_all {
            box-sizing: border-box;
            height: auto;
            position: static;
            width: auto
        }

        :root {
            --ck-z-default: 1;
            --ck-z-modal: calc(var(--ck-z-default) + 999)
        }

        .ck-transitions-disabled,
        .ck-transitions-disabled * {
            transition: none !important
        }

        :root {
            --ck-color-base-foreground: #fafafa;
            --ck-color-base-background: #fff;
            --ck-color-base-border: #ccced1;
            --ck-color-base-action: #53a336;
            --ck-color-base-focus: #6cb5f9;
            --ck-color-base-text: #333;
            --ck-color-base-active: #2977ff;
            --ck-color-base-active-focus: #0d65ff;
            --ck-color-base-error: #db3700;
            --ck-color-focus-border-coordinates: 218, 81.8%, 56.9%;
            --ck-color-focus-border: hsl(var(--ck-color-focus-border-coordinates));
            --ck-color-focus-outer-shadow: #cae1fc;
            --ck-color-focus-disabled-shadow: rgba(119, 186, 248, .3);
            --ck-color-focus-error-shadow: rgba(255, 64, 31, .3);
            --ck-color-text: var(--ck-color-base-text);
            --ck-color-shadow-drop: rgba(0, 0, 0, .15);
            --ck-color-shadow-drop-active: rgba(0, 0, 0, .2);
            --ck-color-shadow-inner: rgba(0, 0, 0, .1);
            --ck-color-button-default-background: transparent;
            --ck-color-button-default-hover-background: #f0f0f0;
            --ck-color-button-default-active-background: #f0f0f0;
            --ck-color-button-default-disabled-background: transparent;
            --ck-color-button-on-background: #f0f7ff;
            --ck-color-button-on-hover-background: #dbecff;
            --ck-color-button-on-active-background: #dbecff;
            --ck-color-button-on-disabled-background: #f0f2f4;
            --ck-color-button-on-color: #2977ff;
            --ck-color-button-action-background: var(--ck-color-base-action);
            --ck-color-button-action-hover-background: #4d9d30;
            --ck-color-button-action-active-background: #4d9d30;
            --ck-color-button-action-disabled-background: #7ec365;
            --ck-color-button-action-text: var(--ck-color-base-background);
            --ck-color-button-save: #008a00;
            --ck-color-button-cancel: #db3700;
            --ck-color-switch-button-off-background: #939393;
            --ck-color-switch-button-off-hover-background: #7d7d7d;
            --ck-color-switch-button-on-background: var(--ck-color-button-action-background);
            --ck-color-switch-button-on-hover-background: #4d9d30;
            --ck-color-switch-button-inner-background: var(--ck-color-base-background);
            --ck-color-switch-button-inner-shadow: rgba(0, 0, 0, .1);
            --ck-color-dropdown-panel-background: var(--ck-color-base-background);
            --ck-color-dropdown-panel-border: var(--ck-color-base-border);
            --ck-color-input-background: var(--ck-color-base-background);
            --ck-color-input-border: var(--ck-color-base-border);
            --ck-color-input-error-border: var(--ck-color-base-error);
            --ck-color-input-text: var(--ck-color-base-text);
            --ck-color-input-disabled-background: #f2f2f2;
            --ck-color-input-disabled-border: var(--ck-color-base-border);
            --ck-color-input-disabled-text: #757575;
            --ck-color-list-background: var(--ck-color-base-background);
            --ck-color-list-button-hover-background: var(--ck-color-button-default-hover-background);
            --ck-color-list-button-on-background: var(--ck-color-button-on-color);
            --ck-color-list-button-on-background-focus: var(--ck-color-button-on-color);
            --ck-color-list-button-on-text: var(--ck-color-base-background);
            --ck-color-panel-background: var(--ck-color-base-background);
            --ck-color-panel-border: var(--ck-color-base-border);
            --ck-color-toolbar-background: var(--ck-color-base-background);
            --ck-color-toolbar-border: var(--ck-color-base-border);
            --ck-color-tooltip-background: var(--ck-color-base-text);
            --ck-color-tooltip-text: var(--ck-color-base-background);
            --ck-color-engine-placeholder-text: #707070;
            --ck-color-upload-bar-background: #6cb5f9;
            --ck-color-link-default: #0000f0;
            --ck-color-link-selected-background: rgba(31, 176, 255, .1);
            --ck-color-link-fake-selection: rgba(31, 176, 255, .3);
            --ck-color-highlight-background: #ff0;
            --ck-disabled-opacity: .5;
            --ck-focus-outer-shadow-geometry: 0 0 0 3px;
            --ck-focus-outer-shadow: var(--ck-focus-outer-shadow-geometry) var(--ck-color-focus-outer-shadow);
            --ck-focus-disabled-outer-shadow: var(--ck-focus-outer-shadow-geometry) var(--ck-color-focus-disabled-shadow);
            --ck-focus-error-outer-shadow: var(--ck-focus-outer-shadow-geometry) var(--ck-color-focus-error-shadow);
            --ck-focus-ring: 1px solid var(--ck-color-focus-border);
            --ck-font-size-base: 13px;
            --ck-line-height-base: 1.84615;
            --ck-font-face: Helvetica, Arial, Tahoma, Verdana, Sans-Serif;
            --ck-font-size-tiny: 0.7em;
            --ck-font-size-small: 0.75em;
            --ck-font-size-normal: 1em;
            --ck-font-size-big: 1.4em;
            --ck-font-size-large: 1.8em;
            --ck-ui-component-min-height: 2.3em
        }

        .ck-reset_all :not(.ck-reset_all-excluded *),
        .ck.ck-reset,
        .ck.ck-reset_all {
            word-wrap: break-word;
            background: transparent;
            border: 0;
            margin: 0;
            padding: 0;
            text-decoration: none;
            transition: none;
            vertical-align: middle
        }

        .ck-reset_all :not(.ck-reset_all-excluded *),
        .ck.ck-reset_all {
            border-collapse: collapse;
            color: var(--ck-color-text);
            cursor: auto;
            float: none;
            font: normal normal normal var(--ck-font-size-base)/var(--ck-line-height-base) var(--ck-font-face);
            text-align: left;
            white-space: nowrap
        }

        .ck-reset_all .ck-rtl :not(.ck-reset_all-excluded *) {
            text-align: right
        }

        .ck-reset_all iframe:not(.ck-reset_all-excluded *) {
            vertical-align: inherit
        }

        .ck-reset_all textarea:not(.ck-reset_all-excluded *) {
            white-space: pre-wrap
        }

        .ck-reset_all input[type=password]:not(.ck-reset_all-excluded *),
        .ck-reset_all input[type=text]:not(.ck-reset_all-excluded *),
        .ck-reset_all textarea:not(.ck-reset_all-excluded *) {
            cursor: text
        }

        .ck-reset_all input[type=password][disabled]:not(.ck-reset_all-excluded *),
        .ck-reset_all input[type=text][disabled]:not(.ck-reset_all-excluded *),
        .ck-reset_all textarea[disabled]:not(.ck-reset_all-excluded *) {
            cursor: default
        }

        .ck-reset_all fieldset:not(.ck-reset_all-excluded *) {
            border: 2px groove #dfdee3;
            padding: 10px
        }

        .ck-reset_all button:not(.ck-reset_all-excluded *)::-moz-focus-inner {
            border: 0;
            padding: 0
        }

        .ck[dir=rtl],
        .ck[dir=rtl] .ck {
            text-align: right
        }

        :root {
            --ck-border-radius: 2px;
            --ck-inner-shadow: 2px 2px 3px var(--ck-color-shadow-inner) inset;
            --ck-drop-shadow: 0 1px 2px 1px var(--ck-color-shadow-drop);
            --ck-drop-shadow-active: 0 3px 6px 1px var(--ck-color-shadow-drop-active);
            --ck-spacing-unit: 0.6em;
            --ck-spacing-large: calc(var(--ck-spacing-unit)*1.5);
            --ck-spacing-standard: var(--ck-spacing-unit);
            --ck-spacing-medium: calc(var(--ck-spacing-unit)*0.8);
            --ck-spacing-small: calc(var(--ck-spacing-unit)*0.5);
            --ck-spacing-tiny: calc(var(--ck-spacing-unit)*0.3);
            --ck-spacing-extra-tiny: calc(var(--ck-spacing-unit)*0.16)
        }

        :root {
            --ck-balloon-panel-arrow-z-index: calc(var(--ck-z-default) - 3)
        }

        .ck.ck-balloon-panel {
            display: none;
            position: absolute;
            z-index: var(--ck-z-modal)
        }

        .ck.ck-balloon-panel.ck-balloon-panel_with-arrow:after,
        .ck.ck-balloon-panel.ck-balloon-panel_with-arrow:before {
            content: "";
            position: absolute
        }

        .ck.ck-balloon-panel.ck-balloon-panel_with-arrow:before {
            z-index: var(--ck-balloon-panel-arrow-z-index)
        }

        .ck.ck-balloon-panel.ck-balloon-panel_with-arrow:after {
            z-index: calc(var(--ck-balloon-panel-arrow-z-index) + 1)
        }

        .ck.ck-balloon-panel[class*=arrow_n]:before {
            z-index: var(--ck-balloon-panel-arrow-z-index)
        }

        .ck.ck-balloon-panel[class*=arrow_n]:after {
            z-index: calc(var(--ck-balloon-panel-arrow-z-index) + 1)
        }

        .ck.ck-balloon-panel[class*=arrow_s]:before {
            z-index: var(--ck-balloon-panel-arrow-z-index)
        }

        .ck.ck-balloon-panel[class*=arrow_s]:after {
            z-index: calc(var(--ck-balloon-panel-arrow-z-index) + 1)
        }

        .ck.ck-balloon-panel.ck-balloon-panel_visible {
            display: block
        }

        :root {
            --ck-balloon-border-width: 1px;
            --ck-balloon-arrow-offset: 2px;
            --ck-balloon-arrow-height: 10px;
            --ck-balloon-arrow-half-width: 8px;
            --ck-balloon-arrow-drop-shadow: 0 2px 2px var(--ck-color-shadow-drop)
        }

        .ck.ck-balloon-panel {
            border-radius: 0
        }

        .ck-rounded-corners .ck.ck-balloon-panel,
        .ck.ck-balloon-panel.ck-rounded-corners {
            border-radius: var(--ck-border-radius)
        }

        .ck.ck-balloon-panel {
            background: var(--ck-color-panel-background);
            border: var(--ck-balloon-border-width) solid var(--ck-color-panel-border);
            box-shadow: var(--ck-drop-shadow), 0 0;
            min-height: 15px
        }

        .ck.ck-balloon-panel.ck-balloon-panel_with-arrow:after,
        .ck.ck-balloon-panel.ck-balloon-panel_with-arrow:before {
            border-style: solid;
            height: 0;
            width: 0
        }

        .ck.ck-balloon-panel[class*=arrow_n]:after,
        .ck.ck-balloon-panel[class*=arrow_n]:before {
            border-width: 0 var(--ck-balloon-arrow-half-width) var(--ck-balloon-arrow-height) var(--ck-balloon-arrow-half-width)
        }

        .ck.ck-balloon-panel[class*=arrow_n]:before {
            border-color: transparent transparent var(--ck-color-panel-border) transparent;
            margin-top: calc(var(--ck-balloon-border-width)*-1)
        }

        .ck.ck-balloon-panel[class*=arrow_n]:after {
            border-color: transparent transparent var(--ck-color-panel-background) transparent;
            margin-top: calc(var(--ck-balloon-arrow-offset) - var(--ck-balloon-border-width))
        }

        .ck.ck-balloon-panel[class*=arrow_s]:after,
        .ck.ck-balloon-panel[class*=arrow_s]:before {
            border-width: var(--ck-balloon-arrow-height) var(--ck-balloon-arrow-half-width) 0 var(--ck-balloon-arrow-half-width)
        }

        .ck.ck-balloon-panel[class*=arrow_s]:before {
            border-color: var(--ck-color-panel-border) transparent transparent;
            filter: drop-shadow(var(--ck-balloon-arrow-drop-shadow));
            margin-bottom: calc(var(--ck-balloon-border-width)*-1)
        }

        .ck.ck-balloon-panel[class*=arrow_s]:after {
            border-color: var(--ck-color-panel-background) transparent transparent transparent;
            margin-bottom: calc(var(--ck-balloon-arrow-offset) - var(--ck-balloon-border-width))
        }

        .ck.ck-balloon-panel[class*=arrow_e]:after,
        .ck.ck-balloon-panel[class*=arrow_e]:before {
            border-width: var(--ck-balloon-arrow-half-width) 0 var(--ck-balloon-arrow-half-width) var(--ck-balloon-arrow-height)
        }

        .ck.ck-balloon-panel[class*=arrow_e]:before {
            border-color: transparent transparent transparent var(--ck-color-panel-border);
            margin-right: calc(var(--ck-balloon-border-width)*-1)
        }

        .ck.ck-balloon-panel[class*=arrow_e]:after {
            border-color: transparent transparent transparent var(--ck-color-panel-background);
            margin-right: calc(var(--ck-balloon-arrow-offset) - var(--ck-balloon-border-width))
        }

        .ck.ck-balloon-panel[class*=arrow_w]:after,
        .ck.ck-balloon-panel[class*=arrow_w]:before {
            border-width: var(--ck-balloon-arrow-half-width) var(--ck-balloon-arrow-height) var(--ck-balloon-arrow-half-width) 0
        }

        .ck.ck-balloon-panel[class*=arrow_w]:before {
            border-color: transparent var(--ck-color-panel-border) transparent transparent;
            margin-left: calc(var(--ck-balloon-border-width)*-1)
        }

        .ck.ck-balloon-panel[class*=arrow_w]:after {
            border-color: transparent var(--ck-color-panel-background) transparent transparent;
            margin-left: calc(var(--ck-balloon-arrow-offset) - var(--ck-balloon-border-width))
        }

        .ck.ck-balloon-panel.ck-balloon-panel_arrow_n:after,
        .ck.ck-balloon-panel.ck-balloon-panel_arrow_n:before {
            left: 50%;
            margin-left: calc(var(--ck-balloon-arrow-half-width)*-1);
            top: calc(var(--ck-balloon-arrow-height)*-1)
        }

        .ck.ck-balloon-panel.ck-balloon-panel_arrow_nw:after,
        .ck.ck-balloon-panel.ck-balloon-panel_arrow_nw:before {
            left: calc(var(--ck-balloon-arrow-half-width)*2);
            top: calc(var(--ck-balloon-arrow-height)*-1)
        }

        .ck.ck-balloon-panel.ck-balloon-panel_arrow_ne:after,
        .ck.ck-balloon-panel.ck-balloon-panel_arrow_ne:before {
            right: calc(var(--ck-balloon-arrow-half-width)*2);
            top: calc(var(--ck-balloon-arrow-height)*-1)
        }

        .ck.ck-balloon-panel.ck-balloon-panel_arrow_s:after,
        .ck.ck-balloon-panel.ck-balloon-panel_arrow_s:before {
            bottom: calc(var(--ck-balloon-arrow-height)*-1);
            left: 50%;
            margin-left: calc(var(--ck-balloon-arrow-half-width)*-1)
        }

        .ck.ck-balloon-panel.ck-balloon-panel_arrow_sw:after,
        .ck.ck-balloon-panel.ck-balloon-panel_arrow_sw:before {
            bottom: calc(var(--ck-balloon-arrow-height)*-1);
            left: calc(var(--ck-balloon-arrow-half-width)*2)
        }

        .ck.ck-balloon-panel.ck-balloon-panel_arrow_se:after,
        .ck.ck-balloon-panel.ck-balloon-panel_arrow_se:before {
            bottom: calc(var(--ck-balloon-arrow-height)*-1);
            right: calc(var(--ck-balloon-arrow-half-width)*2)
        }

        .ck.ck-balloon-panel.ck-balloon-panel_arrow_sme:after,
        .ck.ck-balloon-panel.ck-balloon-panel_arrow_sme:before {
            bottom: calc(var(--ck-balloon-arrow-height)*-1);
            margin-right: calc(var(--ck-balloon-arrow-half-width)*2);
            right: 25%
        }

        .ck.ck-balloon-panel.ck-balloon-panel_arrow_smw:after,
        .ck.ck-balloon-panel.ck-balloon-panel_arrow_smw:before {
            bottom: calc(var(--ck-balloon-arrow-height)*-1);
            left: 25%;
            margin-left: calc(var(--ck-balloon-arrow-half-width)*2)
        }

        .ck.ck-balloon-panel.ck-balloon-panel_arrow_nme:after,
        .ck.ck-balloon-panel.ck-balloon-panel_arrow_nme:before {
            margin-right: calc(var(--ck-balloon-arrow-half-width)*2);
            right: 25%;
            top: calc(var(--ck-balloon-arrow-height)*-1)
        }

        .ck.ck-balloon-panel.ck-balloon-panel_arrow_nmw:after,
        .ck.ck-balloon-panel.ck-balloon-panel_arrow_nmw:before {
            left: 25%;
            margin-left: calc(var(--ck-balloon-arrow-half-width)*2);
            top: calc(var(--ck-balloon-arrow-height)*-1)
        }

        .ck.ck-balloon-panel.ck-balloon-panel_arrow_e:after,
        .ck.ck-balloon-panel.ck-balloon-panel_arrow_e:before {
            margin-top: calc(var(--ck-balloon-arrow-half-width)*-1);
            right: calc(var(--ck-balloon-arrow-height)*-1);
            top: 50%
        }

        .ck.ck-balloon-panel.ck-balloon-panel_arrow_w:after,
        .ck.ck-balloon-panel.ck-balloon-panel_arrow_w:before {
            left: calc(var(--ck-balloon-arrow-height)*-1);
            margin-top: calc(var(--ck-balloon-arrow-half-width)*-1);
            top: 50%
        }

        .ck.ck-balloon-panel.ck-tooltip {
            --ck-balloon-border-width: 0px;
            --ck-balloon-arrow-offset: 0px;
            --ck-balloon-arrow-half-width: 4px;
            --ck-balloon-arrow-height: 4px;
            --ck-color-panel-background: var(--ck-color-tooltip-background);
            padding: 0 var(--ck-spacing-medium);
            pointer-events: none;
            z-index: calc(var(--ck-z-modal) + 100)
        }

        .ck.ck-balloon-panel.ck-tooltip .ck-tooltip__text {
            color: var(--ck-color-tooltip-text);
            font-size: .9em;
            line-height: 1.5
        }

        .ck.ck-balloon-panel.ck-tooltip {
            box-shadow: none
        }

        .ck.ck-balloon-panel.ck-tooltip:before {
            display: none
        }

        .ck.ck-icon {
            vertical-align: middle
        }

        :root {
            --ck-icon-size: calc(var(--ck-line-height-base)*var(--ck-font-size-normal))
        }

        .ck.ck-icon {
            font-size: .8333350694em;
            height: var(--ck-icon-size);
            width: var(--ck-icon-size);
            will-change: transform
        }

        .ck.ck-icon,
        .ck.ck-icon * {
            cursor: inherit
        }

        .ck.ck-icon.ck-icon_inherit-color,
        .ck.ck-icon.ck-icon_inherit-color * {
            color: inherit
        }

        .ck.ck-icon.ck-icon_inherit-color :not([fill]) {
            fill: currentColor
        }

        .ck.ck-button,
        a.ck.ck-button {
            align-items: center;
            display: inline-flex;
            justify-content: left;
            position: relative;
            -moz-user-select: none;
            -webkit-user-select: none;
            -ms-user-select: none;
            user-select: none
        }

        .ck.ck-button .ck-button__label,
        a.ck.ck-button .ck-button__label {
            display: none
        }

        .ck.ck-button.ck-button_with-text .ck-button__label,
        a.ck.ck-button.ck-button_with-text .ck-button__label {
            display: inline-block
        }

        .ck.ck-button:not(.ck-button_with-text),
        a.ck.ck-button:not(.ck-button_with-text) {
            justify-content: center
        }

        .ck.ck-button,
        a.ck.ck-button {
            background: var(--ck-color-button-default-background)
        }

        .ck.ck-button:not(.ck-disabled):hover,
        a.ck.ck-button:not(.ck-disabled):hover {
            background: var(--ck-color-button-default-hover-background)
        }

        .ck.ck-button:not(.ck-disabled):active,
        a.ck.ck-button:not(.ck-disabled):active {
            background: var(--ck-color-button-default-active-background)
        }

        .ck.ck-button.ck-disabled,
        a.ck.ck-button.ck-disabled {
            background: var(--ck-color-button-default-disabled-background)
        }

        .ck.ck-button,
        a.ck.ck-button {
            border-radius: 0
        }

        .ck-rounded-corners .ck.ck-button,
        .ck-rounded-corners a.ck.ck-button,
        .ck.ck-button.ck-rounded-corners,
        a.ck.ck-button.ck-rounded-corners {
            border-radius: var(--ck-border-radius)
        }

        .ck.ck-button,
        a.ck.ck-button {
            -webkit-appearance: none;
            border: 1px solid transparent;
            cursor: default;
            font-size: inherit;
            line-height: 1;
            min-height: var(--ck-ui-component-min-height);
            min-width: var(--ck-ui-component-min-height);
            padding: var(--ck-spacing-tiny);
            text-align: center;
            transition: box-shadow .2s ease-in-out, border .2s ease-in-out;
            vertical-align: middle;
            white-space: nowrap
        }

        .ck.ck-button:active,
        .ck.ck-button:focus,
        a.ck.ck-button:active,
        a.ck.ck-button:focus {
            border: var(--ck-focus-ring);
            box-shadow: var(--ck-focus-outer-shadow), 0 0;
            outline: none
        }

        .ck.ck-button .ck-button__icon use,
        .ck.ck-button .ck-button__icon use *,
        a.ck.ck-button .ck-button__icon use,
        a.ck.ck-button .ck-button__icon use * {
            color: inherit
        }

        .ck.ck-button .ck-button__label,
        a.ck.ck-button .ck-button__label {
            color: inherit;
            cursor: inherit;
            font-size: inherit;
            font-weight: inherit;
            vertical-align: middle
        }

        [dir=ltr] .ck.ck-button .ck-button__label,
        [dir=ltr] a.ck.ck-button .ck-button__label {
            text-align: left
        }

        [dir=rtl] .ck.ck-button .ck-button__label,
        [dir=rtl] a.ck.ck-button .ck-button__label {
            text-align: right
        }

        .ck.ck-button .ck-button__keystroke,
        a.ck.ck-button .ck-button__keystroke {
            color: inherit
        }

        [dir=ltr] .ck.ck-button .ck-button__keystroke,
        [dir=ltr] a.ck.ck-button .ck-button__keystroke {
            margin-left: var(--ck-spacing-large)
        }

        [dir=rtl] .ck.ck-button .ck-button__keystroke,
        [dir=rtl] a.ck.ck-button .ck-button__keystroke {
            margin-right: var(--ck-spacing-large)
        }

        .ck.ck-button .ck-button__keystroke,
        a.ck.ck-button .ck-button__keystroke {
            font-weight: 700;
            opacity: .7
        }

        .ck.ck-button.ck-disabled:active,
        .ck.ck-button.ck-disabled:focus,
        a.ck.ck-button.ck-disabled:active,
        a.ck.ck-button.ck-disabled:focus {
            box-shadow: var(--ck-focus-disabled-outer-shadow), 0 0
        }

        .ck.ck-button.ck-disabled .ck-button__icon,
        .ck.ck-button.ck-disabled .ck-button__label,
        a.ck.ck-button.ck-disabled .ck-button__icon,
        a.ck.ck-button.ck-disabled .ck-button__label {
            opacity: var(--ck-disabled-opacity)
        }

        .ck.ck-button.ck-disabled .ck-button__keystroke,
        a.ck.ck-button.ck-disabled .ck-button__keystroke {
            opacity: .3
        }

        .ck.ck-button.ck-button_with-text,
        a.ck.ck-button.ck-button_with-text {
            padding: var(--ck-spacing-tiny) var(--ck-spacing-standard)
        }

        [dir=ltr] .ck.ck-button.ck-button_with-text .ck-button__icon,
        [dir=ltr] a.ck.ck-button.ck-button_with-text .ck-button__icon {
            margin-left: calc(var(--ck-spacing-small)*-1);
            margin-right: var(--ck-spacing-small)
        }

        [dir=rtl] .ck.ck-button.ck-button_with-text .ck-button__icon,
        [dir=rtl] a.ck.ck-button.ck-button_with-text .ck-button__icon {
            margin-left: var(--ck-spacing-small);
            margin-right: calc(var(--ck-spacing-small)*-1)
        }

        .ck.ck-button.ck-button_with-keystroke .ck-button__label,
        a.ck.ck-button.ck-button_with-keystroke .ck-button__label {
            flex-grow: 1
        }

        .ck.ck-button.ck-on,
        a.ck.ck-button.ck-on {
            background: var(--ck-color-button-on-background)
        }

        .ck.ck-button.ck-on:not(.ck-disabled):hover,
        a.ck.ck-button.ck-on:not(.ck-disabled):hover {
            background: var(--ck-color-button-on-hover-background)
        }

        .ck.ck-button.ck-on:not(.ck-disabled):active,
        a.ck.ck-button.ck-on:not(.ck-disabled):active {
            background: var(--ck-color-button-on-active-background)
        }

        .ck.ck-button.ck-on.ck-disabled,
        a.ck.ck-button.ck-on.ck-disabled {
            background: var(--ck-color-button-on-disabled-background)
        }

        .ck.ck-button.ck-on,
        a.ck.ck-button.ck-on {
            color: var(--ck-color-button-on-color)
        }

        .ck.ck-button.ck-button-save,
        a.ck.ck-button.ck-button-save {
            color: var(--ck-color-button-save)
        }

        .ck.ck-button.ck-button-cancel,
        a.ck.ck-button.ck-button-cancel {
            color: var(--ck-color-button-cancel)
        }

        .ck.ck-button-action,
        a.ck.ck-button-action {
            background: var(--ck-color-button-action-background)
        }

        .ck.ck-button-action:not(.ck-disabled):hover,
        a.ck.ck-button-action:not(.ck-disabled):hover {
            background: var(--ck-color-button-action-hover-background)
        }

        .ck.ck-button-action:not(.ck-disabled):active,
        a.ck.ck-button-action:not(.ck-disabled):active {
            background: var(--ck-color-button-action-active-background)
        }

        .ck.ck-button-action.ck-disabled,
        a.ck.ck-button-action.ck-disabled {
            background: var(--ck-color-button-action-disabled-background)
        }

        .ck.ck-button-action,
        a.ck.ck-button-action {
            color: var(--ck-color-button-action-text)
        }

        .ck.ck-button-bold,
        a.ck.ck-button-bold {
            font-weight: 700
        }

        .ck.ck-button.ck-switchbutton .ck-button__toggle,
        .ck.ck-button.ck-switchbutton .ck-button__toggle .ck-button__toggle__inner {
            display: block
        }

        :root {
            --ck-switch-button-toggle-width: 2.6153846154em;
            --ck-switch-button-toggle-inner-size: calc(1.07692em + 1px);
            --ck-switch-button-translation: calc(var(--ck-switch-button-toggle-width) - var(--ck-switch-button-toggle-inner-size) - 2px);
            --ck-switch-button-inner-hover-shadow: 0 0 0 5px var(--ck-color-switch-button-inner-shadow)
        }

        .ck.ck-button.ck-switchbutton,
        .ck.ck-button.ck-switchbutton.ck-on:active,
        .ck.ck-button.ck-switchbutton.ck-on:focus,
        .ck.ck-button.ck-switchbutton.ck-on:hover,
        .ck.ck-button.ck-switchbutton:active,
        .ck.ck-button.ck-switchbutton:focus,
        .ck.ck-button.ck-switchbutton:hover {
            background: transparent;
            color: inherit
        }

        [dir=ltr] .ck.ck-button.ck-switchbutton .ck-button__label {
            margin-right: calc(var(--ck-spacing-large)*2)
        }

        [dir=rtl] .ck.ck-button.ck-switchbutton .ck-button__label {
            margin-left: calc(var(--ck-spacing-large)*2)
        }

        .ck.ck-button.ck-switchbutton .ck-button__toggle {
            border-radius: 0
        }

        .ck-rounded-corners .ck.ck-button.ck-switchbutton .ck-button__toggle,
        .ck.ck-button.ck-switchbutton .ck-button__toggle.ck-rounded-corners {
            border-radius: var(--ck-border-radius)
        }

        [dir=ltr] .ck.ck-button.ck-switchbutton .ck-button__toggle {
            margin-left: auto
        }

        [dir=rtl] .ck.ck-button.ck-switchbutton .ck-button__toggle {
            margin-right: auto
        }

        .ck.ck-button.ck-switchbutton .ck-button__toggle {
            background: var(--ck-color-switch-button-off-background);
            border: 1px solid transparent;
            transition: background .4s ease, box-shadow .2s ease-in-out, outline .2s ease-in-out;
            width: var(--ck-switch-button-toggle-width)
        }

        .ck.ck-button.ck-switchbutton .ck-button__toggle .ck-button__toggle__inner {
            border-radius: 0
        }

        .ck-rounded-corners .ck.ck-button.ck-switchbutton .ck-button__toggle .ck-button__toggle__inner,
        .ck.ck-button.ck-switchbutton .ck-button__toggle .ck-button__toggle__inner.ck-rounded-corners {
            border-radius: var(--ck-border-radius);
            border-radius: calc(var(--ck-border-radius)*.5)
        }

        .ck.ck-button.ck-switchbutton .ck-button__toggle .ck-button__toggle__inner {
            background: var(--ck-color-switch-button-inner-background);
            height: var(--ck-switch-button-toggle-inner-size);
            transition: all .3s ease;
            width: var(--ck-switch-button-toggle-inner-size)
        }

        .ck.ck-button.ck-switchbutton .ck-button__toggle:hover {
            background: var(--ck-color-switch-button-off-hover-background)
        }

        .ck.ck-button.ck-switchbutton .ck-button__toggle:hover .ck-button__toggle__inner {
            box-shadow: var(--ck-switch-button-inner-hover-shadow)
        }

        .ck.ck-button.ck-switchbutton.ck-disabled .ck-button__toggle {
            opacity: var(--ck-disabled-opacity)
        }

        .ck.ck-button.ck-switchbutton:focus {
            border-color: transparent;
            box-shadow: none;
            outline: none
        }

        .ck.ck-button.ck-switchbutton:focus .ck-button__toggle {
            box-shadow: 0 0 0 1px var(--ck-color-base-background), 0 0 0 5px var(--ck-color-focus-outer-shadow);
            outline: var(--ck-focus-ring);
            outline-offset: 1px
        }

        .ck.ck-button.ck-switchbutton.ck-on .ck-button__toggle {
            background: var(--ck-color-switch-button-on-background)
        }

        .ck.ck-button.ck-switchbutton.ck-on .ck-button__toggle:hover {
            background: var(--ck-color-switch-button-on-hover-background)
        }

        [dir=ltr] .ck.ck-button.ck-switchbutton.ck-on .ck-button__toggle .ck-button__toggle__inner {
            transform: translateX(var(--ck-switch-button-translation))
        }

        [dir=rtl] .ck.ck-button.ck-switchbutton.ck-on .ck-button__toggle .ck-button__toggle__inner {
            transform: translateX(calc(var(--ck-switch-button-translation)*-1))
        }

        .ck.ck-color-grid {
            display: grid
        }

        :root {
            --ck-color-grid-tile-size: 24px;
            --ck-color-color-grid-check-icon: #166fd4
        }

        .ck.ck-color-grid {
            grid-gap: 5px;
            padding: 8px
        }

        .ck.ck-color-grid__tile {
            border: 0;
            height: var(--ck-color-grid-tile-size);
            min-height: var(--ck-color-grid-tile-size);
            min-width: var(--ck-color-grid-tile-size);
            padding: 0;
            transition: box-shadow .2s ease;
            width: var(--ck-color-grid-tile-size)
        }

        .ck.ck-color-grid__tile.ck-disabled {
            cursor: unset;
            transition: unset
        }

        .ck.ck-color-grid__tile.ck-color-table__color-tile_bordered {
            box-shadow: 0 0 0 1px var(--ck-color-base-border)
        }

        .ck.ck-color-grid__tile .ck.ck-icon {
            color: var(--ck-color-color-grid-check-icon);
            display: none
        }

        .ck.ck-color-grid__tile.ck-on {
            box-shadow: inset 0 0 0 1px var(--ck-color-base-background), 0 0 0 2px var(--ck-color-base-text)
        }

        .ck.ck-color-grid__tile.ck-on .ck.ck-icon {
            display: block
        }

        .ck.ck-color-grid__tile.ck-on,
        .ck.ck-color-grid__tile:focus:not(.ck-disabled),
        .ck.ck-color-grid__tile:hover:not(.ck-disabled) {
            border: 0
        }

        .ck.ck-color-grid__tile:focus:not(.ck-disabled),
        .ck.ck-color-grid__tile:hover:not(.ck-disabled) {
            box-shadow: inset 0 0 0 1px var(--ck-color-base-background), 0 0 0 2px var(--ck-color-focus-border)
        }

        .ck.ck-color-grid__label {
            padding: 0 var(--ck-spacing-standard)
        }

        .ck.ck-splitbutton {
            font-size: inherit
        }

        .ck.ck-splitbutton .ck-splitbutton__action:focus {
            z-index: calc(var(--ck-z-default) + 1)
        }

        :root {
            --ck-color-split-button-hover-background: #ebebeb;
            --ck-color-split-button-hover-border: #b3b3b3
        }

        [dir=ltr] .ck.ck-splitbutton.ck-splitbutton_open>.ck-splitbutton__action,
        [dir=ltr] .ck.ck-splitbutton:hover>.ck-splitbutton__action {
            border-bottom-right-radius: unset;
            border-top-right-radius: unset
        }

        [dir=rtl] .ck.ck-splitbutton.ck-splitbutton_open>.ck-splitbutton__action,
        [dir=rtl] .ck.ck-splitbutton:hover>.ck-splitbutton__action {
            border-bottom-left-radius: unset;
            border-top-left-radius: unset
        }

        .ck.ck-splitbutton>.ck-splitbutton__arrow {
            min-width: unset
        }

        [dir=ltr] .ck.ck-splitbutton>.ck-splitbutton__arrow {
            border-bottom-left-radius: unset;
            border-top-left-radius: unset
        }

        [dir=rtl] .ck.ck-splitbutton>.ck-splitbutton__arrow {
            border-bottom-right-radius: unset;
            border-top-right-radius: unset
        }

        .ck.ck-splitbutton>.ck-splitbutton__arrow svg {
            width: var(--ck-dropdown-arrow-size)
        }

        .ck.ck-splitbutton.ck-splitbutton_open>.ck-button:not(.ck-on):not(.ck-disabled):not(:hover),
        .ck.ck-splitbutton:hover>.ck-button:not(.ck-on):not(.ck-disabled):not(:hover) {
            background: var(--ck-color-split-button-hover-background)
        }

        .ck.ck-splitbutton.ck-splitbutton_open>.ck-splitbutton__arrow:not(.ck-disabled):after,
        .ck.ck-splitbutton:hover>.ck-splitbutton__arrow:not(.ck-disabled):after {
            background-color: var(--ck-color-split-button-hover-border);
            content: "";
            height: 100%;
            position: absolute;
            width: 1px
        }

        [dir=ltr] .ck.ck-splitbutton.ck-splitbutton_open>.ck-splitbutton__arrow:not(.ck-disabled):after,
        [dir=ltr] .ck.ck-splitbutton:hover>.ck-splitbutton__arrow:not(.ck-disabled):after {
            left: -1px
        }

        [dir=rtl] .ck.ck-splitbutton.ck-splitbutton_open>.ck-splitbutton__arrow:not(.ck-disabled):after,
        [dir=rtl] .ck.ck-splitbutton:hover>.ck-splitbutton__arrow:not(.ck-disabled):after {
            right: -1px
        }

        .ck.ck-splitbutton.ck-splitbutton_open {
            border-radius: 0
        }

        .ck-rounded-corners .ck.ck-splitbutton.ck-splitbutton_open,
        .ck.ck-splitbutton.ck-splitbutton_open.ck-rounded-corners {
            border-radius: var(--ck-border-radius)
        }

        .ck-rounded-corners .ck.ck-splitbutton.ck-splitbutton_open>.ck-splitbutton__action,
        .ck.ck-splitbutton.ck-splitbutton_open.ck-rounded-corners>.ck-splitbutton__action {
            border-bottom-left-radius: 0
        }

        .ck-rounded-corners .ck.ck-splitbutton.ck-splitbutton_open>.ck-splitbutton__arrow,
        .ck.ck-splitbutton.ck-splitbutton_open.ck-rounded-corners>.ck-splitbutton__arrow {
            border-bottom-right-radius: 0
        }

        :root {
            --ck-dropdown-max-width: 75vw
        }

        .ck.ck-dropdown {
            display: inline-block;
            position: relative
        }

        .ck.ck-dropdown .ck-dropdown__arrow {
            pointer-events: none;
            z-index: var(--ck-z-default)
        }

        .ck.ck-dropdown .ck-button.ck-dropdown__button {
            width: 100%
        }

        .ck.ck-dropdown .ck-dropdown__panel {
            display: none;
            max-width: var(--ck-dropdown-max-width);
            position: absolute;
            z-index: var(--ck-z-modal)
        }

        .ck.ck-dropdown .ck-dropdown__panel.ck-dropdown__panel-visible {
            display: inline-block
        }

        .ck.ck-dropdown .ck-dropdown__panel.ck-dropdown__panel_n,
        .ck.ck-dropdown .ck-dropdown__panel.ck-dropdown__panel_ne,
        .ck.ck-dropdown .ck-dropdown__panel.ck-dropdown__panel_nme,
        .ck.ck-dropdown .ck-dropdown__panel.ck-dropdown__panel_nmw,
        .ck.ck-dropdown .ck-dropdown__panel.ck-dropdown__panel_nw {
            bottom: 100%
        }

        .ck.ck-dropdown .ck-dropdown__panel.ck-dropdown__panel_s,
        .ck.ck-dropdown .ck-dropdown__panel.ck-dropdown__panel_se,
        .ck.ck-dropdown .ck-dropdown__panel.ck-dropdown__panel_sme,
        .ck.ck-dropdown .ck-dropdown__panel.ck-dropdown__panel_smw,
        .ck.ck-dropdown .ck-dropdown__panel.ck-dropdown__panel_sw {
            bottom: auto;
            top: 100%
        }

        .ck.ck-dropdown .ck-dropdown__panel.ck-dropdown__panel_ne,
        .ck.ck-dropdown .ck-dropdown__panel.ck-dropdown__panel_se {
            left: 0
        }

        .ck.ck-dropdown .ck-dropdown__panel.ck-dropdown__panel_nw,
        .ck.ck-dropdown .ck-dropdown__panel.ck-dropdown__panel_sw {
            right: 0
        }

        .ck.ck-dropdown .ck-dropdown__panel.ck-dropdown__panel_n,
        .ck.ck-dropdown .ck-dropdown__panel.ck-dropdown__panel_s {
            left: 50%;
            transform: translateX(-50%)
        }

        .ck.ck-dropdown .ck-dropdown__panel.ck-dropdown__panel_nmw,
        .ck.ck-dropdown .ck-dropdown__panel.ck-dropdown__panel_smw {
            left: 75%;
            transform: translateX(-75%)
        }

        .ck.ck-dropdown .ck-dropdown__panel.ck-dropdown__panel_nme,
        .ck.ck-dropdown .ck-dropdown__panel.ck-dropdown__panel_sme {
            left: 25%;
            transform: translateX(-25%)
        }

        .ck.ck-toolbar .ck-dropdown__panel {
            z-index: calc(var(--ck-z-modal) + 1)
        }

        :root {
            --ck-dropdown-arrow-size: calc(var(--ck-icon-size)*0.5)
        }

        .ck.ck-dropdown {
            font-size: inherit
        }

        .ck.ck-dropdown .ck-dropdown__arrow {
            width: var(--ck-dropdown-arrow-size)
        }

        [dir=ltr] .ck.ck-dropdown .ck-dropdown__arrow {
            margin-left: var(--ck-spacing-standard);
            right: var(--ck-spacing-standard)
        }

        [dir=rtl] .ck.ck-dropdown .ck-dropdown__arrow {
            left: var(--ck-spacing-standard);
            margin-right: var(--ck-spacing-small)
        }

        .ck.ck-dropdown.ck-disabled .ck-dropdown__arrow {
            opacity: var(--ck-disabled-opacity)
        }

        [dir=ltr] .ck.ck-dropdown .ck-button.ck-dropdown__button:not(.ck-button_with-text) {
            padding-left: var(--ck-spacing-small)
        }

        [dir=rtl] .ck.ck-dropdown .ck-button.ck-dropdown__button:not(.ck-button_with-text) {
            padding-right: var(--ck-spacing-small)
        }

        .ck.ck-dropdown .ck-button.ck-dropdown__button .ck-button__label {
            overflow: hidden;
            text-overflow: ellipsis;
            width: 7em
        }

        .ck.ck-dropdown .ck-button.ck-dropdown__button.ck-disabled .ck-button__label {
            opacity: var(--ck-disabled-opacity)
        }

        .ck.ck-dropdown .ck-button.ck-dropdown__button.ck-on {
            border-bottom-left-radius: 0;
            border-bottom-right-radius: 0
        }

        .ck.ck-dropdown .ck-button.ck-dropdown__button.ck-dropdown__button_label-width_auto .ck-button__label {
            width: auto
        }

        .ck.ck-dropdown .ck-button.ck-dropdown__button.ck-off:active,
        .ck.ck-dropdown .ck-button.ck-dropdown__button.ck-on:active {
            box-shadow: none
        }

        .ck.ck-dropdown .ck-button.ck-dropdown__button.ck-off:active:focus,
        .ck.ck-dropdown .ck-button.ck-dropdown__button.ck-on:active:focus {
            box-shadow: var(--ck-focus-outer-shadow), 0 0
        }

        .ck.ck-dropdown__panel {
            border-radius: 0
        }

        .ck-rounded-corners .ck.ck-dropdown__panel,
        .ck.ck-dropdown__panel.ck-rounded-corners {
            border-radius: var(--ck-border-radius)
        }

        .ck.ck-dropdown__panel {
            background: var(--ck-color-dropdown-panel-background);
            border: 1px solid var(--ck-color-dropdown-panel-border);
            bottom: 0;
            box-shadow: var(--ck-drop-shadow), 0 0;
            min-width: 100%
        }

        .ck.ck-dropdown__panel.ck-dropdown__panel_se {
            border-top-left-radius: 0
        }

        .ck.ck-dropdown__panel.ck-dropdown__panel_sw {
            border-top-right-radius: 0
        }

        .ck.ck-dropdown__panel.ck-dropdown__panel_ne {
            border-bottom-left-radius: 0
        }

        .ck.ck-dropdown__panel.ck-dropdown__panel_nw {
            border-bottom-right-radius: 0
        }

        .ck.ck-toolbar {
            align-items: center;
            display: flex;
            flex-flow: row nowrap;
            -moz-user-select: none;
            -webkit-user-select: none;
            -ms-user-select: none;
            user-select: none
        }

        .ck.ck-toolbar>.ck-toolbar__items {
            align-items: center;
            display: flex;
            flex-flow: row wrap;
            flex-grow: 1
        }

        .ck.ck-toolbar .ck.ck-toolbar__separator {
            display: inline-block
        }

        .ck.ck-toolbar .ck.ck-toolbar__separator:first-child,
        .ck.ck-toolbar .ck.ck-toolbar__separator:last-child {
            display: none
        }

        .ck.ck-toolbar .ck-toolbar__line-break {
            flex-basis: 100%
        }

        .ck.ck-toolbar.ck-toolbar_grouping>.ck-toolbar__items {
            flex-wrap: nowrap
        }

        .ck.ck-toolbar.ck-toolbar_vertical>.ck-toolbar__items {
            flex-direction: column
        }

        .ck.ck-toolbar.ck-toolbar_floating>.ck-toolbar__items {
            flex-wrap: nowrap
        }

        .ck.ck-toolbar>.ck.ck-toolbar__grouped-dropdown>.ck-dropdown__button .ck-dropdown__arrow {
            display: none
        }

        .ck.ck-toolbar {
            border-radius: 0
        }

        .ck-rounded-corners .ck.ck-toolbar,
        .ck.ck-toolbar.ck-rounded-corners {
            border-radius: var(--ck-border-radius)
        }

        .ck.ck-toolbar {
            background: var(--ck-color-toolbar-background);
            border: 1px solid var(--ck-color-toolbar-border);
            padding: 0 var(--ck-spacing-small)
        }

        .ck.ck-toolbar .ck.ck-toolbar__separator {
            align-self: stretch;
            background: var(--ck-color-toolbar-border);
            margin-bottom: var(--ck-spacing-small);
            margin-top: var(--ck-spacing-small);
            min-width: 1px;
            width: 1px
        }

        .ck.ck-toolbar .ck-toolbar__line-break {
            height: 0
        }

        .ck.ck-toolbar>.ck-toolbar__items>:not(.ck-toolbar__line-break) {
            margin-right: var(--ck-spacing-small)
        }

        .ck.ck-toolbar>.ck-toolbar__items:empty+.ck.ck-toolbar__separator {
            display: none
        }

        .ck.ck-toolbar>.ck-toolbar__items>:not(.ck-toolbar__line-break),
        .ck.ck-toolbar>.ck.ck-toolbar__grouped-dropdown {
            margin-bottom: var(--ck-spacing-small);
            margin-top: var(--ck-spacing-small)
        }

        .ck.ck-toolbar.ck-toolbar_vertical {
            padding: 0
        }

        .ck.ck-toolbar.ck-toolbar_vertical>.ck-toolbar__items>.ck {
            border-radius: 0;
            margin: 0;
            width: 100%
        }

        .ck.ck-toolbar.ck-toolbar_compact {
            padding: 0
        }

        .ck.ck-toolbar.ck-toolbar_compact>.ck-toolbar__items>* {
            margin: 0
        }

        .ck.ck-toolbar.ck-toolbar_compact>.ck-toolbar__items>:not(:first-child):not(:last-child) {
            border-radius: 0
        }

        .ck.ck-toolbar>.ck.ck-toolbar__grouped-dropdown>.ck.ck-button.ck-dropdown__button {
            padding-left: var(--ck-spacing-tiny)
        }

        .ck.ck-toolbar .ck-toolbar__nested-toolbar-dropdown>.ck-dropdown__panel {
            min-width: auto
        }

        .ck.ck-toolbar .ck-toolbar__nested-toolbar-dropdown>.ck-button>.ck-button__label {
            max-width: 7em;
            width: auto
        }

        .ck-toolbar-container .ck.ck-toolbar {
            border: 0
        }

        .ck.ck-toolbar[dir=rtl]>.ck-toolbar__items>.ck,
        [dir=rtl] .ck.ck-toolbar>.ck-toolbar__items>.ck {
            margin-right: 0
        }

        .ck.ck-toolbar[dir=rtl]:not(.ck-toolbar_compact)>.ck-toolbar__items>.ck,
        [dir=rtl] .ck.ck-toolbar:not(.ck-toolbar_compact)>.ck-toolbar__items>.ck {
            margin-left: var(--ck-spacing-small)
        }

        .ck.ck-toolbar[dir=rtl]>.ck-toolbar__items>.ck:last-child,
        [dir=rtl] .ck.ck-toolbar>.ck-toolbar__items>.ck:last-child {
            margin-left: 0
        }

        .ck.ck-toolbar.ck-toolbar_compact[dir=rtl]>.ck-toolbar__items>.ck:first-child,
        [dir=rtl] .ck.ck-toolbar.ck-toolbar_compact>.ck-toolbar__items>.ck:first-child {
            border-bottom-left-radius: 0;
            border-top-left-radius: 0
        }

        .ck.ck-toolbar.ck-toolbar_compact[dir=rtl]>.ck-toolbar__items>.ck:last-child,
        [dir=rtl] .ck.ck-toolbar.ck-toolbar_compact>.ck-toolbar__items>.ck:last-child {
            border-bottom-right-radius: 0;
            border-top-right-radius: 0
        }

        .ck.ck-toolbar.ck-toolbar_grouping[dir=rtl]>.ck-toolbar__items:not(:empty):not(:only-child),
        .ck.ck-toolbar[dir=rtl]>.ck.ck-toolbar__separator,
        [dir=rtl] .ck.ck-toolbar.ck-toolbar_grouping>.ck-toolbar__items:not(:empty):not(:only-child),
        [dir=rtl] .ck.ck-toolbar>.ck.ck-toolbar__separator {
            margin-left: var(--ck-spacing-small)
        }

        .ck.ck-toolbar[dir=ltr]>.ck-toolbar__items>.ck:last-child,
        [dir=ltr] .ck.ck-toolbar>.ck-toolbar__items>.ck:last-child {
            margin-right: 0
        }

        .ck.ck-toolbar.ck-toolbar_compact[dir=ltr]>.ck-toolbar__items>.ck:first-child,
        [dir=ltr] .ck.ck-toolbar.ck-toolbar_compact>.ck-toolbar__items>.ck:first-child {
            border-bottom-right-radius: 0;
            border-top-right-radius: 0
        }

        .ck.ck-toolbar.ck-toolbar_compact[dir=ltr]>.ck-toolbar__items>.ck:last-child,
        [dir=ltr] .ck.ck-toolbar.ck-toolbar_compact>.ck-toolbar__items>.ck:last-child {
            border-bottom-left-radius: 0;
            border-top-left-radius: 0
        }

        .ck.ck-toolbar.ck-toolbar_grouping[dir=ltr]>.ck-toolbar__items:not(:empty):not(:only-child),
        .ck.ck-toolbar[dir=ltr]>.ck.ck-toolbar__separator,
        [dir=ltr] .ck.ck-toolbar.ck-toolbar_grouping>.ck-toolbar__items:not(:empty):not(:only-child),
        [dir=ltr] .ck.ck-toolbar>.ck.ck-toolbar__separator {
            margin-right: var(--ck-spacing-small)
        }

        .ck.ck-list {
            display: flex;
            flex-direction: column;
            -moz-user-select: none;
            -webkit-user-select: none;
            -ms-user-select: none;
            user-select: none
        }

        .ck.ck-list .ck-list__item,
        .ck.ck-list .ck-list__separator {
            display: block
        }

        .ck.ck-list .ck-list__item>:focus {
            position: relative;
            z-index: var(--ck-z-default)
        }

        .ck.ck-list {
            border-radius: 0
        }

        .ck-rounded-corners .ck.ck-list,
        .ck.ck-list.ck-rounded-corners {
            border-radius: var(--ck-border-radius)
        }

        .ck.ck-list {
            background: var(--ck-color-list-background);
            list-style-type: none
        }

        .ck.ck-list__item {
            cursor: default;
            min-width: 12em
        }

        .ck.ck-list__item .ck-button {
            border-radius: 0;
            min-height: unset;
            padding: calc(var(--ck-line-height-base)*.2*var(--ck-font-size-base)) calc(var(--ck-line-height-base)*.4*var(--ck-font-size-base));
            text-align: left;
            width: 100%
        }

        .ck.ck-list__item .ck-button .ck-button__label {
            line-height: calc(var(--ck-line-height-base)*1.2*var(--ck-font-size-base))
        }

        .ck.ck-list__item .ck-button:active {
            box-shadow: none
        }

        .ck.ck-list__item .ck-button.ck-on {
            background: var(--ck-color-list-button-on-background);
            color: var(--ck-color-list-button-on-text)
        }

        .ck.ck-list__item .ck-button.ck-on:active {
            box-shadow: none
        }

        .ck.ck-list__item .ck-button.ck-on:hover:not(.ck-disabled) {
            background: var(--ck-color-list-button-on-background-focus)
        }

        .ck.ck-list__item .ck-button.ck-on:focus:not(.ck-switchbutton):not(.ck-disabled) {
            border-color: var(--ck-color-base-background)
        }

        .ck.ck-list__item .ck-button:hover:not(.ck-disabled) {
            background: var(--ck-color-list-button-hover-background)
        }

        .ck.ck-list__item .ck-switchbutton.ck-on {
            background: var(--ck-color-list-background);
            color: inherit
        }

        .ck.ck-list__item .ck-switchbutton.ck-on:hover:not(.ck-disabled) {
            background: var(--ck-color-list-button-hover-background);
            color: inherit
        }

        .ck.ck-list__separator {
            background: var(--ck-color-base-border);
            height: 1px;
            width: 100%
        }

        :root {
            --ck-toolbar-dropdown-max-width: 60vw
        }

        .ck.ck-toolbar-dropdown>.ck-dropdown__panel {
            max-width: var(--ck-toolbar-dropdown-max-width);
            width: max-content
        }

        .ck.ck-toolbar-dropdown>.ck-dropdown__panel .ck-button:focus {
            z-index: calc(var(--ck-z-default) + 1)
        }

        .ck.ck-toolbar-dropdown .ck-toolbar {
            border: 0
        }

        .ck.ck-dropdown .ck-dropdown__panel .ck-list {
            border-radius: 0
        }

        .ck-rounded-corners .ck.ck-dropdown .ck-dropdown__panel .ck-list,
        .ck.ck-dropdown .ck-dropdown__panel .ck-list.ck-rounded-corners {
            border-radius: var(--ck-border-radius);
            border-top-left-radius: 0
        }

        .ck.ck-dropdown .ck-dropdown__panel .ck-list .ck-list__item:first-child .ck-button {
            border-radius: 0
        }

        .ck-rounded-corners .ck.ck-dropdown .ck-dropdown__panel .ck-list .ck-list__item:first-child .ck-button,
        .ck.ck-dropdown .ck-dropdown__panel .ck-list .ck-list__item:first-child .ck-button.ck-rounded-corners {
            border-radius: var(--ck-border-radius);
            border-bottom-left-radius: 0;
            border-bottom-right-radius: 0;
            border-top-left-radius: 0
        }

        .ck.ck-dropdown .ck-dropdown__panel .ck-list .ck-list__item:last-child .ck-button {
            border-radius: 0
        }

        .ck-rounded-corners .ck.ck-dropdown .ck-dropdown__panel .ck-list .ck-list__item:last-child .ck-button,
        .ck.ck-dropdown .ck-dropdown__panel .ck-list .ck-list__item:last-child .ck-button.ck-rounded-corners {
            border-radius: var(--ck-border-radius);
            border-top-left-radius: 0;
            border-top-right-radius: 0
        }

        :root {
            --ck-color-editable-blur-selection: #d9d9d9
        }

        .ck.ck-editor__editable:not(.ck-editor__nested-editable) {
            border-radius: 0
        }

        .ck-rounded-corners .ck.ck-editor__editable:not(.ck-editor__nested-editable),
        .ck.ck-editor__editable.ck-rounded-corners:not(.ck-editor__nested-editable) {
            border-radius: var(--ck-border-radius)
        }

        .ck.ck-editor__editable.ck-focused:not(.ck-editor__nested-editable) {
            border: var(--ck-focus-ring);
            box-shadow: var(--ck-inner-shadow), 0 0;
            outline: none
        }

        .ck.ck-editor__editable_inline {
            border: 1px solid transparent;
            overflow: auto;
            padding: 0 var(--ck-spacing-standard)
        }

        .ck.ck-editor__editable_inline[dir=ltr] {
            text-align: left
        }

        .ck.ck-editor__editable_inline[dir=rtl] {
            text-align: right
        }

        .ck.ck-editor__editable_inline>:first-child {
            margin-top: var(--ck-spacing-large)
        }

        .ck.ck-editor__editable_inline>:last-child {
            margin-bottom: var(--ck-spacing-large)
        }

        .ck.ck-editor__editable_inline.ck-blurred ::selection {
            background: var(--ck-color-editable-blur-selection)
        }

        .ck.ck-balloon-panel.ck-toolbar-container[class*=arrow_n]:after {
            border-bottom-color: var(--ck-color-base-foreground)
        }

        .ck.ck-balloon-panel.ck-toolbar-container[class*=arrow_s]:after {
            border-top-color: var(--ck-color-base-foreground)
        }

        .ck.ck-label {
            display: block
        }

        .ck.ck-voice-label {
            display: none
        }

        .ck.ck-label {
            font-weight: 700
        }

        .ck.ck-form__header {
            align-items: center;
            display: flex;
            flex-direction: row;
            flex-wrap: nowrap;
            justify-content: space-between
        }

        :root {
            --ck-form-header-height: 38px
        }

        .ck.ck-form__header {
            border-bottom: 1px solid var(--ck-color-base-border);
            height: var(--ck-form-header-height);
            line-height: var(--ck-form-header-height);
            padding: var(--ck-spacing-small) var(--ck-spacing-large)
        }

        .ck.ck-form__header .ck-form__header__label {
            font-weight: 700
        }

        :root {
            --ck-input-width: 18em;
            --ck-input-text-width: var(--ck-input-width)
        }

        .ck.ck-input {
            border-radius: 0
        }

        .ck-rounded-corners .ck.ck-input,
        .ck.ck-input.ck-rounded-corners {
            border-radius: var(--ck-border-radius)
        }

        .ck.ck-input {
            background: var(--ck-color-input-background);
            border: 1px solid var(--ck-color-input-border);
            min-height: var(--ck-ui-component-min-height);
            min-width: var(--ck-input-width);
            padding: var(--ck-spacing-extra-tiny) var(--ck-spacing-medium);
            transition: box-shadow .1s ease-in-out, border .1s ease-in-out
        }

        .ck.ck-input:focus {
            border: var(--ck-focus-ring);
            box-shadow: var(--ck-focus-outer-shadow), 0 0;
            outline: none
        }

        .ck.ck-input[readonly] {
            background: var(--ck-color-input-disabled-background);
            border: 1px solid var(--ck-color-input-disabled-border);
            color: var(--ck-color-input-disabled-text)
        }

        .ck.ck-input[readonly]:focus {
            box-shadow: var(--ck-focus-disabled-outer-shadow), 0 0
        }

        .ck.ck-input.ck-error {
            animation: ck-input-shake .3s ease both;
            border-color: var(--ck-color-input-error-border)
        }

        .ck.ck-input.ck-error:focus {
            box-shadow: var(--ck-focus-error-outer-shadow), 0 0
        }

        @keyframes ck-input-shake {
            20% {
                transform: translateX(-2px)
            }

            40% {
                transform: translateX(2px)
            }

            60% {
                transform: translateX(-1px)
            }

            80% {
                transform: translateX(1px)
            }
        }

        .ck.ck-labeled-field-view>.ck.ck-labeled-field-view__input-wrapper {
            display: flex;
            position: relative
        }

        .ck.ck-labeled-field-view .ck.ck-label {
            display: block;
            position: absolute
        }

        :root {
            --ck-labeled-field-view-transition: .1s cubic-bezier(0, 0, 0.24, 0.95);
            --ck-labeled-field-empty-unfocused-max-width: 100% - 2 * var(--ck-spacing-medium);
            --ck-labeled-field-label-default-position-x: var(--ck-spacing-medium);
            --ck-labeled-field-label-default-position-y: calc(var(--ck-font-size-base)*0.6);
            --ck-color-labeled-field-label-background: var(--ck-color-base-background)
        }

        .ck.ck-labeled-field-view {
            border-radius: 0
        }

        .ck-rounded-corners .ck.ck-labeled-field-view,
        .ck.ck-labeled-field-view.ck-rounded-corners {
            border-radius: var(--ck-border-radius)
        }

        .ck.ck-labeled-field-view>.ck.ck-labeled-field-view__input-wrapper {
            width: 100%
        }

        .ck.ck-labeled-field-view>.ck.ck-labeled-field-view__input-wrapper>.ck.ck-label {
            top: 0
        }

        [dir=ltr] .ck.ck-labeled-field-view>.ck.ck-labeled-field-view__input-wrapper>.ck.ck-label {
            left: 0
        }

        [dir=rtl] .ck.ck-labeled-field-view>.ck.ck-labeled-field-view__input-wrapper>.ck.ck-label {
            right: 0
        }

        .ck.ck-labeled-field-view>.ck.ck-labeled-field-view__input-wrapper>.ck.ck-label {
            background: var(--ck-color-labeled-field-label-background);
            font-weight: 400;
            line-height: normal;
            max-width: 100%;
            overflow: hidden;
            padding: 0 calc(var(--ck-font-size-tiny)*.5);
            pointer-events: none;
            text-overflow: ellipsis;
            transform: translate(var(--ck-spacing-medium), -6px) scale(.75);
            transform-origin: 0 0;
            transition: transform var(--ck-labeled-field-view-transition), padding var(--ck-labeled-field-view-transition), background var(--ck-labeled-field-view-transition)
        }

        .ck.ck-labeled-field-view.ck-error .ck-input:not([readonly])+.ck.ck-label,
        .ck.ck-labeled-field-view.ck-error>.ck.ck-labeled-field-view__input-wrapper>.ck.ck-label {
            color: var(--ck-color-base-error)
        }

        .ck.ck-labeled-field-view .ck-labeled-field-view__status {
            font-size: var(--ck-font-size-small);
            margin-top: var(--ck-spacing-small);
            white-space: normal
        }

        .ck.ck-labeled-field-view .ck-labeled-field-view__status.ck-labeled-field-view__status_error {
            color: var(--ck-color-base-error)
        }

        .ck.ck-labeled-field-view.ck-disabled>.ck.ck-labeled-field-view__input-wrapper>.ck.ck-label,
        .ck.ck-labeled-field-view.ck-labeled-field-view_empty:not(.ck-labeled-field-view_focused)>.ck.ck-labeled-field-view__input-wrapper>.ck.ck-label {
            color: var(--ck-color-input-disabled-text)
        }

        [dir=ltr] .ck.ck-labeled-field-view.ck-disabled.ck-labeled-field-view_empty>.ck.ck-labeled-field-view__input-wrapper>.ck.ck-label,
        [dir=ltr] .ck.ck-labeled-field-view.ck-labeled-field-view_empty:not(.ck-labeled-field-view_focused):not(.ck-labeled-field-view_placeholder)>.ck.ck-labeled-field-view__input-wrapper>.ck.ck-label {
            transform: translate(var(--ck-labeled-field-label-default-position-x), var(--ck-labeled-field-label-default-position-y)) scale(1)
        }

        [dir=rtl] .ck.ck-labeled-field-view.ck-disabled.ck-labeled-field-view_empty>.ck.ck-labeled-field-view__input-wrapper>.ck.ck-label,
        [dir=rtl] .ck.ck-labeled-field-view.ck-labeled-field-view_empty:not(.ck-labeled-field-view_focused):not(.ck-labeled-field-view_placeholder)>.ck.ck-labeled-field-view__input-wrapper>.ck.ck-label {
            transform: translate(calc(var(--ck-labeled-field-label-default-position-x)*-1), var(--ck-labeled-field-label-default-position-y)) scale(1)
        }

        .ck.ck-labeled-field-view.ck-disabled.ck-labeled-field-view_empty>.ck.ck-labeled-field-view__input-wrapper>.ck.ck-label,
        .ck.ck-labeled-field-view.ck-labeled-field-view_empty:not(.ck-labeled-field-view_focused):not(.ck-labeled-field-view_placeholder)>.ck.ck-labeled-field-view__input-wrapper>.ck.ck-label {
            background: transparent;
            max-width: calc(var(--ck-labeled-field-empty-unfocused-max-width));
            padding: 0
        }

        .ck.ck-labeled-field-view>.ck.ck-labeled-field-view__input-wrapper>.ck-dropdown>.ck.ck-button {
            background: transparent
        }

        .ck.ck-labeled-field-view.ck-labeled-field-view_empty>.ck.ck-labeled-field-view__input-wrapper>.ck-dropdown>.ck-button>.ck-button__label {
            opacity: 0
        }

        .ck.ck-labeled-field-view.ck-labeled-field-view_empty:not(.ck-labeled-field-view_focused):not(.ck-labeled-field-view_placeholder)>.ck.ck-labeled-field-view__input-wrapper>.ck-dropdown+.ck-label {
            max-width: calc(var(--ck-labeled-field-empty-unfocused-max-width) - var(--ck-dropdown-arrow-size) - var(--ck-spacing-standard))
        }

        .ck .ck-balloon-rotator__navigation {
            align-items: center;
            display: flex;
            justify-content: center
        }

        .ck .ck-balloon-rotator__content .ck-toolbar {
            justify-content: center
        }

        .ck .ck-balloon-rotator__navigation {
            background: var(--ck-color-toolbar-background);
            border-bottom: 1px solid var(--ck-color-toolbar-border);
            padding: 0 var(--ck-spacing-small)
        }

        .ck .ck-balloon-rotator__navigation>* {
            margin-bottom: var(--ck-spacing-small);
            margin-right: var(--ck-spacing-small);
            margin-top: var(--ck-spacing-small)
        }

        .ck .ck-balloon-rotator__navigation .ck-balloon-rotator__counter {
            margin-left: var(--ck-spacing-small);
            margin-right: var(--ck-spacing-standard)
        }

        .ck .ck-balloon-rotator__content .ck.ck-annotation-wrapper {
            box-shadow: none
        }

        .ck .ck-fake-panel {
            position: absolute;
            z-index: calc(var(--ck-z-modal) - 1)
        }

        .ck .ck-fake-panel div {
            position: absolute
        }

        .ck .ck-fake-panel div:first-child {
            z-index: 2
        }

        .ck .ck-fake-panel div:nth-child(2) {
            z-index: 1
        }

        :root {
            --ck-balloon-fake-panel-offset-horizontal: 6px;
            --ck-balloon-fake-panel-offset-vertical: 6px
        }

        .ck .ck-fake-panel div {
            background: var(--ck-color-panel-background);
            border: 1px solid var(--ck-color-panel-border);
            border-radius: var(--ck-border-radius);
            box-shadow: var(--ck-drop-shadow), 0 0;
            height: 100%;
            min-height: 15px;
            width: 100%
        }

        .ck .ck-fake-panel div:first-child {
            margin-left: var(--ck-balloon-fake-panel-offset-horizontal);
            margin-top: var(--ck-balloon-fake-panel-offset-vertical)
        }

        .ck .ck-fake-panel div:nth-child(2) {
            margin-left: calc(var(--ck-balloon-fake-panel-offset-horizontal)*2);
            margin-top: calc(var(--ck-balloon-fake-panel-offset-vertical)*2)
        }

        .ck .ck-fake-panel div:nth-child(3) {
            margin-left: calc(var(--ck-balloon-fake-panel-offset-horizontal)*3);
            margin-top: calc(var(--ck-balloon-fake-panel-offset-vertical)*3)
        }

        .ck .ck-balloon-panel_arrow_s+.ck-fake-panel,
        .ck .ck-balloon-panel_arrow_se+.ck-fake-panel,
        .ck .ck-balloon-panel_arrow_sw+.ck-fake-panel {
            --ck-balloon-fake-panel-offset-vertical: -6px
        }

        .ck.ck-sticky-panel .ck-sticky-panel__content_sticky {
            position: fixed;
            top: 0;
            z-index: var(--ck-z-modal)
        }

        .ck.ck-sticky-panel .ck-sticky-panel__content_sticky_bottom-limit {
            position: absolute;
            top: auto
        }

        .ck.ck-sticky-panel .ck-sticky-panel__content_sticky {
            border-top-left-radius: 0;
            border-top-right-radius: 0;
            border-width: 0 1px 1px;
            box-shadow: var(--ck-drop-shadow), 0 0
        }

        .ck.ck-block-toolbar-button {
            position: absolute;
            z-index: var(--ck-z-default)
        }

        :root {
            --ck-color-block-toolbar-button: var(--ck-color-text);
            --ck-block-toolbar-button-size: var(--ck-font-size-normal)
        }

        .ck.ck-block-toolbar-button {
            color: var(--ck-color-block-toolbar-button);
            font-size: var(--ck-block-toolbar-size)
        }

        .ck.ck-editor {
            position: relative
        }

        .ck.ck-editor .ck-editor__top .ck-sticky-panel .ck-toolbar {
            z-index: var(--ck-z-modal)
        }

        .ck.ck-editor__top .ck-sticky-panel .ck-toolbar {
            border-radius: 0
        }

        .ck-rounded-corners .ck.ck-editor__top .ck-sticky-panel .ck-toolbar,
        .ck.ck-editor__top .ck-sticky-panel .ck-toolbar.ck-rounded-corners {
            border-radius: var(--ck-border-radius);
            border-bottom-left-radius: 0;
            border-bottom-right-radius: 0
        }

        .ck.ck-editor__top .ck-sticky-panel .ck-toolbar {
            border-bottom-width: 0
        }

        .ck.ck-editor__top .ck-sticky-panel .ck-sticky-panel__content_sticky .ck-toolbar {
            border-bottom-width: 1px;
            border-radius: 0
        }

        .ck-rounded-corners .ck.ck-editor__top .ck-sticky-panel .ck-sticky-panel__content_sticky .ck-toolbar,
        .ck.ck-editor__top .ck-sticky-panel .ck-sticky-panel__content_sticky .ck-toolbar.ck-rounded-corners {
            border-radius: var(--ck-border-radius);
            border-radius: 0
        }

        .ck.ck-editor__main>.ck-editor__editable {
            background: var(--ck-color-base-background);
            border-radius: 0
        }

        .ck-rounded-corners .ck.ck-editor__main>.ck-editor__editable,
        .ck.ck-editor__main>.ck-editor__editable.ck-rounded-corners {
            border-radius: var(--ck-border-radius);
            border-top-left-radius: 0;
            border-top-right-radius: 0
        }

        .ck.ck-editor__main>.ck-editor__editable:not(.ck-focused) {
            border-color: var(--ck-color-base-border)
        }

        .ck .ck-widget .ck-widget__type-around__button {
            display: block;
            overflow: hidden;
            position: absolute;
            z-index: var(--ck-z-default)
        }

        .ck .ck-widget .ck-widget__type-around__button svg {
            left: 50%;
            position: absolute;
            top: 50%;
            z-index: calc(var(--ck-z-default) + 2)
        }

        .ck .ck-widget .ck-widget__type-around__button.ck-widget__type-around__button_before {
            left: min(10%, 30px);
            top: calc(var(--ck-widget-outline-thickness)*-.5);
            transform: translateY(-50%)
        }

        .ck .ck-widget .ck-widget__type-around__button.ck-widget__type-around__button_after {
            bottom: calc(var(--ck-widget-outline-thickness)*-.5);
            right: min(10%, 30px);
            transform: translateY(50%)
        }

        .ck .ck-widget.ck-widget_selected>.ck-widget__type-around>.ck-widget__type-around__button:after,
        .ck .ck-widget>.ck-widget__type-around>.ck-widget__type-around__button:hover:after {
            content: "";
            display: block;
            left: 1px;
            position: absolute;
            top: 1px;
            z-index: calc(var(--ck-z-default) + 1)
        }

        .ck .ck-widget>.ck-widget__type-around>.ck-widget__type-around__fake-caret {
            display: none;
            left: 0;
            position: absolute;
            right: 0
        }

        .ck .ck-widget:hover>.ck-widget__type-around>.ck-widget__type-around__fake-caret {
            left: calc(var(--ck-widget-outline-thickness)*-1);
            right: calc(var(--ck-widget-outline-thickness)*-1)
        }

        .ck .ck-widget.ck-widget_type-around_show-fake-caret_before>.ck-widget__type-around>.ck-widget__type-around__fake-caret {
            display: block;
            top: calc(var(--ck-widget-outline-thickness)*-1 - 1px)
        }

        .ck .ck-widget.ck-widget_type-around_show-fake-caret_after>.ck-widget__type-around>.ck-widget__type-around__fake-caret {
            bottom: calc(var(--ck-widget-outline-thickness)*-1 - 1px);
            display: block
        }

        .ck.ck-editor__editable.ck-read-only .ck-widget__type-around,
        .ck.ck-editor__editable.ck-restricted-editing_mode_restricted .ck-widget__type-around,
        .ck.ck-editor__editable.ck-widget__type-around_disabled .ck-widget__type-around {
            display: none
        }

        :root {
            --ck-widget-type-around-button-size: 20px;
            --ck-color-widget-type-around-button-active: var(--ck-color-focus-border);
            --ck-color-widget-type-around-button-hover: var(--ck-color-widget-hover-border);
            --ck-color-widget-type-around-button-blurred-editable: var(--ck-color-widget-blurred-border);
            --ck-color-widget-type-around-button-radar-start-alpha: 0;
            --ck-color-widget-type-around-button-radar-end-alpha: .3;
            --ck-color-widget-type-around-button-icon: var(--ck-color-base-background)
        }

        .ck .ck-widget .ck-widget__type-around__button {
            background: var(--ck-color-widget-type-around-button);
            border-radius: 100px;
            height: var(--ck-widget-type-around-button-size);
            opacity: 0;
            pointer-events: none;
            transition: opacity var(--ck-widget-handler-animation-duration) var(--ck-widget-handler-animation-curve), background var(--ck-widget-handler-animation-duration) var(--ck-widget-handler-animation-curve);
            width: var(--ck-widget-type-around-button-size)
        }

        .ck .ck-widget .ck-widget__type-around__button svg {
            height: 8px;
            margin-top: 1px;
            transform: translate(-50%, -50%);
            transition: transform .5s ease;
            width: 10px
        }

        .ck .ck-widget .ck-widget__type-around__button svg * {
            stroke-dasharray: 10;
            stroke-dashoffset: 0;
            fill: none;
            stroke: var(--ck-color-widget-type-around-button-icon);
            stroke-width: 1.5px;
            stroke-linecap: round;
            stroke-linejoin: round
        }

        .ck .ck-widget .ck-widget__type-around__button svg line {
            stroke-dasharray: 7
        }

        .ck .ck-widget .ck-widget__type-around__button:hover {
            animation: ck-widget-type-around-button-sonar 1s ease infinite
        }

        .ck .ck-widget .ck-widget__type-around__button:hover svg polyline {
            animation: ck-widget-type-around-arrow-dash 2s linear
        }

        .ck .ck-widget .ck-widget__type-around__button:hover svg line {
            animation: ck-widget-type-around-arrow-tip-dash 2s linear
        }

        .ck .ck-widget.ck-widget_selected>.ck-widget__type-around>.ck-widget__type-around__button,
        .ck .ck-widget:hover>.ck-widget__type-around>.ck-widget__type-around__button {
            opacity: 1;
            pointer-events: auto
        }

        .ck .ck-widget:not(.ck-widget_selected)>.ck-widget__type-around>.ck-widget__type-around__button {
            background: var(--ck-color-widget-type-around-button-hover)
        }

        .ck .ck-widget.ck-widget_selected>.ck-widget__type-around>.ck-widget__type-around__button,
        .ck .ck-widget>.ck-widget__type-around>.ck-widget__type-around__button:hover {
            background: var(--ck-color-widget-type-around-button-active)
        }

        .ck .ck-widget.ck-widget_selected>.ck-widget__type-around>.ck-widget__type-around__button:after,
        .ck .ck-widget>.ck-widget__type-around>.ck-widget__type-around__button:hover:after {
            background: linear-gradient(135deg, hsla(0, 0%, 100%, 0), hsla(0, 0%, 100%, .3));
            border-radius: 100px;
            height: calc(var(--ck-widget-type-around-button-size) - 2px);
            width: calc(var(--ck-widget-type-around-button-size) - 2px)
        }

        .ck .ck-widget.ck-widget_with-selection-handle>.ck-widget__type-around>.ck-widget__type-around__button_before {
            margin-left: 20px
        }

        .ck .ck-widget .ck-widget__type-around__fake-caret {
            animation: ck-widget-type-around-fake-caret-pulse 1s linear infinite normal forwards;
            background: var(--ck-color-base-text);
            height: 1px;
            outline: 1px solid hsla(0, 0%, 100%, .5);
            pointer-events: none
        }

        .ck .ck-widget.ck-widget_selected.ck-widget_type-around_show-fake-caret_after,
        .ck .ck-widget.ck-widget_selected.ck-widget_type-around_show-fake-caret_before {
            outline-color: transparent
        }

        .ck .ck-widget.ck-widget_type-around_show-fake-caret_after.ck-widget_selected:hover,
        .ck .ck-widget.ck-widget_type-around_show-fake-caret_before.ck-widget_selected:hover {
            outline-color: var(--ck-color-widget-hover-border)
        }

        .ck .ck-widget.ck-widget_type-around_show-fake-caret_after>.ck-widget__type-around>.ck-widget__type-around__button,
        .ck .ck-widget.ck-widget_type-around_show-fake-caret_before>.ck-widget__type-around>.ck-widget__type-around__button {
            opacity: 0;
            pointer-events: none
        }

        .ck .ck-widget.ck-widget_type-around_show-fake-caret_after.ck-widget_selected.ck-widget_with-resizer>.ck-widget__resizer,
        .ck .ck-widget.ck-widget_type-around_show-fake-caret_after.ck-widget_with-selection-handle.ck-widget_selected:hover>.ck-widget__selection-handle,
        .ck .ck-widget.ck-widget_type-around_show-fake-caret_after.ck-widget_with-selection-handle.ck-widget_selected>.ck-widget__selection-handle,
        .ck .ck-widget.ck-widget_type-around_show-fake-caret_before.ck-widget_selected.ck-widget_with-resizer>.ck-widget__resizer,
        .ck .ck-widget.ck-widget_type-around_show-fake-caret_before.ck-widget_with-selection-handle.ck-widget_selected:hover>.ck-widget__selection-handle,
        .ck .ck-widget.ck-widget_type-around_show-fake-caret_before.ck-widget_with-selection-handle.ck-widget_selected>.ck-widget__selection-handle {
            opacity: 0
        }

        .ck[dir=rtl] .ck-widget.ck-widget_with-selection-handle .ck-widget__type-around>.ck-widget__type-around__button_before {
            margin-left: 0;
            margin-right: 20px
        }

        .ck-editor__nested-editable.ck-editor__editable_selected .ck-widget.ck-widget_selected>.ck-widget__type-around>.ck-widget__type-around__button,
        .ck-editor__nested-editable.ck-editor__editable_selected .ck-widget:hover>.ck-widget__type-around>.ck-widget__type-around__button {
            opacity: 0;
            pointer-events: none
        }

        .ck-editor__editable.ck-blurred .ck-widget.ck-widget_selected>.ck-widget__type-around>.ck-widget__type-around__button:not(:hover) {
            background: var(--ck-color-widget-type-around-button-blurred-editable)
        }

        .ck-editor__editable.ck-blurred .ck-widget.ck-widget_selected>.ck-widget__type-around>.ck-widget__type-around__button:not(:hover) svg * {
            stroke: #999
        }

        @keyframes ck-widget-type-around-arrow-dash {
            0% {
                stroke-dashoffset: 10
            }

            20%,
            to {
                stroke-dashoffset: 0
            }
        }

        @keyframes ck-widget-type-around-arrow-tip-dash {

            0%,
            20% {
                stroke-dashoffset: 7
            }

            40%,
            to {
                stroke-dashoffset: 0
            }
        }

        @keyframes ck-widget-type-around-button-sonar {
            0% {
                box-shadow: 0 0 0 0 hsla(var(--ck-color-focus-border-coordinates), var(--ck-color-widget-type-around-button-radar-start-alpha))
            }

            50% {
                box-shadow: 0 0 0 5px hsla(var(--ck-color-focus-border-coordinates), var(--ck-color-widget-type-around-button-radar-end-alpha))
            }

            to {
                box-shadow: 0 0 0 5px hsla(var(--ck-color-focus-border-coordinates), var(--ck-color-widget-type-around-button-radar-start-alpha))
            }
        }

        @keyframes ck-widget-type-around-fake-caret-pulse {
            0% {
                opacity: 1
            }

            49% {
                opacity: 1
            }

            50% {
                opacity: 0
            }

            99% {
                opacity: 0
            }

            to {
                opacity: 1
            }
        }

        :root {
            --ck-color-resizer: var(--ck-color-focus-border);
            --ck-color-resizer-tooltip-background: #262626;
            --ck-color-resizer-tooltip-text: #f2f2f2;
            --ck-resizer-border-radius: var(--ck-border-radius);
            --ck-resizer-tooltip-offset: 10px;
            --ck-resizer-tooltip-height: calc(var(--ck-spacing-small)*2 + 10px)
        }

        .ck .ck-widget,
        .ck .ck-widget.ck-widget_with-selection-handle {
            position: relative
        }

        .ck .ck-widget.ck-widget_with-selection-handle .ck-widget__selection-handle {
            position: absolute
        }

        .ck .ck-widget.ck-widget_with-selection-handle .ck-widget__selection-handle .ck-icon {
            display: block
        }

        .ck .ck-widget.ck-widget_with-selection-handle.ck-widget_selected>.ck-widget__selection-handle,
        .ck .ck-widget.ck-widget_with-selection-handle:hover>.ck-widget__selection-handle {
            visibility: visible
        }

        .ck .ck-size-view {
            background: var(--ck-color-resizer-tooltip-background);
            border: 1px solid var(--ck-color-resizer-tooltip-text);
            border-radius: var(--ck-resizer-border-radius);
            color: var(--ck-color-resizer-tooltip-text);
            display: block;
            font-size: var(--ck-font-size-tiny);
            height: var(--ck-resizer-tooltip-height);
            line-height: var(--ck-resizer-tooltip-height);
            padding: 0 var(--ck-spacing-small)
        }

        .ck .ck-size-view.ck-orientation-above-center,
        .ck .ck-size-view.ck-orientation-bottom-left,
        .ck .ck-size-view.ck-orientation-bottom-right,
        .ck .ck-size-view.ck-orientation-top-left,
        .ck .ck-size-view.ck-orientation-top-right {
            position: absolute
        }

        .ck .ck-size-view.ck-orientation-top-left {
            left: var(--ck-resizer-tooltip-offset);
            top: var(--ck-resizer-tooltip-offset)
        }

        .ck .ck-size-view.ck-orientation-top-right {
            right: var(--ck-resizer-tooltip-offset);
            top: var(--ck-resizer-tooltip-offset)
        }

        .ck .ck-size-view.ck-orientation-bottom-right {
            bottom: var(--ck-resizer-tooltip-offset);
            right: var(--ck-resizer-tooltip-offset)
        }

        .ck .ck-size-view.ck-orientation-bottom-left {
            bottom: var(--ck-resizer-tooltip-offset);
            left: var(--ck-resizer-tooltip-offset)
        }

        .ck .ck-size-view.ck-orientation-above-center {
            left: 50%;
            top: calc(var(--ck-resizer-tooltip-height)*-1);
            transform: translate(-50%)
        }

        :root {
            --ck-widget-outline-thickness: 3px;
            --ck-widget-handler-icon-size: 16px;
            --ck-widget-handler-animation-duration: 200ms;
            --ck-widget-handler-animation-curve: ease;
            --ck-color-widget-blurred-border: #dedede;
            --ck-color-widget-hover-border: #ffc83d;
            --ck-color-widget-editable-focus-background: var(--ck-color-base-background);
            --ck-color-widget-drag-handler-icon-color: var(--ck-color-base-background)
        }

        .ck .ck-widget {
            outline-color: transparent;
            outline-style: solid;
            outline-width: var(--ck-widget-outline-thickness);
            transition: outline-color var(--ck-widget-handler-animation-duration) var(--ck-widget-handler-animation-curve)
        }

        .ck .ck-widget.ck-widget_selected,
        .ck .ck-widget.ck-widget_selected:hover {
            outline: var(--ck-widget-outline-thickness) solid var(--ck-color-focus-border)
        }

        .ck .ck-widget:hover {
            outline-color: var(--ck-color-widget-hover-border)
        }

        .ck .ck-editor__nested-editable {
            border: 1px solid transparent
        }

        .ck .ck-editor__nested-editable.ck-editor__nested-editable_focused,
        .ck .ck-editor__nested-editable:focus {
            background-color: var(--ck-color-widget-editable-focus-background);
            border: var(--ck-focus-ring);
            box-shadow: var(--ck-inner-shadow), 0 0;
            outline: none
        }

        .ck .ck-widget.ck-widget_with-selection-handle .ck-widget__selection-handle {
            background-color: transparent;
            border-radius: var(--ck-border-radius) var(--ck-border-radius) 0 0;
            box-sizing: border-box;
            left: calc(0px - var(--ck-widget-outline-thickness));
            opacity: 0;
            padding: 4px;
            top: 0;
            transform: translateY(-100%);
            transition: background-color var(--ck-widget-handler-animation-duration) var(--ck-widget-handler-animation-curve), visibility var(--ck-widget-handler-animation-duration) var(--ck-widget-handler-animation-curve), opacity var(--ck-widget-handler-animation-duration) var(--ck-widget-handler-animation-curve)
        }

        .ck .ck-widget.ck-widget_with-selection-handle .ck-widget__selection-handle .ck-icon {
            color: var(--ck-color-widget-drag-handler-icon-color);
            height: var(--ck-widget-handler-icon-size);
            width: var(--ck-widget-handler-icon-size)
        }

        .ck .ck-widget.ck-widget_with-selection-handle .ck-widget__selection-handle .ck-icon .ck-icon__selected-indicator {
            opacity: 0;
            transition: opacity .3s var(--ck-widget-handler-animation-curve)
        }

        .ck .ck-widget.ck-widget_with-selection-handle .ck-widget__selection-handle:hover .ck-icon .ck-icon__selected-indicator {
            opacity: 1
        }

        .ck .ck-widget.ck-widget_with-selection-handle:hover>.ck-widget__selection-handle {
            background-color: var(--ck-color-widget-hover-border);
            opacity: 1
        }

        .ck .ck-widget.ck-widget_with-selection-handle.ck-widget_selected:hover>.ck-widget__selection-handle,
        .ck .ck-widget.ck-widget_with-selection-handle.ck-widget_selected>.ck-widget__selection-handle {
            background-color: var(--ck-color-focus-border);
            opacity: 1
        }

        .ck .ck-widget.ck-widget_with-selection-handle.ck-widget_selected:hover>.ck-widget__selection-handle .ck-icon .ck-icon__selected-indicator,
        .ck .ck-widget.ck-widget_with-selection-handle.ck-widget_selected>.ck-widget__selection-handle .ck-icon .ck-icon__selected-indicator {
            opacity: 1
        }

        .ck[dir=rtl] .ck-widget.ck-widget_with-selection-handle .ck-widget__selection-handle {
            left: auto;
            right: calc(0px - var(--ck-widget-outline-thickness))
        }

        .ck.ck-editor__editable.ck-read-only .ck-widget {
            transition: none
        }

        .ck.ck-editor__editable.ck-read-only .ck-widget:not(.ck-widget_selected) {
            --ck-widget-outline-thickness: 0px
        }

        .ck.ck-editor__editable.ck-read-only .ck-widget.ck-widget_with-selection-handle .ck-widget__selection-handle,
        .ck.ck-editor__editable.ck-read-only .ck-widget.ck-widget_with-selection-handle .ck-widget__selection-handle:hover {
            background: var(--ck-color-widget-blurred-border)
        }

        .ck.ck-editor__editable.ck-blurred .ck-widget.ck-widget_selected,
        .ck.ck-editor__editable.ck-blurred .ck-widget.ck-widget_selected:hover {
            outline-color: var(--ck-color-widget-blurred-border)
        }

        .ck.ck-editor__editable.ck-blurred .ck-widget.ck-widget_selected.ck-widget_with-selection-handle:hover>.ck-widget__selection-handle,
        .ck.ck-editor__editable.ck-blurred .ck-widget.ck-widget_selected.ck-widget_with-selection-handle:hover>.ck-widget__selection-handle:hover,
        .ck.ck-editor__editable.ck-blurred .ck-widget.ck-widget_selected.ck-widget_with-selection-handle>.ck-widget__selection-handle,
        .ck.ck-editor__editable.ck-blurred .ck-widget.ck-widget_selected.ck-widget_with-selection-handle>.ck-widget__selection-handle:hover {
            background: var(--ck-color-widget-blurred-border)
        }

        .ck.ck-editor__editable blockquote>.ck-widget.ck-widget_with-selection-handle:first-child,
        .ck.ck-editor__editable>.ck-widget.ck-widget_with-selection-handle:first-child {
            margin-top: calc(1em + var(--ck-widget-handler-icon-size))
        }

        .ck.ck-editor__editable .ck.ck-clipboard-drop-target-position {
            display: inline;
            pointer-events: none;
            position: relative
        }

        .ck.ck-editor__editable .ck.ck-clipboard-drop-target-position span {
            position: absolute;
            width: 0
        }

        .ck.ck-editor__editable .ck-widget:-webkit-drag>.ck-widget__selection-handle,
        .ck.ck-editor__editable .ck-widget:-webkit-drag>.ck-widget__type-around {
            display: none
        }

        :root {
            --ck-clipboard-drop-target-dot-width: 12px;
            --ck-clipboard-drop-target-dot-height: 8px;
            --ck-clipboard-drop-target-color: var(--ck-color-focus-border)
        }

        .ck.ck-editor__editable .ck.ck-clipboard-drop-target-position span {
            background: var(--ck-clipboard-drop-target-color);
            border: 1px solid var(--ck-clipboard-drop-target-color);
            bottom: calc(var(--ck-clipboard-drop-target-dot-height)*-.5);
            margin-left: -1px;
            top: calc(var(--ck-clipboard-drop-target-dot-height)*-.5)
        }

        .ck.ck-editor__editable .ck.ck-clipboard-drop-target-position span:after {
            border-color: var(--ck-clipboard-drop-target-color) transparent transparent transparent;
            border-style: solid;
            border-width: calc(var(--ck-clipboard-drop-target-dot-height)) calc(var(--ck-clipboard-drop-target-dot-width)*.5) 0 calc(var(--ck-clipboard-drop-target-dot-width)*.5);
            content: "";
            display: block;
            height: 0;
            left: 50%;
            position: absolute;
            top: calc(var(--ck-clipboard-drop-target-dot-height)*-.5);
            transform: translateX(-50%);
            width: 0
        }

        .ck.ck-editor__editable .ck-widget.ck-clipboard-drop-target-range {
            outline: var(--ck-widget-outline-thickness) solid var(--ck-clipboard-drop-target-color) !important
        }

        .ck.ck-editor__editable .ck-widget:-webkit-drag {
            zoom: .6;
            outline: none !important
        }

        .ck.ck-heading_heading1 {
            font-size: 20px
        }

        .ck.ck-heading_heading2 {
            font-size: 17px
        }

        .ck.ck-heading_heading3 {
            font-size: 14px
        }

        .ck[class*=ck-heading_heading] {
            font-weight: 700
        }

        .ck.ck-dropdown.ck-heading-dropdown .ck-dropdown__button .ck-button__label {
            width: 8em
        }

        .ck.ck-dropdown.ck-heading-dropdown .ck-dropdown__panel .ck-list__item {
            min-width: 18em
        }

        .ck .ck-widget_with-resizer {
            position: relative
        }

        .ck .ck-widget__resizer {
            display: none;
            left: 0;
            pointer-events: none;
            position: absolute;
            top: 0
        }

        .ck-focused .ck-widget_with-resizer.ck-widget_selected>.ck-widget__resizer {
            display: block
        }

        .ck .ck-widget__resizer__handle {
            pointer-events: all;
            position: absolute
        }

        .ck .ck-widget__resizer__handle.ck-widget__resizer__handle-bottom-right,
        .ck .ck-widget__resizer__handle.ck-widget__resizer__handle-top-left {
            cursor: nwse-resize
        }

        .ck .ck-widget__resizer__handle.ck-widget__resizer__handle-bottom-left,
        .ck .ck-widget__resizer__handle.ck-widget__resizer__handle-top-right {
            cursor: nesw-resize
        }

        :root {
            --ck-resizer-size: 10px;
            --ck-resizer-offset: calc(var(--ck-resizer-size)/-2 - 2px);
            --ck-resizer-border-width: 1px
        }

        .ck .ck-widget__resizer {
            outline: 1px solid var(--ck-color-resizer)
        }

        .ck .ck-widget__resizer__handle {
            background: var(--ck-color-focus-border);
            border: var(--ck-resizer-border-width) solid #fff;
            border-radius: var(--ck-resizer-border-radius);
            height: var(--ck-resizer-size);
            width: var(--ck-resizer-size)
        }

        .ck .ck-widget__resizer__handle.ck-widget__resizer__handle-top-left {
            left: var(--ck-resizer-offset);
            top: var(--ck-resizer-offset)
        }

        .ck .ck-widget__resizer__handle.ck-widget__resizer__handle-top-right {
            right: var(--ck-resizer-offset);
            top: var(--ck-resizer-offset)
        }

        .ck .ck-widget__resizer__handle.ck-widget__resizer__handle-bottom-right {
            bottom: var(--ck-resizer-offset);
            right: var(--ck-resizer-offset)
        }

        .ck .ck-widget__resizer__handle.ck-widget__resizer__handle-bottom-left {
            bottom: var(--ck-resizer-offset);
            left: var(--ck-resizer-offset)
        }

        .ck.ck-text-alternative-form {
            display: flex;
            flex-direction: row;
            flex-wrap: nowrap
        }

        .ck.ck-text-alternative-form .ck-labeled-field-view {
            display: inline-block
        }

        .ck.ck-text-alternative-form .ck-label {
            display: none
        }

        @media screen and (max-width:600px) {
            .ck.ck-text-alternative-form {
                flex-wrap: wrap
            }

            .ck.ck-text-alternative-form .ck-labeled-field-view {
                flex-basis: 100%
            }

            .ck.ck-text-alternative-form .ck-button {
                flex-basis: 50%
            }
        }

        .ck-vertical-form .ck-button:after {
            bottom: -1px;
            content: "";
            position: absolute;
            right: -1px;
            top: -1px;
            width: 0;
            z-index: 1
        }

        .ck-vertical-form .ck-button:focus:after {
            display: none
        }

        @media screen and (max-width:600px) {
            .ck.ck-responsive-form .ck-button:after {
                bottom: -1px;
                content: "";
                position: absolute;
                right: -1px;
                top: -1px;
                width: 0;
                z-index: 1
            }

            .ck.ck-responsive-form .ck-button:focus:after {
                display: none
            }
        }

        .ck-vertical-form>.ck-button:nth-last-child(2):after {
            border-right: 1px solid var(--ck-color-base-border)
        }

        .ck.ck-responsive-form {
            padding: var(--ck-spacing-large)
        }

        .ck.ck-responsive-form:focus {
            outline: none
        }

        [dir=ltr] .ck.ck-responsive-form>:not(:first-child),
        [dir=rtl] .ck.ck-responsive-form>:not(:last-child) {
            margin-left: var(--ck-spacing-standard)
        }

        @media screen and (max-width:600px) {
            .ck.ck-responsive-form {
                padding: 0;
                width: calc(var(--ck-input-width)*.8)
            }

            .ck.ck-responsive-form .ck-labeled-field-view {
                margin: var(--ck-spacing-large) var(--ck-spacing-large) 0
            }

            .ck.ck-responsive-form .ck-labeled-field-view .ck-input-text {
                min-width: 0;
                width: 100%
            }

            .ck.ck-responsive-form .ck-labeled-field-view .ck-labeled-field-view__error {
                white-space: normal
            }

            .ck.ck-responsive-form>.ck-button:nth-last-child(2):after {
                border-right: 1px solid var(--ck-color-base-border)
            }

            .ck.ck-responsive-form>.ck-button:last-child,
            .ck.ck-responsive-form>.ck-button:nth-last-child(2) {
                border-radius: 0;
                margin-top: var(--ck-spacing-large);
                padding: var(--ck-spacing-standard)
            }

            .ck.ck-responsive-form>.ck-button:last-child:not(:focus),
            .ck.ck-responsive-form>.ck-button:nth-last-child(2):not(:focus) {
                border-top: 1px solid var(--ck-color-base-border)
            }

            [dir=ltr] .ck.ck-responsive-form>.ck-button:last-child,
            [dir=ltr] .ck.ck-responsive-form>.ck-button:nth-last-child(2),
            [dir=rtl] .ck.ck-responsive-form>.ck-button:last-child,
            [dir=rtl] .ck.ck-responsive-form>.ck-button:nth-last-child(2) {
                margin-left: 0
            }

            [dir=rtl] .ck.ck-responsive-form>.ck-button:last-child:last-of-type,
            [dir=rtl] .ck.ck-responsive-form>.ck-button:nth-last-child(2):last-of-type {
                border-right: 1px solid var(--ck-color-base-border)
            }
        }

        .ck-content .image {
            clear: both;
            display: table;
            margin: .9em auto;
            min-width: 50px;
            text-align: center
        }

        .ck-content .image img {
            display: block;
            margin: 0 auto;
            max-width: 100%;
            min-width: 100%
        }

        .ck-content .image-inline {
            align-items: flex-start;
            display: inline-flex;
            max-width: 100%
        }

        .ck-content .image-inline picture {
            display: flex
        }

        .ck-content .image-inline img,
        .ck-content .image-inline picture {
            flex-grow: 1;
            flex-shrink: 1;
            max-width: 100%
        }

        .ck.ck-editor__editable .image>figcaption.ck-placeholder:before {
            overflow: hidden;
            padding-left: inherit;
            padding-right: inherit;
            text-overflow: ellipsis;
            white-space: nowrap
        }

        .ck.ck-editor__editable .image-inline.ck-widget_selected,
        .ck.ck-editor__editable .image.ck-widget_selected {
            z-index: 1
        }

        .ck.ck-editor__editable .image-inline.ck-widget_selected ::selection {
            display: none
        }

        .ck.ck-editor__editable td .image-inline img,
        .ck.ck-editor__editable th .image-inline img {
            max-width: none
        }

        .ck.ck-editor__editable .image,
        .ck.ck-editor__editable .image-inline {
            position: relative
        }

        .ck.ck-editor__editable .image .ck-progress-bar,
        .ck.ck-editor__editable .image-inline .ck-progress-bar {
            left: 0;
            position: absolute;
            top: 0
        }

        .ck.ck-editor__editable .image-inline.ck-appear,
        .ck.ck-editor__editable .image.ck-appear {
            animation: fadeIn .7s
        }

        .ck.ck-editor__editable .image .ck-progress-bar,
        .ck.ck-editor__editable .image-inline .ck-progress-bar {
            background: var(--ck-color-upload-bar-background);
            height: 2px;
            transition: width .1s;
            width: 0
        }

        @keyframes fadeIn {
            0% {
                opacity: 0
            }

            to {
                opacity: 1
            }
        }

        .ck-image-upload-complete-icon {
            border-radius: 50%;
            display: block;
            position: absolute;
            right: min(var(--ck-spacing-medium), 6%);
            top: min(var(--ck-spacing-medium), 6%);
            z-index: 1
        }

        .ck-image-upload-complete-icon:after {
            content: "";
            position: absolute
        }

        :root {
            --ck-color-image-upload-icon: #fff;
            --ck-color-image-upload-icon-background: #008a00;
            --ck-image-upload-icon-size: 20;
            --ck-image-upload-icon-width: 2px;
            --ck-image-upload-icon-is-visible: clamp(0px, 100% - 50px, 1px)
        }

        .ck-image-upload-complete-icon {
            animation-delay: 0ms, 3s;
            animation-duration: .5s, .5s;
            animation-fill-mode: forwards, forwards;
            animation-name: ck-upload-complete-icon-show, ck-upload-complete-icon-hide;
            background: var(--ck-color-image-upload-icon-background);
            font-size: calc(1px*var(--ck-image-upload-icon-size));
            height: calc(var(--ck-image-upload-icon-is-visible)*var(--ck-image-upload-icon-size));
            opacity: 0;
            overflow: hidden;
            width: calc(var(--ck-image-upload-icon-is-visible)*var(--ck-image-upload-icon-size))
        }

        .ck-image-upload-complete-icon:after {
            animation-delay: .5s;
            animation-duration: .5s;
            animation-fill-mode: forwards;
            animation-name: ck-upload-complete-icon-check;
            border-right: var(--ck-image-upload-icon-width) solid var(--ck-color-image-upload-icon);
            border-top: var(--ck-image-upload-icon-width) solid var(--ck-color-image-upload-icon);
            box-sizing: border-box;
            height: 0;
            left: 25%;
            opacity: 0;
            top: 50%;
            transform: scaleX(-1) rotate(135deg);
            transform-origin: left top;
            width: 0
        }

        @keyframes ck-upload-complete-icon-show {
            0% {
                opacity: 0
            }

            to {
                opacity: 1
            }
        }

        @keyframes ck-upload-complete-icon-hide {
            0% {
                opacity: 1
            }

            to {
                opacity: 0
            }
        }

        @keyframes ck-upload-complete-icon-check {
            0% {
                height: 0;
                opacity: 1;
                width: 0
            }

            33% {
                height: 0;
                width: .3em
            }

            to {
                height: .45em;
                opacity: 1;
                width: .3em
            }
        }

        .ck .ck-upload-placeholder-loader {
            align-items: center;
            display: flex;
            justify-content: center;
            left: 0;
            position: absolute;
            top: 0
        }

        .ck .ck-upload-placeholder-loader:before {
            content: "";
            position: relative
        }

        :root {
            --ck-color-upload-placeholder-loader: #b3b3b3;
            --ck-upload-placeholder-loader-size: 32px;
            --ck-upload-placeholder-image-aspect-ratio: 2.8
        }

        .ck .ck-image-upload-placeholder {
            margin: 0;
            width: 100%
        }

        .ck .ck-image-upload-placeholder.image-inline {
            width: calc(var(--ck-upload-placeholder-loader-size)*2*var(--ck-upload-placeholder-image-aspect-ratio))
        }

        .ck .ck-image-upload-placeholder img {
            aspect-ratio: var(--ck-upload-placeholder-image-aspect-ratio)
        }

        .ck .ck-upload-placeholder-loader {
            height: 100%;
            width: 100%
        }

        .ck .ck-upload-placeholder-loader:before {
            animation: ck-upload-placeholder-loader 1s linear infinite;
            border-radius: 50%;
            border-right: 2px solid transparent;
            border-top: 3px solid var(--ck-color-upload-placeholder-loader);
            height: var(--ck-upload-placeholder-loader-size);
            width: var(--ck-upload-placeholder-loader-size)
        }

        @keyframes ck-upload-placeholder-loader {
            to {
                transform: rotate(1turn)
            }
        }

        .ck.ck-image-insert-form:focus {
            outline: none
        }

        .ck.ck-form__row {
            display: flex;
            flex-direction: row;
            flex-wrap: nowrap;
            justify-content: space-between
        }

        .ck.ck-form__row>:not(.ck-label) {
            flex-grow: 1
        }

        .ck.ck-form__row.ck-image-insert-form__action-row {
            margin-top: var(--ck-spacing-standard)
        }

        .ck.ck-form__row.ck-image-insert-form__action-row .ck-button-cancel,
        .ck.ck-form__row.ck-image-insert-form__action-row .ck-button-save {
            justify-content: center
        }

        .ck.ck-form__row.ck-image-insert-form__action-row .ck-button .ck-button__label {
            color: var(--ck-color-text)
        }

        .ck.ck-image-insert__panel {
            padding: var(--ck-spacing-large)
        }

        .ck.ck-image-insert__ck-finder-button {
            border: 1px solid #ccc;
            border-radius: var(--ck-border-radius);
            display: block;
            margin: var(--ck-spacing-standard) auto;
            width: 100%
        }

        .ck.ck-splitbutton>.ck-file-dialog-button.ck-button {
            border: none;
            margin: 0;
            padding: 0
        }

        .ck .ck-link_selected {
            background: var(--ck-color-link-selected-background)
        }

        .ck .ck-link_selected span.image-inline {
            outline: var(--ck-widget-outline-thickness) solid var(--ck-color-link-selected-background)
        }

        .ck .ck-fake-link-selection {
            background: var(--ck-color-link-fake-selection)
        }

        .ck .ck-fake-link-selection_collapsed {
            border-right: 1px solid var(--ck-color-base-text);
            height: 100%;
            margin-right: -1px;
            outline: 1px solid hsla(0, 0%, 100%, .5)
        }

        .ck.ck-link-form {
            display: flex
        }

        .ck.ck-link-form .ck-label {
            display: none
        }

        @media screen and (max-width:600px) {
            .ck.ck-link-form {
                flex-wrap: wrap
            }

            .ck.ck-link-form .ck-labeled-field-view {
                flex-basis: 100%
            }

            .ck.ck-link-form .ck-button {
                flex-basis: 50%
            }
        }

        .ck.ck-link-form_layout-vertical {
            display: block
        }

        .ck.ck-link-form_layout-vertical .ck-button.ck-button-cancel,
        .ck.ck-link-form_layout-vertical .ck-button.ck-button-save {
            margin-top: var(--ck-spacing-medium)
        }

        .ck.ck-link-form_layout-vertical {
            min-width: var(--ck-input-width);
            padding: 0
        }

        .ck.ck-link-form_layout-vertical .ck-labeled-field-view {
            margin: var(--ck-spacing-large) var(--ck-spacing-large) var(--ck-spacing-small)
        }

        .ck.ck-link-form_layout-vertical .ck-labeled-field-view .ck-input-text {
            min-width: 0;
            width: 100%
        }

        .ck.ck-link-form_layout-vertical>.ck-button {
            border-radius: 0;
            margin: 0;
            padding: var(--ck-spacing-standard);
            width: 50%
        }

        .ck.ck-link-form_layout-vertical>.ck-button:not(:focus) {
            border-top: 1px solid var(--ck-color-base-border)
        }

        [dir=ltr] .ck.ck-link-form_layout-vertical>.ck-button,
        [dir=rtl] .ck.ck-link-form_layout-vertical>.ck-button {
            margin-left: 0
        }

        [dir=rtl] .ck.ck-link-form_layout-vertical>.ck-button:last-of-type {
            border-right: 1px solid var(--ck-color-base-border)
        }

        .ck.ck-link-form_layout-vertical .ck.ck-list {
            margin: var(--ck-spacing-standard) var(--ck-spacing-large)
        }

        .ck.ck-link-form_layout-vertical .ck.ck-list .ck-button.ck-switchbutton {
            padding: 0;
            width: 100%
        }

        .ck.ck-link-form_layout-vertical .ck.ck-list .ck-button.ck-switchbutton:hover {
            background: none
        }

        .ck.ck-link-actions {
            display: flex;
            flex-direction: row;
            flex-wrap: nowrap
        }

        .ck.ck-link-actions .ck-link-actions__preview {
            display: inline-block
        }

        .ck.ck-link-actions .ck-link-actions__preview .ck-button__label {
            overflow: hidden
        }

        @media screen and (max-width:600px) {
            .ck.ck-link-actions {
                flex-wrap: wrap
            }

            .ck.ck-link-actions .ck-link-actions__preview {
                flex-basis: 100%
            }

            .ck.ck-link-actions .ck-button:not(.ck-link-actions__preview) {
                flex-basis: 50%
            }
        }

        .ck.ck-link-actions .ck-button.ck-link-actions__preview {
            padding-left: 0;
            padding-right: 0
        }

        .ck.ck-link-actions .ck-button.ck-link-actions__preview .ck-button__label {
            color: var(--ck-color-link-default);
            cursor: pointer;
            max-width: var(--ck-input-width);
            min-width: 3em;
            padding: 0 var(--ck-spacing-medium);
            text-align: center;
            text-overflow: ellipsis
        }

        .ck.ck-link-actions .ck-button.ck-link-actions__preview .ck-button__label:hover {
            text-decoration: underline
        }

        .ck.ck-link-actions .ck-button.ck-link-actions__preview,
        .ck.ck-link-actions .ck-button.ck-link-actions__preview:active,
        .ck.ck-link-actions .ck-button.ck-link-actions__preview:focus,
        .ck.ck-link-actions .ck-button.ck-link-actions__preview:hover {
            background: none
        }

        .ck.ck-link-actions .ck-button.ck-link-actions__preview:active {
            box-shadow: none
        }

        .ck.ck-link-actions .ck-button.ck-link-actions__preview:focus .ck-button__label {
            text-decoration: underline
        }

        [dir=ltr] .ck.ck-link-actions .ck-button:not(:first-child),
        [dir=rtl] .ck.ck-link-actions .ck-button:not(:last-child) {
            margin-left: var(--ck-spacing-standard)
        }

        @media screen and (max-width:600px) {
            .ck.ck-link-actions .ck-button.ck-link-actions__preview {
                margin: var(--ck-spacing-standard) var(--ck-spacing-standard) 0
            }

            .ck.ck-link-actions .ck-button.ck-link-actions__preview .ck-button__label {
                max-width: 100%;
                min-width: 0
            }

            [dir=ltr] .ck.ck-link-actions .ck-button:not(.ck-link-actions__preview),
            [dir=rtl] .ck.ck-link-actions .ck-button:not(.ck-link-actions__preview) {
                margin-left: 0
            }
        }

        .ck-source-editing-area {
            overflow: hidden;
            position: relative
        }

        .ck-source-editing-area textarea,
        .ck-source-editing-area:after {
            border: 1px solid transparent;
            font-family: monospace;
            font-size: var(--ck-font-size-normal);
            line-height: var(--ck-line-height-base);
            margin: 0;
            padding: var(--ck-spacing-large);
            white-space: pre-wrap
        }

        .ck-source-editing-area:after {
            content: attr(data-value) " ";
            display: block;
            visibility: hidden
        }

        .ck-source-editing-area textarea {
            border-color: var(--ck-color-base-border);
            border-radius: 0;
            box-sizing: border-box;
            height: 100%;
            outline: none;
            overflow: hidden;
            position: absolute;
            resize: none;
            width: 100%
        }

        .ck-rounded-corners .ck-source-editing-area textarea,
        .ck-source-editing-area textarea.ck-rounded-corners {
            border-radius: var(--ck-border-radius);
            border-top-left-radius: 0;
            border-top-right-radius: 0
        }

        .ck-source-editing-area textarea:not([readonly]):focus {
            border: var(--ck-focus-ring);
            box-shadow: var(--ck-inner-shadow), 0 0;
            outline: none
        }

        :root {
            --ck-color-table-focused-cell-background: rgba(158, 201, 250, .3)
        }

        .ck-widget.table td.ck-editor__nested-editable.ck-editor__nested-editable_focused,
        .ck-widget.table td.ck-editor__nested-editable:focus,
        .ck-widget.table th.ck-editor__nested-editable.ck-editor__nested-editable_focused,
        .ck-widget.table th.ck-editor__nested-editable:focus {
            background: var(--ck-color-table-focused-cell-background);
            border-style: none;
            outline: 1px solid var(--ck-color-focus-border);
            outline-offset: -1px
        }

        .ck .ck-insert-table-dropdown__grid {
            display: flex;
            flex-direction: row;
            flex-wrap: wrap
        }

        :root {
            --ck-insert-table-dropdown-padding: 10px;
            --ck-insert-table-dropdown-box-height: 11px;
            --ck-insert-table-dropdown-box-width: 12px;
            --ck-insert-table-dropdown-box-margin: 1px
        }

        .ck .ck-insert-table-dropdown__grid {
            padding: var(--ck-insert-table-dropdown-padding) var(--ck-insert-table-dropdown-padding) 0;
            width: calc(var(--ck-insert-table-dropdown-box-width)*10 + var(--ck-insert-table-dropdown-box-margin)*20 + var(--ck-insert-table-dropdown-padding)*2)
        }

        .ck .ck-insert-table-dropdown__label {
            text-align: center
        }

        .ck .ck-insert-table-dropdown-grid-box {
            border: 1px solid var(--ck-color-base-border);
            border-radius: 1px;
            margin: var(--ck-insert-table-dropdown-box-margin);
            min-height: var(--ck-insert-table-dropdown-box-height);
            min-width: var(--ck-insert-table-dropdown-box-width);
            outline: none;
            transition: none
        }

        .ck .ck-insert-table-dropdown-grid-box:focus {
            box-shadow: none
        }

        .ck .ck-insert-table-dropdown-grid-box.ck-on {
            background: var(--ck-color-focus-outer-shadow);
            border-color: var(--ck-color-focus-border)
        }

        :root {
            --ck-table-selected-cell-background: rgba(158, 207, 250, .3)
        }

        .ck.ck-editor__editable .table table td.ck-editor__editable_selected,
        .ck.ck-editor__editable .table table th.ck-editor__editable_selected {
            box-shadow: unset;
            caret-color: transparent;
            outline: unset;
            position: relative
        }

        .ck.ck-editor__editable .table table td.ck-editor__editable_selected:after,
        .ck.ck-editor__editable .table table th.ck-editor__editable_selected:after {
            background-color: var(--ck-table-selected-cell-background);
            bottom: 0;
            content: "";
            left: 0;
            pointer-events: none;
            position: absolute;
            right: 0;
            top: 0
        }

        .ck.ck-editor__editable .table table td.ck-editor__editable_selected ::selection,
        .ck.ck-editor__editable .table table td.ck-editor__editable_selected:focus,
        .ck.ck-editor__editable .table table th.ck-editor__editable_selected ::selection,
        .ck.ck-editor__editable .table table th.ck-editor__editable_selected:focus {
            background-color: transparent
        }

        .ck.ck-editor__editable .table table td.ck-editor__editable_selected .ck-widget,
        .ck.ck-editor__editable .table table th.ck-editor__editable_selected .ck-widget {
            outline: unset
        }

        .ck.ck-editor__editable .table table td.ck-editor__editable_selected .ck-widget>.ck-widget__selection-handle,
        .ck.ck-editor__editable .table table th.ck-editor__editable_selected .ck-widget>.ck-widget__selection-handle {
            display: none
        }

        .ck-content .table {
            display: table;
            margin: .9em auto
        }

        .ck-content .table table {
            border: 1px double #b3b3b3;
            border-collapse: collapse;
            border-spacing: 0;
            height: 100%;
            width: 100%
        }

        .ck-content .table table td,
        .ck-content .table table th {
            border: 1px solid #bfbfbf;
            min-width: 2em;
            padding: .4em
        }

        .ck-content .table table th {
            background: rgba(0, 0, 0, .05);
            font-weight: 700
        }

        .ck-content[dir=rtl] .table th {
            text-align: right
        }

        .ck-content[dir=ltr] .table th {
            text-align: left
        }

        .ck-editor__editable .ck-table-bogus-paragraph {
            display: inline-block;
            width: 100%
        }
    </style>
    <style>
        .swal2-popup.swal2-toast {
            box-sizing: border-box;
            grid-column: 1/4 !important;
            grid-row: 1/4 !important;
            grid-template-columns: min-content auto min-content;
            padding: 1em;
            overflow-y: hidden;
            background: #fff;
            box-shadow: 0 0 1px rgba(0, 0, 0, .075), 0 1px 2px rgba(0, 0, 0, .075), 1px 2px 4px rgba(0, 0, 0, .075), 1px 3px 8px rgba(0, 0, 0, .075), 2px 4px 16px rgba(0, 0, 0, .075);
            pointer-events: all
        }

        .swal2-popup.swal2-toast>* {
            grid-column: 2
        }

        .swal2-popup.swal2-toast .swal2-title {
            margin: .5em 1em;
            padding: 0;
            font-size: 1em;
            text-align: initial
        }

        .swal2-popup.swal2-toast .swal2-loading {
            justify-content: center
        }

        .swal2-popup.swal2-toast .swal2-input {
            height: 2em;
            margin: .5em;
            font-size: 1em
        }

        .swal2-popup.swal2-toast .swal2-validation-message {
            font-size: 1em
        }

        .swal2-popup.swal2-toast .swal2-footer {
            margin: .5em 0 0;
            padding: .5em 0 0;
            font-size: .8em
        }

        .swal2-popup.swal2-toast .swal2-close {
            grid-column: 3/3;
            grid-row: 1/99;
            align-self: center;
            width: .8em;
            height: .8em;
            margin: 0;
            font-size: 2em
        }

        .swal2-popup.swal2-toast .swal2-html-container {
            margin: .5em 1em;
            padding: 0;
            overflow: initial;
            font-size: 1em;
            text-align: initial
        }

        .swal2-popup.swal2-toast .swal2-html-container:empty {
            padding: 0
        }

        .swal2-popup.swal2-toast .swal2-loader {
            grid-column: 1;
            grid-row: 1/99;
            align-self: center;
            width: 2em;
            height: 2em;
            margin: .25em
        }

        .swal2-popup.swal2-toast .swal2-icon {
            grid-column: 1;
            grid-row: 1/99;
            align-self: center;
            width: 2em;
            min-width: 2em;
            height: 2em;
            margin: 0 .5em 0 0
        }

        .swal2-popup.swal2-toast .swal2-icon .swal2-icon-content {
            display: flex;
            align-items: center;
            font-size: 1.8em;
            font-weight: bold
        }

        .swal2-popup.swal2-toast .swal2-icon.swal2-success .swal2-success-ring {
            width: 2em;
            height: 2em
        }

        .swal2-popup.swal2-toast .swal2-icon.swal2-error [class^=swal2-x-mark-line] {
            top: .875em;
            width: 1.375em
        }

        .swal2-popup.swal2-toast .swal2-icon.swal2-error [class^=swal2-x-mark-line][class$=left] {
            left: .3125em
        }

        .swal2-popup.swal2-toast .swal2-icon.swal2-error [class^=swal2-x-mark-line][class$=right] {
            right: .3125em
        }

        .swal2-popup.swal2-toast .swal2-actions {
            justify-content: flex-start;
            height: auto;
            margin: 0;
            margin-top: .5em;
            padding: 0 .5em
        }

        .swal2-popup.swal2-toast .swal2-styled {
            margin: .25em .5em;
            padding: .4em .6em;
            font-size: 1em
        }

        .swal2-popup.swal2-toast .swal2-success {
            border-color: #a5dc86
        }

        .swal2-popup.swal2-toast .swal2-success [class^=swal2-success-circular-line] {
            position: absolute;
            width: 1.6em;
            height: 3em;
            transform: rotate(45deg);
            border-radius: 50%
        }

        .swal2-popup.swal2-toast .swal2-success [class^=swal2-success-circular-line][class$=left] {
            top: -0.8em;
            left: -0.5em;
            transform: rotate(-45deg);
            transform-origin: 2em 2em;
            border-radius: 4em 0 0 4em
        }

        .swal2-popup.swal2-toast .swal2-success [class^=swal2-success-circular-line][class$=right] {
            top: -0.25em;
            left: .9375em;
            transform-origin: 0 1.5em;
            border-radius: 0 4em 4em 0
        }

        .swal2-popup.swal2-toast .swal2-success .swal2-success-ring {
            width: 2em;
            height: 2em
        }

        .swal2-popup.swal2-toast .swal2-success .swal2-success-fix {
            top: 0;
            left: .4375em;
            width: .4375em;
            height: 2.6875em
        }

        .swal2-popup.swal2-toast .swal2-success [class^=swal2-success-line] {
            height: .3125em
        }

        .swal2-popup.swal2-toast .swal2-success [class^=swal2-success-line][class$=tip] {
            top: 1.125em;
            left: .1875em;
            width: .75em
        }

        .swal2-popup.swal2-toast .swal2-success [class^=swal2-success-line][class$=long] {
            top: .9375em;
            right: .1875em;
            width: 1.375em
        }

        .swal2-popup.swal2-toast .swal2-success.swal2-icon-show .swal2-success-line-tip {
            animation: swal2-toast-animate-success-line-tip .75s
        }

        .swal2-popup.swal2-toast .swal2-success.swal2-icon-show .swal2-success-line-long {
            animation: swal2-toast-animate-success-line-long .75s
        }

        .swal2-popup.swal2-toast.swal2-show {
            animation: swal2-toast-show .5s
        }

        .swal2-popup.swal2-toast.swal2-hide {
            animation: swal2-toast-hide .1s forwards
        }

        div:where(.swal2-container) {
            display: grid;
            position: fixed;
            z-index: 1060;
            inset: 0;
            box-sizing: border-box;
            grid-template-areas: "top-start     top            top-end" "center-start  center         center-end" "bottom-start  bottom-center  bottom-end";
            grid-template-rows: minmax(min-content, auto) minmax(min-content, auto) minmax(min-content, auto);
            height: 100%;
            padding: .625em;
            overflow-x: hidden;
            transition: background-color .1s;
            -webkit-overflow-scrolling: touch
        }

        div:where(.swal2-container).swal2-backdrop-show,
        div:where(.swal2-container).swal2-noanimation {
            background: rgba(0, 0, 0, .4)
        }

        div:where(.swal2-container).swal2-backdrop-hide {
            background: rgba(0, 0, 0, 0) !important
        }

        div:where(.swal2-container).swal2-top-start,
        div:where(.swal2-container).swal2-center-start,
        div:where(.swal2-container).swal2-bottom-start {
            grid-template-columns: minmax(0, 1fr) auto auto
        }

        div:where(.swal2-container).swal2-top,
        div:where(.swal2-container).swal2-center,
        div:where(.swal2-container).swal2-bottom {
            grid-template-columns: auto minmax(0, 1fr) auto
        }

        div:where(.swal2-container).swal2-top-end,
        div:where(.swal2-container).swal2-center-end,
        div:where(.swal2-container).swal2-bottom-end {
            grid-template-columns: auto auto minmax(0, 1fr)
        }

        div:where(.swal2-container).swal2-top-start>.swal2-popup {
            align-self: start
        }

        div:where(.swal2-container).swal2-top>.swal2-popup {
            grid-column: 2;
            align-self: start;
            justify-self: center
        }

        div:where(.swal2-container).swal2-top-end>.swal2-popup,
        div:where(.swal2-container).swal2-top-right>.swal2-popup {
            grid-column: 3;
            align-self: start;
            justify-self: end
        }

        div:where(.swal2-container).swal2-center-start>.swal2-popup,
        div:where(.swal2-container).swal2-center-left>.swal2-popup {
            grid-row: 2;
            align-self: center
        }

        div:where(.swal2-container).swal2-center>.swal2-popup {
            grid-column: 2;
            grid-row: 2;
            align-self: center;
            justify-self: center
        }

        div:where(.swal2-container).swal2-center-end>.swal2-popup,
        div:where(.swal2-container).swal2-center-right>.swal2-popup {
            grid-column: 3;
            grid-row: 2;
            align-self: center;
            justify-self: end
        }

        div:where(.swal2-container).swal2-bottom-start>.swal2-popup,
        div:where(.swal2-container).swal2-bottom-left>.swal2-popup {
            grid-column: 1;
            grid-row: 3;
            align-self: end
        }

        div:where(.swal2-container).swal2-bottom>.swal2-popup {
            grid-column: 2;
            grid-row: 3;
            justify-self: center;
            align-self: end
        }

        div:where(.swal2-container).swal2-bottom-end>.swal2-popup,
        div:where(.swal2-container).swal2-bottom-right>.swal2-popup {
            grid-column: 3;
            grid-row: 3;
            align-self: end;
            justify-self: end
        }

        div:where(.swal2-container).swal2-grow-row>.swal2-popup,
        div:where(.swal2-container).swal2-grow-fullscreen>.swal2-popup {
            grid-column: 1/4;
            width: 100%
        }

        div:where(.swal2-container).swal2-grow-column>.swal2-popup,
        div:where(.swal2-container).swal2-grow-fullscreen>.swal2-popup {
            grid-row: 1/4;
            align-self: stretch
        }

        div:where(.swal2-container).swal2-no-transition {
            transition: none !important
        }

        div:where(.swal2-container) div:where(.swal2-popup) {
            display: none;
            position: relative;
            box-sizing: border-box;
            grid-template-columns: minmax(0, 100%);
            width: 32em;
            max-width: 100%;
            padding: 0 0 1.25em;
            border: none;
            border-radius: 5px;
            background: #fff;
            color: #545454;
            font-family: inherit;
            font-size: 1rem
        }

        div:where(.swal2-container) div:where(.swal2-popup):focus {
            outline: none
        }

        div:where(.swal2-container) div:where(.swal2-popup).swal2-loading {
            overflow-y: hidden
        }

        div:where(.swal2-container) h2:where(.swal2-title) {
            position: relative;
            max-width: 100%;
            margin: 0;
            padding: .8em 1em 0;
            color: inherit;
            font-size: 1.875em;
            font-weight: 600;
            text-align: center;
            text-transform: none;
            word-wrap: break-word
        }

        div:where(.swal2-container) div:where(.swal2-actions) {
            display: flex;
            z-index: 1;
            box-sizing: border-box;
            flex-wrap: wrap;
            align-items: center;
            justify-content: center;
            width: auto;
            margin: 1.25em auto 0;
            padding: 0
        }

        div:where(.swal2-container) div:where(.swal2-actions):not(.swal2-loading) .swal2-styled[disabled] {
            opacity: .4
        }

        div:where(.swal2-container) div:where(.swal2-actions):not(.swal2-loading) .swal2-styled:hover {
            background-image: linear-gradient(rgba(0, 0, 0, 0.1), rgba(0, 0, 0, 0.1))
        }

        div:where(.swal2-container) div:where(.swal2-actions):not(.swal2-loading) .swal2-styled:active {
            background-image: linear-gradient(rgba(0, 0, 0, 0.2), rgba(0, 0, 0, 0.2))
        }

        div:where(.swal2-container) div:where(.swal2-loader) {
            display: none;
            align-items: center;
            justify-content: center;
            width: 2.2em;
            height: 2.2em;
            margin: 0 1.875em;
            animation: swal2-rotate-loading 1.5s linear 0s infinite normal;
            border-width: .25em;
            border-style: solid;
            border-radius: 100%;
            border-color: #2778c4 rgba(0, 0, 0, 0) #2778c4 rgba(0, 0, 0, 0)
        }

        div:where(.swal2-container) button:where(.swal2-styled) {
            margin: .3125em;
            padding: .625em 1.1em;
            transition: box-shadow .1s;
            box-shadow: 0 0 0 3px rgba(0, 0, 0, 0);
            font-weight: 500
        }

        div:where(.swal2-container) button:where(.swal2-styled):not([disabled]) {
            cursor: pointer
        }

        div:where(.swal2-container) button:where(.swal2-styled).swal2-confirm {
            border: 0;
            border-radius: .25em;
            background: initial;
            background-color: #7066e0;
            color: #fff;
            font-size: 1em
        }

        div:where(.swal2-container) button:where(.swal2-styled).swal2-confirm:focus {
            box-shadow: 0 0 0 3px rgba(112, 102, 224, .5)
        }

        div:where(.swal2-container) button:where(.swal2-styled).swal2-deny {
            border: 0;
            border-radius: .25em;
            background: initial;
            background-color: #dc3741;
            color: #fff;
            font-size: 1em
        }

        div:where(.swal2-container) button:where(.swal2-styled).swal2-deny:focus {
            box-shadow: 0 0 0 3px rgba(220, 55, 65, .5)
        }

        div:where(.swal2-container) button:where(.swal2-styled).swal2-cancel {
            border: 0;
            border-radius: .25em;
            background: initial;
            background-color: #6e7881;
            color: #fff;
            font-size: 1em
        }

        div:where(.swal2-container) button:where(.swal2-styled).swal2-cancel:focus {
            box-shadow: 0 0 0 3px rgba(110, 120, 129, .5)
        }

        div:where(.swal2-container) button:where(.swal2-styled).swal2-default-outline:focus {
            box-shadow: 0 0 0 3px rgba(100, 150, 200, .5)
        }

        div:where(.swal2-container) button:where(.swal2-styled):focus {
            outline: none
        }

        div:where(.swal2-container) button:where(.swal2-styled)::-moz-focus-inner {
            border: 0
        }

        div:where(.swal2-container) div:where(.swal2-footer) {
            justify-content: center;
            margin: 1em 0 0;
            padding: 1em 1em 0;
            border-top: 1px solid #eee;
            color: inherit;
            font-size: 1em
        }

        div:where(.swal2-container) .swal2-timer-progress-bar-container {
            position: absolute;
            right: 0;
            bottom: 0;
            left: 0;
            grid-column: auto !important;
            overflow: hidden;
            border-bottom-right-radius: 5px;
            border-bottom-left-radius: 5px
        }

        div:where(.swal2-container) div:where(.swal2-timer-progress-bar) {
            width: 100%;
            height: .25em;
            background: rgba(0, 0, 0, .2)
        }

        div:where(.swal2-container) img:where(.swal2-image) {
            max-width: 100%;
            margin: 2em auto 1em
        }

        div:where(.swal2-container) button:where(.swal2-close) {
            z-index: 2;
            align-items: center;
            justify-content: center;
            width: 1.2em;
            height: 1.2em;
            margin-top: 0;
            margin-right: 0;
            margin-bottom: -1.2em;
            padding: 0;
            overflow: hidden;
            transition: color .1s, box-shadow .1s;
            border: none;
            border-radius: 5px;
            background: rgba(0, 0, 0, 0);
            color: #ccc;
            font-family: monospace;
            font-size: 2.5em;
            cursor: pointer;
            justify-self: end
        }

        div:where(.swal2-container) button:where(.swal2-close):hover {
            transform: none;
            background: rgba(0, 0, 0, 0);
            color: #f27474
        }

        div:where(.swal2-container) button:where(.swal2-close):focus {
            outline: none;
            box-shadow: inset 0 0 0 3px rgba(100, 150, 200, .5)
        }

        div:where(.swal2-container) button:where(.swal2-close)::-moz-focus-inner {
            border: 0
        }

        div:where(.swal2-container) .swal2-html-container {
            z-index: 1;
            justify-content: center;
            margin: 1em 1.6em .3em;
            padding: 0;
            overflow: auto;
            color: inherit;
            font-size: 1.125em;
            font-weight: normal;
            line-height: normal;
            text-align: center;
            word-wrap: break-word;
            word-break: break-word
        }

        div:where(.swal2-container) input:where(.swal2-input),
        div:where(.swal2-container) input:where(.swal2-file),
        div:where(.swal2-container) textarea:where(.swal2-textarea),
        div:where(.swal2-container) select:where(.swal2-select),
        div:where(.swal2-container) div:where(.swal2-radio),
        div:where(.swal2-container) label:where(.swal2-checkbox) {
            margin: 1em 2em 3px
        }

        div:where(.swal2-container) input:where(.swal2-input),
        div:where(.swal2-container) input:where(.swal2-file),
        div:where(.swal2-container) textarea:where(.swal2-textarea) {
            box-sizing: border-box;
            width: auto;
            transition: border-color .1s, box-shadow .1s;
            border: 1px solid #d9d9d9;
            border-radius: .1875em;
            background: rgba(0, 0, 0, 0);
            box-shadow: inset 0 1px 1px rgba(0, 0, 0, .06), 0 0 0 3px rgba(0, 0, 0, 0);
            color: inherit;
            font-size: 1.125em
        }

        div:where(.swal2-container) input:where(.swal2-input).swal2-inputerror,
        div:where(.swal2-container) input:where(.swal2-file).swal2-inputerror,
        div:where(.swal2-container) textarea:where(.swal2-textarea).swal2-inputerror {
            border-color: #f27474 !important;
            box-shadow: 0 0 2px #f27474 !important
        }

        div:where(.swal2-container) input:where(.swal2-input):focus,
        div:where(.swal2-container) input:where(.swal2-file):focus,
        div:where(.swal2-container) textarea:where(.swal2-textarea):focus {
            border: 1px solid #b4dbed;
            outline: none;
            box-shadow: inset 0 1px 1px rgba(0, 0, 0, .06), 0 0 0 3px rgba(100, 150, 200, .5)
        }

        div:where(.swal2-container) input:where(.swal2-input)::placeholder,
        div:where(.swal2-container) input:where(.swal2-file)::placeholder,
        div:where(.swal2-container) textarea:where(.swal2-textarea)::placeholder {
            color: #ccc
        }

        div:where(.swal2-container) .swal2-range {
            margin: 1em 2em 3px;
            background: #fff
        }

        div:where(.swal2-container) .swal2-range input {
            width: 80%
        }

        div:where(.swal2-container) .swal2-range output {
            width: 20%;
            color: inherit;
            font-weight: 600;
            text-align: center
        }

        div:where(.swal2-container) .swal2-range input,
        div:where(.swal2-container) .swal2-range output {
            height: 2.625em;
            padding: 0;
            font-size: 1.125em;
            line-height: 2.625em
        }

        div:where(.swal2-container) .swal2-input {
            height: 2.625em;
            padding: 0 .75em
        }

        div:where(.swal2-container) .swal2-file {
            width: 75%;
            margin-right: auto;
            margin-left: auto;
            background: rgba(0, 0, 0, 0);
            font-size: 1.125em
        }

        div:where(.swal2-container) .swal2-textarea {
            height: 6.75em;
            padding: .75em
        }

        div:where(.swal2-container) .swal2-select {
            min-width: 50%;
            max-width: 100%;
            padding: .375em .625em;
            background: rgba(0, 0, 0, 0);
            color: inherit;
            font-size: 1.125em
        }

        div:where(.swal2-container) .swal2-radio,
        div:where(.swal2-container) .swal2-checkbox {
            align-items: center;
            justify-content: center;
            background: #fff;
            color: inherit
        }

        div:where(.swal2-container) .swal2-radio label,
        div:where(.swal2-container) .swal2-checkbox label {
            margin: 0 .6em;
            font-size: 1.125em
        }

        div:where(.swal2-container) .swal2-radio input,
        div:where(.swal2-container) .swal2-checkbox input {
            flex-shrink: 0;
            margin: 0 .4em
        }

        div:where(.swal2-container) label:where(.swal2-input-label) {
            display: flex;
            justify-content: center;
            margin: 1em auto 0
        }

        div:where(.swal2-container) div:where(.swal2-validation-message) {
            align-items: center;
            justify-content: center;
            margin: 1em 0 0;
            padding: .625em;
            overflow: hidden;
            background: #f0f0f0;
            color: #666;
            font-size: 1em;
            font-weight: 300
        }

        div:where(.swal2-container) div:where(.swal2-validation-message)::before {
            content: "!";
            display: inline-block;
            width: 1.5em;
            min-width: 1.5em;
            height: 1.5em;
            margin: 0 .625em;
            border-radius: 50%;
            background-color: #f27474;
            color: #fff;
            font-weight: 600;
            line-height: 1.5em;
            text-align: center
        }

        div:where(.swal2-container) .swal2-progress-steps {
            flex-wrap: wrap;
            align-items: center;
            max-width: 100%;
            margin: 1.25em auto;
            padding: 0;
            background: rgba(0, 0, 0, 0);
            font-weight: 600
        }

        div:where(.swal2-container) .swal2-progress-steps li {
            display: inline-block;
            position: relative
        }

        div:where(.swal2-container) .swal2-progress-steps .swal2-progress-step {
            z-index: 20;
            flex-shrink: 0;
            width: 2em;
            height: 2em;
            border-radius: 2em;
            background: #2778c4;
            color: #fff;
            line-height: 2em;
            text-align: center
        }

        div:where(.swal2-container) .swal2-progress-steps .swal2-progress-step.swal2-active-progress-step {
            background: #2778c4
        }

        div:where(.swal2-container) .swal2-progress-steps .swal2-progress-step.swal2-active-progress-step~.swal2-progress-step {
            background: #add8e6;
            color: #fff
        }

        div:where(.swal2-container) .swal2-progress-steps .swal2-progress-step.swal2-active-progress-step~.swal2-progress-step-line {
            background: #add8e6
        }

        div:where(.swal2-container) .swal2-progress-steps .swal2-progress-step-line {
            z-index: 10;
            flex-shrink: 0;
            width: 2.5em;
            height: .4em;
            margin: 0 -1px;
            background: #2778c4
        }

        div:where(.swal2-icon) {
            position: relative;
            box-sizing: content-box;
            justify-content: center;
            width: 5em;
            height: 5em;
            margin: 2.5em auto .6em;
            border: 0.25em solid rgba(0, 0, 0, 0);
            border-radius: 50%;
            border-color: #000;
            font-family: inherit;
            line-height: 5em;
            cursor: default;
            user-select: none
        }

        div:where(.swal2-icon) .swal2-icon-content {
            display: flex;
            align-items: center;
            font-size: 3.75em
        }

        div:where(.swal2-icon).swal2-error {
            border-color: #f27474;
            color: #f27474
        }

        div:where(.swal2-icon).swal2-error .swal2-x-mark {
            position: relative;
            flex-grow: 1
        }

        div:where(.swal2-icon).swal2-error [class^=swal2-x-mark-line] {
            display: block;
            position: absolute;
            top: 2.3125em;
            width: 2.9375em;
            height: .3125em;
            border-radius: .125em;
            background-color: #f27474
        }

        div:where(.swal2-icon).swal2-error [class^=swal2-x-mark-line][class$=left] {
            left: 1.0625em;
            transform: rotate(45deg)
        }

        div:where(.swal2-icon).swal2-error [class^=swal2-x-mark-line][class$=right] {
            right: 1em;
            transform: rotate(-45deg)
        }

        div:where(.swal2-icon).swal2-error.swal2-icon-show {
            animation: swal2-animate-error-icon .5s
        }

        div:where(.swal2-icon).swal2-error.swal2-icon-show .swal2-x-mark {
            animation: swal2-animate-error-x-mark .5s
        }

        div:where(.swal2-icon).swal2-warning {
            border-color: #facea8;
            color: #f8bb86
        }

        div:where(.swal2-icon).swal2-warning.swal2-icon-show {
            animation: swal2-animate-error-icon .5s
        }

        div:where(.swal2-icon).swal2-warning.swal2-icon-show .swal2-icon-content {
            animation: swal2-animate-i-mark .5s
        }

        div:where(.swal2-icon).swal2-info {
            border-color: #9de0f6;
            color: #3fc3ee
        }

        div:where(.swal2-icon).swal2-info.swal2-icon-show {
            animation: swal2-animate-error-icon .5s
        }

        div:where(.swal2-icon).swal2-info.swal2-icon-show .swal2-icon-content {
            animation: swal2-animate-i-mark .8s
        }

        div:where(.swal2-icon).swal2-question {
            border-color: #c9dae1;
            color: #87adbd
        }

        div:where(.swal2-icon).swal2-question.swal2-icon-show {
            animation: swal2-animate-error-icon .5s
        }

        div:where(.swal2-icon).swal2-question.swal2-icon-show .swal2-icon-content {
            animation: swal2-animate-question-mark .8s
        }

        div:where(.swal2-icon).swal2-success {
            border-color: #a5dc86;
            color: #a5dc86
        }

        div:where(.swal2-icon).swal2-success [class^=swal2-success-circular-line] {
            position: absolute;
            width: 3.75em;
            height: 7.5em;
            transform: rotate(45deg);
            border-radius: 50%
        }

        div:where(.swal2-icon).swal2-success [class^=swal2-success-circular-line][class$=left] {
            top: -0.4375em;
            left: -2.0635em;
            transform: rotate(-45deg);
            transform-origin: 3.75em 3.75em;
            border-radius: 7.5em 0 0 7.5em
        }

        div:where(.swal2-icon).swal2-success [class^=swal2-success-circular-line][class$=right] {
            top: -0.6875em;
            left: 1.875em;
            transform: rotate(-45deg);
            transform-origin: 0 3.75em;
            border-radius: 0 7.5em 7.5em 0
        }

        div:where(.swal2-icon).swal2-success .swal2-success-ring {
            position: absolute;
            z-index: 2;
            top: -0.25em;
            left: -0.25em;
            box-sizing: content-box;
            width: 100%;
            height: 100%;
            border: .25em solid rgba(165, 220, 134, .3);
            border-radius: 50%
        }

        div:where(.swal2-icon).swal2-success .swal2-success-fix {
            position: absolute;
            z-index: 1;
            top: .5em;
            left: 1.625em;
            width: .4375em;
            height: 5.625em;
            transform: rotate(-45deg)
        }

        div:where(.swal2-icon).swal2-success [class^=swal2-success-line] {
            display: block;
            position: absolute;
            z-index: 2;
            height: .3125em;
            border-radius: .125em;
            background-color: #a5dc86
        }

        div:where(.swal2-icon).swal2-success [class^=swal2-success-line][class$=tip] {
            top: 2.875em;
            left: .8125em;
            width: 1.5625em;
            transform: rotate(45deg)
        }

        div:where(.swal2-icon).swal2-success [class^=swal2-success-line][class$=long] {
            top: 2.375em;
            right: .5em;
            width: 2.9375em;
            transform: rotate(-45deg)
        }

        div:where(.swal2-icon).swal2-success.swal2-icon-show .swal2-success-line-tip {
            animation: swal2-animate-success-line-tip .75s
        }

        div:where(.swal2-icon).swal2-success.swal2-icon-show .swal2-success-line-long {
            animation: swal2-animate-success-line-long .75s
        }

        div:where(.swal2-icon).swal2-success.swal2-icon-show .swal2-success-circular-line-right {
            animation: swal2-rotate-success-circular-line 4.25s ease-in
        }

        [class^=swal2] {
            -webkit-tap-highlight-color: rgba(0, 0, 0, 0)
        }

        .swal2-show {
            animation: swal2-show .3s
        }

        .swal2-hide {
            animation: swal2-hide .15s forwards
        }

        .swal2-noanimation {
            transition: none
        }

        .swal2-scrollbar-measure {
            position: absolute;
            top: -9999px;
            width: 50px;
            height: 50px;
            overflow: scroll
        }

        .swal2-rtl .swal2-close {
            margin-right: initial;
            margin-left: 0
        }

        .swal2-rtl .swal2-timer-progress-bar {
            right: 0;
            left: auto
        }

        @keyframes swal2-toast-show {
            0% {
                transform: translateY(-0.625em) rotateZ(2deg)
            }

            33% {
                transform: translateY(0) rotateZ(-2deg)
            }

            66% {
                transform: translateY(0.3125em) rotateZ(2deg)
            }

            100% {
                transform: translateY(0) rotateZ(0deg)
            }
        }

        @keyframes swal2-toast-hide {
            100% {
                transform: rotateZ(1deg);
                opacity: 0
            }
        }

        @keyframes swal2-toast-animate-success-line-tip {
            0% {
                top: .5625em;
                left: .0625em;
                width: 0
            }

            54% {
                top: .125em;
                left: .125em;
                width: 0
            }

            70% {
                top: .625em;
                left: -0.25em;
                width: 1.625em
            }

            84% {
                top: 1.0625em;
                left: .75em;
                width: .5em
            }

            100% {
                top: 1.125em;
                left: .1875em;
                width: .75em
            }
        }

        @keyframes swal2-toast-animate-success-line-long {
            0% {
                top: 1.625em;
                right: 1.375em;
                width: 0
            }

            65% {
                top: 1.25em;
                right: .9375em;
                width: 0
            }

            84% {
                top: .9375em;
                right: 0;
                width: 1.125em
            }

            100% {
                top: .9375em;
                right: .1875em;
                width: 1.375em
            }
        }

        @keyframes swal2-show {
            0% {
                transform: scale(0.7)
            }

            45% {
                transform: scale(1.05)
            }

            80% {
                transform: scale(0.95)
            }

            100% {
                transform: scale(1)
            }
        }

        @keyframes swal2-hide {
            0% {
                transform: scale(1);
                opacity: 1
            }

            100% {
                transform: scale(0.5);
                opacity: 0
            }
        }

        @keyframes swal2-animate-success-line-tip {
            0% {
                top: 1.1875em;
                left: .0625em;
                width: 0
            }

            54% {
                top: 1.0625em;
                left: .125em;
                width: 0
            }

            70% {
                top: 2.1875em;
                left: -0.375em;
                width: 3.125em
            }

            84% {
                top: 3em;
                left: 1.3125em;
                width: 1.0625em
            }

            100% {
                top: 2.8125em;
                left: .8125em;
                width: 1.5625em
            }
        }

        @keyframes swal2-animate-success-line-long {
            0% {
                top: 3.375em;
                right: 2.875em;
                width: 0
            }

            65% {
                top: 3.375em;
                right: 2.875em;
                width: 0
            }

            84% {
                top: 2.1875em;
                right: 0;
                width: 3.4375em
            }

            100% {
                top: 2.375em;
                right: .5em;
                width: 2.9375em
            }
        }

        @keyframes swal2-rotate-success-circular-line {
            0% {
                transform: rotate(-45deg)
            }

            5% {
                transform: rotate(-45deg)
            }

            12% {
                transform: rotate(-405deg)
            }

            100% {
                transform: rotate(-405deg)
            }
        }

        @keyframes swal2-animate-error-x-mark {
            0% {
                margin-top: 1.625em;
                transform: scale(0.4);
                opacity: 0
            }

            50% {
                margin-top: 1.625em;
                transform: scale(0.4);
                opacity: 0
            }

            80% {
                margin-top: -0.375em;
                transform: scale(1.15)
            }

            100% {
                margin-top: 0;
                transform: scale(1);
                opacity: 1
            }
        }

        @keyframes swal2-animate-error-icon {
            0% {
                transform: rotateX(100deg);
                opacity: 0
            }

            100% {
                transform: rotateX(0deg);
                opacity: 1
            }
        }

        @keyframes swal2-rotate-loading {
            0% {
                transform: rotate(0deg)
            }

            100% {
                transform: rotate(360deg)
            }
        }

        @keyframes swal2-animate-question-mark {
            0% {
                transform: rotateY(-360deg)
            }

            100% {
                transform: rotateY(0)
            }
        }

        @keyframes swal2-animate-i-mark {
            0% {
                transform: rotateZ(45deg);
                opacity: 0
            }

            25% {
                transform: rotateZ(-25deg);
                opacity: .4
            }

            50% {
                transform: rotateZ(15deg);
                opacity: .8
            }

            75% {
                transform: rotateZ(-5deg);
                opacity: 1
            }

            100% {
                transform: rotateX(0);
                opacity: 1
            }
        }

        body.swal2-shown:not(.swal2-no-backdrop):not(.swal2-toast-shown) {
            overflow: hidden
        }

        body.swal2-height-auto {
            height: auto !important
        }

        body.swal2-no-backdrop .swal2-container {
            background-color: rgba(0, 0, 0, 0) !important;
            pointer-events: none
        }

        body.swal2-no-backdrop .swal2-container .swal2-popup {
            pointer-events: all
        }

        body.swal2-no-backdrop .swal2-container .swal2-modal {
            box-shadow: 0 0 10px rgba(0, 0, 0, .4)
        }

        @media print {
            body.swal2-shown:not(.swal2-no-backdrop):not(.swal2-toast-shown) {
                overflow-y: scroll !important
            }

            body.swal2-shown:not(.swal2-no-backdrop):not(.swal2-toast-shown)>[aria-hidden=true] {
                display: none
            }

            body.swal2-shown:not(.swal2-no-backdrop):not(.swal2-toast-shown) .swal2-container {
                position: static !important
            }
        }

        body.swal2-toast-shown .swal2-container {
            box-sizing: border-box;
            width: 360px;
            max-width: 100%;
            background-color: rgba(0, 0, 0, 0);
            pointer-events: none
        }

        body.swal2-toast-shown .swal2-container.swal2-top {
            inset: 0 auto auto 50%;
            transform: translateX(-50%)
        }

        body.swal2-toast-shown .swal2-container.swal2-top-end,
        body.swal2-toast-shown .swal2-container.swal2-top-right {
            inset: 0 0 auto auto
        }

        body.swal2-toast-shown .swal2-container.swal2-top-start,
        body.swal2-toast-shown .swal2-container.swal2-top-left {
            inset: 0 auto auto 0
        }

        body.swal2-toast-shown .swal2-container.swal2-center-start,
        body.swal2-toast-shown .swal2-container.swal2-center-left {
            inset: 50% auto auto 0;
            transform: translateY(-50%)
        }

        body.swal2-toast-shown .swal2-container.swal2-center {
            inset: 50% auto auto 50%;
            transform: translate(-50%, -50%)
        }

        body.swal2-toast-shown .swal2-container.swal2-center-end,
        body.swal2-toast-shown .swal2-container.swal2-center-right {
            inset: 50% 0 auto auto;
            transform: translateY(-50%)
        }

        body.swal2-toast-shown .swal2-container.swal2-bottom-start,
        body.swal2-toast-shown .swal2-container.swal2-bottom-left {
            inset: auto auto 0 0
        }

        body.swal2-toast-shown .swal2-container.swal2-bottom {
            inset: auto auto 0 50%;
            transform: translateX(-50%)
        }

        body.swal2-toast-shown .swal2-container.swal2-bottom-end,
        body.swal2-toast-shown .swal2-container.swal2-bottom-right {
            inset: auto 0 0 auto
        }
    </style>
    <script type="text/javascript">
        window.hasMobileFirstExtension = true;
    </script>
</head>
