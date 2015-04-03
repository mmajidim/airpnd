<?php
// sendRequest
// note how referer is set manually
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,
        "https://ajax.googleapis.com/ajax/services/feed/load?v=1.0&num=" . 
        BLOG_FEED_COUNT . "&q=".BLOG_URL. "/feeds/posts/default");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

/* Enter the URL of your site here */
curl_setopt($ch, CURLOPT_REFERER,BLOG_URL);
$body = curl_exec($ch);
curl_close($ch);
// now, process the JSON string
$jsonBlogData = json_decode($body);
$posts = $jsonBlogData->responseData->feed->entries;
?>
<div class="box-container-inner container bodyContainer">
    <div class="container-fluid">
        <div class="container ">
            <div class="airspndDivider row-fluid">
                <div class="row-fluid">
                    <div class="span5" >
                        <div class="airspndHeader pull-left">
                            <span> BLOG</span>
                        </div>
                        <div class="airspndHeaderImg pull-left">                        
                        </div>
                    </div>
                </div>
            </div>
            <div class="row-fluid">
                <div class="span10">
                    <?php
                    if(count($posts) >0)
                    foreach($posts as $key=> $post)
                    {
                    ?>
                        <div class="CCRUserCityReviewsDiv">
                            <div class="CCRUserCityReviewsContentDiv">
                                <div class="CCRUserCityReviewsReviewTitle">"<?php echo $post->title; ?>"</div>                        
                                <div class="CCRUserCityReviewsContents">
                                    <p><?php echo $post->content; ?></p>
                                </div>
                                <div class="CityreviewArrowDiv"></div>
                            </div>
                            <div class="CCRUserCityReviewsCarThumbDiv">
                                <div class="CCRUserCityReviewsCarThumb">
                                    <img width="150" height="100" itemprop="image" alt="User" src="resource/images/blogUser.png">
                                </div>
                                <?php
                                    $date = new DateTime($post->publishedDate);
                                ?>
                                <div class="CCROverallReviewsReviewrName"> <span itemprop="name"><?php echo $post->author; ?>, on <?php echo $date->format('m-d-Y'); ?></span> <br>   
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
                <div class="clear clearfix">&nbsp;</div>
            </div>
        </div>
    </div>
</div>