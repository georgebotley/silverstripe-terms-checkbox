# SilverStripe Terms and Conditions Checkbox

Author: George Botley 
Url:    www.botley.me.uk

## Background

A recent project of mine required a checkbox which could link out to an on-site terms and conditions / privacy policy page. This didn't call for downloading any complex modules and could be achieved by extending the pre-existing CheckboxField class. I have shared the one-file solution here in this repo for others to use in their own projects down the line. Hope it helps.

## Requirements

SilverStripe 4

## Installation Instructions

Composer is not required for this as I haven't built this as a module given it's only one field type. 

1. Download a copy of this repository.
2. Upload the `TermsAndConditionsCheckboxField.php` into your SilverStripe installs `app/src` directory. 
3. You may need to run `/dev/build` to get SilverStripe to pick up on the new class.

## Configurable Items

This checkbox field has a few configurable items. 

| Item           | Method          | Accepts | Description                                                                                                                                                                                          |
|----------------|-----------------|---------|------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| Pre Link Text.            | setPreLinkText        | String  | This is the text which appears before the link to the terms page. If not overridden it will default to "I have read and accept the".                                                                 |
| Link Text      | setLinkText     | String  | This is the text used for the link itself. If not overridden it will default to "terms and conditions".                                                                                              |
| Post Link Text | setPostLinkText | String  | This is the text used after the link to the terms page. By default this is blank.                                                                                                                    |
| Terms Page     | setTermsPage    | String  | The UrlSegment of the page to link to on your site. By default this is undefined. Leaving this undefined will simply mean a link will not be used and the link text will be displayed in plain text. |
| New Window     | setNewWindow    | Boolean | Whether or not to open the link in a new window. Defaults to true.                                                                                                                                   |
## Example Usage

```
TermsAndConditionsCheckboxField::create('Terms') // the field title is Terms
    ->setTermsPage('privacy-policy') // will link to /privacy-policy
    ->setPreLinkText('I have read and accept the terms of the') // this will appear before the link
    ->setLinkText('privacy policy'); // this is the text which will be clickable
```
