-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 06, 2024 at 07:36 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stt_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `authors`
--

CREATE TABLE `authors` (
  `author_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `authors`
--

INSERT INTO `authors` (`author_id`, `name`) VALUES
(35, 'Humayun'),
(41, 'Robindro'),
(10036, 'TOSHIKAZU KAWAGUCHI'),
(10037, 'Agatha Christie\r\n'),
(10038, 'Martin Lings'),
(10039, 'Rainbow Rowell'),
(10040, 'Mitch Albom'),
(10041, 'Anthony Doerr'),
(10042, 'Brianna Wiest'),
(10043, 'John Berendt'),
(10044, 'Gillian Flynn'),
(10045, 'Fyodor Dostoevsky'),
(10046, 'Audrey Niffenegger'),
(10047, '');

-- --------------------------------------------------------

--
-- Table structure for table `billing`
--

CREATE TABLE `billing` (
  `billing_id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `purchase_id` int(11) DEFAULT NULL,
  `town` varchar(200) NOT NULL,
  `status` enum('Processing','Shipped','Delivered') DEFAULT 'Processing'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `billing`
--

INSERT INTO `billing` (`billing_id`, `first_name`, `last_name`, `email`, `phone`, `address`, `purchase_id`, `town`, `status`) VALUES
(6, 'hridoy', 'ahmed', 'hridoyahmedddd@gmail.com', ' 012348765487', 'shahjadpur', 13, 'dhaka', 'Processing'),
(7, 'United', 'University', 'hridoyahmedddd@gmail.com', ' 012348765487', 'shahjadpur', 14, 'dhaka', 'Processing'),
(8, 'United', 'University', 'hridoyahmedddd@gmail.com', ' 012348765487', 'shahjadpur', 15, 'dhaka', 'Processing'),
(9, 'United', 'University', 'hridoyahmedddd@gmail.com', ' 012348765487', 'shahjadpur', 16, 'dhaka', 'Processing'),
(11, 'hridoy', 'ahmed', 'hridoyahmedddd@gmail.com', NULL, 'shahjadpur', 18, 'dhaka', 'Processing'),
(12, 'hridoy', 'ahmed', 'hridoyahmedddd@gmail.com', NULL, 'shahjadpur', 19, 'dhaka', 'Processing'),
(13, 'hridoy', 'ahmed', 'hridoyahmedddd@gmail.com', ' 012348765487', 'shahjadpur', 20, 'dhaka', 'Processing'),
(14, 'hridoy', 'ahmed', 'hridoyahmedddd@gmail.com', ' 012348765487', 'shahjadpur', 21, 'dhaka', 'Processing'),
(15, 'hridoy', 'ahmed', 'hridoyahmedddd@gmail.com', ' 012348765487', 'shahjadpur', 22, 'dhaka', 'Processing'),
(16, 'hridoy', 'ahmed', 'hridoyahmedddd@gmail.com', ' 012348765487', 'shahjadpur', 23, 'dhaka', 'Processing');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `book_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `genre` varchar(100) DEFAULT NULL,
  `isbn` varchar(20) NOT NULL,
  `description` text DEFAULT NULL,
  `publication_date` date DEFAULT NULL,
  `language` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `bookcover` varchar(255) DEFAULT NULL,
  `author_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`book_id`, `title`, `genre`, `isbn`, `description`, `publication_date`, `language`, `created_at`, `bookcover`, `author_id`) VALUES
