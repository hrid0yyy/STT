-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 19, 2024 at 09:13 PM
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
-- Database: `shelf to tales`
--

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
  `price` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `bookcover` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`book_id`, `title`, `genre`, `isbn`, `description`, `publication_date`, `language`, `price`, `created_at`, `bookcover`) VALUES
(1, 'A pocket full of rye', 'Crime', '9780451199867', '\"A Pocket Full of Rye\" is set in England, primarily in the countryside and the city of London. The story revolves around a wealthy businessman, Rex Fortescue, who is poisoned while drinking his morning tea. The subsequent investigation leads to shocking revelations about the Fortescue family and their dark secrets.', '1953-11-03', 'English', 200.00, '2024-09-14 09:12:16', NULL),
(2, 'Muhammad', 'Islamic', '9781594771538 ', 'Muhammad is an internationally acclaimed, comprehensive, and authoritative account of the life of the prophet. Based on the sira, the eighth- and ninth-century Arabic biographies that recount numerous events in the prophet’s life, it contains original English translations of many important passages that reveal the words of men and women who heard Muhammad speak and witnessed the events of his life.\r\n\r\nScrupulous and exhaustive in its fidelity to its sources, Muhammad: His Life Based on the Earliest Sources is presented in a narrative style that is easily comprehensible, yet authentic and inspiring in its use of language, reflecting both the simplicity and grandeur of the story it tells. This revised edition includes new sections detailing the prophet’s expanding influence and his spreading of the message of Islam into Syria and its neighboring states. It represents the final updates made to the text before the author’s death in 2005. The book has been published in 12 languages and has received numerous awards, including acknowledgment as best biography of the prophet in English at the National Seerate Conference in Islamabad.', '1983-01-01', 'English', 100.00, '2024-09-14 09:15:56', NULL),
(3, 'Before the coffee gets cold', 'Time Travel', '9781529029581', 'In a small back alley in Tokyo, there is a café which has been serving carefully brewed coffee for more than one hundred years. But this coffee shop offers its customers a unique experience: the chance to travel back in time.\r\n\r\nIn Before the Coffee Gets Cold, we meet four visitors, each of whom is hoping to make use of the café’s time-travelling offer, in order to: confront the man who left them, receive a letter from their husband whose memory has been taken by early onset Alzheimer\'s, to see their sister one last time, and to meet the daughter they never got the chance to know.\r\n\r\nBut the journey into the past does not come without risks: customers must sit in a particular seat, they cannot leave the café, and finally, they must return to the present before the coffee gets cold . . .\r\n\r\nToshikazu Kawaguchi’s beautiful, moving story explores the age-old question: what would you change if you could travel back in time? More importantly, who would you want to meet, maybe for one last time?', '2024-12-06', 'English', 100.00, '2024-09-14 09:18:45', NULL),
(4, 'Eleanor & Park', 'Romance', '	 9781250012579', '\"Bono met his wife in high school,\" Park says.\r\n\"So did Jerry Lee Lewis,\" Eleanor answers.\r\n\"I\'m not kidding,\" he says.\r\n\"You should be,\" she says, \"we\'re 16.\"\r\n\"What about Romeo and Juliet?\"\r\n\"Shallow, confused, then dead.\"\r\n\"I love you,\" Park says.\r\n\"Wherefore art thou,\" Eleanor answers.\r\n\"I\'m not kidding,\" he says.\r\n\"You should be.\"\r\n\r\nSet over one school year in 1986, Eleanor & Park is the story of two star-crossed misfits—smart enough to know first love almost never lasts, but brave and desperate enough to try.', '2012-04-12', 'English', 250.00, '2024-09-14 09:21:18', NULL),
(5, 'Tuesdays with Morrie', 'Inspirational', '0751529818', 'Maybe it was a grandparent, or a teacher or a colleague. Someone older, patient and wise, who understood you when you were young and searching, and gave you sound advice to help you make your way through it. For Mitch Albom, that person was Morrie Schwartz, his college professor from nearly twenty years ago.\r\n\r\nMaybe, like Mitch, you lost track of this mentor as you made your way, and the insights faded. Wouldn\'t you like to see that person again, ask the bigger questions that still haunt you?\r\n\r\nMitch Albom had that second chance. He rediscovered Morrie in the last months of the older man\'s life. Knowing he was dying of ALS - or motor neurone disease - Mitch visited Morrie in his study every Tuesday, just as they used to back in college. Their rekindled relationship turned into one final \'class\': lessons in how to live.', '1997-08-18', 'English', 150.00, '2024-09-14 09:24:07', NULL),
(6, 'All the Light We Cannot See', 'Historical', '	 9781476746586', 'Marie-Laure lives in Paris near the Museum of Natural History, where her father works. When she is twelve, the Nazis occupy Paris and father and daughter flee to the walled citadel of Saint-Malo, where Marie-Laure’s reclusive great uncle lives in a tall house by the sea. With them they carry what might be the museum’s most valuable and dangerous jewel.\r\n\r\nIn a mining town in Germany, Werner Pfennig, an orphan, grows up with his younger sister, enchanted by a crude radio they find that brings them news and stories from places they have never seen or imagined. Werner becomes an expert at building and fixing these crucial new instruments and is enlisted to use his talent to track down the resistance. Deftly interweaving the lives of Marie-Laure and Werner, Doerr illuminates the ways, against all odds, people try to be good to one another.\r\n\r\nFrom the highly acclaimed, multiple award-winning Anthony Doerr, the stunningly beautiful instant New York Times bestseller about a blind French girl and a German boy whose paths collide in occupied France as both try to survive the devastation of World War II.', '2014-05-06', 'English', 300.00, '2024-09-14 09:29:04', NULL),
(7, 'The mountain is you', 'Personal Development', '	 B089DQRDSV', 'This is a book about self-sabotage. Why we do it, when we do it, and how to stop doing it—for good. Coexisting but conflicting needs create self-sabotaging behaviors. This is why we resist efforts to change, often until they feel completely futile. But by extracting crucial insight from our most damaging habits, building emotional intelligence by better understanding our brains and bodies, releasing past experiences at a cellular level, and learning to act as our highest potential future selves, we can step out of our own way and into our potential. For centuries, the mountain has been used as a metaphor for the big challenges we face, especially ones that seem impossible to overcome. To scale our mountains, we actually have to do the deep internal work of excavating trauma, building resilience, and adjusting how we show up for the climb. In the end, it is not the mountain we master, but ourselves.', '2020-05-28', 'English', 300.00, '2024-09-14 09:32:30', NULL),
(8, 'ছায়াবীথি', 'Novel', '9844950058', '**\"Chayabithi\"** is a novel by the renowned Bangladeshi author Humayun Ahmed. The story revolves around the main character, Naila, who is a typical housewife. She lives with her husband, Zaman, and their two-year-old son, Babu. Their life is going smoothly until the arrival of Alam, which creates turmoil in Naila\'s life. She finds herself increasingly drawn towards Alam, leading to growing unrest in her household¹².\r\n\r\n\r\n\r\n', '1990-02-01', 'Bangla', 200.00, '2024-09-14 09:42:59', NULL),
(9, 'মেঘ বলেছে যাব যাব ', 'Drama', '9789844150515', 'মেঘ বলেছে যাবো।আকাশের মেঘেরা কি কথা বলে? তারা কি যেতে চায় কোথাও? তারা কোথায় যেতে চায়? বর্ষান ঘন কালো আকাশের দিকে তাকিয়ে চিত্রলেখার হঠাৎ এই কথা মনে হল। দশ-বার বছরের কিশোরীর মনে এর রকম একটা চিন্তা আসতে পারে, চিত্রলেখার বয়স পঁচিশ। এ রকম উদ্ভট তার জন্যে স্বাভাবিক নয়। তবুও কেন জানি নিজেকে তার মেঘের মতো মনে হয়। তার কোথায় জানি যেতে ইচ্ছা করে। এ রকম ইচ্ছা তো সব মানুষেরই কবে। সব মানুষের ভেতরই কি তাহলে এক টুকরা মেঘ ঢুকে আছে, যে কেবলি কোথাও যেতে চায়?', '1997-02-01', 'Bangla', 250.00, '2024-09-14 09:47:25', NULL),
(10, 'In Cold Blood', 'Crime', '9780679745587', 'It details the 1959 murders of four members of the Clutter family in the small farming community of Holcomb, Kansas', '1966-09-18', 'English', 1200.00, '2024-09-18 17:57:10', 'In Cold Blood.jpg'),
(11, 'Midnight in the Garden of Good and evila', 'Crime', '9780679643418', 'The story of Jim Williams, an antiques dealer on trial for the killing of Danny Hansford', '1994-01-10', 'English', 1000.00, '2024-09-18 17:57:10', 'Midnight in the Garden of Good and evil.jpg'),
(14, 'Dark Places \r\n', 'Crime', '9780307341570', 'The novel deals with class issues in rural America, intense poverty and the Satanic cult hysteria that swept the United States in the 1980s', '1866-07-09', 'English', 1090.00, '2024-09-18 18:16:52', 'Dark Places.jpg'),
(15, 'Crime and Punishments \r\n', 'Crime', '9780553898088', 'Crime and Punishment is the excruciatingly-detailed psycho-epic about the murder of a pawn shop owner (and her sister).', '1866-04-01', 'English', 810.00, '2024-09-18 18:25:04', 'Crime and Punishments.jpg \r\n'),
(16, 'The Time Traveler\'s Wife \r\n', 'Crime', '0578889412', 'It is a love story about Henry, a man with a genetic disorder that causes him to time travel unpredictably, and about Clare, his wife, an artist who has to cope with his frequent absences.', '2003-10-22', 'English', 800.00, '2024-09-18 18:30:07', 'The Time Traveler\'s Wife.jpg'),
(17, '11/22/63 ', 'Time Travel', '97814447272796', 'This is a story about time travel, about survival in a strange, unknown world, about knowing how to adapt to a whole new situation.\r\nAbout a time traveler who attempts to prevent the assassination of United States President John F. Kennedy, which occurred on November 22, 1963. It is the 60th book published by Stephen King, his 49th novel and the 42nd under his own name.', '1963-11-22', 'English', 2000.00, '2024-09-18 18:44:57', 'Book'),
(18, 'বেলা ফুরাবার আগে', 'Islamic', '9789849484400', 'বইটি মূলত নিজেকে আবিষ্কারের একটি আয়না। বইটিতে লেখক কোরআন ও হাদিসের আলোকে ১৬টি ট্রপিকের মাধ্যমে দ্বীন ভুলে বিলাসিতায় গা ভাসিয়ে দেওয়া তরুণদেরকে যেমন সতর্ক করেছেন অপরদিকে যারা সঠিক গন্তব্যের উদ্দেশ্য দ্বীনের পথ আঁকড়ে আছেন তাদের অনুপ্রেরণা জুগিয়েছেন।', '2020-02-04', 'Bangla', 245.00, '2024-09-18 19:00:40', 'বেলা ফুরাবার আগে.jpg'),
(19, 'জীবন যেখানে যেমন', 'Islamic', '9789849548997', 'জীবনের পরতে পরতে ছড়িয়ে ছিটিয়ে থাকা গল্পগুলােকে লেখক তুলে এনেছেন তার শৈল্পিক রং-তুলিতে। আলো থেকে স্ফুরিত হওয়া সেই অসাধারণ গল্পগুলো যেমন জীবনের কথা বলে, তেমনই জীবনে রেখে যায় বিশ্বাসী মূল্যবােধের গভীর এক ছাপ।', '2021-09-10', 'Bangla', 213.00, '2024-09-18 19:00:40', 'জীবন যেখানে যেমন.jpg'),
(20, 'পদ্মজা ', 'Novel', '9789849831938', 'আমি পদ্মজা উপন্যাসের মূল কাহিনী হল একটি গ্রাম্য মেয়ের সামাজিক ও পারিবারিক প্রতিবন্ধকতা অতিক্রম করে আত্মপ্রতিষ্ঠার সংগ্রাম। ', '2024-02-15', 'Bangla', 600.00, '2024-09-19 15:02:31', 'পদ্মজা.jpeg'),
(21, 'দেয়াল', 'Novel', '9789845021272', 'দেয়াল বাংলাদেশের প্রখ্যাত ঔপন্যাসিক হুমায়ূন আহমেদের লেখা একটি ইতিহাসাশ্রয়ী উপন্যাস যার ভিত্তি মুক্তিযুদ্ধ পরবর্তী বাংলাদেশের রাজনৈতিক ও সামাজিক প্রেক্ষাপট। এটি তার রচিত সর্বশেষ উপন্যাস যা তার মৃত্যুর এক বছর পর গ্রন্থাকারে প্রকাশিত হয়।', '2021-09-10', 'Bangla', 387.00, '2024-09-19 15:02:31', 'দেয়াল.jpg'),
(22, 'শেষ বিকেলের মেয়ে', 'Novel', '9789844042698', 'বাংলা সাহিত্যে প্রেম নিয়ে রচিত উপাখ্যানগুলোর মধ্যে \'শেষ বিকেলের মেয়ে\' পাঠক প্রিয়তার শীর্ষের দিকে অবস্থান করছে।', '2017-01-01', 'Bangla', 172.00, '2024-09-19 15:12:50', 'শেষ বিকেলের মেয়ে.jpg'),
(23, 'তোমাকে ', 'Novel', '9844120020', 'তোমাকে তিন বোন ও তাদের বাবাকে নিয়ে লেখা ছোট একটি গল্প। ', '1992-09-03', 'Bangla', 151.00, '2024-09-19 15:12:50', 'তোমাকে.jpg'),
(24, '3:00am', 'Thriller', '9848729925', 'Henry Bins has Henry Bins--a sleeping disorder, named after him. He is awake for one hour a day. He wakes up at 3 a.m. and falls asleep at 4. Life is simple, until he hears a woman scream and sees a man leave the house across the street.', '2021-05-13', 'English', 5000.00, '2024-09-19 15:27:14', 'Three am.jpg'),
(25, 'Vampire Academy : Shadow Kiss', 'Horror', '9780141328553', 'The powerful blend of human and vampire blood that flows through Rose Hathaway, Lissa\'s best friend, makes her a Dhampir. Rose is dedicated to a dangerous life of protecting Lissa from the Strigoi, who are hell-bent on making Lissa one of them. Rose knows it is forbidden to love another guardian.', '2008-11-13', 'English', 527.00, '2024-09-19 15:27:14', 'Shadow Kiss.jpg'),
(26, 'The Return Of Hannibal Lecter( Hannibal)', 'Horror', '9780099532941', 'For the multimillionaire Hannibal left maimed, for a corrupt Italian policeman, and for FBI agent Clarice Starling, who once stood before Lecter and who has never been the same, the final hunt for Hannibal Lecter has begun. All of them, in their separate ways, want to find Dr. Lecter. And all three will get their wish.', '1999-06-08', 'English', 733.00, '2024-09-19 15:36:06', 'The Return Of Hannibal Lecter( Hannibal).jpg'),
(27, 'Twilight ', 'Horror', '9781904233657', 'It is the first book in the Twilight series, and introduces seventeen-year-old Isabella \"Bella\" Swan, who moves from Phoenix, Arizona, to Forks, Washington. She is endangered after falling in love with Edward Cullen, a 103-year-old vampire frozen in his 17-year-old body.', '2005-09-27', 'English', 1078.00, '2024-09-19 15:36:06', 'Twilight.jpg'),
(28, 'Love You All\r\n', 'Science Fiction', '9844460794', 'As you will see, the story is about saving this planet earth, the survival of human race and resisting the four-dimensional beings', '2004-09-24', 'English', 132.00, '2024-09-19 15:45:03', '\r\n'),
(29, 'ক্যাশ মেশিন', NULL, '', NULL, NULL, 'Bang', 352.00, '2024-09-19 15:45:03', 'ক্যাশ মেশিন'),
(30, 'ক্যাশ মেশিন', 'Motivational', '9789849415442', 'এই বইটিকে একটা বিজনেস মাস্টারপিস বললে বেশি বলা হবে না। একজন উদ্যোক্তার মারাত্মক ৫টি ভুল ধরিয়ে দেয়া থেকে শুরু করে এই বই ব্যাখ্যা করে মার্কেটিং কিভাবে বিজনেসের জন্য ম্যাজিক হয়ে ওঠে, কাগজের নোট নয়, কনটেন্ট কেমন করে এই যুগের ক্যাশ হয়ে ওঠে, হিসেব করে তিনি মিলিয়ে দেন কোটি টাকার অংক।', '2024-05-09', 'Bangla', 352.00, '2024-09-19 15:51:11', 'ক্যাশ মেশিন.jpg'),
(31, 'The Art of War ', 'Politics', '9788172345242', 'The Art of War is a book of conflict knowledge and tactics revolving around several key concepts, including: Knowing when to fight and when not to fight. Knowing how to mislead the enemy. Knowing oneself and one\'s enemy.', '2007-11-01', 'English', 168.00, '2024-09-19 16:02:11', 'The Art of War.jpg '),
(32, 'অপেক্ষা ', 'Novel', '9847016600173', 'উপন্যাসটিতে একইসাথে মধ্যবিত্তের টানাপোড়েন এবং প্রিয় মানুষের প্রতি অকৃত্রিম ভালোবাসার নিদর্শন ফুটিয়ে তোলা হয়েছে। ', '1997-12-03', 'Bangla', 344.00, '2024-09-19 17:15:38', 'অপেক্ষা.jpeg'),
(33, 'সে এসে বসুক পাশে', 'Novel', '9789849734048', 'তুমি জীবন জুড়ে যত বেশি ভালো স্মৃতি তৈরি করতে পারবে, তত বেশি ওই নোনা ধরা খারাপ মেমোরিজগুলো ঝাপসা হয়ে যেতে থাকবে। ক্ষতগুলো শুকিয়ে যেতে থাকবে।', '2023-03-09', 'Bangla', 410.00, '2024-09-19 17:15:38', 'সে এসে বসুক পাশে.jpeg'),
(34, 'তোমার নামে সন্ধ্যা নামে', 'Novel', '9789845027342', 'আমাকে হারাতে দিলে নিখোঁজ বিজ্ঞপ্তিতে ছেয়ে যাবে তোমার শহর।', '2020-01-01', 'Bangla', 516.00, '2024-09-19 17:15:38', 'তোমার নামে সন্ধ্যা নামে.jpeg'),
(35, 'রাহে বেলায়াত', 'Islamic', '9789849005315', 'ফরয পালনের পাশাপাশি অবিরত নফল ইবাদত করার মাধ্যমে বান্দা তার প্রভুর নৈকট্য ও প্রেম অর্জন করে। এ বইটিতে সংক্ষেপে আত্মশুদ্ধি ও বেলায়াতের এ পথ সম্পর্কে এবং বিস্তারিতভাবে নফল ইবাদত সম্পর্কে সুস্পষ্ট ধারণা দেওয়া হয়েছে।', '2013-01-01', 'Bangla', 385.00, '2024-09-19 17:15:38', 'রাহে বেলায়াত.jpg'),
(36, 'হায়াতের দিন ফুরোলে', 'Islamic', '9789849859161', 'বইটির কেন্দ্রীয় চরিত্র সাজিদ বিভিন্ন কথোপকথনের মধ্যে তার নাস্তিক বন্ধুর অবিশ্বাসকে বিজ্ঞানসম্মত নানা যুক্তিতর্কের মাধ্যমে খণ্ডন করে। আর এসব কথোপকথনের মধ্য দিয়েই বইটিতে অবিশ্বাসীদের অনেক যুক্তি খণ্ডন করেছেন লেখক। বইটি প্রকাশের পরপরই তুমুল জনপ্রিয়তা পায়। এটি ইংরেজি ও অসমীয়া ভাষায় অনূদিতও হয়েছে।', '2024-02-08', 'Bangla', 248.00, '2024-09-19 17:40:08', 'হায়াতের দিন ফুরোলে.jpg'),
(37, 'আর রাহীকুল মাখতূম বা মোহরাঙ্কিত জান্নাতী সুধা', 'Islamic', '9789848766064', 'আর্‌-রাহীকুল মাখতূম (আরবি/উর্দূতে: الرحيق المختوم ; অর্থ: মোহরাঙ্কিত জান্নাতী সুধা) আরবি এবং উর্দু ভাষায় সফিউর রহমান মোবারকপুরী রচিত মুসলমানদের নবী মুহাম্মদ সাঃ এর জীবনীগ্রন্থ। আধুনিক যুগে ইসলামের নবী মুহাম্মদ সাঃ এর জীবনী নিয়ে আরবি ভাষায় লেখা অন্যতম একটি সিরাত গ্রন্থ।', '1987-09-11', 'Bangla', 525.00, '2024-09-19 17:40:08', 'আর রাহীকুল মাখতূম বা মোহরাঙ্কিত জান্নাতী সুধা.jpg'),
(38, 'মহিমান্বিত কুরআন', 'Islamic', '978-984-8046-40-1', 'The Meaning of the Glorious Koran (1930) হল মারমাডুক পিকথাল দ্বারা সূরাগুলির সংক্ষিপ্ত ভূমিকা সহ কুরআনের একটি ইংরেজি ভাষায় অনুবাদ । 1928 সালে, পিকথাল তার কুরআনের অর্থের অনুবাদ সম্পূর্ণ করার জন্য দুই বছরের বিশ্রাম নিয়েছিলেন, একটি কাজ যেটিকে তিনি তার কৃতিত্বের শীর্ষ বলে মনে করেছিলেন।', '1930-09-10', 'Arbi-Bangla', 990.00, '2024-09-19 17:40:08', 'মহিমান্বিত কুরআন.jpg'),
(39, 'কুরআন সুন্নাহর আলোকে ইসলামী আকীদা ', 'Islamic', '9789849328100', 'ইমান ও আকীদা বিষয়ক সুন্দর একটি বই। নিখাদ ঈমাণ আল্লাহর সন্তুষ্টি অর্জন এবং জান্নাত লাভের পূর্বশর্ত। ', '2017-12-01', 'Bangla', 385.00, '2024-09-19 17:40:08', 'কুরআন সুন্নাহর আলোকে ইসলামী আকীদা.jpg '),
(40, 'কুরআন-সুন্নাহর আলোকে পোশাক, পর্দা ও দেহ-সজ্জা', 'Islamic', '9789849328155', 'বইয়ের সংক্ষিপ্ত কথা : পোশাক-পরিচ্ছদ মানুষের জীবনের অবিচ্ছেদ্য ও সার্বক্ষণিক বিষয়। তাদের দৃষ্টিতে মহিলাদের ক্ষেত্রে শরীর অনাবৃত করাই নারী- স্বাধীনতার প্রকাশ, তবে পুরুষ-স্বাধীনতার প্রকাশ তার দেহ পুরোপুরি আবৃত করা।', '2007-09-04', 'Arabic-Bangla', 252.00, '2024-09-19 17:40:08', 'কুরআন-সুন্নাহর আলোকে পোশাক, পর্দা ও দেহ-সজ্জা.jpg'),
(41, 'কালার কোডেড উচ্চারণ ও অনুবাদ সহ সহজ কোরআন - এনি কালার', 'Islamic', '9798350717525', 'এই বইটিতে আমলের ১৩টি ফজিলতপূর্ণ সূরাসহ সহজ ৪৭টি সূরা যা কালার কোডেড উচ্চারণ ও অনুবাদসহ দেয়া হয়েছে। যা পাঠকদের কাছে অধিক গ্রহণযোগ্যতা পাবে।', '2020-09-02', 'Arabic-Bangla', 186.00, '2024-09-19 18:47:39', 'কালার কোডেড উচ্চারণ ও অনুবাদ সহ সহজ কোরআন - এনি কালার.jpg'),
(42, 'তাদাব্বুরে কুরআন (কুরআন বোঝার রাজপথে আপনার প্রথম স্বপ্নযাত্রা)', 'Islamic', '9789849406654 ', '৫২০ পৃষ্টার ৩০ পারা কুরআনের ১১৪টি সূরা নিয়েই বইটি রচিত অর্থাৎ সম্পুর্ণ কুরআনের ফাহম ও তাদাব্বুর। মূল পাঠে যাওয়ার আগে এবং পরের বিষয় নিয়ে মোট ১২৩ পাঠে সাবলীলভাবে সাজানো।', '2022-11-02', 'Bangla', 499.00, '2024-09-19 18:47:39', 'তাদাব্বুরে কুরআন (কুরআন বোঝার রাজপথে আপনার প্রথম স্বপ্নযাত্রা).jpg'),
(43, 'জেগে ওঠো আবার', 'Islamic', '9789849859185', 'এমন প্রশ্ন নিশ্চয়ই আপনার মনে হামেশাই ঘুরপাক খায়। আপনার এই সবগুলো প্রশ্নের উত্তর পেয়ে যাবেন \'জেগে ওঠো আবার বইটির পাতা ওলটালে।', '2024-05-08', 'Bangla', 278.00, '2024-09-19 18:47:39', 'জেগে ওঠো আবার.jpg'),
(44, 'তারাবীহর সালাতে কুরআনের বার্তা', 'Islamic', '8996700000001', 'আমাদের দেশে প্রায় সব মসজিদে সাতাশ তারাবীহতে কুরআন খতমের প্রচলন আছে। সে হিসেবে প্রতিদিনের তারাবীহতে পঠিতব্য অংশের ঘটনাবলি, ঈমান-আকীদা, আদেশ-নিষেধ, হালাল-হারাম, দৃষ্টান্ত, দোয়া এবং গুরুত্বপূর্ণ আয়াতসমূহের নির্যাস তুলে ধরা হয়েছে এই বইয়ে।', '2024-05-09', 'Bangla', 145.00, '2024-09-19 18:47:39', 'তারাবীহর সালাতে কুরআনের বার্তা.png'),
(45, 'সহিহভাবে কুরআন শিক্ষা তাজওইদ', 'Islamic', '9789843435507', 'পৃথিবীর সবচে শ্রেষ্ঠ গ্রন্থ হলো পবিত্র কুরআনুল কারীম। আর এই গ্রন্থ সহিহ ও শুদ্ধভাবে পড়ার মাধ্যম হলো তাজওইদ সম্পর্কে অবগত থাকা।', '2023-02-23', 'Bangla', 115.00, '2024-09-19 18:47:39', 'সহিহভাবে কুরআন শিক্ষা তাজওইদ.jpeg'),
(46, 'সিরাজদ্দৌলা ', 'Drama', '9788129509505', 'নবাব মির্জা মুহম্মদ সিরাজউদ্দৌলা (ফার্সি: مرزا محمد سراج الدوله; ১৭৩৩ – ২ জুলাই ১৭৫৭) ছিলেন বাংলা-বিহার-ওড়িশার শেষ স্বাধীন নবাব। তিনি ১৭৫৬ থেকে ১৭৫৭ সাল পর্যন্ত রাজত্ব করেছিলেন। তাঁর রাজত্বের সমাপ্তির পর বাংলা এবং পরবর্তীতে প্রায় সমগ্র ভারতীয় উপমহাদেশের উপর ইস্ট ইন্ডিয়া কোম্পানির শাসনের সূচনা হয়।', '1965-11-12', 'Bangla', 504.00, '2024-09-19 18:58:25', 'সিরাজদ্দৌলা.jpeg'),
(47, 'রক্তাক্ত প্রান্তর', 'Drama', '9789848899202', 'যে কাহিনীর ভিত্তিতে মুনীর চৌধুরীর \'রক্তাক্ত প্রান্তর\' লেখা. কায়কোবাদের বক্তব্য থেকে দেখা যাচ্ছে, একটা চ্যালেঞ্জ নিয়েই তিনি কাব্য-সাধনায় যুক্ত হয়েছিলেন।', '1991-06-19', 'Bangla', 172.00, '2024-09-19 18:58:25', 'রক্তাক্ত প্রান্তর.jpg'),
(48, 'রক্তকরবী ', 'Drama', '9848261591', 'রবীন্দ্রনাথের তত্ত্ব-আশ্রয়ী সাংকেতিক নাটকগুলোর মধ্যে \'রক্তকরবী\' অন্যতম। \'রক্তকবরী\' প্রকাশিত হয় ১৯১৬ সালে। এটি তাঁর এক অসাধারণ প্রতীক নাটক, বিশ্বের যে কোন একখানি শ্রেষ্ঠ প্রতীক নাটকের সমকক্ষ। এত রবীন্দ্রনাথ আধুনিক সমস্যার আর একটি উৎকট দিককে একটি অপরূপ প্রতীকতার মধ্যদিয়ে ব্যক্ত করেছেন।', '1926-09-16', 'Bangla', 133.00, '2024-09-19 19:13:04', 'রক্তকরবী.jpeg'),
(49, 'সালাহ উদ্দীন\'স মাস্টার ক্লাস', 'Sports', '9789849741183', ' ২৫ বছরের কোচিং ক্যারিয়ারে মোহাম্মদ সালাউদ্দিন কাজ করেছেন তিন প্রজন্মের সঙ্গে।', '2023-06-21', 'Bangla', 344.00, '2024-09-19 19:13:04', 'সালাহ উদ্দীন\'স মাস্টার ক্লাস.jpeg'),
(50, 'ডোপামিন ডিটক্স', 'Motivational', '9789849642688', 'যেসব গুরুত্বপূর্ণ বিষয় জীবনকে উন্নত করতে পারে, সেগুলো কি আপনার ভেতরে কোনো উত্তেজনা সৃষ্টি করে না? যদি ব্যাপারটা এমনই হয়, তাহলে সম্ভবতঃ আপনার ডোপামিন ডিটক্সের প্রয়োজন। ', '2023-07-25', 'Bangla', 160.00, '2024-09-19 19:13:04', 'ডোপামিন ডিটক্স.jpg');

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
  `stock_quantity` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `reader_id` int(11) DEFAULT NULL,
  `shop_owner_id` int(11) DEFAULT NULL,
  `book_id` int(11) DEFAULT NULL,
  `borrow_date` date DEFAULT NULL,
  `return_date` date DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `is_returned` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `borrow_bookavailability`
