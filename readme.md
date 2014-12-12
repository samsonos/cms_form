#SamsonCMS Generic Form  
 
This module gives abstraction level for working with forms in SamsonCMS environment.
 
[![Latest Stable Version](https://poser.pugx.org/samsonos/cms_form/v/stable.svg)](https://packagist.org/packages/samsonos/cms_form) 
[![Build Status](https://travis-ci.org/samsonos/cms_form.png)](https://travis-ci.org/samsonos/cms_form) 
[![Code Coverage](https://scrutinizer-ci.com/g/samsonos/cms_form/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/samsonos/cms_form/?branch=master)
[![Code Climate](https://codeclimate.com/github/samsonos/cms_form/badges/gpa.svg)](https://codeclimate.com/github/samsonos/cms_form) 
[![Total Downloads](https://poser.pugx.org/samsonos/cms_form/downloads.svg)](https://packagist.org/packages/samsonos/cms_form)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/samsonos/cms_form/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/samsonos/cms_form/?branch=master)

## Adding item to main menu
When UI creates workspace main menu container an ```cms_ui.mainmenu_created``` event is fired. 
Example of how to add custom menu item:
* Subscribe to event
* Add menu item, as you have an access to menu container 

```php
// Subscribe to UI main menu creation event
Event::subscribe('cms_ui.mainmenu_created', array($this, 'mainMenuItem'));

class MyApplication {
    public function mainMenuItem(\samsonos\cms\ui\Menu $menu, \samsonos\cms\ui\UIApplication $ui)
    {
        $menu->add(new MenuItem());
    }
}

```