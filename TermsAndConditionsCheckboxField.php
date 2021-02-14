<?php

use SilverStripe\ORM\FieldType\DBField;

/**
 * An extension of the SilverStripe CheckboxField to allow the use of an
 * anchor within the field label. This label will link out to the terms and
 * conditions page or privacy policy as appropriate although could in theory
 * link anywhere within the site (based on URLSegment).
 *
 * Using this field can be as simple as:
 *
 * TermsAndConditionsCheckboxField::create(FieldName)
 *
 * Out of the box that wont link to any page but will show a tick box with the
 * label 'I have read and accept the terms and conditions'. To customise this
 * further you can do this:
 *
 * TermsAndConditionsCheckboxField::create('Terms')
 *  ->setTermsPage('privacy-policy')
 *  ->setPreLinkText('I have read and accept the terms of the')
 *  ->setLinkText('privacy policy')
 *
 * This will change the label to read 'I have read and accept the terms of the
 * privacy policy' with the text 'privacy policy' linking out to the page with
 * a URLSegment of 'privacy-policy'.
 *
 * @author George Botley - botley.me.uk
 */
class TermsAndConditionsCheckboxField extends SilverStripe\Forms\CheckboxField {

    /**
     * The text displayed before the link to the terms and conditions page.
     * @var string
     */
    protected $pre_link_text = 'I have read and accept the';

    /**
     * The text used for the link to the terms and conditions page.
     * @var string
     */
    protected $link_text = 'terms and conditions';

    /**
     * The text displayed after the link to the terms and conditions page.
     * The intention is for this to remain null with the anchor being the
     * final text in the checkbox label. However, some usecases might require
     * a label with text after it.
     *
     * @var string|null
     */
    protected $post_link_text = null;

    /**
     * The page used for the anchor to the terms and conditions page.
     * Default is null. If null the checkbox label will not link to any page
     * and instead show the link text as text only.
     * @var string|null
     */
    protected $terms_page = null;

    /**
     * Whether of not the link opens in a new window.
     * Defaults to yes.
     */
    protected $open_new_window = false;

    /**
     * Sets the URL the link takes people too.
     * @param String $UrlSegment The segment of the page to send people to.
     * @return $this
     */
    public function setTermsPage(String $UrlSegment)
    {
        $this->terms_page = $UrlSegment;
        $this->generateTitle();
        return $this;
    }

    /**
     * Set the text before the link to the terms and conditions page.
     * @param String $text
     * @return $this
     */
    public function setPreLinkText(String $text)
    {
        $this->pre_link_text = $text;
        $this->generateTitle();
        return $this;
    }

    /**
     * Set the link text.
     * @param String $text
     * @return $this
     */
    public function setLinkText(String $text)
    {
        $this->link_text = $text;
        $this->generateTitle();
        return $this;
    }

    /**
     * Set the text after the link, if required.
     * @param String $text
     * @return $this
     */
    public function setPostLinkText(String $text)
    {
        $this->pre_link_text = $text;
        $this->generateTitle();
        return $this;
    }

    /**
     * Set whether to open the link in a new window.
     * @param Boolean $bool
     * @return $this
     */
    public function setNewWindow(Boolean $bool)
    {
        $this->open_new_window = $bool;
        $this->generateTitle();
        return $this;
    }

    /**
     * Generates the title using the properties of this class.
     * @uses SilverStripe\Forms\FormField::setTitle
     */
    private function generateTitle()
    {
        $label = $this->pre_link_text.' ';
        if($this->terms_page) {
            // if a page has been given, create the anchor
            $label.= '<a href="'.$this->terms_page.'"';
            if($this->open_new_window) {
                // if were to open the link in a new window, add target="_blank"
                $label.= ' target="_blank"';
            }
            $label.= '>'.$this->link_text;
            $label.= '</a>';
        } else {
            // else just show the link text as plain text
            $label.= $this->link_text;
        }
        if(!is_null($this->post_link_text)) {
            // if the post link text is not blank, add it our string
            $label.= ' '.$this->post_link_text;
        }
        $label.= '.';
        // set the field title (label). We use DBField here to stop SS escaping it.
        $this->title = DBField::create_field('HTMLFragment', $label);
        return $this;
    }

}