--

CREATE TABLE `borrow_bookavailability` (
  `book_id` int(11) DEFAULT NULL,
  `shop_owner_id` int(11) DEFAULT NULL,
  `available_copies` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `established_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `rating_id` int(11) NOT NULL,
  `book_id` int(11) DEFAULT NULL,
  `shop_owner_id` int(11) DEFAULT NULL,
  `rating` decimal(2,1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `readers`
--

CREATE TABLE `readers` (
  `reader_auto_id` int(11) DEFAULT NULL,
  `reader_id` varchar(20) DEFAULT NULL,
  `reader_name` varchar(100) DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `readers`
--

INSERT INTO `readers` (`reader_auto_id`, `reader_id`, `reader_name`, `phone_number`, `address`, `date_of_birth`, `email`) VALUES
(19, '240916019', NULL, NULL, NULL, NULL, NULL);

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
-- Table structure for table `shopowners`
--

CREATE TABLE `shopowners` (
  `shop_owner_id` int(11) DEFAULT NULL,
  `shop_name` varchar(100) NOT NULL,
  `owner_name` varchar(100) NOT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `state` varchar(50) DEFAULT NULL,
  `postal_code` varchar(10) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(19, 'user_reader', 'reader@gmail.com', '$2y$10$5xhNjV6L.mtQJFEHhor/pOs6ymZH8zR/7RIasQLGkbYG4VKhSodqa', 'Reader', '2024-09-16 07:28:24');

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
-- Table structure for table `writers`
--

CREATE TABLE `writers` (
  `writer_id` int(11) DEFAULT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `birth_date` date DEFAULT NULL,
  `nationality` varchar(50) DEFAULT NULL,
  `biography` text DEFAULT NULL,
  `website` varchar(100) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`book_id`),
  ADD UNIQUE KEY `isbn` (`isbn`);

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
  ADD PRIMARY KEY (`book_id`,`shop_owner_id`),
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
-- Indexes for table `publishers`
--
ALTER TABLE `publishers`
  ADD KEY `publisher_id` (`publisher_id`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`rating_id`),
  ADD KEY `fk_book` (`book_id`),
  ADD KEY `fk_shop_owner` (`shop_owner_id`);

--
-- Indexes for table `readers`
--
ALTER TABLE `readers`
  ADD KEY `reader_id` (`reader_auto_id`);

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
-- Indexes for table `writers`
--
ALTER TABLE `writers`
  ADD KEY `writer_id` (`writer_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `borrowing`
--
ALTER TABLE `borrowing`
  MODIFY `borrowing_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `rating_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Constraints for dumped tables
--

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
-- Constraints for table `publishers`
--
ALTER TABLE `publishers`
  ADD CONSTRAINT `publishers_ibfk_1` FOREIGN KEY (`publisher_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `ratings`
--
ALTER TABLE `ratings`
  ADD CONSTRAINT `fk_book` FOREIGN KEY (`book_id`) REFERENCES `books` (`book_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_shop_owner` FOREIGN KEY (`shop_owner_id`) REFERENCES `shopowners` (`shop_owner_id`) ON DELETE CASCADE;

--
-- Constraints for table `readers`
--
ALTER TABLE `readers`
  ADD CONSTRAINT `readers_ibfk_1` FOREIGN KEY (`reader_auto_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `shopowners`
--
ALTER TABLE `shopowners`
  ADD CONSTRAINT `shopowners_ibfk_1` FOREIGN KEY (`shop_owner_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `writers`
--
ALTER TABLE `writers`
  ADD CONSTRAINT `writers_ibfk_1` FOREIGN KEY (`writer_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
