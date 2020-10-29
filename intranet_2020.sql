
CREATE TABLE `admininfo` (
  `id` int(11) NOT NULL,
  `companyname` text NOT NULL,
  `avatar` text NOT NULL,
  `orgnr` text NOT NULL,
  `invoiceinfo` text NOT NULL,
  `address_street` text NOT NULL,
  `address_box` text NOT NULL,
  `address_city` text NOT NULL,
  `visit_address` text NOT NULL,
  `firstcolor` text NOT NULL,
  `secondcolor` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Tabellstruktur `arkiv`
--

CREATE TABLE `arkiv` (
  `id` int(11) NOT NULL,
  `file_name` text NOT NULL,
  `category` text NOT NULL,
  `descr` text NOT NULL,
  `the_file` text NOT NULL,
  `filesize` int(11) NOT NULL,
  `insert_date` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Tabellstruktur `arkiv_categories`
--

CREATE TABLE `arkiv_categories` (
  `id` int(11) NOT NULL,
  `cat_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumpning av Data i tabell `arkiv_categories`
--

INSERT INTO `arkiv_categories` (`id`, `cat_name`) VALUES
(1, 'Miljödokument'),
(2, 'Profilmaterial');

-- --------------------------------------------------------

--
-- Tabellstruktur `FAQ`
--

CREATE TABLE `FAQ` (
  `id` int(11) NOT NULL,
  `question` text NOT NULL,
  `answer` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellstruktur `leaveregister`
--

CREATE TABLE `leaveregister` (
  `id` int(11) NOT NULL,
  `reason` text NOT NULL,
  `from_date` text NOT NULL,
  `to_date` text NOT NULL,
  `fullname` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellstruktur `news_categories`
--

CREATE TABLE `news_categories` (
  `id` int(11) NOT NULL,
  `category_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumpning av Data i tabell `news_categories`
--

INSERT INTO `news_categories` (`id`, `category_name`) VALUES
(1, 'Test');

-- --------------------------------------------------------

--
-- Tabellstruktur `news_db`
--

CREATE TABLE `news_db` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `content` text NOT NULL,
  `author` text NOT NULL,
  `img` text NOT NULL,
  `insert_date` text NOT NULL,
  `category` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tabellstruktur `password_reset`
--

CREATE TABLE `password_reset` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `token` text NOT NULL,
  `tokenexpiretime` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellstruktur `sickregister`
--

CREATE TABLE `sickregister` (
  `id` int(11) NOT NULL,
  `reason` text NOT NULL,
  `from_date` text NOT NULL,
  `to_date` text NOT NULL,
  `fullname` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellstruktur `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fname` text NOT NULL,
  `lname` text NOT NULL,
  `username` text NOT NULL,
  `fullname` text NOT NULL,
  `email` text NOT NULL,
  `psw` text NOT NULL,
  `work_title` text NOT NULL,
  `address_street` text NOT NULL,
  `address_box` text NOT NULL,
  `address_city` text NOT NULL,
  `mobnr` text NOT NULL,
  `tfnr` text NOT NULL,
  `avatar` text NOT NULL,
  `active` int(11) NOT NULL,
  `bornday` text NOT NULL,
  `bornmonth` text NOT NULL,
  `bornyear` text NOT NULL,
  `sex` text NOT NULL,
  `lastlogin` text NOT NULL,
  `register_date` text NOT NULL,
  `register_tokenkey` text NOT NULL,
  `register_tokenexpiretime` text NOT NULL,
  `email_tokenkey` text NOT NULL,
  `email_expiretime` text NOT NULL,
  `adminapprove` int(11) NOT NULL,
  `adminmange` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumpning av Data i tabell `users`
--

--
-- Index för dumpade tabeller
--

--
-- Index för tabell `admininfo`
--
ALTER TABLE `admininfo`
  ADD PRIMARY KEY (`id`);

--
-- Index för tabell `arkiv`
--
ALTER TABLE `arkiv`
  ADD PRIMARY KEY (`id`);

--
-- Index för tabell `arkiv_categories`
--
ALTER TABLE `arkiv_categories`
  ADD PRIMARY KEY (`id`);

--
-- Index för tabell `FAQ`
--
ALTER TABLE `FAQ`
  ADD PRIMARY KEY (`id`);

--
-- Index för tabell `leaveregister`
--
ALTER TABLE `leaveregister`
  ADD PRIMARY KEY (`id`);

--
-- Index för tabell `news_categories`
--
ALTER TABLE `news_categories`
  ADD PRIMARY KEY (`id`);

--
-- Index för tabell `news_db`
--
ALTER TABLE `news_db`
  ADD PRIMARY KEY (`id`);

--
-- Index för tabell `password_reset`
--
ALTER TABLE `password_reset`
  ADD PRIMARY KEY (`id`);

--
-- Index för tabell `sickregister`
--
ALTER TABLE `sickregister`
  ADD PRIMARY KEY (`id`);

--
-- Index för tabell `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT för dumpade tabeller
--

--
-- AUTO_INCREMENT för tabell `admininfo`
--
ALTER TABLE `admininfo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT för tabell `arkiv`
--
ALTER TABLE `arkiv`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT för tabell `arkiv_categories`
--
ALTER TABLE `arkiv_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT för tabell `FAQ`
--
ALTER TABLE `FAQ`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT för tabell `leaveregister`
--
ALTER TABLE `leaveregister`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT för tabell `news_categories`
--
ALTER TABLE `news_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT för tabell `news_db`
--
ALTER TABLE `news_db`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT för tabell `password_reset`
--
ALTER TABLE `password_reset`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT för tabell `sickregister`
--
ALTER TABLE `sickregister`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT för tabell `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