(1, 'A pocket full of rye', 'Crime', '9780451199867', '\"A Pocket Full of Rye\" is set in England, primarily in the countryside and the city of London. The story revolves around a wealthy businessman, Rex Fortescue, who is poisoned while drinking his morning tea. The subsequent investigation leads to shocking revelations about the Fortescue family and their dark secrets.', '1953-11-03', 'English', '2024-09-14 09:12:16', 'rye.jpeg', 10037),
(2, 'Muhammad', 'Islam', '9781594771538 ', 'Muhammad is an internationally acclaimed, comprehensive, and authoritative account of the life of the prophet. Based on the sira, the eighth- and ninth-century Arabic biographies that recount numerous events in the prophet’s life, it contains original English translations of many important passages that reveal the words of men and women who heard Muhammad speak and witnessed the events of his life.\r\n\r\nScrupulous and exhaustive in its fidelity to its sources, Muhammad: His Life Based on the Earliest Sources is presented in a narrative style that is easily comprehensible, yet authentic and inspiring in its use of language, reflecting both the simplicity and grandeur of the story it tells. This revised edition includes new sections detailing the prophet’s expanding influence and his spreading of the message of Islam into Syria and its neighboring states. It represents the final updates made to the text before the author’s death in 2005. The book has been published in 12 languages and has received numerous awards, including acknowledgment as best biography of the prophet in English at the National Seerate Conference in Islamabad.', '1983-01-01', 'English', '2024-09-14 09:15:56', '08c070f4d_175256.jpg', 10038),
(3, 'Before the coffee gets cold', 'Novel', '9781529029581', 'In a small back alley in Tokyo, there is a café which has been serving carefully brewed coffee for more than one hundred years. But this coffee shop offers its customers a unique experience: the chance to travel back in time.\n\nIn Before the Coffee Gets Cold, we meet four visitors, each of whom is hoping to make use of the café’s time-travelling offer, in order to: confront the man who left them, receive a letter from their husband whose memory has been taken by early onset Alzheimer\'s, to see their sister one last time, and to meet the daughter they never got the chance to know.\n\nBut the journey into the past does not come without risks: customers must sit in a particular seat, they cannot leave the café, and finally, they must return to the present before the coffee gets cold . . .\n\nToshikazu Kawaguchi’s beautiful, moving story explores the age-old question: what would you change if you could travel back in time? More importantly, who would you want to meet, maybe for one last time?', '2024-12-06', 'English', '2024-09-14 09:18:45', 'coffee.jpeg', 10036),
(4, 'Eleanor & Park', 'Novel', '	 9781250012579', '\"Bono met his wife in high school,\" Park says.\r\n\"So did Jerry Lee Lewis,\" Eleanor answers.\r\n\"I\'m not kidding,\" he says.\r\n\"You should be,\" she says, \"we\'re 16.\"\r\n\"What about Romeo and Juliet?\"\r\n\"Shallow, confused, then dead.\"\r\n\"I love you,\" Park says.\r\n\"Wherefore art thou,\" Eleanor answers.\r\n\"I\'m not kidding,\" he says.\r\n\"You should be.\"\r\n\r\nSet over one school year in 1986, Eleanor & Park is the story of two star-crossed misfits—smart enough to know first love almost never lasts, but brave and desperate enough to try.', '2012-04-12', 'English', '2024-09-14 09:21:18', 'park.jpeg', 10039),
(5, 'Tuesdays with Morrie', 'Novel', '0751529818', 'Maybe it was a grandparent, or a teacher or a colleague. Someone older, patient and wise, who understood you when you were young and searching, and gave you sound advice to help you make your way through it. For Mitch Albom, that person was Morrie Schwartz, his college professor from nearly twenty years ago.\r\n\r\nMaybe, like Mitch, you lost track of this mentor as you made your way, and the insights faded. Wouldn\'t you like to see that person again, ask the bigger questions that still haunt you?\r\n\r\nMitch Albom had that second chance. He rediscovered Morrie in the last months of the older man\'s life. Knowing he was dying of ALS - or motor neurone disease - Mitch visited Morrie in his study every Tuesday, just as they used to back in college. Their rekindled relationship turned into one final \'class\': lessons in how to live.', '1997-08-18', 'English', '2024-09-14 09:24:07', '6900.jpg', 10040),
(6, 'All the Light We Cannot See', 'Novel', '	 9781476746586', 'Marie-Laure lives in Paris near the Museum of Natural History, where her father works. When she is twelve, the Nazis occupy Paris and father and daughter flee to the walled citadel of Saint-Malo, where Marie-Laure’s reclusive great uncle lives in a tall house by the sea. With them they carry what might be the museum’s most valuable and dangerous jewel.\r\n\r\nIn a mining town in Germany, Werner Pfennig, an orphan, grows up with his younger sister, enchanted by a crude radio they find that brings them news and stories from places they have never seen or imagined. Werner becomes an expert at building and fixing these crucial new instruments and is enlisted to use his talent to track down the resistance. Deftly interweaving the lives of Marie-Laure and Werner, Doerr illuminates the ways, against all odds, people try to be good to one another.\r\n\r\nFrom the highly acclaimed, multiple award-winning Anthony Doerr, the stunningly beautiful instant New York Times bestseller about a blind French girl and a German boy whose paths collide in occupied France as both try to survive the devastation of World War II.', '2014-05-06', 'English', '2024-09-14 09:29:04', 'All_the_Light_We_Cannot_See_(Doerr_novel).jpg', 10041),
(7, 'The mountain is you', 'Personal Development', '	 B089DQRDSV', 'This is a book about self-sabotage. Why we do it, when we do it, and how to stop doing it—for good. Coexisting but conflicting needs create self-sabotaging behaviors. This is why we resist efforts to change, often until they feel completely futile. But by extracting crucial insight from our most damaging habits, building emotional intelligence by better understanding our brains and bodies, releasing past experiences at a cellular level, and learning to act as our highest potential future selves, we can step out of our own way and into our potential. For centuries, the mountain has been used as a metaphor for the big challenges we face, especially ones that seem impossible to overcome. To scale our mountains, we actually have to do the deep internal work of excavating trauma, building resilience, and adjusting how we show up for the climb. In the end, it is not the mountain we master, but ourselves.', '2020-05-28', 'English', '2024-09-14 09:32:30', '53642699.jpg', 10042),
(8, 'ছায়াবীথি', 'Novel', '9844950058', '**\"Chayabithi\"** is a novel by the renowned Bangladeshi author Humayun Ahmed. The story revolves around the main character, Naila, who is a typical housewife. She lives with her husband, Zaman, and their two-year-old son, Babu. Their life is going smoothly until the arrival of Alam, which creates turmoil in Naila\'s life. She finds herself increasingly drawn towards Alam, leading to growing unrest in her household¹².\r\n\r\n\r\n\r\n', '1990-02-01', 'Bangla', '2024-09-14 09:42:59', 'chay.jpeg', 35),
(9, 'মেঘ বলেছে যাব যাব ', 'Drama', '9789844150515', 'মেঘ বলেছে যাবো।আকাশের মেঘেরা কি কথা বলে? তারা কি যেতে চায় কোথাও? তারা কোথায় যেতে চায়? বর্ষান ঘন কালো আকাশের দিকে তাকিয়ে চিত্রলেখার হঠাৎ এই কথা মনে হল। দশ-বার বছরের কিশোরীর মনে এর রকম একটা চিন্তা আসতে পারে, চিত্রলেখার বয়স পঁচিশ। এ রকম উদ্ভট তার জন্যে স্বাভাবিক নয়। তবুও কেন জানি নিজেকে তার মেঘের মতো মনে হয়। তার কোথায় জানি যেতে ইচ্ছা করে। এ রকম ইচ্ছা তো সব মানুষেরই কবে। সব মানুষের ভেতরই কি তাহলে এক টুকরা মেঘ ঢুকে আছে, যে কেবলি কোথাও যেতে চায়?', '1997-02-01', 'Bangla', '2024-09-14 09:47:25', NULL, 35),
(10, 'In Cold Blood', 'Crime', '9780679745587', 'It details the 1959 murders of four members of the Clutter family in the small farming community of Holcomb, Kansas', '1966-09-18', 'English', '2024-09-18 11:57:10', 'In Cold Blood.jpg', NULL),
(11, 'Midnight in the Garden of Good and evila', 'Crime', '9780679643418', 'The story of Jim Williams, an antiques dealer on trial for the killing of Danny Hansford', '1994-01-10', 'English', '2024-09-18 11:57:10', 'Midnight in the Garden of Good and evil.jpg', 10043),
(14, 'Dark Places \r\n', 'Crime', '9780307341570', 'The novel deals with class issues in rural America, intense poverty and the Satanic cult hysteria that swept the United States in the 1980s', '1866-07-09', 'English', '2024-09-18 12:16:52', 'Dark Places.jpg', 10044),
(15, 'Crime and Punishments \r\n', 'Crime', '9780553898088', 'Crime and Punishment is the excruciatingly-detailed psycho-epic about the murder of a pawn shop owner (and her sister).', '1866-04-01', 'English', '2024-09-18 12:25:04', 'Crime and Punishments.jpg \r\n', 10045),
(16, 'The Time Traveler\'s Wife \r\n', 'Crime', '0578889412', 'It is a love story about Henry, a man with a genetic disorder that causes him to time travel unpredictably, and about Clare, his wife, an artist who has to cope with his frequent absences.', '2003-10-22', 'English', '2024-09-18 12:30:07', 'The Time Traveler\'s Wife.jpg', 10046),
(17, '11/22/63 ', 'Time Travel', '97814447272796', 'This is a story about time travel, about survival in a strange, unknown world, about knowing how to adapt to a whole new situation.\r\nAbout a time traveler who attempts to prevent the assassination of United States President John F. Kennedy, which occurred on November 22, 1963. It is the 60th book published by Stephen King, his 49th novel and the 42nd under his own name.', '1963-11-22', 'English', '2024-09-18 12:44:57', 'Book', NULL),
(18, 'বেলা ফুরাবার আগে', 'Islamic', '9789849484400', 'বইটি মূলত নিজেকে আবিষ্কারের একটি আয়না। বইটিতে লেখক কোরআন ও হাদিসের আলোকে ১৬টি ট্রপিকের মাধ্যমে দ্বীন ভুলে বিলাসিতায় গা ভাসিয়ে দেওয়া তরুণদেরকে যেমন সতর্ক করেছেন অপরদিকে যারা সঠিক গন্তব্যের উদ্দেশ্য দ্বীনের পথ আঁকড়ে আছেন তাদের অনুপ্রেরণা জুগিয়েছেন।', '2020-02-04', 'Bangla', '2024-09-18 13:00:40', 'বেলা ফুরাবার আগে.jpg', NULL),
(19, 'জীবন যেখানে যেমন', 'Islamic', '9789849548997', 'জীবনের পরতে পরতে ছড়িয়ে ছিটিয়ে থাকা গল্পগুলােকে লেখক তুলে এনেছেন তার শৈল্পিক রং-তুলিতে। আলো থেকে স্ফুরিত হওয়া সেই অসাধারণ গল্পগুলো যেমন জীবনের কথা বলে, তেমনই জীবনে রেখে যায় বিশ্বাসী মূল্যবােধের গভীর এক ছাপ।', '2021-09-10', 'Bangla', '2024-09-18 13:00:40', 'জীবন যেখানে যেমন.jpg', NULL),
(20, 'পদ্মজা ', 'Novel', '9789849831938', 'আমি পদ্মজা উপন্যাসের মূল কাহিনী হল একটি গ্রাম্য মেয়ের সামাজিক ও পারিবারিক প্রতিবন্ধকতা অতিক্রম করে আত্মপ্রতিষ্ঠার সংগ্রাম। ', '2024-02-15', 'Bangla', '2024-09-19 09:02:31', 'পদ্মজা.jpeg', 35),
(21, 'দেয়াল', 'Novel', '9789845021272', 'দেয়াল বাংলাদেশের প্রখ্যাত ঔপন্যাসিক হুমায়ূন আহমেদের লেখা একটি ইতিহাসাশ্রয়ী উপন্যাস যার ভিত্তি মুক্তিযুদ্ধ পরবর্তী বাংলাদেশের রাজনৈতিক ও সামাজিক প্রেক্ষাপট। এটি তার রচিত সর্বশেষ উপন্যাস যা তার মৃত্যুর এক বছর পর গ্রন্থাকারে প্রকাশিত হয়।', '2021-09-10', 'Bangla', '2024-09-19 09:02:31', 'দেয়াল.jpg', 35),
(22, 'শেষ বিকেলের মেয়ে', 'Novel', '9789844042698', 'বাংলা সাহিত্যে প্রেম নিয়ে রচিত উপাখ্যানগুলোর মধ্যে \'শেষ বিকেলের মেয়ে\' পাঠক প্রিয়তার শীর্ষের দিকে অবস্থান করছে।', '2017-01-01', 'Bangla', '2024-09-19 09:12:50', 'শেষ বিকেলের মেয়ে.jpg', 35),
(32, 'অপেক্ষা ', 'Novel', '9847016600173', 'উপন্যাসটিতে একইসাথে মধ্যবিত্তের টানাপোড়েন এবং প্রিয় মানুষের প্রতি অকৃত্রিম ভালোবাসার নিদর্শন ফুটিয়ে তোলা হয়েছে। ', '1997-12-03', 'Bangla', '2024-09-19 11:15:38', 'অপেক্ষা.jpeg', 35),
(33, 'সে এসে বসুক পাশে', 'Novel', '9789849734048', 'তুমি জীবন জুড়ে যত বেশি ভালো স্মৃতি তৈরি করতে পারবে, তত বেশি ওই নোনা ধরা খারাপ মেমোরিজগুলো ঝাপসা হয়ে যেতে থাকবে। ক্ষতগুলো শুকিয়ে যেতে থাকবে।', '2023-03-09', 'Bangla', '2024-09-19 11:15:38', 'সে এসে বসুক পাশে.jpeg', 35),
(34, 'তোমার নামে সন্ধ্যা নামে', 'Novel', '9789845027342', 'আমাকে হারাতে দিলে নিখোঁজ বিজ্ঞপ্তিতে ছেয়ে যাবে তোমার শহর।', '2020-01-01', 'Bangla', '2024-09-19 11:15:38', 'তোমার নামে সন্ধ্যা নামে.jpeg', 35),
(35, 'রাহে বেলায়াত', 'Islamic', '9789849005315', 'ফরয পালনের পাশাপাশি অবিরত নফল ইবাদত করার মাধ্যমে বান্দা তার প্রভুর নৈকট্য ও প্রেম অর্জন করে। এ বইটিতে সংক্ষেপে আত্মশুদ্ধি ও বেলায়াতের এ পথ সম্পর্কে এবং বিস্তারিতভাবে নফল ইবাদত সম্পর্কে সুস্পষ্ট ধারণা দেওয়া হয়েছে।', '2013-01-01', 'Bangla', '2024-09-19 11:15:38', 'রাহে বেলায়াত.jpg', NULL),
(36, 'হায়াতের দিন ফুরোলে', 'Islamic', '9789849859161', 'বইটির কেন্দ্রীয় চরিত্র সাজিদ বিভিন্ন কথোপকথনের মধ্যে তার নাস্তিক বন্ধুর অবিশ্বাসকে বিজ্ঞানসম্মত নানা যুক্তিতর্কের মাধ্যমে খণ্ডন করে। আর এসব কথোপকথনের মধ্য দিয়েই বইটিতে অবিশ্বাসীদের অনেক যুক্তি খণ্ডন করেছেন লেখক। বইটি প্রকাশের পরপরই তুমুল জনপ্রিয়তা পায়। এটি ইংরেজি ও অসমীয়া ভাষায় অনূদিতও হয়েছে।', '2024-02-08', 'Bangla', '2024-09-19 11:40:08', 'হায়াতের দিন ফুরোলে.jpg', NULL),
(37, 'আর রাহীকুল মাখতূম বা মোহরাঙ্কিত জান্নাতী সুধা', 'Islamic', '9789848766064', 'আর্‌-রাহীকুল মাখতূম (আরবি/উর্দূতে: الرحيق المختوم ; অর্থ: মোহরাঙ্কিত জান্নাতী সুধা) আরবি এবং উর্দু ভাষায় সফিউর রহমান মোবারকপুরী রচিত মুসলমানদের নবী মুহাম্মদ সাঃ এর জীবনীগ্রন্থ। আধুনিক যুগে ইসলামের নবী মুহাম্মদ সাঃ এর জীবনী নিয়ে আরবি ভাষায় লেখা অন্যতম একটি সিরাত গ্রন্থ।', '1987-09-11', 'Bangla', '2024-09-19 11:40:08', 'আর রাহীকুল মাখতূম বা মোহরাঙ্কিত জান্নাতী সুধা.jpg', NULL),
(38, 'মহিমান্বিত কুরআন', 'Islamic', '978-984-8046-40-1', 'The Meaning of the Glorious Koran (1930) হল মারমাডুক পিকথাল দ্বারা সূরাগুলির সংক্ষিপ্ত ভূমিকা সহ কুরআনের একটি ইংরেজি ভাষায় অনুবাদ । 1928 সালে, পিকথাল তার কুরআনের অর্থের অনুবাদ সম্পূর্ণ করার জন্য দুই বছরের বিশ্রাম নিয়েছিলেন, একটি কাজ যেটিকে তিনি তার কৃতিত্বের শীর্ষ বলে মনে করেছিলেন।', '1930-09-10', 'Arbi-Bangla', '2024-09-19 11:40:08', 'মহিমান্বিত কুরআন.jpg', NULL),
(39, 'কুরআন সুন্নাহর আলোকে ইসলামী আকীদা ', 'Islamic', '9789849328100', 'ইমান ও আকীদা বিষয়ক সুন্দর একটি বই। নিখাদ ঈমাণ আল্লাহর সন্তুষ্টি অর্জন এবং জান্নাত লাভের পূর্বশর্ত। ', '2017-12-01', 'Bangla', '2024-09-19 11:40:08', 'কুরআন সুন্নাহর আলোকে ইসলামী আকীদা.jpg ', NULL),
(40, 'কুরআন-সুন্নাহর আলোকে পোশাক, পর্দা ও দেহ-সজ্জা', 'Islamic', '9789849328155', 'বইয়ের সংক্ষিপ্ত কথা : পোশাক-পরিচ্ছদ মানুষের জীবনের অবিচ্ছেদ্য ও সার্বক্ষণিক বিষয়। তাদের দৃষ্টিতে মহিলাদের ক্ষেত্রে শরীর অনাবৃত করাই নারী- স্বাধীনতার প্রকাশ, তবে পুরুষ-স্বাধীনতার প্রকাশ তার দেহ পুরোপুরি আবৃত করা।', '2007-09-04', 'Arabic-Bangla', '2024-09-19 11:40:08', 'কুরআন-সুন্নাহর আলোকে পোশাক, পর্দা ও দেহ-সজ্জা.jpg', NULL),
(41, 'কালার কোডেড উচ্চারণ ও অনুবাদ সহ সহজ কোরআন - এনি কালার', 'Islamic', '9798350717525', 'এই বইটিতে আমলের ১৩টি ফজিলতপূর্ণ সূরাসহ সহজ ৪৭টি সূরা যা কালার কোডেড উচ্চারণ ও অনুবাদসহ দেয়া হয়েছে। যা পাঠকদের কাছে অধিক গ্রহণযোগ্যতা পাবে।', '2020-09-02', 'Arabic-Bangla', '2024-09-19 12:47:39', 'কালার কোডেড উচ্চারণ ও অনুবাদ সহ সহজ কোরআন - এনি কালার.jpg', NULL),
(42, 'তাদাব্বুরে কুরআন (কুরআন বোঝার রাজপথে আপনার প্রথম স্বপ্নযাত্রা)', 'Islamic', '9789849406654 ', '৫২০ পৃষ্টার ৩০ পারা কুরআনের ১১৪টি সূরা নিয়েই বইটি রচিত অর্থাৎ সম্পুর্ণ কুরআনের ফাহম ও তাদাব্বুর। মূল পাঠে যাওয়ার আগে এবং পরের বিষয় নিয়ে মোট ১২৩ পাঠে সাবলীলভাবে সাজানো।', '2022-11-02', 'Bangla', '2024-09-19 12:47:39', 'তাদাব্বুরে কুরআন (কুরআন বোঝার রাজপথে আপনার প্রথম স্বপ্নযাত্রা).jpg', NULL),
(43, 'জেগে ওঠো আবার', 'Islamic', '9789849859185', 'এমন প্রশ্ন নিশ্চয়ই আপনার মনে হামেশাই ঘুরপাক খায়। আপনার এই সবগুলো প্রশ্নের উত্তর পেয়ে যাবেন \'জেগে ওঠো আবার বইটির পাতা ওলটালে।', '2024-05-08', 'Bangla', '2024-09-19 12:47:39', 'জেগে ওঠো আবার.jpg', NULL),
(44, 'তারাবীহর সালাতে কুরআনের বার্তা', 'Islamic', '8996700000001', 'আমাদের দেশে প্রায় সব মসজিদে সাতাশ তারাবীহতে কুরআন খতমের প্রচলন আছে। সে হিসেবে প্রতিদিনের তারাবীহতে পঠিতব্য অংশের ঘটনাবলি, ঈমান-আকীদা, আদেশ-নিষেধ, হালাল-হারাম, দৃষ্টান্ত, দোয়া এবং গুরুত্বপূর্ণ আয়াতসমূহের নির্যাস তুলে ধরা হয়েছে এই বইয়ে।', '2024-05-09', 'Bangla', '2024-09-19 12:47:39', 'তারাবীহর সালাতে কুরআনের বার্তা.png', NULL),
(45, 'সহিহভাবে কুরআন শিক্ষা তাজওইদ', 'Islamic', '9789843435507', 'পৃথিবীর সবচে শ্রেষ্ঠ গ্রন্থ হলো পবিত্র কুরআনুল কারীম। আর এই গ্রন্থ সহিহ ও শুদ্ধভাবে পড়ার মাধ্যম হলো তাজওইদ সম্পর্কে অবগত থাকা।', '2023-02-23', 'Bangla', '2024-09-19 12:47:39', 'সহিহভাবে কুরআন শিক্ষা তাজওইদ.jpeg', NULL),
(46, 'সিরাজদ্দৌলা ', 'Drama', '9788129509505', 'নবাব মির্জা মুহম্মদ সিরাজউদ্দৌলা (ফার্সি: مرزا محمد سراج الدوله; ১৭৩৩ – ২ জুলাই ১৭৫৭) ছিলেন বাংলা-বিহার-ওড়িশার শেষ স্বাধীন নবাব। তিনি ১৭৫৬ থেকে ১৭৫৭ সাল পর্যন্ত রাজত্ব করেছিলেন। তাঁর রাজত্বের সমাপ্তির পর বাংলা এবং পরবর্তীতে প্রায় সমগ্র ভারতীয় উপমহাদেশের উপর ইস্ট ইন্ডিয়া কোম্পানির শাসনের সূচনা হয়।', '1965-11-12', 'Bangla', '2024-09-19 12:58:25', 'সিরাজদ্দৌলা.jpeg', NULL),
(47, 'রক্তাক্ত প্রান্তর', 'Drama', '9789848899202', 'যে কাহিনীর ভিত্তিতে মুনীর চৌধুরীর \'রক্তাক্ত প্রান্তর\' লেখা. কায়কোবাদের বক্তব্য থেকে দেখা যাচ্ছে, একটা চ্যালেঞ্জ নিয়েই তিনি কাব্য-সাধনায় যুক্ত হয়েছিলেন।', '1991-06-19', 'Bangla', '2024-09-19 12:58:25', 'রক্তাক্ত প্রান্তর.jpg', NULL),
(48, 'রক্তকরবী ', 'Drama', '9848261591', 'রবীন্দ্রনাথের তত্ত্ব-আশ্রয়ী সাংকেতিক নাটকগুলোর মধ্যে \'রক্তকরবী\' অন্যতম। \'রক্তকবরী\' প্রকাশিত হয় ১৯১৬ সালে। এটি তাঁর এক অসাধারণ প্রতীক নাটক, বিশ্বের যে কোন একখানি শ্রেষ্ঠ প্রতীক নাটকের সমকক্ষ। এত রবীন্দ্রনাথ আধুনিক সমস্যার আর একটি উৎকট দিককে একটি অপরূপ প্রতীকতার মধ্যদিয়ে ব্যক্ত করেছেন।', '1926-09-16', 'Bangla', '2024-09-19 13:13:04', 'রক্তকরবী.png', NULL),
(49, 'সালাহ উদ্দীন\'স মাস্টার ক্লাস', 'Sports', '9789849741183', ' ২৫ বছরের কোচিং ক্যারিয়ারে মোহাম্মদ সালাউদ্দিন কাজ করেছেন তিন প্রজন্মের সঙ্গে।', '2023-06-21', 'Bangla', '2024-09-19 13:13:04', 'সালাহ উদ্দীন\'স মাস্টার ক্লাস.jpeg', NULL),
(50, 'ডোপামিন ডিটক্স', 'Motivational', '9789849642688', 'যেসব গুরুত্বপূর্ণ বিষয় জীবনকে উন্নত করতে পারে, সেগুলো কি আপনার ভেতরে কোনো উত্তেজনা সৃষ্টি করে না? যদি ব্যাপারটা এমনই হয়, তাহলে সম্ভবতঃ আপনার ডোপামিন ডিটক্সের প্রয়োজন। ', '2023-07-25', 'Bangla', '2024-09-19 13:13:04', 'ডোপামিন ডিটক্স.jpg', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bookshelf_pdfs`
--

CREATE TABLE `bookshelf_pdfs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `book_title` varchar(255) NOT NULL,
  `writer` varchar(255) NOT NULL,
  `genre` varchar(100) NOT NULL,
  `pdf_path` varchar(255) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `genre_id` int(11) DEFAULT NULL,
  `progress` int(11) DEFAULT 0,
  `total_pages` int(11) DEFAULT NULL,
  `last_read_page` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookshelf_pdfs`
--

INSERT INTO `bookshelf_pdfs` (`id`, `user_id`, `book_title`, `writer`, `genre`, `pdf_path`, `image_path`, `genre_id`, `progress`, `total_pages`, `last_read_page`) VALUES
(24, 19, 'kracher kornel', 'shahadujjaman', '', 'uploads/pdfs/Offline03-KNN.pdf', 'uploads/images/kracher kornel cover.png', 2, 0, NULL, 0),
(25, 19, 'moner manush', 'Hridoy Moni', '', 'uploads/pdfs/MidAssigment2(011221075).pdf', 'uploads/images/449816222_373648608799598_2561705013507227847_n.jpg', 5, 0, NULL, 0),
(26, 19, 'kotha', 'mehrin', '', 'uploads/pdfs/Offline03-KNN.pdf', 'uploads/images/Image.png', 3, 0, NULL, 0),
(27, 19, 'tomar amar', 'Emon', '', 'uploads/pdfs/Offline03-KNN.pdf', 'uploads/images/Purple And Yellow Illustrative 3d Website Design & Development Facebook Ad.png', 5, 0, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `book_advertisements`
--

CREATE TABLE `book_advertisements` (
  `ad_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `shop_owner_id` int(11) NOT NULL,
  `discount_percentage` int(11) DEFAULT NULL,
  `advertising_start_date` datetime NOT NULL DEFAULT current_timestamp(),
  `advertising_end_date` datetime DEFAULT NULL,
  `status` enum('active','expired') DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `book_advertisements`
--

INSERT INTO `book_advertisements` (`ad_id`, `book_id`, `shop_owner_id`, `discount_percentage`, `advertising_start_date`, `advertising_end_date`, `status`) VALUES
(2, 8, 31, 10, '2024-10-05 21:28:00', '2024-10-07 21:29:00', 'active'),
(3, 2, 10049, 10, '2024-10-05 21:35:00', '2024-10-08 21:35:00', 'active'),
(4, 1, 10049, 30, '2024-10-06 01:06:00', '2024-10-07 01:06:00', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `book_publishers`
--

CREATE TABLE `book_publishers` (
  `book_id` int(11) NOT NULL,
  `publisher_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `book_shopowners`
--

CREATE TABLE `book_shopowners` (
  `book_id` int(11) NOT NULL,
  `shop_owner_id` int(11) NOT NULL,
  `stock_quantity` int(11) DEFAULT 0,
  `price` decimal(10,2) DEFAULT NULL,
  `quality` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `book_shopowners`
--

INSERT INTO `book_shopowners` (`book_id`, `shop_owner_id`, `stock_quantity`, `price`, `quality`) VALUES
(1, 31, 48, 800.00, 'Offset Paper'),
(1, 31, 98, 500.00, 'White Print'),
(1, 36, 40, 500.00, 'Paperback'),
(1, 10048, 48, 448.00, 'Yellow Print'),
(1, 10049, 95, 586.00, 'Paperback'),
(2, 31, 78, 500.00, 'White Print'),
(2, 36, 100, 500.00, 'Paperback'),
(2, 10049, 57, 478.00, 'Yellow Print'),
(3, 31, 98, 500.00, 'White Print'),
(3, 36, 10, 500.00, 'Offset Paper'),
(4, 31, 100, 400.00, 'Yellow Print'),
(5, 31, 18, 500.00, 'Yellow Print'),
(6, 31, 56, 100.00, 'White Print'),
(7, 31, 98, 100.00, 'Paperback'),
(8, 31, 10, 200.00, 'Paperback'),
(10, 31, 10, 100.00, 'Paperback'),
(11, 31, 9, 150.00, 'Paperback'),
(14, 31, 9, 200.00, 'Paperback'),
(15, 31, 9, 350.00, 'Paperback'),
(16, 31, 10, 150.00, 'Paperback'),
(17, 31, 10, 300.00, 'Paperback'),
(18, 31, 10, 250.00, 'Paperback'),
(19, 31, 10, 150.00, 'Paperback'),
(20, 31, 8, 150.00, 'Paperback'),
(21, 31, 8, 150.00, 'Paperback'),
(22, 31, 10, 150.00, 'Paperback');

-- --------------------------------------------------------

--
-- Table structure for table `book_writers`
--

CREATE TABLE `book_writers` (
  `book_id` int(11) NOT NULL,
  `writer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `borrowing`
--

CREATE TABLE `borrowing` (
  `borrowing_id` int(11) NOT NULL,
  `reader_id` int(11) NOT NULL,
  `shop_owner_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `borrow_date` date NOT NULL DEFAULT current_timestamp(),
  `return_date` date DEFAULT NULL,
  `is_returned` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `borrowing`
--

INSERT INTO `borrowing` (`borrowing_id`, `reader_id`, `shop_owner_id`, `book_id`, `borrow_date`, `return_date`, `is_returned`) VALUES
(54, 19, 31, 1, '2024-10-05', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `borrow_bookavailability`
--

CREATE TABLE `borrow_bookavailability` (
  `book_id` int(11) DEFAULT NULL,
  `shop_owner_id` int(11) DEFAULT NULL,
  `available_copies` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `borrow_bookavailability`
--

INSERT INTO `borrow_bookavailability` (`book_id`, `shop_owner_id`, `available_copies`) VALUES
(1, 31, 123),
(2, 36, 6),
(3, 31, 3);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `reader_id` int(11) NOT NULL,
  `shop_owner_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `book_id`, `reader_id`, `shop_owner_id`, `amount`) VALUES
(12, 3, 30, 36, 6),
(13, 2, 30, 31, 1);

-- --------------------------------------------------------

--
-- Table structure for table `exchange_books`
--

CREATE TABLE `exchange_books` (
  `exchange_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `reader_id` int(11) NOT NULL,
  `listed_date` datetime DEFAULT current_timestamp(),
  `preferred_genre` varchar(100) DEFAULT NULL,
  `condition_image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `exchange_books`
--

INSERT INTO `exchange_books` (`exchange_id`, `book_id`, `reader_id`, `listed_date`, `preferred_genre`, `condition_image`) VALUES
(17, 2, 30, '2024-09-27 22:58:38', 'Science Fiction', 'https://drive.google.com/file/d/1714EiJJ-DrWZlU-o4n3_WYvrdV4b-b-P/view?usp=drive_link'),
(21, 3, 30, '2024-09-28 00:39:12', 'Fiction', 'https://drive.google.com/file/d/1714EiJJ-DrWZlU-o4n3_WYvrdV4b-b-P/view?usp=drive_link'),
(20, 4, 19, '2024-09-27 23:45:01', 'Novel', 'https://drive.google.com/file/d/1714EiJJ-DrWZlU-o4n3_WYvrdV4b-b-P/view?usp=drive_link'),
(19, 6, 30, '2024-09-27 23:44:33', 'Novel', 'https://drive.google.com/file/d/1714EiJJ-DrWZlU-o4n3_WYvrdV4b-b-P/view?usp=drive_link');

-- --------------------------------------------------------

--
-- Table structure for table `exchange_notification`
--

CREATE TABLE `exchange_notification` (
  `notification_id` int(11) NOT NULL,
  `req_id` int(11) DEFAULT NULL,
  `requestor_status` enum('seen','unseen') DEFAULT 'unseen',
  `requestee_status` enum('seen','unseen') DEFAULT 'unseen'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `exchange_notification`
--

INSERT INTO `exchange_notification` (`notification_id`, `req_id`, `requestor_status`, `requestee_status`) VALUES
(5, 8, 'seen', 'seen'),
(6, 9, 'seen', 'seen'),
(7, 10, 'unseen', 'seen');

-- --------------------------------------------------------

--
-- Table structure for table `exchange_req`
--

CREATE TABLE `exchange_req` (
  `req_id` int(11) NOT NULL,
  `requestor_exchange_id` int(11) NOT NULL,
  `requestee_exchange_id` int(11) NOT NULL,
  `status` enum('pending','accepted','declined') DEFAULT 'pending',
  `request_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `response_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `exchange_req`
--

INSERT INTO `exchange_req` (`req_id`, `requestor_exchange_id`, `requestee_exchange_id`, `status`, `request_date`, `response_date`) VALUES
(8, 20, 17, 'accepted', '2024-09-28 12:00:13', '2024-09-28 12:01:19'),
(9, 20, 19, 'declined', '2024-09-28 12:00:22', '2024-09-28 12:01:21'),
(10, 21, 20, 'declined', '2024-09-28 12:01:41', '2024-09-28 12:13:23');

--
-- Triggers `exchange_req`
--
DELIMITER $$
CREATE TRIGGER `after_exchange_request_insert` AFTER INSERT ON `exchange_req` FOR EACH ROW BEGIN
    INSERT INTO exchange_notification (req_id) 
    VALUES (NEW.req_id);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `genre`
--

CREATE TABLE `genre` (
  `genre_id` int(11) NOT NULL,
  `genre_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `genre`
--

INSERT INTO `genre` (`genre_id`, `genre_name`) VALUES
(1, 'Fiction'),
(2, 'Science Fiction'),
(3, 'Fantasy'),
(4, 'Non-Fiction'),
(5, 'Romance'),
(6, 'Thriller'),
(7, 'Biography');

-- --------------------------------------------------------

--
-- Table structure for table `membership`
--

CREATE TABLE `membership` (
  `reader_id` int(11) NOT NULL,
  `type` enum('free','premium','elite') NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `membership`
--

INSERT INTO `membership` (`reader_id`, `type`, `date`) VALUES
(19, 'elite', '2024-10-05');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` int(11) NOT NULL,
  `cart_id` int(11) NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  `payment_status` enum('Pending','Paid','Failed') DEFAULT 'Pending',
  `payment_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `transaction_id` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `publication_request`
--

CREATE TABLE `publication_request` (
  `request_id` int(11) NOT NULL,
  `publisher_id` int(11) NOT NULL,
  `writer_id` int(11) NOT NULL,
  `manuscript` varchar(255) NOT NULL,
  `genre` varchar(100) NOT NULL,
  `request_date` datetime DEFAULT current_timestamp(),
  `status` enum('pending','accepted','declined') DEFAULT 'pending',
  `book_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `publication_request`
--

INSERT INTO `publication_request` (`request_id`, `publisher_id`, `writer_id`, `manuscript`, `genre`, `request_date`, `status`, `book_name`) VALUES
(1, 33, 41, 'sdfgsdf', 'sdfgfds', '2024-09-28 22:50:51', 'pending', 'yutyutyuty'),
(2, 32, 41, 'dfhg', 'fghg', '2024-09-28 22:57:42', 'declined', 'dfsdsh');

-- --------------------------------------------------------

--
-- Table structure for table `publishers`
--

CREATE TABLE `publishers` (
  `publisher_id` int(11) DEFAULT NULL,
  `publisher_name` varchar(100) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `website` varchar(100) DEFAULT NULL,
  `established_date` date DEFAULT NULL,
  `profile_pic` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `publishers`
--

INSERT INTO `publishers` (`publisher_id`, `publisher_name`, `address`, `phone_number`, `email`, `website`, `established_date`, `profile_pic`) VALUES
(32, 'ula publication', 'shahjadpur', ' 012348765487', 'hridoyahmedddd@gmail.com', 'https://aniwatchtv.to/home', '1999-12-30', NULL),
(33, 'Sheba Prokashoni', 'dhaka, shahjadpur', '01552354505', 'sheba@gmail.com', 'https://aniwatchtv.to/home', '1960-10-20', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

CREATE TABLE `purchase` (
  `purchase_id` int(11) NOT NULL,
  `reader_id` int(11) DEFAULT NULL,
  `book_id` int(11) DEFAULT NULL,
  `shop_owner_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `purchase_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `purchase`
--

INSERT INTO `purchase` (`purchase_id`, `reader_id`, `book_id`, `shop_owner_id`, `quantity`, `purchase_date`) VALUES
(13, 19, 6, 31, 1, '2024-09-28 18:56:50'),
(14, 19, 6, 31, 2, '2024-10-06 22:03:11'),
(15, 19, 20, 31, 1, '2024-10-06 22:03:11'),
(16, 19, 21, 31, 2, '2024-10-06 22:03:11'),
(17, 19, 20, 31, 1, '2024-10-06 22:21:01'),
(18, 19, 14, 31, 1, '2024-10-06 23:24:50'),
(19, 19, 11, 31, 1, '2024-10-06 23:24:50'),
(20, 19, 15, 31, 1, '2024-10-06 23:29:19'),
(21, 19, 5, 31, 1, '2024-10-06 23:30:12'),
(22, 19, 6, 31, 1, '2024-10-06 23:31:58'),
(23, 19, 6, 31, 1, '2024-10-06 23:33:43');

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `book_id` int(11) NOT NULL,
  `shop_owner_id` int(11) NOT NULL,
  `reader_id` int(11) NOT NULL,
  `star_rating` int(11) DEFAULT NULL CHECK (`star_rating` between 0 and 5)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`book_id`, `shop_owner_id`, `reader_id`, `star_rating`) VALUES
(5, 31, 19, 4),
(6, 31, 19, 5);

-- --------------------------------------------------------

--
-- Table structure for table `readers`
--

CREATE TABLE `readers` (
  `reader_auto_id` int(11) DEFAULT NULL,
  `reader_id` varchar(20) DEFAULT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `profile_pic` varchar(255) DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `readers`
--

INSERT INTO `readers` (`reader_auto_id`, `reader_id`, `first_name`, `last_name`, `profile_pic`, `phone_number`, `date_of_birth`, `email`, `country`) VALUES
(19, '240916019', 'Hridoy                 ', 'Ahmed                        ', 'luffy san.jpg', '01552354505         ', '2001-12-28', 'hridoyahmedddd@gmail.com', 'Bangladesh'),
(30, '240919030', ' lionel', ' messi', NULL, ' 012348765487', '1970-01-01', 'messi@gmail.com', 'Argentina'),
(40, '240928040', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

--
-- Triggers `readers`
--
DELIMITER $$
CREATE TRIGGER `before_insert_reader` BEFORE INSERT ON `readers` FOR EACH ROW BEGIN
    DECLARE date_part VARCHAR(6);
    DECLARE auto_part VARCHAR(10);
    
    -- Get the current date in YYMMDD format
    SET date_part = DATE_FORMAT(CURDATE(), '%y%m%d');
    
    -- Get the auto-increment part (from the reader_auto_id)
    SET auto_part = LPAD(NEW.reader_auto_id, 3, '0'); -- Pads the number with zeros, up to 3 digits

    -- Concatenate the date and auto part to form the final reader_id
    SET NEW.reader_id = CONCAT(date_part, auto_part);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `reviewreactions`
--

CREATE TABLE `reviewreactions` (
  `ReviewID` int(11) NOT NULL,
  `ReaderID` int(11) NOT NULL,
  `Reaction` enum('Like','Dislike') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviewreactions`
--

INSERT INTO `reviewreactions` (`ReviewID`, `ReaderID`, `Reaction`) VALUES
(13, 30, 'Like'),
(15, 30, 'Dislike'),
(16, 30, 'Like'),
(18, 19, 'Dislike');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `ReviewID` int(11) NOT NULL,
  `BookID` int(11) DEFAULT NULL,
  `ShopOwnerID` int(11) DEFAULT NULL,
  `ReviewerID` int(11) DEFAULT NULL,
  `ReviewDate` date DEFAULT current_timestamp(),
  `ReviewText` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`ReviewID`, `BookID`, `ShopOwnerID`, `ReviewerID`, `ReviewDate`, `ReviewText`) VALUES
(13, 6, 31, 19, '2024-10-04', 'ulalala'),
(14, 8, 31, 19, '2024-10-04', 'dsfdsa'),
(15, 6, 31, 19, '2024-10-04', 'gsdgsdf'),
(16, 5, 31, 19, '2024-10-04', 'sadsa'),
(17, 1, 31, 19, '2024-10-05', 'gfds'),
(18, 5, 31, 30, '2024-10-05', 'sadsad');

-- --------------------------------------------------------

--
-- Table structure for table `shopowners`
--

CREATE TABLE `shopowners` (
  `shop_owner_id` int(11) DEFAULT NULL,
  `shop_name` varchar(100) NOT NULL,
  `owner_name` varchar(100) NOT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `postal_code` varchar(10) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shopowners`
--

INSERT INTO `shopowners` (`shop_owner_id`, `shop_name`, `owner_name`, `phone_number`, `address`, `city`, `postal_code`, `email`) VALUES
(31, 'Book shop', 'zoro', '01552354505', 'notunbazar', 'Dhaka', '1212', 'bs@gmail.com'),
(36, 'UIU BOOK SHOP', 'Kashem Sir', '123456789', '100 ft', 'Dhaka', NULL, NULL),
(10048, '', '', NULL, NULL, NULL, NULL, NULL),
(10049, '', '', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `user_type` enum('Reader','Writer','Publisher','ShopOwner') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password_hash`, `user_type`, `created_at`) VALUES
(19, 'user_reader', 'reader@gmail.com', '$2y$10$5xhNjV6L.mtQJFEHhor/pOs6ymZH8zR/7RIasQLGkbYG4VKhSodqa', 'Reader', '2024-09-16 07:28:24'),
(30, 'messi', 'messi@gmail.com', '$2y$10$Z20S2Hz/omevGyCK0SHicumG/XyMf1186hR0JSuTbqQXRYm8z64ZG', 'Reader', '2024-09-19 09:44:25'),
(31, 'BoiMela', 'so@gmail.com', '$2y$10$BnI51XR29T41EvQ97TMzlOyJdL8ncjKjOIAo3eR.VMocv8zCzdMqm', 'ShopOwner', '2024-09-20 04:27:49'),
(32, 'publisher1234', 'pb@gmail.com', '$2y$10$sgwpSaC2RHi1O7cRIZCnbeVG.wN3fvpwgZrnvIrFc4J7AVjNpNg7e', 'Publisher', '2024-09-21 16:43:52'),
(33, 'sheba prokashoni', 'sheba@gmail.com', '$2y$10$pqVWMR5QqK.7An6WmnJHMOs2MDDNRs8HtySfMpMJ1UoOkwgXcBgby', 'Publisher', '2024-09-24 14:00:20'),
(35, 'humayun', 'humayun@gmail.com', 'Hum12345', 'Writer', '2024-09-25 15:13:13'),
(36, 'UIU book shop', 'uiu@gmail.com', '$2y$10$6wg/BnmKm9DJ8cAJ2K7XqOoJliYtZDrm/dfQ9izL/TvxRUH9xJnPq', 'ShopOwner', '2024-09-26 10:36:12'),
(40, 'arafat', 'arafat@gmail.com', '$2y$10$Pjl.Q2rr8lud96goaR9Yfu36gyGFg3vDNIwOfl60E01clKaMk3hya', 'Reader', '2024-09-28 15:06:40'),
(41, 'bambola', 'writer@gmail.com', '$2y$10$Gq9CZ5ZuP5Lb/RWv7U0W.u2KdowIt3B6r47gbAG9PKgfONdpQl9Oa', 'Writer', '2024-09-28 15:21:34'),
(10047, 'asdasd', 'asd@gmail.com', '$2y$10$orahNXumh8So6iKSMKcX.uaMTf47VlpGS9x/3nMvHUxSWacyB4CXG', 'Writer', '2024-09-28 15:36:49'),
(10048, 'shop', 'shop@mail.com', '$2y$10$lsKxqIuJGgmvxU8QWTFY3OxlxyN9Yw2MF.rVjQgwtojYM43bilO2q', 'ShopOwner', '2024-10-05 15:03:49'),
(10049, 'shop1', 'shop@gmail.com', '$2y$10$zTX3nYdpKCZtUI7oYCxp.Oa.WU5D10wzGPVnBw2hRT3Z4wkOW6Y0e', 'ShopOwner', '2024-10-05 15:32:44');

--
-- Triggers `users`
--
DELIMITER $$
CREATE TRIGGER `after_user_insert_publisher` AFTER INSERT ON `users` FOR EACH ROW BEGIN
    IF NEW.user_type = 'Publisher' THEN
        INSERT INTO Publishers (publisher_id)
        VALUES (NEW.user_id);  -- Adjust default values as needed
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_user_insert_reader` AFTER INSERT ON `users` FOR EACH ROW BEGIN
    IF NEW.user_type = 'Reader' THEN
        INSERT INTO Readers (reader_auto_id)
        VALUES (NEW.user_id);  -- Adjust default values as needed
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_user_insert_shopowner` AFTER INSERT ON `users` FOR EACH ROW BEGIN
    IF NEW.user_type = 'ShopOwner' THEN
        INSERT INTO ShopOwners (shop_owner_id)
        VALUES (NEW.user_id);  -- Adjust default values as needed
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_user_insert_writer` AFTER INSERT ON `users` FOR EACH ROW BEGIN
    IF NEW.user_type = 'Writer' THEN
        INSERT INTO Writers (writer_id)
        VALUES (NEW.user_id);  -- Adjust default values as needed
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `before_user_insert` BEFORE INSERT ON `users` FOR EACH ROW BEGIN
  IF NEW.user_type = 'Writer' THEN
    -- Set the new user_id to max user_id + 1 for writers, or 2000 if none exists
    SET NEW.user_id = (SELECT IFNULL(MAX(author_id) + 1, 2000) FROM authors);
  END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `email_format_before_insert` BEFORE INSERT ON `users` FOR EACH ROW BEGIN
    IF NEW.email NOT LIKE '%_@__%.__%' THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Invalid email format';
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `email_format_before_update` BEFORE UPDATE ON `users` FOR EACH ROW BEGIN
    IF NEW.email NOT LIKE '%_@__%.__%' THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Invalid email format';
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `password_format_before_insert` BEFORE INSERT ON `users` FOR EACH ROW BEGIN
    DECLARE password_length INT;
    
    SET password_length = LENGTH(NEW.password_hash);

    IF password_length < 8 THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Password must be at least 8 characters long';
    END IF;

    IF NEW.password_hash NOT REGEXP '[A-Z]' THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Password must contain at least one uppercase letter';
    END IF;

    IF NEW.password_hash NOT REGEXP '[a-z]' THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Password must contain at least one lowercase letter';
    END IF;

    IF NEW.password_hash NOT REGEXP '[0-9]' THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Password must contain at least one digit';
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `user_bookshelf`
--

CREATE TABLE `user_bookshelf` (
  `shelf_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `pdf_url` varchar(255) NOT NULL,
  `added_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `writers`
--

CREATE TABLE `writers` (
  `writer_id` int(11) DEFAULT NULL,
  `name` varchar(50) NOT NULL,
  `birth_date` date DEFAULT NULL,
  `nationality` varchar(50) DEFAULT NULL,
  `biography` text DEFAULT NULL,
  `website` varchar(100) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `writers`
--

INSERT INTO `writers` (`writer_id`, `name`, `birth_date`, `nationality`, `biography`, `website`, `email`) VALUES
(35, 'Humayun', NULL, NULL, NULL, NULL, NULL),
(41, 'Robindro', NULL, NULL, NULL, NULL, NULL),
(10047, '', NULL, NULL, NULL, NULL, NULL);

--
-- Triggers `writers`
--
DELIMITER $$
CREATE TRIGGER `after_writers_update` AFTER UPDATE ON `writers` FOR EACH ROW BEGIN
    UPDATE authors
    SET name = NEW.name
    WHERE author_id = NEW.writer_id;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `before_writers_insert` BEFORE INSERT ON `writers` FOR EACH ROW BEGIN
    INSERT INTO authors (author_id, name) 
    VALUES (NEW.writer_id, NEW.name);
END
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`author_id`);

--
-- Indexes for table `billing`
--
ALTER TABLE `billing`
  ADD PRIMARY KEY (`billing_id`),
  ADD KEY `purchase_id` (`purchase_id`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`book_id`),
  ADD UNIQUE KEY `isbn` (`isbn`),
  ADD KEY `fk_author` (`author_id`);

--
-- Indexes for table `bookshelf_pdfs`
--
ALTER TABLE `bookshelf_pdfs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `genre_id` (`genre_id`);

--
-- Indexes for table `book_advertisements`
--
ALTER TABLE `book_advertisements`
  ADD PRIMARY KEY (`ad_id`),
  ADD KEY `book_id` (`book_id`),
  ADD KEY `shop_owner_id` (`shop_owner_id`);

--
-- Indexes for table `book_publishers`
--
ALTER TABLE `book_publishers`
  ADD PRIMARY KEY (`book_id`,`publisher_id`),
  ADD KEY `publisher_id` (`publisher_id`);

--
-- Indexes for table `book_shopowners`
--
ALTER TABLE `book_shopowners`
  ADD PRIMARY KEY (`book_id`,`shop_owner_id`,`quality`),
  ADD KEY `shop_owner_id` (`shop_owner_id`);

--
-- Indexes for table `book_writers`
--
ALTER TABLE `book_writers`
  ADD PRIMARY KEY (`book_id`,`writer_id`),
  ADD KEY `writer_id` (`writer_id`);

--
-- Indexes for table `borrowing`
--
ALTER TABLE `borrowing`
  ADD PRIMARY KEY (`borrowing_id`),
  ADD KEY `shop_owner_id` (`shop_owner_id`),
  ADD KEY `book_id` (`book_id`),
  ADD KEY `fk_borrowing_reader` (`reader_id`);

--
-- Indexes for table `borrow_bookavailability`
--
ALTER TABLE `borrow_bookavailability`
  ADD KEY `book_id` (`book_id`),
  ADD KEY `shop_owner_id` (`shop_owner_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `book_id` (`book_id`),
  ADD KEY `reader_id` (`reader_id`),
  ADD KEY `shop_owner_id` (`shop_owner_id`);

--
-- Indexes for table `exchange_books`
--
ALTER TABLE `exchange_books`
  ADD PRIMARY KEY (`book_id`,`reader_id`),
  ADD UNIQUE KEY `exchange_id` (`exchange_id`),
  ADD KEY `reader_id` (`reader_id`);

--
-- Indexes for table `exchange_notification`
--
ALTER TABLE `exchange_notification`
  ADD PRIMARY KEY (`notification_id`),
  ADD KEY `req_id` (`req_id`);

--
-- Indexes for table `exchange_req`
--
ALTER TABLE `exchange_req`
  ADD PRIMARY KEY (`requestor_exchange_id`,`requestee_exchange_id`),
  ADD UNIQUE KEY `req_id` (`req_id`),
  ADD KEY `fk_requestee_exchange_id` (`requestee_exchange_id`);

--
-- Indexes for table `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`genre_id`);

--
-- Indexes for table `membership`
--
ALTER TABLE `membership`
  ADD PRIMARY KEY (`reader_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `cart_id` (`cart_id`);

--
-- Indexes for table `publication_request`
--
ALTER TABLE `publication_request`
  ADD PRIMARY KEY (`request_id`),
  ADD KEY `fk_writer` (`writer_id`),
  ADD KEY `fk_publisher` (`publisher_id`);

--
-- Indexes for table `publishers`
--
ALTER TABLE `publishers`
  ADD KEY `publisher_id` (`publisher_id`);

--
-- Indexes for table `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`purchase_id`),
  ADD KEY `reader_id` (`reader_id`),
  ADD KEY `shop_owner_id` (`shop_owner_id`),
  ADD KEY `book_id` (`book_id`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`book_id`,`shop_owner_id`,`reader_id`),
  ADD KEY `shop_owner_id` (`shop_owner_id`),
  ADD KEY `reader_id` (`reader_id`);

--
-- Indexes for table `readers`
--
ALTER TABLE `readers`
  ADD KEY `reader_id` (`reader_auto_id`);

--
-- Indexes for table `reviewreactions`
--
ALTER TABLE `reviewreactions`
  ADD PRIMARY KEY (`ReviewID`,`ReaderID`),
  ADD KEY `ReaderID` (`ReaderID`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`ReviewID`),
  ADD KEY `fk_book_id` (`BookID`),
  ADD KEY `fk_shop_owner_id` (`ShopOwnerID`),
  ADD KEY `fk_reviewer_id` (`ReviewerID`);

--
-- Indexes for table `shopowners`
--
ALTER TABLE `shopowners`
  ADD KEY `shop_owner_id` (`shop_owner_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_bookshelf`
--
ALTER TABLE `user_bookshelf`
  ADD PRIMARY KEY (`shelf_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `book_id` (`book_id`);

--
-- Indexes for table `writers`
--
ALTER TABLE `writers`
  ADD KEY `writer_id` (`writer_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `authors`
--
ALTER TABLE `authors`
  MODIFY `author_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10048;

--
-- AUTO_INCREMENT for table `billing`
--
ALTER TABLE `billing`
  MODIFY `billing_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `bookshelf_pdfs`
--
ALTER TABLE `bookshelf_pdfs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `book_advertisements`
--
ALTER TABLE `book_advertisements`
  MODIFY `ad_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `borrowing`
--
ALTER TABLE `borrowing`
  MODIFY `borrowing_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `exchange_books`
--
ALTER TABLE `exchange_books`
  MODIFY `exchange_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `exchange_notification`
--
ALTER TABLE `exchange_notification`
  MODIFY `notification_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `exchange_req`
--
ALTER TABLE `exchange_req`
  MODIFY `req_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `genre`
--
ALTER TABLE `genre`
  MODIFY `genre_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `publication_request`
--
ALTER TABLE `publication_request`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `purchase`
--
ALTER TABLE `purchase`
  MODIFY `purchase_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `ReviewID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10050;

--
-- AUTO_INCREMENT for table `user_bookshelf`
--
ALTER TABLE `user_bookshelf`
  MODIFY `shelf_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `billing`
--
ALTER TABLE `billing`
  ADD CONSTRAINT `billing_ibfk_1` FOREIGN KEY (`purchase_id`) REFERENCES `purchase` (`purchase_id`);

--
-- Constraints for table `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `fk_author` FOREIGN KEY (`author_id`) REFERENCES `authors` (`author_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `bookshelf_pdfs`
--
ALTER TABLE `bookshelf_pdfs`
  ADD CONSTRAINT `bookshelf_pdfs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bookshelf_pdfs_ibfk_2` FOREIGN KEY (`genre_id`) REFERENCES `genre` (`genre_id`) ON DELETE CASCADE;

--
-- Constraints for table `book_advertisements`
--
ALTER TABLE `book_advertisements`
  ADD CONSTRAINT `book_advertisements_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `books` (`book_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `book_advertisements_ibfk_2` FOREIGN KEY (`shop_owner_id`) REFERENCES `shopowners` (`shop_owner_id`) ON DELETE CASCADE;

--
-- Constraints for table `book_publishers`
--
ALTER TABLE `book_publishers`
  ADD CONSTRAINT `book_publishers_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `books` (`book_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `book_publishers_ibfk_2` FOREIGN KEY (`publisher_id`) REFERENCES `publishers` (`publisher_id`) ON DELETE CASCADE;

--
-- Constraints for table `book_shopowners`
--
ALTER TABLE `book_shopowners`
  ADD CONSTRAINT `book_shopowners_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `books` (`book_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `book_shopowners_ibfk_2` FOREIGN KEY (`shop_owner_id`) REFERENCES `shopowners` (`shop_owner_id`) ON DELETE CASCADE;

--
-- Constraints for table `book_writers`
--
ALTER TABLE `book_writers`
  ADD CONSTRAINT `book_writers_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `books` (`book_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `book_writers_ibfk_2` FOREIGN KEY (`writer_id`) REFERENCES `writers` (`writer_id`) ON DELETE CASCADE;

--
-- Constraints for table `borrowing`
--
ALTER TABLE `borrowing`
  ADD CONSTRAINT `borrowing_ibfk_2` FOREIGN KEY (`shop_owner_id`) REFERENCES `shopowners` (`shop_owner_id`),
  ADD CONSTRAINT `borrowing_ibfk_3` FOREIGN KEY (`book_id`) REFERENCES `books` (`book_id`),
  ADD CONSTRAINT `fk_borrowing_reader` FOREIGN KEY (`reader_id`) REFERENCES `readers` (`reader_auto_id`);

--
-- Constraints for table `borrow_bookavailability`
--
ALTER TABLE `borrow_bookavailability`
  ADD CONSTRAINT `borrow_bookavailability_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `books` (`book_id`),
  ADD CONSTRAINT `borrow_bookavailability_ibfk_2` FOREIGN KEY (`shop_owner_id`) REFERENCES `shopowners` (`shop_owner_id`);

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `books` (`book_id`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`reader_id`) REFERENCES `readers` (`reader_auto_id`),
  ADD CONSTRAINT `cart_ibfk_3` FOREIGN KEY (`shop_owner_id`) REFERENCES `shopowners` (`shop_owner_id`);

--
-- Constraints for table `exchange_books`
--
ALTER TABLE `exchange_books`
  ADD CONSTRAINT `exchange_books_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `books` (`book_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `exchange_books_ibfk_2` FOREIGN KEY (`reader_id`) REFERENCES `readers` (`reader_auto_id`) ON DELETE CASCADE;

--
-- Constraints for table `exchange_notification`
--
ALTER TABLE `exchange_notification`
  ADD CONSTRAINT `exchange_notification_ibfk_1` FOREIGN KEY (`req_id`) REFERENCES `exchange_req` (`req_id`) ON DELETE CASCADE;

--
-- Constraints for table `exchange_req`
--
ALTER TABLE `exchange_req`
  ADD CONSTRAINT `fk_requestee_exchange_id` FOREIGN KEY (`requestee_exchange_id`) REFERENCES `exchange_books` (`exchange_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_requestor_exchange_id` FOREIGN KEY (`requestor_exchange_id`) REFERENCES `exchange_books` (`exchange_id`) ON DELETE CASCADE;

--
-- Constraints for table `membership`
--
ALTER TABLE `membership`
  ADD CONSTRAINT `membership_ibfk_1` FOREIGN KEY (`reader_id`) REFERENCES `readers` (`reader_auto_id`);

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`cart_id`) REFERENCES `cart` (`cart_id`) ON DELETE CASCADE;

--
-- Constraints for table `publication_request`
--
ALTER TABLE `publication_request`
  ADD CONSTRAINT `fk_publisher` FOREIGN KEY (`publisher_id`) REFERENCES `publishers` (`publisher_id`),
  ADD CONSTRAINT `fk_writer` FOREIGN KEY (`writer_id`) REFERENCES `writers` (`writer_id`);

--
-- Constraints for table `publishers`
--
ALTER TABLE `publishers`
  ADD CONSTRAINT `publishers_ibfk_1` FOREIGN KEY (`publisher_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `purchase`
--
ALTER TABLE `purchase`
  ADD CONSTRAINT `purchase_ibfk_1` FOREIGN KEY (`reader_id`) REFERENCES `readers` (`reader_auto_id`),
  ADD CONSTRAINT `purchase_ibfk_2` FOREIGN KEY (`shop_owner_id`) REFERENCES `shopowners` (`shop_owner_id`),
  ADD CONSTRAINT `purchase_ibfk_3` FOREIGN KEY (`book_id`) REFERENCES `books` (`book_id`);

--
-- Constraints for table `ratings`
--
ALTER TABLE `ratings`
  ADD CONSTRAINT `ratings_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `books` (`book_id`),
  ADD CONSTRAINT `ratings_ibfk_2` FOREIGN KEY (`shop_owner_id`) REFERENCES `shopowners` (`shop_owner_id`),
  ADD CONSTRAINT `ratings_ibfk_3` FOREIGN KEY (`reader_id`) REFERENCES `readers` (`reader_auto_id`);

--
-- Constraints for table `readers`
--
ALTER TABLE `readers`
  ADD CONSTRAINT `readers_ibfk_1` FOREIGN KEY (`reader_auto_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `reviewreactions`
--
ALTER TABLE `reviewreactions`
  ADD CONSTRAINT `reviewreactions_ibfk_1` FOREIGN KEY (`ReviewID`) REFERENCES `reviews` (`ReviewID`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviewreactions_ibfk_2` FOREIGN KEY (`ReaderID`) REFERENCES `readers` (`reader_auto_id`) ON DELETE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `fk_book_id` FOREIGN KEY (`BookID`) REFERENCES `books` (`book_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_reviewer_id` FOREIGN KEY (`ReviewerID`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_shop_owner_id` FOREIGN KEY (`ShopOwnerID`) REFERENCES `shopowners` (`shop_owner_id`) ON DELETE CASCADE;

--
-- Constraints for table `shopowners`
--
ALTER TABLE `shopowners`
  ADD CONSTRAINT `shopowners_ibfk_1` FOREIGN KEY (`shop_owner_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `user_bookshelf`
--
ALTER TABLE `user_bookshelf`
  ADD CONSTRAINT `user_bookshelf_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_bookshelf_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `books` (`book_id`) ON DELETE CASCADE;

--
-- Constraints for table `writers`
--
ALTER TABLE `writers`
  ADD CONSTRAINT `writers_ibfk_1` FOREIGN KEY (`writer_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
