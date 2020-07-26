-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 25, 2020 at 02:15 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(11) NOT NULL,
  `cat_title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_title`) VALUES
(12, 'Cancer');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `comment_post_id` int(11) NOT NULL,
  `comment_author` varchar(255) NOT NULL,
  `comment_email` varchar(255) NOT NULL,
  `comment_content` text NOT NULL,
  `comment_status` varchar(255) NOT NULL DEFAULT 'unapproved',
  `comment_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(11) NOT NULL,
  `post_cat_id` int(11) NOT NULL,
  `post_title` varchar(255) NOT NULL,
  `post_author` varchar(255) NOT NULL,
  `post_date` date NOT NULL,
  `post_image` text NOT NULL,
  `post_content` text NOT NULL,
  `post_tags` varchar(255) NOT NULL,
  `post_comment_count` int(11) NOT NULL DEFAULT 0,
  `post_status` varchar(255) NOT NULL,
  `post_views_count` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `post_cat_id`, `post_title`, `post_author`, `post_date`, `post_image`, `post_content`, `post_tags`, `post_comment_count`, `post_status`, `post_views_count`) VALUES
(16, 12, 'Getting Ready for Chemo', '1', '2020-07-25', '650x350_get_ready_for_chemo_blog_features.jpg', '<p style=\"box-sizing: border-box; font-family: Chivo, Arial, sans-serif; font-size: 1.6em; background: 0px 0px #ffffff; margin: 0px 0px 26px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; line-height: 24px; color: #3a3b3c;\">Chemo is full of unknowns -- the experience is different for everyone -- so it&rsquo;s impossible to know exactly how chemo will unfold for you. But that doesn&rsquo;t mean it won&rsquo;t help to prepare.</p>\r\n<p style=\"box-sizing: border-box; font-family: Chivo, Arial, sans-serif; font-size: 1.6em; background: 0px 0px #ffffff; margin: 0px 0px 26px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; line-height: 24px; color: #3a3b3c;\">Here are some things that helped me as I went through my own chemo experience:</p>\r\n<p style=\"box-sizing: border-box; font-family: Chivo, Arial, sans-serif; font-size: 1.6em; background: 0px 0px #ffffff; margin: 0px 0px 26px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; line-height: 24px; color: #3a3b3c;\">&nbsp;</p>\r\n<section id=\"page-1\" class=\"page pageview-recorded scrolled-passed\" style=\"box-sizing: border-box; position: relative; color: #3a3b3c; font-family: Lato, Arial, sans-serif; font-size: 10px; background-color: #ffffff;\" data-page-number=\"1\" data-word-count=\"505\" data-page-height=\"852\">\r\n<div class=\"section\" style=\"box-sizing: border-box; font-size: inherit; background: 0px 0px; margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline;\" data-section-id=\"s01\">\r\n<p style=\"box-sizing: border-box; font-family: Chivo, Arial, sans-serif; font-size: 1.6em; background: 0px 0px; margin: 0px 0px 26px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; line-height: 24px;\"><strong style=\"box-sizing: border-box; background: 0px 0px; margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline;\">Pillows, lots of pillows:&nbsp;</strong>Sometimes chemo made me so uncomfortable and achy that regular chairs, couches, and beds seemed like torture devices. Pillows came to the rescue. I felt like&nbsp;<em style=\"box-sizing: border-box; background: 0px 0px; margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline;\">The Princess and the Pea</em>!</p>\r\n<div id=\"remoteCenterAd_rdr\" class=\"ad-5000 icm-ad icm-ad-center\" style=\"box-sizing: border-box; font-size: inherit; background: 0px 0px; margin: 0px 0px 26px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline;\">\r\n<div class=\"centerAd_BG_fmt\" style=\"box-sizing: border-box; font-size: inherit; background: 0px 0px; margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline;\">\r\n<div id=\"ads2-pos-5000-outstream_ad\" class=\"ad_placeholder\" style=\"box-sizing: border-box; font-size: inherit; background: 0px 0px; margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline;\" data-pos=\"5000\" data-sizes=\"[1,2]\" data-google-query-id=\"CMWhqrqs6OoCFYb_cwEdTqwJ7g\">\r\n<div id=\"google_ads_iframe_/4312434/consumer/webmd_0__container__\" style=\"box-sizing: border-box; font-size: inherit; background: 0px 0px; margin: 0px; padding: 0px; border: 0pt none; outline: 0px; vertical-align: baseline; width: 1px; height: 2px;\"></div>\r\n</div>\r\n</div>\r\n</div>\r\n<p style=\"box-sizing: border-box; font-family: Chivo, Arial, sans-serif; font-size: 1.6em; background: 0px 0px; margin: 0px 0px 26px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; line-height: 24px;\"><strong style=\"box-sizing: border-box; background: 0px 0px; margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline;\">Social media:&nbsp;</strong>Chemo can be isolating. I found unbelievable comfort on Facebook -- it felt like I had my own cheering section. When I felt nervous about a procedure or test, dozens of childhood friends, classmates, and colleagues would send me messages of encouragement. It helped me weather the endless days at home alone in pajamas. Facebook may not be your thing. If not, try another platform: Start commenting on a website dedicated to your kind of cancer, or try Twitter or Snapchat or Tumblr. Trust me, it will help you feel less alone. And while, yes, social media does have trolls, in my experience it seemed that angry commenters largely leave cancer patients alone.</p>\r\n<p style=\"box-sizing: border-box; font-family: Chivo, Arial, sans-serif; font-size: 1.6em; background: 0px 0px; margin: 0px 0px 26px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; line-height: 24px;\"><strong style=\"box-sizing: border-box; background: 0px 0px; margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline;\">Movies:&nbsp;</strong>Netflix. Apple TV. HBO. Acorn. Whatever&rsquo;s your pleasure, make sure you have access to movies. There were a lot of days when I didn&rsquo;t make it out of the easy chair. Movies were my saving grace on those days. And as chemo progressed, I became less and less able to focus on reading books or magazines -- again, movies came to the rescue.</p>\r\n<div class=\"bottom-ad-override\" style=\"box-sizing: border-box; font-size: inherit; background: 0px 0px; margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline;\">&nbsp;</div>\r\n<p style=\"box-sizing: border-box; font-family: Chivo, Arial, sans-serif; font-size: 1.6em; background: 0px 0px; margin: 0px 0px 26px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; line-height: 24px;\"><strong style=\"box-sizing: border-box; background: 0px 0px; margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline;\">Enlist a team of friends and family to help you get through it:</strong>&nbsp;My dear friend Sarah came to all my early appointments. She took notes and asked the doctors questions for me. My husband and I were too physically and emotionally exhausted to ask questions effectively, even though we&rsquo;re both journalists who have made a career out of asking questions.</p>\r\n<p style=\"box-sizing: border-box; font-family: Chivo, Arial, sans-serif; font-size: 1.6em; background: 0px 0px; margin: 0px 0px 26px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; line-height: 24px;\">My sister-in-law brought over her famous enchiladas the night after my first infusion. And many other friends and family brought us food as chemo progressed. For each infusion, another friend came to sit with me and my husband. Others set up a collection and handed us a check to cover take-out meals and housework help.</p>\r\n</div>\r\n</section>\r\n<section id=\"page-2\" class=\"page scrolled-passed pageview-recorded\" style=\"box-sizing: border-box; position: relative; color: #3a3b3c; font-family: Lato, Arial, sans-serif; font-size: 10px; background-color: #ffffff;\" data-page-number=\"2\" data-word-count=\"433\" data-page-height=\"728\">\r\n<div class=\"section\" style=\"box-sizing: border-box; font-size: inherit; background: 0px 0px; margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline;\" data-section-id=\"s01\">\r\n<p style=\"box-sizing: border-box; font-family: Chivo, Arial, sans-serif; font-size: 1.6em; background: 0px 0px; margin: 0px 0px 26px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; line-height: 24px;\">There are several web-based programs to help organize your helpers. Check out Lotsa Helping Hands or CaringBridge. If you don&rsquo;t have friends or family nearby, ask your medical team for referrals to local nonprofits and support groups. Don&rsquo;t go it alone. There&rsquo;s help out there. Ask for it.</p>\r\n<p style=\"box-sizing: border-box; font-family: Chivo, Arial, sans-serif; font-size: 1.6em; background: 0px 0px; margin: 0px 0px 26px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; line-height: 24px;\"><strong style=\"box-sizing: border-box; background: 0px 0px; margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline;\">Create a big cancer binder:</strong>&nbsp;Put everything in it: Diagnostic test results, imaging, handouts from your oncologist, important phone numbers, and calendars for treatment and for helpers. Bring it to each appointment. Even in these days of electronic records, it can be helpful to have everything in one place, on paper. Or if you&rsquo;re tech-minded, scan everything and store it on a tablet. Either way, bring that binder or tablet to all your appointments. No matter how great your medical team, sometimes the right hand does not know what the left is doing.</p>\r\n<p style=\"box-sizing: border-box; font-family: Chivo, Arial, sans-serif; font-size: 1.6em; background: 0px 0px; margin: 0px 0px 26px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; line-height: 24px;\"><strong style=\"box-sizing: border-box; background: 0px 0px; margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline;\">Put your finances and your work life in order as much as you can:</strong>&nbsp;You will probably have to take some time off, and perhaps lots of time. Be honest with yourself, and with your work supervisors. Remember that the Americans with Disabilities Act covers cancer. You do not have to disclose your cancer status if you don&rsquo;t wish to do so. But if you think it may affect your job performance, or if you anticipate taking a lot of time off, it might be a good idea.</p>\r\n<p style=\"box-sizing: border-box; font-family: Chivo, Arial, sans-serif; font-size: 1.6em; background: 0px 0px; margin: 0px 0px 26px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; line-height: 24px;\">I didn&rsquo;t work through chemo. I don&rsquo;t think there was any way I could have -- chemo took my brain and replaced it with fuzz. In my case, since I&rsquo;ve been a freelancer for nearly 25 years, there was no &ldquo;boss&rdquo; that I need to tell. But it definitely strained my family&rsquo;s pocketbook.</p>\r\n<p style=\"box-sizing: border-box; font-family: Chivo, Arial, sans-serif; font-size: 1.6em; background: 0px 0px; margin: 0px 0px 26px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; line-height: 24px;\">Cancer can wreak havoc on patients&rsquo; finances. But there are programs out there to help. The Cancer Financial Assistance Coalition can refer you to programs near you. Most big hospitals have financial navigators to help you through the complex world of cancer treatment. If you think cancer may affect you financially, get help as soon as you can, not when you&rsquo;re facing an overwhelming bill.</p>\r\n</div>\r\n<div id=\"lazy-load-ad-2\" class=\"lazy-load-ad\" style=\"box-sizing: border-box; font-size: inherit; background: 0px 0px; margin: 0px 0px 25px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; position: absolute; right: -320px; bottom: 0px; width: 300px; height: auto; text-align: center;\"></div>\r\n</section>\r\n<section id=\"page-3\" class=\"page last scrolled-passed pageview-recorded\" style=\"box-sizing: border-box; position: relative; color: #3a3b3c; font-family: Lato, Arial, sans-serif; font-size: 10px; background-color: #ffffff;\" data-page-number=\"3\" data-word-count=\"178\" data-page-height=\"244\">\r\n<div class=\"section\" style=\"box-sizing: border-box; font-size: inherit; background: 0px 0px; margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline;\" data-section-id=\"s01\">\r\n<p style=\"box-sizing: border-box; font-family: Chivo, Arial, sans-serif; font-size: 1.6em; background: 0px 0px; margin: 0px 0px 26px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; line-height: 24px;\"><strong style=\"box-sizing: border-box; background: 0px 0px; margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline;\">Figure out what makes you happy. Set aside time for that:&nbsp;</strong>Going through chemo is intense. You feel sad, scared, expectant, sick, overwhelmed, often all at once.</p>\r\n<p style=\"box-sizing: border-box; font-family: Chivo, Arial, sans-serif; font-size: 1.6em; background: 0px 0px; margin: 0px 0px 26px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; line-height: 24px;\">You cannot focus on cancer 24/7 or you will go bonkers. Try to do something each day that you really enjoy. I like being outside, and I&rsquo;ve always been a dog person. So I took my dog hiking each day. Of course, the hikes got shorter and shorter as chemo progressed, but they still brought me joy.</p>\r\n<p style=\"box-sizing: border-box; font-family: Chivo, Arial, sans-serif; font-size: 1.6em; background: 0px 0px; margin: 0px 0px 26px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; line-height: 24px;\">So figure out what brings you happiness, and do it as much as you are able. Even in the worst times, you can find good things -- even if they&rsquo;re small.</p>\r\n</div>\r\n</section>', 'Cancer, Chemo', 0, 'published', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `image` text NOT NULL,
  `role` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `first_name`, `last_name`, `email`, `image`, `role`, `token`) VALUES
(1, 'harsh ', '$2y$10$a5nAYFdEIuOXJ2viBoBfvOPOXxhUKNBczDfztjwK8kHUknSa6Sbjm', 'Harsh', 'Kukreja', 'harshkukreja99@gmail.com', 'images.jpg', 'super_admin', ' ');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
