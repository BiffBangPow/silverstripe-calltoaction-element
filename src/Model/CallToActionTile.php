<?php

namespace BiffBangPow\Element\Model;

use BiffBangPow\Element\CallToActionElement;
use BiffBangPow\Element\MultiCallToActionElement;
use BiffBangPow\Extension\CallToActionExtension;
use BiffBangPow\Extension\SortableExtension;
use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Assets\File;
use SilverStripe\Assets\Image;
use SilverStripe\CMS\Model\SiteTree;
use SilverStripe\Forms\DropdownField;
use SilverStripe\Forms\LiteralField;
use SilverStripe\Forms\TextareaField;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\TreeDropdownField;
use SilverStripe\ORM\DataObject;
use UncleCheese\DisplayLogic\Forms\Wrapper;


class CallToActionTile extends DataObject
{
    private static $table_name = 'CTATile';
    private static $singular_name = 'Call to action tile';
    private static $plural_name = 'Call to action tiles';
    private static $db = [
        'Title' => 'Varchar',
        'Content' => 'Text'
    ];
    private static $has_one = [
        'Image' => Image::class
    ];
    private static $owns = [
        'Image'
    ];
    private static $belongs_many_many = [
        'Element' => CallToActionElement::class
    ];
    private static $extensions = [
        SortableExtension::class,
        CallToActionExtension::class
    ];

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();
        $fields->removeByName(['CTAType', 'ActionID', 'DownloadFile', 'Element']);
        $fields->addFieldsToTab('Root.Main', [
            TextField::create('Title'),
            TextareaField::create('Content'),
            UploadField::create('Image')
                ->setAllowedFileCategories('image/supported')
                ->setFolderName('CTA')
        ]);

        $fields->addFieldsToTab('Root.Main', [
            DropdownField::create('CTAType', 'Call to action type',
                singleton($this->owner->ClassName)->dbObject('CTAType')->enumValues()),
            Wrapper::create(TreeDropdownField::create('ActionID', 'Link to page', SiteTree::class))
                ->displayIf("CTAType")->isEqualTo("Link")->end(),
            TextField::create('LinkAnchor')
                ->setDescription('Anchor to append to the end of the link (do not need to include #)')
                ->displayIf("CTAType")->isEqualTo("Link")->end(),
            UploadField::create('DownloadFile', 'Download File')->setFolderName('Downloads')
                ->displayIf('CTAType')->isEqualTo("Download")->end(),
            TextField::create('LinkData')
                ->setDescription('External link, email address, etc.')
                ->displayIf("CTAType")->isEqualTo("External")
                ->orIf("CTAType")->isEqualTo("Email")->end(),
            TextField::create('LinkText')->displayUnless("CTAType")->isEqualTo("None")->end(),
        ]);        

        return $fields;
    }
}
