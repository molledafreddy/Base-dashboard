<?php

use App\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Site Settings
        factory(Setting::class)->create([
            'setting_group_id' => 1,
            'param' => 'Defaul languaje',
            'key' => snake_case('defaul_languaje'),
            'type' => 'text',
            'value' => 'es'
        ]);

        factory(Setting::class)->create([
            'setting_group_id' => 2,
            'param' => 'Colors',
            'key' => snake_case('color'),
            'type' => 'list',
            'value' => 'blue',
            'options' => 'blue, danger, success, black, warning, purple, pink, blue dark',
        ]);

        factory(Setting::class)->create([
            'setting_group_id' => 3,
            'param' => 'Favicon',
            'key' => snake_case('favicon'),
            'type' => 'image',
            'value' => '/images/settings/favicon.ico'
        ]);

        factory(Setting::class)->create([
            'setting_group_id' => 3,
            'param' => 'Favicon',
            'key' => snake_case('favicon'),
            'type' => 'image',
            'value' => '/images/settings/favicon.ico'
        ]);

        // factory(Setting::class)->create([
        //     'setting_group_id' => 1,
        //     'param' => 'Site Name',
        //     'key' => snake_case('Site Name'),
        //     'type' => 'text',
        //     'value' => 'Carsyagoo'
        // ]);

        // factory(Setting::class)->create([
        //     'setting_group_id' => 1,
        //     'param' => 'Twitter Card',
        //     'key' => snake_case('Twitter Card'),
        //     'type' => 'text'
        // ]);

        // factory(Setting::class)->create([
        //     'setting_group_id' => 1,
        //     'param' => 'Twitter site',
        //     'key' => snake_case('Twitter site'),
        //     'type' => 'text'
        // ]);

        // factory(Setting::class)->create([
        //     'setting_group_id' => 1,
        //     'param' => 'Captcha Site Key',
        //     'key' => snake_case('Captcha Site Key'),
        //     'type' => 'text'
        // ]);

        // factory(Setting::class)->create([
        //     'setting_group_id' => 1,
        //     'param' => 'Captcha Secret Key',
        //     'key' => snake_case('Captcha Secret Key'),
        //     'type' => 'text'
        // ]);

        // factory(Setting::class)->create([
        //     'setting_group_id' => 1,
        //     'param' => 'Captcha Hide Badge',
        //     'key' => snake_case('Captcha Hide Badge'),
        //     'type' => 'boolean',
        //     'value' => null,
        // ]);

        // factory(Setting::class)->create([
        //     'setting_group_id' => 1,
        //     'param' => 'Captcha Data Badge',
        //     'key' => snake_case('Captcha Data Badge'),
        //     'type' => 'list',
        //     'value' => null,
        //     'options' => 'bottomright, bottomleft, inline',
        // ]);

        // factory(Setting::class)->create([
        //     'setting_group_id' => 1,
        //     'param' => 'Captch timeout',
        //     'key' => snake_case('Captch timeout'),
        //     'type' => 'text'
        // ]);

        // factory(Setting::class)->create([
        //     'setting_group_id' => 1,
        //     'param' => 'Captcha Debug',
        //     'key' => snake_case('Captcha Debug'),
        //     'type' => 'boolean',
        //     'value' => null,
        // ]);

        // factory(Setting::class)->create([
        //     'setting_group_id' => 1,
        //     'param' => 'Google API Keys',
        //     'key' => snake_case('Google API Keys'),
        //     'type' => 'text',
        // ]);


        // factory(Setting::class)->create([
        //     'setting_group_id' => 1,
        //     'param' => 'Blog Image',
        //     'key' => snake_case('Blog Image'),
        //     'type' => 'text',
        //     'value' => '/images/blog.jpg',
        // ]);

        // factory(Setting::class)->create([
        //     'setting_group_id' => 1,
        //     'param' => 'Subscribe Image',
        //     'key' => snake_case('Subscribe Image'),
        //     'type' => 'text',
        //     'value' => '/images/subscribe.png',
        // ]);

        // factory(Setting::class)->create([
        //     'setting_group_id' => 1,
        //     'param' => 'Slider 1',
        //     'key' => snake_case('Slider1 '),
        //     'type' => 'text',
        //     'value' => '/assets/images/slider1.jpg',
        // ]);

        // factory(Setting::class)->create([
        //     'setting_group_id' => 2,
        //     'param' => 'Slider 1',
        //     'key' => snake_case('Slider1 '),
        //     'type' => 'text',
        //     'value' => '/assets/images/slider1.jpg',
        // ]);

        // factory(Setting::class)->create([
        //     'setting_group_id' => 1,
        //     'param' => 'Slider 2',
        //     'key' => snake_case('Slider 2'),
        //     'type' => 'text',
        //     'value' => '/assets/images/slider2.jpg',
        // ]);

        // factory(Setting::class)->create([
        //     'setting_group_id' => 1,
        //     'param' => 'Default Image',
        //     'key' => snake_case('Default Image'),
        //     'type' => 'text',
        //     'value' => '/assets/images/default.png',
        // ]);

        // factory(Setting::class)->create([
        //     'setting_group_id' => 1,
        //     'param' => 'Invoice Footer',
        //     'key' => snake_case('Invoice Footer'),
        //     'type' => 'longText',
        //     'value' => 'Loep Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem plugg dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.',
        // ]);

        // factory(Setting::class)->create([
        //     'setting_group_id' => 1,
        //     'param' => 'Welcome Section',
        //     'key' => snake_case('Welcome Section'),
        //     'type' => 'html',
        //     'value' => '<div class="col-md-7">
        //             <h1 class="uppercase strong">Welcome to NissiAutos.com<br><i>Listing portal</i></h1>
        //             <p class="lead">We are the  Cars Listing Systems for <br>easy and quick <span class="accent-color">car buying and selling</span></p>
        //         </div>
        //         <div class="col-md-5">
        //             <p></p>
        //             <p>More than a WebSite we are an <span class="accent-color">Artificial Intelligence System</span> that makes available to the public our <span class="accent-color">Expert Algorithm</span> to find the Best Deals on New and Used cars.</p>
        //         </div>',
        // ]);


        //SEO Settings
        // factory(Setting::class)->create([
        //     'setting_group_id' => 2,
        //     'param' => 'Robots',
        //     'key' => snake_case('Robots'),
        //     'type' => 'list',
        //     'options' => 'Index - Follow, No Index - Follow,Index - No Follow, No Index - No Follow',
        //     'value' => null,
        // ]);

        // factory(Setting::class)->create([
        //     'setting_group_id' => 2,
        //     'param' => 'Site Meta Description',
        //     'key' => snake_case('Site Meta Description'),
        //     'type' => 'longText'
        // ]);

        // factory(Setting::class)->create([
        //     'setting_group_id' => 2,
        //     'param' => 'Site Meta Keywords',
        //     'key' => snake_case('Site Meta Keywords'),
        //     'type' => 'longText'
        // ]);

        // factory(Setting::class)->create([
        //     'setting_group_id' => 2,
        //     'param' => 'Canonical',
        //     'key' => snake_case('Canonical'),
        //     'type' => 'text'
        // ]);

        //Panel 3: Webmaster Tags
        // factory(Setting::class)->create([
        //     'setting_group_id' => 2,
        //     'param' => 'Google Webmaster Tag',
        //     'key' => snake_case('Google Webmaster Tag'),
        //     'type' => 'text',
        // ]);

        // factory(Setting::class)->create([
        //     'setting_group_id' => 3,
        //     'param' => 'Bing Webmaster Tag',
        //     'key' => snake_case('Bing Webmaster Tag'),
        //     'type' => 'text',
        // ]);

        // factory(Setting::class)->create([
        //     'setting_group_id' => 3,
        //     'param' => 'Alexa Webmaster Tag',
        //     'key' => snake_case('Alexa Webmaster Tag'),
        //     'type' => 'text',
        // ]);

        // factory(Setting::class)->create([
        //     'setting_group_id' => 3,
        //     'param' => 'Pinterest Webmaster Tag',
        //     'key' => snake_case('Pinterest Webmaster Tag'),
        //     'type' => 'text',
        // ]);

        // factory(Setting::class)->create([
        //     'setting_group_id' => 3,
        //     'param' => 'Yandex Webmaster Tag',
        //     'key' => snake_case('Yandex Webmaster Tag'),
        //     'type' => 'text',
        // ]);

        // factory(Setting::class)->create([
        //     'setting_group_id' => 3,
        //     'param' => 'Google Analytics Tag',
        //     'key' => snake_case('Google Analytics Tag'),
        //     'type' => 'text',
        // ]);

        //Panel 4: OpenGraph
        // factory(Setting::class)->create([
        //     'setting_group_id' => 2,
        //     'param' => 'Title',
        //     'key' => snake_case('Title'),
        //     'type' => 'text',
        // ]);
        // factory(Setting::class)->create([
        //     'setting_group_id' => 2,
        //     'param' => 'Description',
        //     'key' => snake_case('Description'),
        //     'type' => 'longText',
        // ]);
        // factory(Setting::class)->create([
        //     'setting_group_id' => 2,
        //     'param' => 'URL',
        //     'key' => snake_case('URL'),
        //     'type' => 'text',
        // ]);
        // factory(Setting::class)->create([
        //     'setting_group_id' => 2,
        //     'param' => 'Site Name',
        //     'key' => snake_case('Site Name'),
        //     'type' => 'text',
        // ]);
        // factory(Setting::class)->create([
        //     'setting_group_id' => 2,
        //     'param' => 'Images',
        //     'key' => snake_case('Images'),
        //     'type' => 'text',
        // ]);

        //Panel 1: Email Notify
        // factory(Setting::class)->create([
        //     'setting_group_id' => 5,
        //     'param' => 'From Email',
        //     'key' => snake_case('From Email'),
        //     'type' => 'text',
        //     'value' => 'developer@nissienterprise.com'
        // ]);

        // factory(Setting::class)->create([
        //     'setting_group_id' => 5,
        //     'param' => 'From Name',
        //     'key' => snake_case('From Name'),
        //     'type' => 'text',
        //     'value' => 'Info Carsyagoo'
        // ]);

        // factory(Setting::class)->create([
        //     'setting_group_id' => 5,
        //     'param' => 'Reply to Email',
        //     'key' => snake_case('Reply to Email'),
        //     'type' => 'text',
        // ]);

        // factory(Setting::class)->create([
        //     'setting_group_id' => 5,
        //     'param' => 'SMTP Host',
        //     'key' => snake_case('SMTP Host'),
        //     'type' => 'text',
        // ]);

        // factory(Setting::class)->create([
        //     'setting_group_id' => 5,
        //     'param' => 'SMTP Port',
        //     'key' => snake_case('SMTP Port'),
        //     'type' => 'number',
        //     'value' => 0,
        // ]);

        // factory(Setting::class)->create([
        //     'setting_group_id' => 5,
        //     'param' => 'SMTP Security',
        //     'key' => snake_case('SMTP Security'),
        //     'type' => 'text',
        // ]);

        // factory(Setting::class)->create([
        //     'setting_group_id' => 5,
        //     'param' => 'SMTP Username',
        //     'key' => snake_case('SMTP Username'),
        //     'type' => 'text',
        // ]);

        // factory(Setting::class)->create([
        //     'setting_group_id' => 5,
        //     'param' => 'SMTP Password',
        //     'key' => snake_case('SMTP Password'),
        //     'type' => 'password',
        // ]);

        //Panel 2: Email Notifications
        // factory(Setting::class)->create([
        //     'setting_group_id' => 6,
        //     'param' => 'Notify user me when product is available',
        //     'key' => snake_case('Notify user me when product is available'),
        //     'type' => 'html',
        // ]);

        // factory(Setting::class)->create([
        //     'setting_group_id' => 6,
        //     'param' => 'Notify to Store Manager when the Stock < Stock Minimum',
        //     'key' => snake_case('Notify to Store Manager when the Stock < Stock Minimum'),
        //     'type' => 'html',
        // ]);

        // factory(Setting::class)->create([
        //     'setting_group_id' => 6,
        //     'param' => 'Notify to Store Manager the Sales Report',
        //     'key' => snake_case('Notify to Store Manager the Sales Report'),
        //     'type' => 'html',
        // ]);

        // factory(Setting::class)->create([
        //     'setting_group_id' => 6,
        //     'param' => 'To Store Manager or Registered User when an Order is generated To Store',
        //     'key' => snake_case('To Store Manager or Registered User when an Order is generated To Store'),
        //     'type' => 'html',
        // ]);

        // factory(Setting::class)->create([
        //     'setting_group_id' => 6,
        //     'param' => 'Manager/Registered User when a Back-Order is generated',
        //     'key' => snake_case('Manager/Registered User when a Back-Order is generated'),
        //     'type' => 'html',
        // ]);

        // factory(Setting::class)->create([
        //     'setting_group_id' => 6,
        //     'param' => 'To Store Manager/Registered User when the order change status',
        //     'key' => snake_case('To Store Manager/Registered User when the order change status'),
        //     'type' => 'html',
        // ]);

        // factory(Setting::class)->create([
        //     'setting_group_id' => 6,
        //     'param' => 'To Store Manager when someone make a "Contactus"',
        //     'key' => snake_case('To Store Manager when someone make a "Contactus"'),
        //     'type' => 'html',
        // ]);

        // factory(Setting::class)->create([
        //     'setting_group_id' => 6,
        //     'param' => 'To Store Manager when someone rate the product',
        //     'key' => snake_case('To Store Manager when someone rate the product'),
        //     'type' => 'html',
        // ]);

        // factory(Setting::class)->create([
        //     'setting_group_id' => 6,
        //     'param' => 'To Store Manager when someone ASK a Question About Product',
        //     'key' => snake_case('To Store Manager when someone ASK a Question About Product'),
        //     'type' => 'html',
        // ]);

        // factory(Setting::class)->create([
        //     'setting_group_id' => 6,
        //     'param' => 'Contact Mail',
        //     'key' => snake_case('Contact Mail'),
        //     'type' => 'html',
        //     'value' => '<p>Hi <b>:first_name :last_name</b>, we have received your email</p> <br> <p>You wrote: ":message"</p> <br> <p>Your phone is :phone</p>'
        // ]);

        // factory(Setting::class)->create([
        //     'setting_group_id' => 7,
        //     'param' => 'Cars Years',
        //     'key' => snake_case('Cars Years'),
        //     'type' => 'list',
        //     'options' => '2000, 2001, 2002, 2003, 2004, 2005, 2006, 2007, 2008, 2009, 2010, 2011, 2012, 2013, 2014, 2015, 2016, 2017, 2018, 2019',
        //     'value' => null,
        // ]);

        // factory(Setting::class)->create([
        //     'setting_group_id' => 8,
        //     'param' => 'About',
        //     'key' => snake_case('About'),
        //     'type' => 'html',
        //     'value' => '<h1 style="text-align: center;">About us</h1><div><br></div><div><span style="color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify; background-color: rgb(255, 255, 255);">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</span><br></div><div><span style="color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify; background-color: rgb(255, 255, 255);"><br></span></div><div><span style="color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify; background-color: rgb(255, 255, 255);">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?</span><span style="color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify; background-color: rgb(255, 255, 255);"><br></span></div>',
        // ]);

        // factory(Setting::class)->create([
        //     'setting_group_id' => 8,
        //     'param' => 'Private Police',
        //     'key' => snake_case('Policy'),
        //     'type' => 'html',
        //     'value' => '<h1 style="text-align: center;">Private Police</h1><div><br></div><div><span style="color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify; background-color: rgb(255, 255, 255);">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</span><br></div><div><span style="color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify; background-color: rgb(255, 255, 255);"><br></span></div><div><span style="color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify; background-color: rgb(255, 255, 255);">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?</span><span style="color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify; background-color: rgb(255, 255, 255);"><br></span></div>',
        // ]);
    }
}
