
<!-- this part of code is taken from the website https://www.chillyfacts.com/dynamic-facebook-share-button-php accessed on- 03-jan-2021-->
<?php
//this link is for taken the url of the current page
$page_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$page_url ="http://kaushalg.com.np" // initializating the page_url variable
?>
<br>
 <div >
 	<!-- This facebook icon is taken from https://www.flaticon.com/svg/static/icons/svg/1312/1312139.svg on 03-jan-2021 -->
 	<h4>Share this News:</h4>
    <a class="sharec" href="http://www.facebook.com/sharer.php?u=<?php echo $page_url ?>" target="_blank"><img height="35px" width="35px" 
                src="https://www.flaticon.com/svg/static/icons/svg/1312/1312139.svg" alt="facebook" />
    </a>
<!-- This twitter icon is taken from https://www.flaticon.com/svg/static/icons/svg/145/145812.svg on 03-jan-2021 -->
    <a class="sharec" href="https://twitter.com/share?url=<?php echo $page_url ?>" target="_blank">
        <img height="35px" width="35px"  src="https://www.flaticon.com/svg/static/icons/svg/145/145812.svg" alt="twitter"/>
    </a>
</div>