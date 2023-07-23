[![Donate](https://img.shields.io/badge/Donate-PayPal-green.svg?style=for-the-badge)](https://www.paypal.me/quellenform)
[![Latest Stable Version](https://img.shields.io/packagist/v/quellenform/t3x-lib-ical-eventnews?style=for-the-badge)](https://packagist.org/packages/quellenform/t3x-lib-ical-eventnews)
[![TYPO3 11](https://img.shields.io/badge/TYPO3-11-%23f49700.svg?style=for-the-badge)](https://get.typo3.org/version/11)
[![License](https://img.shields.io/packagist/l/quellenform/t3x-lib-ical-eventnews?style=for-the-badge)](https://packagist.org/packages/quellenform/t3x-lib-ical-eventnews)

# iCal Provider for "eventnews"

TYPO3 CMS Extension "lib_ical_eventnews"

## What does it do?

This Extension registers a new iCal-provider for `EXT:lib_ical` which allows you to download events created with `EXT:news` in conjunction with `EXT:eventnews`. Simple use a few lines in your News-Detail-Template to display a link which leads directly to the .ics-file neccessary for calendars.

## Installation/Configuration

1. Install/configure `EXT:news` and `EXT:eventnews`
1. Install this extension with composer or from TER/git
2. Include the following lines in your News-Template:

```html
{namespace ical=Quellenform\LibIcal\ViewHelpers}
<html xmlns:ical="http://typo3.org/ns/Quellenform/LibIcal/ViewHelpers" data-namespace-typo3-fluid="true">
<f:if condition="{newsItem.isEvent}">
    <div class="ics-download">
        <ical:link class="btn btn-primary" provider="eventnews" additionalParams="{uid:newsItem.uid}">
            <span class="glyphicon glyphicon-calendar"></span>
            <f:translate key="download" extensionName="lib_ical" />
        </ical:link>
    </div>
</f:if>
```
