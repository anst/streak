Streak - a text-based blog microframework inspired by Toto.
------------------
>**What is Streak?**   
>>Streak is a text-based blog microframework inspired by [Toto](http://github.com/cloudhead/toto).   
<img src="http://i2.minus.com/iTSHC16g6o8EE.png"/>
> How do I use Streak?
>> It's simple, all you need is PHP 5.3 and above! No other dependencies at all.   

>**Why use Streak?**   
>>1. It's easy to *use*; you just create text files as your post, or use the built in generator.   
>>2. It's easy to *customize*; Streak comes with a basic theme, and the core functions are outlined clearly so you can customize around Streak.
>>3. It's *extensible*; you can view the source code and modify it however you wish, Streak in reality is very simple.
   
>**How do I install/configure/use Streak?**  
>>It's really simple, all you have to do pull the latest source from Github.   
>>```git pull https://github.com/nanocomet/streak.git``` 
>>And open ``` system/config.php ```
>>config.php should look like this:   
>>```php   
$streak_config = [
    "streak_blog_author" => "streaker",
    "streak_blog_name" => "Streak", //your awesome blog name
    "streak_blog_description" => "A PHP blogging framework.", //your awesome blog description
    "streak_url" => "http://streak.com/", //your awesome blog url (your root domain url)
    "streak_url_prefix" => "", //your awesome blog prefix
    "streak_post_extension" => "md", //your awesome blog post extension
    "streak_post_directory" => "posts/", //your awesome blog post directory
    "streak_post_preview_length" => 219, //your awesome blog post preview length
    "streak_disqus_id" => "", //your awesome disqus id (empty for none)
    "streak_enable_markdown" => TRUE, //do you want to enable markdown? TRUE or FALSE
    "streak_enable_sitemap" => FALSE, //NOT IMPLEMENTED YET! do you want to enable automatic sitemap generation (works only when streak is placed in the root of your domain)
];
```  
>>Just simply edit what you'd like, mandatory options that need changing are ```phpstreak_url``` and ```php streak_url_prefix ```  
>>Now that you have everything configured, navigate to your posts folder. You should find two posts, these are your sample posts!   
>>To delete posts, simply remove the file! To add a post, run ```create_post.php``` from CLI or create a file using the following guidelines:    
>>>The file name follows the following format ```YYYY-MM-DD-my-shot-slug-here.extension_i_specified_in_config```. See [XKCD](http://xkcd.com/1179/) for more info on date formatting. If the nomenclature does not follow these guidelines, you could possibly break Streak!   
>>>It is recommended that you use ```create_post.php``` instead of creating the post yourself.   
>>>Inside the file, the first line is reserved for the title of your post, for example:   
>>>```
@My awesome title here!
```   
>>>As you can see the title is prefixed by an @ symbol to let Streak know that it's the title. If you don't include the @ symbol your title will be cut off by one letter!    
>>>After that, you can start typing your regular blog post. If you have markdown enabled, you can use that too.   
>>>Here is an example post:    
>>>```    
@Hello, world. In an old fashioned way.   
Introducting Streak, a blogging framework that uses text files and **markdown** to blog.   
*I love Streaking!*   
```   

>**What's next?**  
>>You can now edit the theme, found in ```theme/```. You'll find 3 files, ```404.html, home.html, and post.html```.   
>>>* 404.html - contains the response if the blog post is not found.  
>>>* home.html - contains the homepage html template, you can edit everything but everything in the content div as those are key to Streak's functionality.     
>>>* post.html - contains the post html template, style this as you wish, but again, avoid editing the content div unless you know what to do.  


If you have any tips/suggestions/complaints/death threats leave them issues page and I'll answer them as quickly as possible.   
Created overnight by nanocomet.